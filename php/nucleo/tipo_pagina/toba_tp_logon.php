<?php
/**
 * Tipo de página pensado para pantallas de login, presenta un logo y un pie de página básico
 * 
 * @package SalidaGrafica
 */
class toba_tp_logon extends toba_tp_basico
{
	
	function inicio_barra_superior(){
		toba::output()->get('PaginaLogon')->getInicioBarraSuperior();
	}
	
	function fin_barra_superior(){
		toba::output()->get('PaginaLogon')->getFinBarraSuperior();
	}

	function pre_contenido()
	{
		toba::output()->get('PaginaLogon')->getPreContenido();		
	}

	function post_contenido()
	{
		toba::output()->get('PaginaLogon')->getPostContenido();
	}
}
?>