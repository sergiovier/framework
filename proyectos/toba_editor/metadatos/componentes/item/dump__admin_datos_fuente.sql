------------------------------------------------------------
--[/admin/datos/fuente]--  Fuente de Datos - Editor 
------------------------------------------------------------
INSERT INTO apex_item (item_id, proyecto, item, padre_id, padre_proyecto, padre, carpeta, nivel_acceso, solicitud_tipo, pagina_tipo_proyecto, pagina_tipo, actividad_buffer_proyecto, actividad_buffer, actividad_patron_proyecto, actividad_patron, nombre, descripcion, actividad_accion, menu, orden, solicitud_registrar, solicitud_obs_tipo_proyecto, solicitud_obs_tipo, solicitud_observacion, solicitud_registrar_cron, prueba_directorios, zona_proyecto, zona, zona_orden, zona_listar, imagen_recurso_origen, imagen, parametro_a, parametro_b, parametro_c, publico, redirecciona, usuario, creacion) VALUES ('201', 'toba_editor', '/admin/datos/fuente', '143', 'toba_editor', '/configuracion', '0', '0', 'web', 'toba', 'titulo', 'toba', '0', 'toba', 'editable_abm', 'Fuente de Datos - Editor', 'Las [wiki:Referencia/FuenteDatos fuentes de datos] permiten conectar componentes y c�digo propio a distintas bases de datos.', '', '1', '0', '0', 'toba', 'item_datos', NULL, '0', NULL, 'toba_editor', 'zona_fuente', '4', '1', 'apex', 'fuente.gif', NULL, NULL, NULL, '0', '0', NULL, '2004-03-10 18:06:39');
INSERT INTO apex_item_objeto (item_id, proyecto, item, objeto, orden, inicializar) VALUES (NULL, 'toba_editor', '/admin/datos/fuente', '1832', '0', NULL);
