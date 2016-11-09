<?php
/**
 * Clase estática con métodos que encapsulan los tags de un formulario HTML
 * Estos métodos son de bajisimo nivel y son solo shorcuts para evitar escribir html directo
 * 
 * @package SalidaGrafica
 */
class toba_form 
{

	static function text($nombre,$actual,$read_only,$len,$size,$clase="ef-input",$extra="")
	// EditBox
	{
		$escapador = toba::escaper();
		$actual = texto_plano($actual);		
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$clase = $escapador->escapeHtmlAttr($clase);
		//$extra = $escapador->escapeHtmlAttr($extra);		
		$max_length = ($len != '') ? "maxlength='".$escapador->escapeHtmlAttr($len)."'" : '';
		
		$r = "<INPUT type='text' name='$nombre_sf' id='$nombre_sf' $max_length size='". $escapador->escapeHtmlAttr($size)."' ";
		if (isset($actual)) { 			
			$r .= "value='". $escapador->escapeHtmlAttr($actual)."' ";		
		}
		if ($read_only) {
			$r .= " readonly ";
			$clase .= ' ef-input-solo-lectura';
		}
		$r .= "class='$clase' $extra />\n";
		return $r;
	}

	static function select($nombre,$actual,$datos,$clase="ef-combo", $extra="", $categorias=null)
	//Combo STANDART. recibe el listado en un array asociativo
	{
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);		
		if(!is_array($datos)) {
			//Si datos no es un array, no puedo seguir
			$datos= array();
		}
		$combo = "<select name='$nombre_sf' id='$nombre_sf' class='".$escapador->escapeHtmlAttr($clase)."' $extra>\n";
		if (!isset($categorias)) {
			foreach ($datos as $id => $desc) {
				$s = ("$id" == "$actual") ? "selected" : "";
				$id = $escapador->escapeHtmlAttr($id);
				$desc = texto_plano($desc);
				$combo .= "<option value='$id' $s>$desc</option>\n";
			}
		} else {
			foreach ($categorias as $categoria => $valores) {
				$categoria_sf = $escapador->escapeHtmlAttr($categoria);
				$combo .= "<optgroup label='$categoria_sf'>\n";
				foreach ($valores as $id) {
					$s = ($id == $actual) ? "selected" : "";
					$desc = texto_plano($datos[$id]);
					$id = $escapador->escapeHtmlAttr($id);
					$combo .= "<option value='$id' $s>$desc</option>\n";
				}
				$combo .= "</optgroup>\n";
			}
		}
		$combo .= "</select>\n";
		return $combo;
	}

	static function multi_select($nombre,$actuales,$datos, $tamanio, $clase="ef-combo", $extra="")
	{
		if(!is_array($datos)){//Si datos no es un array, no puedo seguir
			$datos[""] = "";
		}
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$clase_sf = $escapador->escapeHtmlAttr($clase);
		$tamanio_sf = $escapador->escapeHtmlAttr($tamanio);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		$combo = "<select name='".$nombre_sf."[]' id='$nombre_sf' class='$clase_sf' size='$tamanio_sf' multiple $extra>\n";
		foreach ($datos as $id => $desc){
			$s = (in_array($id, $actuales)) ? "selected" : "";
			$id_sf = $escapador->escapeHtmlAttr($id);
			$desc = $escapador->escapeHtml($desc);
			$combo .= "<option value='$id_sf' $s>$desc</option>\n";
		}
		$combo .= "</select>\n";
		return $combo;
	}	

	static function textarea($nombre,$valor,$filas,$columnas,$clase="ef-textarea",$wrap="",$extra="")
	//TEXTAREA
	//wrap=virtual
	{	
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$filas_sf = $escapador->escapeHtmlAttr($filas);
		$columnas_sf = $escapador->escapeHtmlAttr($columnas);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		$clase_sf = $escapador->escapeHtmlAttr($clase);
		if(trim($wrap)!="") {
			$wrap_sf = $escapador->escapeHtmlAttr($wrap);
			$wrap = "wrap='$wrap_sf'";
		}
		$valor = texto_plano($valor);
		return "<textarea class='$clase_sf' name='$nombre_sf' id='$nombre_sf' rows='$filas_sf' cols='$columnas_sf' $wrap $extra>$valor</textarea>\n";
	}

	static function checkbox($nombre,$actual,$valor,$clase="ef-checkbox",$extra="")
	//Checkbox STANDART. recibe el valor y el valor actual
	{
		$s = "";
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		if(!is_null($valor) && !is_null($actual) && $valor == $actual) { $s = "CHECKED";}		//Castea null a cero, por ende en necesario evitarlo
		$valor_sf = $escapador->escapeHtmlAttr($valor);
		$clase_sf = $escapador->escapeHtmlAttr($clase);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		return "<input name='$nombre_sf' id='$nombre_sf' type='checkbox' value='$valor_sf' $s class='$clase_sf' $extra/>\n";
	}

	static function radio($nombre, $actual, $datos, $clase=null, $extra="", $tab_index = "")
	{
		if (!is_array($datos)) {
			$datos = array();	
		}
		$escapador = toba::escaper();
		$html = '';
		$html_clase = isset($clase) ? "class='".$escapador->escapeHtmlAttr($clase)."'" : '';
		$i=0;
		foreach ($datos as $clave => $valor) {
			$id = $nombre . $i;
			$sel = ($actual == $clave) ? "checked" : "";
			$clave = texto_plano($clave);
			$valor = texto_plano($valor);
			$html .= self::radio_manual($id, $nombre, $clave, $sel, $html_clase, $extra, $tab_index, $valor);
			$tab_index = '';
			$i++;
		}
		return $html;
	}

	static function radio_manual($id, $nombre, $clave, $sel, $html_clase, $extra, $tab_index, $valor)
	{
		$escapador = toba::escaper();
		$id_sf = $escapador->escapeHtmlAttr($id);
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$clave_sf = $escapador->escapeHtmlAttr($clave);
		$sel_sf = $escapador->escapeHtmlAttr($sel);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		$tab_sf = $escapador->escapeHtmlAttr($tab_index);
		$valor_sf = texto_plano($valor);
		return  "<label class='ef-radio' for='$id_sf'><input type='radio' id='$id_sf' name='$nombre_sf' value='$clave_sf' $sel_sf $html_clase $extra $tab_sf />$valor_sf</label>\n";
	}

	static function hidden($nombre,$valor, $extra="")
	//Campo HIDDEN
	{
		$valor_sf = texto_plano($valor);
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);		
		return "<input name='$nombre_sf' id='$nombre_sf' type='hidden' value='$valor_sf' $extra />\n";
	}

	static function submit($nombre,$valor,$clase="ei-boton",$extra="", $tecla = null)
	// Boton de SUBMIT
	{
		if ($tecla === null) {
			$escapador = toba::escaper();
			$nombre_sf = $escapador->escapeHtmlAttr($nombre);
			//$extra_sf = $escapador->escapeHtmlAttr($extra);		
			$valor_sf = $escapador->escapeHtmlAttr($valor);
			$clase_sf = $escapador->escapeHtmlAttr($clase);
			return "<INPUT type='submit' name='$nombre_sf' id='$nombre_sf' value='$valor' class='$clase_sf' $extra />\n";
		} else {
			return toba_form::button_html($nombre, $valor, $extra, 0, $tecla, '', 'submit', '', $clase);
		}
	}

	static function image($nombre,$src,$extra="", $tecla = null)
	// Boton de SUBMIT
	{
		$acceso = toba_recurso::ayuda($tecla);
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$src_sf = $escapador->escapeHtmlAttr($escapador->escapeUrl($src));
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		return "<INPUT type='image' name='$nombre_sf' id='$nombre_sf' src='$src_sf' $acceso $extra />\n";
	}

	static function button($nombre,$valor,$extra="",$clase="ei-boton", $tecla = null)
	// Boton de SUBMIT
	{
		if ($tecla === null) {
			$escapador = toba::escaper();
			$nombre_sf = $escapador->escapeHtmlAttr($nombre);
			//$extra_sf = $escapador->escapeHtmlAttr($extra);		
			$valor_sf = $escapador->escapeHtmlAttr($valor);
			$clase_sf = $escapador->escapeHtmlAttr($clase);
			return "<INPUT type='button' name='$nombre_sf' id='$nombre_sf' value='$valor' class='$clase_sf' $extra />\n";
		} else{
			return toba_form::button_html($nombre, $valor, $extra, 0, $tecla, '', 'button', '', $clase);
		}
	}

	static function button_html($nombre,$html, $extra="", $tab = null, $tecla = null, $tip='', $tipo='button', $valor='', $clase="ei-boton", $con_id=true, $estilo_inline=null, $habilitado=true )
	// Boton con html embebido
	{
		$escapador = toba::escaper();
		//$extra_sf = $escapador->escapeHtmlAttr($extra);
		$valor_sf = $escapador->escapeHtmlAttr($valor);
		$html_sf = $escapador->escapeHtml($html);
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$tipo_sf = $escapador->escapeHtmlAttr($tipo);
		
		$acceso = toba_recurso::ayuda($tecla, $tip, $clase);
		$id_sf = ($con_id) ? "id='$nombre_sf'" : '';
		$tab_sf = (isset($tab) && $tab != 0) ? "tabindex='".$escapador->escapeHtmlAttr($tab)."'" : "";				
		$estilo_inline_sf = isset($estilo_inline) ? "style='" . $escapador->escapeHtmlAttr($estilo_inline) . "'": '';
		$habilitado = $habilitado ? '' : 'DISABLED';		
		return  "<button type='$tipo_sf' name='$nombre_sf' $id_sf value='$valor' $tab_sf $acceso $extra $estilo_inline_sf $habilitado>".
				"<span>$html</span></button>\n";
	}

	static function password($nombre,$valor="", $maximo='', $tamanio='', $clase="ef-input", $extra = '')
	{
		$escapador = toba::escaper();
		$valor_sf = $escapador->escapeHtmlAttr($valor);
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$clase_sf = $escapador->escapeHtmlAttr($clase);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);		
		$max_length_sf = ($maximo != '') ? "maxlength='". $escapador->escapeHtmlAttr($maximo)."'" : '';    	
		$tamanio_sf = ($tamanio != '') ? "size='". $escapador->escapeHtmlAttr($tamanio)."'" : '';  
		return "<INPUT type='password' name='$nombre_sf' $tamanio_sf $max_length_sf id='$nombre_sf' value='$valor_sf' class='$clase_sf' $extra />\n";
	}

	static function archivo($nombre,$valor=null,$clase="ef-upload",$extra="")
	// Boton de SUBMIT
	{
		$escapador = toba::escaper();
		$valor_sf = (! is_null($valor)) ? "value='". $escapador->escapeHtmlAttr($valor). "'" : '';
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		$clase_sf = $escapador->escapeHtmlAttr($clase);
		//$extra_sf = $escapador->escapeHtmlAttr($extra);				
		return "<INPUT type='file' name='$nombre_sf' id='$nombre_sf' $valor_sf $extra class='$clase_sf' />\n";
	}

	static function abrir($nombre,$action,$extra="",$method="post",$upload=true)
	{
		// Dejo el upload por defecto, asi no tengo que dejar una puerta para
		// cuando se necesita en los consumidores (particularmente el MT).
		// Aparentemente no tiene ningun efecto negativo...
		if($upload){
			$enctype='multipart/form-data';
			$method='post';//Post obligado en este caso
		}else{
			$enctype='application/x-www-form-urlencoded';
		}
		$escapador = toba::escaper();
		$nombre_sf = $escapador->escapeHtmlAttr($nombre);
		//$action_sf = $escapador->escapeUrl($action);
		//$extra_sf = $escapador->escapeHtml($extra);		
		return  "\n<form  enctype='$enctype' id='$nombre_sf' name='$nombre_sf' method='$method' action='$action' $extra>\n";
	}

	static function cerrar()
	{
		return  "\n</form>\n";
	}
}
?>