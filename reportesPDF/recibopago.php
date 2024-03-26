<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');


$codigo = $_GET['codigo'];
$cadena = explode(",",$_REQUEST['codigo']);
$codigo = "'".implode("','",$cadena)."'";

$tramite = "SELECT u.name,u.rfc,u.rif,m.tramite,c.sector,c.calle,c.edificio,c.numeroedif FROM mayor m LEFT JOIN users u ON m.idrfc=u.rfc LEFT JOIN citizen c ON c.rfc=u.rfc WHERE m.tramite IN (".$codigo.") GROUP BY m.tramite limit 1";
$tramite2 = "SELECT m.id,m.idt,t.detalle,m.totliq,m.totpag,m.descuento,m.period FROM `mayor` m LEFT JOIN tributes t ON t.idt=m.idt WHERE `tramite` IN (".$codigo.") ";
$tramite3 = "SELECT SUM(`totpag`) AS calculo, SUM(`descuento`) AS caldescuento, SUM(`creditof`) AS calcredito, SUM(`totliq`) AS caltotliq FROM `mayor` WHERE tramite IN (".$codigo.")";
$link = $conexion;


if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite)) {

while ($obj = mysqli_fetch_object($result)) {
    $rfc=$obj->rfc;
    $rif=$obj->rif;
    $nombre=$obj->name;
    $tramite=$codigo;
    $d1=$obj->sector;
    $d2=$obj->calle;
    $d3=$obj->edificio;
    $d4=$obj->numeroedif;
   
    
 }
  mysqli_free_result($result);
}
if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite3)) {

while ($obj = mysqli_fetch_object($result)) {
    $calculo=$obj->calculo;
    $caldescuento=$obj->caldescuento;
    $calcredito=$obj->calcredito;
    $caltotliq=$obj->caltotliq;
   
   
   
   
    
 }
  mysqli_free_result($result);
}
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
$this->Image('img/escudo.png',10,9,11);
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
$this->Cell(0, 0, utf8_decode('Dirección de Hacienda Municipal'),0,0,'C');

$this->Ln(20);

}

function Footer()
{

     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(135);
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
$pdf->SetY(24);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 8, utf8_decode('PLANILLA DE LIQUIDACION Y PAGO DE LAS OBLIGACIONES TRIBUTARIAS'),1,0,'C',1);

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
$pdf->SetX(10);
$pdf->SetY(45);*/
$tramite=str_replace("'", "", $tramite);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(65.33,65.33,65.33));
$pdf->Row(array('RIF: '.$rif.'','Tramite: '.$tramite,'RFC: '.$rfc));

$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Razon Social: '.$nombre.'')));

$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Direccion: '.$d1.' '.$d2.' '.$d3.' '.$d4.'')));

/*
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Razon Social: '.$nombre.''),1,0,'L',0);
$pdf->SetX(10);
$pdf->SetY(52);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Direccion: '.$d1.' '.$d2.' '.$d3.' '.$d4.''),1,0,'L',0);
*/


//-------------Datos Tramite
/*
$pdf->SetX(10);
$pdf->SetY(58);*/
//$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('DETALLE TRAMITE'),1,0,'C',1);
/*
$pdf->SetTextColor(0,0,0);
$pdf->SetX(10);
$pdf->SetY(64);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(10, 7, utf8_decode('IDT'),1,0,'C',0);
$pdf->Cell(10, 7, utf8_decode('Perido'),1,0,'C',0);
$pdf->Cell(136, 7, utf8_decode('Descricion'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Impuesto Total'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Impuesto Pagado'),1,0,'C',0);

*/
 $pdf->Ln();
 $pdf->SetFont('Arial','B',6);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','J','J','J'));
$pdf->SetWidths(array(10,10,136,40));
$pdf->Row(array('IDT','Perido',utf8_decode('Descricion'),'Impuesto Total'));

$sumaliq=0;
$sumapagado=0;
$sumadesc=0;

while($row=$datos->fetch_assoc())
// ASIGNO MARGEN
{ 
  
 
  $sumaliq=$sumaliq+$row['totliq'];
  $sumapagado=$sumapagado+$row['totpag'];
  $sumadesc=$sumadesc+$row['descuento'];
  $calculop=$calculo-($calculo-$row['totliq']);


  $pdf->SetFont('Arial','B',6);
  /*$pdf->SetFillColor(255,255,255);
  $pdf->Ln(7);
  $pdf->setX(10);
  $pdf->Cell(10, 7, utf8_decode($row['idt']),1,0,'C',0);
  $pdf->Cell(10, 7, utf8_decode($row['period']),1,0,'C',0);
  $pdf->Cell(136, 7, utf8_decode($row['detalle']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode(number_format($row['totliq'],2,',','.')),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode(number_format($calculop,2,',','.')),1,0,'C',0);*/
 
$pdf->SetWidths(array(10,10,136,40));
$pdf->Row(array(utf8_decode($row['idt']),utf8_decode($row['period']),utf8_decode($row['detalle']),utf8_decode(number_format($row['totliq'],2,',','.'))));
//$pdf->Ln();
   
}

$sumadesc=number_format($sumadesc,2,',','.');
$sumaliq=number_format($sumaliq,2,',','.');
/*
$pdf->Ln(7);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(49, 7, utf8_decode('Recargo: 0,00'),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Intereses de mora: 0,00'),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Descuento: '.$sumadesc.''),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Total a pagar: '.$sumaliq.''),1,0,'C',0);

*/
//$pdf->Ln();
$pdf->SetAligns(array('J','J','J','J'));
$pdf->SetWidths(array(49,49,49,49));
$pdf->Row(array(utf8_decode('Recargo: 0,00'), utf8_decode('Intereses de mora: 0,00'),utf8_decode('Descuento: '.$sumadesc.''),utf8_decode('Total a pagar: '.$sumaliq.'')));


$pendiente=$caltotliq-$calculo;

//$pdf->Ln();
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('DETALLE DE PAGOS REALIZADOS'),1,0,'C',1);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
/*
$pdf->Cell(49, 7, utf8_decode('Total Cancelado: '.number_format($calculo,2,',','.').''),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Descuento Aplicado: '.number_format($caldescuento,2,',','.').' '),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Cred Fisc/Desc: '.number_format($calcredito,2,',','.').''),1,0,'C',0);
$pdf->Cell(49, 7, utf8_decode('Monto Pend: '.number_format($pendiente,2,',','.').''),1,0,'C',0);
*/

$pdf->SetAligns(array('J','J','J','J'));
$pdf->SetWidths(array(49,49,49,49));
$pdf->Row(array(utf8_decode('Total Cancelado: '.number_format($calculo,2,',','.').''), utf8_decode('Descuento Aplicado: '.number_format($caldescuento,2,',','.').' '),utf8_decode('Cred Fisc/Desc: '.number_format($calcredito,2,',','.').''),utf8_decode('Monto Pend: '.number_format($pendiente,2,',','.').'')));



$pdf->Ln();
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 7, utf8_decode('VALIDACION POR OFICINA'),1,0,'C',1);


$pdf->Ln();
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',6);
$pdf->setX(10);

$pdf->Cell(66, 20, utf8_decode('Solo a solicitud de parte interesada - No es obligatorio'),1,0,'C',0);
$pdf->Cell(65, 20, utf8_decode('FUNCIONARIO RECEPTOR: '),1,0,'C',0);
$pdf->Cell(65, 20, utf8_decode('SELLO:'),1,0,'C',0);
$pdf->Ln(20);


$pdf->SetFillColor(230);



$pdf->Output('D');
?>