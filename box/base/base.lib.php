<?php
	if(!defined("BASE_LIB")){
		define("BASE_LIB",1);

		require($_SERVER['DOCUMENT_ROOT']."/box/servidor/server.mysql.php");
		date_default_timezone_set('America/Mexico_City');
		/*
		*	funcion para conectar a la base de datos, no recibe datos
		*/
		function conectar(){
			$link=dbConnect();
			if($link){
		//		mysqli_query("SET time_zone = '-6:00';");

				return $link;
			}
			else{
				return false;
			}
		}


		/*
		*	funcion para agregar un elemento, recibe:
		*	datos: es un arreglo
		*	tabla: la tabla a donde se va agregar
		*	return el numero del key frame recien puesto
		*/
		function agregar($datos, $tabla){
			$link=conectar();
			if($link){
				if(is_array($datos)){
					$dato="";
					$k="";
					$i=0;
					foreach($datos as $key => $value){

						$value= trim($value);

						if($i==0){
							$dato = "'$value'";
							$k = $key;
							$i++;
						}
						else{
							$dato .= ", '$value'";
							$k .= ", $key";
						}
					}

					//mysqli_query($link, "SET time_zone = '-6:00';");

					$query = "INSERT INTO $tabla ($k) VALUES ($dato)";
					//print($query);
					$result = dbQuery($query, $link);
					return mysqli_insert_id($link);
				}
			}
		}

		/*
		*	funcion para actualizar la info, recibe:
		*	datos: es un arreglo
		*	tabla: la tabla a donde se va a actualizar la info
		*	id: el id de la primary key de la tabla
		*	nombre_primary: es el nombre de la primary key
		*/
		function actualizar($datos, $tabla, $id, $nombre_primary){
			$link=conectar();
			if($link){
				if(is_array($datos)){
					$dato="";
					$k="";
					$i=0;
					foreach( $datos as $key => $value){

						$value= trim($value);

						if($i==0){
							$dato = "$key='$value'";
							$i++;
						}
						else{
							$dato .= ", $key = '$value'";
						}
					}


					//mysqli_query($link, "SET time_zone = '-6:00';");

					$query = "UPDATE $tabla SET $dato WHERE $nombre_primary ='$id'";
					$result = dbQuery($query, $link);
					return $result;
				}
			}

		}


		/*
		*	funcion para eliminar la info, recibe:
		*	tabla: la tabla a donde se va a eliminar la info
		*	id: el id de la primary key de la tabla
		*	nombre_primary: es el nombre de la primary key
		*/
		function eliminar($tabla, $id, $nombre_primary){
			$link=conectar();
			if($link){
				$query = "DELETE FROM $tabla WHERE $nombre_primary='$id'";
				$result = dbQuery($query, $link);
			}
		}


		/*
		*	funcion para consultar la info, recibe:
		*	$query: es la instucci�n de la consulta
		*	regresa el resultado del $query.
		*/
		function consultar($query){
			$link=conectar();
			if($link){
				$result = dbQueryArray($query, $link);
				return $result;
			}

		}

		function contar($query){
			$link=conectar();
			if($link){
				$result = dbQueryArray($query, $link);
				if(count($result) != 0){ $result = $result[0]['suma'];  }else{ $result=0; }
				return $result;
			}
		}


		function pullQuery($query){
			$link=conectar();
			if($link){
				$result = dbQueryArray($query, $link);
				return $result;
			}
		}

		function ejecutarQuery($query){
			$link=conectar();
			if($link){
				$result =dbQuery($query, $link);
				return $result;
			}
		}

		function mandarQuery($query){
			$link=conectar();
			if($link){
				$result =dbQuery($query, $link);
				return $result;
			}
		}
	}

?>
