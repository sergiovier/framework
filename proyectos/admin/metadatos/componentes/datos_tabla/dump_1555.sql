------------------------------------------------------------
--[1555]--  ITEM - Permisos 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '1555', NULL, NULL, 'toba', 'objeto_datos_tabla', NULL, NULL, NULL, NULL, 'ITEM - Permisos', NULL, NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-09-06 16:58:17');
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES ('admin', '1555', NULL, NULL, '1', NULL, NULL, 'apex_usuario_grupo_acc_item', NULL, NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1555', '266', 'proyecto', 'C', '1', NULL, '15', NULL, '1', NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1555', '267', 'usuario_grupo_acc', 'C', '1', NULL, '20', NULL, '1', NULL);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1555', '268', 'item', 'C', '1', NULL, '60', NULL, '1', NULL);
