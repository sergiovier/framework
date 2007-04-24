------------------------------------------------------------
--[10000024]--  PUNTOS DE CONTROL - relacion 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba_editor', '10000024', NULL, NULL, 'toba', 'objeto_datos_relacion', NULL, NULL, NULL, NULL, 'PUNTOS DE CONTROL - relacion', NULL, NULL, NULL, 'toba_editor', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-12-18 14:25:55');
INSERT INTO apex_objeto_datos_rel (proyecto, objeto, debug, clave, ap, ap_clase, ap_archivo, sinc_susp_constraints, sinc_orden_automatico) VALUES ('toba_editor', '10000024', '0', NULL, '2', NULL, NULL, '0', '1');
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES ('toba_editor', '10000024', '10000002', NULL, 'toba_editor', '10000022', 'apex_ptos_control', 'proyecto,pto_control', 'toba_editor', '10000028', 'apex_ptos_ctrl_param', 'proyecto,pto_control', NULL, '1');
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES ('toba_editor', '10000024', '10000004', NULL, 'toba_editor', '10000022', 'apex_ptos_control', 'proyecto,pto_control', 'toba_editor', '10000035', 'ptos_control_ctrl', 'proyecto,pto_control', NULL, '2');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_editor', '10000029', '10000024', '10000022', 'apex_ptos_control', '1', '1', NULL, NULL, '3');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_editor', '10000035', '10000024', '10000028', 'apex_ptos_ctrl_param', '', '', NULL, NULL, '2');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_editor', '10000041', '10000024', '10000035', 'ptos_control_ctrl', NULL, NULL, NULL, NULL, '1');
