<?php
require_once('db/dao_editores.php');
require_once('objetos_toba/asignador_objetos.php');
require_once('admin_util.php');
//----------------------------------------------------------------
class ci_creador_objeto extends objeto_ci
{
	protected $clase_actual;
	protected $datos_editor;
	protected $destino;
	protected $objeto_construido;
	
	function __construct($id)
	{
		parent::__construct($id);
		if (! dba::hay_fuente_definida(editor::get_proyecto_cargado())) {
			throw new excepcion_toba("El proyecto actual no tiene definida una fuente de datos propia. Chequear en las propiedades del proyecto.");
		}		
		
		if (isset($this->clase_actual)) {
			$this->cargar_editor();
		}
		$hilo = toba::get_hilo();
		$destino_tipo = $hilo->obtener_parametro('destino_tipo');
		if (isset($destino_tipo)) {
			$this->destino = array();
			$this->destino['tipo'] = $destino_tipo;
			$this->destino['objeto'] = $hilo->obtener_parametro('destino_id');
			$this->destino['proyecto'] = $hilo->obtener_parametro('destino_proyecto');
			$this->destino['pantalla'] = $hilo->obtener_parametro('destino_pantalla');
		}
	}
	
	function mantener_estado_sesion()
	{
		$prop = parent::mantener_estado_sesion();
		$prop[] = 'clase_actual';
		$prop[] = 'datos_editor';
		$prop[] = 'destino';
		$prop[] = 'objeto_construido';
		return $prop;
	}
	
	
	/**
	*	Cuando se selecciona una clase se construye el objeto
	*/
	function get_etapa_actual()
	{
		if (! isset($this->clase_actual)) {
			return "tipos";
		} 
		if (! isset($this->objeto_construido)) {
			return "construccion";
		}
		//Sino es que el objeto se creo y no hay que asignarselo a nadie asi que 
		//hay que redireccionar
		$this->redireccionar_a_objeto_creado();
	}	
	
	function get_lista_ei__tipos()
	{
		$eis = array();
		if (isset($this->destino)) {
			if ($this->destino['tipo'] == 'datos_relacion') {
				$eis[] = 'info_asignacion_dr';
			} elseif ($this->destino['tipo'] == 'ci' ||
						$this->destino['tipo'] == 'ci_pantalla') { 
				$eis[] = 'info_asignacion';
			}
		}
		$eis[] = 'tipos';		
		return $eis;
	}
	
	function obtener_descripcion_pantalla($pantalla)
	{
		switch ($pantalla) {
			case 'tipos':
				$des = "<strong>Tipo de objeto</strong><br>Seleccione el tipo de [wiki:Referencia/Objetos objeto] a crear.";
				switch ($this->destino['tipo']) {
					case 'item': 
						$des .= "<br>El objeto construido se asignará automáticamente al 
								<strong>item</strong> seleccionado.";
						break;
					case 'ci':
						$des .= "<br>El objeto construido se asignará automáticamente al 
								<strong>CI</strong> seleccionado,<br> con el rol ingresado.";
						break;		
					case 'ci_pantalla':
						$des .= "<br>El objeto construido se asignará automáticamente a la 
								<strong>pantalla</strong> seleccionada,<br> con el rol ingresado.";
						break;		
					case 'datos_relacion':
						$des .= "<br>El datos_tabla construido se asignará automáticamente al
								<strong>datos_relacion</strong> seleccionado,<br> con el rol ingresado.";								
				}
				break;
			case 'construccion':
				$clase_reducida = substr($this->clase_actual['clase'], 7);
				$des = "<strong>Construcción</strong><br>
						Construyendo un [wiki:Referencia/Objetos/$clase_reducida {$this->clase_actual['clase']}]";
				break;			
			case 'asignacion':
				$des = "<strong>Asignación</strong><br>Para poder asignarlo necesita indicar con que identificador se conocera el objeto en el CI.";
				break;
			case 'asignacion_dr':
				$des = "<strong>Asignación a un datos_relacion</strong><br>Ingrese los datos de la tabla en la relación.";
				break;
			default:
				$des = parent::obtener_descripcion_pantalla($pantalla);
		}
		return $des;
	}
	
	//------------------------------------------------------------
	//-----------------  TIPOS DE OBJETOS   ----------------------
	//------------------------------------------------------------
	
	function evt__tipos__carga()
	{
		return dao_editores::get_clases_editores($this->destino['tipo']);
	}
	
	function evt__tipos__seleccionar($clase)
	{
		$this->clase_actual = $clase;
		$this->cargar_editor();
	}	

	function evt__info_asignacion__modificacion($datos)
	{
		$this->destino += $datos;
	}
	
	function evt__info_asignacion__carga()
	{
		if (isset($this->destino)) {
			return $this->destino;
		}
	}
	
	/**
	*	Parametros para asignar el objeto a un datos_relacion
	*/
	function evt__info_asignacion_dr__modificacion($datos)
	{
		$this->destino += $datos;
	}
	
	function evt__info_asignacion_dr__carga()
	{
		if (isset($this->destino)) {
			return $this->destino;
		}
	}

	//------------------------------------------------------------
	//-----------------  ETAPA DE CONSTRUCCION   ----------------------
	//------------------------------------------------------------
	function evt__volver()
	{
		unset($this->clase_actual);
		unset($this->datos_editor);
	}
	
	/**
	*	Durante la construcción mostrar el editor
	*/	
	function get_lista_ei__construccion()
	{
		return array("editor");
	}
	
		
	function cargar_editor()
	{
		if (!isset($this->datos_editor)) {
			$this->datos_editor = dao_editores::get_ci_editor_clase($this->clase_actual['proyecto'], $this->clase_actual['clase']);
		}
		$this->agregar_dependencia('editor', $this->datos_editor['proyecto'], $this->datos_editor['objeto']);
	}
	
	function get_nombre_destino()
	{
		$clave = array('componente' => $this->destino['objeto'],
						'proyecto' => $this->destino['proyecto']);
		$nombre = "";
		if (isset($this->destino)) {
			switch ($this->destino['tipo']) {
				case 'item': 
				case 'ci':
				case 'datos_relacion':
					$info = constructor_toba::get_info($clave, $this->destino['tipo'], false);								
					$nombre .= $info->get_nombre_corto();
					break;
				case 'ci_pantalla':
					//--- Si es una pantalla el info_ci se carga en profunidad para traer el nombre de la misma
					$info = constructor_toba::get_info($clave, 'ci', true);			
					$pantalla = $info->get_pantalla($this->destino['pantalla']);
					$nombre .= $info->get_nombre_corto() .' - '.$pantalla->get_id();
					break;
			}	
		}	
		return $nombre;
	}
	
	function hay_destino()
	{
		return isset($this->destino['tipo']);	
	}
	
	function destino_es_item()
	{
		return $this->destino['tipo'] == 'item';	
	}
	
	function get_nombre_rol()
	{
		if (isset($this->destino['id_dependencia'])) {
			return $this->destino['id_dependencia'];
		}	
	}
	
	/**
	*	Cuando se procesa este CI es porque el editor contenido ya proceso
	*	Por lo que se debe extraer la clave del objeto creado para su posterior asignacion
	*/
	function evt__editor__procesar()
	{
		$this->objeto_construido = $this->dependencia('editor')->get_entidad()->tabla('base')->get_clave_valor(0);
		
		//---Asigna el objeto creado al destino
		if (isset($this->destino)) {
			$asignador = new asignador_objetos($this->objeto_construido, $this->destino);
			$asignador->asignar();
			$this->redireccionar_a_objeto_creado();
		}
	}
		
	function redireccionar_a_objeto_creado()
	{
		admin_util::redireccionar_a_editor_objeto($this->objeto_construido['proyecto'], 
													$this->objeto_construido['objeto']);
	}
	
}

?>