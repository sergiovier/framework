--********************************************************************************************
--**************************************  FILTRO *****************************************
--********************************************************************************************

CREATE TABLE apex_objeto_ei_filtro_tipo_col
---------------------------------------------------------------------------------------------------
--: proyecto: toba
--: dump: nucleo_multiproyecto
--: dump_order_by: tipo_col
--: zona: central
--: desc:
--: version: 1.0
---------------------------------------------------------------------------------------------------
(	
	tipo_col						varchar(30)		NOT NULL,
	descripcion						varchar(50)		NOT NULL,
	proyecto						varchar(15)		NOT NULL,
	CONSTRAINT	"apex_ei_filtro_tipo_col_pk" 			PRIMARY KEY ("tipo_col"),
	CONSTRAINT	"apex__ei_filtro_tipo_col_fk_proyecto" 	FOREIGN KEY ("proyecto")	REFERENCES "apex_proyecto"	("proyecto") ON DELETE NO ACTION	ON	UPDATE NO ACTION DEFERRABLE INITIALLY	IMMEDIATE
);
--#################################################################################################


CREATE TABLE apex_objeto_ei_filtro
---------------------------------------------------------------------------------------------------
--: proyecto: toba
--: dump: componente
--: dump_clave_proyecto: objeto_ei_filtro_proyecto
--: dump_clave_componente: objeto_ei_filtro
--: dump_order_by: objeto_ei_filtro
--: dump_where: ( objeto_ei_filtro_proyecto = '%%' )
--: zona: objeto
--: desc:
--: historica: 0
--: version: 1.0
---------------------------------------------------------------------------------------------------
(
	objeto_ei_filtro_proyecto    	varchar(15)		NOT NULL,
	objeto_ei_filtro       			int8  			NOT NULL,
	ancho                  				varchar(10)    	NULL,	
	CONSTRAINT  "apex_ei_filtro_pk" PRIMARY KEY ("objeto_ei_filtro_proyecto", "objeto_ei_filtro"),
	CONSTRAINT  "apex_ei_filtro_fk_objeto" FOREIGN KEY ("objeto_ei_filtro", "objeto_ei_filtro_proyecto") REFERENCES "apex_objeto" ("objeto", "proyecto") ON DELETE CASCADE ON UPDATE NO ACTION DEFERRABLE INITIALLY IMMEDIATE
);
--###################################################################################################


CREATE SEQUENCE apex_objeto_ei_filtro_col_seq INCREMENT	1 MINVALUE 0 MAXVALUE 9223372036854775807	CACHE	1;
CREATE TABLE apex_objeto_ei_filtro_col
---------------------------------------------------------------------------------------------------
--: proyecto: toba
--: dump: componente
--: dump_clave_proyecto: objeto_ei_filtro_proyecto
--: dump_clave_componente: objeto_ei_filtro
--: dump_order_by: objeto_ei_filtro_col
--: dump_where: ( objeto_ei_filtro_proyecto = '%%' )
--: zona: objeto
--: desc:
--: historica: 0
--: version: 1.0
---------------------------------------------------------------------------------------------------
(
	objeto_ei_filtro_col				int8			DEFAULT nextval('"apex_objeto_ei_filtro_col_seq"'::text) NOT NULL, 
	objeto_ei_filtro            		int8			NOT NULL,
	objeto_ei_filtro_proyecto    		varchar(15)		NOT NULL,
	tipo								varchar(30)		NOT NULL,
	nombre								varchar(255)	NOT NULL,
	expresion							varchar(255)	NOT NULL,
	etiqueta							varchar(80)    	NULL,
	descripcion             			varchar        	NULL,
	obligatorio             			smallint       	NOT NULL DEFAULT 0,
	inicial								smallint		NOT NULL DEFAULT 0,		
	orden								smallint		NOT NULL DEFAULT 0,
	estado_defecto						varchar(255)	NULL,
	opciones_es_multiple				smallint		NULL,
	opciones_ef							varchar(50)		NULL,	--ef de tipo combo,radio,muti_seleccion_check, etc
	
	-- Parametros de los efs
	carga_metodo						varchar(100)	NULL,	-- carga ci
	carga_clase							varchar(100)	NULL,	-- carga estatico
	carga_include						varchar(255)	NULL,
	carga_dt							int8			NULL,	--carga datos_tabla
	carga_consulta_php					int8			NULL,	--carga consulta_php
	carga_sql							varchar			NULL,	--carga sql	
	carga_fuente						varchar(30)		NULL,
	carga_lista							varchar(255)	NULL,	--carga lista
	carga_col_clave						varchar(100)	NULL,
	carga_col_desc						varchar(100)	NULL,
	carga_permite_no_seteado	smallint		NOT NULL DEFAULT 0,
	carga_no_seteado					varchar(100)	NULL,
	carga_no_seteado_ocultar			smallint		NULL,
	edit_tamano							smallint		NULL,
	edit_maximo							smallint		NULL,
	edit_mascara						varchar(100)	NULL,
	edit_unidad							varchar(255)	NULL,
	edit_rango							varchar(100)	NULL,
	edit_expreg							varchar(255)	NULL,	
	popup_item							varchar(60)		NULL,
	popup_proyecto						varchar(15)		NULL,
	popup_editable						smallint		NULL,
	popup_ventana						varchar(50)		NULL,
	popup_carga_desc_metodo				varchar(100)	NULL,
	popup_carga_desc_clase				varchar(100)	NULL,
	popup_carga_desc_include			varchar(255)	NULL,
	popup_puede_borrar_estado			smallint 		NULL,
	check_valor_si						varchar(40)		NULL,
	check_valor_no						varchar(40)		NULL,
	check_desc_si						varchar(100)	NULL,
	check_desc_no						varchar(100)	NULL,
	selec_cant_minima					smallint		NULL,
	selec_cant_maxima					smallint		NULL,
	selec_utilidades					smallint		NULL,
	selec_tamano						smallint		NULL,
	selec_ancho							varchar(30)		NULL,
	selec_serializar					smallint		NULL,
	selec_cant_columnas					smallint		NULL,
	CONSTRAINT  "apex_ei_filtro_col_pk" PRIMARY KEY ("objeto_ei_filtro_col", "objeto_ei_filtro", "objeto_ei_filtro_proyecto"),
	CONSTRAINT  "apex_ei_filtro_col_fk_padre" FOREIGN KEY ("objeto_ei_filtro", "objeto_ei_filtro_proyecto") REFERENCES "apex_objeto_ei_filtro" ("objeto_ei_filtro", "objeto_ei_filtro_proyecto") ON DELETE CASCADE ON UPDATE NO ACTION DEFERRABLE INITIALLY IMMEDIATE,
	CONSTRAINT  "apex_ei_filtro_col_fk_tipo" FOREIGN KEY ("tipo") REFERENCES "apex_objeto_ei_filtro_tipo_col" ("tipo_col") ON DELETE CASCADE ON UPDATE NO ACTION DEFERRABLE INITIALLY IMMEDIATE,
	CONSTRAINT  "apex_ei_filtro_col_fk_ef" FOREIGN KEY ("opciones_ef") REFERENCES "apex_elemento_formulario" ("elemento_formulario") ON DELETE CASCADE ON UPDATE NO ACTION DEFERRABLE INITIALLY IMMEDIATE,
	CONSTRAINT	"apex_ei_filtro_col_fk_accion_vinculo" FOREIGN KEY ("popup_proyecto","popup_item") 	REFERENCES	"apex_item"	("proyecto","item")  ON DELETE CASCADE ON UPDATE NO ACTION DEFERRABLE INITIALLY	IMMEDIATE
);
--###################################################################################################