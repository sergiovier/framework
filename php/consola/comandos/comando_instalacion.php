<?
require_once('comando_toba.php');
require_once('modelo/instalacion.php');

class comando_instalacion extends comando_toba
{
	static function get_info()
	{
		return "Administracion de la INSTALACION. (Trabajo sobre el conjunto que carpetas que conforman al toba)";
	}

	//-------------------------------------------------------------
	// Opciones
	//-------------------------------------------------------------

	/**
	*	Muestra los proyectos existentes dentro de la instalacion
	*/
	function opcion__proyectos()
	{
		instalacion::set_toba_dir( $this->get_dir_raiz() );
		$proyectos = instalacion::get_lista_proyectos();
		print_r( $proyectos );		
	}
	
	/**
	*	Migracion de definicion de instancias entre las versiones 0.8.3.3 y 0.8.4.
	*	Esto no esta en el comando conversion porque es pre-conexion.
	*/
	function opcion__migrar_definicion()
	{
		require_once('instancias.php');
		instalacion::set_toba_dir( $this->get_dir_raiz() );
	
		//*** 0) Creo la carpeta INSTALACION
	
		$this->manejador_interface->titulo( "Crear carpeta 'instalacion'" );
		instalacion::crear_directorio();
		$this->manejador_interface->mensaje( "Toda la informacion relacionada con la instalacion esta en esta carpeta");
	
		//*** 1) BASES
	
		$bases_registradas = array();
		$this->manejador_interface->titulo( "Migrar la definicion de BASES. (php/instancias.php)" );
		if( ! instalacion::existe_info_bases() ) {
			foreach( $instancia as $i => $datos ) {
			    $base['motor']= $datos[apex_db_motor];
			    $base['profile'] = $datos[apex_db_profile];
			    $base['usuario'] = $datos[apex_db_usuario];
			    $base['clave'] = $datos[apex_db_clave];
			    $base['base'] = $datos[apex_db_base];
				$bases_registradas[] = $i;
				$bases[$i] = $base;
			}
			instalacion::crear_info_bases( $bases );
			$this->manejador_interface->mensaje("la definicion de BASES se encuentra ahora en '" . instalacion::archivo_info_bases() . "'");	
		} else {
			$this->manejador_interface->error( "ya existe una archivo '" . instalacion::archivo_info_bases() . "'" );
		}
	
		// *** 2) CLAVES
	
		$this->manejador_interface->titulo( "Migrar la definicion de CLAVES. (php/instancias.php)" );
		if( ! instalacion::existe_info_basica() ) {
			instalacion::crear_info_basica( apex_clave_get, apex_clave_db);
			$this->manejador_interface->mensaje("la definicion de CLAVES se encuentra ahora en '" . instalacion::archivo_info_basica() . "'");	
		} else {
			$this->manejador_interface->error( "ya existe una archivo '" . instalacion::archivo_info_basica() . "'" );
		}
	
		// *** 3) INSTANCIAS
	
		$this->manejador_interface->titulo( "Migrar INSTANCIAS toba" );
		$this->manejador_interface->mensaje( "Indique que BASES son INSTANCIAS toba"); 
		//Busco la lista de proyectos de la instalacion
	
		$proyectos = instalacion::get_lista_proyectos();
	
		//Creo las instancias, preguntando en cada caso
		//Existe la opcion de conectarse a la base y preguntar si existe la tabla 'apex_objeto',
		//pero puede ser que por algun motivo la base no este online y sea una instancia
		foreach( $instancia as $i => $datos ) {
			if( $datos[apex_db_motor] == 'postgres7' ) {
				$this->manejador_interface->separador("BASE: $i");
				print_r($datos);
				if ( $this->manejador_interface->dialogo_simple("La base '$i' corresponde a una INSTANCIA TOBA?") ) {
					if( instalacion::existe_carpeta_instancia( $i ) ) {
						$this->manejador_interface->error("No es posible crearla instancia '$i'");
						$this->manejador_interface->mensaje("Ya exite una carpeta: $path"); 	
					} else {
						instalacion::crear_instancia( $i, $i, $proyectos );
					}
				}
			}
		}
		
		$this->manejador_interface->separador("FIN");		
		$this->manejador_interface->mensaje("Puede borrar el archivo 'php/instancias.php'");
		$this->manejador_interface->mensaje("Toda la informacion correspondiente a la instalacion, se encuentra ahora en la carpeta 'instalacion'");
	}
}
?>