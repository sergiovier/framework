<?php

class toba_aplicacion_modelo_base implements toba_aplicacion_modelo 
{
	protected $permitir_exportar_modelo = true;
	protected $permitir_instalar = true;
	protected $schema_modelo = 'public';
	protected $schema_auditoria = 'auditoria';
	
	/**
	 * @var toba_proceso_gui
	 */
	protected $manejador_interface;
	
	/**
	 * @var toba_modelo_instalacion
	 */	
	protected $instalacion;

	/**
	 * @var toba_modelo_instancia
	 */
	protected $instancia;
	
	/**
	 * @var toba_modelo_proyecto
	 */
	protected $proyecto;
	
	/**
	 * Inicializaci�n de la clase en el entorno consumidor
	 * @param toba_modelo_instalacion $instalacion Representante de la instalaci�n de toba como un todo
	 * @param toba_modelo_instancia $instancia Representante de la instancia actualmente utilizada
	 * @param toba_modelo_proyecto $proyecto Representante del proyecto como un proyecto toba (sin la l�gica de admin. de la aplicaci�n)
	 */
	function set_entorno($manejador_interface, toba_modelo_instalacion $instalacion, toba_modelo_instancia $instancia, toba_modelo_proyecto $proyecto)
	{
		$this->manejador_interface = $manejador_interface;
		$this->instalacion = $instalacion;
		$this->instancia = $instancia;
		$this->proyecto = $proyecto;
	}
	
	/**
	 * @return toba_modelo_instalacion
	 */
	function get_instalacion()
	{
		return $this->instalacion;
	}

	/**
	 * @return toba_modelo_instancia
	 */
	function get_instancia()
	{
		return $this->instancia;
	}

	/**
	 * @return toba_modelo_proyecto
	 */
	function get_proyecto()
	{
		return $this->proyecto;
	}
	
	
	/**
	 * Retorna la versi�n actualmente instalada de la aplicaci�n (puede no estar migrada)
	 * @return toba_version
	 */
	function get_version_actual()
	{
		return $this->get_version_nueva();
	}

	/**
	 * Retorna la versi�n a la cual se debe migrar la aplicaci�n (si ya esta migrada deber�a ser igual a la 'version_actual')
	 * @return toba_version
	 */	
	function get_version_nueva()
	{
		if (file_exists($this->proyecto->get_dir().'/VERSION')) {
			return new toba_version(file_get_contents($this->proyecto->get_dir().'/VERSION'));
		} else {
			return $this->instalacion->get_version_actual();
		}
	}
	
	function get_id_base()
	{
		$version = $this->get_version_nueva();		
		return $this->proyecto->get_id().'_'.$version->get_release('_');		
	}

	/**
	 * Toma como motor predefinido el mismo que el de la instalacion de toba
	 */
	function get_servidor_defecto()
	{
		$parametros = $this->instancia->get_parametros_db();
		if (isset($parametros['base'])) {
			unset($parametros['base']);
		}
		return $parametros;
	}	
	
	
	function cargar_modelo_datos($base)
	{
		$base->abrir_transaccion();
		if (! $base->existe_schema($this->schema_modelo)) {
			$base->crear_schema($this->schema_modelo);
			$base->set_schema($this->schema_modelo);				
		}
		$base->retrazar_constraints();
		$this->crear_estructura($base);
		$this->cargar_datos($base);
		$base->cerrar_transaccion();			
	}
	
	/**
	 * @todo No esta soportada la exportaci�n de los datos en Windows cuando el usuario de postgres requiere clave
	 */
	function regenerar_modelo_datos($base, $id_def_base)
	{
		if (! $this->permitir_exportar_modelo) {
			$this->manejador_interface->mensaje('Ya existe un modelo de datos del proyecto cargado previamente.');
			return;
		}
		$reemplazar = $this->manejador_interface->dialogo_simple("Ya existe el modelo de datos, ".
							"Desea reemplazarlo? (borra la base completa y la vuelva a cargar)", 's');
		if (! $reemplazar) {
			return;
		}
		$exportar = $this->manejador_interface->dialogo_simple("Antes de borrar la base. Desea exportar y utilizar su contenido actual en la nueva carga?", 's');
		if ($exportar) {
			//-- Esquema principal
			$archivo = $this->proyecto->get_dir().'/sql/datos_locales.sql';			
			$this->exportar_esquema_base($id_def_base, $this->schema_modelo, $archivo, true);
			//-- Esquema auditoria
			$archivo = $this->proyecto->get_dir().'/sql/datos_auditoria.sql';			
			$this->exportar_esquema_base($id_def_base, $this->schema_auditoria, $archivo, false);			
		}
		
		//--- Borra la base fisicamente
		$this->manejador_interface->mensaje('Borrando base actual', false);
		$base->destruir();
		unset($base);
		$this->instalacion->borrar_base_datos($id_def_base);
		$this->instalacion->crear_base_datos($id_def_base);
		$this->manejador_interface->progreso_avanzar();
		$this->manejador_interface->progreso_fin();		
		
		//--- Carga nuevamente el modelo de datos
		$base = $this->instalacion->conectar_base($id_def_base);
		$this->cargar_modelo_datos($base);	
	}
	
	protected function exportar_esquema_base($id_def_base, $esquema, $archivo, $obligatorio)
	{
		$parametros = $this->instalacion->get_parametros_base($id_def_base);
		if (file_exists($archivo)) {
			copy($archivo, $archivo.'.old');
		}
		$comando = "pg_dump -d -a -n $esquema -h {$parametros['profile']} -U {$parametros['usuario']} -f \"$archivo\" {$parametros['base']}";			
		if (! toba_manejador_archivos::es_windows() && $parametros['clave'] != '') {
			$clave = "export PGPASSWORD=".$parametros['clave'].';';
			$comando = $clave.$comando;
		}
		$this->manejador_interface->mensaje("Ejecutando: $comando");
		$salida = array();
		echo exec($comando, $salida, $exito);
		echo implode("\n", $salida);
		if ($obligatorio && $exito > 0) {
			throw new toba_error('No se pudo exportar correctamente los datos');
		}
	}
	
	
	/**
	 * Determina si el modelo de datos se encuentra cargado en una conexi�n espec�fica
	 * @param toba_db $base
	 */
	function estructura_creada(toba_db $base)
	{
		$tablas = $base->get_lista_tablas(false, $this->schema_modelo);
		return ! empty($tablas);
	}
	
	function crear_estructura(toba_db $base)
	{
		$estructura = $this->proyecto->get_dir().'/sql/estructura.sql';
		if (file_exists($estructura)) {
			$this->manejador_interface->mensaje('Creando estructura', false);
			$this->manejador_interface->progreso_avanzar();	
			$base->ejecutar_archivo($estructura);
			$this->manejador_interface->progreso_fin();
		}
	}

	
	function cargar_datos(toba_db $base)
	{
		$locales =  $this->proyecto->get_dir().'/sql/datos_locales.sql';
		if (file_exists($locales)) {
			$this->manejador_interface->mensaje('Cargando datos locales', false);			
			$this->manejador_interface->progreso_avanzar();			
			$base->ejecutar_archivo($locales);			
			$this->manejador_interface->progreso_fin();
		} else {
			$datos = $this->proyecto->get_dir().'/sql/datos_basicos.sql';
			if (file_exists($datos)) {
				$this->manejador_interface->mensaje('Cargando datos b�sicos', false);
				$base->ejecutar_archivo($datos);
				$this->manejador_interface->progreso_fin();				
			}			
		}		
	
	}
	
	/**
	 * @param array $datos_servidor Asociativo con los par�metros de conexi�n a la base
	 */
	function instalar($datos_servidor)
	{
		if (! $this->permitir_instalar) {
			return;
		}
		$version = $this->get_version_nueva();
		$fuentes = $this->proyecto->get_indice_fuentes();
		if (empty($fuentes)) {
			return;
		}
		$id = $this->proyecto->get_id();
		$this->manejador_interface->titulo("Instalando $id ".$version->__toString());		
		//--- Se asume que la base a instalar corresponde a la primer fuente
		$id_def_base = $this->proyecto->construir_id_def_base(current($fuentes));
		
		//--- Chequea si existe la entrada de la base de negocios en el archivo de bases
		if (! $this->instalacion->existe_base_datos_definida($id_def_base)) {
			if (! isset($datos_servidor['base'])) {
				$id_base = $this->get_id_base();
				$datos_servidor['base'] = $id_base;
			}
			//-- Cambia el schema
			$datos_servidor['schema'] = $this->schema_modelo;			

			//-- Agrega la definici�n de la base
			$this->instalacion->agregar_db($id_def_base, $datos_servidor);
		}
		
		//--- Chequea si existe fisicamente la base creada
		if (! $this->instalacion->existe_base_datos($id_def_base)) {
			$this->instalacion->crear_base_datos($id_def_base);
		} 
		
		//--- Chequea si hay un modelo cargado y decide que hacer en tal caso
		$base = $this->instalacion->conectar_base($id_def_base);	
		if (!$this->estructura_creada($base)) {
			$this->cargar_modelo_datos($base);			
		} else {
			$this->regenerar_modelo_datos($base, $id_def_base);
		}
	}

	function desinstalar()
	{
		$fuentes = $this->proyecto->get_indice_fuentes();
		if (empty($fuentes)) {
			return;
		}
		$id = $this->proyecto->get_id();
		$this->manejador_interface->titulo("Desinstalando $id");		
		//--- Se asume que la base a desinstalar corresponde a la primer fuente
		$id_def_base = $this->proyecto->construir_id_def_base(current($fuentes));
		
		//--- Chequea si existe la entrada de la base de negocios en el archivo de bases
		if ($this->instalacion->existe_base_datos_definida($id_def_base)) {
			//--- Chequea si existe fisicamente la base creada y la borra
			if ($this->instalacion->existe_base_datos($id_def_base)) {
				$this->manejador_interface->mensaje('Borrando base de datos', false);
				$this->manejador_interface->progreso_avanzar();	
				$this->instalacion->borrar_base_datos($id_def_base);
				$this->manejador_interface->progreso_fin();				
				
			} 			
			$this->instalacion->eliminar_db($id_def_base);
		}	
	}
	
	/**
	 * Crea los triggers, store_procedures y esquema para la auditor�a de tablas del sistema
	 * @param array $tablas Tablas especificas a auditar
	 * @param string $prefijo_tablas Tomar todas las tablas que tienen este prefijo, si es null se toman todas
	 * @param boolean $con_transaccion Crea el esquema dentro de una transaccion
	 */
	function crear_auditoria($tablas=array(), $prefijo_tablas=null, $con_transaccion=true)
	{
		$fuentes = $this->proyecto->get_indice_fuentes();
		if (empty($fuentes)) {
			return;
		}
		$id_def_base = $this->proyecto->construir_id_def_base(current($fuentes));
		$base = $this->instalacion->conectar_base($id_def_base);		
		if ($con_transaccion) {
			$base->abrir_transaccion();
		}
		//--- Tablas de auditor�a
		$auditoria = new toba_auditoria_tablas_postgres($base);
		if (empty($tablas)) {
			$auditoria->agregar_tablas($prefijo_tablas);
		} else {
			foreach($tablas as $tabla) {
				$auditoria->agregar_tabla($tabla);
			}
		}
		$this->manejador_interface->mensaje('Creando esquema de auditoria', false);
		$this->manejador_interface->progreso_avanzar();		
		if ($auditoria->existe()) {
			$auditoria->eliminar();
		}
		$auditoria->crear();
		$this->manejador_interface->progreso_fin();

		//--- Datos anteriores
		$archivo_datos = $this->proyecto->get_dir().'/sql/datos_auditoria.sql';
		if (file_exists($archivo_datos)) {
			$this->manejador_interface->mensaje('Cargando datos de auditoria', false);			
			$this->manejador_interface->progreso_avanzar();
			$base->ejecutar_archivo($archivo_datos);
			$this->manejador_interface->progreso_fin();
		}
		if ($con_transaccion) {
			$base->cerrar_transaccion();
		}		
	}
			
		
	/**
	 * Ejecuta los scripts de migraci�n entre dos versiones espec�ficas del sistema
	 * @param toba_version $desde
	 * @param toba_version $hasta
	 */
	function migrar(toba_version $desde, toba_version $hasta)
	{
		
	}	
	
}

?>