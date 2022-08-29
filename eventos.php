<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Registro De Alumno</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php
$Evento = $_POST['Evento'];
$Clase = $_POST['Clase'];
$Nombre = $_POST['Nombre'];
$Edad = $_POST['Edad'];
$Celular = $_POST['Celular'];
$Ocupacion = $_POST['Ocupacion'];
$Email = $_POST['Email'];



if ($Nombre=='' || $Edad=='' || $Celular=='' || $Ocupacion=='' || $Email==''){

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
    $mail->Subject  =  "Eventos";
    $mail->Body     =  
    "Evento: $Evento \n<br />".
    "Clase: $Clase \n<br />".
    "Nombre: $Nombre \n<br />".    
    "Edad: $Edad \n<br />".
    "Celular: $Celular \n<br />". 
    "Ocupacion: $Ocupacion \n<br />".
    "Email: $Email \n<br />";
 

// Datos del servidor SMTP

    
  
    
    if ($mail->Send())
    echo "<script>alert('Gracias por registrarte muy pronto nos comunicaremos contigo.');location.href ='http://intoenglish.com.mx/';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>