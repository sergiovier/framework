<?
require_once("ap.php");
define("apex_db_registros_separador","%");

class ap_tabla_db extends ap
{
	// Definicion general
	protected $where;							// Condicion utilizada para cargar datos - WHERE
	protected $from;							// Condicion utilizada para cargar datos - FROM
	
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//------  CARGA  ----------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------

	public function cargar_datos_clave($id)
	{
		/*
			Esta funcion deberia mapear un ID expresado como un array
			y transformarlo en un WHERE
		*/		
	}

	public function cargar_datos($where=null, $from=null)
	{
		if(isset($where)){
			if(!is_array($where)){
				throw new excepcion_toba("El WHERE debe ser un array");
			}	
		}
		$this->log("Cargar de DB");
		$this->where = $where;
		$this->from = $from;
		//Obtengo los datos de la DB
		$this->datos = $this->cargar_db();
		//Controlo que no se haya excedido el tope de registros
		if( $this->tope_max_registros != 0){
			if( $this->tope_max_registros < count( $this->datos ) ){
				//Hay mas datos que los que permite el tope, todo mal
				$this->datos = null;
				$this->log("Se sobrepaso el tope maximo de registros en carga: " . count( $this->datos ) . " registros" );
				throw new excepcion_toba("Los registros cargados superan el TOPE MAXIMO de registros");
			}
		}
		//ei_arbol($this->datos);
		//Se solicita control de SINCRONIA a la DB?
		if($this->control_sincro_db){
			$this->datos_orig = $this->datos;
		}
		$this->generar_estructura_control_post_carga();
		//Le saco los caracteres de escape a los valores traidos de la DB
		for($a=0;$a<count($this->datos);$a++){
			foreach(array_keys($this->datos[$a]) as $columna){
				$this->datos[$a][$columna] = stripslashes($this->datos[$a][$columna]);
			}	
		}
		//Actualizo la posicion en que hay que incorporar al proximo registro
		$this->proximo_registro = count($this->datos);	
		//Controlo que no se haya excedido el tope de registros
		if( $this->tope_max_registros != 0){
			if( ( $this->get_cantidad_registros() > $this->proximo_registro) ){
				$this->log("Se sobrepaso el tope maximo de registros mientras se agregaba un registro" );
				throw new excepcion_toba("Los registros cargados superan el TOPE MAXIMO de registros");
			}
		}
		//Lleno las columnas basadas en valores EXTERNOS
		$this->actualizar_campos_externos();
	}

	private function cargar_db($carga_estricta=false)
	//Cargo los db_registrosS con datos de la DB
	//Los datos son 
	{
		$db = toba::get_fuente($this->fuente);
		$sql = $this->generar_sql_select();//echo $sql . "<br>";
		//-- Intento cargar el db_registros
		$rs = $db[apex_db_con]->Execute($sql);
		if(!is_object($rs)){
			toba::get_logger()->error("db_registros  " . get_class($this). " [{$this->identificador}] - Error cargando datos, no se genero un RECORDSET" .
									$sql . " - " . $db[apex_db_con]->ErrorMsg());
			throw new excepcion_toba("Error cargando datos en el db_registros. Verifique la definicion. $sql");
		}
		if($rs->EOF){
			if($carga_estricta){
				toba::get_logger()->error("db_registros  " . get_class($this). " [{$this->identificador}] - " .
								"No se recuperarron DATOS. Se solicito carga estricta");
			}
			return null;
		}else{
			$datos =& $rs->getArray();
			//ei_arbol($datos);
			//Los campos NO SQL deberian estar metidos en el array
			if(isset($this->campos_externa)){
				foreach($this->campos_externa as $externa){
					for($a=0;$a<count($datos);$a++){
						$datos[$a][$externa] = "";
					}
				}
			}
			return $datos; 
		}
	}

	private function controlar_conservacion_where($where)
	/*
		El uso de este metodo ya no tiene sentido
	*/
	{
		if(!isset($this->where)){
			if(isset($where)){
				$this->log("Control WHERE: No existe");
				return false;	
			}
		}else{
			for($a=0;$a<count($this->where);$a++){
				if(!isset($where[$a])){
					$this->log("Control WHERE: nuevo mas corto"); 
					return false;
				}else{
					if($where[$a] !== $this->where[$a]){
						$this->log("Control WHERE: nuevo distinto"); 
						return false;	
					}
				}
			}
		}
		$this->log("Control WHERE: OK!");
		return true;
	}

	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//------  SINCRONIZACION  -------------------------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------

	public function sincronizar($control_tope_minimo=true)
	//Sincroniza las modificaciones del db_registros con la DB
	{
		$this->log("Inicio SINCRONIZACION"); 
		if($control_tope_minimo){
			if( $this->tope_min_registros != 0){
				if( ( $this->get_cantidad_registros() < $this->tope_min_registros) ){
					$this->log("No se cumplio con el tope minimo de registros necesarios" );
					throw new excepcion_toba("Los registros cargados no cumplen con el TOPE MINIMO necesario");
				}
			}
		}
		$this->controlar_alteracion_db();
		// No puedo ejecutar los cambios en cualguier orden
		// Necesito ejecutar primero los deletes, por si el usuario borra algo y despues inserta algo igual
		$inserts = array(); $deletes = array();	$updates = array();
		foreach(array_keys($this->control) as $registro){
			switch($this->control[$registro]['estado']){
				case "d":
					$deletes[] = $registro;
					break;
				case "i":
					$inserts[] = $registro;
					break;
				case "u":
					$updates[] = $registro;
					break;
			}
		}
		try{
			if($this->utilizar_transaccion) abrir_transaccion();
			$this->evt__pre_sincronizacion();
			$modificaciones = 0;
			//-- DELETE --
			foreach($deletes as $registro){
				$this->evt__pre_delete($registro);
				$this->eliminar($registro);
				$this->evt__post_delete($registro);
				$modificaciones ++;
			}
			//-- INSERT --
			foreach($inserts as $registro){
				$this->evt__pre_insert($registro);
				$this->insertar($registro);
				$this->evt__post_insert($registro);
				$modificaciones ++;
			}
			//-- UPDATE --
			foreach($updates as $registro){
				$this->evt__pre_update($registro);
				$this->modificar($registro);
				$this->evt__post_update($registro);
				$modificaciones ++;
			}
			$this->evt__post_sincronizacion();
			if($this->utilizar_transaccion) cerrar_transaccion();
			//Actualizo la estructura interna que mantiene el estado de los registros
			$this->sincronizar_estructura_control();
			$this->log("Fin SINCRONIZACION: $modificaciones."); 
			return $modificaciones;
		}catch(excepcion_toba $e){
			if($this->utilizar_transaccion) abortar_transaccion();
			toba::get_logger()->debug($e);
			throw new excepcion_toba($e->getMessage());
		}
	}

	protected function insertar($id_registro)
	{
	}
	
	protected function modificar($id_registro)
	{
	}

	protected function eliminar($id_registro)
	{
	}

	//-------------------------------------------------------------------------------
	//------  EVENTOS de SINCRONIZACION  --------------------------------------------
	//-------------------------------------------------------------------------------
	/*
		Este es el lugar para meter validaciones, 
		si algo sale mal se deberia disparar una excepcion	
	*/

	protected function evt__pre_sincronizacion()
	{
	}
	
	protected function evt__post_sincronizacion()
	{
	}

	protected function evt__pre_insert($id)
	{
	}
	
	protected function evt__post_insert($id)
	{
	}
	
	protected function evt__pre_update($id)
	{
	}
	
	protected function evt__post_update($id)
	{
	}

	protected function evt__pre_delete($id)
	{
	}
	
	protected function evt__post_delete($id)
	{
	}

	//-------------------------------------------------------------------------------

	public function get_sql_inserts()
	{
		$sql = array();
		foreach(array_keys($this->control) as $registro){
			$sql[] = $this->generar_sql_insert($registro);
		}
		return $sql;
	}

	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------
	//------------  Control de SINCRONISMO  -----------------------------------------
	//-------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------

	public function controlar_alteracion_db()
	//Controla que los datos
	{
		/*
			Esto hay que pensarlo bien
		*/
	}

	private function controlar_alteracion_db_array()
	//Soporte al manejo transaccional OPTIMISTA
	//Indica si los datos iniciales extraidos de la base difieren de
	//los datos existentes en el momento de realizar la transaccion
	{
		$ok = true;
		$datos_actuales = $this->cargar_db();
		//Hay datos?
		if(is_array($datos_actuales)){
			//La cantidad de filas es la misma?
			if(count($datos_actuales) == count($this->datos_orig)){
				for($a=0;$a<count($this->datos_orig);$a++){
					//Existe la fila?
					if(isset($datos_actuales[$a])){
						foreach(array_keys($this->datos_orig[$a]) as $columna){
							//El valor de las columnas coincide?
							if($this->datos_orig[$a][$columna] !== $datos_actuales[$a][$columna]){
								$ok = false;
								break 2;
							}
						}
					}else{
						$ok = false;
						break 1;
					}
				}
			}else{
				$ok = false;
			}
		}else{
			$ok = false;
		}
		return $ok;
	}
	//-------------------------------------------------------------------------------

	private function controlar_alteracion_db_timestamp()
	//Esto tiene que basarse en una forma generica de trabajar sobre tablas
	//(Una columna que posea el timestamp, y triggers que los actualicen)
	{
	}

}
?>