<?php
require_once('nucleo/lib/permisos.php');

class test_permisos extends test_toba
{

	function get_descripcion()
	{
		return "Permisos dentro de una operación";
	}

	function test_accion_inexistente()
	{
		try {
			toba::get_permisos()->validar("inexistente");
			$this->fail();
		} catch (toba_excepcion_def $e) {
			$this->pass();	
		}
	}
	
	function test_accion_permitida()
	{
		try {
			permisos::instancia()->validar("prueba1");
			$this->pass();			
		} catch (toba_excepcion_permisos $e) {
			$this->fail();			
		}		
	}	
	
	function test_accion_no_permitida()
	{
		try {
			permisos::instancia()->validar("prueba2");
			$this->fail();
		} catch (toba_excepcion_permisos $e) {
			$this->pass();	
		}		
	}
}

?>