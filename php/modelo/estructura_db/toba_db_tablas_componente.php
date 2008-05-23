<?php

class toba_db_tablas_componente
{
	static function get_lista()
	{
		return array (
  0 => 'apex_item',
  1 => 'apex_item_info',
  2 => 'apex_objeto',
  3 => 'apex_objeto_info',
  4 => 'apex_objeto_dependencias',
  5 => 'apex_objeto_eventos',
  6 => 'apex_ptos_control_x_evento',
  7 => 'apex_item_objeto',
  8 => 'apex_objeto_mt_me',
  9 => 'apex_objeto_ci_pantalla',
  10 => 'apex_objeto_cuadro',
  11 => 'apex_objeto_cuadro_cc',
  12 => 'apex_objeto_ei_cuadro_columna',
  13 => 'apex_objeto_ut_formulario',
  14 => 'apex_objeto_ei_formulario_ef',
  15 => 'apex_objeto_esquema',
  16 => 'apex_objeto_ei_filtro_ml',
  17 => 'apex_objeto_ei_filtro_ml_col',
  18 => 'apex_objeto_db_registros',
  19 => 'apex_objeto_db_registros_col',
  20 => 'apex_objeto_db_registros_ext',
  21 => 'apex_objeto_db_registros_ext_col',
  22 => 'apex_objeto_db_registros_uniq',
  23 => 'apex_objeto_datos_rel',
  24 => 'apex_objeto_datos_rel_asoc',
  25 => 'apex_molde_operacion',
  26 => 'apex_molde_operacion_log',
  27 => 'apex_molde_operacion_log_elementos',
  28 => 'apex_molde_operacion_abms',
  29 => 'apex_molde_operacion_abms_fila',
);
	}

	static function apex_item()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'item',
  'dump_order_by' => 'item',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'item_id',
    1 => 'proyecto',
    2 => 'item',
    3 => 'padre_id',
    4 => 'padre_proyecto',
    5 => 'padre',
    6 => 'carpeta',
    7 => 'nivel_acceso',
    8 => 'solicitud_tipo',
    9 => 'pagina_tipo_proyecto',
    10 => 'pagina_tipo',
    11 => 'actividad_buffer_proyecto',
    12 => 'actividad_buffer',
    13 => 'actividad_patron_proyecto',
    14 => 'actividad_patron',
    15 => 'nombre',
    16 => 'descripcion',
    17 => 'actividad_accion',
    18 => 'menu',
    19 => 'orden',
    20 => 'solicitud_registrar',
    21 => 'solicitud_obs_tipo_proyecto',
    22 => 'solicitud_obs_tipo',
    23 => 'solicitud_observacion',
    24 => 'solicitud_registrar_cron',
    25 => 'prueba_directorios',
    26 => 'zona_proyecto',
    27 => 'zona',
    28 => 'zona_orden',
    29 => 'zona_listar',
    30 => 'imagen_recurso_origen',
    31 => 'imagen',
    32 => 'parametro_a',
    33 => 'parametro_b',
    34 => 'parametro_c',
    35 => 'publico',
    36 => 'redirecciona',
    37 => 'usuario',
    38 => 'creacion',
  ),
);
	}

	static function apex_item_info()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'item_proyecto',
  'dump_clave_componente' => 'item',
  'dump_order_by' => 'item',
  'dump_where' => '(	item_proyecto = \\\'%%\\\'	)',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'item_id',
    1 => 'item_proyecto',
    2 => 'item',
    3 => 'descripcion_breve',
    4 => 'descripcion_larga',
  ),
);
	}

	static function apex_objeto()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'objeto',
    2 => 'anterior',
    3 => 'reflexivo',
    4 => 'clase_proyecto',
    5 => 'clase',
    6 => 'subclase',
    7 => 'subclase_archivo',
    8 => 'objeto_categoria_proyecto',
    9 => 'objeto_categoria',
    10 => 'nombre',
    11 => 'titulo',
    12 => 'colapsable',
    13 => 'descripcion',
    14 => 'fuente_datos_proyecto',
    15 => 'fuente_datos',
    16 => 'solicitud_registrar',
    17 => 'solicitud_obj_obs_tipo',
    18 => 'solicitud_obj_observacion',
    19 => 'parametro_a',
    20 => 'parametro_b',
    21 => 'parametro_c',
    22 => 'parametro_d',
    23 => 'parametro_e',
    24 => 'parametro_f',
    25 => 'usuario',
    26 => 'creacion',
  ),
);
	}

	static function apex_objeto_info()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'descripcion_breve',
    3 => 'descripcion_larga',
  ),
);
	}

	static function apex_objeto_dependencias()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto_consumidor',
  'dump_order_by' => 'objeto_consumidor, identificador',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'dep_id',
    2 => 'objeto_consumidor',
    3 => 'objeto_proveedor',
    4 => 'identificador',
    5 => 'parametros_a',
    6 => 'parametros_b',
    7 => 'parametros_c',
    8 => 'inicializar',
    9 => 'orden',
  ),
);
	}

	static function apex_objeto_eventos()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, orden, identificador',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'evento_id',
    2 => 'objeto',
    3 => 'identificador',
    4 => 'etiqueta',
    5 => 'maneja_datos',
    6 => 'sobre_fila',
    7 => 'confirmacion',
    8 => 'estilo',
    9 => 'imagen_recurso_origen',
    10 => 'imagen',
    11 => 'en_botonera',
    12 => 'ayuda',
    13 => 'orden',
    14 => 'ci_predep',
    15 => 'implicito',
    16 => 'defecto',
    17 => 'display_datos_cargados',
    18 => 'grupo',
    19 => 'accion',
    20 => 'accion_imphtml_debug',
    21 => 'accion_vinculo_carpeta',
    22 => 'accion_vinculo_item',
    23 => 'accion_vinculo_objeto',
    24 => 'accion_vinculo_popup',
    25 => 'accion_vinculo_popup_param',
    26 => 'accion_vinculo_target',
    27 => 'accion_vinculo_celda',
  ),
);
	}

	static function apex_ptos_control_x_evento()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, evento_id',
  'zona' => 'nucleo',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'pto_control',
    2 => 'evento_id',
    3 => 'objeto',
  ),
);
	}

	static function apex_item_objeto()
	{
		return array (
  'archivo' => 'pgsql_a03_tablas_componentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'item',
  'dump_order_by' => 'item, objeto',
  'zona' => 'central',
  'desc' => '',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'item_id',
    1 => 'proyecto',
    2 => 'item',
    3 => 'objeto',
    4 => 'orden',
    5 => 'inicializar',
  ),
);
	}

	static function apex_objeto_mt_me()
	{
		return array (
  'archivo' => 'pgsql_a10_componente_ci.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_mt_me_proyecto',
  'dump_clave_componente' => 'objeto_mt_me',
  'dump_order_by' => 'objeto_mt_me',
  'dump_where' => '(	objeto_mt_me_proyecto =	\\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_mt_me_proyecto',
    1 => 'objeto_mt_me',
    2 => 'ev_procesar_etiq',
    3 => 'ev_cancelar_etiq',
    4 => 'ancho',
    5 => 'alto',
    6 => 'posicion_botonera',
    7 => 'tipo_navegacion',
    8 => 'con_toc',
    9 => 'incremental',
    10 => 'debug_eventos',
    11 => 'activacion_procesar',
    12 => 'activacion_cancelar',
    13 => 'ev_procesar',
    14 => 'ev_cancelar',
    15 => 'objetos',
    16 => 'post_procesar',
    17 => 'metodo_despachador',
    18 => 'metodo_opciones',
  ),
);
	}

	static function apex_objeto_ci_pantalla()
	{
		return array (
  'archivo' => 'pgsql_a10_componente_ci.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_ci_proyecto',
  'dump_clave_componente' => 'objeto_ci',
  'dump_order_by' => 'objeto_ci_proyecto, objeto_ci, pantalla',
  'dump_where' => '(	objeto_ci_proyecto =	\\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_ci_proyecto',
    1 => 'objeto_ci',
    2 => 'pantalla',
    3 => 'identificador',
    4 => 'orden',
    5 => 'etiqueta',
    6 => 'descripcion',
    7 => 'tip',
    8 => 'imagen_recurso_origen',
    9 => 'imagen',
    10 => 'objetos',
    11 => 'eventos',
    12 => 'subclase',
    13 => 'subclase_archivo',
  ),
);
	}

	static function apex_objeto_cuadro()
	{
		return array (
  'archivo' => 'pgsql_a11_componente_ei_cuadro.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_cuadro_proyecto',
  'dump_clave_componente' => 'objeto_cuadro',
  'dump_order_by' => 'objeto_cuadro',
  'dump_where' => '( objeto_cuadro_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_cuadro_proyecto',
    1 => 'objeto_cuadro',
    2 => 'titulo',
    3 => 'subtitulo',
    4 => 'sql',
    5 => 'columnas_clave',
    6 => 'clave_dbr',
    7 => 'archivos_callbacks',
    8 => 'ancho',
    9 => 'ordenar',
    10 => 'paginar',
    11 => 'tamano_pagina',
    12 => 'tipo_paginado',
    13 => 'eof_invisible',
    14 => 'eof_customizado',
    15 => 'exportar_paginado',
    16 => 'exportar',
    17 => 'exportar_rtf',
    18 => 'pdf_propiedades',
    19 => 'pdf_respetar_paginacion',
    20 => 'asociacion_columnas',
    21 => 'ev_seleccion',
    22 => 'ev_eliminar',
    23 => 'dao_nucleo_proyecto',
    24 => 'dao_nucleo',
    25 => 'dao_metodo',
    26 => 'dao_parametros',
    27 => 'desplegable',
    28 => 'desplegable_activo',
    29 => 'scroll',
    30 => 'scroll_alto',
    31 => 'cc_modo',
    32 => 'cc_modo_anidado_colap',
    33 => 'cc_modo_anidado_totcol',
    34 => 'cc_modo_anidado_totcua',
  ),
);
	}

	static function apex_objeto_cuadro_cc()
	{
		return array (
  'archivo' => 'pgsql_a11_componente_ei_cuadro.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_cuadro_proyecto',
  'dump_clave_componente' => 'objeto_cuadro',
  'dump_order_by' => 'objeto_cuadro, objeto_cuadro_cc',
  'dump_where' => '( objeto_cuadro_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_cuadro_proyecto',
    1 => 'objeto_cuadro',
    2 => 'objeto_cuadro_cc',
    3 => 'identificador',
    4 => 'descripcion',
    5 => 'orden',
    6 => 'columnas_id',
    7 => 'columnas_descripcion',
    8 => 'pie_contar_filas',
    9 => 'pie_mostrar_titular',
    10 => 'pie_mostrar_titulos',
    11 => 'imp_paginar',
    12 => 'modo_inicio_colapsado',
  ),
);
	}

	static function apex_objeto_ei_cuadro_columna()
	{
		return array (
  'archivo' => 'pgsql_a11_componente_ei_cuadro.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_cuadro_proyecto',
  'dump_clave_componente' => 'objeto_cuadro',
  'dump_order_by' => 'objeto_cuadro, objeto_cuadro_col',
  'dump_where' => '( objeto_cuadro_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_cuadro_proyecto',
    1 => 'objeto_cuadro',
    2 => 'objeto_cuadro_col',
    3 => 'clave',
    4 => 'orden',
    5 => 'titulo',
    6 => 'estilo_titulo',
    7 => 'estilo',
    8 => 'ancho',
    9 => 'formateo',
    10 => 'vinculo_indice',
    11 => 'no_ordenar',
    12 => 'mostrar_xls',
    13 => 'mostrar_pdf',
    14 => 'pdf_propiedades',
    15 => 'desabilitado',
    16 => 'total',
    17 => 'total_cc',
    18 => 'usar_vinculo',
    19 => 'vinculo_carpeta',
    20 => 'vinculo_item',
    21 => 'vinculo_popup',
    22 => 'vinculo_popup_param',
    23 => 'vinculo_target',
    24 => 'vinculo_celda',
  ),
);
	}

	static function apex_objeto_ut_formulario()
	{
		return array (
  'archivo' => 'pgsql_a12_componente_ei_formulario.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_ut_formulario_proyecto',
  'dump_clave_componente' => 'objeto_ut_formulario',
  'dump_order_by' => 'objeto_ut_formulario',
  'dump_where' => '( objeto_ut_formulario_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_ut_formulario_proyecto',
    1 => 'objeto_ut_formulario',
    2 => 'tabla',
    3 => 'titulo',
    4 => 'ev_agregar',
    5 => 'ev_agregar_etiq',
    6 => 'ev_mod_modificar',
    7 => 'ev_mod_modificar_etiq',
    8 => 'ev_mod_eliminar',
    9 => 'ev_mod_eliminar_etiq',
    10 => 'ev_mod_limpiar',
    11 => 'ev_mod_limpiar_etiq',
    12 => 'ev_mod_clave',
    13 => 'clase_proyecto',
    14 => 'clase',
    15 => 'auto_reset',
    16 => 'ancho',
    17 => 'ancho_etiqueta',
    18 => 'expandir_descripcion',
    19 => 'campo_bl',
    20 => 'scroll',
    21 => 'filas',
    22 => 'filas_agregar',
    23 => 'filas_agregar_online',
    24 => 'filas_agregar_abajo',
    25 => 'filas_agregar_texto',
    26 => 'filas_borrar_en_linea',
    27 => 'filas_undo',
    28 => 'filas_ordenar',
    29 => 'filas_ordenar_en_linea',
    30 => 'columna_orden',
    31 => 'filas_numerar',
    32 => 'ev_seleccion',
    33 => 'alto',
    34 => 'analisis_cambios',
  ),
);
	}

	static function apex_objeto_ei_formulario_ef()
	{
		return array (
  'archivo' => 'pgsql_a12_componente_ei_formulario.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_ei_formulario_proyecto',
  'dump_clave_componente' => 'objeto_ei_formulario',
  'dump_order_by' => 'objeto_ei_formulario, objeto_ei_formulario_fila',
  'dump_where' => '( objeto_ei_formulario_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_ei_formulario_fila',
    1 => 'objeto_ei_formulario',
    2 => 'objeto_ei_formulario_proyecto',
    3 => 'identificador',
    4 => 'elemento_formulario',
    5 => 'columnas',
    6 => 'obligatorio',
    7 => 'oculto_relaja_obligatorio',
    8 => 'orden',
    9 => 'etiqueta',
    10 => 'etiqueta_estilo',
    11 => 'descripcion',
    12 => 'colapsado',
    13 => 'desactivado',
    14 => 'estilo',
    15 => 'total',
    16 => 'inicializacion',
    17 => 'estado_defecto',
    18 => 'solo_lectura',
    19 => 'carga_metodo',
    20 => 'carga_clase',
    21 => 'carga_include',
    22 => 'carga_dt',
    23 => 'carga_consulta_php',
    24 => 'carga_sql',
    25 => 'carga_fuente',
    26 => 'carga_lista',
    27 => 'carga_col_clave',
    28 => 'carga_col_desc',
    29 => 'carga_maestros',
    30 => 'carga_cascada_relaj',
    31 => 'carga_no_seteado',
    32 => 'carga_no_seteado_ocultar',
    33 => 'edit_tamano',
    34 => 'edit_maximo',
    35 => 'edit_mascara',
    36 => 'edit_unidad',
    37 => 'edit_rango',
    38 => 'edit_filas',
    39 => 'edit_columnas',
    40 => 'edit_wrap',
    41 => 'edit_resaltar',
    42 => 'edit_ajustable',
    43 => 'edit_confirmar_clave',
    44 => 'edit_expreg',
    45 => 'popup_item',
    46 => 'popup_proyecto',
    47 => 'popup_editable',
    48 => 'popup_ventana',
    49 => 'popup_carga_desc_metodo',
    50 => 'popup_carga_desc_clase',
    51 => 'popup_carga_desc_include',
    52 => 'fieldset_fin',
    53 => 'check_valor_si',
    54 => 'check_valor_no',
    55 => 'check_desc_si',
    56 => 'check_desc_no',
    57 => 'check_ml_toggle',
    58 => 'fijo_sin_estado',
    59 => 'editor_ancho',
    60 => 'editor_alto',
    61 => 'editor_botonera',
    62 => 'selec_cant_minima',
    63 => 'selec_cant_maxima',
    64 => 'selec_utilidades',
    65 => 'selec_tamano',
    66 => 'selec_ancho',
    67 => 'selec_serializar',
    68 => 'selec_cant_columnas',
    69 => 'upload_extensiones',
  ),
);
	}

	static function apex_objeto_esquema()
	{
		return array (
  'archivo' => 'pgsql_a13_componente_ei_esquema.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_esquema_proyecto',
  'dump_clave_componente' => 'objeto_esquema',
  'dump_order_by' => 'objeto_esquema',
  'dump_where' => '( objeto_esquema_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_esquema_proyecto',
    1 => 'objeto_esquema',
    2 => 'parser',
    3 => 'descripcion',
    4 => 'dot',
    5 => 'debug',
    6 => 'formato',
    7 => 'modelo_ejecucion',
    8 => 'modelo_ejecucion_cache',
    9 => 'tipo_incrustacion',
    10 => 'ancho',
    11 => 'alto',
    12 => 'dirigido',
    13 => 'sql',
  ),
);
	}

	static function apex_objeto_ei_filtro_ml()
	{
		return array (
  'archivo' => 'pgsql_a14_componente_ei_filtro_ml.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_ei_filtro_ml_proyecto',
  'dump_clave_componente' => 'objeto_ei_filtro_ml',
  'dump_order_by' => 'objeto_ei_filtro_ml',
  'dump_where' => '( objeto_ei_filtro_ml_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_ei_filtro_ml_proyecto',
    1 => 'objeto_ei_filtro_ml',
    2 => 'ancho',
  ),
);
	}

	static function apex_objeto_ei_filtro_ml_col()
	{
		return array (
  'archivo' => 'pgsql_a14_componente_ei_filtro_ml.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_ei_filtro_ml_proyecto',
  'dump_clave_componente' => 'objeto_ei_filtro_ml',
  'dump_order_by' => 'objeto_ei_filtro_ml_col',
  'dump_where' => '( objeto_ei_filtro_ml_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_ei_filtro_ml_col',
    1 => 'objeto_ei_filtro_ml',
    2 => 'objeto_ei_filtro_ml_proyecto',
    3 => 'tipo',
    4 => 'nombre',
    5 => 'etiqueta',
    6 => 'descripcion',
    7 => 'obligatorio',
    8 => 'inicial',
    9 => 'orden',
    10 => 'opciones_es_multiple',
    11 => 'opciones_ef',
    12 => 'carga_metodo',
    13 => 'carga_clase',
    14 => 'carga_include',
    15 => 'carga_dt',
    16 => 'carga_consulta_php',
    17 => 'carga_lista',
    18 => 'carga_col_clave',
    19 => 'carga_col_desc',
    20 => 'carga_no_seteado',
    21 => 'popup_item',
    22 => 'popup_proyecto',
    23 => 'popup_editable',
    24 => 'popup_ventana',
    25 => 'popup_carga_desc_metodo',
    26 => 'popup_carga_desc_clase',
    27 => 'popup_carga_desc_include',
  ),
);
	}

	static function apex_objeto_db_registros()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'max_registros',
    3 => 'min_registros',
    4 => 'ap',
    5 => 'ap_clase',
    6 => 'ap_archivo',
    7 => 'tabla',
    8 => 'alias',
    9 => 'modificar_claves',
    10 => 'fuente_datos_proyecto',
    11 => 'fuente_datos',
  ),
);
	}

	static function apex_objeto_db_registros_col()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, col_id',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'col_id',
    3 => 'columna',
    4 => 'tipo',
    5 => 'pk',
    6 => 'secuencia',
    7 => 'largo',
    8 => 'no_nulo',
    9 => 'no_nulo_db',
    10 => 'externa',
  ),
);
	}

	static function apex_objeto_db_registros_ext()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, externa_id',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'externa_id',
    3 => 'tipo',
    4 => 'sincro_continua',
    5 => 'metodo',
    6 => 'clase',
    7 => 'include',
    8 => 'sql',
  ),
);
	}

	static function apex_objeto_db_registros_ext_col()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, externa_id, col_id',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => 'Asocia una carga externa con una columna, ya sea como resultado o como parametro',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'externa_id',
    3 => 'col_id',
    4 => 'es_resultado',
  ),
);
	}

	static function apex_objeto_db_registros_uniq()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'objeto_proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, uniq_id',
  'dump_where' => '( objeto_proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'objeto_proyecto',
    1 => 'objeto',
    2 => 'uniq_id',
    3 => 'columnas',
  ),
);
	}

	static function apex_objeto_datos_rel()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'objeto',
    2 => 'debug',
    3 => 'clave',
    4 => 'ap',
    5 => 'ap_clase',
    6 => 'ap_archivo',
    7 => 'sinc_susp_constraints',
    8 => 'sinc_orden_automatico',
  ),
);
	}

	static function apex_objeto_datos_rel_asoc()
	{
		return array (
  'archivo' => 'pgsql_a40_componente_datos.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'objeto',
  'dump_order_by' => 'objeto, asoc_id',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'objeto',
    2 => 'asoc_id',
    3 => 'identificador',
    4 => 'padre_proyecto',
    5 => 'padre_objeto',
    6 => 'padre_id',
    7 => 'padre_clave',
    8 => 'hijo_proyecto',
    9 => 'hijo_objeto',
    10 => 'hijo_id',
    11 => 'hijo_clave',
    12 => 'cascada',
    13 => 'orden',
  ),
);
	}

	static function apex_molde_operacion()
	{
		return array (
  'archivo' => 'pgsql_a50_asistentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'molde',
  'dump_order_by' => 'molde',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'molde',
    2 => 'operacion_tipo',
    3 => 'nombre',
    4 => 'item',
    5 => 'carpeta_archivos',
    6 => 'prefijo_clases',
    7 => 'fuente',
  ),
);
	}

	static function apex_molde_operacion_log()
	{
		return array (
  'archivo' => 'pgsql_a50_asistentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'molde',
  'dump_order_by' => 'generacion',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'molde',
    2 => 'generacion',
    3 => 'momento',
  ),
);
	}

	static function apex_molde_operacion_log_elementos()
	{
		return array (
  'archivo' => 'pgsql_a50_asistentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'molde',
  'dump_order_by' => 'generacion',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'generacion',
    1 => 'molde',
    2 => 'id',
    3 => 'tipo',
    4 => 'proyecto',
    5 => 'clave',
  ),
);
	}

	static function apex_molde_operacion_abms()
	{
		return array (
  'archivo' => 'pgsql_a50_asistentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'molde',
  'dump_order_by' => 'molde',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'molde',
    2 => 'tabla',
    3 => 'gen_usa_filtro',
    4 => 'gen_separar_pantallas',
    5 => 'filtro_comprobar_parametros',
    6 => 'cuadro_eof',
    7 => 'cuadro_eliminar_filas',
    8 => 'cuadro_id',
    9 => 'cuadro_forzar_filtro',
    10 => 'cuadro_carga_origen',
    11 => 'cuadro_carga_sql',
    12 => 'cuadro_carga_php_include',
    13 => 'cuadro_carga_php_clase',
    14 => 'cuadro_carga_php_metodo',
    15 => 'datos_tabla_validacion',
    16 => 'apdb_pre',
  ),
);
	}

	static function apex_molde_operacion_abms_fila()
	{
		return array (
  'archivo' => 'pgsql_a50_asistentes.sql',
  'proyecto' => 'toba',
  'dump' => 'componente',
  'dump_clave_proyecto' => 'proyecto',
  'dump_clave_componente' => 'molde',
  'dump_order_by' => 'molde, fila',
  'dump_where' => '( proyecto = \\\'%%\\\' )',
  'zona' => 'objeto',
  'desc' => '',
  'historica' => '0',
  'version' => '1.0',
  'columnas' => 
  array (
    0 => 'proyecto',
    1 => 'molde',
    2 => 'fila',
    3 => 'orden',
    4 => 'columna',
    5 => 'asistente_tipo_dato',
    6 => 'etiqueta',
    7 => 'en_cuadro',
    8 => 'en_form',
    9 => 'en_filtro',
    10 => 'filtro_operador',
    11 => 'cuadro_estilo',
    12 => 'cuadro_formato',
    13 => 'dt_tipo_dato',
    14 => 'dt_largo',
    15 => 'dt_secuencia',
    16 => 'dt_pk',
    17 => 'elemento_formulario',
    18 => 'ef_obligatorio',
    19 => 'ef_desactivar_modificacion',
    20 => 'ef_procesar_javascript',
    21 => 'ef_carga_origen',
    22 => 'ef_carga_sql',
    23 => 'ef_carga_php_include',
    24 => 'ef_carga_php_clase',
    25 => 'ef_carga_php_metodo',
    26 => 'ef_carga_tabla',
    27 => 'ef_carga_col_clave',
    28 => 'ef_carga_col_desc',
  ),
);
	}

}

?>