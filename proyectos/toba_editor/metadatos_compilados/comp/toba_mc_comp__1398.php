<?php

class toba_mc_comp__1398
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1398,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_ei_formulario_ml',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'OBJETO - DBR - Columnas',
    'titulo' => NULL,
    'colapsable' => NULL,
    'descripcion' => NULL,
    'fuente_proyecto' => 'toba_editor',
    'fuente' => 'instancia',
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
    'creacion' => '2005-07-26 23:58:37',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ei_formulario_ml',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ei_formulario_ml.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ei_formulario_ml',
    'clase_icono' => 'objetos/ut_formulario_ml.gif',
    'clase_descripcion_corta' => 'ei_formulario_ml',
    'clase_instanciador_proyecto' => 'toba_editor',
    'clase_instanciador_item' => '1842',
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '0',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'modificacion',
      'etiqueta' => 'Modificacion',
      'maneja_datos' => 1,
      'sobre_fila' => 0,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => NULL,
      'imagen' => NULL,
      'en_botonera' => 0,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => 1,
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
      'identificador' => 'leer_db',
      'etiqueta' => 'Leer Metadatos DB',
      'maneja_datos' => 1,
      'sobre_fila' => 0,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'fuente.gif',
      'en_botonera' => 1,
      'ayuda' => 'Construye autom�ticamente los nombres y propiedades de las columnas en base a los metadatos disponibles de la tabla en la base de datos.',
      'ci_predep' => NULL,
      'implicito' => 0,
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
  ),
  '_info_puntos_control' => 
  array (
  ),
  '_info_formulario' => 
  array (
    'auto_reset' => NULL,
    'scroll' => NULL,
    'ancho' => NULL,
    'alto' => NULL,
    'filas' => NULL,
    'filas_agregar' => 1,
    'filas_agregar_online' => 1,
    'filas_ordenar' => NULL,
    'filas_numerar' => NULL,
    'columna_orden' => NULL,
    'analisis_cambios' => 'LINEA',
  ),
  '_info_formulario_ef' => 
  array (
    0 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1264,
      'identificador' => 'columna',
      'elemento_formulario' => 'ef_editable',
      'columnas' => 'columna',
      'obligatorio' => 1,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '1',
      'etiqueta' => 'Columna',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => 25,
      'edit_maximo' => 120,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    1 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1270,
      'identificador' => 'tipo',
      'elemento_formulario' => 'ef_combo',
      'columnas' => 'tipo',
      'obligatorio' => 1,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '2',
      'etiqueta' => 'Tipo',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => 'SELECT tipo, descripcion
FROM apex_tipo_datos',
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => 'Indefinido',
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    2 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1265,
      'identificador' => 'largo',
      'elemento_formulario' => 'ef_editable_numero',
      'columnas' => 'largo',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '3',
      'etiqueta' => 'Max.',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => 10,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    3 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1268,
      'identificador' => 'pk',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'pk',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '4',
      'etiqueta' => 'PK',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => '1',
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    4 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1269,
      'identificador' => 'secuencia',
      'elemento_formulario' => 'ef_editable',
      'columnas' => 'secuencia',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '5',
      'etiqueta' => 'Secuencia',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => 15,
      'edit_maximo' => 120,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    5 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1267,
      'identificador' => 'no_nulo_db',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'no_nulo_db',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '7',
      'etiqueta' => 'NOT NULL',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => 4,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => '1',
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => 4,
    ),
    6 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1398,
      'objeto_ei_formulario_fila' => 1532,
      'identificador' => 'externa',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'externa',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => NULL,
      'orden' => '8',
      'etiqueta' => 'Ext.',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Una [wiki:Referencia/Objetos/datos_tabla#ColumnasExternas columna externa] es una que participa de la tabla por razones cosm�ticas, generalmente la tabla ya tiene un ID (casi siempre una FK a otra tabla) pero tambi�n necesita el campo legible que representa ese ID, que por normalizaci�n no est� inclu�do en la tabla.',
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => 0,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => '1',
      'check_valor_no' => '0',
      'check_desc_si' => 'S�',
      'check_desc_no' => 'No',
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => NULL,
    ),
  ),
);
	}

}

?>