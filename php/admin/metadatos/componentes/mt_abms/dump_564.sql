------------------------------------------------------------
--[564]--  ADM PROY - Tarea Tema 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '564', NULL, NULL, 'toba', 'objeto_mt_abms', NULL, NULL, NULL, NULL, 'ADM PROY - Tarea Tema', 'Tarea Tema', NULL, NULL, 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-08-24 17:49:58');
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba', '564', 'apex_ap_tarea_tema', NULL, NULL, NULL, NULL, NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '564', 'descripcion', 'descripcion', NULL, '1', 'ef_editable', '', '2', 'Descripción', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '564', 'tarea_tema', 'tarea_tema', '1', NULL, 'ef_oculto_secuencia', '', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
