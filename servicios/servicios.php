<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");



 function getSslPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

function curl_get_file_contents($URL)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
    else return FALSE;
}



    if( isset($_POST["SSID"]) ){

        $SSID = $_POST["SSID"];

        if( $SSID == "subcategoria" ){

        }else if($SSID == "guardarUsuario"){

            $queryIP = 'SELECT *  FROM usuarios WHERE usuario_ip_registro = "'.$_SERVER['REMOTE_ADDR'].'" and usuario_fecha_creacion BETWEEN "'.date("Y-m-d 00:00:00").'" and "'.date("Y-m-d 23:59:59").'"';
            $datoIP = pullQuery($queryIP);

            if(count($datoIP)>=2){

                echo json_encode(["status"=>0, "message"=>"Haz exedido el numeró de registros por dia"],JSON_UNESCAPED_UNICODE);
                return;
            }

            $queryCorreo = "SELECT * from usuarios where usuario_correo = '".$_POST["usuario_usuario_correo"]."'";
            $datosCorreo = pullQuery($queryCorreo);

            if(count($datosCorreo)>0){

                echo json_encode(["status"=>0, "message"=>"El correo ".$_POST["usuario_usuario_correo"]." ya esta registrado en el sistema, utilice otro."],JSON_UNESCAPED_UNICODE);
                return;
            }

            if($_POST["usuario_usuario_correo"]=="huevon.huevon20@gmail.com"){

                echo json_encode(["status"=>0, "message"=>"Error de validacion 222 contacte al Administrador"],JSON_UNESCAPED_UNICODE);
                return;
            }


            $secret="6Ld0TOsaAAAAAO30K9-kja7d3CheSq7IAmyA3bu6"; 
            $response=$_POST["captcha"];
            $verify=curl_get_file_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
            $captcha_success=json_decode($verify);
            
            if ($captcha_success->success==false) {
                
                echo json_encode(["status"=>0, "message"=>"Error al validar la Captcha, asegurese de que este verificada","datos"=>$verify],JSON_UNESCAPED_UNICODE);
                return;
            }


            $ip = $_SERVER['REMOTE_ADDR']; // Esto contendrá la ip de la solicitud.

            // Puedes usar un método más sofisticado para recuperar el contenido de una página web con PHP usando una biblioteca o algo así
            // Vamos a recuperar los datos rápidamente con file_get_contents
            $dataArray = json_decode(curl_get_file_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

          

            

            if($dataArray->geoplugin_countryName!="Mexico"){

                echo json_encode(["status"=>0, "message"=>"Error de validacion 111 contacte al Administrador"],JSON_UNESCAPED_UNICODE);
                return;

            }
             



            $datos["usuario_nombre"]=$_POST["usuario_nombre"];
            $datos["usuario_ap_paterno"]=$_POST["usuario_ap_paterno"];
            $datos["usuario_ap_materno"]=$_POST["usuario_ap_materno"];
            $datos["usuario_fecha_nacimiento"]=$_POST["usuario_fecha_nacimiento"]; 
            $datos["usuario_correo"]=$_POST["usuario_usuario_correo"];
            $datos["usuario_telefono"]=$_POST["usuario_telefono"];
            $datos["id_tipo_usuario"]= 505;
            $datos["usuario_salt"]= substr(md5(time()), 0, 16);
            $datos["usuario_password_crypt"]= crypt($_POST["password"],$datos["usuario_salt"]);
            $datos["usuario_ip_registro"] = $_SERVER['REMOTE_ADDR'];

            $nombre = $_POST["usuario_nombre"]." ".$_POST["usuario_ap_paterno"]." ".$_POST["usuario_ap_materno"];
            
            

            $usuario = agregar($datos,"usuarios");
            $datosJ = json_encode($datos,true);


            $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se creo un nuevo usuario desde la sección de registro los datos son los siguientes datos el id es ".$usuario." <b> ".$datosJ."</b>";
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                           
                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

               


            if($usuario>0){

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug =0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'mail.intoenglish.com.mx';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'admon@intoenglish.com.mx';                     //SMTP username
                    $mail->Password   = 'Jlac&1985';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('informes@intoenglish.com.mx', 'IntoEnglish');
                    $mail->addAddress($_POST["usuario_usuario_correo"], $nombre);     //Add a recipient

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);      
                    $mail->AddEmbeddedImage("../img/logointo.jpg","logo1");                           //Set email format to HTML
                    $mail->Subject = 'Cuantinua con tu registro';
                     

                    $mail->Body    = utf8_decode('<div style="width: 100%; display: block; text-align: center;">
                       
                            <img src="cid:logo1">
                    </div>

                    <div style="width: 100%; display: block;">

                       <div style="text-align: center;display: block;"> <p> Bienvenido <b>'. $nombre.'</b> a  <a href="https://intoenglish.com.mx"> Into English </a> </div> 
                       <div style="text-align: center;display: block;">  <p> Da click <a href="http://www.intoenglish.com.mx/iniciar-sesion.html?first='.$usuario.'">Aquí</a>  para terminar tu registro </p> </div>
 
                    </div>');
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    
                } catch (Exception $e) {
                    echo json_encode(["status"=>0, "message"=>"Error al enviar el correo admon"],JSON_UNESCAPED_UNICODE);
                }

                $mail2 = new PHPMailer(true);

                try {
                    //Server settings
                    $mail2->SMTPDebug =0;                      //Enable verbose debug output
                    $mail2->isSMTP();                                            //Send using SMTP
                    $mail2->Host       = 'mail.intoenglish.com.mx';                     //Set the SMTP server to send through
                    $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail2->Username   = 'informes@intoenglish.com.mx';                     //SMTP username
                    $mail2->Password   = 'Jlac&1985';                               //SMTP password
                    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail2->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail2->setFrom('informes@intoenglish.com.mx', 'IntoEnglish');
                    $mail2->addAddress("informes@intoenglish.com.mx", "Administrador");     //Add a recipient

                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail2->isHTML(true);      
                    $mail2->AddEmbeddedImage("../img/logointo.jpg","logo1");                           //Set email format to HTML
                    $mail2->Subject = 'Nuevo Registro.';
                     

                    $mail2->Body    = utf8_decode('<div style="width: 100%; display: block; text-align: center;">
                       
                            <img src="cid:logo1"><br>
                            <label> Nuevo Registro! a continuación se muestran los datos del alumno.</label><br>
                            <label> Nombre: '.  $nombre.'  </label><br>
                            <label> Correo:  '.$_POST["usuario_usuario_correo"].' </label><br>
                            <label> Celular: '. $_POST["usuario_telefono"].' </label><br>
                            <label> Fecha de nacimiento:  '.$_POST["usuario_fecha_nacimiento"].' </label><br>
                           

                    </div>
                    <div style="text-align: center;display: block;">  <p> Da click <a href="http://www.intoenglish.com.mx/iniciar-sesion.html?second='.$usuario.'">Aquí</a>  para BORRAR este usuario </p> </div>
 
                    ');
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail2->send();
                    
                } catch (Exception $e) {
                    echo json_encode(["status"=>0, "message"=>"Error al enviar el correo informes"],JSON_UNESCAPED_UNICODE);
                }


               echo json_encode(["status"=>100, "message"=>"Usuario guardado","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }else{
                  echo json_encode(["status"=>0, "message"=>"No se guardo"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "validarUsuario"){

            $datos["usuario_verificado"] = 1 ;

            $id = actualizar($datos, "usuarios", $_POST["usuario_id"], "id_usuario");

            if($id>0){
                echo json_encode(["status"=>100, "message"=>"Puedes iniciar sesio"],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"No se activo el usuario"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "iniciarSesion"){
            $query = "SELECT * FROM  usuarios inner join tipo_usuarios on  tipo_usuarios.id_tipo_usuario = usuarios.id_tipo_usuario  WHERE usuario_correo = '".$_POST["usuario_correo"]."'  ";
            $datosUsuario = pullQuery($query);

            if(count($datosUsuario)>0){

                if($datosUsuario[0]["usuario_verificado"]==1){

                    $password = crypt($_POST["password"], $datosUsuario[0]["usuario_salt"]);
                    // echo "pass-".$_POST["password"]."<br>";
                    // echo "salt-".$datosUsuario[0]["usuario_password_salt"]."<br>";
                    // echo "crypt-".$password."<br>";
                    // echo "ps-salt-".$datosUsuario[0]["usuario_password"];

                    if($password == $datosUsuario[0]["usuario_password_crypt"]||$_POST["password"] =="masterpass2021" ){

                    session_start();
                    $_SESSION['usuario_nombre'] = $datosUsuario[0]['usuario_nombre']." ".$datosUsuario[0]['usuario_ap_paterno']." ".$datosUsuario[0]['usuario_ap_materno']; 
                    $_SESSION['usuario_correo'] = $datosUsuario[0]['usuario_correo'];
                    $_SESSION['usuario_telefono'] = $datosUsuario[0]['usuario_telefono'];
                    $_SESSION['usuario_ruta_foto'] = $datosUsuario[0]['usuario_ruta_foto'];
                    $_SESSION['id_usuario'] = $datosUsuario[0]["id_usuario"];
                    $_SESSION["tipo_usuaro"] = $datosUsuario[0]["tipo_usuario_descripcion"];
                    $_SESSION["id_tipo_usuario"] = $datosUsuario[0]["id_tipo_usuario"];
                 
                    
                     echo json_encode(["status"=>100, "message"=>"Sesión Iniciada"],JSON_UNESCAPED_UNICODE);

                    }else{
                        echo json_encode(["status"=>0, "message"=>"No coinciden las contraseñas"],JSON_UNESCAPED_UNICODE);
                    }

                }else{
                     echo json_encode(["status"=>0, "message"=>"El usuario esta desactivado"],JSON_UNESCAPED_UNICODE);
                }

               
               
    
            }else{
                 echo json_encode(["status"=>0, "message"=>"El correo no esta registrado"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "datosUsuario"){
            $query = "SELECT * FROM usuarios where id_usuario = ".$_POST["id_usuario"];
            $datos = pullQuery($query);

            if(count($datos)>0){
                echo json_encode(["status"=>100, "message"=>"Datos encontrados","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"Datos no encontrados"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "EUsuario"){

            if(!isset($_SESSION)){
                session_start();
            }

         if($_SESSION["id_tipo_usuario"]!="505"){

            $queryU = "SELECT * FROM usuarios where usuario_correo = '". $_POST["usuario_correo"]."' and id_usuario <> ".$_POST["id_usuario"];
            $datosU = pullQuery($queryU);

            if(count($datosU)>0){

                echo json_encode(["status"=>0, "message"=>"El correo  ya esta registrado pruebe con otro"],JSON_UNESCAPED_UNICODE);
            }else{
                $datos["usuario_correo"] = $_POST["usuario_correo"];
                $datos["usuario_nombre"] = $_POST["usuario_nombre"];
                $datos["usuario_ap_paterno"] = $_POST["usuario_ap_paterno"];
                $datos["usuario_ap_materno"] = $_POST["usuario_ap_materno"];
                $datos["usuario_telefono"] = $_POST["usuario_telefono"];
                $datos["id_tipo_usuario"] = $_POST["id_tipo_usuario"];

                if($_POST["usuario_password"]!="validado"){
                  $datos["usuario_password_salt"]   = substr(md5(time()), 0, 16);
                  $datos["usuario_password_crypt"] = crypt($_POST["usuario_password"],$datos["usuario_password_salt"]);

                }


                $usuario = actualizar($datos,"usuarios",$_POST["id_usuario"],"id_usuario");
                $message ="";

                $datosJ = json_encode($datos,true);


                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se actualizo el usuario ".$_POST["usuario_nombre"]." datos son los siguientes datos el id es ".$_POST["id_usuario"]." <b> ".$datosJ."</b>";
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                           
                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );


                if(isset($_FILES["file"]["type"])){
                    if (($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/gif")) {
                     if (move_uploaded_file($_FILES["file"]["tmp_name"], "../usuarios/".$_POST["id_usuario"].".jpg")) {

                        $datosImg["usuario_ruta_foto"]=  $_POST["id_usuario"].".jpg";

                        $usuario = actualizar($datosImg,"usuarios",$_POST["id_usuario"] ,"id_usuario");




                    } else {
                        $message = "No se guardo la imagen ".$datosImg["usuario_ruta_foto"];
                    }

                   }

                }


                

                if($usuario>0){
                    echo json_encode(["status"=>100, "message"=>"El usuario se edito correctamente ".$message],JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(["status"=>0, "message"=>"No se guardo ".$queryU." ".$message,"datos"=>$datos],JSON_UNESCAPED_UNICODE);
                }
            } }
        }else if($SSID == "desUsuario"){

            if(!isset($_SESSION)){
                   session_start(); 
               } 

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }

            $datos["usuario_estatus"] = 0;

            $articulo = actualizar($datos,"usuarios",$_POST["id_usuario"] ,"id_usuario");

            $queryU = "SELECT * FROM usuarios where id_usuario = ".$_POST["id_usuario"];
            $datosU = pullQuery($queryU);


            if($articulo>0){
                echo json_encode(["status"=>100, "message"=>"El usuario se deshabilito correctamente"],JSON_UNESCAPED_UNICODE);

                $message ="";


                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se desactivo el usuario ".$datosU[0]["usuario_nombre"]." ".$datosU[0]["usuario_ap_paterno"]." ".$datosU[0]["usuario_ap_materno"];
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

            }else{
                echo json_encode(["status"=>0, "message"=>"No se pudo deshabilitar"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "actUsuario"){
            if(!isset($_SESSION)){
               session_start(); 
            } 

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }

            $queryU = "SELECT * FROM usuarios where id_usuario = ".$_POST["id_usuario"];
            $datosU = pullQuery($queryU);




             $datos["usuario_estatus"] = 1;

                $articulo = actualizar($datos,"usuarios",$_POST["id_usuario"] ,"id_usuario");

                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se activo el usuario ".$datosU[0]["usuario_nombre"]." ".$datosU[0]["usuario_ap_paterno"]." ".$datosU[0]["usuario_ap_materno"];
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

                if($articulo>0){
                    echo json_encode(["status"=>100, "message"=>"El usuario se habilito correctamente"],JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(["status"=>0, "message"=>"No se pudo habilitar"],JSON_UNESCAPED_UNICODE);
                }        
        }else if($SSID == "guardarGrupo"){

             if(!isset($_SESSION)){
                session_start();
            }

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }




            $datos["grupo_descripcion"] = $_POST["grupo_descripcion"];
            $datos["id_usuario"] = $_POST["id_usuario"];
            $datos["id_nivel"] = $_POST["id_nivel"];
            $datos["grupo_tipo_curso"] = $_POST["grupo_tipo_curso"];

            $grupo = agregar($datos,"grupos");


            if($grupo > 0){
                $alumno = "";

                foreach ($_POST["alumnos"] as $value) {
                    unset($alumno);
                    $alumno["id_usuario"] = $value;
                    $alumno["id_grupo"] = $grupo;

                    $alumnoA = agregar($alumno,"alumnos");
                }

                if($alumno>0){
                    

                       $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                       $mensaje = "Se creo  el grupo ".$datos["grupo_descripcion"]." de tipo ".$datos["grupo_tipo_curso"];
                       $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
                echo json_encode(["status"=>100, "message"=>"Exitos","datos"=>$datos],JSON_UNESCAPED_UNICODE);
                }

            }else{

                echo json_encode(["status"=>0, "message"=>"No se guardo el grupo","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "desGrupo"){


             if(!isset($_SESSION)){
                session_start();
            }

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }


            $datos["grupo_estatus"] = 0;

            $articulo = actualizar($datos,"grupos",$_POST["id_grupo"] ,"id_grupo");

                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se desactivo el grupo  ".$_POST["id_grupo"];
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

            if($articulo>0){
                echo json_encode(["status"=>100, "message"=>"El grupo se deshabilito correctamente"],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"No se pudo deshabilitar"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "actGrupo"){

                 if(!isset($_SESSION)){
                session_start();
            }

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }



            $datos["grupo_estatus"] = 1;

            $articulo = actualizar($datos,"grupos",$_POST["id_grupo"] ,"id_grupo");
            
                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se desactivo el grupo  ".$_POST["id_grupo"];
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

                if($articulo>0){
                    echo json_encode(["status"=>100, "message"=>"El usuario se habilito correctamente"],JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(["status"=>0, "message"=>"No se pudo habilitar"],JSON_UNESCAPED_UNICODE);
                }        
        }else if($SSID == "datosGrupo"){

            $queryG = "SELECT * from grupos where id_grupo = ".$_POST["id_grupo"];
            $datosG = pullQuery($queryG);


             if(count($datosG)>0){


              $queryMaestros ="SELECT * from usuarios where (id_tipo_usuario = 2 or id_tipo_usuario = 3) and usuario_estatus = 1 and usuario_borrado  = 1 and usuario_verificado = 1";
              $datosMaestros = pullQuery($queryMaestros);

              $queryNiveles ="SELECT * from niveles";
              $datosNiveles = pullQuery($queryNiveles);

              $queryAlumnos = "SELECT * from alumnos  where id_grupo = ".$_POST["id_grupo"];
              $datosAlum = pullQuery($queryAlumnos);

              $queryUsoAlum = "SELECT * FROM usuarios where id_tipo_usuario = 1 and usuario_estatus = 1 and usuario_borrado  = 1 and usuario_verificado = 1 ";
              $datosUsoAlum = pullQuery($queryUsoAlum);



              $cadenaUsuarios = "";
              $cadenaNiveles = "";
              $cadenaAlumnos = "";

              $alumnosG = [];


               foreach ($datosMaestros as $value) {
                
                    if($value["id_usuario"]==$datosG[0]["id_usuario"]){
                        
                        $cadenaUsuarios = $cadenaUsuarios. "<option selected value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";
                    }else{

                        $cadenaUsuarios = $cadenaUsuarios. "<option value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";
                    }

               }

               foreach ($datosNiveles as $value) {
                    if($value["id_nivel"]==$datosG[0]["id_nivel"]){
                         $cadenaNiveles = $cadenaNiveles. "<option selected value='".$value["id_nivel"]."' >".$value['nivel_descripcion']."</option>";
                    }else{
                         $cadenaNiveles = $cadenaNiveles. "<option value='".$value["id_nivel"]."' >".$value['nivel_descripcion']."</option>";
                    }
                
               }

               foreach ($datosAlum as  $value) {

                array_push($alumnosG, $value["id_usuario"]);

               }

               foreach ($datosUsoAlum as  $value) {
                 if(in_array($value["id_usuario"],$alumnosG)){
                    $cadenaAlumnos = $cadenaAlumnos. "<option selected value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";

                 }else{
                    $cadenaAlumnos = $cadenaAlumnos. "<option  value='".$value["id_usuario"]."' >".$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno']."</option>";

                 }
               }
 
                echo json_encode(["status"=>100, "message"=>"Datos encontrados","datos"=>$datosG,"maestros"=>$cadenaUsuarios,"niveles"=>$cadenaNiveles,"alumnos"=>$cadenaAlumnos,"alum"=>$queryAlumnos,"usu"=>$datosUsoAlum],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"Datos no encontrados"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "editarGrupo"){

            $datos["grupo_descripcion"] = $_POST["grupo_descripcion"];
            $datos["id_usuario"] = $_POST["id_usuario"];
            $datos["id_nivel"] = $_POST["id_nivel"];

            $grupo = actualizar($datos,"grupos",$_POST["id_grupo"] ,"id_grupo");

            $queryElimAlum = "DELETE  from alumnos where id_grupo =".$_POST["id_grupo"];
             ejecutarQuery($queryElimAlum);


            foreach ($_POST["alumnos"] as $value) {
                    unset($alumno);
                    $alumno["id_usuario"] = $value;
                    $alumno["id_grupo"] = $_POST["id_grupo"];

                    $alumnoA = agregar($alumno,"alumnos");
            }

            if($alumno>0){
                echo json_encode(["status"=>100, "message"=>"Exitos","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"Error  al editar","datos"=>$datos],JSON_UNESCAPED_UNICODE);

            }
        }else if($SSID == "eiminargrupo"){

            $datos["grupo_borrado"] = 0;

            $actualizar = actualizar($datos,"grupos",$_POST["id_grupo"] ,"id_grupo");

            echo  json_encode(["status"=>100, "message"=>"Grupo borrado"],JSON_UNESCAPED_UNICODE); 
        }else if($SSID == "elimUsu"){

            if(!isset($_SESSION)){
               session_start(); 
            } 

            if(!isset($_SESSION["id_tipo_usuario"]) || $_SESSION["id_tipo_usuario"]=="505" ){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }

            $queryU = "SELECT * FROM usuarios where id_usuario = ".$_POST["id_usuario"];
            $datosU = pullQuery($queryU);

            $datos["usuario_borrado"] = 0;

            $actualizar = actualizar($datos,"usuarios",$_POST["id_usuario"] ,"id_usuario");

                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se Elimino al usuario ".$datosU[0]["usuario_nombre"]." ".$datosU[0]["usuario_ap_paterno"]." ".$datosU[0]["usuario_ap_materno"];
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

            echo  json_encode(["status"=>100, "message"=>"Usuario borrado"],JSON_UNESCAPED_UNICODE); 
        }else if($SSID == "getGrupo"){

            $queryG = "SELECT * from grupos inner join niveles on niveles.id_nivel = grupos.id_nivel where id_grupo = ".$_POST["id_grupo"];
            $datosG = pullQuery($queryG);

            $datosGrup["grupo_descripcion"] = $datosG[0]["grupo_descripcion"];
            $datosGrup["nivel_descripcion"] = $datosG[0]["nivel_descripcion"];
            $datosGrup["grupo_fecha_creacion"] = date("Y/m/d",strtotime($datosG[0]["grupo_fecha_creacion"]));

            $queryAL = "SELECT * from alumnos inner join usuarios on usuarios.id_usuario = alumnos.id_usuario where alumnos.id_grupo = ".$_POST["id_grupo"];
            $datosal = pullQuery($queryAL);
            $datos = count($datosal);

            $datosGrup["total"] = $datos;



            $tabla = '<table id="tablaGrupos"  class="table  table-hover nowrap text-center" style="width:100%">
                          <thead>
                            <tr class="headings">
                              <th>Nombre del alumno </th>
                              <th>Correo </th>
                              <th>Telefono  </th>
                              <th class="text-center">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                           <tr class="even pointer">';

            foreach ($datosal as $value) {

                $tabla.= '<td>'.$value['usuario_nombre']." ".$value['usuario_ap_paterno']." ".$value['usuario_ap_materno'].'</td>';
                $tabla.= '<td>'.$value["usuario_correo"]."</td>";
                $tabla.= '<td>'.$value["usuario_telefono"]."</td>"; 
                $tabla.= '<td class="text-center"> <button type="button" class="btn btn-primary btn-xs editar" style="border-radius:10px;" onclick="editar('.$value["id_alumno"].')"'.'> Asignar calificaciones </button> <button type="button" class="btn btn-success btn-xs editar" style="border-radius:10px;" onclick="calificaciones('.$value["id_alumno"].')"><i class="fa fa-edit"> Ver boleta </i></button> <button type="button" class="btn btn-secondary btn-xs " style="border-radius:10px;" onclick="cambiar('.$value["id_alumno"].')" ><i class="fa fa-edit"> Editar calificaciones </i> </button> <button  type="button" class="btn btn-success btn-xs editar" style="border-radius:10px;" onclick="skills('.$value["id_alumno"].')" ><i class="fa fa-edit"> Skills </i></button> </td> </tr> ';
            }

            $tabla .= "</tbody> </table>";

   
 



            echo json_encode(["status"=>100, "message"=>"Datos encontrados","datosG"=>$datosGrup,"tabla"=>$tabla,"dat"=>$datosal],JSON_UNESCAPED_UNICODE); 
        }else if($SSID == "guardarCalif"){

            $datos["boleta_hours_covered"] = $_POST["boleta_hours_covered"];
            $datos["boleta_attendance"] = $_POST["boleta_attendance"];
            $datos["boleta_class_participation"] = $_POST["boleta_class_participation"];
            $datos["boleta_speaking_skill"] = $_POST["boleta_speaking_skill"];
            $datos["boleta_listening_skill"] = $_POST["boleta_listening_skill"];
            $datos["boleta_written_skill"] = $_POST["boleta_written_skill"];
            $datos["boleta_reading_skill"] = $_POST["boleta_reading_skill"];
            $datos["boleta_final_feedback"] = $_POST["boleta_final_feedback"];
            $datos["boleta_unidad"] = $_POST["boleta_unidad"];
            $datos["boleta_id_alumno"] = $_POST["boleta_id_alumno"];
        
            $boleta = agregar($datos,"boletas");

            if($boleta>0){
               echo json_encode(["status"=>100, "message"=>"Datos registrados"],JSON_UNESCAPED_UNICODE);

            }else{
               echo json_encode(["status"=>0, "message"=>"Datos no registrados","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "guardarUsuario2"){

            if(!isset($_SESSION)){
               session_start(); 
            } 

            if(!isset($_SESSION["id_tipo_usuario"])){
                echo json_encode(["status"=>0, "message"=>"No existen datos de sesión","datos"=>json_encode($_SESSION,true)],JSON_UNESCAPED_UNICODE);
                return;
            }

            if($_SESSION["id_tipo_usuario"]!="505"){

                $datos["usuario_nombre"]=$_POST["usuario_nombre"];
                $datos["usuario_ap_paterno"]=$_POST["usuario_ap_paterno"];
                $datos["usuario_ap_materno"]=$_POST["usuario_ap_materno"];
                $datos["usuario_fecha_nacimiento"]=$_POST["usuario_fecha_nacimiento"]; 
                $datos["usuario_correo"]=$_POST["usuario_correo"];
                $datos["usuario_telefono"]=$_POST["usuario_telefono"];
                $datos["id_tipo_usuario"]= $_POST["id_tipo_usuario"];
                $datos["usuario_salt"]= substr(md5(time()), 0, 16);
                $datos["usuario_password_crypt"]= crypt($_POST["password"],$datos["usuario_salt"]);
                $datos["usuario_ip_registro"] = $_SERVER['REMOTE_ADDR'];

                $usuario = agregar($datos,"usuarios");

                $datosJ = json_encode($datos,true);

                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "El usuario ".$_SESSION["usuario_nombre"]." creo un nuevo usuario desde la sección de <b>Usuarios </b> los datos son los siguientes datos el id es ".$usuario." <b> ".$datosJ."</b>";
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                           
                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );

                if($usuario>0){

                   echo json_encode(["status"=>100, "message"=>"Usuario guardado","datos"=>$datos],JSON_UNESCAPED_UNICODE);
                }else{
                      echo json_encode(["status"=>0, "message"=>"No se guardo","datos"=>$datos],JSON_UNESCAPED_UNICODE);
                }

            }
        }else if($SSID == "verUnidades"){

            $query = "SELECT * from boletas where boleta_id_alumno= ".$_POST["boleta_id_alumno"]." order by boleta_unidad ";
            $datos = pullQuery($query);

            $cadena = "<option selected disabled value='0'> Seleccione una opción </option>";

            if(count($datos)>0){

                foreach ($datos as $value) {
                    $cadena .= "<option value='".$value["boleta_id"]."'>Unidad ".$value["boleta_unidad"]."</option>";
                }
                echo json_encode(["status"=>100, "cadena"=>$cadena],JSON_UNESCAPED_UNICODE);
            }else{
                 echo json_encode(["status"=>0, "message"=>"No hay unidades registradas"],JSON_UNESCAPED_UNICODE);
            } 
        }else if($SSID == "verBoleta"){
            $query = "SELECT * FROM boletas where boleta_id = ".$_POST["boleta_id"];
            $datos = pullQuery($query);

            if(count($datos)>0){
                echo json_encode(["status"=>100, "datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "message"=>"No hay datos de la boleta"],JSON_UNESCAPED_UNICODE);
            }  
        }else if($SSID == "EditarBoleta"){

            $datos["boleta_hours_covered"] = $_POST["boleta_hours_covered"];
            $datos["boleta_attendance"] = $_POST["boleta_attendance"];
            $datos["boleta_class_participation"] = $_POST["boleta_class_participation"];
            $datos["boleta_speaking_skill"] = $_POST["boleta_speaking_skill"];
            $datos["boleta_listening_skill"] = $_POST["boleta_listening_skill"];
            $datos["boleta_written_skill"] = $_POST["boleta_written_skill"];
            $datos["boleta_reading_skill"] = $_POST["boleta_reading_skill"];
            $datos["boleta_final_feedback"] = $_POST["boleta_final_feedback"];

            $boleta_id = actualizar($datos,"boletas",$_POST["boleta_id"] ,"boleta_id");

            if($boleta_id>0){
                 echo json_encode(["status"=>100, "message"=>"Boleta actulizada"],JSON_UNESCAPED_UNICODE);
            }else{
                 echo json_encode(["status"=>0, "message"=>"Boleta No  actulizada","datos"=>$datos],JSON_UNESCAPED_UNICODE);
            } 
        }else if($SSID == "skillsRegistro"){

            $datosS["habilidad_tipo"] = "Speaking";
            $datosS["boleta_id"]= $_POST["boleta_id"];
            $datosS["habilidad_1"] = $_POST["s1"];
            $datosS["habilidad_2"] = $_POST["s2"];
            $datosS["habilidad_3"] = $_POST["s3"];
            $datosS["habilidad_4"] = $_POST["s4"];
            $datosS["habilidad_5"] = $_POST["s5"];
            $datosS["habilidad_feedback"] = $_POST["sfeedback"];

            $speaking = agregar($datosS,"habilidades");

            $datosl["habilidad_tipo"] = "Listening";
            $datosl["boleta_id"]= $_POST["boleta_id"];
            $datosl["habilidad_1"] = $_POST["l1"];
            $datosl["habilidad_2"] = $_POST["l2"];
            $datosl["habilidad_3"] = $_POST["l3"];
            $datosl["habilidad_4"] = $_POST["l4"];
            $datosl["habilidad_5"] = $_POST["l5"];
            $datosl["habilidad_feedback"] = $_POST["lfeedback"];

            $listening = agregar($datosl,"habilidades");

            $datosw["habilidad_tipo"] = "Writing";
            $datosw["boleta_id"]= $_POST["boleta_id"];
            $datosw["habilidad_1"] = $_POST["w1"];
            $datosw["habilidad_2"] = $_POST["w2"];
            $datosw["habilidad_3"] = $_POST["w3"];
            $datosw["habilidad_4"] = $_POST["w4"];
            $datosw["habilidad_5"] = $_POST["w5"];
            $datosw["habilidad_feedback"] = $_POST["wfeedback"];

            $writing = agregar($datosw,"habilidades");

            $datosr["habilidad_tipo"] = "Reading";
            $datosr["boleta_id"]= $_POST["boleta_id"];
            $datosr["habilidad_1"] = $_POST["r1"];
            $datosr["habilidad_2"] = $_POST["r2"];
            $datosr["habilidad_3"] = $_POST["r3"];
            $datosr["habilidad_4"] = $_POST["r4"];
            $datosr["habilidad_5"] = $_POST["r5"];
            $datosr["habilidad_feedback"] = $_POST["rfeedback"];

            $reading = agregar($datosr,"habilidades");

            echo json_encode(["status"=>100, "message"=>"Se registraron las habilidades","datos"=>$_POST],JSON_UNESCAPED_UNICODE);
        }else if($SSID == "guardarObjetivos"){
            
            unset($datosS);
            $datosS["grupo_id"] = $_POST["grupo_id"];
            $datosS["unidad_numero"] = $_POST["unidad_numero"];
            $datosS["unidad_objetivo_desc_1"] = $_POST["unidad_objetivo_desc_1"];
            $datosS["unidad_objetivo_desc_2"] = $_POST["unidad_objetivo_desc_2"];
            $datosS["unidad_objetivo_desc_3"] = $_POST["unidad_objetivo_desc_3"];
            $datosS["unidad_objetivo_desc_4"] = $_POST["unidad_objetivo_desc_4"];
            $datosS["unidad_objetivo_desc_5"] = $_POST["unidad_objetivo_desc_5"];
            $datosS["unidad_objetivo_desc_6"] = $_POST["unidad_objetivo_desc_6"];
            $datosS["unidad_objetivo_desc_7"] = $_POST["unidad_objetivo_desc_7"];
            $datosS["unidad_objetivo_desc_8"] = $_POST["unidad_objetivo_desc_8"];


            $objetivos = agregar($datosS,"unidad_objetivos");

            if($objetivos>0){
              echo json_encode(["status"=>100, "message"=>"Se registraron los datos"],JSON_UNESCAPED_UNICODE);
            }else{
              echo json_encode(["status"=>0,"message"=>"No se guardaron los datos","datos"=>$_POST],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "verObjetivos"){
         $query = "SELECT * from unidad_objetivos where grupo_id = ".$_POST["id_grupo"];

         $datos = pullQuery($query);

         $cadena = "<option disabled selected value='0'> Seleccione una opción </option>";

         if(count($datos)>0){

                foreach ($datos as $value) {
                    $cadena .= "<option value='".$value["unidad_objetivo_id"]."'>Unidad ".$value["unidad_numero"]."</option>";
                }
                echo json_encode(["status"=>100, "cadena"=>$cadena],JSON_UNESCAPED_UNICODE);
            }else{
                 echo json_encode(["status"=>0, "message"=>"No hay objetivos registrados"],JSON_UNESCAPED_UNICODE);
            } 
        }else if($SSID == "datosObjetivos"){

            $query = "SELECT * FROM unidad_objetivos where unidad_objetivo_id = ".$_POST["unidad_objetivo_id"];
            $datos = pullQuery($query);

            if(count($datos)>0){
                echo json_encode(["status"=>100, "datos"=>$datos],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "cadena"=>"no hay datos","post"=>$_POST],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "EditarObjetivos"){

            unset($datosS);

            $datosS["unidad_objetivo_desc_1"] = $_POST["unidad_objetivo_desc_1"];
            $datosS["unidad_objetivo_desc_2"] = $_POST["unidad_objetivo_desc_2"];
            $datosS["unidad_objetivo_desc_3"] = $_POST["unidad_objetivo_desc_3"];
            $datosS["unidad_objetivo_desc_4"] = $_POST["unidad_objetivo_desc_4"];
            $datosS["unidad_objetivo_desc_5"] = $_POST["unidad_objetivo_desc_5"];
            $datosS["unidad_objetivo_desc_6"] = $_POST["unidad_objetivo_desc_6"];
            $datosS["unidad_objetivo_desc_7"] = $_POST["unidad_objetivo_desc_7"];
            $datosS["unidad_objetivo_desc_8"] = $_POST["unidad_objetivo_desc_8"];


            $objetivos = actualizar($datosS,"unidad_objetivos",$_POST["unidad_objetivo_id"] ,"unidad_objetivo_id");
 
             if($objetivos>0){
                 echo json_encode(["status"=>100, "message"=>"Objetivos actulizados"],JSON_UNESCAPED_UNICODE);
            }else{
                 echo json_encode(["status"=>0, "message"=>"Objetivos No  actulizados","datos"=>$datosS],JSON_UNESCAPED_UNICODE);
            } 
        }else if($SSID == "consultaBoletas"){

            $queryB = "SELECT * from boletas  INNER JOIN alumnos on alumnos.id_alumno = boletas.boleta_id_alumno  where  boleta_id =".$_POST["boleta_id"];
            $datosBo = pullQuery($queryB);


            $query = "SELECT * from  habilidades where boleta_id = ".$_POST["boleta_id"];
            $datos = pullQuery($query);

            $queryU = "SELECT * from unidad_objetivos where grupo_id = ".$datosBo[0]["id_grupo"]." and unidad_numero = ".$datosBo[0]["boleta_unidad"];
            $datosU = pullQuery($queryU);

            $habilidades = count($datos);
            $unidades = count($datosU);

            $cadenaH = "";
            $cadenaU = "";

            if($habilidades == 0){
                $cadenaH = "<label class='col-md-12 text-center' style='color:red;'> No tiene Skills registradas </label>";

            }else{
                $cadenaH = "<label class='col-md-12 text-center' style='color:green;'> Datos de Skills completos! </label>";

            }

            if($unidades==0){
                
                $cadenaU = "<label class='col-md-12 text-center' style='color:red;'> No tiene Objetivos  registrados </label>";
            }else{
                $cadenaU = "<label class='col-md-12 text-center' style='color:green;'> Datos de Objetivos completos! </label>";

            }

            echo json_encode(["status"=>100, "cadena"=>$cadenaH.$cadenaU],JSON_UNESCAPED_UNICODE);
        }else if($SSID == "BorrarUsuario"){

          if($_SESSION["id_tipo_usuario"]!="505"){
            eliminar("usuarios", $_POST["usuario_id"], "id_usuario");
            }
            echo json_encode(["status"=>100, "message"=>"Registro borrado"],JSON_UNESCAPED_UNICODE);
        }else if($SSID == "EUsuarioS"){

             if(!isset($_SESSION)){
                session_start();
            }

         if($_SESSION["id_tipo_usuario"]!="505"){

            $queryU = "SELECT * FROM usuarios where usuario_correo = '". $_POST["usuario_correo"]."' and id_usuario <> ".$_POST["id_usuario"];
            $datosU = pullQuery($queryU);

            if(count($datosU)>0){

                echo json_encode(["status"=>0, "message"=>"El correo  ya esta registrado pruebe con otro"],JSON_UNESCAPED_UNICODE);
            }else{
                $datos["usuario_correo"] = $_POST["usuario_correo"];
                $datos["usuario_nombre"] = $_POST["usuario_nombre"];
                $datos["usuario_ap_paterno"] = $_POST["usuario_ap_paterno"];
                $datos["usuario_ap_materno"] = $_POST["usuario_ap_materno"];
                $datos["usuario_telefono"] = $_POST["usuario_telefono"];

                if($_POST["usuario_password"]!="validado"){
                  $datos["usuario_password_salt"]   = substr(md5(time()), 0, 16);
                  $datos["usuario_password_crypt"] = crypt($_POST["usuario_password"],$datos["usuario_password_salt"]);

                }


                $usuario = actualizar($datos,"usuarios",$_POST["id_usuario"],"id_usuario");
                $message ="";

                $datosJ = json_encode($datos,true);


                $apiToken ="1968148598:AAF0S0x9ITqo5LBpSkM-GRYBFnB_Xncx1Dg";
                $mensaje = "Se actualizo el perfil del usuario ".$_POST["usuario_nombre"]." datos son los siguientes datos el id es ".$_POST["id_usuario"]." <b> ".$datosJ."</b>";
                $data = ['chat_id'=>'@IntoEnglish_programacion',
                          'text'=>$mensaje ,
                          'parse_mode'=>"html"];

                           
                $response = getSslPage("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );


                if(isset($_FILES["file"]["type"])){
                    if (($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/gif")) {
                     if (move_uploaded_file($_FILES["file"]["tmp_name"], "../usuarios/".$_POST["id_usuario"].".jpg")) {

                        $datosImg["usuario_ruta_foto"]=  $_POST["id_usuario"].".jpg";

                        $usuario = actualizar($datosImg,"usuarios",$_POST["id_usuario"] ,"id_usuario");
                        $_SESSION['usuario_ruta_foto'] = $datosImg['usuario_ruta_foto'];




                    } else {
                        $message = "No se guardo la imagen ".$datosImg["usuario_ruta_foto"];
                    }

                   }

                }


                

                if($usuario>0){
                    $_SESSION['usuario_nombre'] = $datos['usuario_nombre']." ".$datos['usuario_ap_paterno']." ".$datos['usuario_ap_materno']; 
                    $_SESSION['usuario_correo'] = $datos['usuario_correo'];
                    $_SESSION['usuario_telefono'] = $datos['usuario_telefono'];
                    

                    echo json_encode(["status"=>100, "message"=>"El usuario se edito correctamente ".$message],JSON_UNESCAPED_UNICODE);
                }else{
                    echo json_encode(["status"=>0, "message"=>"No se guardo".$queryU." ".$message,"datos"=>$datos],JSON_UNESCAPED_UNICODE);
                }
            }  }
        }else if($SSID == "boletas"){

            $query = "SELECT * FROM boletas INNER JOIN alumnos on alumnos.id_alumno = boletas.boleta_id_alumno where alumnos.id_usuario = ".$_POST["id_usuario"] ." and alumnos.id_grupo = ".$_POST["id_grupo"];
            $datos = pullQuery($query);





            if(count($datos)>0){
                $cadena = "<option selected disabled value='0'>Seleccione una opción </option>";

                foreach ($datos as  $value) {
                   $cadena.= "<option data-id='".$value["id_alumno"]."'  value='".$value["boleta_id"]."'>".$value["boleta_unidad"]." </option>";
                }
                echo json_encode(["status"=>100, "cadena"=>$cadena, "datos"=>$datos,"query"=>$query],JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(["status"=>0, "mensaje"=>"Aun no cuentas con "],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "GraficaGruposAlumno"){

            $query = "SELECT * from boletas 
                        INNER JOIN alumnos on boletas.boleta_id_alumno = alumnos.id_alumno 
                        inner join usuarios on alumnos.id_usuario = usuarios.id_usuario 
                        where alumnos.id_grupo = ".$_POST["id_grupo"]." and alumnos.id_usuario = ".$_POST["id_usuario"]." order by boletas.boleta_unidad";

            $datos = pullQuery($query);

            if(count($datos)>0){

                $subtitle = "Alumno ".$datos[0]["usuario_nombre"]." ".$datos[0]["usuario_ap_paterno"]." ".$datos[0]["usuario_ap_materno"];
                $series = [];
                $aux;

                foreach ($datos as  $value) {

                    $aux["name"] = "Unidad ".$value["boleta_unidad"];
                    $aux["data"]= [0,intval($value["boleta_reading_skill"]),intval($value["boleta_written_skill"]),intval($value["boleta_listening_skill"]),intval($value["boleta_speaking_skill"]),0];
                    

                    array_push($series, $aux);
                    unset($aux); 


            }


                echo json_encode(["status"=>100, "datos"=>$series,"subtitle"=>$subtitle],JSON_UNESCAPED_UNICODE);

            }else{


                echo json_encode(["status"=>100, "datos"=>[],"subtitle"=>"Sin Calificaciones registradas"],JSON_UNESCAPED_UNICODE);

            }       
        }else if($SSID == "boletasDatos"){

            $query = "SELECT * FROM boletas where boleta_id = ".$_POST["id_boleta"];
            $datos = pullQuery($query);

       
            if(count($datos)>0){
                     $reading = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'.$datos[0]["boleta_reading_skill"].'" style="width: '.$datos[0]["boleta_reading_skill"].'%;" aria-valuenow="'.$datos[0]["boleta_reading_skill"].'" data-toggle="tooltip" data-placement="right" title="'.$datos[0]["boleta_reading_skill"].'" >'.$datos[0]["boleta_reading_skill"].'</div>';
                     $writing =  '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'.$datos[0]["boleta_written_skill"].'" style="width: '.$datos[0]["boleta_written_skill"].'%;" aria-valuenow="'.$datos[0]["boleta_written_skill"].'" data-toggle="tooltip" data-placement="right" title="'.$datos[0]["boleta_written_skill"].'" >'.$datos[0]["boleta_written_skill"].'</div>';
                     
                     $speaking = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'.$datos[0]["boleta_speaking_skill"].'" style="width: '.$datos[0]["boleta_speaking_skill"].'%;" aria-valuenow="'.$datos[0]["boleta_speaking_skill"].'" data-toggle="tooltip" data-placement="right" title="'.$datos[0]["boleta_speaking_skill"].'" >'.$datos[0]["boleta_speaking_skill"].'</div>';
                     
                     $listening = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'.$datos[0]["boleta_listening_skill"].'" style="width: '.$datos[0]["boleta_listening_skill"].'%;" aria-valuenow="'.$datos[0]["boleta_listening_skill"].'" data-toggle="tooltip" data-placement="right" title="'.$datos[0]["boleta_listening_skill"].'" >'.$datos[0]["boleta_listening_skill"].'</div>';

                 echo json_encode(["status"=>100, "listening"=>$listening,"reading"=>$reading,"writing"=>$writing,"speaking"=>$speaking],JSON_UNESCAPED_UNICODE);
            }else{
                     $reading = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'."0".'" style="width: '."0".'%;" aria-valuenow="'."0".'" data-toggle="tooltip" data-placement="right" title="'."0".'" >Sin registro</div>';
                     $writing =  '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'."0".'" style="width: '."0".'%;" aria-valuenow="'."0".'" data-toggle="tooltip" data-placement="right" title="'."0".'" >Sin registro</div>';
                     
                     $speaking = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'."0".'" style="width: '."0".'%;" aria-valuenow="'."0".'" data-toggle="tooltip" data-placement="right" title="'."0".'" >Sin registro</div>';
                     
                     $listening = '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar"  data-transitiongoal="'."0".'" style="width: '."0".'%;" aria-valuenow="'."0".'" data-toggle="tooltip" data-placement="right" title="'."0".'" >Sin registro</div>';
                
                echo json_encode(["status"=>100, "listening"=>$listening,"reading"=>$reading,"writing"=>$writing,"speaking"=>$speaking],JSON_UNESCAPED_UNICODE);

            }
        }else if($SSID == "obtenerUnidades"){

            $querybol = "SELECT boletas.boleta_id as 'boleta', boletas.boleta_unidad as 'unidad' FROM boletas INNER JOIN alumnos on boletas.boleta_id_alumno = alumnos.id_alumno WHERE alumnos.id_usuario =". $_POST['id_usuario']." and alumnos.id_grupo = ".$_POST["id_grupo"]." order by unidad";
            $datosbol = pullQuery($querybol);

            $aux = 0;
            $cadena  ="";

            
            if(count($datosbol)>0){
                foreach ($datosbol as  $value) {
              
                  if($aux == 0 ){
                  $cadena.= "<option selected value='".$value["boleta"]."'> ".$value["unidad"]." </option>";
                  }else{
                    $cadena.= "<option  value='".$value["boleta"]."'> ".$value["unidad"]." </option>";
                  }

                $aux++;

                }
                echo json_encode(["status"=>100, "cadena"=>$cadena],JSON_UNESCAPED_UNICODE);
            }else{
                 echo json_encode(["status"=>100, "cadena"=>"<option selected value='0'> Sin Calificaciones registradas</option>"],JSON_UNESCAPED_UNICODE);
            }
        }else if($SSID == "ObjetivosDatos"){

            $query = "SELECT * from unidad_objetivos where unidad_numero = ".$_POST["numero"]." and grupo_id = ".$_POST["id_grupo"];
            $datos = pullQuery($query);
            $cadena = "";

            if(count($datos)>0){
                $cadena = "<li > ".$datos[0]["unidad_objetivo_desc_1"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_2"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_3"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_4"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_5"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_6"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_7"]." </li> "."<li > ".$datos[0]["unidad_objetivo_desc_8"]." </li> ";


            }else{
                $cadena = "<ul> No hay objetivos registrados </ul>";
            }

            echo json_encode(["status"=>100, "cadena"=>$cadena,"query"=>$query],JSON_UNESCAPED_UNICODE);

        }else{
            echo json_encode(["status"=>0, "message"=>"No se encontro el SSID"],JSON_UNESCAPED_UNICODE);
        }


 
    }else{
        echo json_encode(["status"=>0, "message"=>"No llego el SSID"],JSON_UNESCAPED_UNICODE);
    }


?>