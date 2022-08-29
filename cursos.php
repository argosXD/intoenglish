<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Informes - Into English</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php


$Curso = $_POST['Curso'];
$Nombre = $_POST['Nombre'];
$Email = $_POST['Email'];
$Telefono = $_POST['Telefono'];
$Mensaje = $_POST['Mensaje'];

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
if($arrResponses["success"] == '1' && $arrRespons["action"] == $action && $arrResponse["score"] >= 0.5) {
    // Si entra aqui, es un humano, puedes procesar el formulario
	echo "<script>location.href ='https://www.intoenglish.com.mx/';</script>";
} else {
    // Si entra aqui, es un robot....
	echo "Lo siento, parece que eres un Robot";
}



if ($Nombre=='' || $Email=='' || $Telefono==''|| $token=='' || $action=='' ){

echo "<script>alert('Los campos marcados con * son obligatorios');location.href ='javascript:history.back()';</script>";

}else{


    require("archivosformulario/class.phpmailer.php");
    $mail = new PHPMailer();

    $mail->From     = $Email;
    $mail->FromName = $Nombre; 
    $mail->AddAddress("hola@intoenglish.com.mx"); // Dirección a la que llegaran los mensajes.
   
// Aquí van los datos que apareceran en el correo que reciba
    //adjuntamos un archivo 
        //adjuntamos un archivo
            
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Curso Online";
    $mail->Body     =  
    "Curso: $Curso \n<br />".
    "Nombre: $Nombre \n<br />".
    "Email: $Email \n<br />". 
    "Telefono: $Telefono \n<br />".
    "Mensaje: $Mensaje \n<br />";
 
   
    
    

// Datos del servidor SMTP

    
  
    
    if ($mail->Send())
    echo "<script>alert('Gracias por contactarnos muy pronto nos comunicaremos contigo.');location.href ='http://intoenglish.com.mx/';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>