<?php

/**
 * Funciones varias relacionadas con generación de markup HTML
 * @package SalidaGrafica
 */

	function pre($txt)
	{
		echo '<pre>'. toba::escaper()->escapeHtml($txt)."\n\n</pre>";
	}
	
	function ei_vinculo($url, $texto, $imagen=null, $target=null, $css='lista-link')
	{
		$escapador = toba::escaper();
		if(isset($target)) {
			$target = "target='". $escapador->escapeHtmlAttr($target)."'";
		}
		$html =  "<a href='$url' class='". $escapador->escapeHtmlAttr($css)."' $target>";
		if(isset($imagen)){
			$html .=  toba_recurso::imagen_toba($imagen,true,null,null,$texto);
		}else{
			$html .=  $texto;		
		}
		$html .=  "</a>";
		return $html;
	}

	function ei_separador($titulo="")
	/*
	 @@acceso: publico
	@@desc: Imprime una barra que divide la pantalla
	@@param: string | Titulo de la barra
*/
	{
		echo "<table width='100%' class='tabla-0'><tr>\n";
		echo "<td class='barra-separador'>". toba::escaper()->escapeHtml($titulo)."</td>\n";
		echo "</tr></table>\n";
	}

	function ei_mensaje($mensaje,$tipo='info',$subtitulo="",$ancho=400)
/*
	@@acceso: publico
	@@desc: Imprime un mensaje en la pantalla
	@@param: string | Texto del mensaje
	@@param: string | Tipo de mensaje (info/error) | info
	@@param: string | Subtitulo del recuadro | vacio
 	@@retorno: string | HTML del mensaje
*/
	{
		$solicitud = toba::solicitud();
		$escapador = toba::escaper();
		if (isset($solicitud) && $solicitud->get_tipo() == 'consola') {
			echo $mensaje . "\n\n";
			return;
		}		
		$css = $tipo;
		if($tipo=='info') {
			$titulo = "";
		} elseif($tipo=='error') {
			$titulo = toba_recurso::imagen_toba('error.gif', true)." ERROR";
		} else {
			$titulo = $tipo;
			$css = "INFO";
		}
		$html = "<div width='". $escapador->escapeHtmlAttr($ancho)."' class='". $escapador->escapeHtmlAttr("mensaje mensaje-$css")."'>
		        <div class='". $escapador->escapeHtmlAttr("mensaje-titulo-$css")."'>". $escapador->escapeHtml($titulo)."</div>";
		if($subtitulo!=""){
			$html.=	"<div class='". $escapador->escapeHtmlAttr("mensaje-subtitulo-$css")."'>". $escapador->escapeHtml($subtitulo)."</div>";
		}
		$html.=	"<div class='". $escapador->escapeHtmlAttr("mensaje-cuerpo-$css")."'>". $escapador->escapeHtml($mensaje)."</div>
				</div>\n";
		return $html;
	}

	function ei_nota($texto, $clase='ef-etiqueta')
/*
	@@acceso: publico
	@@desc: Imprime una nota
	@@param: string | Texto a mostrar
*/
	{
		$escapador = toba::escaper();
		echo 	"<div align='center'><table class='tabla-0' width='100%'>
				<tr>
				<td align='center'  style='padding: 10px 10px 10px 10px;' class='". $escapador->escapeHtmlAttr($clase)."'>
				". $escapador->escapeHtml($texto)."</td></tr></table></div>";
	}

	function ei_texto($texto,$titulo=null)
/*
	@@acceso: publico
	@@desc: Imprime un texto en la pantalla
	@@param: string | Texto a mostrar
	@@param: string | Titulo del texto
*/
	{
		echo "<div align='center'><table border='0' cellspacing='0' cellpadding='10'>";
		$escapador = toba::escaper();
		if(isset($titulo)) { 
			echo "<tr><td align='center'>". $escapador->escapeHtml($titulo)."</td></tr>";			
		}
		echo "<tr><td align='center'><pre>";
		print_r($escapador->escapeHtml($texto));
		echo "<pre></td></tr></table></div>";
	}

	function ei_centrar($html, $ancho="100%")
/*
	@@acceso: publico
	@@desc: Imprime el parametro centrado en la pantalla
	@@param: string | HTML a mostrar
*/
	{
		echo "<table width='". toba::escaper()->escapeHtmlAttr($ancho)."' border='0' cellspacing='0' cellpadding='10' align='center'>";
		echo "<tr><td align='center'>";
		echo $html;		
		echo "</td></tr></table>";
	}
    
    function enter()
/*
	@@acceso: publico
	@@desc: Imprime un salto de linea
*/
	{
        echo "<br />\n";
    }

    /**
     * Imprime un GIF transparente. Util para forzar el posicionamiento de contenido
     */
	function gif_nulo($ancho=1,$alto=1,$nota="")
	{
		$alt = "alt=''";
		if($nota!="") {
			$alt = " alt='". toba::escaper()->escapeHtmlAttr($nota) ."' ";
		}
		$ancho = convertir_a_medida_tabla($ancho);
		$alto = convertir_a_medida_tabla($alto, 'height');
		return "<img class='gif-nulo-tobita' src='". toba_recurso::imagen_toba("nulo.gif"). "' $ancho $alto $alt />";
	}

	function ei_linea($ancho="100%")
/*
	@@acceso: publico
	@@desc: Imprime una barra que divide la pantalla
	@@param: string | Ancho de la linea
*/
	{
		echo "<table width='100%' class='tabla-0'><tr>\n";
		echo "<td class='barra-separador'>".gif_nulo($ancho,1)."</td>\n";
		echo "</tr></table>\n";
	}
	
	function ei_tabla($tabla,$identificador="Tabla NN")
/*
	@@acceso: publico
	@@desc: 
	@@param: 
	@@retorno:
*/
	// Dumpea un array de dos dimensiones cuyas claves son NUMERICAS y ascendentes
	{
		$escapador = toba::escaper();
		$filas = count($tabla);
		$columnas = count($tabla[1]);
		echo "<br><table width='98%' border=1 bgcolor='0000ff' align='center' cellpadding='2'>\n";
		echo "  <tr><td align='center' colspan='". $escapador->escapeHtmlAttr($columnas+1)."' bgcolor='ff0000'><b>". $escapador->escapeHtml($identificador)."</b></td></tr>\n";		
		echo "<tr>\n";
		echo "   <td align='center' bgcolor='ffcccc'>&nbsp;</td>\n";
		for ($y=0;$y<$columnas;$y++)	{
			echo "   <td align='center' bgcolor='ffeeaa'>". $escapador->escapeHtml($y)."</td>\n";
		}
		echo "</tr>\n";
		for ($x=0;$x<$filas;$x++)	{
			echo "<tr>\n";
			echo "   <td align='right' bgcolor='ffeeaa'>". $escapador->escapeHtml($x)."</td>\n";
			for ($y=0;$y<$columnas;$y++)	{
				echo "   <td align='right' bgcolor='ffffff'>" . $escapador->escapeHtml($tabla[$x][$y]) . "</td>\n";
			}
			echo "</tr>\n";
		}
		echo "</table>";
		echo "<br>";
	}

	function ei_arbol($arbol,$identificador="DUMPEO de VALORES",$ancho="50%",$colapsado=false)
	{
		//Me estan llamando por consola??
		if(toba::solicitud() != null && toba::solicitud()->get_tipo() == 'consola'){
			//echo "<pre>";
			print_r($arbol);
			//echo "</pre>";
			return;
		}
		$escapador = toba::escaper();
		//Javascript de colapsado de niveles (esto no es bello, pero funciona)
		static $js = 0; // Para que entre una sola vez
		if($js==0){
			echo "<script language='javascript'>function ei_arbol_colapsar_nivel(id, img){
					nodo = document.getElementById(id);
					if(nodo.style.display == 'none'){
						//Abrir
						nodo.style.display = '';
						img.src = '".toba_recurso::imagen_toba('nucleo/contraer.gif', false)."';
					}else{
						//Cerrar
						nodo.style.display = 'none';
						img.src = '".toba_recurso::imagen_toba('nucleo/expandir.gif', false)."';
					}
				}</script>";
		}
		$js++;
		
		//Es un array?
		if(is_array($arbol)){
			echo "<div  align='center'><br>";
			echo "<table class='tabla-0' width='". $escapador->escapeHtmlAttr($ancho)."'>";
			echo "<tr><td class='arbol-titulo'><b>". $escapador->escapeHtml($identificador)."</b></td></tr>\n";		
			echo "<tr><td class='arbol-valor-array'>\n";
			ei_arbol_nivel($arbol, $colapsado);
			echo "</td></tr>\n";
			echo "</table>\n";
			echo "</div><br>";
		}elseif(is_object($arbol)){
			echo ei_mensaje("CLASE&nbsp;<b>" . get_class($arbol) ."</b>",null,$identificador);
		}else{
			echo ei_mensaje($arbol,null,$identificador);
		}
	}

	function ei_arbol_nivel($nivel, $colapsado) 
	{
		$estilo="";
		static $n = 0;
		static $id = 0;
		$id++;
		$display = ($colapsado)? "style='display:none'" : '';//Mostrar el arbol colapsado de entrada?
		if($colapsado){
			$imagen = toba_recurso::imagen_toba('nucleo/expandir.gif', false);
		}else{
			$imagen = toba_recurso::imagen_toba('nucleo/contraer.gif', false); 
		}
		echo "<table width='100%' class='tabla-0'>\n";
		$escapador = toba::escaper();
		foreach( $nivel as $valor => $contenido )
		{
			if($estilo=="arbol-etiqueta1"){
				$estilo="arbol-etiqueta2";
			}else{
				$estilo="arbol-etiqueta1";
			}
			echo "<tr><td class='". $escapador->escapeHtmlAttr($estilo)."' width='5%'><b>". $escapador->escapeHtml($valor)."</b></td>\n";
			if (is_array($contenido))
			{
				echo "<td class='arbol-valor-array'>
				<img src='$imagen' onclick='ei_arbol_colapsar_nivel(\"". $escapador->escapeHtmlAttr("ei-arbol-$id")."\", this)'>
				[". $escapador->escapeHtml(count($contenido)) ."]
				<div id='". $escapador->escapeHtmlAttr("ei-arbol-$id")."' $display>";
				$n++;
				ei_arbol_nivel($contenido, $colapsado);
				$n--;
				echo "</div></td>\n";
			} else {
				if(is_object($contenido)){
					//El elemento es un objeto.
					echo "<td class='arbol-valor-objeto'>objeto&nbsp;(CLASE&nbsp;<b>" . $escapador->escapeHtml(get_class($contenido)) ."</b>)</td>\n";
				}elseif(is_null($contenido)){
					echo "<td class='arbol-valor-null'>null</td>\n";
				}else{
					echo "<td class='arbol-valor'>" . str_replace("\n","<br>", $escapador->escapeHtml($contenido)) ."</td>\n";
				}
			}
			echo "</tr>\n";
			
		}
		echo "</table>\n";	
	}

	function ei_barra_inicio($clases)
	{
		echo "<table cellpadding='5' cellspacing=0 align='center' class='barra-redondeada ". toba::escaper()->escapeHtmlAttr($clases)."'>";
		echo '<tr>
			<td class="tl" align="left" valign="top"><img src="'.toba_recurso::imagen_skin('corner_tl.gif').'" class="c" alt=""></td>
			<td class="barra-redondeada-cont" rowspan="2">';
	}
	
	function ei_barra_fin()
	{
		echo '
		    </td><td class="tr" align="right" valign="top"><img src="'.toba_recurso::imagen_skin('corner_tr.gif').'" class="c" alt=""></td>
		  </tr>
		  <tr>
		    <td class="bl" align="left" valign="bottom"><img src="'.toba_recurso::imagen_skin('corner_bl.gif').'" class="c" alt=""></td>
		    <td class="br" align="right" valign="bottom"><img src="'.toba_recurso::imagen_skin('corner_br.gif').'" class="c" alt=""></td>
		  </tr>
		';
		echo "</table>";
	}

	
?>
