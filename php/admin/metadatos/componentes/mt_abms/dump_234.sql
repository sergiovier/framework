------------------------------------------------------------
--[234]--  Elemento - ZONA 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '234', NULL, NULL, 'toba', 'objeto_mt_abms', NULL, NULL, NULL, NULL, 'Elemento - ZONA', 'Propiedades', NULL, 'ABM de ZONAS', 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2004-02-27 21:22:26');
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba', '234', 'apex_item_zona', 'Propiedades', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '234', 'archivo', 'archivo', NULL, '1', 'ef_editable', 'tamano:60;', '3', 'Archivo', 'Archivo donde se implementa la clase ZONA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '234', 'descripcion', 'descripcion', NULL, NULL, 'ef_editable_multilinea', 'filas: 4;
columnas: 35;', '4', 'Descripcion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '234', 'nombre', 'nombre', NULL, '1', 'ef_editable', 'tamano:40;', '2', 'Nombre', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '234', 'proyecto', 'proyecto', '1', NULL, 'ef_oculto_proyecto', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario_ef (objeto_ut_formulario_proyecto, objeto_ut_formulario, identificador, columnas, clave_primaria, obligatorio, elemento_formulario, inicializacion, orden, etiqueta, descripcion, colapsado, desactivado, no_sql, total, clave_primaria_padre, listar, lista_cabecera, lista_orden, lista_columna_estilo, lista_valor_sql, lista_valor_sql_formato, lista_valor_sql_esp, lista_ancho) VALUES ('toba', '234', 'zona', 'zona', '1', '1', 'ef_editable', '20', '1', 'Identificador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
