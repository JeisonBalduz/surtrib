<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');


//$codigo = $_GET['codigo'];
$codigo = $_GET['codigo'];
$cadena = explode(",",$_REQUEST['codigo']);
$codigo = "'".implode("','",$cadena)."'";


$tramite = "SELECT g.period,a.direccion as dirser,a.sector,a.calle,a.edificio,a.nedificio,m.id as referencia,IF(a.tipotax=1,'Comercial','Residencial') as tiposerv,u.rfc,u.name,u.rif,a.id as idserv,g.id,g.tax,g.moment,g.hashkey,g.iduser,t.categoriatax,t.tipotax,t.idt,t.ramotax,m.tramite,m.period as annomm FROM gaugingaseo g LEFT JOIN ambiente a ON a.id=g.idrelaseo LEFT JOIN mayor_aseo m ON g.hashkey=m.tramite LEFT JOIN taxaseo t ON a.idtambiente=t.idt LEFT JOIN users u ON u.rfc=m.idrfc WHERE g.id=".$codigo."";


$link = $conexion;


if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite)) {
$con=0;
$tramite="";
while ($obj = mysqli_fetch_object($result)) {
     $referencia=$obj->referencia;
    $rfc=$obj->rfc;
    $rif=$obj->rif;
    $idserv=$obj->idserv;
    $tiposerv=$obj->tiposerv;
    $sector=$obj->sector;
    $calle=$obj->calle;
    $edificio=$obj->edificio;
    $nedificio=$obj->nedificio;
    $dirser=$obj->dirser;
     $tramite=$obj->tramite;
    $tipotax=$obj->tipotax;
    $ramotax=$obj->ramotax;
    $categoriatax=$obj->categoriatax;
    $period=$obj->period;
    $rif=$obj->rif;
    $rif=$obj->rif;
    $nombre=$obj->name;
    if($con==0){
    $tramite=$obj->tramite;
     }else{ 
      $tramite.=",".$obj->tramite;}
    $annomm=$obj->annomm;
   
   $con++;
   
    
 }
  mysqli_free_result($result);
}


$tramite2 = "SELECT * FROM mayor_aseo m LEFT JOIN tributes_aseo t ON m.idt=t.idt WHERE m.period=(SELECT period FROM mayor_aseo h WHERE h.tramite=".$tramite.") AND m.moment=(SELECT moment FROM mayor_aseo h WHERE h.tramite=".$tramite.")";

$datos = mysqli_query($link,$tramite2);

class PDF extends FPDF
{
// Cabecera de página
//Numeros de paginas
//SetTextColor(255,255,255);es RGB extraer colores con GIMP
//SetFillColor()
//SetDrawColor()
//Line(derecha-izquierda, arriba-abajo,ancho,arriba-abajo)
//Color line setDrawColor(61,174,233)
//GetX() || GetY() posiciones en cm
//Grosor SetLineWidth(1)
// SetFont(tipo{COURIER, HELVETICA,ARIAL,TIMES,SYMBOL, ZAPDINGBATS}, estilo[normal,B,I ,A], tamaño)
// Cell(ancho , alto,texto,borde,salto(0/1),alineacion,rellenar, link)
//AddPage(orientacion[PORTRAIT, LANDSCAPE], tamño[A3.A4.A5.LETTER,LEGAL],rotacion)
//Image(ruta, poscisionx,pocisiony,alto,ancho,tipo,link)
//SetMargins(10,30,20,20) luego de addpage
  
function Header()
{
//$this->Image('img/banner.jpg',20,20,180);
$this->Image('img/logo.jpg',180,8,25);
$this->Image('img/logoa.jpg',10,9,25);
$this->SetY(14);
$this->SetX(0);

$this->SetFont('Arial','B',12);
$this->Cell(0, 0, 'REPUBLICA BOLIVARIANA DE VENEZUELA',0,0,'C');
$this->SetY(18);
$this->SetX(0);
$this->SetFont('Arial','',10);
$this->Cell(0, 0, utf8_decode('MUNICIPIO LIBERTADOR ESTADO CARABOBO'),0,0,'C');
$this->SetY(22);
$this->SetX(0);
$this->SetFont('Arial','',10);
$this->Cell(0, 0, utf8_decode('Instituto Autonomo de Gestion Ambiental del Municipio Libertador'),0,0,'C');

$this->Ln(20);

}

function Footer()
{

     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(180);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,-10,utf8_decode("Alcaldia de Libertador Estado Carabobo © Todos los derechos reservados."),0,0,"C");
        
}


}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','letter');
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


 //-------------Datos Contribuyente

$pdf->SetX(10);
$pdf->SetY(26);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10.5);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 8, utf8_decode('DECLARACION IMPUESTO DE RECOLECCION DE DESECHOS SOLIDOS'),1,0,'C',1);

$pdf->SetX(10);
$pdf->SetY(32);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Datos del Contribuyente'),1,0,'C',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(38);
$pdf->SetTextColor(0,0,0);
/*
$pdf->Cell(65, 7,'RIF: '.$rif.'',1,0,'L',0);
$pdf->Cell(65, 7, utf8_decode('Tramite: '.$tramite.''),1,0,'L',0);
$pdf->Cell(66, 7, utf8_decode('RFC: '.$rfc.''),1,0,'L',0);
*/

$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(65.33,65.33,65.33));
$pdf->Row(array('RIF: '.$rif.'','Recibo: 00000'.$referencia,'RFC: '.$rfc));


/*
$pdf->SetX(10);
$pdf->SetY(45);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Razon Social: '.$nombre.''),1,0,'L',0);
*/
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Razon Social: '.$nombre.'')));



$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10.5);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(196, 6, utf8_decode('Datos del Servicio de Aseo'),1,0,'C',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(54);
$pdf->SetTextColor(0,0,0);
/*
$pdf->Cell(65, 7,'RIF: '.$rif.'',1,0,'L',0);
$pdf->Cell(65, 7, utf8_decode('Tramite: '.$tramite.''),1,0,'L',0);
$pdf->Cell(66, 7, utf8_decode('RFC: '.$rfc.''),1,0,'L',0);
*/

$pdf->SetAligns(array('J','J'));
$pdf->SetWidths(array(98,98));
$pdf->Row(array('Tipo: '.$tiposerv.'','Numero Serv.: '.$rfc.'-'.$idserv));


/*
$pdf->SetX(10);
$pdf->SetY(45);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Razon Social: '.$nombre.''),1,0,'L',0);
*/
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Direccion: '.$dirser.'')));
$pdf->SetAligns(array('J','J','J','J'));
$pdf->SetWidths(array(49,49,49,49));
$pdf->Row(array('Sector: '.$sector.'','Calle: '.$calle.'', 'Edificio: '.$edificio.'',utf8_decode('Nº Edif.: '.$nedificio.'')));
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Tasa: '.$tipotax.' - '.$ramotax.' - '.$categoriatax.'')));

//-------------Datos Tramite
 //$pdf->Ln();
//$pdf->SetX(10);
//$pdf->SetY(51);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Monto por tramites para el Perdido: '.$period),1,0,'C',1);

$pdf->SetTextColor(0,0,0);
/*
$pdf->SetX(10);
$pdf->SetY(57);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(15, 7, utf8_decode('Codigo'),1,0,'C',0);
$pdf->Cell(111, 7, utf8_decode('Descricion Actividad'),1,0,'C',0);
$pdf->Cell(10, 7, utf8_decode('Alicuota'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Minimo Tributable'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Ingresos Brutos (Bs)'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Impuesto Mes'),1,0,'C',0);

*/
 $pdf->Ln();
 $pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','J','J','C'));
$pdf->SetWidths(array(15,131,20,30));
$pdf->Row(array(utf8_decode('Codigo'),utf8_decode('Descricion'), utf8_decode('Tramite'),utf8_decode('Impuesto Bs')));


$total=0;


while($row=$datos->fetch_assoc())
// ASIGNO MARGEN
{ 
  $total=$total+$row['totliq'];
 
 /* $pdf->SetFont('Arial','B',6);
  $pdf->SetFillColor(255,255,255);
  $pdf->Ln(7);
  $pdf->setX(10);
  $pdf->Cell(15, 7, utf8_decode($row['codigo_grupo']),1,0,'C',0);
  $pdf->Cell(111, 7, utf8_decode($row['detalles']),1,0,'C',0);
  $pdf->Cell(10, 7, utf8_decode($row['alicuota']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['minimo_tributable']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['income']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['tax']),1,0,'C',0);*/

$pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','J','J','C'));
$pdf->SetWidths(array(15,131,20,30));
$pdf->Row(array(utf8_decode($row['idt']),utf8_decode($row['detalle']),utf8_decode($row['tramite']),utf8_decode(number_format(($row['totliq']),2,',','.'))));

//$pdf->Ln();


   
}
/*$pdf->Ln(7);
$pdf->Cell(65, 7, utf8_decode('Total de ingresos: '.$total.''),1,0,'C',0);
$pdf->Cell(66, 7, utf8_decode('Total de impuestos: '.$taxt.''),1,0,'C',0);
$pdf->Cell(65, 7, utf8_decode('Total de retenciones: 0.00'),1,0,'C',0);*/

$pdf->SetAligns(array('J','C'));
$pdf->SetWidths(array(166,30));
$pdf->Row(array(utf8_decode('Total:'),utf8_decode(number_format(($total),2,',','.'))));





//$pdf->Ln();
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 7, utf8_decode('OBLIGACIONES TRIBUTARIAS'),1,0,'C',1);


$pdf->Ln(7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->setX(10);
$pdf->Cell(196, 7, utf8_decode('Periodo: '.$annomm.'                                                    Total impuesto a pagar: '.number_format(($total),2,',','.').''),1,0,'C',0);

$pdf->Output('D');
?>