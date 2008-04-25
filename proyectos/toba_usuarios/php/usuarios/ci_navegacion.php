<?php

class ci_navegacion extends toba_ci
{
	protected $s__filtro;
	const umbral_registros_filtro_obligatorio = 50;

	//-------------------------------------------------------------------
	//--- Eventos GLOBALES
	//-------------------------------------------------------------------
	
	function ini__operacion()
	{
		if ( toba::sesion()->proyecto_esta_predefinido() ) {
			$this->s__filtro['asociados'] = 1;
		}
	}
	
	function evt__guardar()
	{
		$this->dep('datos')->sincronizar();
		$this->dep('datos')->resetear();
		$this->set_pantalla('seleccionar');
	}

	function evt__cancelar()
	{
		$this->dep('datos')->resetear();
		$this->set_pantalla('seleccionar');
	}

	function evt__agregar()
	{
		$this->dep('editor')->limpiar_datos();
		$this->set_pantalla('editar');
	}
	
	function evt__eliminar()
	{
		$this->dep('datos')->eliminar();
		$this->dep('datos')->resetear();
		$this->set_pantalla('seleccionar');
	}
	
	function conf__seleccionar()
	{
		if ( toba::sesion()->proyecto_esta_predefinido() ) {
			$proyecto = toba::sesion()->get_id_proyecto();
			$desc = "Editor de usuarios para el proyecto: <strong>$proyecto</strong>";
			$this->dep('filtro')->desactivar_efs(array('pertenencia','proyecto'));
		}else{
			$desc = 'Editor de usuarios <strong>Multiproyecto</strong>';
			$this->dep('filtro')->desactivar_efs(array('asociados'));
		}
		$this->pantalla()->set_descripcion($desc);
	}

	//---- filtro -------------------------------------------------------

	function evt__filtro__filtrar($datos)
	{
		$this->s__filtro = $datos;
	}

	function evt__filtro__cancelar()
	{
		unset($this->s__filtro);
	}

	function conf__filtro($componente)
	{
		if(isset($this->s__filtro)) {
			$componente->set_datos($this->s__filtro);
		}
	}
	
	//---- cuadro -------------------------------------------------------

	function conf_evt__cuadro__eliminar(toba_evento_usuario $evt)
	{
		$usuario = $evt->get_parametros();
		if ($usuario == toba::usuario()->get_id()) {
			$evt->anular();	
		}
	}
	
	function conf__editar()
	{
		if( toba::sesion()->proyecto_esta_predefinido() ) {
			$this->pantalla('editar')->eliminar_dep('editor');
		}else{
			$this->pantalla('editar')->eliminar_dep('editor_simple');
		}
	}

	function conf__cuadro($componente)
	{
		if (isset($this->s__filtro)) {
			if ( toba::sesion()->proyecto_esta_predefinido() ) {
				$proyecto = toba::sesion()->get_id_proyecto();
				if ($this->s__filtro['asociados']) {
					$datos = consultas_instancia::get_usuarios_vinculados_proyecto($proyecto, $this->s__filtro);
				}else{
					$datos = consultas_instancia::get_usuarios_no_vinculados_proyecto($proyecto, $this->s__filtro);
				}				
			}else{
				$proyecto = $this->s__filtro['proyecto'];
				switch ($this->s__filtro['pertenencia']){
					case 'P' : 
						$datos = consultas_instancia::get_usuarios_vinculados_proyecto($proyecto, $this->s__filtro);
					break;
					case 'N' : 
						$datos = consultas_instancia::get_usuarios_no_vinculados_proyecto($proyecto, $this->s__filtro);
					break;
					case 'T':
						$datos = consultas_instancia::get_lista_usuarios($this->s__filtro);
					break;
					case 'S' :
						$datos = consultas_instancia::get_usuarios_no_vinculados_proyecto(null, $this->s__filtro);
					break;
				}
			}
			$componente->set_datos($datos);
		}
	}
	
	function evt__cuadro__seleccion($id)
	{
		$this->dep('editor')->limpiar_datos();
		$this->dep('datos')->cargar($id);
		$this->set_pantalla('editar');
	}

	function evt__cuadro__eliminar($id)
	{
		$this->dep('datos')->cargar($id);
		$this->evt__eliminar();	
	}
}
?>