<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class toba_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static $clases = array(
		'toba_carpeta_menu' => 'contrib/catalogo_items_menu/toba_carpeta_menu.php',
		'toba_catalogo_items_menu' => 'contrib/catalogo_items_menu/toba_catalogo_items_menu.php',
		'toba_item_menu' => 'contrib/catalogo_items_menu/toba_item_menu.php',
		'toba_manejador_procesos' => 'contrib/lib/toba_manejador_procesos.php',
		'toba_nodo_basico' => 'contrib/lib/toba_nodo_basico.php',
		'toba_nodo_form_basico' => 'contrib/lib/toba_nodo_basico.php',
		'toba_db' => 'lib/db/toba_db.php',
		'toba_db_informix' => 'lib/db/toba_db_informix.php',
		'toba_db_mysql' => 'lib/db/toba_db_mysql.php',
		'toba_db_odbc' => 'lib/db/toba_db_odbc.php',
		'toba_db_postgres7' => 'lib/db/toba_db_postgres7.php',
		'toba_db_sqlserver' => 'lib/db/toba_db_sqlserver.php',
		'toba_parser_error_db' => 'lib/db/toba_parser_error_db.php',
		'toba_parser_error_db_postgres7' => 'lib/db/toba_parser_error_db_postgres7.php',
		'toba_pm_a_registro' => 'lib/puntos_montaje/toba_pm_a_registro.php',
		'toba_punto_montaje' => 'lib/puntos_montaje/toba_punto_montaje.php',
		'toba_punto_montaje_autoload' => 'lib/puntos_montaje/toba_punto_montaje_autoload.php',
		'toba_punto_montaje_factory' => 'lib/puntos_montaje/toba_punto_montaje_factory.php',
		'toba_punto_montaje_pers' => 'lib/puntos_montaje/toba_punto_montaje_pers.php',
		'toba_punto_montaje_proyecto' => 'lib/puntos_montaje/toba_punto_montaje_proyecto.php',
		'toba_archivo_php' => 'lib/reflexion/toba_archivo_php.php',
		'toba_clase_datos' => 'lib/reflexion/toba_clase_datos.php',
		'toba_clase_php' => 'lib/reflexion/toba_clase_php.php',
		'toba_registro_conflicto' => 'lib/registro/conflictos/toba_registro_conflicto.php',
		'toba_registro_conflicto_constraints' => 'lib/registro/conflictos/toba_registro_conflicto_constraints.php',
		'toba_registro_conflicto_inexistente' => 'lib/registro/conflictos/toba_registro_conflicto_inexistente.php',
		'toba_registro_conflicto_tabla_inexistente' => 'lib/registro/conflictos/toba_registro_conflicto_tabla_inexistente.php',
		'toba_registro_conflicto_univoco' => 'lib/registro/conflictos/toba_registro_conflicto_univoco.php',
		'toba_registro_conflicto_valor_original' => 'lib/registro/conflictos/toba_registro_conflicto_valor_original.php',
		'convertible_registro' => 'lib/registro/convertible_registro.php',
		'toba_registro' => 'lib/registro/toba_registro.php',
		'toba_registro_con_clave' => 'lib/registro/toba_registro_con_clave.php',
		'toba_registro_delete' => 'lib/registro/toba_registro_delete.php',
		'toba_registro_insert' => 'lib/registro/toba_registro_insert.php',
		'toba_registro_update' => 'lib/registro/toba_registro_update.php',
		'toba_registro_xml_factory' => 'lib/registro/toba_registro_xml_factory.php',
		'toba_asercion' => 'lib/toba_asercion.php',
		'toba_cache_db' => 'lib/toba_cache_db.php',
		'toba_editor_texto' => 'lib/toba_editor_archivos.php',
		'toba_editor_archivos' => 'lib/toba_editor_archivos.php',
		'toba_encriptador' => 'lib/toba_encriptador.php',
		'toba_extractor_clases' => 'lib/toba_extractor_clases.php',
		'toba_fecha' => 'lib/toba_fecha.php',
		'toba_ini' => 'lib/toba_ini.php',
		'toba_manejador_archivos' => 'lib/toba_manejador_archivos.php',
		'toba_sincronizador_archivos' => 'lib/toba_sincronizador_archivos.php',
		'toba_svn' => 'lib/toba_svn.php',
		'toba_texto' => 'lib/toba_texto.php',
		'toba_validaciones' => 'lib/toba_validaciones.php',
		'toba_manejador_tabs' => 'lib/toba_varios.php',
		'toba_objeto_de_mentira' => 'lib/toba_varios.php',
		'toba_xml' => 'lib/toba_xml.php',
		'toba_xml_tablas' => 'lib/toba_xml_tablas.php',
		'toba_aplicacion_comando' => 'modelo/aplicacion/toba_aplicacion_comando.php',
		'toba_aplicacion_comando_base' => 'modelo/aplicacion/toba_aplicacion_comando_base.php',
		'toba_aplicacion_modelo' => 'modelo/aplicacion/toba_aplicacion_modelo.php',
		'toba_aplicacion_modelo_base' => 'modelo/aplicacion/toba_aplicacion_modelo_base.php',
		'toba_asistente' => 'modelo/asistentes/toba_asistente.php',
		'toba_asistente_1dt' => 'modelo/asistentes/toba_asistente_1dt.php',
		'toba_asistente_abms' => 'modelo/asistentes/toba_asistente_abms.php',
		'toba_asistente_adhoc' => 'modelo/asistentes/toba_asistente_adhoc.php',
		'toba_asistente_grilla' => 'modelo/asistentes/toba_asistente_grilla.php',
		'toba_asistente_importacion' => 'modelo/asistentes/toba_asistente_importacion.php',
		'toba_catalogo_asistentes' => 'modelo/asistentes/toba_catalogo_asistentes.php',
		'toba_db_catalogo_general' => 'modelo/estructura_db/toba_db_catalogo_general.php',
		'toba_db_secuencias' => 'modelo/estructura_db/toba_db_secuencias.php',
		'toba_db_tablas_componente' => 'modelo/estructura_db/toba_db_tablas_componente.php',
		'toba_db_tablas_instancia' => 'modelo/estructura_db/toba_db_tablas_instancia.php',
		'toba_db_tablas_nucleo' => 'modelo/estructura_db/toba_db_tablas_nucleo.php',
		'toba_db_tablas_proyecto' => 'modelo/estructura_db/toba_db_tablas_proyecto.php',
		'toba_ap_relacion_db_info' => 'modelo/info/componentes/toba_ap_relacion_db_info.php',
		'toba_ap_tabla_db_info' => 'modelo/info/componentes/toba_ap_tabla_db_info.php',
		'toba_ci_info' => 'modelo/info/componentes/toba_ci_info.php',
		'toba_ci_pantalla_info' => 'modelo/info/componentes/toba_ci_pantalla_info.php',
		'toba_cn_info' => 'modelo/info/componentes/toba_cn_info.php',
		'toba_componente_info' => 'modelo/info/componentes/toba_componente_info.php',
		'toba_datos_relacion_info' => 'modelo/info/componentes/toba_datos_relacion_info.php',
		'toba_datos_tabla_info' => 'modelo/info/componentes/toba_datos_tabla_info.php',
		'toba_ei_arbol_info' => 'modelo/info/componentes/toba_ei_arbol_info.php',
		'toba_ei_archivos_info' => 'modelo/info/componentes/toba_ei_archivos_info.php',
		'toba_ei_calendario_info' => 'modelo/info/componentes/toba_ei_calendario_info.php',
		'toba_ei_codigo_info' => 'modelo/info/componentes/toba_ei_codigo_info.php',
		'toba_ei_cuadro_info' => 'modelo/info/componentes/toba_ei_cuadro_info.php',
		'toba_ei_esquema_info' => 'modelo/info/componentes/toba_ei_esquema_info.php',
		'toba_ei_filtro_info' => 'modelo/info/componentes/toba_ei_filtro_info.php',
		'toba_ei_firma_info' => 'modelo/info/componentes/toba_ei_firma_info.php',
		'toba_ei_formulario_info' => 'modelo/info/componentes/toba_ei_formulario_info.php',
		'toba_ei_formulario_ml_info' => 'modelo/info/componentes/toba_ei_formulario_ml_info.php',
		'toba_ei_grafico_info' => 'modelo/info/componentes/toba_ei_grafico_info.php',
		'toba_ei_info' => 'modelo/info/componentes/toba_ei_info.php',
		'toba_ei_mapa_info' => 'modelo/info/componentes/toba_ei_mapa_info.php',
		'toba_meta_clase' => 'modelo/info/componentes/toba_interface_meta_clase.php',
		'toba_item_info' => 'modelo/info/componentes/toba_item_info.php',
		'toba_servicio_web_info' => 'modelo/info/componentes/toba_servicio_web_info.php',
		'toba_carpeta_perfil' => 'modelo/info/componentes_perfil/toba_carpeta_perfil.php',
		'toba_elemento_perfil' => 'modelo/info/componentes_perfil/toba_elemento_perfil.php',
		'toba_item_perfil' => 'modelo/info/componentes_perfil/toba_item_perfil.php',
		'toba_rf' => 'modelo/info/componentes_perfil/toba_rf.php',
		'toba_rf_carpeta' => 'modelo/info/componentes_perfil/toba_rf_carpeta.php',
		'toba_rf_ci' => 'modelo/info/componentes_perfil/toba_rf_ci.php',
		'toba_rf_componente' => 'modelo/info/componentes_perfil/toba_rf_componente.php',
		'toba_rf_componente_cuadro' => 'modelo/info/componentes_perfil/toba_rf_componente_cuadro.php',
		'toba_rf_componente_filtro' => 'modelo/info/componentes_perfil/toba_rf_componente_filtro.php',
		'toba_rf_componente_formulario' => 'modelo/info/componentes_perfil/toba_rf_componente_formulario.php',
		'toba_rf_grupo' => 'modelo/info/componentes_perfil/toba_rf_grupo.php',
		'toba_rf_grupo_columnas' => 'modelo/info/componentes_perfil/toba_rf_grupo_columnas.php',
		'toba_rf_grupo_efs' => 'modelo/info/componentes_perfil/toba_rf_grupo_efs.php',
		'toba_rf_grupo_eventos' => 'modelo/info/componentes_perfil/toba_rf_grupo_eventos.php',
		'toba_rf_grupo_pantallas' => 'modelo/info/componentes_perfil/toba_rf_grupo_pantallas.php',
		'toba_rf_item' => 'modelo/info/componentes_perfil/toba_rf_item.php',
		'toba_rf_pantalla' => 'modelo/info/componentes_perfil/toba_rf_pantalla.php',
		'toba_rf_subcomponente' => 'modelo/info/componentes_perfil/toba_rf_subcomponente.php',
		'toba_rf_subcomponente_columna' => 'modelo/info/componentes_perfil/toba_rf_subcomponente_columna.php',
		'toba_rf_subcomponente_ef' => 'modelo/info/componentes_perfil/toba_rf_subcomponente_ef.php',
		'toba_rf_subcomponente_evento' => 'modelo/info/componentes_perfil/toba_rf_subcomponente_evento.php',
		'toba_rf_subcomponente_filtro_col' => 'modelo/info/componentes_perfil/toba_rf_subcomponente_filtro_col.php',
		'toba_catalogo_items' => 'modelo/info/toba_catalogo_items.php',
		'toba_catalogo_items_base' => 'modelo/info/toba_catalogo_items_base.php',
		'toba_catalogo_items_perfil' => 'modelo/info/toba_catalogo_items_perfil.php',
		'toba_catalogo_objetos' => 'modelo/info/toba_catalogo_objetos.php',
		'toba_catalogo_restricciones_funcionales' => 'modelo/info/toba_catalogo_restricciones_funcionales.php',
		'toba_contexto_info' => 'modelo/info/toba_contexto_info.php',
		'toba_datos_editores' => 'modelo/info/toba_datos_editores.php',
		'toba_info_editores' => 'modelo/info/toba_info_editores.php',
		'toba_info_instancia' => 'modelo/info/toba_info_instancia.php',
		'toba_info_permisos' => 'modelo/info/toba_info_permisos.php',
		'toba_contexto_ejecucion_info' => 'modelo/info/transversales/toba_contexto_ejecucion_info.php',
		'toba_elemento_transversal_info' => 'modelo/info/transversales/toba_elemento_transversal_info.php',
		'toba_sesion_info' => 'modelo/info/transversales/toba_sesion_info.php',
		'toba_tipo_pagina_info' => 'modelo/info/transversales/toba_tipo_pagina_info.php',
		'toba_usuario_info' => 'modelo/info/transversales/toba_usuario_info.php',
		'toba_zona_info' => 'modelo/info/transversales/toba_zona_info.php',
		'toba_test' => 'modelo/lib/testing_unitario/toba_test.php',
		'EqualArrayExpectation' => 'modelo/lib/testing_unitario/toba_test.php',
		'toba_test_grupo_casos' => 'modelo/lib/testing_unitario/toba_test_grupo_casos.php',
		'toba_test_lista_casos' => 'modelo/lib/testing_unitario/toba_test_lista_casos.php',
		'toba_test_runner' => 'modelo/lib/testing_unitario/toba_test_runner.php',
		'toba_analizador_logger_fs' => 'modelo/lib/toba_analizador_logger.php',
		'toba_auditoria_tablas_postgres' => 'modelo/lib/toba_auditoria_tablas_postgres.php',
		'toba_estandar_convenciones' => 'modelo/lib/toba_estandar_convenciones.php',
		'toba_modelo_elemento' => 'modelo/lib/toba_modelo_elemento.php',
		'toba_error_modelo' => 'modelo/lib/toba_modelo_error.php',
		'toba_error_modelo_preexiste' => 'modelo/lib/toba_modelo_error.php',
		'toba_error_asistentes' => 'modelo/lib/toba_modelo_error.php',
		'toba_modelo_operacion' => 'modelo/lib/toba_modelo_operacion.php',
		'toba_proceso_gui' => 'modelo/lib/toba_proceso_gui.php',
		'toba_mock_proceso_gui' => 'modelo/lib/toba_proceso_gui.php',
		'toba_testing_selenium' => 'modelo/lib/toba_testing_selenium.php',
		'toba_version' => 'modelo/lib/toba_version.php',
		'toba_migracion_2_2_0' => 'modelo/migraciones_instancia/toba_migracion_2_2_0.php',
		'toba_migracion_2_4_0' => 'modelo/migraciones_instancia/toba_migracion_2_4_0.php',
		'toba_codigo_clase' => 'modelo/moldes_codigo/toba_codigo_clase.php',
		'toba_codigo_elemento' => 'modelo/moldes_codigo/toba_codigo_elemento.php',
		'toba_codigo_metodo' => 'modelo/moldes_codigo/toba_codigo_metodo.php',
		'toba_codigo_metodo_js' => 'modelo/moldes_codigo/toba_codigo_metodo_js.php',
		'toba_codigo_metodo_php' => 'modelo/moldes_codigo/toba_codigo_metodo_php.php',
		'toba_codigo_propiedad_php' => 'modelo/moldes_codigo/toba_codigo_propiedad_php.php',
		'toba_codigo_separador' => 'modelo/moldes_codigo/toba_codigo_separador.php',
		'toba_codigo_separador_js' => 'modelo/moldes_codigo/toba_codigo_separador_js.php',
		'toba_codigo_separador_php' => 'modelo/moldes_codigo/toba_codigo_separador_php.php',
		'toba_ci_molde' => 'modelo/moldes_metadatos/toba_ci_molde.php',
		'toba_datos_relacion_molde' => 'modelo/moldes_metadatos/toba_datos_relacion_molde.php',
		'toba_datos_tabla_molde' => 'modelo/moldes_metadatos/toba_datos_tabla_molde.php',
		'toba_ei_cuadro_molde' => 'modelo/moldes_metadatos/toba_ei_cuadro_molde.php',
		'toba_ei_filtro_molde' => 'modelo/moldes_metadatos/toba_ei_filtro_molde.php',
		'toba_ei_formulario_ml_molde' => 'modelo/moldes_metadatos/toba_ei_formulario_ml_molde.php',
		'toba_ei_formulario_molde' => 'modelo/moldes_metadatos/toba_ei_formulario_molde.php',
		'toba_item_molde' => 'modelo/moldes_metadatos/toba_item_molde.php',
		'toba_molde_cuadro_col' => 'modelo/moldes_metadatos/toba_molde_cuadro_col.php',
		'toba_molde_datos_tabla_col' => 'modelo/moldes_metadatos/toba_molde_datos_tabla_col.php',
		'toba_molde_ef' => 'modelo/moldes_metadatos/toba_molde_ef.php',
		'toba_molde_elemento' => 'modelo/moldes_metadatos/toba_molde_elemento.php',
		'toba_molde_elemento_componente' => 'modelo/moldes_metadatos/toba_molde_elemento_componente.php',
		'toba_molde_elemento_componente_datos' => 'modelo/moldes_metadatos/toba_molde_elemento_componente_datos.php',
		'toba_molde_elemento_componente_ei' => 'modelo/moldes_metadatos/toba_molde_elemento_componente_ei.php',
		'toba_molde_evento' => 'modelo/moldes_metadatos/toba_molde_evento.php',
		'toba_molde_tipo_pagina' => 'modelo/moldes_metadatos/toba_molde_tipo_pagina.php',
		'toba_molde_zona' => 'modelo/moldes_metadatos/toba_molde_zona.php',
		'toba_importador_plan' => 'modelo/personalizacion/importador/plan/toba_importador_plan.php',
		'toba_importador_plan_item' => 'modelo/personalizacion/importador/plan/toba_importador_plan_item.php',
		'toba_tarea_componente' => 'modelo/personalizacion/importador/tarea/toba_tarea_componente.php',
		'toba_tarea_datos' => 'modelo/personalizacion/importador/tarea/toba_tarea_datos.php',
		'toba_tarea_pers' => 'modelo/personalizacion/importador/tarea/toba_tarea_pers.php',
		'toba_tarea_tabla' => 'modelo/personalizacion/importador/tarea/toba_tarea_tabla.php',
		'toba_importador' => 'modelo/personalizacion/importador/toba_importador.php',
		'toba_importador_componentes' => 'modelo/personalizacion/importador/toba_importador_componentes.php',
		'toba_importador_tablas' => 'modelo/personalizacion/importador/toba_importador_tablas.php',
		'toba_recuperador' => 'modelo/personalizacion/recuperador/toba_recuperador.php',
		'toba_recuperador_componentes' => 'modelo/personalizacion/recuperador/toba_recuperador_componentes.php',
		'toba_recuperador_data' => 'modelo/personalizacion/recuperador/toba_recuperador_data.php',
		'toba_recuperador_tablas' => 'modelo/personalizacion/recuperador/toba_recuperador_tablas.php',
		'toba_recuperador_utildb_componentes' => 'modelo/personalizacion/recuperador/toba_recuperador_utildb_componentes.php',
		'toba_recuperador_utildb_tablas' => 'modelo/personalizacion/recuperador/toba_recuperador_utildb_tablas.php',
		'agrego_tabla_relacion' => 'modelo/personalizacion/testing/caso/agrego_tabla_relacion.php',
		'tester_caso' => 'modelo/personalizacion/testing/caso/caso.php',
		'tester_caso_modifpantalla' => 'modelo/personalizacion/testing/caso/modifpantalla.php',
		'tester_caso_nuevoform' => 'modelo/personalizacion/testing/caso/nuevoform.php',
		'tester_caso_nuevoformml' => 'modelo/personalizacion/testing/caso/nuevoformml.php',
		'tester_caso_nuevoitem' => 'modelo/personalizacion/testing/caso/nuevoitem.php',
		'toba_pers_caso_test' => 'modelo/personalizacion/testing/toba_pers_caso_test.php',
		'toba_personalizacion' => 'modelo/personalizacion/toba_personalizacion.php',
		'toba_registro_conflictos' => 'modelo/personalizacion/toba_registro_conflictos.php',
		'toba_pers_xml_atributos' => 'modelo/personalizacion/xml/toba_pers_xml_atributos.php',
		'toba_pers_xml_elementos' => 'modelo/personalizacion/xml/toba_pers_xml_elementos.php',
		'toba_pers_xml_generador' => 'modelo/personalizacion/xml/toba_pers_xml_generador.php',
		'toba_pers_xml_generador_componentes' => 'modelo/personalizacion/xml/toba_pers_xml_generador_componentes.php',
		'toba_pers_xml_generador_tablas' => 'modelo/personalizacion/xml/toba_pers_xml_generador_tablas.php',
		'toba_modelo_catalogo' => 'modelo/toba_modelo_catalogo.php',
		'toba_modelo_instalacion' => 'modelo/toba_modelo_instalacion.php',
		'toba_modelo_instancia' => 'modelo/toba_modelo_instancia.php',
		'toba_modelo_nucleo' => 'modelo/toba_modelo_nucleo.php',
		'toba_modelo_pms' => 'modelo/toba_modelo_pms.php',
		'toba_modelo_proyecto' => 'modelo/toba_modelo_proyecto.php',
		'toba_modelo_servicio_web' => 'modelo/toba_modelo_servicio_web.php',
		'toba_modelo_rest' => 'modelo/toba_modelo_rest.php',
		'util_modelo_proyecto' => 'modelo/util/util_modelo_proyecto.php',
		'toba_componente_definicion' => 'nucleo/componentes/definicion/_interfaces.php',
		'toba_asistente_abms_def' => 'nucleo/componentes/definicion/toba_asistente_abms_def.php',
		'toba_asistente_def' => 'nucleo/componentes/definicion/toba_asistente_def.php',
		'toba_asistente_grilla_def' => 'nucleo/componentes/definicion/toba_asistente_grilla_def.php',
		'toba_asistente_importacion_def' => 'nucleo/componentes/definicion/toba_asistente_importacion_def.php',
		'toba_ci_def' => 'nucleo/componentes/definicion/toba_ci_def.php',
		'toba_cn_def' => 'nucleo/componentes/definicion/toba_cn_def.php',
		'toba_componente_def' => 'nucleo/componentes/definicion/toba_componente_def.php',
		'toba_datos_relacion_def' => 'nucleo/componentes/definicion/toba_datos_relacion_def.php',
		'toba_datos_tabla_def' => 'nucleo/componentes/definicion/toba_datos_tabla_def.php',
		'toba_ei_arbol_def' => 'nucleo/componentes/definicion/toba_ei_arbol_def.php',
		'toba_ei_archivos_def' => 'nucleo/componentes/definicion/toba_ei_archivos_def.php',
		'toba_ei_calendario_def' => 'nucleo/componentes/definicion/toba_ei_calendario_def.php',
		'toba_ei_codigo_def' => 'nucleo/componentes/definicion/toba_ei_codigo_def.php',
		'toba_ei_cuadro_def' => 'nucleo/componentes/definicion/toba_ei_cuadro_def.php',
		'toba_ei_def' => 'nucleo/componentes/definicion/toba_ei_def.php',
		'toba_ei_esquema_def' => 'nucleo/componentes/definicion/toba_ei_esquema_def.php',
		'toba_ei_filtro_def' => 'nucleo/componentes/definicion/toba_ei_filtro_def.php',
		'toba_ei_firma_def' => 'nucleo/componentes/definicion/toba_ei_firma_def.php',
		'toba_ei_formulario_def' => 'nucleo/componentes/definicion/toba_ei_formulario_def.php',
		'toba_ei_formulario_ml_def' => 'nucleo/componentes/definicion/toba_ei_formulario_ml_def.php',
		'toba_ei_grafico_def' => 'nucleo/componentes/definicion/toba_ei_grafico_def.php',
		'toba_ei_mapa_def' => 'nucleo/componentes/definicion/toba_ei_mapa_def.php',
		'toba_item_def' => 'nucleo/componentes/definicion/toba_item_def.php',
		'toba_item_perfil_def' => 'nucleo/componentes/definicion/toba_item_perfil_def.php',
		'toba_servicio_web_def' => 'nucleo/componentes/definicion/toba_servicio_web_def.php',
		'toba_boton' => 'nucleo/componentes/interface/botones/toba_boton.php',
		'toba_evento_usuario' => 'nucleo/componentes/interface/botones/toba_evento_usuario.php',
		'toba_tab' => 'nucleo/componentes/interface/botones/toba_tab.php',
		'toba_carga_opciones_ef' => 'nucleo/componentes/interface/efs/toba_carga_opciones_ef.php',
		'toba_ef' => 'nucleo/componentes/interface/efs/toba_ef.php',
		'toba_ef_cbu' => 'nucleo/componentes/interface/efs/toba_ef_cbu.php',
		'toba_ef_seleccion' => 'nucleo/componentes/interface/efs/toba_ef_combo.php',
		'toba_ef_combo' => 'nucleo/componentes/interface/efs/toba_ef_combo.php',
		'toba_ef_radio' => 'nucleo/componentes/interface/efs/toba_ef_combo.php',
		'toba_ef_combo_editable' => 'nucleo/componentes/interface/efs/toba_ef_combo_editable.php',
		'toba_ef_cuit' => 'nucleo/componentes/interface/efs/toba_ef_cuit.php',
		'toba_callback_errores_validacion' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_numero' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_moneda' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_numero_porcentaje' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_clave' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_fecha' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_fecha_hora' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_hora' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_textarea' => 'nucleo/componentes/interface/efs/toba_ef_editable.php',
		'toba_ef_editable_captcha' => 'nucleo/componentes/interface/efs/toba_ef_editable_captcha.php',
		'toba_ef_multi_seleccion' => 'nucleo/componentes/interface/efs/toba_ef_multi_seleccion.php',
		'toba_ef_multi_seleccion_lista' => 'nucleo/componentes/interface/efs/toba_ef_multi_seleccion.php',
		'toba_ef_multi_seleccion_check' => 'nucleo/componentes/interface/efs/toba_ef_multi_seleccion.php',
		'toba_ef_multi_seleccion_doble' => 'nucleo/componentes/interface/efs/toba_ef_multi_seleccion.php',
		'toba_ef_oculto' => 'nucleo/componentes/interface/efs/toba_ef_oculto.php',
		'toba_ef_oculto_usuario' => 'nucleo/componentes/interface/efs/toba_ef_oculto.php',
		'toba_ef_popup' => 'nucleo/componentes/interface/efs/toba_ef_popup.php',
		'toba_ef_sin_estado' => 'nucleo/componentes/interface/efs/toba_ef_sin_estado.php',
		'toba_ef_barra_divisora' => 'nucleo/componentes/interface/efs/toba_ef_sin_estado.php',
		'toba_ef_fieldset' => 'nucleo/componentes/interface/efs/toba_ef_sin_estado.php',
		'toba_ef_upload' => 'nucleo/componentes/interface/efs/toba_ef_upload.php',
		'toba_ef_checkbox' => 'nucleo/componentes/interface/efs/toba_ef_varios.php',
		'toba_ef_fijo' => 'nucleo/componentes/interface/efs/toba_ef_varios.php',
		'toba_ef_html' => 'nucleo/componentes/interface/efs/toba_ef_varios.php',
		'toba_filtro_columna' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna.php',
		'toba_filtro_columna_booleano' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_booleano.php',
		'toba_filtro_columna_cadena' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_cadena.php',
		'toba_filtro_columna_compuesta' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_compuesta.php',
		'toba_filtro_columna_fecha' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_fecha.php',
		'toba_filtro_columna_fecha_hora' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_fecha_hora.php',
		'toba_filtro_columna_hora' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_hora.php',
		'toba_filtro_columna_numero' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_numero.php',
		'toba_filtro_columna_opciones' => 'nucleo/componentes/interface/filtro_columnas/toba_filtro_columna_opciones.php',
		'toba_filtro_condicion' => 'nucleo/componentes/interface/filtro_condiciones/toba_filtro_condicion.php',
		'toba_filtro_condicion_entre' => 'nucleo/componentes/interface/filtro_condiciones/toba_filtro_condicion_entre.php',
		'toba_filtro_condicion_multi' => 'nucleo/componentes/interface/filtro_condiciones/toba_filtro_condicion_multi.php',
		'toba_filtro_condicion_negativa' => 'nucleo/componentes/interface/filtro_condiciones/toba_filtro_condicion_negativa.php',
		'toba_nodo_arbol' => 'nucleo/componentes/interface/interfaces.php',
		'toba_nodo_arbol_form' => 'nucleo/componentes/interface/interfaces.php',
		'toba_ef_icono_utileria' => 'nucleo/componentes/interface/interfaces.php',
		'toba_valida_datos' => 'nucleo/componentes/interface/interfaces.php',
		'toba_ci' => 'nucleo/componentes/interface/toba_ci.php',
		'toba_ei' => 'nucleo/componentes/interface/toba_ei.php',
		'toba_ei_arbol' => 'nucleo/componentes/interface/toba_ei_arbol.php',
		'toba_ei_archivos' => 'nucleo/componentes/interface/toba_ei_archivos.php',
		'toba_ei_calendario' => 'nucleo/componentes/interface/toba_ei_calendario.php',
		'calendario' => 'nucleo/componentes/interface/toba_ei_calendario.php',
		'toba_ei_codigo' => 'nucleo/componentes/interface/toba_ei_codigo.php',
		'toba_ei_cuadro' => 'nucleo/componentes/interface/toba_ei_cuadro.php',
		'toba_ei_cuadro_salida' => 'nucleo/componentes/interface/toba_ei_cuadro_salida.php',
		'toba_ei_cuadro_salida_excel' => 'nucleo/componentes/interface/toba_ei_cuadro_salida_excel.php',
		'toba_ei_cuadro_salida_html' => 'nucleo/componentes/interface/toba_ei_cuadro_salida_html.php',
		'toba_ei_cuadro_salida_impresion_html' => 'nucleo/componentes/interface/toba_ei_cuadro_salida_impresion_html.php',
		'toba_ei_cuadro_salida_pdf' => 'nucleo/componentes/interface/toba_ei_cuadro_salida_pdf.php',
		'toba_ei_cuadro_salida_xml' => 'nucleo/componentes/interface/toba_ei_cuadro_salida_xml.php',
		'toba_ei_esquema' => 'nucleo/componentes/interface/toba_ei_esquema.php',
		'toba_ei_filtro' => 'nucleo/componentes/interface/toba_ei_filtro.php',
		'toba_ei_firma' => 'nucleo/componentes/interface/toba_ei_firma.php',
		'toba_ei_formulario' => 'nucleo/componentes/interface/toba_ei_formulario.php',
		'toba_ei_formulario_ml' => 'nucleo/componentes/interface/toba_ei_formulario_ml.php',
		'toba_ei_grafico' => 'nucleo/componentes/interface/toba_ei_grafico.php',
		'toba_ei_mapa' => 'nucleo/componentes/interface/toba_ei_mapa.php',
		'toba_ei_pantalla' => 'nucleo/componentes/interface/toba_ei_pantalla.php',
		'toba_cn' => 'nucleo/componentes/negocio/toba_cn.php',
		'toba_servicio_web' => 'nucleo/componentes/negocio/toba_servicio_web.php',
		'toba_ap_tabla' => 'nucleo/componentes/persistencia/toba_ap.php',
		'toba_ap_relacion' => 'nucleo/componentes/persistencia/toba_ap.php',
		'toba_ap_relacion_db' => 'nucleo/componentes/persistencia/toba_ap_relacion_db.php',
		'toba_ap_tabla_db' => 'nucleo/componentes/persistencia/toba_ap_tabla_db.php',
		'toba_ap_tabla_db_mt' => 'nucleo/componentes/persistencia/toba_ap_tabla_db_mt.php',
		'toba_ap_tabla_db_s' => 'nucleo/componentes/persistencia/toba_ap_tabla_db_s.php',
		'toba_datos_busqueda' => 'nucleo/componentes/persistencia/toba_datos_busqueda.php',
		'toba_datos_relacion' => 'nucleo/componentes/persistencia/toba_datos_relacion.php',
		'toba_datos_tabla' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
		'toba_relacion_entre_tablas' => 'nucleo/componentes/persistencia/toba_relacion_entre_tablas.php',
		'toba_tipo_datos' => 'nucleo/componentes/persistencia/toba_tipo_datos.php',
		'toba_cargador' => 'nucleo/componentes/toba_cargador.php',
		'toba_componente' => 'nucleo/componentes/toba_componente.php',
		'toba_constructor' => 'nucleo/componentes/toba_constructor.php',
		'toba_ei_grafico_conf' => 'nucleo/lib/interface/toba_ei_grafico/toba_ei_grafico_conf.php',
		'toba_ei_grafico_conf_barras' => 'nucleo/lib/interface/toba_ei_grafico/toba_ei_grafico_conf_barras.php',
		'toba_ei_grafico_conf_especifico' => 'nucleo/lib/interface/toba_ei_grafico/toba_ei_grafico_conf_especifico.php',
		'toba_ei_grafico_conf_lineas' => 'nucleo/lib/interface/toba_ei_grafico/toba_ei_grafico_conf_lineas.php',
		'toba_ei_grafico_conf_torta' => 'nucleo/lib/interface/toba_ei_grafico/toba_ei_grafico_conf_torta.php',
		'toba_form' => 'nucleo/lib/interface/toba_form.php',
		'toba_formateo' => 'nucleo/lib/interface/toba_formateo.php',
		'toba_imagen_captcha' => 'nucleo/lib/salidas/toba_imagen_captcha.php',
		'toba_impr_html' => 'nucleo/lib/salidas/toba_impr_html.php',
		'toba_impresion' => 'nucleo/lib/salidas/toba_impresion.php',
		'toba_vista_excel' => 'nucleo/lib/salidas/toba_vista_excel.php',
		'toba_vista_jasperreports' => 'nucleo/lib/salidas/toba_vista_jasperreports.php',
		'toba_vista_pdf' => 'nucleo/lib/salidas/toba_vista_pdf.php',
		'toba_vista_xml' => 'nucleo/lib/salidas/toba_vista_xml.php',
		'toba_vista_xslfo' => 'nucleo/lib/salidas/toba_vista_xslfo.php',
		'toba_vista_xslfo_callback_generacion' => 'nucleo/lib/salidas/toba_vista_xslfo_callback_generacion.php',
		'toba_acciones_js' => 'nucleo/lib/toba_acciones_js.php',
		'toba_admin_fuentes' => 'nucleo/lib/toba_admin_fuentes.php',
		'toba_ajax_respuesta' => 'nucleo/lib/toba_ajax_respuesta.php',
		'toba_autenticable' => 'nucleo/lib/toba_autenticable.php',
		'toba_autenticacion_basica' => 'nucleo/lib/toba_autenticacion_basica.php',
		'toba_autenticacion_cas' => 'nucleo/lib/toba_autenticacion_cas.php',
		'toba_autenticacion_ldap' => 'nucleo/lib/toba_autenticacion_ldap.php',
		'toba_autenticacion_openid' => 'nucleo/lib/toba_autenticacion_openid.php',
		'toba_autenticacion_saml' => 'nucleo/lib/toba_autenticacion_saml.php',
		'toba_contenedor_gadgets' => 'nucleo/lib/toba_contenedor_gadgets.php',
		'toba_contexto_ejecucion' => 'nucleo/lib/toba_contexto_ejecucion.php',
		'toba_cronometro' => 'nucleo/lib/toba_cronometro.php',
		'toba_dba' => 'nucleo/lib/toba_dba.php',
		'toba_derechos' => 'nucleo/lib/toba_derechos.php',
		'toba_editor' => 'nucleo/lib/toba_editor.php',
		'toba_error' => 'nucleo/lib/toba_error.php',
		'toba_error_db' => 'nucleo/lib/toba_error.php',
		'toba_error_usuario' => 'nucleo/lib/toba_error.php',
		'toba_error_def' => 'nucleo/lib/toba_error.php',
		'toba_error_permisos' => 'nucleo/lib/toba_error.php',
		'toba_error_autenticacion' => 'nucleo/lib/toba_error.php',
		'toba_error_autenticacion_intentos' => 'nucleo/lib/toba_error.php',
		'toba_error_login_contrasenia_vencida' => 'nucleo/lib/toba_error.php',
		'toba_error_pwd_conformacion_invalida' => 'nucleo/lib/toba_error.php',
		'toba_error_autorizacion' => 'nucleo/lib/toba_error.php',
		'toba_error_seguridad' => 'nucleo/lib/toba_error.php',
		'toba_error_validacion' => 'nucleo/lib/toba_error.php',
		'toba_error_ini_sesion' => 'nucleo/lib/toba_error.php',
		'toba_error_comunicacion' => 'nucleo/lib/toba_error.php',
		'toba_reset_nucleo' => 'nucleo/lib/toba_error.php',
		'toba_error_servicio_web' => 'nucleo/lib/toba_error.php',
		'toba_error_firma_digital' => 'nucleo/lib/toba_error.php',
		'toba_firma_digital' => 'nucleo/lib/toba_firma_digital.php',
		'toba_fuente_datos' => 'nucleo/lib/toba_fuente_datos.php',
		'toba_gadget' => 'nucleo/lib/toba_gadget.php',
		'toba_gadget_shindig' => 'nucleo/lib/toba_gadget_shindig.php',
		'toba_hash' => 'nucleo/lib/toba_hash.php',
		'toba_http' => 'nucleo/lib/toba_http.php',
		'toba_rest' => 'nucleo/lib/toba_rest.php',
		'toba_info_relacion_entre_tablas' => 'nucleo/lib/toba_info_relacion_entre_tablas.php',
		'toba_instalacion' => 'nucleo/lib/toba_instalacion.php',
		'toba_instancia' => 'nucleo/lib/toba_instancia.php',
		'toba_interface_contexto_ejecucion' => 'nucleo/lib/toba_interface_contexto_ejecucion.php',
		'toba_interface_sesion' => 'nucleo/lib/toba_interface_sesion.php',
		'toba_interface_usuario' => 'nucleo/lib/toba_interface_usuario.php',
		'toba_js' => 'nucleo/lib/toba_js.php',
		'toba_logger' => 'nucleo/lib/toba_logger.php',
		'toba_logger_ws' => 'nucleo/lib/toba_logger_ws.php',
		'toba_mail' => 'nucleo/lib/toba_mail.php',
		'toba_manejador_sesiones' => 'nucleo/lib/toba_manejador_sesiones.php',
		'toba_memoria' => 'nucleo/lib/toba_memoria.php',
		'toba_mensajes' => 'nucleo/lib/toba_mensajes.php',
		'toba_notificacion' => 'nucleo/lib/toba_notificacion.php',
		'toba_parser_ayuda' => 'nucleo/lib/toba_parser_ayuda.php',
		'toba_perfil_datos' => 'nucleo/lib/toba_perfil_datos.php',
		'toba_perfil_funcional' => 'nucleo/lib/toba_perfil_funcional.php',
		'toba_planificador_tareas' => 'nucleo/lib/toba_planificador_tareas.php',
		'toba_pms' => 'nucleo/lib/toba_pms.php',
		'toba_proyecto' => 'nucleo/lib/toba_proyecto.php',
		'toba_proyecto_db' => 'nucleo/lib/toba_proyecto_db.php',
		'toba_proyecto_implementacion' => 'nucleo/lib/toba_proyecto_implementacion.php',
		'toba_control' => 'nucleo/lib/toba_puntos_control.php',
		'toba_puntos_control' => 'nucleo/lib/toba_puntos_control.php',
		'toba_recurso' => 'nucleo/lib/toba_recurso.php',
		'toba_serializar_propiedades' => 'nucleo/lib/toba_serializar_propiedades.php',
		'toba_servicio_web_cliente' => 'nucleo/lib/toba_servicio_web_cliente.php',
		'toba_servicio_web_cliente_soap' => 'nucleo/lib/toba_servicio_web_cliente_soap.php',
		'toba_servicio_web_cliente_rest' => 'nucleo/lib/toba_servicio_web_cliente_rest.php',		
		'toba_servicio_web_mensaje' => 'nucleo/lib/toba_servicio_web_mensaje.php',
		'toba_sesion' => 'nucleo/lib/toba_sesion.php',
		'toba_tarea' => 'nucleo/lib/toba_tarea.php',
		'toba_tarea_php' => 'nucleo/lib/toba_tarea.php',
		'toba_test_reporter' => 'nucleo/lib/toba_test_reporter.php',
		'toba_usuario' => 'nucleo/lib/toba_usuario.php',
		'toba_usuario_anonimo' => 'nucleo/lib/toba_usuario_anonimo.php',
		'toba_usuario_basico' => 'nucleo/lib/toba_usuario_basico.php',
		'toba_usuario_no_autenticado' => 'nucleo/lib/toba_usuario_no_autenticado.php',
		'toba_vinculador' => 'nucleo/lib/toba_vinculador.php',
		'toba_vinculo' => 'nucleo/lib/toba_vinculo.php',
		'toba_zona' => 'nucleo/lib/toba_zona.php',
		'toba_menu' => 'nucleo/menu/toba_menu.php',
		'toba_menu_css' => 'nucleo/menu/toba_menu_css.php',
		'toba_menu_libmenu' => 'nucleo/menu/toba_menu_libmenu.php',
		'toba_menu_yui' => 'nucleo/menu/toba_menu_yui.php',
		'toba_tipo_pagina' => 'nucleo/tipo_pagina/toba_tipo_pagina.php',
		'toba_tp_basico' => 'nucleo/tipo_pagina/toba_tp_basico.php',
		'toba_tp_basico_titulo' => 'nucleo/tipo_pagina/toba_tp_basico_titulo.php',
		'toba_tp_logon' => 'nucleo/tipo_pagina/toba_tp_logon.php',
		'toba_tp_normal' => 'nucleo/tipo_pagina/toba_tp_normal.php',
		'toba_tp_popup' => 'nucleo/tipo_pagina/toba_tp_popup.php',
		'toba' => 'nucleo/toba.php',
		'toba_configuracion' => 'nucleo/toba_configuracion.php',
		'toba_nucleo' => 'nucleo/toba_nucleo.php',
		'toba_solicitud' => 'nucleo/toba_solicitud.php',
		'toba_solicitud_accion' => 'nucleo/toba_solicitud_accion.php',
		'toba_solicitud_consola' => 'nucleo/toba_solicitud_consola.php',
		'toba_solicitud_servicio_web' => 'nucleo/toba_solicitud_servicio_web.php',
		'toba_solicitud_web' => 'nucleo/toba_solicitud_web.php',
		'toba_autoload' => 'toba_autoload.php',
		'Numbers_Words_es_Ar' => '3ros/Numbers_Words/Words/lang.es_AR.php',
		'phpCAS' => '3ros/phpCAS/CAS/CAS.php',
		'toba_migracion' => 'modelo/migraciones/toba_migracion.php',
	);
}
?>