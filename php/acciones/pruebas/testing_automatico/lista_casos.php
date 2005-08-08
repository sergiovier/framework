<?php
include_once('nucleo/browser/interface/ef.php');

class lista_casos
{
	static function get_categorias()
	{
		return array(
					array('id' => 'todas', 'nombre' => '-- Todas --'),
					array('id' => 'administrador', 'nombre' => 'Administrador Toba'),
					array('id' => 'ef', 'nombre' => "Ef's"),
					array('id' => 'items', 'nombre' => 'Items'),
					array('id' => 'objetos', 'nombre' => 'Objetos'),
					array('id' => 'persistencia', 'nombre' => 'Persistencia'),
					array('id' => 'varios', 'nombre' => 'Varios')
				);
	}
	
	static function get_casos($categoria = apex_ef_no_seteado)
	{
		$casos = array(
					//Items
					array('id' => 'test_item', 'nombre' => 'Comportamiento b�sico del �tem', 'categoria' => 'items'),
					array('id' => 'test_arbol_items', 'nombre' => 'Manejo del �rbol de �tems', 'categoria' => 'items'),
					
					//Objetos
					array('id' => 'test_ei_formulario_ml', 'nombre' => 'ei_formulario_ml', 'categoria' => 'objetos'),
					array('id' => 'test_db_registros', 'nombre' =>  'db_registros', 'categoria' => 'objetos'),

					//EF
					array('id' => 'test_editable', 'nombre' => 'EF Editable', 'categoria' => 'ef'),
					array('id' => 'test_editable_numero', 'nombre' => 'EF N�mero', 'categoria' => 'ef'),
					array('id' => 'test_multi_seleccion', 'nombre' => 'EF Multi-selecci�n', 'categoria' => 'ef'),
					array('id' => 'test_fijos', 'nombre' => 'EF Fijos', 'categoria' => 'ef'),					
					array('id' => 'test_entrega_parametros', 'nombre' => 'EF * - Entrega de parametros', 'categoria' => 'ef'),

					//Persistencia
					array('id' => 'test_db_registros_std_s_1', 'nombre' =>  'DBR Estandard -- db_registros_s -[ 1 ]- (clave simple)', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_std_s_2', 'nombre' =>  'DBR Estandard -- db_registros_s -[ 2 ]- (clave multiple)', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_std_mt_1', 'nombre' => 'DBR Estandard -- db_registros_mt -[ 1 ]- ( 2 tablas / INNER join / clave simple identica)', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_std_mt_2', 'nombre' => 'DBR Estandard -- db_registros_mt -[ 2 ]- ( 2 tablas / INNER join / clave compuesta identica)', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_std_mt_3', 'nombre' => 'DBR Estandard -- db_registros_mt -[ 3 ]- ( 3 tablas / INNER join / clave simple identica)', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_s_seq', 'nombre' =>  'SEQ db_registros_s', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_mt_seq', 'nombre' =>  'SEQ db_registros_ml', 'categoria' => 'persistencia'),
					array('id' => 'test_db_registros_s_alias', 'nombre' =>  'ALIAS db_registros_s', 'categoria' => 'persistencia'),
					//array('id' => 'test_db_tablas_cd', 'nombre' => 'DB Tablas Cabecera-Detalle', 'categoria' => 'persistencia'),

					//Administrador
					array('id' => 'test_elemento_toba', 'nombre' => 'Elementos Toba', 'categoria' => 'administrador'),
					array('id' => 'test_reflexion', 'nombre' => 'Creaci�n de archivos y clases PHP', 'categoria' => 'administrador'),
					array('id' => 'test_motor_wiki', 'nombre' => 'Motor Wiki', 'categoria' => 'administrador'),
					array('id' => 'test_exportador', 'nombre' => 'Exportador', 'categoria' => 'administrador'),
					
					//Varios
					array('id' =>  'test_parseo_etiquetas', 'nombre' => 'Parseo de etiquetas', 'categoria' => 'varios'), 
				);

		if ($categoria == 'todas' || $categoria == apex_ef_no_seteado)
			return $casos;
		else {
			$casos_selecc = array();
			foreach ($casos as $caso) {
				if ($caso['categoria'] == $categoria) {
					$casos_selecc[] = $caso;
				}
			}
			return $casos_selecc;
		}
	}
}


?>