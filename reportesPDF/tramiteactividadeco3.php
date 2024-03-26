<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');


$codigo = $_GET['codigo'];


$tramite = "SELECT u.rfc,u.name,u.rif,c.id,cc.id AS ccid,c.annomm,c.income,c.tax,c.deductible,cc.moment,cc.tramite,cc.rfc,a.detalles,a.codigo_grupo,a.minimo_tributable,a.alicuota FROM companyeib c LEFT JOIN companye cc ON c.idrelcompanye=cc.id LEFT JOIN activitiesenero2024 a ON c.idactivity=a.id LEFT JOIN users u ON cc.rfc=u.usuario WHERE cc.id='$codigo' ORDER BY c.annomm DESC";
$tramite2 = "SELECT u.rfc,u.name,u.rif,c.id,cc.id AS ccid,c.annomm,c.income,c.tax,c.deductible,cc.moment,cc.tramite,cc.rfc,a.detalles,a.codigo_grupo,a.minimo_tributable,a.alicuota FROM companyeib c LEFT JOIN companye cc ON c.idrelcompanye=cc.id LEFT JOIN activitiesenero2024 a ON c.idactivity=a.id LEFT JOIN users u ON cc.rfc=u.usuario WHERE cc.id='$codigo' ORDER BY c.annomm DESC";
$link = $conexion;


if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite)) {

while ($obj = mysqli_fetch_object($result)) {
    $rfc=$obj->rfc;
    $rif=$obj->rif;
    $nombre=$obj->name;
    $tramite=$obj->tramite;
    $annomm=$obj->annomm;
   
   
   
    
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
        $this->SetY(110);
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

$pdf->SetFont('Arial','B',7.5);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 8, utf8_decode('DECLARACION ESTIMADA DE IMPUESTO SOBRE ACTIVIDADES ECONOMICAS DE INDUCTRIA, COMERCIOS, SERVICIOS Y DE OTROS INDOLES'),1,0,'C',1);

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
$pdf->Cell(65, 7,'RIF: '.$rif.'',1,0,'L',0);
$pdf->Cell(65, 7, utf8_decode('Tramite: '.$tramite.''),1,0,'L',0);
$pdf->Cell(66, 7, utf8_decode('RFC: '.$rfc.''),1,0,'L',0);
$pdf->SetX(10);
$pdf->SetY(45);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Razon Social: '.$nombre.''),1,0,'L',0);



//-------------Datos Tramite

$pdf->SetX(10);
$pdf->SetY(51);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Ingresos Brutos por Actividades Economicas'),1,0,'C',1);

$pdf->SetTextColor(0,0,0);
$pdf->SetX(10);
$pdf->SetY(57);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(15, 7, utf8_decode('Codigo'),1,0,'C',0);
$pdf->Cell(111, 7, utf8_decode('Descricion Actividad'),1,0,'C',0);
$pdf->Cell(10, 7, utf8_decode('Alicuota'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Minimo Tributable'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Ingresos Brutos (Bs)'),1,0,'C',0);
$pdf->Cell(20, 7, utf8_decode('Impuesto Mes'),1,0,'C',0);
$total=0;
$taxt=0;

while($row=$datos->fetch_assoc())
// ASIGNO MARGEN
{ 
  $total=$total+$row['income'];
  $taxt=$taxt+$row['tax'];
  $pdf->SetFont('Arial','B',6);
  $pdf->SetFillColor(255,255,255);
  $pdf->Ln(7);
  $pdf->setX(10);
  $pdf->Cell(15, 7, utf8_decode($row['codigo_grupo']),1,0,'C',0);
  $pdf->Cell(111, 7, utf8_decode($row['detalles']),1,0,'C',0);
  $pdf->Cell(10, 7, utf8_decode($row['alicuota']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['minimo_tributable']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['income']),1,0,'C',0);
  $pdf->Cell(20, 7, utf8_decode($row['tax']),1,0,'C',0);


   
}
$pdf->Ln(7);
$pdf->Cell(65, 7, utf8_decode('Total de ingresos: '.$total.''),1,0,'C',0);
$pdf->Cell(66, 7, utf8_decode('Total de impuestos: '.$taxt.''),1,0,'C',0);
$pdf->Cell(65, 7, utf8_decode('Total de retenciones: 0.00'),1,0,'C',0);

$pdf->Ln(6);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 7, utf8_decode('OTRAS OBLIGACIONES TRIBUTARIAS'),1,0,'C',1);


$pdf->Ln(7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->setX(10);
$pdf->Cell(196, 7, utf8_decode('Periodo: '.$annomm.'                                                    Total impuesto a pagar: '.$taxt.''),1,0,'C',0);

$pdf->Output('D');
?>