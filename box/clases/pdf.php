<?php

include $_SERVER["DOCUMENT_ROOT"].'box/fpdf182/fpdf.php';

class pdf extends FPDF{
    
    public function __construct($opc1, $opc2, $opc3, $datos){
        
        parent::__construct($opc1, $opc2, $opc3);
        
        $this->path_img = $_SERVER["DOCUMENT_ROOT"]."img/";
        $this->margen = 5;
        $this->anchuraDocumento = $this->GetPageWidth() - ($this->margen * 2);
        $this->AddPage();
        $this->SetFont("Arial",'B',8);
        $this->SetDrawColor(0,0,0);
        $this->SetXY(5,5);
        $this->datos = $datos;
    }
    
    public function generar_documento(){
        $this->generar_encabezado();
        $this->generar_cuerpo();
        $this->Output('I');
    }
    
    public function retornar_nombre_documento(){
        return $this->tiempo.".pdf";
    }
    
    private function tiempo(){
        return (time() - (1 * 5 * 60 * 60));
    }
    
    private function generar_encabezado(){
        $division = $this->anchuraDocumento / 4;
        $X = $Y = $this->margen;
        $iText = 2.8;
        $this->Cell($division,35,"",1,0,'C',false);
        $this->Cell($division * 2,25,"",1,0,'C',false);
        $this->Cell($division,25,"",1,0,'C',false);
        $this->SetXY($division+5,25+5);
        $this->Cell($division*3,10,"",1,0,'C',false);
        
        $this->Image( $this->path_img."logo-retina.png", $X+2, $X+2, $division-4, $Y+=10);
        $this->Text($X+2, $Y+=12, "Av. de las Naciones No. 46B");
        $this->Text($X+2, $Y+=$iText, "Col. Valle Dorado");
        $this->Text($X+2, $Y+=$iText, utf8_decode("Tlalnepnatla, Estado de México"));
        $this->Text($X+2, $Y+=$iText, utf8_decode("México, C.P. 54020"));
        
        $X = $division + $this->margen + 2;
        $Y = $this->margen + 6;
        $iText++;
        $this->SetFont("Arial",'B',10);
        $this->Text($X+20, $Y, "TRIBUNAL SUPERIOR DE JUSTICIA");
        $this->Text($X+27, $Y+=$iText, utf8_decode("DE LA CIUDAD DE MÉXICO"));
        $this->Text($X+5, $Y+=$iText, utf8_decode("DIRECCIÓN EJECUTIVA DE GESTIÓN TECNOLÓGICA"));
        $this->Text($X+10, $Y+=$iText+2, "Hoja de Servicio de Mantenimiento al Sistema");
        $this->Text($X+27, $Y+=$iText, utf8_decode("Integral de Gestión Judicial"));
        
        $X = $division+5+2;
        $Y = $this->margen+4+25;
        $this->SetFont("Arial",'B',6);
        // $this->Text($X+60, $Y, " ".$this->datos["contrato"]);
        $this->Text($X, $Y, $this->datos["descripcion_contrato"]."\"");
        $this->SetFont("Arial",'B',8);
        $X = ($division*3)+$this->margen; 
        $Y = $this->margen;
        $this->Image( $this->path_img."logo-tsj.jpg", $X+2, $Y+4, $division-4, $Y+10);
    }
    
    private function generar_cuerpo(){
        $division = $this->anchuraDocumento / 12;
        $X = $this->margen;
        $Y = 35 + $this->margen;
        $iText = 2.8;
        $this->SetXY($X, $Y);
        $this->Cell( $division*12, 7, "DATOS DEL REPORTE", 1, 0, 'C'); $Y+=7;
        $this->SetXY($X, $Y); 
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division+13, 7, "Num ticket CAT", 1, 0, 'C', 1);
        $this->Cell( $division+8, 7, "Folio", 1, 0, 'C', 1);
        $this->Cell( ($division*2)+13.2, 7, "Sitio", 1, 0, 'C', 1);
        $this->Cell( ($division*2)+13.2, 7, utf8_decode("Área"), 1, 0, 'C', 1);
        $this->Cell( ($division*2)-7, 7, "Fecha", 1, 0, 'C', 1);
        $this->Cell( ($division*2)-7, 7, "Hora", 1, 0, 'C', 1); $Y+=7;
        $this->SetXY($X, $Y); 
        $this->SetTextColor(0,0,0);
        $this->Cell( $division+13, 14, $this->datos["num_ticket_cat"], 1, 0, 'C');
        $this->Cell( $division+8, 14, $this->datos["folio"], 1, 0, 'C');
         $this->agregarTexto( $this->GetX(), $this->GetY()+5,3,$iText,30,$this->datos["sitio"]);
        $this->Cell(($division*2)+13.2, 14,"", 1, 0, 'C');
         $this->agregarTexto( $this->GetX(), $this->GetY()+5,3,$iText,25,$this->datos["area"]);
        $this->Cell( ($division*2)+13.2, 14, "", 1, 0, 'C');
        $this->Cell( ($division*2)-7, 14, $this->datos["fecha"], 1, 0, 'C');
        $this->Cell( ($division*2)-7, 14, $this->datos["hora"], 1, 0, 'C'); $Y+=14;
        $this->SetXY($X, $Y); 
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division*12, 7, "Datos del Solicitante", 1, 0, 'C',1); $Y+=7;
        $this->SetXY($X, $Y); 
        $this->SetTextColor(0,0,0);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division*8, 7, "Nombre: ".$this->datos["nombre_solicitante"], 1, 0, 'L');
        $this->Cell( $division*2, 14, "", 1, 0, 'C');
        $X+=($division*8)+2;
        $this->Text($X, $Y+=$iText, utf8_decode("Teléfono:"));
        $this->Text($X, $Y+=$iText+2, $this->datos["telefono_solicitante"]);
        $this->Cell( $division*2, 14, "", 1, 0, 'C');
        $X = $this->margen;
        $Y-=($iText * 2)+2;
        $X+=($division*10)+2;
        $this->Text($X, $Y+=$iText, "Ext.:");
        $this->Text($X, $Y+=$iText+2, $this->datos["extencion_solicitante"]);
        $X = $this->margen;
        $Y -= ($iText * 2) + 2;
        $this->SetXY($X, $Y+=7);
        $this->Cell( $division*8, 7, utf8_decode("Área: ").$this->datos["area_solicitante"],1,0,'L');
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X,$Y);
        $this->Cell( $division * 6,7,utf8_decode("TIPO DE OPERACIÓN"),1,0,'L' );
        $this->Cell( $division * 6,7,"FALLA REPORTADA ",1,0,'C' );
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 3,7,"Registro",1,0,"L");
        $this->Cell( $division * 3,7,$this->datos["tipo_registro"],1,0,"C");
         $this->agregarTexto( $this->GetX(), $this->GetY(),1,$iText,70,$this->datos["falla_reportada_diagnostico"]);
        $this->SetFont("Arial",'B',8);
        
        $this->Cell( $division * 6,7 * 4,"",1,0,"L");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X,$Y);
        $this->Cell( $division * 3, 7,utf8_decode("Actualización"),1,0,"L");
        $this->Cell( $division * 3, 7,$this->datos["tipo_actualizacion"],1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X,$Y);
        $this->Cell( $division * 3, 7,utf8_decode("Cancelación"),1,0,"L");
        $this->Cell( $division * 3, 7,$this->datos["tipo_cancelacion"],1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X,$Y);
        $this->Cell( $division * 3, 7,"Otros",1,0,"L");
        $this->Cell( $division * 3, 7,$this->datos["tipo_otros"],1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division * 12,7,utf8_decode("DIAGNOSTICO"),1,0,"C",1);
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(0,0,0);
         $this->agregarTexto( $this->GetX(), $this->GetY(),1,$iText,114,$this->datos["diagnostico"]);
        $this->Cell( $division * 12, 7*3,"",1,0,"L");
        
        $X = $this->margen;
        $Y += 7*3;
        $this->SetXY($X, $Y);
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division * 12, 7,"ACCIONES CORRECTIVAS",1,0,"C",1);
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(0,0,0);
        $this->agregarTexto( $this->GetX(), $this->GetY(),1,$iText,114,$this->datos["ACorrectivas"]);
        $this->Cell( $division * 12, 7*3,"",1,0,"L");
        
        $X = $this->margen;
        $Y += 7*3;
        $this->SetXY($X, $Y);
        $this->agregarTexto( $this->GetX()-2, $this->GetY()+5.1,5,$iText,18,utf8_decode("FECHA DE INICIO DE          ATENCIÓN"));
        $this->Cell( $division * 2, 7*2,"",1,0,"C");
        $this->Cell( $division * 2, 7*2,utf8_decode("FECHA DE SOLUCIÓN"),1,0,"C");
        $this->Cell( $division * 4, 7*2,"SEVERIDAD",1,0,"C");
        $this->agregarTexto( $this->GetX()+1, $this->GetY()+1,0,$iText,15,utf8_decode("Observaciones:"));
        $this->SetFont("Arial",'B',7);
        $this->agregarTexto( $this->GetX()+1, $this->GetY()+3+$iText+1,0,$iText,40,utf8_decode($this->datos["observaciones"]));
        $this->Cell( $division * 4, 7*4,"",1,0,"C");
        $this->SetFont("Arial",'B',8);
        
        $X = $this->margen;
        $Y += 7*2;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 2, 7,$this->datos["fecha_inicio_atencion"],1,0,"C");
        $this->Cell( $division * 2, 7,$this->datos["fecha_solucion"],1,0,"C");
        if( $this->datos["severidad"] == "N" ) $this->agregarTexto( $this->GetX()+10, $this->GetY()+13,0,$iText,15,"X");
        $this->Cell( ($division * 4)/3, 7*3,"NORMAL",1,0,"C");
        if( $this->datos["severidad"] == "U" ) $this->agregarTexto( $this->GetX()+10, $this->GetY()+13,0,$iText,15,"X");
        $this->Cell( ($division * 4)/3, 7*3,"URGENTE",1,0,"C");
        if( $this->datos["severidad"] == "C" ) $this->agregarTexto( $this->GetX()+10, $this->GetY()+13,0,$iText,15,"X");
        $this->Cell( ($division * 4)/3, 7*3,"CRITICA",1,0,"C");
        $this->SetXY($this->GetX(), $this->GetY()+14);
        $this->Cell( $division * 4, 7*8,"",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->agregarTexto( $this->GetX()-2, $this->GetY()+5.1,5,$iText,18,utf8_decode("HORA DE INICIO DE         ATENCIÓN"));
        $this->Cell( $division * 2, 7*2,"",1,0,"C");
        $this->Cell( $division * 2, 7*2,utf8_decode("HORA DE SOLUCIÓN"),1,0,"C");
        
        $X = $this->margen;
        $Y += 7*2;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 2, 7,$this->datos["hora_inicio_atencion"],1,0,"C");
        $this->Cell( $division * 2, 7,$this->datos["hora_solucion"],1,0,"C");
        $this->SetFont("Arial",'B',7);
        $this->Cell( $division * 4, 7,"Estado:O Concluido/ O Cancelado/ O En proceso",1,0,"C");
        $this->SetFont("Arial",'B',8);
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( $division * 8, 7,utf8_decode("EVALUACIÓN DEL SERVICIO"),1,0,"C",1);
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(0,0,0);
        $this->Cell( $division * 4, 7,"",1,0,"C");
        $this->Cell( $division, 7,"Excelente",1,0,"C");
        $this->Cell( $division, 7,"Bueno",1,0,"C");
        $this->Cell( $division, 7,"Regular",1,0,"C");
        $this->Cell( $division, 7,"Malo",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 4, 7,"Puntualidad",1,0,"L");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 4, 7,"Orden",1,0,"L");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 4, 7,"Amabilidad",1,0,"L");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 4, 7,"Actitud de Servicio",1,0,"L");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        $this->Cell( $division, 7,"O",1,0,"C");
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->Cell( $division * 4, 7,"Por \"TOTALPAT, S.A de C.V.\"",1,0,"C");
        $this->Cell( $division * 4, 7,utf8_decode("Por la D.E.G.T. "),1,0,"C");
        $this->Cell( $division * 4, 7,utf8_decode("Por el área Usuaria"),1,0,"C");
        
        //$this->AddPage();
        $this->SetAutoPageBreak(false);
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(255,255,255);
        $this->SetFillColor(0,0,0);
        $this->Cell( ($division * 4)/2, 7,"Nombre",1,0,"L",1);
        $this->Cell( ($division * 4)/2, 7,"Firma",1,0,"L",1);
        $this->Cell( ($division * 4)/2, 7,"Nombre",1,0,"L",1);
        $this->Cell( ($division * 4)/2, 7,"Firma",1,0,"L",1);
        $this->Cell( ($division * 4)/2, 7,"Nombre",1,0,"L",1);
        $this->Cell( ($division * 4)/2, 7,"Firma",1,0,"L",1);
        
        $X = $this->margen;
        $Y += 7;
        $this->SetXY($X, $Y);
        $this->SetTextColor(0,0,0);
        $this->SetFont("Arial",'B',7);
        $this->agregarTexto($this->GetX(),$this->GetY()+3,3,$iText,18,$this->datos["nombre_persona_realizo"]);
       
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"L");
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"R");
        $this->agregarTexto($this->GetX()-3,$this->GetY()+3,5,$iText,20,$this->datos["nombre_persona_direccion_ejecutiva"]);
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"L");
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"R");
         $this->agregarTexto($this->GetX(),$this->GetY()+3,3,$iText,18,$this->datos["nombre_persona_area_usuaria"]);
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"L");
        $this->Cell( ($division * 4)/2, 7*2,"",1,0,"L");
    }
    
   private function agregarTexto( $X, $Y, $margenX, $factorLinea, $longitudCadena, $texto ){    
    if( strlen($texto) > $longitudCadena && $longitudCadena > 15 ){

        $inicio = $con = 0;
        $final_cadena = $caracteres_extraer = $longitudCadena;
        $caracter_final = $caracter_siguiente = "";
        for($iY = $factorLinea; $inicio<strlen($texto); $iY += $factorLinea, $caracteres_extraer = $longitudCadena, $final_cadena += $longitudCadena ){

            $caracter_final = $texto[$final_cadena-1];
            $caracter_siguiente = $texto[$final_cadena];

            if( !(($caracter_final == " " && $caracter_siguiente != " ") || ($caracter_final != " " && $caracter_siguiente == " " )) ){
                $caracteres = 0;
                for( $i=$final_cadena; $texto[$i] != " "; $i-- ){ $caracteres++; }
                $caracteres_extraer -= $caracteres;
                $final_cadena -= $caracteres;
            }

            $cadena = substr($texto, $inicio, $caracteres_extraer);
            $inicio += $caracteres_extraer;
            $this->Text( $X+$margenX, $Y+$iY, $cadena );

            $caracteres_sobrantes = strlen($texto) - $final_cadena;
            if( $caracteres_sobrantes <= $longitudCadena ){
                $cadena = substr($texto, $inicio, $caracteres_sobrantes);
                $iY += $factorLinea;
                $this->Text( $X+$margenX, $Y+$iY, $cadena );
                $inicio += $caracteres_sobrantes;
            }
        }

    } else {
        $this->Text( $X+$margenX, $Y+$factorLinea, $texto );
    }
}
    
}



/*$datos = [
        "contrato" => "-num contrato-",
        "descripcion_contrato" => "-descripcion contrato-",
        "num_ticket_cat" => "101010",
        "folio" => "101010",
        "sitio" => "-sitio-",
        "area" => "-area-",
        "fecha" => "-fecha-",
        "hora" => "-hora-",
        "nombre_solicitante" => "-nombre solicitante-",
        "telefono_solicitante" => "55-55-55-55-55",
        "extencion_solicitante" => "120",
        "area_solicitante" => "-area solicitante-",
        "tipo_registro" => "",
        "tipo_actualizacion" => "",
        "tipo_cancelacion" => "",
        "tipo_otros" => "-otros-",
        "falla_reportada" => "-texto largo-",
        "diagnostico" => "-texto largo-",
        "acciones_correctivas" => "-texto largo-",
        "fecha_inicio_atencion" => "-fecha-",
        "fecha_solucion" => "-fecha-",
        "hora_inicio_atencion" => "-hora-",
        "hora_solucion" => "-hora-",
        "nombre_persona_realizo" => "-nombre-",
        "nombre_persona_direccion_ejecutiva" => "-nombre-",
        "nombre_persona_area_usuaria" => "-nombre-",
        "severidad" => "N"
    ];

$pdf = new pdf('P','mm','A4', $datos);
$pdf->generar_documento();*/