<?
/**
*	Administra la utilizacion de bases de datos
*	Esto es suministrar las conexiones, crear, borrar y consultar su existencia.
*
*	ATENCION: 	- hay que sacar la suposicion de que si no se pasa un nombre se utilice la conexion 'instancia'
*					(algo puede funcionar en el administrador y dejar de andar en un proyecto)
*				- Hay que buscar una forma mejor de menejar las conexiones a la instancia que con 'instancia'
*/
class dba
{
	const path_archivo_bases = '/instalacion/info_bases.php';
	const db_encoding_estandar = 'LATIN1';
	private static $dba;						// Implementacion del singleton.
	private static $info_bases;					// Parametros de las conexiones abiertas
	private $bases_conectadas = array();		// Conexiones abiertas

	private function __construct(){}
	
	//------------------------------------------------------------------------
	// Administracion de conexiones
	//------------------------------------------------------------------------

	/**
	*	Retorna una referencia a una CONEXION con una base
	*	@param string $nombre Por defecto toma la constante fuente_datos_defecto o la misma base de toba
	*	@return db
	*/
	static function get_db( $nombre=null )
	{
		$dba = self::get_instancia();
		if ( is_null( $nombre ) ) {
			//ATENCION: estoy hay que sacarlo no esta bueno asumir 'instancia'
			$nombre = (defined('fuente_datos_defecto')) ? fuente_datos_defecto : 'instancia';
		}
		return $dba->get_conexion( $nombre );
	}
	
	/**
	*	�Hay una conexi�n abierta a la base?
	*/
	static function existe_conexion( $nombre )
	{
		return self::get_instancia()->existe_conexion_privado( $nombre );	
	}

	/**
	*	Fuerza la recarga de los parametros de una conexion y reconecta a la base
	*/	
	static function refrescar( $nombre )
	{
		$dba = self::get_instancia();
		$dba->desconectar_db( $nombre );
		return self::get_db( $nombre );
	}

	/**
	*	Desconecta una DB
	*/	
	static function desconectar( $nombre )
	{
		$dba = self::get_instancia();
		$dba->desconectar_db( $nombre );
	}
		
	//------------------------------------------------------------------------
	// Mantenimiento de BASES de DATOS
	//------------------------------------------------------------------------

	/**
	*	Crea la base de datos asociada a la fuente
	*	@param string $nombre Nombre de la fuente de datos
	*/
	static function crear_base_datos( $nombre )
	{
		$info_db = self::get_parametros_base( $nombre );
		$base_a_crear = $info_db['base'];
		if($info_db['motor']=='postgres7')
		{
			$info_db['base'] = 'template1';
			$info_db['fuente_datos'] = 'template1';
			$db = self::conectar_db( $info_db );
			$sql = "CREATE DATABASE $base_a_crear ENCODING '" . self::db_encoding_estandar . "';";
			$db->ejecutar( $sql );
		}else{
			throw new excepcion_toba("El metodo no esta definido para el motor especificado");
		}
	}

	/**
	*	Borra la base de datos asociada a la fuente
	*	@param string $nombre Nombre de la fuente de datos
	*/	
	static function borrar_base_datos( $nombre )
	{
		$info_db = self::get_parametros_base( $nombre );
		$base_a_borrar = $info_db['base'];
		if($info_db['motor']=='postgres7')
		{
			$info_db['base'] = 'template1';
			$info_db['fuente_datos'] = 'template1';
			$db = self::conectar_db($info_db);
			$sql = "DROP DATABASE $base_a_borrar;";
			$db->ejecutar($sql);
		}else{
			throw new excepcion_toba("El metodo no esta definido para el motor especificado");
		}
	}

	/**
	*	Determina si la base de datos de la fuente existe
	*	@param string $nombre Nombre de la fuente de datos
	*/
	static function existe_base_datos( $nombre )
	{
		try{
			$info_db = self::get_parametros_base( $nombre );
			$info_db['fuente_datos'] = 'test';
			$db = self::conectar_db( $info_db );
			$db->destruir();
		}catch(excepcion_toba $e){
			return false;
		}
		return true;
	}

	//------------------------------------------------------------------------
	// Servicios internos
	//------------------------------------------------------------------------

	/**
	*	Manejo interno de las conexiones realizadas
	*/
	private function get_conexion( $nombre )
	{
		if( ! isset( $this->bases_conectadas[$nombre] ) ) {
			if	( $nombre == 'instancia' ) {
				$parametros = $this->get_info_db_instancia();
				$this->bases_conectadas[$nombre] = self::conectar_db( $parametros );
			} else {
				//Busco los parametros de la fuente de datos
				$parametros = self::get_info_db_fuente_datos( $nombre );
				//Si los parametros indican un link a una base abierta, reaprovecho la conexion
				$link = ( isset( $parametros['link_base_archivo'] ) && ( $parametros['link_base_archivo'] == 1 ) );
				$db_abierta = ( isset( $this->bases_conectadas[$parametros['fuente_datos']] ) );
				if ( $link && $db_abierta ) {
					$this->bases_conectadas[$nombre] = $this->bases_conectadas[$parametros['fuente_datos']];
				} else {
					// Conecto la base
					$this->bases_conectadas[$nombre] = self::conectar_db( $parametros );
				}
			}
		}
		return $this->bases_conectadas[$nombre];
	}
	
	/**
	*	Recupera la informacion de conexion de la instancia
	*/
	static function get_info_db_instancia()
	{
		if ( ! isset( self::$info_bases['instancia'] ) ) {
			if ( ! defined('apex_pa_instancia') ) {
				throw new excepcion_toba("DBA: La instancia no se encuentra definida (no exite la constante 'apex_pa_instancia')");
			}
			//incluyo el archivo de informacion basica de la INSTANCIA
			$archivo = toba_dir() . '/instalacion/i__' . apex_pa_instancia . '/info_instancia.php';
			if ( is_file( $archivo ) ) {
				require_once( $archivo );
			} else {
				throw new excepcion_toba("DBA: No se encuentra definido el archivo de inicializacion de la INSTANCIA: '".apex_pa_instancia."' ('$archivo')");
			}
			//Identifico la BASE
			$id_base = info_instancia::get_base();
			$datos_conexion = self::get_parametros_base( $id_base );
			$datos_conexion['fuente_datos'] = 'instancia';
			self::$info_bases['instancia'] = $datos_conexion;
		}
		return self::$info_bases['instancia'];
	}

	/**
	*	Busca la definicion de una FUENTE de DATOS declarada en el toba. 
	*		Si la fuente esta marcada como 'link_instancia', 
	*		busca la definicion en el archivo de bases
	*/
	static function get_info_db_fuente_datos( $nombre )
	{
		if ( ! isset( self::$info_bases[$nombre] ) ) {
			$sql = "SELECT 	*,
							link_instancia 		as link_base_archivo,
							fuente_datos_motor 	as motor,
							host 				as profile
					FROM 	apex_fuente_datos
					WHERE	fuente_datos = '$nombre'";
			$rs = consultar_fuente( $sql, 'instancia' );
			if (!$rs || count($rs) == 0) {
				throw new excepcion_toba("La FUENTE de DATOS '$nombre' no fue definida");
			}
			$datos_db = $rs[0];
			//Es un link al archivo de instancias?
			if ( $datos_db['link_base_archivo'] == 1 ) {
				//La ausencia de 'instancia_id' indica que hay que usar la conexion a la instancia
				$id_base = ( isset( $datos_db['instancia_id'] ) ) ? $datos_db['instancia_id'] : 'instancia';
				$datos_conexion = array_merge( $datos_db, self::get_parametros_base( $id_base ) );
				$datos_conexion['fuente_datos'] = $id_base;
			}
			self::$info_bases[$nombre] = $datos_conexion;
		}
		return self::$info_bases[$nombre];
	}

	/**
	*	Busca la definicion de una base en el archivo de bases 
	*/
	static function get_parametros_base( $id_base )
	{
		if(! class_exists('info_bases') ) {
			self::incluir_archivo_bases();
		}
		$bases_registradas = get_class_methods('info_bases');
		if ( in_array($id_base, $bases_registradas) ) {
			return info_bases::$id_base();
		} else {
			throw new excepcion_toba("La BASE '$id_base' no esta definida en el archivo de bases: '" . self::path_archivo_bases . "'" );
		}
	}

	/*
	*	Devuelve la lista de bases del archivo de bases.
	*/
	static function get_lista_bases_archivo()
	{
		if(! class_exists('info_bases') ) {
			self::incluir_archivo_bases();
		}
		return get_class_methods('info_bases');
	}

	/*
	*	Incluye el archivo de bases
	*/
	private static function incluir_archivo_bases()
	{
		$archivo = toba_dir() . self::path_archivo_bases;
		if ( is_file( $archivo ) ) {
			require_once( $archivo );
		} else {
			throw new excepcion_toba("Atencion, no se encuentra definido el archivo de BASES: '$archivo'");	
		}
	}

	/**
	*	Creacion de conexiones
	*/
	private static function conectar_db($parametros)
	{
		if (isset($parametros['subclase_archivo'])) {
			$archivo = $parametros['subclase_archivo'];
		} else {
			$archivo = "db_" . $parametros['motor'] . ".php";
		}
		if (isset($parametros['subclase_nombre'])) {
			$clase = $parametros['subclase_nombre'];
		} else {
			$clase = "db_" . $parametros['motor'];
		}		
		require_once($archivo);
		$objeto_db = new $clase(	$parametros['profile'],
									$parametros['usuario'],
									$parametros['clave'],
									$parametros['base'] );
		$conexion = $objeto_db->conectar();
		//--------  MIGRACION 0.8.3 --------------			
		//Como puente de migracion de versiones anteriores la bd se almacena como global
		global $db;
		$db[$parametros['fuente_datos']][apex_db_con] = $objeto_db;
		//-------------------------------------------
		return $objeto_db;
	}

	/**
	*	Fuerza a reconectar en el proximo pedido de bases
	*/
	private function desconectar_db($nombre)
	{
		if ( isset( self::$info_bases[$nombre] ) ) {
			unset( self::$info_bases[$nombre] );
		}
		if ( isset( $this->bases_conectadas[$nombre] ) ) {
			$this->bases_conectadas[$nombre]->destruir();
			unset( $this->bases_conectadas[$nombre] );
		}
	}		

	private function existe_conexion_privado( $nombre )
	{
		return isset($this->bases_conectadas[$nombre]);
	}

	/**
	*	Devuelve una referencia a la instancia
	*/
	private static function get_instancia()
	{
	   if (!isset(self::$dba)){
		   $c =	__CLASS__;
		   self::$dba = new $c;
	   }
	   return self::$dba;
	}
}
?>