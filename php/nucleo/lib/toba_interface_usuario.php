<?php

interface toba_interface_usuario
{
	/*
		Debe llamarse antes que las demas,
		si ocure un fallo en la autentificacion debe disparar
		una excepcion de tipo 'toba_excepcion_login'
	*/
	function cargar($id_usuario, $clave=null);
	/*
		Deben llamarse despues que carga.
	*/
	function get_id();
	function get_nombre();
	function get_grupo_acceso();		//Tiene que manejar N proyectos actuales simultaneamente
	function get_fecha_vencimiento();
	function get_horario_permitido();
	function get_dias_semana_permitidos();
	function get_ip_permitida();
}
?>