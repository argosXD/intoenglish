<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$alumno = $_GET["alumno"];
$boleta = $_GET["boleta"];

use setasign\Fpdi\Fpdi;

require_once('../box/fpdf182/fpdf.php');
require_once('../box/fpdfi/src/autoload.php');

$path_img = "/public_html/usuarios";

require($_SERVER['DOCUMENT_ROOT']."/box/base/base.lib.php");

// initiate FPDI
$pdf = new FPDI();

// set the source file
$pageCount = $pdf->setSourceFile("../plantillas/boleta.pdf");

$queryAlumno = "SELECT * from alumnos
          inner join usuarios on usuarios.id_usuario = alumnos.id_usuario  
          where alumnos.id_alumno = ".$alumno;

$datos = pullQuery($queryAlumno);

$queryMaestroGrupo = "SELECT * from grupos
          inner join usuarios on usuarios.id_usuario = grupos.id_usuario
          inner join niveles on niveles.id_nivel =  grupos.id_nivel 
          where grupos.id_grupo = ".$datos[0]["id_grupo"];

$datosMG = pullQuery($queryMaestroGrupo);

$queryBoletaU = "SELECT * FROM boletas where boleta_id = ".$boleta;
$datosBoleta = pullQuery($queryBoletaU);


$queryBoleta = "SELECT * FROM boletas where boleta_id_alumno = ".$alumno." and boleta_unidad <= ".$datosBoleta[0]["boleta_unidad"]." order by boleta_unidad";

$datosBo = pullQuery($queryBoleta);

$queryBoletaS = "SELECT * FROM boletas where boleta_id_alumno = ".$alumno." and boleta_unidad = ".$datosBoleta[0]["boleta_unidad"]." order by boleta_unidad";

$datosBoS = pullQuery($queryBoletaS);


for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $tplIdx = $pdf->importPage($pageNo);

    // add a page
    $pdf->AddPage();
    $pdf->useTemplate($tplIdx, 0, 0, 216,278,true);

    if($pageNo==1){

      // font and color selection

      $pdf->SetFont('Helvetica',"",9);
      $pdf->SetTextColor(0, 0, 0);

      // now write some text above the imported page
      $pdf->SetXY(83, 38);
      $pdf->Write(2, utf8_decode($datos[0]["usuario_nombre"])." ".utf8_decode($datos[0]["usuario_ap_paterno"])." ".utf8_decode($datos[0]["usuario_ap_materno"]));

      $pdf->SetXY(156, 38);
      $pdf->SetFont('Helvetica',"",9.5);
      $pdf->Write(2, utf8_decode($datosMG[0]["nivel_descripcion"]));

      $pdf->SetFont('Helvetica',"",9);
      $pdf->SetXY(83, 43);
      $pdf->Write(2, utf8_decode($datosMG[0]["usuario_nombre"])." ".utf8_decode($datosMG[0]["usuario_ap_paterno"])." ".utf8_decode($datosMG[0]["usuario_ap_materno"]));

      $pdf->SetXY(192, 37.5);
      $pdf->SetFont('Helvetica',"",11);
      $pdf->Write(2, utf8_decode($datosBoleta[0]["boleta_unidad"]));


      $pdf->SetFont('Helvetica',"",9.5);
      $pdf->SetXY(157, 43);
      $pdf->Write(2,utf8_decode($datosMG[0]["grupo_tipo_curso"]));

  


      
   

       $pdf->Image( $_SERVER['DOCUMENT_ROOT']."/usuarios/".$datos[0]["usuario_ruta_foto"], 13.2, 38.65, 36, 48);

       $pdf->SetFont('Helvetica',"",11);

       foreach ($datosBo as $value) {

         if($value["boleta_unidad"]=="1"){

           $pdf->SetXY(109, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(109, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(109, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(109, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(109, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(109, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(109, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(109, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);


         }

         if($value["boleta_unidad"]=="2"){

           $pdf->SetXY(124.9, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(124.9, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(124.9, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(124.9, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(124.9, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(124.9, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(124.9, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(124.9, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);

         }

         if($value["boleta_unidad"]=="3"){

           $pdf->SetXY(138.9, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(138.9, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(138.9, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(138.9, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(138.9, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(138.9, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(138.9, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));  

           $pdf->SetXY(138.9, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);

         }

         if($value["boleta_unidad"]=="4"){

           $pdf->SetXY(154.9, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(154.9, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(154.9, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(154.9, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(154.9, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(154.9, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(154.9, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(154.9, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);

         }

         if($value["boleta_unidad"]=="5"){

           $pdf->SetXY(172.5, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(172.5, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(172.5, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(172.5, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(172.5, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(172.5, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(172.5, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(172.5, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);

         }

         if($value["boleta_unidad"]=="6"){

           $pdf->SetXY(189.5, 60.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(189.5, 65.4);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(189.5, 70.2);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(189.5, 75);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(189.5, 79.8);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(189.5, 84.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(189.5, 89.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(189.5, 94.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="7"){

           $pdf->SetXY(109, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(109, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(109, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(109, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(109, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(109, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(109, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(109, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="8"){

           $pdf->SetXY(124.9, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(124.9, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(124.9, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(124.9, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(124.9, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(124.9, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(124.9, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(124.9, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="9"){

           $pdf->SetXY(138.9, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(138.9, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(138.9, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(138.9, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(138.9, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(138.9, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(138.9, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(138.9, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="10"){

           $pdf->SetXY(154.9, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(154.9, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(154.9, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(154.9, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(154.9, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(154.9, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(154.9, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(154.9, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="11"){

           $pdf->SetXY(172.5, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(172.5, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(172.5, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(172.5, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(172.5, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(172.5, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(172.5, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(172.5, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

         if($value["boleta_unidad"]=="12"){

           $pdf->SetXY(189.5, 60.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_hours_covered"]));

           $pdf->SetXY(189.5, 65.4+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_attendance"]));

           $pdf->SetXY(189.5, 70.2+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_class_participation"]));

           $pdf->SetXY(189.5, 75+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_speaking_skill"]));

           $pdf->SetXY(189.5, 79.8+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_listening_skill"]));

           $pdf->SetXY(189.5, 84.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_written_skill"]));

           $pdf->SetXY(189.5, 89.5+51.5);
           $pdf->Write(2,utf8_decode($value["boleta_reading_skill"]));

           $pdf->SetXY(189.5, 94.5+51.5);
           $prom = ($value["boleta_speaking_skill"]+$value["boleta_listening_skill"]+$value["boleta_written_skill"]+$value["boleta_reading_skill"])/4; 
           $pdf->Write(2,$prom);
         }

        }
        $pdf->SetXY(15, 227);
        $pdf->SetFont('Helvetica',"",11);
        $pdf->Write(2, utf8_decode($datosBoleta[0]["boleta_final_feedback"]));

        $queryObjetivos = "SELECT * from unidad_objetivos where grupo_id = ".$datos[0]["id_grupo"]." and unidad_numero = ".$datosBoleta[0]["boleta_unidad"];
        $datosOb = pullQuery($queryObjetivos);

        if(count($datosOb)>0){

          $pdf->SetXY(19, 164);
          $pdf->SetFont('Helvetica',"",11);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_1"]));

          $pdf->SetXY(19, 169-0.3);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_2"]));

          $pdf->SetXY(19, 174-0.3);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_3"]));

          $pdf->SetXY(19, 179-0.3);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_4"]));

          $pdf->SetXY(19, 184-0.5);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_5"]));

          $pdf->SetXY(19, 189-0.5);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_6"]));

          $pdf->SetXY(19, 194-0.5);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_7"]));

          $pdf->SetXY(19, 199-0.5);
          $pdf->Write(2, utf8_decode($datosOb[0]["unidad_objetivo_desc_8"]));

        }else{

          $pdf->SetXY(19, 164);
          $pdf->SetFont('Helvetica',"",11);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 169-0.3);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 174-0.3);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 179-0.3);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 184-0.5);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 189-0.5);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 194-0.5);
          $pdf->Write(2, utf8_decode(""));

          $pdf->SetXY(19, 199-0.5);
          $pdf->Write(2, utf8_decode(""));

        }



 

       }

    if($pageNo==2){

      $pdf->SetXY(0, 0);
      foreach ($datosBoS as $value) {
        
       $querySkill = "SELECT * FROM habilidades where boleta_id = ".$value["boleta_id"];

       $datosS = pullQuery($querySkill);
        if(count($datosS)>0){

          foreach ($datosS as  $valueS){

            if($valueS["habilidad_tipo"]=="Speaking"){
              if($valueS["habilidad_1"]=="Excellent"){
                 $pdf->SetXY(154.5, 63.1-0.5-0.2);
                 $pdf->Write(2,"X");
              }else if($valueS["habilidad_1"]=="Good"){
                 $pdf->SetXY(170, 63.1-0.5);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_1"]=="Fair"){
                 $pdf->SetXY(182, 63.1-0.5);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_1"]=="Poor"){
                 $pdf->SetXY(194.5, 63.1-0.5);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_2"]=="Excellent"){
                 $pdf->SetXY(154.5, 68.2-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_2"]=="Good"){
                 $pdf->SetXY(170, 68.2-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_2"]=="Fair"){
                 $pdf->SetXY(182, 68.2-0.2);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_2"]=="Poor"){
                 $pdf->SetXY(194.5, 68.2-0.2);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_3"]=="Excellent"){
                 $pdf->SetXY(154.5, 73.4-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_3"]=="Good"){
                 $pdf->SetXY(170, 73.4-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_3"]=="Fair"){
                 $pdf->SetXY(182, 73.4-0.2);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_3"]=="Poor"){
                 $pdf->SetXY(194.5, 73.4-0.2);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_4"]=="Excellent"){
                 $pdf->SetXY(154.5, 78.6-0.3);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_4"]=="Good"){
                 $pdf->SetXY(170, 78.6-0.3);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_4"]=="Fair"){
                 $pdf->SetXY(182, 78.6-0.3);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_4"]=="Poor"){
                 $pdf->SetXY(194.5, 78.6-0.3);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_5"]=="Excellent"){
                 $pdf->SetXY(154.5, 83.7-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_5"]=="Good"){
                 $pdf->SetXY(170, 83.7-0.2);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_5"]=="Fair"){
                 $pdf->SetXY(182, 83.7-0.2);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_5"]=="Poor"){
                 $pdf->SetXY(194.5, 83.7-0.2);
                 $pdf->Write(2,"X");
                
              }

                 $pdf->SetXY(13, 103);
                 $pdf->Write(2,utf8_decode($valueS["habilidad_feedback"]));


              //agregar feedback
            }

            if($valueS["habilidad_tipo"]=="Listening"){

              if($valueS["habilidad_1"]=="Excellent"){
                 $pdf->SetXY(124.1, 152.7-0.75);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_1"]=="Good"){
                 $pdf->SetXY(145.3, 152.7-0.75);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_1"]=="Fair"){
                 $pdf->SetXY(164.3, 152.7-0.75);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_1"]=="Poor"){
                 $pdf->SetXY(186.5, 152.7-0.75);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_2"]=="Excellent"){
                 $pdf->SetXY(124.1, 157);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_2"]=="Good"){
                 $pdf->SetXY(145.3, 157);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_2"]=="Fair"){
                 $pdf->SetXY(164.3, 157);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_2"]=="Poor"){
                 $pdf->SetXY(186.5, 157);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_3"]=="Excellent"){
                 $pdf->SetXY(124.1, 163-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_3"]=="Good"){
                 $pdf->SetXY(145.3, 163-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_3"]=="Fair"){
                 $pdf->SetXY(164.3, 163-0.8);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_3"]=="Poor"){
                 $pdf->SetXY(186.5, 163-0.8);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_4"]=="Excellent"){
                 $pdf->SetXY(124.1, 168.2-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_4"]=="Good"){
                 $pdf->SetXY(145.3, 168.2-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_4"]=="Fair"){
                 $pdf->SetXY(164.3, 168.2-0.8);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_4"]=="Poor"){
                 $pdf->SetXY(186.5, 168.2-0.8);
                 $pdf->Write(2,"X");
                
              }

              if($valueS["habilidad_5"]=="Excellent"){
                 $pdf->SetXY(124.1, 173.4-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_5"]=="Good"){
                 $pdf->SetXY(145.3, 173.4-0.8);
                 $pdf->Write(2,"X");

              }else if($valueS["habilidad_5"]=="Fair"){
                 $pdf->SetXY(164.3, 173.4-0.8);
                 $pdf->Write(2,"X");
                
              }else if($valueS["habilidad_5"]=="Poor"){
                 $pdf->SetXY(186.5, 173.4-0.8);
                 $pdf->Write(2,"X");
                
              }

               $pdf->SetXY(13, 193);
               $pdf->Write(2,utf8_decode($valueS["habilidad_feedback"]));
            }

            
          }
        }

      }
    }

    if($pageNo==3){

      $pdf->SetXY(0, 0);

      foreach ($datosBoS as $value) {
        
       $querySkill = "SELECT * FROM habilidades where boleta_id = ".$value["boleta_id"];

       $datosS = pullQuery($querySkill);

        if(count($datosS)>0){

          foreach ($datosS as  $valueS) {

            if($valueS["habilidad_tipo"]=="Writing"){
              if($valueS["habilidad_1"]=="Excellent"){
                 $pdf->SetXY(148,63-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Good"){
                 $pdf->SetXY(165.5,63-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Fair"){
                 $pdf->SetXY(178,63-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Poor"){
                 $pdf->SetXY(189.2,63-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Excellent"){
                 $pdf->SetXY(148,68.5-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Good"){
                 $pdf->SetXY(165.5,68.5-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Fair"){
                 $pdf->SetXY(178,68.5-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Poor"){
                 $pdf->SetXY(189.2,68.5-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Excellent"){
                 $pdf->SetXY(148,74-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Good"){
                 $pdf->SetXY(165.5,74-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Fair"){
                 $pdf->SetXY(178,74-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Poor"){
                 $pdf->SetXY(189.2,74 );
                 $pdf->Write(2,"X");
              }


              if($valueS["habilidad_4"]=="Excellent"){
                 $pdf->SetXY(148,79.6-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Good"){
                 $pdf->SetXY(165.5,79.6-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Fair"){
                 $pdf->SetXY(178,79.6 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Poor"){
                 $pdf->SetXY(189.2,79.6-0.4 );
                 $pdf->Write(2,"X");
              }


              if($valueS["habilidad_5"]=="Excellent"){
                 $pdf->SetXY(148,85.2-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Good"){
                 $pdf->SetXY(165.5,85.2-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Fair"){
                 $pdf->SetXY(178,85.2-0.4 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Poor"){
                 $pdf->SetXY(189.2,85.2-0.4 );
                 $pdf->Write(2,"X");
              }

               $pdf->SetXY(13, 104);
               $pdf->Write(2,utf8_decode($valueS["habilidad_feedback"]));
            }

            if($valueS["habilidad_tipo"]=="Reading"){
              if($valueS["habilidad_1"]=="Excellent"){
                 $pdf->SetXY(124.2,156.5-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Good"){
                 $pdf->SetXY(145.5,156.5-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Fair"){
                 $pdf->SetXY(164.2,156.5-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_1"]=="Poor"){
                 $pdf->SetXY(183.7,156.5-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Excellent"){
                 $pdf->SetXY(124.2,161.69-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Good"){
                 $pdf->SetXY(145.5,161.69-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Fair"){
                 $pdf->SetXY(164.2,161.69-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_2"]=="Poor"){
                 $pdf->SetXY(183.7,161.69-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Excellent"){
                 $pdf->SetXY(124.2,166.85-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Good"){
                 $pdf->SetXY(145.5,166.85-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Fair"){
                 $pdf->SetXY(164.2,166.85-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_3"]=="Poor"){
                 $pdf->SetXY(183.7,166.85-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Excellent"){
                 $pdf->SetXY(124.2,172-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Good"){
                 $pdf->SetXY(145.5,172-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Fair"){
                 $pdf->SetXY(164.2,172-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_4"]=="Poor"){
                 $pdf->SetXY(183.7,172-1.5 );
                 $pdf->Write(2,"X");
              }

                if($valueS["habilidad_5"]=="Excellent"){
                 $pdf->SetXY(124.2,177.2-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Good"){
                 $pdf->SetXY(145.5,177.2-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Fair"){
                 $pdf->SetXY(164.2,177.2-1.5 );
                 $pdf->Write(2,"X");
              }

              if($valueS["habilidad_5"]=="Poor"){
                 $pdf->SetXY(183.7,177.2-1.5 );
                 $pdf->Write(2,"X");
              }

               $pdf->SetXY(13, 197);
               $pdf->Write(2,utf8_decode($valueS["habilidad_feedback"]));
            }

          }

        }
      }
    }

   
    

    
}

$pdf->Output("I","prueba.pdf");


?>