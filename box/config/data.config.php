<?php
	
	if(!defined("CONFIG_DATA_LIB")){
		define("CONFIG_DATA_LIB",1);
			
		/*****************
		****	VERSION TOTALPAT
		*****************/
		$versionTotal=$controlVer="1.0";
		
		
		/*****************
		****	HEADERS
		*****************/
		header("Content-Type: text/html; charset=UTF-8");
		header("Pragma: public"); // required
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Cache-Control: private",false); // required for certain browsers
		header("Cache-Control: public",false); // required for certain browsers 
		header("Cache-Control: no-cache, must-revalidate");
		date_default_timezone_set('America/Mexico_City');
		
		/*****************
		****	LIGAS INICIALES
		*****************/
		//constantes para enrutar a las librerias
		$carpeta="";
		
		define("DOMINIO_HASH", SUB_DOMINIO.".".CARPETA_DOMINIO."");
		define("DOMINIO_PATH", "https://".DOMINIO_HASH."/".$carpeta);
		define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);
		define("SCRIPT_PATH", "https://".DOMINIO_HASH."/".$carpeta);
		define("IMAGES_PATH", "https://".DOMINIO_HASH."/".$carpeta);
		define("DOMINIO_CLIENTE", "https://".SUB_DOMINIO.".".CARPETA_DOMINIO."");
		define('TIME_LOCK', 1000);
	
		/*****************
		****	BASE DE DTAOS
		*****************/
		define("DB_HOST","localhost");
		//define("DB_HOST","216.144.236.22");
		define("DB","intoeng1_base_de_datos");
		define("DB_USER","intoeng1_develop");
		define("DB_PASSWD","Marban85.");
		//define("DB_PASSWD","caballito");
		
	}
		
?>
