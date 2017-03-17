<?php


use SIU\InterfacesManejadorSalidaToba\IFactory;

class toba_factory_service {
	
	
	private static $_instance;
	private static $_services;
	
	/**
	 * @param string $component nombre del servicio que se desea obtener
	 * @return object instancia del objeto solicitado
	 */	
	function get($component){
		
		return new self::$_services['toba'][$component];
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