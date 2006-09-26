<?php
require_once('objetos_toba/ci_editores_toba.php');
require_once('modelo/componentes/info_ci.php');
require_once('admin_util.php');

class ci_editor extends ci_editores_toba
{
	protected $s__seleccion_pantalla;
	protected $s__seleccion_pantalla_anterior;
	protected $s__pantalla_dep_asoc;
	protected $s__pantalla_evt_asoc;
	protected $cambio_objeto = false;		//Se esta editando un nuevo objeto?
	protected $id_intermedio_pantalla;
	protected $clase_actual = 'objeto_ci';
	protected $info_actual = 'info_ci';
	protected $s__pantalla_php_db;			// La base posee registro de la existencia de una extension??
	protected $s__pantalla_php_archivo;		// El archivo de la extension existe en el sistema de archivos??
	
	function ini()
	{
		parent::ini();
		$pantalla = toba::memoria()->get_parametro('pantalla');
		//---- �Se selecciono una pantalla desde afuera?
		if (isset($pantalla)) {
			$this->set_pantalla(2);
			//Se busca cual es el id interno del ML para enviarselo
			$datos = $this->conf__pantallas_lista($this->dep('pantallas_lista'));
			foreach ($datos as $id => $dato) {
				if ($dato['identificador'] == $pantalla) {
					$this->evt__pantallas_lista__seleccion($id);
				}
			}
		}
	}

	function conf()
	{
		parent::conf();
		//Mecanismo para saber si la extension PHP de un AP ya exite en la DB y posee archivo
		if ( !isset($this->s__pantalla_php_db) ) {
			$this->s__pantalla_php_db = array();
			$this->s__pantalla_php_archivo = array();
			if ( $this->componente_existe_en_db() ) {
				$datos_pantalla = $this->get_entidad()->tabla('pantallas')->get_filas();
				//ei_arbol($datos_pantalla);
				foreach ($datos_pantalla as $pantalla) {
					if (isset($pantalla['subclase']) && $pantalla['subclase'] &&  $pantalla['subclase_archivo']) {
						$this->s__pantalla_php_db[$pantalla['x_dbr_clave']] = $pantalla['identificador'];
						if( admin_util::existe_archivo_subclase($pantalla['subclase_archivo'])) {
							$this->s__pantalla_php_archivo[$pantalla['x_dbr_clave']] = true;
						}
					}
				}
			}
		}
	}

	function evt__procesar()
	{
		parent::evt__procesar();
		unset($this->s__pantalla_php_db);
		unset($this->s__pantalla_php_archivo);
	}
	
	// *******************************************************************
	// ******************* tab PROPIEDADES BASICAS  **********************
	// *********************************************

	function conf__prop_basicas($form)
	{
		$datos = $this->get_entidad()->tabla("prop_basicas")->get();
		$form->set_datos($datos);
	}

	function evt__prop_basicas__modificacion($datos)
	{
		$this->get_entidad()->tabla("prop_basicas")->set($datos);
	}

	// *******************************************************************
	// *******************  tab DEPENDENCIAS  ****************************
	// *******************************************************************
	/*
		Metodos necesarios para que el CI de eventos funcione
	*/
	function evt__1__salida()
	{
		$this->dep('dependencias')->limpiar_seleccion();
	}

	function get_dbr_dependencias()
	{
		return $this->get_entidad()->tabla('dependencias');
	}
	
	function eliminar_dependencia($id)
	{
		//El ci de dependencias avisa que se borro la dependencias $id
		$this->get_entidad()->tabla('pantallas')->eliminar_dependencia($id);
	}
	
	/**
	*	El ci de dependencias avisa que una dependencia cambio su identificacion
	*/
	function modificar_dependencia($anterior, $nuevo)
	{
		//Este cambio se le notifica a las pantallas
		$this->get_entidad()->tabla('pantallas')->cambiar_id_dependencia($anterior, $nuevo);
	}	
	
	// *******************************************************************
	// ******************* tab PANTALLAS  ********************************
	// *******************************************************************

	function existen_deps()
	{
		return count($this->s__pantalla_dep_asoc) > 0;
	}
	
	function existen_evts()
	{
		return count($this->s__pantalla_evt_asoc) > 0;
	}
	
	function hay_pant_sel()
	{
		return isset($this->s__seleccion_pantalla);
	}
	
	function get_datos_pantalla_actual()
	{
		return $this->get_entidad()->tabla('pantallas')->get_fila($this->s__seleccion_pantalla);
	}
	
	function conf__2($pantalla)
	{
		//--- Armo la lista de DEPENDENCIAS disponibles
		$this->s__pantalla_dep_asoc = array();
		if($registros = $this->get_entidad()->tabla('dependencias')->get_filas())
		{
			foreach($registros as $reg){
				$this->s__pantalla_dep_asoc[ $reg['identificador'] ] = $reg['identificador'];
			}
		}
		//--- Armo la lista de EVENTOS disponibles
		$this->s__pantalla_evt_asoc = array();
		if($registros = $this->get_entidad()->tabla('eventos')->get_filas())
		{
			foreach($registros as $reg){
				$this->s__pantalla_evt_asoc[ $reg['identificador'] ] = $reg['identificador'];
			}
		}		

		//--- Se selecciono una pantalla?
		if ($this->hay_pant_sel()) {
			$this->dependencia('pantallas_lista')->seleccionar($this->s__seleccion_pantalla);
			if( empty($this->s__pantalla_dep_asoc) ) {
				$pantalla->eliminar_dep('pantallas_ei');
			}
			if( empty($this->s__pantalla_evt_asoc) ){
				$pantalla->eliminar_dep('pantallas_evt');			
			}			
		} else {
			$pantalla->eliminar_dep('pantallas_ei');
			$pantalla->eliminar_dep('pantallas_evt');
			$pantalla->eliminar_dep('pantallas');
		}
	}
	
	function evt__2__salida()
	{
		unset($this->s__seleccion_pantalla_anterior);
		unset($this->s__seleccion_pantalla);
	}

	function evt__cancelar_pantalla()
	{
		unset($this->s__seleccion_pantalla_anterior);
		unset($this->s__seleccion_pantalla);
	}

	function evt__aceptar_pantalla()
	{
		unset($this->s__seleccion_pantalla_anterior);
		unset($this->s__seleccion_pantalla);
	}

	//----------------------------------------------------------
	//-- Lista -------------------------------------------------
	//----------------------------------------------------------
	
	function evt__pantallas_lista__modificacion($registros)
	{
		/*
			Como en el mismo request es posible dar una columna de alta y seleccionarla,
			tengo que guardar el ID intermedio que el ML asigna en las columnas NUEVAS,
			porque ese es el que se pasa como parametro en la seleccion
		*/
		$dbr = $this->get_entidad()->tabla("pantallas");
		$orden = 1;
		foreach(array_keys($registros) as $id) {
			//Creo el campo orden basado en el orden real de las filas
			//ATENCION:  Ya esta soportado en el ML
			$registros[$id]['orden'] = $orden;
			$orden++;
			$accion = $registros[$id][apex_ei_analisis_fila];
			unset($registros[$id][apex_ei_analisis_fila]);
			switch($accion){
				case "A":
					$this->id_intermedio_pantalla[$id] = $dbr->nueva_fila($registros[$id], null, $id);
					break;	
				case "B":
					$dbr->eliminar_fila($id);
					break;	
				case "M":
					$dbr->modificar_fila( $id, $registros[$id]);
					break;	
			}
		}		
	}
	
	function evt__pantallas_lista__seleccion($id)
	{
		if(isset($this->id_intermedio_pantalla[$id])){
			$id = $this->id_intermedio_pantalla[$id];
		}
		$this->s__seleccion_pantalla = $id;
	}
	
	/**
	 * @todo Cuando el ML tenga un api para setear prox. fila, cambiar este metodo
	 */
	function conf__pantallas_lista($ml)
	{
		$datos_dbr = $this->get_entidad()->tabla('pantallas')->get_filas();
		if (!empty($datos_dbr)) {
			//Ordeno los registros segun la 'posicion'
			//ei_arbol($datos_dbr,"Datos para el ML: PRE proceso");
			for($a=0;$a<count($datos_dbr);$a++){
				$orden[] = $datos_dbr[$a]['orden'];
			}
			array_multisort($orden, SORT_ASC , $datos_dbr);
			//EL formulario_ml necesita necesita que el ID sea la clave del array
			// No se solicita asi del DBR porque array_multisort no conserva claves numericas
			// y las claves internas del DBR lo son
			for($a=0;$a<count($datos_dbr);$a++){
				$id_dbr = $datos_dbr[$a][apex_db_registros_clave];
				unset( $datos_dbr[$a][apex_db_registros_clave] );
				$datos[ $id_dbr ] = $datos_dbr[$a];
			}
			//ei_arbol($datos,"Datos para el ML: POST proceso");
		} else {
			//--Carga inicial
			$datos = array(array(
							'identificador' => 'pant_inicial', 
							'etiqueta' => 'Pantalla Inicial',
							apex_ei_analisis_fila => 'A'
					));
		}
		$ml->set_datos($datos);		
		
		//--- Se setea al ml el proximo ID
		$ml->set_proximo_id( $this->get_entidad()->tabla("pantallas")->get_proximo_id() );
	
		//--Protejo la evento seleccionada de la eliminacion		
		if( $this->hay_pant_sel() ) {
			$this->dependencia("pantallas_lista")->set_fila_protegida( $this->s__seleccion_pantalla );
		}
		return $datos;
	}
	
	//------------------------------------------------------
	//-- Informacion extendida de la pantalla  -------------
	//------------------------------------------------------

	function evt__pantallas__modificacion($datos)
	{
		$this->get_entidad()->tabla('pantallas')->modificar_fila($this->s__seleccion_pantalla_anterior, $datos);
	}
	
	function conf__pantallas($obj)
	{
		$this->s__seleccion_pantalla_anterior = $this->s__seleccion_pantalla;
		//Manejo de la apertura del editor
		if (!isset($this->s__pantalla_php_db[$this->s__seleccion_pantalla_anterior])) {
			$obj->eliminar_evento('ver_php');
			$obj->eliminar_evento('abrir_php');
		} else {
			// Link al editor
			$parametros = info_componente::get_utileria_editor_parametros(array('proyecto'=>$this->id_objeto['proyecto'],
																				'componente'=> $this->id_objeto['objeto']),
																			$this->s__pantalla_php_db[$this->s__seleccion_pantalla_anterior]);
			$obj->evento('ver_php')->vinculo()->set_parametros($parametros);
			if (isset($this->s__pantalla_php_archivo[$this->s__seleccion_pantalla_anterior])) {
				// Apertura de archivos
				$abrir = info_componente::get_utileria_editor_abrir_php(array('proyecto'=>$this->id_objeto['proyecto'],
																				'componente'=> $this->id_objeto['objeto']),
																			$this->s__pantalla_php_db[$this->s__seleccion_pantalla_anterior]);
				$obj->set_js_abrir($abrir['js']);
			} else {
				$obj->eliminar_evento('abrir_php');
			}
		}
		$obj->set_datos($this->get_entidad()->tabla('pantallas')->get_fila($this->s__seleccion_pantalla_anterior));
	}

	//------------------------------------------------------
	//--- Asociacion de DEPENDENCIAS a pantallas  ----------
	//------------------------------------------------------

	function conf__pantallas_ei()
	{
		if( $deps = $this->get_entidad()->tabla('pantallas')->get_dependencias_pantalla($this->s__seleccion_pantalla_anterior) )
		{
			$a=0;
			$datos = null;
			foreach($deps as $dep){
				if(in_array($dep, $this->s__pantalla_dep_asoc)){
					$datos[$a]['dependencia'] = $dep;
					$a++;	
				}
			}
			return $datos;
		}
		//return array();
	}

	function evt__pantallas_ei__modificacion($datos)
	{
		$deps = array();
		foreach($datos as $dato){
			$deps[] = $dato['dependencia'];
		}
		$this->get_entidad()->tabla('pantallas')->set_dependencias_pantalla($this->s__seleccion_pantalla_anterior, $deps);
	}

	function combo_dependencias()
	{
		$datos = null;
		$a=0;
		foreach( $this->s__pantalla_dep_asoc as $dep => $info){
			$datos[$a]['id'] = $dep; 
			$datos[$a]['desc'] = $info; 
			$a++;
		}
		return $datos;
	}

	//------------------------------------------------------
	//--- Asociacion de EVENTOS a pantallas  ---------------
	//------------------------------------------------------

	function conf__pantallas_evt()
	{
		$eventos_asociados = $this->get_entidad()->tabla('pantallas')->get_eventos_pantalla($this->s__seleccion_pantalla_anterior);
		$datos = null;
		$a=0;
		foreach( $this->s__pantalla_evt_asoc as $dep){
			$datos[$a]['evento'] = $dep; 
			if(is_array($eventos_asociados)){
				if(in_array($dep, $eventos_asociados)){
					$datos[$a]['asociar'] = 1;
				}else{
					$datos[$a]['asociar'] = 0;
				}
			}else{
				$datos[$a]['asociar'] = 0;
			}
			$a++;
		}
		return $datos;
	}

	function evt__pantallas_evt__modificacion($datos)
	{
		$eventos = array();
		foreach($datos as $dato){
			if($dato['asociar'] == "1")	$eventos[] = $dato['evento'];
		}
		$this->get_entidad()->tabla('pantallas')->set_eventos_pantalla($this->s__seleccion_pantalla_anterior, $eventos);
	}
	
	// *******************************************************************
	// *******************  tab EVENTOS  *********************************
	// *******************************************************************
	/*
		Metodos necesarios para que el CI de eventos funcione
	*/

	function evt__3__salida()
	{
		$this->dependencia('eventos')->limpiar_seleccion();
	}

	function get_dbr_eventos()
	{
		return $this->get_entidad()->tabla('eventos');
	}
	
	function get_eventos_estandar($modelo)
	{
		return info_ci::get_lista_eventos_estandar($modelo);
	}

	function eliminar_evento($id)
	{
		//El ci de EVENTOS avisa que se borro el evento $id
		$this->get_entidad()->tabla('pantallas')->eliminar_evento($id);
	}
	
	/**
	*	Se modifica el identificador de un evento, esto afecta a todas las pantallas en la que esta inclu�do
	*/
	function modificar_evento($id_anterior, $id_nuevo)
	{
		$this->get_entidad()->tabla('pantallas')->cambiar_id_evento($id_anterior, $id_nuevo);
	}

	/**
	 * Se actualiza la aparicion de un evento en las pantallas dadas
	 *
	 * @param array $pant_presentes Pantallas en las que el evento aparece (si es null se asumen todas)
	 * @param string $evento Identificador del evento (ej: procesar)
	 */
	function set_pantallas_evento($pant_presentes, $evento)
	{
		$this->get_entidad()->tabla('pantallas')->set_pantallas_evento($pant_presentes, $evento);
	}
	
	/**
	 * Retorna las pantallas en las que esta incluido el evento
	 */
	function get_pantallas_evento($evento)
	{
		return $this->get_entidad()->tabla('pantallas')->get_pantallas_evento($evento);
	}
	
	function get_pantallas_posibles()
	{
		$pantallas = $this->get_entidad()->tabla('pantallas')->get_filas();
		//Se contruye un nombre mas completo
		foreach (array_keys($pantallas) as $pant) {
			$pantallas[$pant]['nombre'] = '('.$pantallas[$pant]['identificador'].') '.
											$pantallas[$pant]['etiqueta'];
		}
		return $pantallas;
	}
}
?>