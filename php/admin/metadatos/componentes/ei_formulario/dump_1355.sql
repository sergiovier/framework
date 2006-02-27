------------------------------------------------------------
--[1355]--  OBJETO - General - Propiedades BASE 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '1355', NULL, '1', 'toba', 'objeto_ei_formulario', NULL, NULL, 'toba', NULL, 'OBJETO - General - Propiedades BASE', NULL, NULL, 'En esta interface se definen propiedades basicas de un objeto STANDART', 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo) VALUES ('toba', '33', '1355', 'modificacion', 'Modificacion', '1', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', NULL, NULL);
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba', '1355', 'apex_objeto', 'Caracter�sticas principales', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', '150px', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1170', 'colapsable', 'ef_checkbox', 'colapsable', NULL, 'valor: 1;
valor_info: SI;', '8', 'Colapsable', NULL, 'Indica si el objeto tiene capacidad de plegarse y desplegarse a pedido del usuario. Requiere que el objeto tenga definido t�tulo. En ejecuci�n usar el m�todo colapsar() para cambiar el estado inicial de este objeto.', '1', NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1171', 'descripcion', 'ef_editable_multilinea', 'descripcion', NULL, 'filas: 7;
columnas: 60;', '9', 'Descripcion', NULL, 'Descripcion del objeto.', '1', NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1172', 'fuente_datos', 'ef_combo_db_proyecto', 'fuente_datos_proyecto, fuente_datos', '1', 'sql: SELECT proyecto, fuente_datos, descripcion_corta  FROM apex_fuente_datos %w% ORDER BY 2;
columna_proyecto: proyecto;', '3', 'Fuente de Datos', NULL, 'Fuente de datos a la que se conecta el objeto.', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1173', 'nombre', 'ef_editable', 'nombre', '1', 'tamano: 50;
maximo: 255;', '2', 'Nombre', NULL, 'Nombre del objeto', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1174', 'subclase', 'ef_editable', 'subclase', NULL, 'tamano: 40;
maximo: 100;', '5', 'Subclase', NULL, 'Nombre de la clase. (La clase tiene que heredar el elemento de la infraestructura seleccionado y utilizar las ventanas permitidas)', NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1175', 'subclase_archivo', 'ef_popup', 'subclase_archivo', NULL, 'tamano: 60;
maximo: 80;
item_destino: /admin/objetos_toba/selector_archivo,toba;
ventana: 400,400,yes;
editable: 1;', '6', 'Subclase - Archivo', NULL, 'Archivo PHP donde reside la subclase.', NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1176', 'tipo_clase', 'ef_combo_db', 'tipo_clase', NULL, 'sql: SELECT clase_tipo, descripcion_corta FROM apex_clase_tipo;
no_seteado: --- FILTRAR ---;', '4', 'Tipo Clase', NULL, 'Esto es (por ahora) para testear cascadas', NULL, '1', NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '1177', 'titulo', 'ef_editable', 'titulo', NULL, 'tamano: 60;
maximo: 80;', '7', 'Titulo interface', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4346', 'id', 'ef_editable', 'objeto', NULL, 'tamano: 10;
solo_lectura: 1;', '1', 'ID', NULL, NULL, NULL, '1', NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4434', 'parametro_a', 'ef_editable', 'parametro_a', NULL, 'tamano: 60;
maximo: 100;', '10', 'Parametro A', NULL, NULL, '1', NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4435', 'parametro_b', 'ef_editable', 'parametro_b', NULL, 'tamano: 60;
maximo: 100;', '11', 'Parametro B', NULL, NULL, '1', NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4436', 'parametro_c', 'ef_editable', 'parametro_c', NULL, 'tamano: 60;
maximo: 100;', '12', 'Parametro C', NULL, NULL, '1', NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4437', 'parametro_d', 'ef_editable', 'parametro_d', NULL, 'tamano: 60;
maximo: 100;', '13', 'Parametro D', NULL, NULL, '1', NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1355', '4438', 'parametro_e', 'ef_editable', 'parametro_e', NULL, 'tamano: 60;
maximo: 100;', '14', 'Parametro E', NULL, NULL, '1', NULL, NULL, '0');
