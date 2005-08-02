<?
require_once("dbt_objeto.php");
require_once("db_registros/dbr_apex_objeto.php");
require_once("db_registros/dbr_apex_objeto_dependencias.php");

class dbt_objeto_db_tablas extends dbt_objeto
{
	function __construct($fuente)
	{
		//db_registros
		$this->elemento['base'] = new 				dbr_apex_objeto($fuente, 1, 1);
		$this->elemento['dependencias'] = new 		dbr_apex_objeto_dependencias($fuente, 0, 0);
		//Relaciones
		$this->cabecera = 'base';
		$this->detalles = array(
								'dependencias'=>array('proyecto','objeto_consumidor') 
							);
		parent::__construct($fuente);
	}
}
?>