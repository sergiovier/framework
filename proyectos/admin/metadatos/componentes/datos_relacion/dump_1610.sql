------------------------------------------------------------
--[1610]--  OBJETO - ei_arbol 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '1610', NULL, NULL, 'toba', 'objeto_datos_relacion', NULL, NULL, NULL, NULL, 'OBJETO - ei_arbol', NULL, NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-09-16 17:35:04');
INSERT INTO apex_objeto_datos_rel (proyecto, objeto, debug, clave, ap, ap_clase, ap_archivo, sinc_susp_constraints, sinc_orden_automatico) VALUES ('admin', '1610', '0', NULL, '3', 'ap_relacion_objeto', 'db/ap_relacion_objeto.php', '0', '1');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('admin', '131', '1610', '1501', 'base', '1', '1', NULL, NULL, NULL);
