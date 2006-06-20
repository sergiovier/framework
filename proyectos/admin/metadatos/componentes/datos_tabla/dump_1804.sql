------------------------------------------------------------
--[1804]--  Permisos 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '1804', NULL, NULL, 'toba', 'objeto_datos_tabla', NULL, NULL, NULL, NULL, 'Permisos', NULL, NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-02-01 10:42:57');
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES ('admin', '1804', NULL, NULL, '1', NULL, NULL, 'apex_permiso', NULL, '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1804', '392', 'permiso', 'E', '1', '\"apex_permiso_seq\"', NULL, NULL, '1', NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1804', '393', 'proyecto', 'C', '1', NULL, '15', NULL, '1', NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1804', '394', 'nombre', 'C', NULL, NULL, '100', NULL, '1', NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1804', '395', 'descripcion', 'C', NULL, NULL, '255', NULL, NULL, NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1804', '396', 'mensaje_particular', 'C', NULL, NULL, NULL, NULL, NULL, NULL);
