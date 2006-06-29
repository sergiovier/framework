<?php
//require_once('nucleo/browser/clases/interfaces.php');
require_once('nucleo/lib/cronometro.php');          		//Cronometrar ejecucion
require_once('nucleo/lib/db.php');		    				//Manejo de bases (utiliza abodb340)
require_once('nucleo/lib/encriptador.php');					//Encriptador
require_once('nucleo/lib/varios.php');						//Funciones genericas (Manejo de paths, etc.)
require_once('nucleo/lib/sql.php');							//Libreria de manipulacion del SQL
require_once('nucleo/lib/excepcion_toba.php');				//Excepciones del TOBA
require_once('nucleo/lib/logger.php');						//Logger
require_once('nucleo/lib/mensajes.php');						//Modulo de mensajes parametrizables
require_once('nucleo/lib/cola_mensajes.php');				//Cola de mensajes utilizada durante la EJECUCION
require_once('nucleo/lib/asercion.php');       	   			//Aserciones
require_once('nucleo/lib/permisos.php');					//Administrador de permisos particulares
require_once('nucleo/browser/recurso.php');					//Obtencion de imágenes de la aplicación
require_once('nucleo/componentes/constructor_toba.php');	//Constructor de componentes
require_once('nucleo/componentes/cargador_toba.php');		//Cargador de componentes
require_once('nucleo/componentes/catalogo_toba.php');		//Catalogo de componentes
require_once('nucleo/info_instalacion.php');				//Informacion sobre la instalacion
require_once('nucleo/info_instancia.php');					//Informacion sobre la instancia
require_once('nucleo/info_proyecto.php');	   				//Informacion sobre el proyecto
require_once('nucleo/browser/usuario_toba.php');	  		//Informacion sobre el usuario
require_once('nucleo/browser/editor.php');			  		//Interaccion con el EDITOR


class nucleo_toba
{
	static private $instancia;
	private $solicitud;
	private $medio_acceso;
	private $solicitud_en_proceso = false;
	
	private function __construct()
	{
		if (get_magic_quotes_gpc()) {
			throw new excepcion_toba("Necesita desactivar las 'magic_quotes' en el servidor (ver http://www.php.net/manual/es/security.magicquotes.disabling.php)");
		}
		toba::get_cronometro();
	}
	
	static function instancia()
	{
		if (!isset(self::$instancia)) {
			self::$instancia = new nucleo_toba();	
		}
		return self::$instancia;	
	}	

	function get_solicitud()
	{
		return $this->solicitud;
	}
		
	function acceso_web()
	{
		try {
			require_once('nucleo/solicitud.php');
			require_once('nucleo/browser/http.php');				//Genera Encabezados de HTTP
			require_once('nucleo/browser/sesion_toba.php');			//Control de sesiones HTTP
			session_start();
		    http::headers_standart();
			$this->preparar_include_path();
			$this->iniciar_contexto_proyecto();
			toba::get_db('instancia');
			try {
				$this->solicitud = $this->cargar_solicitud();
				$this->solicitud_en_proceso = true;
				$this->solicitud->procesar();
			} catch( excepcion_reset_nucleo $e ) {
				//El item puede redireccionar?
				if ( !$this->solicitud->get_datos_item('redirecciona') ) {
					throw new excepcion_toba('ERROR: El item no esta habilitado para provocar redirecciones.');
				}
				//TRAP para forzar la recarga de solicitud
				$this->solicitud_en_proceso = false;
				toba::get_hilo()->limpiar_memoria();
				$item_nuevo = $e->get_item();
				toba::get_hilo()->set_item_solicitado( $item_nuevo );				
				$this->solicitud = $this->cargar_solicitud();
				$this->solicitud->procesar();
			}
			$this->solicitud->registrar();
			$this->solicitud->finalizar_objetos();
		} catch (Exception $e) {
			toba::get_logger()->crit($e);
			echo $e->getMessage() . "\n\n";
		}
		toba::get_logger()->guardar();		
		//echo cronometro::instancia()->tiempo_acumulado();
	}

	/**
	*	Se determia el item y se controla el acceso
	*/
	function cargar_solicitud()
	{
		if (toba::get_sesion()->controlar_estado_activacion()) {
			$item = $this->get_id_item('item_inicio_sesion');
			$grupo_acceso = toba::get_sesion()->get_grupo_acceso();
			$solicitud = constructor_toba::get_runtime(array('proyecto'=>$item[0],'componente'=>$item[1]), 'item');
			if (!$solicitud->es_item_publico()) {
				info_proyecto::control_acceso_item($item, $grupo_acceso);
			}
			return $solicitud;
		} else {
			$mensaje_error = 'La seccion no esta activa. Solo es posible acceder items PUBLICOS.';
			$item = $this->get_id_item('item_pre_sesion');
			$solicitud = constructor_toba::get_runtime(array('proyecto'=>$item[0],'componente'=>$item[1]), 'item');
			if (!$solicitud->es_item_publico()) {
				// Si se arrastra una URL previa despues de finalizar la sesion y se refresca la pagina
				// el nucleo trata de cargar un item explicito por URL. El mismo no va a ser publico...
				// Esto apunta a solucionar ese error: Blanqueo el item solicitado y vuelvo a intentar.
				// (NOTA: esto puede ocultar la navegacion entre items supuestamente publicos)
				if ( toba::get_hilo()->obtener_item_solicitado() ) {
					toba::get_logger()->debug('Fallo la carga de un item publico. Se intenta con el item predeterminado');
					toba::get_hilo()->set_item_solicitado(null);					
					$item = $this->get_id_item('item_pre_sesion');
					$solicitud = constructor_toba::get_runtime(array('proyecto'=>$item[0],'componente'=>$item[1]), 'item');
					if (!$solicitud->es_item_publico()) {
						throw new excepcion_toba($mensaje_error);				
					}
				} else {
					throw new excepcion_toba($mensaje_error);				
				}
			}
			return $solicitud;
		}		
	}

	/**
	*	Averigua el ITEM ACTUAL. Si no existe y puede busca un ITEM PREDEFINIDO
	*/
	function get_id_item($predefinido=null,$forzar_predefinido=false)
	{
		$item = toba::get_hilo()->obtener_item_solicitado();		
		if (!$item) {
			if(isset($predefinido)){
				$item[0] = info_proyecto::instancia()->get_id();
				$item[1] = info_proyecto::instancia()->get_parametro($predefinido);		
				toba::get_hilo()->set_item_solicitado($item);
			} else {
				throw new excepcion_toba('NUCLEO: No es posible determinar el item a cargar');
			}
		}
		return $item;
	}
	
	function preparar_include_path()
	{
		$proyecto = info_proyecto::instancia()->get_id();
		$i_path = ini_get("include_path");
		if (substr(PHP_OS, 0, 3) == 'WIN'){
			$i_proy = toba_dir() . "/proyectos/" . $proyecto;
			$i_proy_php = $i_proy  . "/php";
			ini_set("include_path", $i_path . ";.;" . $i_proy_php );
		}else{
			$i_proy = toba_dir() . "/proyectos/" . $proyecto;
			$i_proy_php = $i_proy . "/php";
			ini_set("include_path", $i_path . ":.:" . $i_proy_php);
		}
		$_SESSION['toba']["path_proyecto"] = $i_proy;
		$_SESSION['toba']["path_proyecto_php"] = $i_proy_php;
		//echo "PROYECTO: $proyecto - INCLUDE_PATH= \"" . ini_get("include_path") ."\"";
	}

	function iniciar_contexto_proyecto()
	{
		include_once("inicializacion.php");
	}

	function acceso_consola($instancia, $proyecto, $item, $usuario)
	{
		try {
			//---- Registra la solicitud en la base
			define("apex_pa_registrar_solicitud","db");// VALORES POSIBLES: nunca, siempre, db
			//---- Guarda el benchmark de la generacion del item
			define("apex_pa_registrar_cronometro","db");//VALORES POSIBLES: nunca, siempre, db
			# Nivel de log a ARCHVO
			define("apex_pa_log_archivo",1);
			define("apex_pa_log_archivo_nivel",2);			
			define('apex_pa_instancia', $instancia);
			require_once("nucleo/solicitud_consola.php");
			$this->solicitud = new solicitud_consola($proyecto, $item, $usuario);
			toba::get_db("instancia");
			try{
				$this->iniciar_contexto_proyecto();
				$this->solicitud->procesar();	//Se llama a la ACTIVIDAD del ITEM
				$this->solicitud->registrar();
				$this->solicitud->finalizar_objetos();
			}catch( Exception $e ){
				toba::get_logger()->crit($e);
			}
			toba::get_logger()->guardar();
			exit( $this->solicitud->obtener_estado_proceso() );
		} catch (excepcion_toba $e) {
			ei_mensaje($e->getMessage());
		}		
	}
	
	function solicitud_en_proceso()
	{
		return $this->solicitud_en_proceso;
	}
}
?>