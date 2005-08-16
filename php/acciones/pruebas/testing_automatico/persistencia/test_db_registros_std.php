<?php
require_once("test_db_registros.php");
/*
	Test de la interface BASICA de un db_registros
	----------------------------------------------

	PRUEBAS PENDIENTE:
	
	* Columnas externas
	* carga de columnas externas
	* procesar registros en bloque
	* llamada a eventos de controlador
	* reset
	* Preservacion de campos que ya existian pero no se entregaron en una modificacion
	* Casos con claves distintas

	--- Funciones informativas sobre $this->dbr ------

	function dump($mensaje="Info")
	function dump_definicion_externa($mensaje="definicion EXTERNA")
	function dump_definicion($mensaje="Info DEFINICION")
	function dump_control($mensaje="Estructura CONTROL")
	function dump_datos($mensaje="Registros")
	function dump_datos_col($mensaje="Registros")

	--------------------------------------------------
*/
class test_db_registros_std extends test_db_registros
{
	//-------------------------------------------------------------
	//--- A. Recuperacion de la definicion
	//-------------------------------------------------------------

	function test_dump()
	{
		return;	
		$this->dump_control();
		$this->dump_definicion();
		$this->dump_definicion_externa();
		$this->dump();
		$this->dump_datos();
	}

	function test_recuperar_claves()
	{
		$this->assertEqualArray( $this->dbr->get_clave(), $this->get_clave_test() );
	}

/**  Se reprodujo el test en objeto_datos_tabla hasta aca **/

	function test_recuperar_tope_registros()
	{
		$this->assertEqual( $this->dbr->get_tope_max_registros(), 0 );
		$this->assertEqual( $this->dbr->get_tope_min_registros(), 0 );
	}
	
	function test_recuperar_clave_valor()
	{
		$this->dbr->cargar_datos_clave( $this->get_id_registro_test() );
		$this->assertEqual( $this->dbr->get_clave_valor(0), $this->get_clave_valor_test() );
	}

	//-------------------------------------------------------------
	//--- Recuperacion de datos
	//-------------------------------------------------------------

	function test_carga_registros()
	/*
		Carga completa de registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "db");
		$this->AssertEqual($control[1]['estado'], "db");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
	}

	function test_carga_registros_where()
	/*
		Carga completa de registros con WHERE
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 3);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "db");
		$this->AssertEqual($control[1]['estado'], "db");
		$this->AssertEqual($control[2]['estado'], "db");
	}

	function test_carga_registros_clave()
	/*
		Carga completa de registros con WHERE
	*/
	{
		$this->dbr->cargar_datos_clave( $this->get_id_registro_test() );
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 1);
		$registro = $this->dbr->get_registro(0);		
		$this->AssertEqual($registro['nombre'], "Naranjas");
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "db");
	}

	function test_obtencion_registros()
	/*
		Obtener los registros cargados
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		$datos = $this->dbr->get_registros();
		$this->AssertEqual( count($datos), 3);
		//Vino la columna que indica el ID interno
		for($a=0;$a<count($datos);$a++){
			$this->AssertTrue( isset($datos[$a][apex_db_registros_clave] ) );
		}
	}

	function test_obtencion_registro()
	/*
		Obtener un registro
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		$datos = $this->dbr->get_registro(0);
		$this->AssertTrue( is_array($datos) );
		$this->AssertTrue( isset($datos[apex_db_registros_clave]) );
	}

	function test_obtencion_registro_valor()
	/*
		Obtener un registro
	*/
	{
		$this->dbr->cargar_datos_clave( $this->get_id_registro_test() );
		$this->AssertEqual($this->dbr->get_registro_valor(0,"nombre"), "Naranjas");
	}

	function test_obtencion_registro_inexistente()
	/*
		Obtener un registro
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		if($dato = $this->dbr->get_registro(4)){
			$this->fail();
		}
		$this->pass();
	}

	function test_obtencion_registro_id_interno()
	/*
		Obtener los registros cargados
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		$datos = $this->dbr->get_registros(null, true);
		$this->AssertEqual( count($datos), 3);
		$control = $this->dbr->get_estructura_control();
		foreach(array_keys($datos) as $id){
			if(!isset($control[$id])){
				$this->fail();	
			}
		}
	}

	function test_obtencion_datos_filtro()
	/*
		Obtener los registros cargados aplicando un FILTRO
	*/
	{
		$where = $this->get_where_test();
		$this->dbr->cargar_datos($where);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 3);
		$datos = $this->dbr->get_registros( $this->get_condicion_filtro_test() );
		$this->AssertEqual(count($datos), 1);
	}

	//-------------------------------------------------------------
	//--- Modificacion de datos, sin sincro con la DB
	//-------------------------------------------------------------

	//**** INSERTAR ************************************************************

	function test_insertar_registros_dbr_vacio()
	/*
		Insertar registros
	*/
	{
		$id = $this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
		$this->AssertEqual($id, 0);
		$id = $this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
		$this->AssertEqual($id, 1);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 2);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "i");
		$this->AssertEqual($control[1]['estado'], "i");
	}

	function test_insertar_registros()
	/*
		Insertar registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
		$this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 6);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "db");
		$this->AssertEqual($control[1]['estado'], "db");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
		$this->AssertEqual($control[4]['estado'], "i");
		$this->AssertEqual($control[5]['estado'], "i");
	}

	function test_insertar_registro_campo_invalido_nulo()
	/*
		Insertar registros invalido: un campo not null es nulo
	*/
	{
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("invalido_null") );
			//ei_arbol($this->dbr->info(true),"db_registros");
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();	
			$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
			$this->AssertEqual( count( $this->dbr->get_estructura_control() ), 0);
		}
	}

	function test_insertar_registro_campo_invalido_no_existente()
	/*
		Insertar registros invalido: un campo no existe en la definicion
	*/
	{
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("invalido_col_inexistente") );
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();	
			$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
			$this->AssertEqual( count( $this->dbr->get_estructura_control() ), 0);
		}
	}

	function test_insertar_registro_conservacion_datos()
	/*
		Control de la conservacion de los datos insertados
	*/
	{
		$datos = $this->get_registro_test("valido_1");
		$this->dbr->agregar_registro( $datos );
		$datos_dbr = $this->dbr->get_registro( 0 );
		unset($datos_dbr[apex_db_registros_clave]);
		$this->assertEqualArray($datos, $datos_dbr);
	}

	//**** ELIMINAR ****************************************************+

	function test_eliminar_registros()
	/*
		Eliminar todos los registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->eliminar_registros();		
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "d");
		$this->AssertEqual($control[1]['estado'], "d");
		$this->AssertEqual($control[2]['estado'], "d");
		$this->AssertEqual($control[3]['estado'], "d");
	}

	function test_eliminar_registro_puntual()
	/*
		Eliminar registros puntuales
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->eliminar_registro(0);		
		$this->dbr->eliminar_registro(1);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 2);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "d");
		$this->AssertEqual($control[1]['estado'], "d");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
	}

	function test_eliminar_registro_inexistente()
	/*
		Eliminar un registro que no existe
	*/
	{
		try{
			$this->dbr->eliminar_registro( 0 );
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
			$this->AssertEqual( count( $this->dbr->get_estructura_control() ), 0);
			$this->pass();	
		}
	}

	function test_eliminar_conservacion_claves_internas()
	/*
		Conservacion de claves internas en la eliminacion
	*/
	{
		$id = $this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
		$this->AssertEqual($id, 0);
		$id = $this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
		$this->AssertEqual($id, 1);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 2);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "i");
		$this->AssertEqual($control[1]['estado'], "i");
		$this->dbr->eliminar_registro(0);
		$datos = $this->dbr->get_registros();
		$this->AssertEqual($datos[0][apex_db_registros_clave], 1, "Conservacion de clave como columna");
		$datos = $this->dbr->get_registros(null,true);
		$id = array_keys($datos);
		$this->AssertEqual($id[0], 1, "Conservacion de clave como llave");
	}

	//**** MODIFICAR ************************************************************

	function test_modificar_registro()
	/*
		Modificar registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->modificar_registro( $this->get_registro_test("valido_1"), 0);
		$this->dbr->modificar_registro( $this->get_registro_test("valido_2"), 1);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$this->AssertEqual($control[1]['estado'], "u");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
	}
	
	function test_modificar_registro_inexistente()
	/*
		Modificar un registro que no existe
	*/
	{
		try{
			$this->dbr->modificar_registro( $this->get_registro_test("valido_1"),0 );
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();	
			$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
			$this->AssertEqual( count( $this->dbr->get_estructura_control() ), 0);
		}
	}

	function test_modificar_registro_campo_invalido_nulo()
	/*
		Modificar registros con un campo un campo "not null" nulo
	*/
	{
		try{
			$this->dbr->cargar_datos();
			$this->dbr->modificar_registro( $this->get_registro_test("invalido_null"), 0);
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();	
			$control = $this->dbr->get_estructura_control();
			$this->AssertEqual($control[0]['estado'], "db");
			$this->AssertEqual($control[1]['estado'], "db");
			$this->AssertEqual($control[2]['estado'], "db");
			$this->AssertEqual($control[3]['estado'], "db");
		}
	}

	function test_modificar_registro_campo_invalido_no_existente()
	/*
		Modificar registros con un campo un campo que no existe en la definicion
	*/
	{
		try{
			$this->dbr->cargar_datos();
			$this->dbr->modificar_registro( $this->get_registro_test('invalido_col_inexistente'), 0);
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();	
			$control = $this->dbr->get_estructura_control();
			$this->AssertEqual($control[0]['estado'], "db");
			$this->AssertEqual($control[1]['estado'], "db");
			$this->AssertEqual($control[2]['estado'], "db");
			$this->AssertEqual($control[3]['estado'], "db");
		}
	}

	function test_modificar_registro_conservacion_datos()
	/*
		Control de la conservacion de los datos insertados
	*/
	{
		$this->dbr->cargar_datos();
		$datos = $this->get_registro_test("valido_1");
		$this->dbr->modificar_registro( $datos, 0 );
		$datos_dbr = $this->dbr->get_registro( 0 );
		foreach(array_keys($datos) as $dato){
			if(!isset($datos_dbr[$dato])){
				$this->fail();	
				return;
			}else{
				if(! ($datos_dbr[$dato] == $datos[$dato] )){
					$this->fail();	
					return;
				}			
			}
		}
		$this->pass();
	}

	function test_modificar_registro_valor_puntual()
	{
		$this->dbr->cargar_datos();
		$this->dbr->set_registro_valor( 0, "nombre", "pizza" );
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$registro = $this->dbr->get_registros(array("nombre"=>"pizza"));
		$this->AssertEqual( count($registro), 1);
	}
	
	function test_modificar_valor_columna()
	{
		$this->dbr->cargar_datos();
		$this->dbr->set_valor_columna("nombre", "pizza");
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$this->AssertEqual($control[1]['estado'], "u");
		$this->AssertEqual($control[2]['estado'], "u");
		$this->AssertEqual($control[3]['estado'], "u");
		$registro = $this->dbr->get_registros(array("nombre"=>"pizza"));
		$this->AssertEqual( count($registro), 4);
	}

	//-------------------------------------------------------------
	//--- Modificacion de datos con sincronizacion con la DB
	//-------------------------------------------------------------

	//**** INSERTAR ************************************************************

	function test_sync_insertar_registros()
	/*
		Insertar registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
		$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
		$this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[4]['estado'], "i");
		$this->AssertEqual($control[5]['estado'], "i");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 2);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[4]['estado'], "db");
		$this->AssertEqual($control[5]['estado'], "db");
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 6);
	}

	function test_sync_insertar_registros_error_db()
	/*
		Insertar un registro que la base va a rechazar
	*/
	{
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("invalido_db") );
			$control = $this->dbr->get_estructura_control();
			$this->AssertEqual($control[0]['estado'], "i");
			$diff = $this->dbr->sincronizar();
			$this->fail();
		}catch( excepcion_toba $e ){
			$this->pass();
			$control = $this->dbr->get_estructura_control();
			$this->AssertEqual($control[0]['estado'], "i");
		}
	}

	//**** ELIMINAR ****************************************************+

	function test_sync_eliminar_registros()
	/*
		Eliminar todos los registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
		$this->dbr->eliminar_registros();
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "d");
		$this->AssertEqual($control[1]['estado'], "d");
		$this->AssertEqual($control[2]['estado'], "d");
		$this->AssertEqual($control[3]['estado'], "d");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 4);
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 0);
	}

	function test_sync_eliminar_registro_puntual()
	/*
		Eliminar registros puntuales
	*/
	{
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
		$this->dbr->eliminar_registro(0);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "d");
		$this->AssertEqual($control[1]['estado'], "db");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 1);
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 3);
	}

	//**** MODIFICAR ************************************************************

	function test_sync_modificar_registro()
	/*
		Modificar registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
		$this->dbr->modificar_registro($this->get_registro_test("valido_1"), 0);
		$this->dbr->modificar_registro($this->get_registro_test("valido_2"), 1);
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$this->AssertEqual($control[1]['estado'], "u");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 2);
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$where[] =  "nombre = 'TOMATE'";
		$this->dbr->cargar_datos($where);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 2);
	}
	
	function test_sync_modificar_registro_valor_puntual()
	/*
		Modificar una columna de un registro
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->set_registro_valor( 0, "nombre", "pizza" );
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$this->AssertEqual($control[1]['estado'], "db");
		$this->AssertEqual($control[2]['estado'], "db");
		$this->AssertEqual($control[3]['estado'], "db");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 1);
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$where[] =  "nombre = 'pizza'";
		$this->dbr->cargar_datos($where);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 1);
	}
	
	function test_sync_modificar_columnas()
	/*
		Modificar una columna en todos los registros
	*/
	{
		$this->dbr->cargar_datos();
		$this->dbr->set_valor_columna("nombre", "pizza");
		$control = $this->dbr->get_estructura_control();
		$this->AssertEqual($control[0]['estado'], "u");
		$this->AssertEqual($control[1]['estado'], "u");
		$this->AssertEqual($control[2]['estado'], "u");
		$this->AssertEqual($control[3]['estado'], "u");
		$diff = $this->dbr->sincronizar();
		$this->AssertEqual($diff, 4);
		//Compruebo que los nuevos registros existan en la DB
		$this->dbr->resetear();
		$where[] =  "nombre = 'pizza'";
		$this->dbr->cargar_datos($where);
		$this->AssertEqual($this->dbr->get_cantidad_registros(), 4);
	}

	//-------------------------------------------------------------
	//--- Varios
	//-------------------------------------------------------------

	//-- TOPES de REGISTROS

	function test_tope_maximo_registros_carga()
	/*
		No se deben cargar de la DB mas registros que los que el tope basico permite
	*/
	{
		$this->dbr->set_tope_max_registros(3);
		try{
			$this->dbr->cargar_datos();	//Hay 4 registros
			$this->fail("Se sobrepaso el tope de registros en la carga");
		}catch( excepcion_toba $e ){
			$this->pass();	
		}
	}

	function test_tope_maximo_registros_agregar()
	/*
		No se puede agregar mas registros que los que permite el tope
	*/
	{
		$this->dbr->set_tope_max_registros(5);
		$this->dbr->cargar_datos();	//Hay 4 registros
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
			$this->pass("No se supero el tope ahun");	
			$this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
			$this->fail("Se sobrepaso el tope de registros agregando un registro");
		}catch( excepcion_toba $e ){
			$this->pass();	
		}
	}

	function test_tope_minimo_registros_sincronizar()
	/*
		No se pueden sincronizar menos registros que los que el tope minimo permite
	*/
	{
		$this->dbr->set_tope_min_registros(2);
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
			$this->dbr->sincronizar();
			$this->fail("No se cumplio con el tope minimo de registros");
		}catch( excepcion_toba $e ){
			$this->pass();	
			$this->dbr->agregar_registro( $this->get_registro_test("valido_2") );
			$this->dbr->sincronizar();
			$this->pass();	
		}
	}

	//-- CONSTRAINTS
	
	function test_control_no_duplicado_agregar()
	/*
		Manejo de REGLAS UNIQUE cuando se agregan registros
	*/
	{
		$this->dbr->set_no_duplicado( $this->get_constraint_no_duplicado() );
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
			$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
			$this->fail("Se rompio un CONSTRAINT UNIQUE");
		}catch( excepcion_toba $e ){
			$this->pass();	
		}
	}

	function test_control_no_duplicado_modificar()
	/*
		Manejo de REGLAS UNIQUE cuando se agregan registros
	*/
	{
		$this->dbr->set_no_duplicado( $this->get_constraint_no_duplicado() );
		$this->dbr->cargar_datos();
		try{
			$this->dbr->agregar_registro( $this->get_registro_test("valido_1") );
			$this->dbr->modificar_registro( $this->get_registro_test("valido_1"),0 );
			$this->fail("Se rompio un CONSTRAINT UNIQUE");
		}catch( excepcion_toba $e ){
			$this->pass();	
		}
	}
}
?>