------------------------------------------------------------
--[658]--  OBJETO - Editor ESQUEMA 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '658', NULL, NULL, 'toba', 'objeto_mt_abms', NULL, NULL, NULL, NULL, 'OBJETO - Editor ESQUEMA', 'Editar de ESQUEMA', NULL, NULL, 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-09-26 03:24:11');
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba', '658', 'apex_objeto_esquema', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, '500', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'alto', 'alto', NULL, NULL, 'ef_editable', 'tamano: 10;', '9', 'Alto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'ancho', 'ancho', NULL, NULL, 'ef_editable', 'tamano: 10;', '10', 'Ancho', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'debug', 'debug', NULL, NULL, 'ef_checkbox', 'valor: 1;
valor_info: SI;', '100', 'Debug', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'descripcion', 'descripcion', NULL, NULL, 'ef_editable_multilinea', 'filas: 3;
columnas: 60;', '2', 'Descripcion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'dot', 'dot', NULL, NULL, 'ef_editable_multilinea', 'filas: 25;
columnas: 90;
no_margen: 1;', '1.5', 'DOT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'formato', 'formato', NULL, NULL, 'ef_combo_lista', 'lista: gif, png;', '5', 'Formato', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'modelo_ejecucion', 'modelo_ejecucion', NULL, NULL, 'ef_combo_lista', 'lista: cache, onTheFly;', '6', 'Modelo ejecucion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'modelo_ejecucion_c', 'modelo_ejecucion_cache', NULL, NULL, 'ef_checkbox', 'valor: 1;
valor_info: SI;', '7', 'Usar cache', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'objeto', 'objeto_esquema', '1', '1', 'ef_oculto', '', '0.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'objeto_proyecto', 'objeto_esquema_proyecto', '1', '1', 'ef_oculto_proyecto', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'parser', 'parser', NULL, NULL, 'ef_combo_lista', 'lista: dot, neato;', '1', 'Herramienta', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '658', 'tipo_incrustacion', 'tipo_incrustacion', NULL, NULL, 'ef_combo_lista', 'lista: iframe, img;', '8', 'Tipo incrustacion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
