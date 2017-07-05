<?php

/**
 * Este tipo de página incluye una cabecera con:
 *  - Menú
 *  - Logo
 *  - Información básica del usuario logueado
 *  - Capacidad de cambiar de proyecto 
 *  - Capacidad de desloguearse
 * @package SalidaGrafica
 */
class toba_tp_normal extends toba_tp_basico_titulo
{
	protected $menu;
	protected $alto_cabecera = "34px";

	function __construct()
	{
		$this->menu = toba::output()->get('Menu');
	}
	
	
	function inicio_encabezado_html(){
		toba::output()->get('PaginaNormal')->getPreEncabezadoHtml();
	}
	
	function inicio_barra_superior(){
		toba::output()->get('PaginaNormal')->getInicioBarraSuperior();
	}
	
	function fin_encabezado_html(){
		toba::output()->get('PaginaNormal')->getPostEncabezadoHtml();
	}
	
	function fin_barra_superior(){
		toba::output()->get('PaginaNormal')->getFinBarraSuperior();
	}
	
	function barra_superior()
	{
		toba::output()->get('PaginaNormal')->getContenidoBarraSuperior($this->titulo_item(), $this->info_version(), $this->generar_ayuda());
	}
	
	protected function comienzo_cuerpo_basico()
	{
		toba::output()->get('PaginaNormal')->getInicioCuerpo();
	}
	
	protected function estilos_css()
	{
		parent::estilos_css();
		toba::output()->get('PaginaTitulo')->getEstiloCss();
	}
	
	protected function comienzo_cuerpo()
	{
		parent::comienzo_cuerpo();
		$this->cabecera_aplicacion();
		
		$this->menu();	
		
	}
	
	public function pre_contenido(){
		toba::output()->get('PaginaNormal')->getPreContenido();
	}
	
	public function post_contenido(){
		toba::output()->get('PaginaNormal')->getPostContenido();
	}

	protected function menu()
	{
		if (isset($this->menu)) {
			$this->menu->mostrar();
		}		
	}

	protected function plantillas_css()
	{
		if (isset($this->menu)) {
			$estilo = $this->menu->plantilla_css();
			if ($estilo != '') {
				echo toba_recurso::link_css($estilo, 'screen', false);
			}
		}
		parent::plantillas_css();
	}
	
	protected function cabecera_aplicacion()
	{
		if ( toba::proyecto()->get_parametro('requiere_validacion') ) {
			$mostrar_app_launcher = toba::proyecto()->get_parametro('proyecto', 'app_launcher', false);
			if (!$mostrar_app_launcher) {
				//--- Salir
				$js = toba_editor::modo_prueba() ? 'window.close()' : 'salir()';
				toba::output()->get('PaginaNormal')->getSalir($js);

				//--- Usuario
				$this->info_usuario();
			} else {
				//--- Usuario y aplicaciones
				$this->info_usuario_aplicaciones();
			}
		}
		
		$muestra = toba::proyecto()->get_parametro('proyecto', 'mostrar_resize_fuente', false);
		if (! is_null($muestra) && $muestra) {
			$this->mostrar_resize_fuente();
		}

		//--- Proyecto
		if(toba::proyecto()->es_multiproyecto()) {
			$this->cambio_proyecto();
		}
		if (toba::proyecto()->permite_cambio_perfiles()) {
			$this->cambio_perfil();
		}
		
		//--- Logo
		
		$this->mostrar_logo();
		
		
	}

	/**
	 * Genera el HTML que posibilita cambiar entre procesos
	 * @ventana
	 */
	protected function cambio_proyecto()
	{
		$proyectos = toba::instancia()->get_proyectos_accesibles();
		$actual = toba::proyecto()->get_id();
		toba::output()->get('PaginaNormal')->getCambioProyecto($proyectos, $actual);
	}
	
	function cambio_perfil()
	{
		$perfiles = toba::instancia()->get_datos_perfiles_funcionales_usuario_proyecto( toba::usuario()->get_id(), toba::proyecto()->get_id());		
		toba::output()->get('PaginaNormal')->getCambioPerfil($perfiles);		
	}	
	
	protected function mostrar_logo()
	{
		toba::output()->get('PaginaNormal')->getLogo($this->alto_cabecera);
	}
	
	protected function info_usuario()
	{
		toba::output()->get('PaginaNormal')->getInfoUsuario();
	}

	protected function info_usuario_aplicaciones()
	{
		toba::app_launcher()->mostrar_html_app_launcher();
	}
	
}
?>