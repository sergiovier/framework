<?php

class toba_migracion_1_4_0 extends toba_migracion
{
	/**
	 *  Se agrega la tabla:
	 *				-  apex_objeto_cuadro_col_cc
	 */
	function instancia__cambios_estructura()
	{
		$sql = array();
		//-----------------Tabla para especificar que columnas participan de la sumatoria de un corte de control----------------------
		$sql[] = 'CREATE TABLE apex_objeto_cuadro_col_cc(
							objeto_cuadro_cc BIGINT NULL,
							objeto_cuadro_proyecto VARCHAR(15) NULL,
							objeto_cuadro BIGINT NULL,
							objeto_cuadro_col BIGINT NULL,
							total SMALLINT NULL DEFAULT 0,
						CONSTRAINT pkapex_objeto_cuadro_col_cc	PRIMARY KEY (objeto_cuadro_cc, objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col)
						);';

		$sql[] = 'ALTER TABLE apex_objeto_cuadro_col_cc ADD CONSTRAINT fk_apex_objeto_cuadro_col_cc_apex_objeto_cuadro_cc FOREIGN KEY (objeto_cuadro_cc, objeto_cuadro_proyecto, objeto_cuadro)
					REFERENCES apex_objeto_cuadro_cc (objeto_cuadro_cc, objeto_cuadro_proyecto, objeto_cuadro) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';

		$sql[]= 'ALTER TABLE apex_objeto_cuadro_col_cc ADD CONSTRAINT fk_apex_objeto_cuadro_col_cc_apex_objeto_ei_cuadro_columna FOREIGN KEY (objeto_cuadro_col, objeto_cuadro, objeto_cuadro_proyecto)
					REFERENCES apex_objeto_ei_cuadro_columna (objeto_cuadro_col, objeto_cuadro, objeto_cuadro_proyecto) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';

		//----------------- Tabla para asociar objetos a las pantallas-------------------------------------
		$sql[] = 'CREATE TABLE apex_objetos_pantalla(
							proyecto VARCHAR(15) NULL,
							pantalla BIGINT NULL,
							objeto_ci BIGINT NULL,
							orden SMALLINT NULL,
							dep_id BIGINT NULL,
							CONSTRAINT apex_objetos_pantalla_pk	PRIMARY KEY (proyecto, objeto_ci, pantalla, dep_id)
						);';
		$sql[] = 'ALTER TABLE apex_objetos_pantalla ADD CONSTRAINT apex_objetos_pantalla_apex_objeto_ci_pantalla_fk FOREIGN KEY (pantalla, objeto_ci, proyecto) 
						REFERENCES apex_objeto_ci_pantalla (pantalla, objeto_ci, objeto_ci_proyecto) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';

		$sql[] = 'ALTER TABLE apex_objetos_pantalla ADD CONSTRAINT apex_objetos_pantalla_apex_objeto_dependencias_fk FOREIGN KEY (dep_id, proyecto, objeto_ci) 
						REFERENCES apex_objeto_dependencias (dep_id, proyecto, objeto_consumidor) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';

		//----------------- Tabla para asociar eventos a las pantallas-------------------------------------
		$sql[] ='CREATE TABLE apex_eventos_pantalla(
							pantalla BIGINT NULL,
							objeto_ci BIGINT NULL,
							evento_id BIGINT NULL,
							proyecto VARCHAR(15) NULL,
							CONSTRAINT pkapex_eventos_pantalla	PRIMARY KEY (pantalla, objeto_ci, proyecto, evento_id)
						);';

		$sql[] ='ALTER TABLE apex_eventos_pantalla ADD CONSTRAINT apex_eventos_pantalla_apex_objeto_ci_pantalla_fk FOREIGN KEY (pantalla, objeto_ci, proyecto)
						REFERENCES apex_objeto_ci_pantalla (pantalla, objeto_ci, objeto_ci_proyecto) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';
		$sql[] = 'ALTER TABLE apex_eventos_pantalla ADD CONSTRAINT apex_eventos_pantalla_apex_objeto_eventos_fk FOREIGN KEY (evento_id, proyecto)
						REFERENCES apex_objeto_eventos (evento_id, proyecto) ON UPDATE NO ACTION ON DELETE NO ACTION DEFERRABLE INITIALLY IMMEDIATE;';
		
		$this->elemento->get_db()->ejecutar($sql);
	}

	/**
	 *  Se deserializan los campos de la sumatoria del corte de control y se generan registros nuevos
	 */
	function proyecto__normalizar_suma_cortes_cuadro()
	{
		$sql = "SELECT col.objeto_cuadro_proyecto, col.objeto_cuadro, col.objeto_cuadro_col, col.total_cc
					 FROM    apex_objeto_ei_cuadro_columna col
					WHERE
							col.total_cc IS NOT NULL AND
							col.total_cc <> '' AND
							col.objeto_cuadro_proyecto = '{$this->elemento->get_id()}'; ";

		$datos = $this->elemento->get_db()->consultar($sql);
		toba_logger::instancia()->debug('Sql ejecutada: '. $sql . "\n datos devueltos:");
		toba_logger::instancia()->var_dump($datos);

		$sql = array();
		foreach($datos as $corte){
			$cols_involucradas = explode(',' , $corte['total_cc']);
			$cols_involucradas = array_map('trim', $cols_involucradas);
			foreach($cols_involucradas as $columna){
				$sql[] = "INSERT INTO apex_objeto_cuadro_col_cc(objeto_cuadro_cc, objeto_cuadro_proyecto, objeto_cuadro, objeto_cuadro_col, total) 
								(SELECT  objeto_cuadro_cc, '{$corte['objeto_cuadro_proyecto']}',
												   '{$corte['objeto_cuadro']}', '{$corte['objeto_cuadro_col']}', '1'
								 FROM	apex_objeto_cuadro_cc
								 WHERE
									objeto_cuadro_proyecto =  '{$corte['objeto_cuadro_proyecto']}' AND
									objeto_cuadro = '{$corte['objeto_cuadro']}' AND
									identificador = '$columna'
								);";
			}
		}
		$this->elemento->get_db()->ejecutar($sql);
	}

	/**
	 * Se deserializa el campo que contiene las dependencias asociadas a las pantallas y se envia a una relacion
	 */
	function proyecto__normalizar_dependencias_pantallas()
	{
		$sql = "SELECT	cp.objeto_ci,
										cp.pantalla,
										cp.objetos
					FROM	apex_objeto_ci_pantalla cp
					WHERE
								cp.objeto_ci_proyecto = '{$this->elemento->get_id()}'
								AND cp.objetos IS NOT NULL
								AND cp.objetos <> ''
					ORDER BY objeto_ci, pantalla, orden;";
		
		$datos = $this->elemento->get_db()->consultar($sql);

		$sql = array();
		foreach($datos as $pant){
			$orden = 1;
			$obj_involucrados = explode(',' , $pant['objetos']);
			$obj_involucrados = array_map('trim' , $obj_involucrados);
			foreach($obj_involucrados as $dep){
				$sql[] = "INSERT INTO apex_objetos_pantalla (proyecto, pantalla, objeto_ci, orden, dep_id)
								(SELECT proyecto, '{$pant['pantalla']}', objeto_consumidor, '$orden',  dep_id
								FROM	apex_objeto_dependencias
								WHERE
									proyecto = '{$this->elemento->get_id()}' AND
									objeto_consumidor = '{$pant['objeto_ci']}' AND
									identificador = '{$dep}'
								); ";
				$orden++;
			}
		}
		$sql[] = "UPDATE apex_objeto_ci_pantalla SET objetos = NULL WHERE objeto_ci_proyecto = '{$this->elemento->get_id()}'; ";
		$this->elemento->get_db()->ejecutar($sql);
	}

	/**
	 * Se deserializa el campo que contiene los eventos asociados a la pantalla y se envia a una relacion
	 */
	function proyecto__normalizar_eventos_pantallas()
	{
		$sql = "SELECT cp.objeto_ci, cp.pantalla, cp.eventos
					 FROM	apex_objeto_ci_pantalla cp
					 WHERE	cp.objeto_ci_proyecto = '{$this->elemento->get_id()}'
					AND cp.eventos IS NOT NULL
					AND cp.eventos <> ''
					ORDER BY objeto_ci, pantalla, orden";
		$datos = $this->elemento->get_db()->consultar($sql);

		$sql = array();
		foreach($datos as $pant){
			$evt_involucrados = explode(',', $pant['eventos' ]);
			$evt_involucrados = array_map('trim', $evt_involucrados);
			foreach($evt_involucrados as $evento){
				$sql[] = "INSERT INTO apex_eventos_pantalla (proyecto, objeto_ci, pantalla, evento_id)
								(SELECT proyecto, objeto, '{$pant['pantalla']}', evento_id
								 FROM	apex_objeto_eventos
								 WHERE
										proyecto = '{$this->elemento->get_id()}' AND
										objeto = '{$pant['objeto_ci']}' AND
										identificador = '{$evento}' );";
			}
		}
		$sql[] = "UPDATE apex_objeto_ci_pantalla SET eventos = NULL WHERE objeto_ci_proyecto = '{$this->elemento->get_id()}'; ";
		$this->elemento->get_db()->ejecutar($sql);
	}
	
	/**
	 * Se cambia:
	 *	evt__limpieza_memoria por limpiar_memoria
	 */
	function proyecto__cambio_api_cn()
	{
		$editor = new toba_editor_archivos();
		$editor->agregar_sustitucion("|evt__limpieza_memoria|","limpiar_memoria");
		$archivos = toba_manejador_archivos::get_archivos_directorio( $this->elemento->get_dir(), '|.php|', true);
		$editor->procesar_archivos($archivos);
	}
}

?>