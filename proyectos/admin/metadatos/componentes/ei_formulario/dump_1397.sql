------------------------------------------------------------
--[1397]--  OBJETO - DBR - Prop. basicas 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '1397', NULL, NULL, 'toba', 'objeto_ei_formulario', 'eiform_ap', 'objetos_toba/db_registros/eiform_ap.php', NULL, NULL, 'OBJETO - DBR - Prop. basicas', 'Administrador de Persistencia PREDETERMINADO', NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-07-26 23:56:28');
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('admin', '73', '1397', 'modificacion', 'Modificacion', '1', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('admin', '1397', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '150px', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1258', 'ap', 'ef_combo_db', 'ap', '1', 'predeterminado: 1;
sql: SELECT ap, descripcion FROM apex_admin_persistencia
WHERE categoria = \'T\' ORDER BY 2 DESC;', '4', 'Tipo de persistencia', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1259', 'ap_archivo', 'ef_popup', 'ap_archivo', NULL, 'tamano: 60;
maximo: 80;
item_destino: /admin/objetos_toba/selector_archivo;
ventana: 400,400,yes;
editable: 1;', '6', 'Archivo', NULL, 'Seleccionar un archivo PHP.', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1260', 'ap_clase', 'ef_editable', 'ap_clase', NULL, 'tamano: 40;
maximo: 80;', '5', 'Subclase', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1261', 'max_filas', 'ef_editable_numero', 'max_registros', NULL, NULL, '1', 'Max. Filas', NULL, NULL, NULL, '1', NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1262', 'min_filas', 'ef_editable_numero', 'min_registros', NULL, NULL, '2', 'Min. Filas', NULL, NULL, NULL, '1', NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '1263', 'tabla', 'ef_editable', 'tabla', '1', 'tamano: 40;
maximo: 120;', '3', 'Tabla', NULL, 'Nombre de la tabla de la base de datos con la que va a trabajar el objeto.', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('admin', '1397', '4237', 'modificar_claves', 'ef_checkbox', 'modificar_claves', NULL, 'valor: 1;
valor_no_seteado: 0;
estado: 0;', '7', 'Permitir mod. claves', NULL, 'Por defecto las columnas marcadas como claves primarias de un tabla no son modificables.', NULL, NULL, NULL, '0');
