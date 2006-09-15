<?php

/**
 * Elemento editable equivalente a un <input type='text'>
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable extends toba_ef
{
	protected $tamano = 20;
	protected $maximo;
	protected $estilo="ef-input";
	protected $mascara;
	protected $unidad;
	
	
    static function get_lista_parametros_carga()
    {
    	$parametros = toba_ef::get_lista_parametros_carga_basico();    
		array_borrar_valor($parametros, 'carga_lista');
		array_borrar_valor($parametros, 'carga_col_clave');
		array_borrar_valor($parametros, 'carga_col_desc');
		return $parametros;    	
    }
    	
    static function get_lista_parametros()
    {
    	$param[] = 'edit_tamano';
    	$param[] = 'edit_maximo';
    	$param[] = 'edit_mascara';
    	$param[] = 'edit_unidad';
    	return $param;    	
    }
    	
	function __construct($padre,$nombre_formulario,$id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		//VAlor FIJO
		if(isset($parametros['estado_defecto'])){
			$this->estado_defecto = $parametros['estado_defecto'];
			$this->estado = $this->estado_defecto;
		}
		//Tama�o del editable
		if (isset($parametros['edit_tamano'])) {
			$this->tamano = $parametros['edit_tamano'];	
		}
		//Maximo de caracteres
		if(isset($parametros['edit_maximo'])){
			if($parametros['edit_maximo']!=""){
				$this->maximo = $parametros['edit_maximo'];
			}else{
				$this->maximo = $this->tamano;
			}
		}else{
			$this->maximo = $this->tamano;
		}
		//Mascara
		if(isset($parametros['edit_mascara'])) {
			$this->mascara = $parametros['edit_mascara'];		
		}
		if (isset($parametros['edit_unidad'])) {
			$this->unidad = $parametros['edit_unidad'];
			unset($parametros['edit_unidad']);	
		}		
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
	}
	
	function set_opciones($opciones)
	{
		if ($opciones === null) {
			$this->solo_lectura = true;
		}
		if (!isset($this->estado)) {
			$this->estado = $opciones;
		}		
	}
	
	function set_estado($estado)
	{
   		if(isset($estado)){								
    		$this->estado=trim($estado);
			return true;
	    } else {
	    	$this->estado = null;	
	    }
	}
	
	function cargar_estado_post()
	{
		if (isset($_POST[$this->id_form])) {
			$this->estado = trim($_POST[$this->id_form]);
    	} else {
    		$this->estado = null;
    	}
	}	

	function tiene_estado()
	{
		if (isset($this->estado)) {
			return ($this->estado != "");
		} else{
			return false;
		}
	}
    
	function get_input()
	{
		$estado = htmlentities($this->estado,ENT_QUOTES); 
		$tab = $this->padre->get_tab_index();
		$this->input_extra .= " tabindex='$tab'";
		$input = toba_form::text($this->id_form, $estado,$this->solo_lectura,$this->maximo,$this->tamano,$this->estilo, $this->javascript.' '.$this->input_extra);
		if (isset($this->unidad)) {
			$input .= ' '. $this->unidad;
		}
		return $input;
	}
	
	function get_consumo_javascript()
	{
		$consumos = array('efs/mascaras', 'efs/ef', 'efs/ef_editable');
		return $consumos;
	}

	function parametros_js()
	{
		return parent::parametros_js().", '{$this->mascara}'";
	}	
	
	function crear_objeto_js()
	{
		return "new ef_editable({$this->parametros_js()})";
	}	
	
}
//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que s�lo permite ingresar n�meros
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_numero extends toba_ef_editable
{
	protected $rango_inferior = array('limite' => '*', 'incluido' => 1);
	protected $rango_superior = array('limite' => '*', 'incluido' => 1);
	protected $tamano = 10;
	protected $mensaje_defecto;

    static function get_lista_parametros()
    {
    	$param = parent::get_lista_parametros();
    	$param[] = 'edit_rango';
    	return $param;
    }
    	
	function __construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		$this->estilo = "ef-numero";
		if (isset($parametros['edit_rango'])) {
			$this->cambiar_rango($parametros['edit_rango']);
		}
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
	}

	function cambiar_rango($rango)
	{
		//Parseo del rango
		$limitadores = array('[', ']', '(', ')');
		$partes = explode(',', $rango, 2);

		//Determinaci�n de l�mites
		$rango = trim($partes[0]);
		list($inferior, $superior) = explode('..',  str_replace($limitadores, '', $rango));
		$this->rango_inferior['limite'] = trim($inferior);
		if (strpos($rango, '(') !== false)
			$this->rango_inferior['incluido'] = 0;
		$this->rango_superior['limite']	= trim($superior);
		if (strpos($rango, ')') !== false)
			$this->rango_superior['incluido'] = 0;

		//Descripci�n
		if (isset($partes[1])) {
			$this->mensaje_defecto = $partes[1];
		}
	}
	
	function mensaje_validacion_rango()
	{
		if (isset($this->mensaje_defecto)) {
			return $this->mensaje_defecto;
		}
		$inferior = "";
		$superior = "";
		if ($this->rango_inferior['limite'] != '*') {
			$inferior .= (($this->rango_inferior['incluido']) ? " mayor o igual a " : " mayor a ").$this->rango_inferior['limite'];
		}
		if ($this->rango_superior['limite'] != '*') {
			$superior .= (($this->rango_superior['incluido']) ? " menor o igual a " : " menor a ").$this->rango_superior['limite'];
		}
		$nexo = ($inferior != "" && $superior != "") ? " y" : "";
		return " debe ser$inferior$nexo$superior.";
	}
	
	function validar_rango()
	{
		$ok = true;
		if ($this->rango_inferior['limite'] != '*') {
			if ($this->rango_inferior['incluido'])
				$ok = ($this->estado >= $this->rango_inferior['limite']);
			else
				$ok = ($this->estado > $this->rango_inferior['limite']);			
		}
		if ($ok && $this->rango_superior['limite'] != '*') {
			if ($this->rango_superior['incluido'])
				$ok = ($this->estado <= $this->rango_superior['limite']);
			else
				$ok = ($this->estado < $this->rango_superior['limite']);			
		}
		if (! $ok ) {
			return $this->mensaje_validacion_rango();
		}
		return true;
	}

    function validar_estado()
	{
		$padre = parent::validar_estado();
		if ($padre !== true) {
			return $padre;	
		}
        if ($this->tiene_estado()) {
			if (! is_numeric($this->estado)) {
				return "El campo es num�rico";
			}
			return $this->validar_rango();
		}
		return true;
	}
	

	function parametros_js()
	{
		$inferior = "new Array('{$this->rango_inferior['limite']}', {$this->rango_inferior['incluido']})";
		$superior = "new Array('{$this->rango_superior['limite']}', {$this->rango_superior['incluido']})";
		return parent::parametros_js().", [$inferior, $superior], '{$this->mensaje_validacion_rango()}'";
	}		
	
	function crear_objeto_js()
	{
		return "new ef_editable_numero({$this->parametros_js()})";
	}	
}
//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que s�lo permite ingresar n�meros que representan un valor monetario
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_moneda extends toba_ef_editable_numero
{
	protected $rango_inferior = array('limite' => '0', 'incluido' => 1);
	protected $mensaje_defecto = ' debe ser un importe positivo.';
	protected $tamano = 12;	
	
	function crear_objeto_js()
	{
		return "new ef_editable_moneda({$this->parametros_js()})";
	}	
}

//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que s�lo permite ingresar n�meros que representan un porcentaje
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_numero_porcentaje extends toba_ef_editable_numero
{
	protected $rango_inferior = array('limite' => '0', 'incluido' => 1);
	protected $rango_superior = array('limite' => '100', 'incluido' => 1);
	protected $mensaje_defecto = ' debe estar entre 0% y 100%.';
	

	function __construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		if (! isset($parametros['edit_tamano']))
			$parametros['edit_tamano']= 4;
		if (!isset($parametros['unidad'])) {
			$parametros['unidad'] = '%';
		}
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
	}

	function crear_objeto_js()
	{
		return "new ef_editable_porcentaje({$this->parametros_js()})";
	}	
}

//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que permite ingresar contrase�as, con o sin campo de confirmaci�n
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_clave extends toba_ef_editable
{
	protected $confirmar_clave = false;
	
    static function get_lista_parametros()
    {
    	$param[] = 'edit_tamano';
    	$param[] = 'edit_maximo';
    	$param[] = 'edit_confirmar_clave';
    	return $param;
    }
    
	function __construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		if ( isset($parametros['edit_confirmar_clave'])) {
			$this->confirmar_clave = $parametros['edit_confirmar_clave'];
		}
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
	}
    
	function get_input()
	{
		$tab = $this->padre->get_tab_index(2);
		$this->input_extra .= " tabindex='$tab'";
		$estado = isset($this->estado)? $this->estado : "";
		$html = toba_form::password($this->id_form,$estado, $this->maximo, $this->tamano, 'ef-input', $this->input_extra);
		if ($this->confirmar_clave) {
			$html .= "<br>".toba_form::password($this->id_form ."_test", $estado, $this->maximo, $this->tamano, 'ef-input', $this->input_extra);
		}
		return $html;
	}
	
	function crear_objeto_js()
	{
		return "new ef_editable_clave({$this->parametros_js()})";
	}
}

//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que permite ingresar fechas
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_fecha extends toba_ef_editable
{
    static function get_lista_parametros()
    {
    	$param = toba_ef_editable::get_lista_parametros();
    	array_borrar_valor($param, 'edit_unidad');
    	return $param;
    }	
	
	function __construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		if (! isset($parametros['edit_tamano'])) {
			$parametros['edit_tamano'] = "10";//Esto deberia depender del tipo de fecha
		}
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
	}

	function cambiar_fecha($fecha,$sep_actual,$sep_nuevo){
		$f = explode($sep_actual,$fecha);
		$dia = str_pad($f[0],2,0,STR_PAD_LEFT);
		$mes = str_pad($f[1],2,0,STR_PAD_LEFT);
		return $f[2] . $sep_nuevo . $mes . $sep_nuevo .$dia;
 	}

	function set_estado($estado="")
	{
  		if($estado!="") {
    		$this->estado = $this->cambiar_fecha($estado,'-','/');
	    } else {
	    	$this->estado = null;	
	    }
	}

	function get_estado()
	{
		// En este punto se formatea la fecha
		if($this->tiene_estado()){
			return $this->cambiar_fecha($this->estado,'/','-');
		}else{
			return null;
		}
	}	
	
	function get_consumo_javascript()
	{
		$consumo = parent::get_consumo_javascript();
		$consumo[] = "efs/fecha";
		return $consumo;
	}
	
	function get_input()
	{
		$tab = $this->padre->get_tab_index();
		$this->input_extra .= " tabindex='$tab'";
		$html = "<span class='ef-fecha'>";
		$html .= toba_form::text($this->id_form,$this->estado,$this->solo_lectura,$this->tamano,
								$this->tamano, $this->estilo, $this->input_extra);
		if (! $this->solo_lectura) {
			$html .= "<a id='link_". $this->id_form . "' ";
			$html .= " onclick='calendario.select(document.getElementById(\"{$this->id_form}\"),\"link_".$this->id_form."\",\"dd/MM/yyyy\");return false;' ";
			$html .= " href='#' name='link_". $this->id_form . "'>".toba_recurso::imagen_apl('cal.gif',true,16,16,"Seleccione la fecha")."</a>\n";
		}
		$html .= "</span>\n";
		return $html;
	}
    
    function validar_estado()
	{
		$padre = parent::validar_estado();
		if ($padre !== true) {
			return $padre;	
		}
		if ($this->tiene_estado()) {
            $fecha = explode('/',$this->estado); 
            if (count($fecha) != 3) {
				return "El campo no es una fecha valida (3).";
            }
            if ( ! is_numeric($fecha[0]) || !is_numeric($fecha[1]) || !is_numeric($fecha[2]) ) {
				return "El campo no es una fecha valida (2).";
            }
            if (! checkdate($fecha[1],$fecha[0],$fecha[2])) {
				return "El campo no es una fecha valida (1).";
			}
		}
		return true;
   }
   
	function crear_objeto_js()
	{
		return "new ef_editable_fecha({$this->parametros_js()})";
	}		   
}
//########################################################################################################
//########################################################################################################

/**
 * Elemento editable que permite ingresar textos largos, equivalene a un tag <textarea>
 * @package Componentes
 * @subpackage Efs
 */
class toba_ef_editable_textarea extends toba_ef_editable
{
	protected $lineas;
	protected $resaltar;
	protected $wrap;
	protected $clase='ef-textarea';
	protected $no_margen;
	protected $ajustable;
	protected $maximo;
	
    static function get_lista_parametros()
    {
    	$param[] = 'edit_filas';
    	$param[] = 'edit_columnas';
    	$param[] = 'edit_wrap';
    	$param[] = 'edit_maximo';
    	$param[] = 'edit_resaltar';
    	$param[] = 'edit_ajustable';
    	return $param;
    }		
	
	function __construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros)
	{
		//Esta conversion es para no modificar ahora las definiciones, CAMBIAR!
		$this->lineas = isset($parametros['edit_filas']) ? $parametros['edit_filas'] : 6;
		$this->wrap = isset($parametros['edit_wrap']) ? $parametros['edit_wrap'] : "";
		if (isset($parametros['edit_resaltar'])){
			if($parametros['edit_resaltar']==1){
				$this->resaltar = 1;
			}
		}else{
			$this->resaltar = 0;
		}
		$parametros['edit_tamano'] = isset($parametros["edit_columnas"]) ? $parametros["edit_columnas"] : 40;
		
		if(isset($parametros['edit_maximo']) && $parametros['edit_maximo']!="") {
			$maximo = $parametros['edit_maximo'];
			unset($parametros['edit_maximo']);
		}
		$this->ajustable = isset($parametros['edit_ajustable']) ? $parametros['edit_ajustable'] : false;
		unset($parametros['edit_filas']);
		unset($parametros['edit_columnas']);
		parent::__construct($padre,$nombre_formulario, $id,$etiqueta,$descripcion,$dato,$obligatorio,$parametros);
		
		if (isset($maximo)) {
			$this->maximo = $maximo;	
		} else {
			$this->maximo = null;	
		}
	}

	function get_consumo_javascript()
	{
		$consumo = parent::get_consumo_javascript();
		//Consumo la clase para hacer resize de los textarea
		if ($this->ajustable)
			$consumo[] = "efs/resizeTa";
		return $consumo;
	}

	function get_input()
	{	
		if (!isset($this->estado)) {
			$this->estado = '';	
		}
		$html = "";
		if($this->solo_lectura){
			$html .= toba_form::textarea( $this->id_form, $this->estado, $this->lineas, $this->tamano, $this->clase, $this->wrap, " readonly");
		}else{
			if($this->resaltar){
				$javascript = " onclick='javascript: document.getElementById('{$this->id_form}').select()'";
				$html .= toba_form::button($this->id_form . "_res", "Seleccionar", $javascript );
			}
			if ($this->maximo) {
				$obj = $this->objeto_js();
				$this->javascript .= "onkeydown=\"$obj.validar()\" onkeyup=\"$obj.validar()\"";
			}
			$tab = $this->padre->get_tab_index();
			$this->input_extra .= " tabindex='$tab'";
			$html .= toba_form::textarea( $this->id_form, $this->estado,$this->lineas,$this->tamano,$this->clase,$this->wrap,$this->javascript.' '.$this->input_extra);
		}
		return $html;
	}
	
	function set_estado($estado)
	{
		parent::set_estado($estado);
		if ($this->maximo) {
			if (strlen($this->estado) > $this->maximo) {
				$this->estado = substr($this->estado, 0, $this->maximo);
			}
		}
	}
	
	function crear_objeto_js()
	{
		return "new ef_editable_multilinea({$this->parametros_js()})";
	}			
	
	function parametros_js()
	{
		$maximo = isset($this->maximo) ? "'{$this->maximo}'" : 'null';
		$ajustable = ($this->ajustable) ? "true" : "false";
		return parent::parametros_js().", $maximo, $ajustable";	
	}
}
//########################################################################################################
//########################################################################################################
         
?>
