<!DOCTYPE html>
<html lang="es">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Examen de colocación</title> <!-- Aquí va el título de la página -->

</head>

<body>
<?php
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$Celular = $_POST['Celular'];
$Email = $_POST['Email'];
$Ocupacion = $_POST['Ocupacion'];
$Pais = $_POST['Pais'];
$P1 = $_POST['P1'];
$P2 = $_POST['P2'];
$P3 = $_POST['P3'];
$P4 = $_POST['P4'];
$P5 = $_POST['P5'];
$P6 = $_POST['P6'];
$P7 = $_POST['P7'];
$P8 = $_POST['P8'];
$P9 = $_POST['P9'];
$P10 = $_POST['P10'];
$P11 = $_POST['P11'];
$P12 = $_POST['P12'];
$P13 = $_POST['P13'];
$P14 = $_POST['P14'];
$P15 = $_POST['P15'];
$P16 = $_POST['P16'];
$P17 = $_POST['P17'];
$P18 = $_POST['P18'];
$P19 = $_POST['P19'];
$P20 = $_POST['P20'];
$P21 = $_POST['P21'];
$P22 = $_POST['P22'];
$P23 = $_POST['P23'];
$P24 = $_POST['P24'];
$P25 = $_POST['P25'];
$P26 = $_POST['P26'];
$P27 = $_POST['P27'];
$P28 = $_POST['P28'];
$P29 = $_POST['P29'];
$P30 = $_POST['P30'];
$P31 = $_POST['P31'];
$P32 = $_POST['P32'];
$P33 = $_POST['P33'];
$P34 = $_POST['P34'];
$P35 = $_POST['P35'];
$P36 = $_POST['P36'];
$P37 = $_POST['P37'];
$P38 = $_POST['P38'];
$P39 = $_POST['P39'];
$P40 = $_POST['P40'];
$P41 = $_POST['P41'];
$P42 = $_POST['P42'];
$P43 = $_POST['P43'];
$P44 = $_POST['P44'];
$P45 = $_POST['P45'];
$P46 = $_POST['P46'];
$P47 = $_POST['P47'];
$P48 = $_POST['P48'];
$P49 = $_POST['P49'];
$P50 = $_POST['P50'];
$P51 = $_POST['P51'];
$P52 = $_POST['P52'];
$P53 = $_POST['P53'];
$P54 = $_POST['P54'];
$P55 = $_POST['P55'];
$P56 = $_POST['P56'];
$P57 = $_POST['P57'];
$P58 = $_POST['P58'];
$P59 = $_POST['P59'];
$P60 = $_POST['P60'];
$P61 = $_POST['P61'];
$P62 = $_POST['P62'];
$P63 = $_POST['P63'];
$P64 = $_POST['P64'];
$P65 = $_POST['P65'];
$P66 = $_POST['P66'];
$P67 = $_POST['P67'];
$P68 = $_POST['P68'];
$P69 = $_POST['P69'];
$P70 = $_POST['P70'];
$P71 = $_POST['P71'];
$P72 = $_POST['P72'];
$P73 = $_POST['P73'];
$P74 = $_POST['P74'];
$P75 = $_POST['P75'];
$P76 = $_POST['P76'];
$P77 = $_POST['P77'];
$P78 = $_POST['P78'];
$P79 = $_POST['P79'];
$P80 = $_POST['P80'];
$P81 = $_POST['P81'];
$P82 = $_POST['P82'];
$P83 = $_POST['P83'];
$P84 = $_POST['P84'];
$P85 = $_POST['P85'];
$P86 = $_POST['P86'];
$P87 = $_POST['P87'];
$P88 = $_POST['P88'];
$P89 = $_POST['P89'];
$P90 = $_POST['P90'];



if ($Nombre=='' || $Apellido=='' || $Celular=='' || $Email=='' || $Ocupacion=='' || $Pais==''){

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
    $mail->Subject  =  "Resultados Examen de Colocacion";
    $mail->Body     =  
    "Nombre: $Nombre \n<br />".
    "Apellido: $Apellido \n<br />".    
    "Celular: $Celular \n<br />".
    "Email: $Email \n<br />".
    "Ocupacion: $Ocupacion \n<br />". 
    "Pais: $Pais \n<br />".
    "C1: $P1 \n<br />".
    "C2: $P2 \n<br />".
    "C3: $P3 \n<br />".
    "C4: $P4 \n<br />".
    "C5: $P5 \n<br />".
    "C6: $P6 \n<br />".
    "C7: $P7 \n<br />".
    "C8: $P8 \n<br />".
    "C9: $P9 \n<br />".
    "C10: $P10 \n<br />".
    "C11: $P11 \n<br />".
    "C12: $P12 \n<br />".
    "C13: $P13 \n<br />".
    "C14: $P14 \n<br />".
    "C15: $P15 \n<br />".
    "C16: $P16 \n<br />".
    "C17: $P17 \n<br />".
    "C18: $P18 \n<br />".
    "C19: $P19 \n<br />".
    "C20: $P20 \n<br />".
    "C21: $P21 \n<br />".
    "C22: $P22 \n<br />".
    "C23: $P23 \n<br />".
    "C24: $P24 \n<br />".
    "C25: $P25 \n<br />".
    "C26: $P26 \n<br />".
    "C27: $P27 \n<br />".
    "C28: $P28 \n<br />".
    "C29: $P29 \n<br />".
    "C30: $P30 \n<br />".
    "C31: $P31 \n<br />".
    "C32: $P32 \n<br />".
    "C33: $P33 \n<br />".
    "C34: $P34 \n<br />".
    "C35: $P35 \n<br />".
    "C36: $P36 \n<br />".
    "C37: $P37 \n<br />".
    "C38: $P38 \n<br />".
    "C39: $P39 \n<br />".
    "C40: $P40 \n<br />".
    "C41: $P41 \n<br />".
    "C42: $P42 \n<br />".
    "C43: $P43 \n<br />".
    "C44: $P44 \n<br />".
    "C45: $P45 \n<br />".
    "C46: $P46 \n<br />".
    "C47: $P47 \n<br />".
    "C48: $P48 \n<br />".
    "C49: $P49 \n<br />".
    "C50: $P50 \n<br />".
    "C51: $P51 \n<br />".
    "C52: $P52 \n<br />".
    "C53: $P53 \n<br />".
    "C54: $P54 \n<br />".
    "C55: $P55 \n<br />".
    "C56: $P56 \n<br />".
    "C57: $P57 \n<br />".
    "C58: $P58 \n<br />".
    "C59: $P59 \n<br />".
    "C60: $P60 \n<br />".
    "C61: $P61 \n<br />".
    "C62: $P62 \n<br />".
    "C63: $P63 \n<br />".
    "C64: $P64 \n<br />".
    "C65: $P65 \n<br />".
    "C66: $P66 \n<br />".
    "C67: $P67 \n<br />".
    "C68: $P68 \n<br />".
    "C69: $P69 \n<br />".
    "C70: $P70 \n<br />".
    "C71: $P71 \n<br />".
    "C72: $P72 \n<br />".
    "C73: $P73 \n<br />".
    "C74: $P74 \n<br />".
    "C75: $P75 \n<br />".
    "C76: $P76 \n<br />".
    "C77: $P77 \n<br />".
    "C78: $P78 \n<br />".
    "C79: $P79 \n<br />".
    "C80: $P80 \n<br />".
    "C81: $P81 \n<br />".
    "C82: $P82 \n<br />".
    "C83: $P83 \n<br />".
    "C84: $P84 \n<br />".
    "C85: $P85 \n<br />".
    "C86: $P86 \n<br />".
    "C87: $P87 \n<br />".
    "C88: $P88 \n<br />".
    "C89: $P89 \n<br />".
    "C90: $P90 \n<br />";
 
   
    
    

// Datos del servidor SMTP

    
  
    
    if ($mail->Send())
    echo "<script>alert('Gracias por hacer el examen de colocación muy pronto nos comunicaremos contigo.');location.href ='http://intoenglish.com.mx/';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

}

?>
</body>
</html>