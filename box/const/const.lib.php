<?php

	if(!defined("CONST_LIB")){
		define("CONST_LIB",1);

		define('SUB_DOMINIO', '');
		define('CARPETA_DOMINIO', 'intoenglish.com.mx');
		define('LOCK_TIME', '7200');

		$carpeta="";
		//libreria de configuracion	/home/totpat2/public_html/
		require($_SERVER['DOCUMENT_ROOT']."$carpeta/box/config/data.config.php");

		//var de sessiones
		$session_ruta="";

		//RUTAS DE CONSTANTES Y BASICAS
		define("SERVIDOR_PATH", ROOT_PATH."$carpeta/box/servidor/");
		define("BASE_PATH", ROOT_PATH."$carpeta/box/base/");

		define("COST_SCRIPT", SCRIPT_PATH."/box/const_script/");
		define("JAVASCRIPT_PATH", SCRIPT_PATH."/box/javascripts/");
		define("CSS_PATH", SCRIPT_PATH."/box/css/");
		define("CREATIVE_PATH", SCRIPT_PATH."$carpeta/box/shit_done_pro_1.4.3/");
		define("PAGES_DASHBOARD_PATH", SCRIPT_PATH."$carpeta/box/pages_dashboard/");

		//PHP
		define("GoogleAuthenticator_PATH", ROOT_PATH."$carpeta/box/GoogleAuthenticator/");
		define("LIB_PATH", ROOT_PATH."$carpeta/box/lib/");
		define("HEADER_PATH", ROOT_PATH."$carpeta/acceso/header.php");
		define("MAIL_PATH", ROOT_PATH."$carpeta/box/mail/");
		define("PDF_PATH", ROOT_PATH."$carpeta/box/pdfClasses/");		/*FALTA */
		define("QR_CODE", ROOT_PATH."$carpeta/box/phpqrcode/");			/*FALTA */
		define("PHPEXCEL", ROOT_PATH."$carpeta/box/PHPExcel_1.8.0/Classes/PHPExcel/");
		define("PHPEXCEL_write", ROOT_PATH."$carpeta/box/PHPExcel/Classes/");
		define("ENCRYP_PATH", ROOT_PATH."$carpeta/box/encryp/5CR.php");
		define("TEMPLATE_PATH", ROOT_PATH."$carpeta/modules/mailling/");
		define("SESSIONES", ROOT_PATH."$carpeta/box/session/session.lib.php");
		define("CAPTCHA", ROOT_PATH."$carpeta/box/captcha/");
		define("COMET_PATH",ROOT_PATH."$carpeta/box/comet/index.php");
		define("COMET_PATH2",ROOT_PATH."$carpeta/box/comet/");
		define("SEGURIDAD_PATH",ROOT_PATH."$carpeta/box/seguridad/chain.seguridad.php");
		define("ENCRIPT_PATH",ROOT_PATH."$carpeta/box/seguridad/encript-url.lib.php");
		define("CORE_PATH",DOMINIO_PATH."$carpeta/box/gentelella-core/");
		define("FACEBOOK_LIB",ROOT_PATH."$carpeta/box/Facebook/autoload.php");

		define("CUSTOM",DOMINIO_PATH."/custom/");
		define("SERVICIOS",DOMINIO_PATH."/custom/PHP_Servicios/");
        define("HIGHCHARTS",DOMINIO_PATH."/box/highCharts/");
        define("HIGHCHARTS_DEF",DOMINIO_PATH."/box/highCharts_default/");
        define("HIGHSTOCK",DOMINIO_PATH."/box/highstock/");
        define("GP",DOMINIO_PATH."/gestion_proyectos/");


		//CARPETA UPALOAD
		define('URL_UPLOAD', "http://".SUB_DOMINIO.".".CARPETA_DOMINIO."/upload/");
		define("MAIL_ATTACH",ROOT_PATH."$carpeta/upload/mail/");


		//CONSTANTE PARA IMAGENES
		define("IMG_PATH", ROOT_PATH."$carpeta/images/fichas/");
		define("REST_IMG_PATH", ROOT_PATH."$carpeta/restaurantes_info/");


		//RUTAS DEL PROYECTO
		define("URL_COMPLETA", "http://".SUB_DOMINIO.".".CARPETA_DOMINIO);
		define("IMG_TOTALPAT", URL_COMPLETA.'/img/');
		define("BASE_CONOCIMIENTO", URL_COMPLETA.'/base_conocimiento/');
		define("CATALOGOS", URL_COMPLETA.'/cata/');
		define('DIR_BASE_CONOCIMIENTO', '/var/base_conocimiento');


		//CONSTANTES PARA MODALES
		define('MODAL_SIMPLE', URL_COMPLETA.'/box/lib/modal.php');


		$array_meses = [
		    "1" => "Enero",
		    "2" => "Febrero",
				"3" => "Marzo",
				"4" => "Abril",
				"5" => "Mayo",
				"6" => "Junio",
				"7" => "Julio",
				"8" => "Agosto",
				"9" => "Septiembre",
				"10" => "Octubre",
				"11" => "Noviembre",
				"12" => "Diciembre",
		];

		$array_meses_min = [
		    "1" => "Ene",
		    "2" => "Feb",
				"3" => "Mar",
				"4" => "Abr",
				"5" => "May",
				"6" => "Jun",
				"7" => "Jul",
				"8" => "Ago",
				"9" => "Sep",
				"10" => "Oct",
				"11" => "Nov",
				"12" => "Dic",
		];




		//funciones
		function printSiNo($valor){
			if($valor=="1"){
				print "S�";
			}
			else{
				print "No";
			}
		}

		function createRandomPassword($tam=80) {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= $tam) {
				$num = rand() % 59;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}

		function elimina_acentos($cadena, $bandera_min=""){
			$tofind = "�����������������������������������������������������";
			$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
			$texto_final= strtr($cadena,$tofind,$replac);

			if($bandera_min==1){
				$texto_final=strtolower($texto_final);
			}
			return $texto_final;


		}

		function getRealIpAddr(){
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}


		function ping($host, $port, $timeout){
		  $tB = microtime(true);
		  $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
		  if (!$fP) { return "0"; }
		  $tA = microtime(true);
		  return round((($tA - $tB) * 1000), 0)." ms";
		}


		function array_sort_by_column_class(&$arr, $col, $dir = SORT_ASC) {

			$sort_col = array();
			foreach ($arr as $key=> $row) {

				$sort_col[$key] = $row->$col;

			}
			array_multisort($sort_col, $dir, $arr);
		}

		function recortar_texto_contactos($texto, $limite=100){
			$texto = trim($texto);
			$texto = strip_tags($texto);
			$tamano = strlen($texto);
			$resultado = '';
			if($tamano <= $limite){
				return $texto;
			}else{
				$texto = substr($texto, 0, $limite);
				$palabras = explode(' ', $texto);
				$resultado = implode(' ', $palabras);
				$resultado .= '...';
			}
			return $resultado;
		}

		function array_sort_func($a,$b=NULL) {
		   static $keys;
		   if($b===NULL) return $keys=$a;
		   foreach($keys as $k) {
			  if(@$k[0]=='!') {
				 $k=substr($k,1);
				 if(@$a[$k]!==@$b[$k]) {
					return strcmp(@$b[$k],@$a[$k]);
				 }
			  }
			  else if(@$a[$k]!==@$b[$k]) {
				 return strcmp(@$a[$k],@$b[$k]);
			  }
		   }
		   return 0;
		}

		function array_sort(&$array) {
		   if(!$array) return $keys;
		   $keys=func_get_args();
		   array_shift($keys);
		   array_sort_func($keys);
		   usort($array,"array_sort_func");
		}


		function multiexplode ($delimiters,$string) {
			$ready = str_replace($delimiters, $delimiters[0], $string);
			$launch = explode($delimiters[0], $ready);
			return  $launch;
		}

		function validar_mail(&$email){
			print(1);
			global $error_email;
			$email=trim($email);
			$email=strtolower($email);
			$email=addslashes($email);

			if(!eregi("^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9]+@[a-zA-Z0-9]+[a-zA-Z0-9-]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$", $email)){
				return 0;
			}
			else{
				return 1;
			}

		}


		function oscurece_color($color,$cant){
			//voy a extraer las tres partes del color
			$rojo = substr($color,1,2);
			$verd = substr($color,3,2);
			$azul = substr($color,5,2);

			//voy a convertir a enteros los string, que tengo en hexadecimal
			$introjo = hexdec($rojo);
			$intverd = hexdec($verd);
			$intazul = hexdec($azul);

			//ahora verifico que no quede como negativo y resto
			if($introjo-$cant>=0) $introjo = $introjo-$cant;
			if($intverd-$cant>=0) $intverd = $intverd-$cant;
			if($intazul-$cant>=0) $intazul = $intazul-$cant;

			//voy a convertir a hexadecimal, lo que tengo en enteros
			$rojo = dechex($introjo);
			$verd = dechex($intverd);
			$azul = dechex($intazul);

			//voy a validar que los string hexadecimales tengan dos caracteres
			if(strlen($rojo)<2) $rojo = "0".$rojo;
			if(strlen($verd)<2) $verd = "0".$verd;
			if(strlen($azul)<2) $azul = "0".$azul;

			//voy a construir el color hexadecimal
			$oscuridad = "#".$rojo.$verd.$azul;

			//la funci�n devuelve el valor del color hexadecimal resultante
			return $oscuridad;
		}


		function sanear_string($String){

			$String = trim($String);
			$String = utf8_decode($String);

			$String = str_replace(array('�','�','�','�','�','�'),"a",$String);
			$String = str_replace(array('�','�','�','�','�'),"A",$String);
			$String = str_replace(array('�','�','�','�'),"I",$String);
			$String = str_replace(array('�','�','�','�'),"i",$String);
			$String = str_replace(array('�','�','�','�'),"e",$String);
			$String = str_replace(array('�','�','�','�'),"E",$String);
			$String = str_replace(array('�','�','�','�','�','�'),"o",$String);
			$String = str_replace(array('�','�','�','�','�'),"O",$String);
			$String = str_replace(array('�','�','�','�'),"u",$String);
			$String = str_replace(array('�','�','�','�'),"U",$String);
			$String = str_replace(array('[','^','�','`','�','~',']',' '),"",$String);
			$String = str_replace("�","c",$String);
			$String = str_replace("�","C",$String);
			$String = str_replace("�","n",$String);
			$String = str_replace("�","N",$String);
			$String = str_replace("�","Y",$String);
			$String = str_replace("�","y",$String);

			$String = str_replace("&aacute;","a",$String);
			$String = str_replace("&Aacute;","A",$String);
			$String = str_replace("&eacute;","e",$String);
			$String = str_replace("&Eacute;","E",$String);
			$String = str_replace("&iacute;","i",$String);
			$String = str_replace("&Iacute;","I",$String);
			$String = str_replace("&oacute;","o",$String);
			$String = str_replace("&Oacute;","O",$String);
			$String = str_replace("&uacute;","u",$String);
			$String = str_replace("&Uacute;","U",$String);
			return $String;
		}

	}


?>