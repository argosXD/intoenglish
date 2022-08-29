<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ficha de  Inscripción</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Edad = $_POST['Edad'];
$Ciudad = $_POST['Ciudad'];
$CP = $_POST['CP'];
$Celular = $_POST['Celular'];
$Nacimiento = $_POST['Nacimiento'];
$Ocupacion = $_POST['Ocupacion'];
$Email = $_POST['Email'];
$CursoSemi = $_POST['CursoSemi'];
$DiaSemi = $_POST['DiaSemi'];
$SemiNivel = $_POST['SemiNivel'];
$HoraSemi = $_POST['HoraSemi'];
$CursoIn = $_POST['CursoIn'];
$DiaIn = $_POST['DiaIn'];
$HoraIn = $_POST['HoraIn'];
$InNivel = $_POST['InNivel'];
$Acepto = $_POST['Acepto'];




if ($Nombre=='' || $Apellido=='' || $Edad=='' || $Ciudad=='' || $CP=='' || $Celular=='' || $Nacimiento=='' || $Ocupacion=='' || $Email==''){

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
    $mail->Subject  =  utf8_decode("Ficha de Inscripción");
    $mail->Body     =  utf8_decode(
    "Nombre: $Nombre \n<br />". 
    "Apellido: $Apellido \n<br />".   
    "Edad: $Edad \n<br />".
    "Ciudad: $Ciudad \n<br />".
    "CP: $CP \n<br />". 
    "Celular: $Celular \n<br />". 
    "Nacimiento: $Nacimiento \n<br />".
    "Ocupacion: $Ocupacion \n<br />".
    "Email: $Email \n<br />".
    "Modalidad: $CursoSemi \n<br />".
    "Dia: $DiaSemi \n<br />".
    "Nivel: $SemiNivel \n<br />".
    "Hora: $HoraSemi \n<br />".
    "Modalidad: $CursoIn \n<br />".
    "Dia: $DiaIn \n<br />".
    "Nivel: $InNivel \n<br />".
    "Hora: $HoraIn \n<br />".
    "Acepto: $Acepto \n<br />");
 

// Datos del servidor SMTP

    
  
    
    if ($mail->Send())
    echo "<script>alert('Gracias por registrarte muy pronto nos comunicaremos contigo.');location.href ='http://intoenglish.com.mx/';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>