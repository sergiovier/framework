<?php

/**
* El tipo de p�gina b�sico est� pensado como clase base para las personalizaciones fuertes de la salida.
* Presenta la estructura b�sica que de la salida html del framework:
*  - Doctype
*  - Titulo de la pagina
*  - Codificacion
*  - Plantillas css
*  - Includes js b�sico
* 
* @package SalidaGrafica
*/
class toba_tp_basico extends toba_tipo_pagina
{
	protected $clase_encabezado = '';
	
	function encabezado()
	{
		$this->cabecera_html();
		$this->comienzo_cuerpo();
		$this->inicio_encabezado_html();
		$this->inicio_barra_superior();
		$this->barra_superior();//--- No se cierra el div de encabezado para dar lugar a la zona...
	}
	
	function inicio_encabezado_html(){
		toba::output()->get('PaginaBasica')->getPreEncabezadoHtml();
	}
	
	function inicio_barra_superior(){
		toba::output()->get('PaginaBasica')->getInicioBarraSuperior();
	}
	
	function post_encabezado() {
		$this->fin_barra_superior();
		$this->fin_encabezado_html();
		
	}
	
	function fin_barra_superior(){
		toba::output()->get('PaginaBasica')->getFinBarraSuperior();
	}
	
	function fin_encabezado_html(){
		toba::output()->get('PaginaBasica')->getPostEncabezadoHtml();
	}
	
	function pre_contenido(){
		toba::output()->get('PaginaBasica')->getPreContenido();
	}
	
	function post_contenido(){
		toba::output()->get('PaginaBasica')->getPostContenido();
	}

	function pie()
	{
		if ( toba_editor::modo_prueba() ) {
			echo "<br>";
			$item = toba::solicitud()->get_datos_item('item');
			$accion = toba::solicitud()->get_datos_item('item_act_accion_script');
			toba_editor::generar_zona_vinculos_item($item, $accion);
		}
		$this->footer();
		toba::output()->get('PaginaBasica')->getFinCuerpo();
		toba::output()->get('PaginaBasica')->getFinHtml();
	}
	
	protected function footer(){
		toba::output()->get('PaginaBasica')->getFooterHtml();
	}
	
	protected function cabecera_html()
	{
		toba::output()->get('PaginaBasica')->getInicioHtml();
		toba::output()->get('PaginaBasica')->getInicioHead($this->titulo_pagina());
		$this->encoding();
		$this->plantillas_css();
		$this->estilos_css();
		toba_js::cargar_consumos_basicos();
		toba::output()->get('PaginaBasica')->getFinHead();
	}
	
	protected function titulo_pagina()
	{
		$item = toba::solicitud()->get_datos_item('item_nombre');
		return toba::proyecto()->get_parametro('descripcion_corta') . ' - ' . $item;
	}
	
	protected function encoding()
	{
		toba::output()->get('PaginaBasica')->getEncoding();
	}

	protected function plantillas_css()
	{
		toba::output()->get('PaginaBasica')->getPlantillasCss();
	}
	
	protected function estilos_css()
	{
		toba::output()->get('PaginaBasica')->getEstilosCss();
	}

	/**
	 * Crea el <body> y toba_recursos basicos. 
	 * Incluye un <div> que se propaga hasta el fin de la zona parte sup. 
	 */
	protected function comienzo_cuerpo()
	{
		$this->capa_espera();
		$this->comienzo_cuerpo_basico();
		
		
	}
	protected function capa_espera(){
		toba::output()->get('PaginaBasica')->getOverlay();
		toba::output()->get('PaginaBasica')->getCapaEspera();
	}
	
	protected function comienzo_cuerpo_basico()
	{
		toba::output()->get('PaginaBasica')->getInicioCuerpo();		
	}

	function barra_superior()
	{
		toba::output()->get('PaginaBasica')->getContenidoBarraSuperior();
	}
	
	function mostrar_resize_fuente()
	{
		toba::output()->get('PaginaBasica')->getResizeFuente("ampliar_fuente();","reducir_fuente();");
	}
	
}
?>
