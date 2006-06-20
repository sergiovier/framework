------------------------------------------------------------
--[571]--  MENSAJES 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '571', NULL, NULL, 'toba', 'objeto_cuadro', NULL, NULL, NULL, NULL, 'MENSAJES', NULL, NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-08-25 05:21:41');
INSERT INTO apex_objeto_cuadro (objeto_cuadro_proyecto, objeto_cuadro, titulo, subtitulo, sql, columnas_clave, clave_dbr, archivos_callbacks, ancho, ordenar, paginar, tamano_pagina, tipo_paginado, eof_invisible, eof_customizado, exportar, exportar_rtf, pdf_propiedades, pdf_respetar_paginacion, asociacion_columnas, ev_seleccion, ev_eliminar, dao_nucleo_proyecto, dao_nucleo, dao_metodo, dao_parametros, desplegable, desplegable_activo, scroll, scroll_alto, cc_modo, cc_modo_anidado_colap, cc_modo_anidado_totcol, cc_modo_anidado_totcua) VALUES ('admin', '571', NULL, NULL, 'SELECT proyecto, msg, indice, descripcion_corta
FROM apex_msg %w% ORDER BY indice;', 'proyecto, msg', NULL, NULL, '500', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, orden, titulo, columna_estilo, columna_ancho, ancho_html, total, total_cc, valor_sql, valor_sql_formato, valor_fijo, valor_proceso, valor_proceso_esp, valor_proceso_parametros, vinculo_indice, par_dimension_proyecto, par_dimension, par_tabla, par_columna, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado) VALUES ('admin', '571', '1', 'Indice', '4', NULL, NULL, NULL, NULL, 'indice', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);
INSERT INTO apex_objeto_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, orden, titulo, columna_estilo, columna_ancho, ancho_html, total, total_cc, valor_sql, valor_sql_formato, valor_fijo, valor_proceso, valor_proceso_esp, valor_proceso_parametros, vinculo_indice, par_dimension_proyecto, par_dimension, par_tabla, par_columna, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado) VALUES ('admin', '571', '2', 'Descripcion', '4', NULL, NULL, NULL, NULL, 'descripcion_corta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);
INSERT INTO apex_objeto_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, orden, titulo, columna_estilo, columna_ancho, ancho_html, total, total_cc, valor_sql, valor_sql_formato, valor_fijo, valor_proceso, valor_proceso_esp, valor_proceso_parametros, vinculo_indice, par_dimension_proyecto, par_dimension, par_tabla, par_columna, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado) VALUES ('admin', '571', '3', 'Editar', '4', '1%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'abm', NULL, NULL, NULL, NULL, NULL, '1', '1', '', NULL);
