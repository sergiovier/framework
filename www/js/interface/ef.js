var apex_ef_no_seteado = 'nopar';

//--------------------------------------------------------------------------------
//Clase ef
function ef(id_form, etiqueta, obligatorio) {
	this._id = null;						//El id lo asigna el formulario cuando lo inicia
	this._id_form = id_form;				//El id_form es la clave que permite identificarlo univocamente
	this._id_form_orig = this._id_form;
	this._etiqueta = etiqueta;
	this._obligatorio = obligatorio;
	this._error = null;
}
var def = ef.prototype;
def.constructor = ef;

	//---Servicios de inicio y finalizaci�n 
	def.iniciar = function(id) {
		this._id = id;
	}

	def.validar = function () {
		return true;
	}	
	
	def.submit = function () {
	}		
	
	//---Consultas	
	def.id = function() { 
		return this._id;	
	}
	
	def.valor = function() {
		return this.input().value;
	}
	
	def.valor_formateado = function() {
		return this.valor();
	}	

	//Retorna el formato en modo texto de valor
	def.formato_texto = function (valor) {
		return valor;
	}
	
	def.input = function() {
		return document.getElementById(this._id_form);
	}
	
	def.tab = function () {
		return this.input().tabIndex;
	}

	def.error = function() {
		return this._error;
	}
	
	//---Comandos 
	def.resetear_error = function() {
		delete(this._error);
	}

	def.seleccionar = function () {
		try {
			this.input().focus();
			this.input().select();
			return true;
		} catch(e) {
			return false;
		}
	}
	
	def.activo = function() {
		return !(this.input().disabled);
	}
	
	def.desactivar = function () {
		this.input().disabled = true;
	}

	def.activar = function () {
		this.input().disabled = false;		
	}
	
	
	def.cambiar_tab = function(tab_index) {
		this.input().tabIndex = tab_index;
	}
	
	def.cambiar_valor = function(nuevo) {
		this.input().value = nuevo;
	}
	
	//cuando_cambia_valor (disparar_callback)
	def.cuando_cambia_valor = function(callback) { 
		addEvent(this.input(), 'onchange', callback);
	}

	//Multiplexacion, permite tener varias instancias del ef
	def.ir_a_fila = function(fila) {
		this._id_form = this._id_form_orig + fila;
		return this;	
	}
	
	//Multiplexacion, deja sin seleccionar la fila en la que est� 
	def.sin_fila = function() {
		this._id_form = this._id_form_orig;
		return this;
	}	


	