<?php

class ci_selector_archivos extends objeto_ci
{
	protected $archivo;
	
	function mantener_estado_sesion()
	{
		$propiedades = parent::mantener_estado_sesion();
		return $propiedades;
	}
	
	function evt__listado__carga()
	{
		$inicial = toba::get_hilo()->obtener_parametro('ef_popup_valor');
		$relativo = toba::get_hilo()->obtener_proyecto_path()."/php/";
		$this->dependencia('listado')->set_path_relativo_inicial($relativo);
		if ($inicial != null)
			$this->dependencia('listado')->set_path(dirname($inicial));
	}

	
}
?>