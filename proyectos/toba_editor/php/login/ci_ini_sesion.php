<?php 
require_once('modelo/catalogo_modelo.php');
require_once('modelo/lib/gui.php');

class ci_ini_sesion extends toba_ci
{
	function evt__form__modificacion($datos)
	{
		if ( isset($datos)) {
			try {
				toba::manejador_sesiones()->iniciar_sesion_proyecto($datos);
			} catch ( toba_error_login $e ) {
				toba::notificacion()->agregar( $e->getMessage() );
			}
		}		
	}

	function evt__form__ingresar($datos)
	{
		$this->evt__form__modificacion($datos);
	}

	//--- COMBOS ----------------------------------------------------------------

	function get_lista_instancias()
	{
		$instancias = instancia::get_lista();
		$datos = array();
		$a = 0;
		foreach( $instancias as $x) {
			$datos[$a]['id'] = $x;
			$datos[$a]['desc'] = $x;
			$a++;
		}
		return $datos;
	}
	
	function get_lista_proyectos($instancia_id)
	{
		$instancia = catalogo_modelo::instanciacion()->get_instancia($instancia_id, new mock_gui);
		$proyectos = $instancia->get_lista_proyectos_vinculados();
		$datos = array();
		$a = 0;
		foreach( $proyectos as $x) {
			$datos[$a]['id'] = $x;
			$datos[$a]['desc'] = $x;
			$a++;
		}
		return $datos;
	}
}
?>