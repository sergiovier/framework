<?php

class toba_mc_comp__1449
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1449,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_ci',
    'subclase' => 'ci_principal',
    'subclase_archivo' => 'objetos_toba/ei_archivos/ci_principal.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'Editor OBJETO - ei_archivos',
    'titulo' => NULL,
    'colapsable' => NULL,
    'descripcion' => NULL,
    'fuente_proyecto' => NULL,
    'fuente' => NULL,
    'solicitud_registrar' => NULL,
    'solicitud_obj_obs_tipo' => NULL,
    'solicitud_obj_observacion' => NULL,
    'parametro_a' => NULL,
    'parametro_b' => NULL,
    'parametro_c' => NULL,
    'parametro_d' => NULL,
    'parametro_e' => NULL,
    'parametro_f' => NULL,
    'usuario' => NULL,
    'creacion' => '2005-08-19 16:16:16',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ci',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ci.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ci',
    'clase_icono' => 'objetos/multi_etapa.gif',
    'clase_descripcion_corta' => 'ci',
    'clase_instanciador_proyecto' => 'toba_editor',
    'clase_instanciador_item' => '1642',
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '2',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'eliminar',
      'etiqueta' => '&Eliminar',
      'maneja_datos' => 0,
      'sobre_fila' => 0,
      'confirmacion' => 'Este comando ELIMINARA el COMPONENTE y sus asociaciones con otros elementos del sistema. �Desea continuar?',
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'borrar.gif',
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
      'grupo' => NULL,
      'accion' => NULL,
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => NULL,
      'accion_vinculo_item' => NULL,
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => NULL,
      'accion_vinculo_popup_param' => NULL,
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'procesar',
      'etiqueta' => '&Guardar',
      'maneja_datos' => 1,
      'sobre_fila' => 0,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'guardar.gif',
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => 1,
      'grupo' => NULL,
      'accion' => NULL,
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => NULL,
      'accion_vinculo_item' => NULL,
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => NULL,
      'accion_vinculo_popup_param' => NULL,
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
  ),
  '_info_puntos_control' => 
  array (
  ),
  '_info_ci' => 
  array (
    'ev_procesar_etiq' => NULL,
    'ev_cancelar_etiq' => NULL,
    'objetos' => NULL,
    'ancho' => '600',
    'alto' => '400',
    'posicion_botonera' => 'ambos',
    'tipo_navegacion' => 'tab_h',
    'con_toc' => NULL,
  ),
  '_info_ci_me_pantalla' => 
  array (
    0 => 
    array (
      'pantalla' => 457,
      'identificador' => '0',
      'etiqueta' => 'Propiedades B�sicas',
      'descripcion' => NULL,
      'tip' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'objetos/archivos.gif',
      'objetos' => 'base',
      'eventos' => 'procesar,eliminar',
      'orden' => 1,
      'subclase' => NULL,
      'subclase_archivo' => NULL,
    ),
  ),
  '_info_dependencias' => 
  array (
    0 => 
    array (
      'identificador' => 'base',
      'proyecto' => 'toba_editor',
      'objeto' => 1355,
      'clase' => 'objeto_ei_formulario',
      'clase_archivo' => 'nucleo/componentes/interface/toba_ei_formulario.php',
      'subclase' => 'eiform_prop_base',
      'subclase_archivo' => 'objetos_toba/eiform_prop_base.php',
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'datos',
      'proyecto' => 'toba_editor',
      'objeto' => 1538,
      'clase' => 'objeto_datos_relacion',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_relacion.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
  ),
);
	}

}

?>