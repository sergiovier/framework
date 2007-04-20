------------------------------------------------------------
--[1000245]--  Ataques XSS 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba_testing', '1000245', NULL, NULL, 'toba', 'objeto_ci', 'ci_xss', 'seguridad/ci_xss.php', NULL, NULL, 'Ataques XSS', 'Prueba vulnerabilidades XSS sobre distintos componentes', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-04-19 14:41:24');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_testing', '1000108', '1000245', '1000246', 'form', NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_mt_me (objeto_mt_me_proyecto, objeto_mt_me, ev_procesar_etiq, ev_cancelar_etiq, ancho, alto, posicion_botonera, tipo_navegacion, con_toc, incremental, debug_eventos, activacion_procesar, activacion_cancelar, ev_procesar, ev_cancelar, objetos, post_procesar, metodo_despachador, metodo_opciones) VALUES ('toba_testing', '1000245', NULL, NULL, '400px', NULL, 'abajo', 'tab_h', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ci_pantalla (objeto_ci_proyecto, objeto_ci, pantalla, identificador, orden, etiqueta, descripcion, tip, imagen_recurso_origen, imagen, objetos, eventos, subclase, subclase_archivo) VALUES ('toba_testing', '1000245', '1000145', 'pant_inicial', '1', 'Formulario', NULL, NULL, 'apex', NULL, 'form', '', NULL, NULL);
INSERT INTO apex_objeto_ci_pantalla (objeto_ci_proyecto, objeto_ci, pantalla, identificador, orden, etiqueta, descripcion, tip, imagen_recurso_origen, imagen, objetos, eventos, subclase, subclase_archivo) VALUES ('toba_testing', '1000245', '1000146', 'pant_cuadro', '2', 'Cuadro', NULL, NULL, 'apex', NULL, NULL, NULL, NULL, NULL);