<?
require_once('comando_toba.php');

class comando_instalacion extends comando_toba
{
	static function get_info()
	{
		return "Administracion de la INSTALACION";
	}

	function mostrar_observaciones()
	{
		$this->consola->mensaje("Directorio de la INSTALACION: " . toba_dir() );
		$this->consola->enter();
	}
	
	//-------------------------------------------------------------
	// Opciones
	//-------------------------------------------------------------

	/**
	*	Muestra informacion de la instalacion.
	*/
	function opcion__info()
	{
		if ( instalacion::existe_info_basica() ) {
			$this->consola->enter();
			// INSTANCIAS
			$instancias = instalacion::get_lista_instancias();
			if ( $instancias ) {
				$this->consola->lista( $instancias, 'INSTANCIAS' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No existen INSTANCIAS definidas.');
			}
			$this->consola->enter();
			// BASES
			comando_toba::mostrar_bases_definidas();
			// ID de grupo de DESARROLLO
			$grupo = instalacion::get_id_grupo_desarrollo();
			if ( $grupo ) {
				$this->consola->enter();
				$this->consola->lista( array( $grupo ), 'ID grupo desarrollo' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No esta definido el ID del GRUPO de DESARROLLO.');
			}
			// PROYECTOS
			$proyectos = proyecto::get_lista();
			if ( $proyectos ) {
				$this->consola->lista( $proyectos, 'PROYECTOS' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No existen PROYECTOS definidos.');
			}
		} else {
			$this->consola->enter();
			$this->consola->mensaje( 'La INSTALACION no ha sido inicializada.');
		}
	}

	/**
	*	Agrega una BASE en la instalacion. [-d 'id_base']
	*/
	function opcion__agregar_db()
	{
		$def = $this->get_id_definicion_actual();
		if ( dba::existe_base_datos_definida( $def ) ) {
			throw new excepcion_toba( "Ya existe una base definida con el ID '$def'");
		}
		$form = $this->consola->get_formulario("Definir una nueva BASE de DATOS");
		$form->agregar_campo( array( 'id' => 'motor', 	'nombre' => 'MOTOR' ) );
		$form->agregar_campo( array( 'id' => 'profile',	'nombre' => 'HOST/PROFILE' ) );
		$form->agregar_campo( array( 'id' => 'usuario', 'nombre' => 'USUARIO' ) );
		$form->agregar_campo( array( 'id' => 'clave', 	'nombre' => 'CLAVE' ) );
		$form->agregar_campo( array( 'id' => 'base', 	'nombre' => 'BASE' ) );
		$datos = $form->procesar();
		instalacion::agregar_db( $def, $datos );
	}

	/**
	*	Elimina una BASE en la instalacion. [-d 'id_base']
	*/
	function opcion__eliminar_db()
	{
		$def = $this->get_id_definicion_actual();
		if ( dba::existe_base_datos_definida( $def ) ) {
			$this->consola->enter();
			$this->consola->subtitulo("DEFINICION: $def");
			$this->consola->lista_asociativa( dba::get_parametros_base( $def ), array('Parametro','Valor') );
			$this->consola->enter();
			if ( $this->consola->dialogo_simple("Desea eliminar la definicion?") ) {
				instalacion::eliminar_db( $def );
			}
		} else {
			throw new excepcion_toba( "NO EXISTE una base definida con el ID '$def'");
		}
	}
	
	/**
	*	Crea una instalacion.
	*/
	function opcion__crear()
	{
		instalacion::crear_directorio();
		if( ! instalacion::existe_info_basica() ) {
			$this->consola->titulo( "Configurando INSTALACION en: " . toba_dir() );
			$apex_clave_get = md5(uniqid(rand(), true)); 
			$apex_clave_db = md5(uniqid(rand(), true)); 
			$id_grupo_desarrollo = self::definir_id_grupo_desarrollo();
			instalacion::crear_info_basica( $apex_clave_get, $apex_clave_db, $id_grupo_desarrollo );
			instalacion::crear_info_bases();
			instalacion::crear_directorio_proyectos();
		} else {
			$this->consola->enter();
			$this->consola->mensaje( 'Ya existe una instalacion DEFINIDA' );
			$this->consola->enter();
		}
	}

	//-------------------------------------------------------------
	// Interface
	//-------------------------------------------------------------

	/**
	*	Determina sobre que base definida en 'info_bases' se va a trabajar
	*/
	private function get_id_definicion_actual()
	{
		$param = $this->get_parametros();
		if ( isset($param['-d']) &&  (trim($param['-d']) != '') ) {
			return $param['-d'];
		} else {
			throw new excepcion_toba("Es necesario indicar el ID de la BASE a utilizar. Utilice el modificador '-d'");
		}
	}
	
	/**
	*	Consulta al usuario el ID del grupo de desarrollo
	*/
	protected function definir_id_grupo_desarrollo()
	{
		$this->consola->subtitulo('Definir el ID del grupo de desarrollo');
		$this->consola->mensaje('Este codigo se utiliza para permitir el desarrollo paralelo de equipos '.
								'de trabajo geograficamente distribuidos.');
		$this->consola->enter();
		$resultado = $this->consola->dialogo_ingresar_texto( 'ID', false );
		if ( $resultado == '' ) {
			return null;	
		} else {
			return $resultado;	
		}
	}

	//-------------------------------------------------------------
	// Exclusivo migracion 0.8.3.3
	//-------------------------------------------------------------

	/**
	*	Migracion de definicion de instancias de la version 0.8.3.3
	*/
	function opcion__migrar_definicion()
	{
		require_once('instancias.php');
	
		//*** 0) Creo la carpeta INSTALACION
	
		$this->consola->titulo( "Inicializacion de la INSTALACION" );
		instalacion::crear_directorio();
		$this->consola->mensaje( "Crear carpeta 'instalacion'");
	
		//*** 1) BASES
	
		$bases_registradas = array();
		$this->consola->Mensaje( "Migrar la definicion de BASES. (php/instancias.php)" );
		if( ! instalacion::existe_info_bases() ) {
			foreach( $instancia as $i => $datos ) {
			    $base['motor']= $datos[apex_db_motor];
			    $base['profile'] = $datos[apex_db_profile];
			    $base['usuario'] = $datos[apex_db_usuario];
			    $base['clave'] = $datos[apex_db_clave];
			    $base['base'] = $datos[apex_db_base];
				$bases_registradas[] = $i;
				$bases[$i] = $base;
			}
			instalacion::crear_info_bases( $bases );
			$this->consola->mensaje("la definicion de BASES se encuentra ahora en '" . instalacion::archivo_info_bases() . "'");	
		} else {
			$this->consola->mensaje( "ya existe una archivo '" . instalacion::archivo_info_bases() . "'" );
		}
	
		// *** 2) CLAVES
	
		$this->consola->mensaje( "Migrar la definicion de CLAVES. (php/instancias.php)" );
		if( ! instalacion::existe_info_basica() ) {
			$this->consola->enter();
			$id_grupo_desarrollo = self::definir_id_grupo_desarrollo();
			instalacion::crear_info_basica( apex_clave_get, apex_clave_db, $id_grupo_desarrollo );
		} else {
			$this->consola->mensaje( "ya existe una archivo '" . instalacion::archivo_info_basica() . "'" );
		}
	
		// *** 3) INSTANCIAS
	
		$this->consola->enter();
		$this->consola->subtitulo( "Migrar INSTANCIAS toba" );
		$this->consola->mensaje( "Indique que BASES son INSTANCIAS toba"); 
		//Busco la lista de proyectos de la instalacion
	
		$proyectos = proyecto::get_lista();
	
		//Creo las instancias, preguntando en cada caso
		//Existe la opcion de conectarse a la base y preguntar si existe la tabla 'apex_objeto',
		//pero puede ser que por algun motivo la base no este online y sea una instancia
		foreach( $instancia as $i => $datos ) {
			if( $datos[apex_db_motor] == 'postgres7' ) {
				$this->consola->separador("BASE: $i");
				print_r($datos);
				if ( $this->consola->dialogo_simple("La base '$i' corresponde a una INSTANCIA TOBA?") ) {
					if( instalacion::existe_carpeta_instancia( $i ) ) {
						$this->consola->error("No es posible crearla instancia '$i'");
						$this->consola->mensaje("Ya exite una carpeta: $path"); 	
					} else {
						instalacion::crear_instancia( $i, $i, $proyectos );
					}
				}
			}
		}
		$this->consola->separador("FIN");		
		$this->consola->mensaje("La migracion ha finalizado");
		$this->consola->mensaje("Puede borrar el archivo 'toba_dir/php/instancias.php'");
	}
}
?>