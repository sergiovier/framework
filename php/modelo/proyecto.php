<?php
require_once('lib/elemento_modelo.php');
require_once('modelo/instancia.php');
require_once('modelo/consultas/dao_permisos.php');
require_once('modelo/info/contexto_info.php');
require_once('nucleo/componentes/toba_catalogo.php');
require_once('nucleo/componentes/toba_cargador.php');
require_once('lib/toba_manejador_archivos.php');
require_once('lib/toba_sincronizador_archivos.php');
require_once('lib/toba_editor_archivos.php');
require_once('lib/reflexion/toba_clase_datos.php');
require_once('modelo/estructura_db/tablas_proyecto.php');
require_once('modelo/estructura_db/tablas_instancia.php');
require_once('modelo/estructura_db/tablas_componente.php');
require_once('nucleo/lib/toba_editor.php'); //Se necesita para saber el ID del editor

/**
*	Administrador de metadatos de PROYECTOS
*/
class proyecto extends elemento_modelo
{
	private $instancia;				
	private $identificador;
	private $dir;
	private $sincro_archivos;
	private $db;
	const dump_prefijo_componentes = 'dump_';
	const dump_prefijo_permisos = 'grupo_acceso__';
	const compilar_archivo_referencia = 'tabla_tipos';
	const compilar_prefijo_componentes = 'php_';	
	const template_proyecto = '/php/modelo/template_proyecto';
	private $compilacion_tabla_tipos;

	function __construct( instancia $instancia, $identificador )
	{
		$this->instancia = $instancia;
		$this->identificador = $identificador;
		$this->dir = $instancia->get_path_proyecto($identificador);
		if( ! is_dir( $this->dir ) ) {
			throw new toba_error("PROYECTO: El proyecto '{$this->identificador}' es invalido. (la carpeta '{$this->dir}' no existe)");
		}
		$this->db = $this->instancia->get_db();
		contexto_info::set_db($this->get_db());
		contexto_info::set_proyecto($this->identificador);
		toba_logger::instancia()->debug('PROYECTO "'.$this->identificador.'"');				
	}

	function get_sincronizador()
	{
		if ( ! isset( $this->sincro_archivos ) ) {
			$this->sincro_archivos = new toba_sincronizador_archivos( $this->get_dir_dump() );
		}
		return $this->sincro_archivos;
	}

	//-----------------------------------------------------------
	//	Informacion BASICA
	//-----------------------------------------------------------

	function get_id()
	{
		return $this->identificador;
	}
	
	
	function get_alias()
	{
		return $this->get_id();
	}
	
	function get_dir()
	{
		return $this->dir;	
	}

	function get_dir_dump()
	{
		return $this->dir . '/metadatos';	
	}

	function get_dir_componentes()
	{
		return $this->get_dir_dump() . '/componentes';
	}
	
	function get_dir_tablas()
	{
		return $this->get_dir_dump() . '/tablas';
	}

	function get_dir_permisos()
	{
		return $this->get_dir_dump() . '/permisos';
	}
	
	function get_dir_componentes_compilados()
	{
		return $this->dir . '/metadatos_compilados/componentes';
	}

	function get_instancia()
	{
		return $this->instancia;
	}
	
	function get_db()
	{
		return $this->instancia->get_db();	
	}

	//-----------------------------------------------------------
	//	ACTUALIZAR SVN
	//-----------------------------------------------------------

	function actualizar()
	{
		$dir = $this->get_dir();
		system("svn update $dir");		
	}
	
	//-----------------------------------------------------------
	//	EXPORTAR
	//-----------------------------------------------------------

	function exportar()
	{
		toba_logger::instancia()->debug( "Exportando PROYECTO {$this->identificador}");
		$this->manejador_interface->titulo( "Exportaci�n PROYECTO {$this->identificador}" );		
		$existe_vinculo = $this->instancia->existe_proyecto_vinculado( $this->identificador );
		$existen_metadatos = $this->instancia->existen_metadatos_proyecto( $this->identificador );
		if( !( $existen_metadatos || $existe_vinculo ) ) {
			throw new toba_error("PROYECTO: El proyecto '{$this->identificador}' no esta asociado a la instancia actual");
		}
		try {
			$this->exportar_tablas();
			$this->exportar_componentes();
			$this->exportar_permisos();
			$this->sincronizar_archivos();
		} catch ( toba_error $e ) {
			$this->manejador_interface->error( "Proyecto {$this->identificador}: Ha ocurrido un error durante la exportacion:\n".
												$e->getMessage() );
		}
	}
	
	private function sincronizar_archivos()
	{
		$obs = $this->get_sincronizador()->sincronizar();
		$this->manejador_interface->lista( $obs, 'Observaciones' );
	}

	//-- TABLAS -------------------------------------------------------------

	private function exportar_tablas()
	{
		$this->manejador_interface->mensaje("Exportando datos generales", false);
		toba_manejador_archivos::crear_arbol_directorios( $this->get_dir_tablas() );
		foreach ( tablas_proyecto::get_lista() as $tabla ) {
			$contenido = $this->get_contenido_tabla($tabla);			
			if ( trim( $contenido ) != '' ) {
				$this->guardar_archivo( $this->get_dir_tablas() .'/'. $tabla . '.sql', $contenido );			
			}
			$this->manejador_interface->mensaje_directo('.');
		}
		$this->manejador_interface->mensaje("OK");
	}

	private function get_contenido_tabla($tabla, $where_extra=null)
	{
		$definicion = tablas_proyecto::$tabla();
		//Genero el SQL
		if( isset($definicion['dump_where']) && ( trim($definicion['dump_where']) != '') ) {
   			$w = stripslashes($definicion['dump_where']);
   			$where = ereg_replace("%%",$this->get_id(), $w);
        } else {
   			$where = " ( proyecto = '".$this->get_id()."')";
		}
		if(isset($where_extra)) $where = $where . ' AND ('. $where_extra .')';
		$sql = "SELECT " . implode(', ', $definicion['columnas']) .
				" FROM $tabla " .
				" WHERE $where " .
				//" WHERE {$definicion['dump_clave_proyecto']} = '".$this->get_id()."}' " .
				" ORDER BY {$definicion['dump_order_by']} ;\n";
		//$this->manejador_interface->mensaje( $sql );
		$contenido = "";
		$datos = $this->db->consultar($sql);
		$regs = count( $datos );
		if ( $regs > 1 ) {
			$columnas_orden = array_map('trim', explode(',',$definicion['dump_order_by']) );
			$datos = rs_ordenar_por_columnas( $datos, $columnas_orden );
		
		}
		toba_logger::instancia()->debug("TABLA  $tabla  ($regs reg.)");
		for ( $a = 0; $a < $regs ; $a++ ) {
			$contenido .= sql_array_a_insert( $tabla, $datos[$a] );
		}
		return $contenido;
	}

	//-- COMPONENTES -------------------------------------------------------------

	/*
	*	Exporta los componentes
	*/
	private function exportar_componentes()
	{
		$this->manejador_interface->mensaje("Exportando componentes", false);
		toba_cargador::instancia()->crear_cache_simple( $this->get_id(), $this->db );
		foreach (toba_catalogo::get_lista_tipo_componentes_dump() as $tipo) {
			$lista_componentes = toba_catalogo::get_lista_componentes( $tipo, $this->get_id(), $this->db );
			foreach ( $lista_componentes as $id_componente) {
				$this->exportar_componente( $tipo, $id_componente );
			}
			$this->manejador_interface->mensaje_directo(".");
		}
		$this->manejador_interface->mensaje("OK");		
	}
	
	/*
	*	Exporta un componente
	*/
	private function exportar_componente( $tipo, $id )
	{
		$directorio = $this->get_dir_componentes() . '/' . $tipo;
		toba_manejador_archivos::crear_arbol_directorios( $directorio );
		$archivo = toba_manejador_archivos::nombre_valido( self::dump_prefijo_componentes . $id['componente'] );
		$contenido =&  $this->get_contenido_componente( $tipo, $id );
		$this->guardar_archivo( $directorio .'/'. $archivo . '.sql', $contenido ); 
		toba_logger::instancia()->debug("COMPONENTE $tipo  --  " . $id['componente'] . 
									' ('.$this->cant_reg_exp.' reg.)');
	}
	
	/*
	*	Genera el contenido de la exportacion de un componente
	*/
	private function & get_contenido_componente( $tipo, $id )
	{
		$this->cant_reg_exp = 0;
		//Recupero metadatos
		$metadatos = toba_cargador::instancia()->get_metadatos_simples( $id, $tipo, $this->db );
		//Obtengo el nombre del componente
		if ( isset($metadatos['apex_objeto']) ) {
			$nombre_componente = $metadatos['apex_objeto'][0]['nombre'];		
		} else {
			$nombre_componente = $metadatos['apex_item'][0]['nombre'];		
		}
		//Genero el CONTENIDO
		$contenido = "------------------------------------------------------------\n";
		$contenido .= "--[{$id['componente']}]--  $nombre_componente \n";
		$contenido .= "------------------------------------------------------------\n";
		foreach ( $metadatos as $tabla => $datos) {
			for ( $a=0; $a<count($datos); $a++ ) {
				$this->cant_reg_exp++;				
				$contenido .= sql_array_a_insert( $tabla, $datos[$a] );
			}
		}
		return $contenido;		
	}

	//-- PERMISOS -------------------------------------------------------------

	private function exportar_permisos()
	{
		$this->manejador_interface->mensaje("Exportando permisos", false);
		toba_manejador_archivos::crear_arbol_directorios( $this->get_dir_permisos() );
		$tablas = array('apex_usuario_grupo_acc', 'apex_usuario_grupo_acc_item', 'apex_permiso_grupo_acc');
		foreach( $this->get_lista_permisos() as $permiso ) {
			toba_logger::instancia()->debug("PERMISO  $permiso");
			$contenido = '';		
			$where = "usuario_grupo_acc = '$permiso'";
			foreach($tablas as $tabla) {
				$contenido .= $this->get_contenido_tabla($tabla, $where);
			}
			if ( $contenido ) {
				$this->guardar_archivo( $this->get_dir_permisos() .'/'. self::dump_prefijo_permisos . $permiso . '.sql', $contenido );			
				$this->manejador_interface->mensaje_directo('.');
			}			
		}
		$this->manejador_interface->mensaje("OK");
	}

	function get_lista_permisos()
	{
		$permisos = dao_permisos::get_grupos_acceso();
		$datos = array();
		foreach($permisos as $permiso) {
			$datos[] = $permiso['usuario_grupo_acc'];	
		}
		return $datos;
	}

	//-----------------------------------------------------------
	//	CARGAR
	//-----------------------------------------------------------
	
	/*
	*	Carga en proyecto en una transaccion
	*/
	function cargar_autonomo()
	{
		toba_logger::instancia()->debug( "Cargando PROYECTO {$this->identificador}");					
		try {
			$this->db->abrir_transaccion();
			$this->db->retrazar_constraints();
			$this->cargar();
			$this->instancia->actualizar_secuencias();
			$this->db->cerrar_transaccion();
		} catch ( toba_error $e ) {
			$this->db->abortar_transaccion();
			$this->manejador_interface->error( "PROYECTO: Ha ocurrido un error durante la IMPORTACION:\n".
												$e->getMessage() );
		}
	}

	/*
	*	Carga un proyecto
	*/
	function cargar()
	{
		toba_logger::instancia()->debug("Cargando proyecto '{$this->identificador}'");
		if( ! ( $this->instancia->existe_proyecto_vinculado( $this->identificador ) ) ) {
			throw new toba_error("PROYECTO: El proyecto '{$this->identificador}' no esta asociado a la instancia actual");
		}
		$this->cargar_tablas();
		$this->cargar_componentes();
		$this->cargar_permisos();
	}

	private function cargar_tablas()
	{
		$this->manejador_interface->mensaje('Cargando datos globales', false);
		$archivos = toba_manejador_archivos::get_archivos_directorio( $this->get_dir_tablas(), '|.*\.sql|' );
		$cant_total = 0;
		foreach( $archivos as $archivo ) {
			$cant = $this->db->ejecutar_archivo( $archivo );
			toba_logger::instancia()->debug($archivo . ". ($cant)");
			$this->manejador_interface->mensaje_directo('.');
			$cant_total++;
		}
		$this->manejador_interface->mensaje("OK");
	}
	
	private function cargar_permisos()
	{
		$this->manejador_interface->mensaje('Cargando permisos', false);
		$archivos = toba_manejador_archivos::get_archivos_directorio( $this->get_dir_permisos(), '|.*\.sql|' );
		$cant_total = 0;
		foreach( $archivos as $archivo ) {
			$cant = $this->db->ejecutar_archivo( $archivo );
			toba_logger::instancia()->debug($archivo . ". ($cant)");
			$this->manejador_interface->mensaje_directo('.');
			$cant_total++;
		}
		$this->manejador_interface->mensaje("OK");
	}

	private function cargar_componentes()
	{
		$this->manejador_interface->mensaje('Cargando componentes', false);		
		$subdirs = toba_manejador_archivos::get_subdirectorios( $this->get_dir_componentes() );
		foreach ( $subdirs as $dir ) {
			$archivos = toba_manejador_archivos::get_archivos_directorio( $dir , '|.*\.sql|' );
			foreach( $archivos as $archivo ) {
				$cant = $this->db->ejecutar_archivo( $archivo );
				toba_logger::instancia()->debug($archivo . " ($cant)");
			}
			$this->manejador_interface->mensaje_directo('.');			
		}
		$this->manejador_interface->mensaje('OK');
	}

	//-----------------------------------------------------------
	//	ELIMINAR
	//-----------------------------------------------------------

	/*
	*	Eliminacion dentro de una transaccion
	*/
	function eliminar_autonomo()
	{
		try {
			$this->db->abrir_transaccion();
			$this->db->retrazar_constraints();
			$this->eliminar();
			$this->db->cerrar_transaccion();
			$this->manejador_interface->mensaje("El proyecto '{$this->identificador}' ha sido eliminado");
		} catch ( toba_error $e ) {
			$this->db->abortar_transaccion();
			$this->manejador_interface->error( "Ha ocurrido un error durante la eliminacion de TABLAS de la instancia:\n".
												$e->getMessage() );
		}
	}

	function eliminar()
	{
		$this->manejador_interface->mensaje( "Borrando metadatos...", false);
		$sql = $this->get_sql_eliminacion();
		$cant = count($sql);		
		$cant = $this->db->ejecutar( $sql );
		toba_logger::instancia()->debug("Eliminacion. Registros borrados: $cant");
		$this->manejador_interface->mensaje( "OK" );				
	}

	/*
	*	Genera el SQL de eliminacion del proyecto
	*/	
	private function get_sql_eliminacion()
	{
		// Tablas
		$tablas = array();
		//Busco las TABLAS y sus WHERES
		$catalogos = array();
		$catalogos['tablas_componente'][] = 'get_lista';
		$catalogos['tablas_proyecto'][] = 'get_lista';
		$catalogos['tablas_instancia'][] = 'get_lista_proyecto';
		$catalogos['tablas_instancia'][] = 'get_lista_proyecto_log';
		$catalogos['tablas_instancia'][] = 'get_lista_proyecto_usuario';
		foreach( $catalogos as $catalogo => $indices ) {
			foreach( $indices as $indice ) {
				$lista_tablas = call_user_func( array( $catalogo, $indice ) );
				foreach ( $lista_tablas as $t ) {
					$info_tabla = call_user_func( array( $catalogo, $t ) );
					if( isset( $info_tabla['dump_where'] ) ) {
						$where = " WHERE " . ereg_replace('%%', $this->identificador, stripslashes($info_tabla['dump_where']) );
						$where = ereg_replace( " dd", $t, $where );						
					} else {
						$where = " WHERE proyecto = '{$this->identificador}'";
					}
					$tablas[ $t ] = $where;
				}
			}
		}
		$sql = sql_array_tablas_delete( $tablas );
		return $sql;
	}

	//-----------------------------------------------------------
	//	REGENERAR
	//-----------------------------------------------------------

	/*
	*	cargar un PROYECTO en una instancia ya creada
	*/
	function regenerar()
	{
		toba_logger::instancia()->debug( "Regenerando PROYECTO {$this->identificador}");
		$this->manejador_interface->titulo( "Regenerando PROYECTO {$this->identificador}" );		
		try {
			$this->db->abrir_transaccion();
			$this->db->retrazar_constraints();
			$this->eliminar();
			$this->cargar();
			$this->instancia->cargar_informacion_instancia_proyecto( $this->identificador );
			$this->instancia->actualizar_secuencias();			
			$this->db->cerrar_transaccion();
		} catch ( toba_error $e ) {
			$this->db->abortar_transaccion();
			$this->manejador_interface->error("PROYECTO {$this->identificador}: Ha ocurrido un error durante la IMPORTACION:\n".
												$e->getMessage());
		}
	}

	//-----------------------------------------------------------
	//	COMPILAR
	//-----------------------------------------------------------

	function compilar()
	{
		try {
			$this->compilar_componentes();
			$this->crear_compilar_archivo_referencia();
		} catch ( toba_error $e ) {
			$this->manejador_interface->error( "PROYECTO {$this->identificador}: Ha ocurrido un error durante la compilacion:\n".
												$e->getMessage());
		}
	}

	/*
	*	Ciclo de compilacion de componentes
	*/
	function compilar_componentes()
	{
		foreach (toba_catalogo::get_lista_tipo_componentes_dump() as $tipo) {
			$this->manejador_interface->titulo( $tipo );
			$path = $this->get_dir_componentes_compilados() . '/' . $tipo;
			toba_manejador_archivos::crear_arbol_directorios( $path );
			foreach (toba_catalogo::get_lista_componentes( $tipo, $this->get_id(), $this->db ) as $id_componente) {
				$this->compilar_componente( $tipo, $id_componente );
			}
		}
	}
	
	/*
	*	Compila un componente
	*/
	function compilar_componente( $tipo, $id )
	{
		//Armo la clase compilada
		$nombre = toba_manejador_archivos::nombre_valido( self::compilar_prefijo_componentes . $id['componente'] );
		$this->manejador_interface->mensaje("Compilando: " . $id['componente']);
		$clase = new toba_clase_datos( $nombre );		
		$metadatos = toba_cargador::instancia()->get_metadatos_extendidos( $id, $tipo, $this->db );
		$clase->agregar_metodo_datos('get_metadatos',$metadatos);
		//Creo el archivo
		$directorio = $this->get_dir_componentes_compilados() . '/' . $tipo;
		$path = $directorio .'/'. $nombre . '.php';
		$clase->guardar( $path );
		//Creo la tabla de referencia
		/*	ATENCION! excluyo los items porque pueden pisarse los IDs con los objetos	*/
		if ( $tipo != 'item' ) {
			$this->compilacion_tabla_tipos[$id['componente']] = $tipo;
		}
	}

	/*
	*	Creo la tabla de referencias
	*/
	function crear_compilar_archivo_referencia()
	{
		//Armo la clase compilada
		$this->manejador_interface->mensaje("Creando tabla de tipos.");
		$clase = new toba_clase_datos( self::compilar_archivo_referencia );		
		$clase->agregar_metodo_datos('get_datos',$this->compilacion_tabla_tipos);
		//Creo el archivo
		$archivo = toba_manejador_archivos::nombre_valido( self::compilar_archivo_referencia );
		$path = $this->get_dir_componentes_compilados() .'/'. $archivo . '.php';
		$clase->guardar( $path );
	}

	//-----------------------------------------------------------
	//	Primitivas basicas
	//-----------------------------------------------------------

	private function guardar_archivo( $archivo, $contenido )
	{
		file_put_contents( $archivo, $contenido );
		$this->get_sincronizador()->agregar_archivo( $archivo );
	}
	
	//-----------------------------------------------------------
	//	Informacion sobre METADATOS
	//-----------------------------------------------------------
	
	function get_lista_grupos_acceso()
	{
		$sql = "SELECT usuario_grupo_acc as id, nombre
				FROM apex_usuario_grupo_acc
				WHERE proyecto = '".$this->get_id()."';";
		return $this->instancia->get_db()->consultar( $sql );
	}

	function get_lista_componentes()
	{
		$sql = "	SELECT clase, COUNT(*) as cantidad
					FROM apex_objeto
					WHERE proyecto = '{$this->identificador}'
					GROUP BY 1
					ORDER BY 2 DESC";
		return $this->instancia->get_db()->consultar( $sql );
	}
		
	//-----------------------------------------------------------
	//	Manipulacion de METADATOS
	//-----------------------------------------------------------

	function vincular_usuario( $usuario, $perfil_acceso, $perfil_datos = 'no' )
	{
		$sql = self::get_sql_vincular_usuario( $this->get_id(), $usuario, $perfil_acceso, $perfil_datos );
		$this->instancia->get_db()->ejecutar( $sql );
	}

	function desvincular_usuario( $usuario )
	{
		$sql = "DELETE FROM apex_usuario_proyecto 
				WHERE usuario = '$usuario'
				AND proyecto = '".$this->get_id()."'";
		$this->instancia->get_db()->ejecutar( $sql );
	}
	
	function get_item_login()
	{
		$sql = "SELECT item_pre_sesion FROM apex_proyecto WHERE proyecto='{$this->identificador}'";
		$rs = $this->get_db()->consultar($sql);
		return $rs[0]['item_pre_sesion'];
	}
	
	/**
	 * @todo Cuando los dao_editores se puedan usar desde consola, cambiar la consulta manual 
	 */
	function actualizar_login($pisar_anterior = false)
	{
		//--- �Existe el proyecto editor?
		if (! $this->instancia->existen_metadatos_proyecto( toba_editor::get_id() )) {
			$msg = "No se crea el item de login porque el proyecto editor no est� cargado en la instancia";
			toba_logger::instancia()->info($msg);
			$this->manejador_interface->mensaje($msg);
			return;
		}
		//--- Averiguo la fuente destino
		/**
		require_once('modelo/consultas/dao_editores.php');
		dao_editores::get_fuentes_datos
		*/
		$sql = "SELECT proyecto, fuente_datos, descripcion_corta  
				FROM apex_fuente_datos
				WHERE ( proyecto = '{$this->identificador}' )
				ORDER BY 2";
		$fuentes = $this->get_db()->consultar($sql);
		if (empty($fuentes)) {
			throw new toba_error("El proyecto no tiene definida una fuente de datos.");
		} else {
			$fuente = current($fuentes);
		}
		
		//--- Clonando
		$comando = 'toba item ejecutar -p toba_editor -t 1000043 ';
		$comando .= ' -orig_proy toba_editor';
		$comando .= ' -orig_item 1000042';
		$comando .= ' -dest_proy '.$this->identificador;
		$comando .= ' -dest_padre "__raiz__"';
		$comando .= ' -dest_fuente '.$fuente['fuente_datos'];
		$comando .= ' -dest_dir login';	
		//---- Averiguo un usuario capaz de ejecutar en toba_editor
		$usuarios = $this->instancia->get_usuarios_administradores('toba_editor');
		if (! empty($usuarios)) {
			$comando .= ' -u '.$usuarios[0]['usuario'];	
		}		

		
		$this->manejador_interface->mensaje("Clonando item de login...", false);
		toba_logger::instancia()->debug("Ejecutando el comando: $comando");
		$id_item = trim(exec($comando));
		if (! is_numeric($id_item)) {
			throw new toba_error("($id_item). A ocurrido un error clonando el item de login. Ver el log del proyecto toba_editor");
		}
		$this->manejador_interface->mensaje("OK");
		
		//--- Actualizar el item de login
		$this->manejador_interface->mensaje("Actualizando el proyecto...", false);		
		$sql = "UPDATE apex_proyecto SET item_pre_sesion='$id_item'
				WHERE proyecto='{$this->identificador}'";
		$this->get_db()->ejecutar($sql);
		$this->manejador_interface->mensaje("OK");
		
		//--- Borrar el item viejo
		if ($pisar_anterior) {
			echo "Aun no est� implementada la eliminaci�n desde consola";
		}		
	}

	//------------------------------------------------------------------------
	//-------------------------- Manejo de Versiones --------------------------
	//------------------------------------------------------------------------
	function migrar_rango_versiones($desde, $hasta, $recursivo)
	{
		$this->get_db()->abrir_transaccion();
		parent::migrar_rango_versiones($desde, $hasta, $recursivo);
		$this->get_db()->cerrar_transaccion();
	}
	
	function migrar_version($version)
	{
		if ($version->es_mayor($this->get_version_actual())) {
			toba_logger::instancia()->debug("Migrando proyecto {$this->identificador} a la versi�n ".$version->__toString());
			$this->manejador_interface->mensaje("Migrando proyecto '{$this->identificador}'");
			$version->ejecutar_migracion('proyecto', $this, null, $this->manejador_interface);
			$this->actualizar_campo_version($version);
		} else {
			toba_logger::instancia()->debug("El proyecto {$this->identificador} no necesita migrar a la versi�n ".$version->__toString());
		}
	}
	
	function ejecutar_migracion_particular($version, $metodo)
	{
		$this->get_db()->abrir_transaccion();		
		$version->ejecutar_migracion('proyecto', $this, $metodo, $this->manejador_interface);
		$this->get_db()->cerrar_transaccion();		
	}

	function get_version_actual()
	{
		$sql = "SELECT version_toba FROM apex_proyecto WHERE proyecto='{$this->identificador}'";
		$rs = $this->db->consultar($sql);
		$version = $rs[0]['version_toba'];
		if (! isset($version)) {
			return version_toba::inicial();
		}
		return new version_toba($version);
	}
	
	private function actualizar_campo_version($version)
	{
		$sql = $this->get_sql_actualizar_version($version, $this->identificador);
		$this->get_db()->ejecutar($sql);
	}
	
	private function get_sql_actualizar_version($version, $id_proyecto)
	{
		$nueva = $version->__toString();
		$sql = "UPDATE apex_proyecto SET version_toba='$nueva' WHERE proyecto='$id_proyecto'";
		return $sql;
	}	
	
	//-----------------------------------------------------------
	//	Funcionalidad ESTATICA
	//-----------------------------------------------------------
	
	/**
	*	Devuelve la lista de proyectos existentes en la carpeta por defecto de la instalaci�n
	* 	Es posible que existan proyectos en otros lugares del sistema de archivos y no se listen con este m�todo
	* 	@return array Arreglo asociativo path relativo => id proyecto
	*/
	static function get_lista()
	{
		$proyectos = array();
		$directorio_proyectos = toba_dir() . '/proyectos';
		if( is_dir( $directorio_proyectos ) ) {
			if ($dir = opendir($directorio_proyectos)) {
			   while (false	!==	($archivo = readdir($dir)))	{ 
					if( is_dir($directorio_proyectos . '/' . $archivo) 
							&& ($archivo != '.' ) && ($archivo != '..' ) && ($archivo != '.svn' ) ) {
						$arch_nombre = $directorio_proyectos . '/' . $archivo.'/PROYECTO';
						$id = $archivo;
						//--- Si no se encuentra el archivo PROYECTO, se asume que dir=id
						if (file_exists($arch_nombre)) {
							$id = file_get_contents($arch_nombre);
						}
						$proyectos[$archivo] = $id;													
					}
			   } 
			   closedir($dir);
			}
		}
		return $proyectos;
	}
	
	
	
	/**
	*	Indica si un proyecto existe en el sistema de archivos
	*/
	static function existe( $nombre )
	{
		$proyectos = self::get_lista();
		if ( in_array( $nombre, $proyectos ) ) {
			return true;	
		} else {
			return false;	
		}
	}
	
	/**
	*	Crea un proyecto NUEVO
	*/
	static function crear( instancia $instancia, $nombre, $usuarios_a_vincular )
	{
		//- 1 - Controles
		$dir_template = toba_dir() . self::template_proyecto;
		if ( $nombre == 'toba' ) {
			throw new toba_error("INSTALACION: No es posible crear un proyecto con el nombre 'toba'");	
		}
		if ( self::existe( $nombre ) ) {
			throw new toba_error("INSTALACION: Ya existe una carpeta con el nombre '$nombre' en la carpeta 'proyectos'");	
		}
		try {
			//- 2 - Modificaciones en el sistema de archivos
			$dir_proyecto = $instancia->get_path_proyecto($nombre);
			// Creo la CARPETA del PROYECTO
			toba_manejador_archivos::copiar_directorio( $dir_template, $dir_proyecto );
			
			//--- Creo el archivo PROYECTO
			file_put_contents($dir_proyecto.'/PROYECTO', $nombre);
			// Modifico los archivos
			$editor = new toba_editor_archivos();
			$editor->agregar_sustitucion( '|__proyecto__|', $nombre );
			$editor->agregar_sustitucion( '|__instancia__|', $instancia->get_id() );
			$editor->agregar_sustitucion( '|__toba_dir__|', toba_manejador_archivos::path_a_unix( toba_dir() ) );
			$editor->procesar_archivo( $dir_proyecto . '/www/aplicacion.php' );
			// Asocio el proyecto a la instancia
			$instancia->vincular_proyecto( $nombre );

			//- 3 - Modificaciones en la BASE de datos
			$db = $instancia->get_db();
			try {
				$db->abrir_transaccion();
				$db->retrazar_constraints();
				$db->ejecutar( self::get_sql_metadatos_basicos( $nombre ) );
				$sql_version = self::get_sql_actualizar_version( instalacion::get_version_actual(),
																$nombre);
				$db->ejecutar($sql_version);
				foreach( $usuarios_a_vincular as $usuario ) {
					$db->ejecutar( self::get_sql_vincular_usuario( $nombre, $usuario, 'admin', 'no' ) );
				}
				$db->cerrar_transaccion();
			} catch ( toba_error $e ) {
				$db->abortar_transaccion();
				$txt = 'PROYECTO : Ha ocurrido un error durante la carga de METADATOS del PROYECTO. DETALLE: ' . $e->getMessage();
				throw new toba_error( $txt );
			}
		} catch ( toba_error $e ) {
			// Borro la carpeta creada
			if ( is_dir( $dir_proyecto ) ) {
				$instancia->desvincular_proyecto( $nombre );
				toba_manejador_archivos::eliminar_directorio( $dir_proyecto );
			}	
			throw $e;
		}
	}
	
	/**
	*	Sentencias de creacion de los metadatos BASICOS
	*/
	static function get_sql_metadatos_basicos( $id_proyecto )
	{
		// Creo el proyecto
		$sql[] = "INSERT INTO apex_proyecto (proyecto, estilo,descripcion,descripcion_corta,listar_multiproyecto, item_inicio_sesion, menu) VALUES ('$id_proyecto','toba','".strtoupper($id_proyecto)."','".ucwords($id_proyecto)."',1, '/inicio','css');";
		//Le agrego los items basicos
		$sql[] = "INSERT INTO apex_item (proyecto, item, padre_proyecto, padre, carpeta, nivel_acceso, solicitud_tipo, pagina_tipo_proyecto, pagina_tipo, nombre, descripcion, actividad_buffer_proyecto, actividad_buffer, actividad_patron_proyecto, actividad_patron) VALUES ('$id_proyecto','__raiz__','$id_proyecto','__raiz__','1','0',NULL,'toba','NO','Raiz PROYECTO','','toba','0','toba','especifico');";
		$sql[] = "INSERT INTO apex_item (proyecto, item, padre_proyecto, padre, carpeta, nivel_acceso, solicitud_tipo, pagina_tipo_proyecto, pagina_tipo, nombre, descripcion, actividad_buffer_proyecto, actividad_buffer, actividad_patron_proyecto, actividad_patron,actividad_accion,menu,orden) VALUES ('$id_proyecto','/inicio','$id_proyecto','__raiz__','0','0','web','toba','normal','Inicio','','toba','0','toba','especifico','item_inicial.php',1,'0');";
		// Creo un grupo de acceso
		$sql[] = "INSERT INTO apex_usuario_grupo_acc (proyecto, usuario_grupo_acc, nombre, nivel_acceso, descripcion) VALUES ('$id_proyecto','admin','Administrador','0','Accede a toda la funcionalidad');";
		$sql[] = "INSERT INTO apex_usuario_grupo_acc_item ( proyecto, usuario_grupo_acc, item ) VALUES ('$id_proyecto', 'admin', '/inicio');";
		// Creo un perfil de datos
		$sql[] = "INSERT INTO apex_usuario_perfil_datos (proyecto, usuario_perfil_datos, nombre, descripcion) VALUES ('$id_proyecto','no','No posee','');";
		// Crea una fuente de datos 
		$sql[] = "INSERT INTO apex_fuente_datos (proyecto, fuente_datos, fuente_datos_motor, descripcion, descripcion_corta, link_instancia, instancia_id) VALUES ('$id_proyecto','$id_proyecto', 'postgres7', 'Fuente $id_proyecto', '$id_proyecto', 1, '$id_proyecto');";
		// Pone la fuente de datos como predeterminada
		$sql[] = "UPDATE apex_proyecto SET fuente_datos='$id_proyecto' WHERE proyecto='$id_proyecto';";
		return $sql;
	}

	static function get_sql_vincular_usuario( $proyecto, $usuario, $perfil_acceso, $perfil_datos )
	{
		$sql = array();
		$sql[] = "INSERT INTO apex_usuario_proyecto (proyecto, usuario, usuario_grupo_acc, usuario_perfil_datos)
					VALUES ('$proyecto','$usuario','$perfil_acceso','$perfil_datos');";
				// Decide un PA por defecto para el proyecto
		$sql[] = "INSERT INTO apex_admin_param_previsualizazion (proyecto, usuario, grupo_acceso, punto_acceso) 
					VALUES ('$proyecto','$usuario','$perfil_acceso', '/$proyecto');";
		return $sql;
	}
}
?>
