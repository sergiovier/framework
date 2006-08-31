<?php
require_once('nucleo/componentes/interface/objeto_ci.php'); 
require_once('modelo/consultas/dao_editores.php');
require_once('objetos_toba/asignador_objetos.php');
require_once('admin_util.php');
//----------------------------------------------------------------
class ci_clonador_objetos extends objeto_ci
{
	protected $id_objeto;
	protected $destino;
	protected $nuevo_nombre;
	
	function ini()
	{
		if (! toba::get_zona()->cargada()) {
			throw new toba_excepcion('La operación se debe invocar desde la zona de un item');
		}
	}	
	
	function mantener_estado_sesion()
	{
		$propiedades = parent::mantener_estado_sesion();
		$propiedades[] = "id_objeto";
		$propiedades[] = "datos";
		return $propiedades;
	}		
	
	/********************************
	*			DAOS
	*********************************/
	
	static function get_tipos_destino()
	{
		$destinos = array(
						array(
							'proyecto' => editor::get_proyecto_cargado(),
							'clase' => 'item'
						)
					);
		$destinos = array_merge($destinos, dao_editores::get_clases_contenedoras());
		//Agregar el item
		return $destinos;
	}

	static function get_objetos_destino($clase=null)
	{
		if (isset($clase)) {
			switch ($clase) {
				case 'item':
					return dao_editores::get_lista_items();
					break;
				default:
					$tipo = "componente,".$clase;
					return dao_editores::get_lista_objetos_toba($tipo);
			}
		}
	}
	
	
	/********************************
	*			EVENTOS
	*********************************/
	
	function conf__destino()
	{
		if (! isset($this->datos)) {
			$this->datos = array();
			$this->datos['proyecto'] = editor::get_proyecto_cargado();	
		}
		return $this->datos;
	}
	
	function evt__destino__modificacion($datos)
	{
		$this->datos = $datos;
		if ($datos['con_destino']) {
			if (isset($datos['tipo']) && isset($datos['objeto'])) {
				$this->destino = $datos;
				//Validaciones 
				if ($this->destino['tipo'] == 'objeto_ci' || $this->destino['tipo'] == 'objeto_ci') {
					if (!isset($this->destino['id_dependencia'])) {
						throw new toba_excepcion("El identificador es obligatorio");
					}
				}				
				//Se convierten los tipos a los que entiende el asignador
				$tipo = null;
				switch ($this->destino['tipo']) {
					case 'objeto_ci':
						if (isset($this->destino['pantalla'])) {
							$tipo = 'ci_pantalla';
						} else {
							$tipo = 'ci';
						}
						break;
					case 'objeto_datos_relacion':
						$tipo = 'datos_relacion';
						break;
					default:
						$tipo = $this->destino['tipo'];
				}
				$this->destino['tipo'] = $tipo;
				$this->destino['proyecto'] = editor::get_proyecto_cargado();
			}
		}
	}
	
	function evt__procesar()
	{
		abrir_transaccion("instancia");
		$directorio = false;
		if ($this->datos['con_subclases']) {
			$directorio = $this->datos['carpeta_subclases'];
		}
		list($proyecto_actual, $comp_actual) = toba::get_zona()->get_editable();
		$id = array('proyecto' => $proyecto_actual, 'componente' => $comp_actual);
		$info = constructor_toba::get_info($id, null, $this->datos['profundidad']);
		$nuevos_datos = array('anexo_nombre' => $this->datos['anexo_nombre']);
		$clon = $info->clonar($nuevos_datos, $directorio, false);
		
		//--- Asignación
		if (isset($this->destino)) {
			$asignador = new asignador_objetos($clon, $this->destino);
			$asignador->asignar();
		}
		cerrar_transaccion("instancia");
		admin_util::redireccionar_a_editor_objeto($clon['proyecto'], $clon['objeto']);
	}
}

?>