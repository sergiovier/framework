<?php 
class ci_planes extends toba_ci
{
	//-----------------------------------------------------------------------------------
	//---- Inicializacion ---------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function ini()
	{
	}

	//-----------------------------------------------------------------------------------
	//---- Eventos ----------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function evt__procesar()
	{
		$asistente = toba_catalogo_asistentes::buscar('toba_plan_operacion_abms','toba_editor',1);
		$asistente->generar_molde();
		$asistente->crear_operacion();
	}

	function evt__cancelar()
	{
	}
}

?>