------------------------------------------------------------
--[1821]--  Listado de cambios 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '1821', NULL, NULL, 'toba', 'objeto_ei_cuadro', NULL, NULL, NULL, NULL, 'Listado de cambios', NULL, NULL, NULL, 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-04-17 15:28:47');
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param) VALUES ('toba', '432', '1821', 'seleccion', NULL, NULL, '1', NULL, NULL, 'apex', 'doc.gif', '0', NULL, '1', NULL, NULL, NULL, NULL, 'V', NULL, NULL, NULL, NULL, '0', NULL);
INSERT INTO apex_objeto_cuadro (objeto_cuadro_proyecto, objeto_cuadro, titulo, subtitulo, sql, columnas_clave, clave_dbr, archivos_callbacks, ancho, ordenar, paginar, tamano_pagina, tipo_paginado, eof_invisible, eof_customizado, exportar, exportar_rtf, pdf_propiedades, pdf_respetar_paginacion, asociacion_columnas, ev_seleccion, ev_eliminar, dao_nucleo_proyecto, dao_nucleo, dao_metodo, dao_parametros, desplegable, desplegable_activo, scroll, scroll_alto, cc_modo, cc_modo_anidado_colap, cc_modo_anidado_totcol, cc_modo_anidado_totcua) VALUES ('toba', '1821', NULL, NULL, NULL, 'componente_proyecto, componente_id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', '0', NULL, NULL);
INSERT INTO apex_objeto_ei_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col, clave, orden, titulo, estilo_titulo, estilo, ancho, formateo, vinculo_indice, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado, total, total_cc) VALUES ('toba', '1821', '525', 'usuario', '1', 'Usuario', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col, clave, orden, titulo, estilo_titulo, estilo, ancho, formateo, vinculo_indice, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado, total, total_cc) VALUES ('toba', '1821', '526', 'momento', '2', 'Momento', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col, clave, orden, titulo, estilo_titulo, estilo, ancho, formateo, vinculo_indice, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado, total, total_cc) VALUES ('toba', '1821', '527', 'componente_nombre', '4', 'Componente', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_cuadro_columna (objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col, clave, orden, titulo, estilo_titulo, estilo, ancho, formateo, vinculo_indice, no_ordenar, mostrar_xls, mostrar_pdf, pdf_propiedades, desabilitado, total, total_cc) VALUES ('toba', '1821', '529', 'icono_tipo_componente', '3', NULL, 'lista-col-titulo', '0', NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
