<?php
require_once("tp_basico_titulo.php");
require_once("nucleo/lib/interface/form.php");

class tp_normal extends tp_basico_titulo
{
	protected $menu;
	protected $alto_cabecera = "34px";

	function __construct()
	{
		$archivo_menu = info_proyecto::instancia()->get_parametro('menu_archivo');
		require_once($archivo_menu);
		$clase = basename($archivo_menu, ".php");
		$this->menu = new $clase();
	}
	
	protected function comienzo_cuerpo()
	{
		parent::comienzo_cuerpo();
		$this->menu();					
		$this->cabecera_aplicacion();			
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
				echo recurso::link_css($estilo, "screen");
			}
		}
		parent::plantillas_css();
	}
	
	protected function cabecera_aplicacion()
	{
		//--- Salir
		$js = editor::modo_prueba() ? 'window.close()' : 'salir()';
		echo '<a href="#" class="enc-salir" title="Cerrar la sesi�n" onclick="javascript:'.$js.'"><img src='.
				recurso::imagen_apl('finalizar_sesion.gif').
				' border="0"></a>';
		
		//--- Usuario
		$this->info_usuario();
		
		//--- Proyecto
		if(info_proyecto::instancia()->es_multiproyecto()) {		
			$this->cambio_proyecto();
		}		
		if (apex_pa_proyecto=="multi") {
			
		}	
		//--- Logo
		echo "<div style='height:{$this->alto_cabecera}'>";
		$this->mostrar_logo();
		echo "</div>\n";
	}

	protected function cambio_proyecto()
	{
		$proyectos = info_instancia::get_proyectos_accesibles();
		$actual = info_proyecto::instancia()->get_id();
		if (count($proyectos) > 1) {
			//-- Si hay al menos dos proyectos
			echo '<div class="enc-cambio-proy">';
			echo '<a href="#" title="Ir a la inicio" onclick="vinculador.ir_a_proyecto(\''.$actual.'\');">'.
					recurso::imagen_apl("home.gif",true).'</a>';
			$datos = rs_convertir_asociativo($proyectos, array(0), 1);
			echo form::select(apex_sesion_qs_cambio_proyecto, $actual, 
								$datos, 'ef-combo', 'onchange="vinculador.ir_a_proyecto(this.value)"');
			echo js::abrir();
			echo 'var url_proyectos = '.js::arreglo(info_instancia::get_url_proyectos(array_keys($datos)), true);
			echo js::cerrar();
			echo '</div>';
		}
	}
	
	protected function mostrar_logo()
	{
		echo recurso::imagen_pro('logo.gif', true);
	}
	
	protected function info_usuario()
	{
		echo '<div class="enc-usuario">';		
		echo "<span class='enc-usuario-nom'>".toba::get_usuario()->get_nombre()."</span>";
		echo "<span class='enc-usuario-id'>".toba::get_usuario()->get_id()."</span>";
		echo '</div>';		
	}		
	
	function pie()
	{
		parent::pie();	
	}
}
?>