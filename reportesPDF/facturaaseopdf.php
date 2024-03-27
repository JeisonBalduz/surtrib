<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');

$codigo = $_GET['codigo'];



$factura = "SELECT f.*,u.name as cajero FROM `facturaambiente` f left join users u ON f.useregistro=u.id WHERE f.id=$codigo ";
$moneda = "SELECT * FROM `currencies` WHERE id=2 ";

$link = $conexion;

if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$moneda)) {

while ($obj = mysqli_fetch_object($result)) {
    $valor=$obj->value;
  
  

    
 }
  mysqli_free_result($result);
}



if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$factura)) {

while ($obj = mysqli_fetch_object($result)) {
    $rif=$obj->rif;
    $nombre=$obj->nombre;
    $conceptopago1=$obj->conceptopago1;
    $monto1=$obj->monto1;
    $conceptopago2=$obj->conceptopago2;
    $monto2=$obj->monto2;
    $conceptopago3=$obj->conceptopago3;
    $monto3=$obj->monto3;
    $conceptopago4=$obj->conceptopago4;
    $monto4=$obj->monto4;
    $conceptopago5=$obj->conceptopago5;
    $monto5=$obj->monto5;
    $montototal=$obj->montotal;

    $direccion=$obj->direccion;
    
    $telefono=$obj->telefono;
    $correo=$obj->correo;
    $formapago=$obj->formapago;
  
    $correlativo=$obj->nfactura;
     $formapago=$obj->formapago;
     $fechapago=$obj->fechapago;
     $cajero=$obj->cajero;
  

    
 }
  mysqli_free_result($result);
}


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
$this->Image('img/logo.jpg',170,8,30);
$this->Image('img/logoa.jpg',12,9,30);
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
$this->Cell(0, 0, utf8_decode('Instituto Autonomo de Gestion Ambental'),0,0,'C');

$this->Ln(20);

}

function Footer()
{

     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(130);
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
$pdf->SetTopMargin(20);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


 //-------------Datos Contribuyente

$pdf->SetX(10);
$pdf->SetY(30);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 8, utf8_decode('Recibo de Pago Nº: '.$correlativo.'' ),1,0,'C',1);

$pdf->SetX(10);
$pdf->SetY(38);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Datos del Contribuyente'),1,0,'C',1);
/*$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(44);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49, 7, utf8_decode('N° Declaracion: '.$correlativo.''),1,0,'L',0);
$pdf->Cell(49, 7, utf8_decode('RFC: '.$rfc.''),1,0,'L',0);
$pdf->Cell(49, 7,'Licencia: '.$llicencia.'',1,0,'L',0);
$pdf->Cell(49, 7, utf8_decode('RIF: '.$rif.''),1,0,'L',0);
*/
$pdf->Ln();
 $pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','J','J','J'));
$pdf->SetWidths(array(49,147));
$pdf->Row(array(utf8_decode('RIF: '.$rif.''),'Nombre o Razon Social: '.$nombre.''));


$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Direccion: '.$direccion.'')));



//$pdf->Ln(10);

/*
$pdf->SetX(10);
$pdf->SetY(77);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(98, 7, utf8_decode('Telefono: 0'.$rtelefono.''),1,0,'L',0);
$pdf->Cell(98, 7, utf8_decode('Correo: '.$correo.''),1,0,'L',0);
*/
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',8);
$pdf->SetAligns(array('J','J'));
$pdf->SetWidths(array(98,98));
$pdf->Row(array(utf8_decode('Telefono: 0'.$telefono.''),utf8_decode('Correo: '.$correo.'')));

//-------------Datos Tramite

//$pdf->SetX(10);
//$pdf->SetY(84);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Conceptos'),1,0,'C',1);
$pdf->Ln();
/*
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Ingresos Brutos por Actividades Economicas')));
*/

/*
$pdf->SetTextColor(0,0,0);
$pdf->SetX(10);
$pdf->SetY(90);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(15, 7, utf8_decode('Codigo'),1,0,'C',0);
$pdf->Cell(111, 7, utf8_decode('Descricion Actividad'),1,0,'C',0);
$pdf->Cell(10, 7, utf8_decode('Alicuota'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Ingresos Brutos (Bs)'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Impuesto Mes'),1,0,'C',0);

*/

 
 $pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(130,33,33));
$pdf->Row(array(utf8_decode('Descricion'),utf8_decode('TCMMV (BCV)'),utf8_decode('Bolivares')));




//$pdf->SetFont('Arial','',6);
$pdf->SetTextColor(0,0,0);

if ($monto2==0.00) {
    $monto2='';
}

if ($monto3==0.00) {
    $monto3='';
}

if ($monto4==0.00) {
    $monto4='';
}

if ($monto5==0.00) {
    $monto5='';
}





$pdf->SetFont('Arial','B',8);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(130,33,33));
$pdf->Row(array(utf8_decode($conceptopago1),utf8_decode(number_format(($monto1/$valor),4,',','.')),utf8_decode($monto1)));

if ($conceptopago2=='') {
    
}
else {
$pdf->Row(array(utf8_decode($conceptopago2),utf8_decode(number_format(($monto2/$valor),4,',','.')),utf8_decode($monto2)));
}

if ($conceptopago3=='') {
    
}
else {
$pdf->Row(array(utf8_decode($conceptopago3),utf8_decode(number_format(($monto3/$valor),4,',','.')),utf8_decode($monto3)));
}

if ($conceptopago4=='') {
    
}
else {
$pdf->Row(array(utf8_decode($conceptopago4),utf8_decode(number_format(($monto4/$valor),4,',','.')),utf8_decode($monto4)));
}

if ($conceptopago5=='') {
    
}
else {
$pdf->Row(array(utf8_decode($conceptopago5),utf8_decode(number_format(($monto5/$valor),4,',','.')),utf8_decode($monto5)));
}


   
$pdf->SetX(140);
 $pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(33,33));
$pdf->Row(array(utf8_decode('Total TCMMV (BCV)'),utf8_decode('Total de Bolivares')));



/*
$pdf->Ln(7);
$pdf->Cell(136, 7, utf8_decode(''),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$ttotal.''),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$ftaxt.''),1,0,'C',0);
*/
$pdf->SetX(140);
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(33,33));
$pdf->Row(array(utf8_decode(''.number_format(($montototal/$valor),4,',','.').''),utf8_decode(''.$montototal.'')));


$pdf->Ln();
//$pdf->setX(10);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(65, 6, utf8_decode('Forma de Pago'),1,0,'C',1);
$pdf->Cell(65, 6, utf8_decode('Fecha de Pago'),1,0,'C',1);
$pdf->Cell(66, 6, utf8_decode('Cajero'),1,0,'C',1);

$pdf->Ln();
//$pdf->setX(10);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(65, 6, utf8_decode(''.$formapago.''),1,0,'C',1);
$pdf->Cell(65, 6, utf8_decode(''.$fechapago.''),1,0,'C',1);
$pdf->Cell(66, 6, utf8_decode(''.$cajero.''),1,0,'C',1);


$pdf->SetTextColor(0,0,0);





$pdf->Output('D');



?>