------------------------------------------------------------
--[1959]--  Tipos Unidades Academicas - datos 
------------------------------------------------------------

------------------------------------------------------------
-- apex_objeto
------------------------------------------------------------

--- INICIO Grupo de desarrollo 0
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES (
	'curso', --proyecto
	'1959', --objeto
	NULL, --anterior
	NULL, --reflexivo
	'toba', --clase_proyecto
	'toba_datos_tabla', --clase
	NULL, --subclase
	NULL, --subclase_archivo
	NULL, --objeto_categoria_proyecto
	NULL, --objeto_categoria
	'Tipos Unidades Academicas - datos', --nombre
	NULL, --titulo
	NULL, --colapsable
	NULL, --descripcion
	'curso', --fuente_datos_proyecto
	'curso', --fuente_datos
	NULL, --solicitud_registrar
	NULL, --solicitud_obj_obs_tipo
	NULL, --solicitud_obj_observacion
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	NULL, --parametro_d
	NULL, --parametro_e
	NULL, --parametro_f
	NULL, --usuario
	'2007-05-16 15:14:53'  --creacion
);
--- FIN Grupo de desarrollo 0

------------------------------------------------------------
-- apex_objeto_db_registros
------------------------------------------------------------
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES (
	'curso', --objeto_proyecto
	'1959', --objeto
	NULL, --max_registros
	NULL, --min_registros
	'1', --ap
	NULL, --ap_clase
	NULL, --ap_archivo
	'soe_tiposua', --tabla
	NULL, --alias
	'0'  --modificar_claves
);

------------------------------------------------------------
-- apex_objeto_db_registros_col
------------------------------------------------------------

--- INICIO Grupo de desarrollo 0
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES (
	'curso', --objeto_proyecto
	'1959', --objeto
	'580', --col_id
	'tipoua', --columna
	'E', --tipo
	'1', --pk
	'soe_tiposua_tipoua_seq', --secuencia
	'-1', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0'  --externa
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES (
	'curso', --objeto_proyecto
	'1959', --objeto
	'581', --col_id
	'descripcion', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'50', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0'  --externa
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES (
	'curso', --objeto_proyecto
	'1959', --objeto
	'582', --col_id
	'detalle', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'255', --largo
	NULL, --no_nulo
	'0', --no_nulo_db
	'0'  --externa
);
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES (
	'curso', --objeto_proyecto
	'1959', --objeto
	'583', --col_id
	'estado', --columna
	'C', --tipo
	'0', --pk
	'', --secuencia
	'1', --largo
	NULL, --no_nulo
	'1', --no_nulo_db
	'0'  --externa
);
--- FIN Grupo de desarrollo 0