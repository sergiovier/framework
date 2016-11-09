<?php

/**
 * Parser de links tipo wiki en una ayuda o descripción
 * @package Varios
 */
class toba_parser_ayuda
{
	protected static $tags = array('wiki', 'wiki_toba', 'api', 'api_js', 'link', 'url', 'test');
	
	/**
	 * Determina si una cadena es texto plano o contiene algun formato a parsear y convertir
	 * @todo Ver una forma de no usar exp.reg. para saber si parsear o no!
	 */
	static function es_texto_plano($texto)
	{
		return ! preg_match(self::exp_reg(), $texto);
	}
	
	/**
	 * Busca y reemplaza el formato wiki en un texto
	 */
	static function parsear($texto, $resumido=false)
	{
		$parseado = "";
		$resultado = array();
		if (strpos($texto, '[') === false) return $texto;
		if (preg_match_all(self::exp_reg(), $texto, $resultado)) {
			for ($i=0; $i< count($resultado[0]); $i++) {
				$tipo = $resultado[2][$i];
				$parseado .= $resultado[1][$i];
				$metodo = "parsear_".$tipo;
				$parseado .= self::$metodo($resultado[3][$i], $resultado[4][$i], null, $resumido);
				$parseado .= $resultado[5][$i];
			}
		} else {
			$parseado = $texto;	
		}
		return $parseado;
	}
	
	protected static function exp_reg()
	{
		$tags = implode('|', self::$tags);
		return  '/([^\[]*)\[('.$tags.'):([^\ ]+)[\ ]*([^\[]*)\]([^\[]*)/';
		
	}
	
	static function parsear_wiki_toba($id, $nombre, $proyecto=null, $resumido=false)
	{
		return self::parsear_wiki($id, $nombre, 'toba_editor', $resumido);
	}	
	
	static function parsear_wiki($id, $nombre, $proyecto=null, $resumido=false)
	{
		// Busco la base de la URL
		$escapador = toba::escaper();
		$url_base = '';
		if (isset($proyecto)) {
			$url_base .= toba::instancia()->get_url_proyecto($proyecto).'/';
			if ($proyecto == 'toba_editor') {
				$url_base .= 'doc/wiki/trac/toba/wiki/';	//Hack para evitar tener que armar un esquema mucho mas complicado para manejar el caso de usar doc toba desde distintos lados
			}			
		} else {
			$url_base .= toba::proyecto()->get_parametro('proyecto', 'url_ayuda');
		}
		// Armo la URL
		$agregar_extension = toba::proyecto()->get_parametro('proyecto', 'url_ayuda_agregar_extension', false);
		if (!isset($agregar_extension) || $agregar_extension) {
			$anchor = '';
			if (strpos($id, '#') !== false) {
				$anchor = substr($id, strpos($id, '#')+1);			
				$id = substr($id, 0, strpos($id, '#'));
				$url = $url_base. $escapador->escapeUrl($id).'.html#'.$escapador->escapeUrl($anchor);
			} else {
				$url = $url_base.$escapador->escapeUrl($id).'.html';
			}
		} else {
				
			$url = $url_base. $escapador->escapeUrl($id);
		}
		// Genero la salida
		if ($resumido) {
			return $url;
		} else {
			$img = toba_recurso::imagen_toba("wiki.gif", true);
			$tag = "<a href=". $escapador->escapeHtmlAttr($url)." target=wiki>". $escapador->escapeHtml($nombre)."</a>$img";
			return $tag;
		}
	}
	
	static function parsear_api($id, $nombre, $proyecto=null, $resumido=false)
	{
		$anchor = '';
		if (strpos($id, '#') !== false) {
			$anchor = substr($id, strpos($id, '#')+1);			
			$id = substr($id, 0, strpos($id, '#'));
		}
		$escapador = toba::escaper();
		$url = toba_recurso::url_proyecto($proyecto)."/doc/api/". $escapador->escapeUrl($id).'.html#'. $escapador->escapeUrl($anchor);
		$img = toba_recurso::imagen_proyecto("api.gif", true, null, null, null, null, $proyecto);
		$tag = "<a href=". $escapador->escapeHtmlAttr($url)."  target=api>". $escapador->escapeHtml($nombre)."</a>$img";
		return $tag;
	}
	
	static function parsear_api_js($id, $nombre, $proyecto=null, $resumido=false)
	{
		$anchor = '';
		if (strpos($id, '#') !== false) {
			$anchor = substr($id, strpos($id, '#')+1);			
			$id = substr($id, 0, strpos($id, '#'));
		}
		$escapador = toba::escaper();
		$url = toba_recurso::url_proyecto($proyecto)."/doc/api_js/". $escapador->escapeUrl($id).'.html#'. $escapador->escapeUrl($anchor);
		$img = toba_recurso::imagen_proyecto("api.gif", true);
		$tag = "<a href=". $escapador->escapeHtmlAttr($url)."  target=api>". $escapador->escapeHtml($nombre)."</a>$img";
		return $tag;
	}	
	
	protected static function parsear_link($id, $nombre, $proyecto=null, $resumido=false)
	{
		$url = toba_recurso::url_proyecto()."/".$id;
		$escapador = toba::escaper();
		$tag = "<a href=". $escapador->escapeHtmlAttr($url)."  target=_blank>". $escapador->escapeHtml($nombre)."</a>";
		return $tag;
	}
	
	protected static function parsear_url($id, $nombre, $proyecto=null, $resumido=false)
	{
		$url = $id;
		$escapador = toba::escaper();
		$tag = "<a href=". $escapador->escapeHtmlAttr($url)."  target=_blank>". $escapador->escapeHtml($nombre)."</a>";
		return $tag;
	}
	
	protected static function parsear_test($id, $nombre, $proyecto=null, $resumido=false)
	{
		$escapador = toba::escaper();
		if (! $resumido) {
			return "<test id='". $escapador->escapeHtmlAttr($id)."'>". $escapador->escapeHtml($nombre)."</test>";
		} else {
			return '"<test>'. $escapador->escapeHtml($id).'</test>';
		}
	}
	
}


?>