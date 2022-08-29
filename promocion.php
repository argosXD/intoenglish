<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Registro De Alumno</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php

define("RECAPTCHA_V3_SECRET_KEY", '6LeQSeUZAAAAANBA1pwoyV6d5xWXIajvX7y_VaJw');

$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verificar la respuesta
if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // Si entra aqui, es un humano, puedes procesar el formulario
	echo "<script>location.href ='https://www.intoenglish.com.mx/';</script>";
} else {
    // Si entra aqui, es un robot....
	echo "Lo siento, parece que eres un Robot";
}

$Promocion = $_POST['Promocion'];
$Nombre = $_POST['Nombre'];
$Edad = $_POST['Edad'];
$Celular = $_POST['Celular'];
$Ocupacion = $_POST['Ocupacion'];
$Email = $_POST['Email'];




if ($Nombre=='' || $Edad=='' || $Celular=='' || $Ocupacion=='' || $Email=='' || $token=='' || $action==''){

echo "<script>alert('Los campos marcados con * son obligatorios');location.href ='javascript:history.back()';</script>";

}else{


    require("archivosformulario/class.phpmailer.php");
    $mail = new PHPMailer();

    $mail->From     = $Email;
    $mail->FromName = $Nombre; 
    $mail->AddAddress("informes@intoenglish.com.mx"); // Dirección a la que llegaran los mensajes.
   
// Aquí van los datos que apareceran en el correo que reciba
    //adjuntamos un archivo 
        //adjuntamos un archivo
            
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Promocion";
    $mail->Body     =  
    "Promocion: $Promocion \n<br />". 
    "Nombre: $Nombre \n<br />".    
    "Edad: $Edad \n<br />".
    "Celular: $Celular \n<br />". 
    "Ocupacion: $Ocupacion \n<br />".
    "Email: $Email \n<br />".
    "ModLinea: $ModLinea \n<br />".
    "HoLinea: $HoLinea \n<br />".
    "ModPre: $ModPre \n<br />";
 

// Datos del servidor SMTP

    
  
    
    if ($mail->Send())
    echo "<script>alert('Gracias por registrarte muy pronto nos comunicaremos contigo.');location.href ='http://intoenglish.com.mx/';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>