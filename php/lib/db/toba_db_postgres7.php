<?php
/**
 * Driver de conexi�n con postgres
 * @package Fuentes
 * @subpackage Drivers
 */
class toba_db_postgres7 extends toba_db
{
	protected $cache_metadatos = array(); //Guarda un cache de los metadatos de cada tabla
	
	function __construct($profile, $usuario, $clave, $base, $puerto)
	{
		$this->motor = "postgres7";
		parent::__construct($profile, $usuario, $clave, $base, $puerto);
	}

	function get_dsn()
	{
		$puerto = ($this->puerto != '') ? "port={$this->puerto}": '';
		return "pgsql:host=$this->profile;dbname=$this->base;$puerto";	
	}

	/**
	*	Recupera el valor actual de una secuencia
	*	@param string $secuencia Nombre de la secuencia
	*	@return string Siguiente numero de la secuencia
	*/	
	function recuperar_secuencia($secuencia)
	{
		$sql = "SELECT currval('$secuencia') as seq;";
		$datos = $this->consultar($sql);
		return $datos[0]['seq'];
	}
		
	function retrazar_constraints()
	{
		$this->ejecutar("SET CONSTRAINTS ALL DEFERRED");
		toba_logger::instancia()->debug("************ Se retraza el chequeo de constraints ****************", 'toba');		
	}

	function abrir_transaccion()
	{
		$sql = 'BEGIN TRANSACTION';
		$this->ejecutar($sql);
		toba_logger::instancia()->debug("************ ABRIR transaccion ($this->base@$this->profile) ****************", 'toba');
	}
	
	function abortar_transaccion()
	{
		$sql = 'ROLLBACK TRANSACTION';
		$this->ejecutar($sql);		
		toba_logger::instancia()->debug("************ ABORTAR transaccion ($this->base@$this->profile) ****************", 'toba'); 
	}
	
	function cerrar_transaccion()
	{
		$sql = "COMMIT TRANSACTION";
		$this->ejecutar($sql);		
		toba_logger::instancia()->debug("************ CERRAR transaccion ($this->base@$this->profile) ****************", 'toba'); 
	}

	
	/**
	*	Recupera el valor actual de una secuencia. Requiere la extension origineal pgsql
	*	@param string $tabla Nombre de la tabla en la que se insertar�n los datos
	*	@param array $datos Los datos a insertar: cada elemento del arreglo ser� un registro en la tabla.
	*	@param string $delimitador Separador de datos de cada fila.
	*	@param string $valor_nulo Cadena que se utlilizar� como valor nulo.
	*	@return boolean Retorn TRUE en caso de �xito o FALSE en caso de error.
	*/
	function insert_masivo($tabla,$datos) {	
		$puerto = ($this->puerto != '') ? "port={$this->puerto}": '';
		$host = "host={$this->profile}";
		$base =  "dbname={$this->base}";
		$usuario = "user={$this->usuario}";
		$clave = "password={$this->clave}";		
		$conn_string = "$host $puerto $base $usuario $clave";
		$dbconn = pg_connect($conn_string);
		$salida = pg_copy_from($dbconn,$tabla,$datos);
		pg_close($dbconn);
		return $salida;
	}

	
	//------------------------------------------------------------------------
	//-- INSPECCION del MODELO de DATOS
	//------------------------------------------------------------------------

	function get_lista_tablas($esquema=null)
	{
		$sql_esquema = '';
		if (isset($esquema)) {
			$sql_esquema .= " AND schemaname='$esquema'";
		}
		$sql = "SELECT tablename as nombre
				FROM pg_tables
				WHERE 
						tablename NOT LIKE 'pg_%'
					AND tablename NOT LIKE 'sql_%' 
					$sql_esquema
				ORDER BY nombre
		";
		return $this->consultar($sql);
	}
	
	function existe_columna($columna, $tabla)
	{
		$sql = "
				SELECT 	a.attname as nombre
				FROM 	pg_class c,
						pg_type t,
						pg_attribute a 	
				WHERE c.relkind in ('r','v') 
				AND c.relname='$tabla'
				AND a.attname not like '....%%'
				AND a.attnum > 0 
				AND a.atttypid = t.oid 
				AND a.attrelid = c.oid 
				ORDER BY a.attnum;		
		";
		foreach ($this->consultar($sql) as $campo) {
			if ($campo['nombre'] == $columna) {
				return true;
			}
		}
		return false;
	}
	
	function get_lista_secuencias()
	{
		$sql = "
			SELECT 
				c.relname as tabla,
				a.attname as campo,
				replace( substring(adef.adsrc,'\'[^\']*\''), '\'', '' ) as nombre
			FROM
				pg_catalog.pg_attribute a LEFT JOIN pg_catalog.pg_attrdef adef ON a.attrelid=adef.adrelid AND a.attnum=adef.adnum
					 LEFT JOIN pg_catalog.pg_type t ON a.atttypid=t.oid
					 LEFT JOIN pg_catalog.pg_class c ON a.attrelid=c.oid
			WHERE
			 	adsrc like '%nextval%'
			 	AND a.attnum > 0 AND NOT a.attisdropped
			ORDER BY a.attname
		";
		return $this->consultar($sql);
	}
	
	/**
	*	Busca la definicion de un TABLA. Cachea los resultados por un pedido de pagina
	*/
	function get_definicion_columnas($tabla, $esquema=null)
	{
		$where = '';
		if (isset($esquema)) {
			$where .= " AND n.nspname = '$esquema'";
		}
		if (isset($this->cache_metadatos[$tabla])) {
			return $this->cache_metadatos[$tabla];
		}
		//1) Busco definicion
		$sql = "SELECT 	a.attname as 			nombre,
						t.typname as 			tipo,
						a.attlen as 			tipo_longitud,
						a.atttypmod as 			longitud,
						format_type(a.atttypid, a.atttypmod) as tipo_sql,
						a.attnotnull as 		not_null,
						a.atthasdef as 			tiene_predeterminado,
						d.adsrc as 				valor_predeterminado,
						ic.relname AS 			nombre_indice,
						i.indisunique AS 		uk,
						i.indisprimary AS 		pk,
						'' as					secuencia,
						fc.relname				as fk_tabla,
						fa.attname				as fk_campo,						
						a.attnum as 			orden
				FROM 	pg_class c,
						pg_type t,
						pg_namespace as n,						
						pg_attribute a 	
							LEFT OUTER JOIN pg_attrdef d
								ON ( d.adrelid = a.attrelid AND d.adnum = a.attnum)
							--- Foreign Keys
							LEFT OUTER JOIN (pg_constraint const 
												INNER JOIN pg_class fc ON fc.oid = const.confrelid
												INNER JOIN pg_attribute fa ON (fa.attrelid = const.confrelid AND fa.attnum = const.confkey[1]
																				AND const.confkey[2] IS NULL) 
											)
								ON (const.conrelid = a.attrelid
										AND const.contype='f'
										AND const.conkey[1] = a.attnum
								)
							---- Indices
							LEFT OUTER JOIN ( pg_index i INNER JOIN pg_class ic ON ic.oid = i.indexrelid ) 
								ON ( a.attrelid = i.indrelid 
									AND (i.indkey[0] = a.attnum 
										OR i.indkey[1] = a.attnum 
										OR i.indkey[2] = a.attnum 
										OR i.indkey[3] = a.attnum 
										OR i.indkey[4] = a.attnum 
										OR i.indkey[5] = a.attnum 
										OR i.indkey[6] = a.attnum 
										OR i.indkey[7] = a.attnum) )
				WHERE 
						c.relkind in ('r','v') 
					AND c.relname='$tabla'
					AND a.attname not like '....%%'
					AND a.attnum > 0 
					AND a.atttypid = t.oid 
					AND a.attrelid = c.oid 
						$where
				ORDER BY a.attnum;";
		$columnas = $this->consultar($sql);
		if(!$columnas){
			throw new toba_error("La tabla '$tabla' no existe");	
		}
		//2) Normalizo VALORES
		$procesadas = array();
		$columnas_booleanas = array('uk','pk','not_null','tiene_predeterminado');
		foreach(array_keys($columnas) as $id) {
			//El query de arriba duplica columnas si pertenecen a mas de un indice...
			//Esto es un fix momentaneo que anda para la mayoria de los casos...(jaja?)
			if(isset($procesadas[$columnas[$id]['nombre']])) {
				unset($columnas[$id]);
				continue;
			}
			//Estas columnas manejan string en vez de booleanos
			foreach($columnas_booleanas as $x) {
				if($columnas[$id][$x]=='t'){
					$columnas[$id][$x] = true;
				}else{
					$columnas[$id][$x] = false;
				}
			}
			//Tipo de datos generico
			$columnas[$id]['tipo'] = $this->get_tipo_datos_generico($columnas[$id]['tipo']);
			//longitudes
			//-- Si el tipo es -1 es que es 'varlena' http://www.postgresql.org/docs/7.4/static/catalog-pg-type.html
			//-- Para el caso de varchar hay que restarle 4
			if($columnas[$id]['tipo_longitud'] <= 0){
				$columnas[$id]['longitud'] = $columnas[$id]['longitud'] - 4;
			}
			//-- Si es numerico(a,b) la longitud es 327680*b+a, pero para facilitar el proceso general se usa -1
			if ($columnas[$id]['tipo'] == 'numeric') {
				$columnas[$id]['longitud'] = -1;
			}
			//Secuencias
			if($columnas[$id]['tiene_predeterminado']){
				$match = array();
				if(preg_match("&nextval.*?(\'|\")(.*?[.]|)(.*)(\'|\")&",$columnas[$id]['valor_predeterminado'],$match)){
					$columnas[$id]['secuencia'] = $match[3];
				}			
			}
			//Guardo las que procese
			$procesadas[$columnas[$id]['nombre']] = $id;
		}
		$this->cache_metadatos[$tabla] = array_values($columnas);
		return $this->cache_metadatos[$tabla];
	}
}
?>