<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET["alumno"];


use setasign\Fpdi\Fpdi;

require_once('../box/fpdf182/fpdf.php');
require_once('../box/fpdfi/src/autoload.php');

// initiate FPDI
$pdf = new FPDI();

// set the source file
$pageCount = $pdf->setSourceFile("../plantillas/boleta.pdf");

for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $tplIdx = $pdf->importPage($pageNo);

    // add a page
    $pdf->AddPage();
    $pdf->useTemplate($tplIdx, 0, 0, 216,278,true);

    // font and color selection
    $pdf->SetFont('Helvetica');
    $pdf->SetTextColor(200, 0, 0);

    // now write some text above the imported page
    $pdf->SetXY(40, 83);
    $pdf->Write(2, $id);
}

$pdf->Output("I","prueba.pdf");


?>



    