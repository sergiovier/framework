<?php


use SIU\InterfacesManejadorSalidaToba\IFactory;

class toba_factory_service {
	
	
	private static $_instance;
	private static $_services;
	private static $_config = [
								'PaginaBasica' => 'bootstrap',
								'PaginaTitulo' => 'bootstrap',
								'PaginaNormal' => 'bootstrap',
								'PaginaPopup' => 'toba',
								'PaginaLogon' => 'toba',
								'ElementoInterfaz' => 'bootstrap',
								'Pantalla' => 'bootstrap',
								'Cuadro' => 'bootstrap',
								'SalidaHtml' => 'bootstrap',
								'Formulario' => 'bootstrap',
								'FormularioMl' => 'bootstrap',
								'EventoUsuario' => 'toba',
								'EventoTab' => 'bootstrap',
								'InputsForm' => 'toba',
								'FiltroColumnas' => 'bootstrap',
								'Menu' => 'bootstrap',
								'Filtro' => 'bootstrap'
	];
	
	/**
	 * @param string $component nombre del servicio que se desea obtener
	 * @return object instancia del objeto solicitado
	 */	
	function get($component, $default = false){
		$provider = $default?'toba':self::$_config[$component];
		$proyecto = toba_proyecto::get_id();
		$provider = $proyecto == 'toba_editor'?"toba":$provider;
		return new self::$_services[$provider][$component];
	}
	
	function registrarServicio(IFactory $fabrica){
		
		if(!( $fabrica instanceof IFactory))
			throw new toba_error("El servicio a registrar debe ser una implementación de IFactory");
		
		/* @todo Agregar validación de nombre */
		$nombre_fabrica = $fabrica->getProvider();
		
		foreach (get_class_methods($fabrica) as $method){
			$componente = substr($method, 3); //Le quito el 'get' para obtener el nombre
			
			if ($implementacion = $fabrica->$method() != null ){
				self::$_services[$nombre_fabrica][$componente] = $fabrica->$method();
				//echo self::$_services[$nombre_fabrica][$componente]; 
			}
		}		
		
	}
	
}