<?php

// include("../box/clases/pdf.php");
require($_SERVER['DOCUMENT_ROOT']."/box/const/const.lib.php");
require(BASE_PATH."base.lib.php");

require($_SERVER['DOCUMENT_ROOT']."/box/clases/pdf.php");

 $query = "SELECT * FROM ticket_servicios inner join tareas on tareas.tarea_id = ticket_servicios.tarea_id 
                                          inner join tipos_tarea on tipos_tarea.tipo_tarea_id = tareas.tipo_tarea_id
                                          inner join proyectos on proyectos.proyecto_id = tareas.proyecto_id 
                                          inner join usuarios on usuarios.usuario_id = ticket_servicios.usuario_id 
                                          inner join tsjcdmx_sitios on tsjcdmx_sitios.tsjcdmx_sitio_id = ticket_servicios.tsjcdmx_sitio_id 
                                          inner join tsjcdmx_areas on tsjcdmx_areas.tsjcdmx_area_id = ticket_servicios.tsjcdmx_area_id 
                                          where ticket_servicios.ticket_servicio_id = ".$_GET["ticket_id"];

$datosTicket = pullQuery($query);

$queryaux = "SELECT * FROM ticket_servicios where ticket_servicio_id = ".$_GET["ticket_id"];
$datosT = pullQuery($queryaux);

$queryUsuario = "SELECT * FROM  participantes_tarea  inner join usuarios on usuarios.usuario_id = participantes_tarea.usuario_id where participantes_tarea.tarea_id = ".$datosT[0]["tarea_id"]." limit 1";
$datosUsuario = pullQuery($queryUsuario);

$query2 ="SELECT * FROM  tickets_serv_cierre  inner join usuarios on usuarios.usuario_id = tickets_serv_cierre.usuario_id 
          where  tickets_serv_cierre.ticket_servicio_id = ".$_GET["ticket_id"]." ORDER BY ticket_serv_cierre_fecha_cre DESC ";


$datosTicket2 = pullQuery($query2);

$auxR = "";
$auxA = "";
$auxC = "";
$auxO = "";

$severidad ="";

if($datosTicket[0]["ticket_servicio_prioridad"]=="Normal"){
    $severidad ="N";
}elseif($datosTicket[0]["ticket_servicio_prioridad"]=="Urgente"){
    $severidad ="U";
}elseif($datosTicket[0]["ticket_servicio_prioridad"]=="Critica"){
    $severidad ="C";
}

if($datosTicket[0]["ticket_servicio_to"]=="Registro"){
    $auxR = "X";

}elseif ($datosTicket[0]["ticket_servicio_to"]=="Actualización") {
    $auxA = "X";

}elseif ($datosTicket[0]["ticket_servicio_to"]=="Cancelación") {
    $auxC = "X";
    
}elseif ($datosTicket[0]["ticket_servicio_to"]=="Otros") {
    $auxO = "X";
}
  
// $datos = $_
$datos = [
    "contrato" => utf8_decode($datosTicket[0]["proyecto_nombre"]),
    "descripcion_contrato" => str_replace("?","'",utf8_decode($datosTicket[0]["proyecto_descripcion"])),
    "num_ticket_cat" => utf8_decode($datosTicket[0]["ticket_servicio_numero"]),
    "folio" => $datosTicket[0]["proyecto_iniciales"]."-".($datosTicket[0]["ticket_servicio_consecutivo"]<=99?"0".$datosTicket[0]["ticket_servicio_consecutivo"]:$datosTicket[0]["ticket_servicio_consecutivo"]),
    "sitio" => utf8_decode($datosTicket[0]["tsjcdmx_sitio_descripcion"]),
    "area" => utf8_decode($datosTicket[0]["tsjcdmx_area_desc"]),
    "fecha" =>utf8_decode(strftime("%F",strtotime( $datosTicket[0]["ticket_servicio_fecha_AP"]))),
    "hora" => utf8_decode(strftime("%H:%M",strtotime( $datosTicket[0]["ticket_servicio_fecha_AP"]))),
    "nombre_solicitante" => utf8_decode($datosTicket[0]["ticket_servicio_nombre"]),
    "telefono_solicitante" => utf8_decode($datosTicket[0]["ticket_servicio_tel"]),
    "extencion_solicitante" => utf8_decode($datosTicket[0]["ticket_servicio_extencion"]),
    "area_solicitante" => utf8_decode($datosTicket[0]["tsjcdmx_area_desc"]),
    "tipo_registro" => $auxR,
    "tipo_actualizacion" => $auxA,
    "diagnostico"=> utf8_decode($datosTicket[0]["ticket_servicio_descripcion"]),
    "tipo_cancelacion" => $auxC , 
    "tipo_otros" =>$auxO ,
    "falla_reportada_diagnostico" => utf8_decode($datosTicket[0]["tipo_tarea_descripcion"]),
    "ACorrectivas" => utf8_decode($datosTicket2[0]["ticket_serv_cierre_des"]),
    "historico" => utf8_decode($datosTicket[0]["ticket_servicio_seguimiento"]),
    "fecha_inicio_atencion" =>strftime("%F",strtotime($datosTicket[0]["ticket_servicio_fecha_creacion"])),
    "fecha_solucion" => strftime("%F",strtotime($datosTicket2[0]["ticket_serv_cierre_fecha_cre"])),
    "hora_inicio_atencion" => strftime("%H:%M",strtotime($datosTicket[0]["ticket_servicio_fecha_creacion"])),
    "hora_solucion" => strftime("%H:%M",strtotime($datosTicket2[0]["ticket_serv_cierre_fecha_cre"])),
    "nombre_persona_realizo" => strtoupper(utf8_decode($datosUsuario[0]["usuario_nombre"])),
    "nombre_persona_direccion_ejecutiva" => strtoupper(utf8_decode("Ing. Salvador García Rios")),
    "nombre_persona_area_usuaria" => utf8_decode($datosTicket[0]["ticket_servicio_nombre"]),
    "severidad" => $severidad,
    "observaciones"=> $datosT[0]["ticket_servicio_seguimiento"]
];

$pdf = new pdf('P','mm','A4', $datos);

$pdf->generar_documento();





?>