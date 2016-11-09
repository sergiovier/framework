<?php
/**
 * Clase abstracta para manejo de un gadget via shindig
 * @package Centrales
 */

class toba_gadget_shindig extends toba_gadget
{
	function get_tipo()
	{
		return apex_tipo_gadget_shindig;
	}

	function generar_html()
	{
		$escapador = toba::escaper();
		$orden = $this->get_orden();
		$url = $escapador->escapeJs($this->get_gadget_url());
		$titulo = $escapador->escapeJs($this->get_titulo());
		
		echo "<div id='". $escapador->escapeHtmlAttr("gadget-chrome-$orden")."' class='gadgets-gadget-chrome'></div>\n";

		echo toba_js::abrir();

		echo "
			var ". $escapador->escapeJs("gadget$orden")." = gadgets.container.createGadget({specUrl: '$url', title: '$titulo', elim: ".($this->es_eliminable() ? 'true':'false')."});
			gadgets.container.addGadget(". $escapador->escapeJs("gadget$orden").");

			if (typeof gadgets.container.layoutManager.gadgetChromeIds_ == 'undefined') {
				gadgets.container.layoutManager.gadgetChromeIds_ = [];
			}
			gadgets.container.layoutManager.gadgetChromeIds_.push('". $escapador->escapeJs("gadget-chrome-$orden")."');

			gadgets.container.renderGadget(". $escapador->escapeJs("gadget$orden").");
		";

		echo toba_js::cerrar();
	}
}
?>
