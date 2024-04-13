<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');

$codigo = $_GET['codigo'];
$codigo2 = $_GET['codigo2'];
$representante = $_GET['representante'];
$rcedula = $_GET['rcedula'];
$rtelefono = $_GET['rtelefono'];
$correlativo = $_GET['correlativo'];



$tramite = "SELECT * FROM users u LEFT JOIN definitiva d ON u.rfc=d.rfc LEFT JOIN citizen c ON c.rfc=u.rfc WHERE u.rfc='$codigo2'";
$tramite2 = "SELECT a.codigo_grupo,a.detalles,a.alicuota,ROUND((SUM(c.income)),2) AS tbruto,ROUND((SUM(c.tax)),2) AS ttax FROM companyeib c LEFT JOIN 
companye cc ON c.idrelcompanye =cc.id LEFT JOIN activities2023 a ON c.idactivity=a.id LEFT JOIN users u ON u.rfc=cc.rfc LEFT JOIN mayor m ON m.tramite=cc.tramite
 WHERE cc.rfc='$codigo2' AND CONVERT(`annomm` USING utf8) LIKE '%2023%' GROUP BY a.codigo_grupo";
$tramite3 = "SELECT ROUND((SUM(c.income)),2) AS brutonopagado,ROUND((SUM(c.tax)),2) AS taxnopagado FROM companyeib c LEFT JOIN companye cc ON c.idrelcompanye =cc.id LEFT JOIN 
activities a ON c.idactivity=a.id LEFT JOIN users u ON u.rfc=cc.rfc LEFT JOIN mayor m ON m.tramite=cc.tramite WHERE cc.rfc='$codigo2' 
AND CONVERT(`annomm` USING utf8) LIKE '%2023%' AND m.mcondition='L'";
$link = $conexion;

$definitiva = "SELECT u.rfc,u.name,u.rif,SUM(ROUND(c.income,2)) AS ibruto,SUM(ROUND(c.tax,2)) as tax,a.codigo_grupo,a.detalles,a.alicuota FROM companyeib c LEFT JOIN companye cc ON c.idrelcompanye =cc.id LEFT JOIN activities a ON c.idactivity=a.id LEFT JOIN users u ON u.rfc=cc.rfc WHERE cc.rfc='$codigo2' AND CONVERT(`annomm` USING utf8) LIKE '%2023%' GROUP BY a.codigo_grupo";


if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite)) {

while ($obj = mysqli_fetch_object($result)) {
    $rfc=$obj->rfc;
    $rif=$obj->rif;
    $nombre=$obj->name;
    $llicencia=$obj->licencia;
    $direccion=$obj->sector;
    $direccion2=$obj->calle;
    $direccion3=$obj->edificio;
    $direccion4=$obj->numeroedif;
    $telefono=$obj->celular;
    $cedula=$obj->cedularif;
    $tipocedula=$obj->tiponac;
    $correo=$obj->correo;
    $nacionalidad=$obj->nacionalidad;

    
 }
  mysqli_free_result($result);
}

if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite3)) {

while ($obj2 = mysqli_fetch_object($result)) {
    $brutonpagado=$obj2->brutonopagado;
    $taxnpagado=$obj2->taxnopagado;
  

    
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
        $this->SetY(260);
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
$pdf->Cell(196, 8, utf8_decode('DECLARACION DEFINITIVA DE IMPUESTOS BRUTOS'),1,0,'C',1);

$pdf->SetX(10);
$pdf->SetY(38);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Datos del Contribuyente'),1,0,'C',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(44);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49, 7, utf8_decode('N° Declaracion: '.$correlativo.''),1,0,'L',0);
$pdf->Cell(49, 7, utf8_decode('RFC: '.$rfc.''),1,0,'L',0);
$pdf->Cell(49, 7,'Licencia: '.$llicencia.'',1,0,'L',0);
$pdf->Cell(49, 7, utf8_decode('RIF: '.$rif.''),1,0,'L',0);
$pdf->SetX(10);
$pdf->SetY(51);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 7, utf8_decode('Razon Social: '.$nombre.''),1,0,'L',0);
$pdf->SetX(10);
$pdf->SetY(58);
$pdf->Cell(196, 7, utf8_decode('Direccion: '.$direccion.' '.$direccion2.' '.$direccion3.' '.$direccion4.''),1,0,'L',0);

$pdf->SetX(10);
$pdf->SetY(64);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Datos del Representante Legal'),1,0,'C',1);

$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(70);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(147, 7, utf8_decode('Representante Legal:'.$representante.''),1,0,'L',0);
$pdf->Cell(49, 7, utf8_decode('Cedula: '.$nacionalidad.$rcedula.''),1,0,'L',0);
$pdf->SetX(10);
$pdf->SetY(77);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(98, 7, utf8_decode('Telefono: 0'.$rtelefono.''),1,0,'L',0);
$pdf->Cell(98, 7, utf8_decode('Correo: '.$correo.''),1,0,'L',0);



//-------------Datos Tramite

$pdf->SetX(10);
$pdf->SetY(84);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Ingresos Brutos por Actividades Economicas'),1,0,'C',1);

$pdf->SetTextColor(0,0,0);
$pdf->SetX(10);
$pdf->SetY(90);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(15, 7, utf8_decode('Codigo'),1,0,'C',0);
$pdf->Cell(111, 7, utf8_decode('Descricion Actividad'),1,0,'C',0);
$pdf->Cell(10, 7, utf8_decode('Alicuota'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Ingresos Brutos (Bs)'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Impuesto Mes'),1,0,'C',0);
$total=0;
$taxt=0;

while($row=$datos->fetch_assoc())
// ASIGNO MARGEN
{ 
 
  $total=$total+$row['tbruto'];
  $taxt=$taxt+$row['ttax'];
  $pdf->SetFont('Arial','B',5);
  $pdf->SetFillColor(255,255,255);
  $pdf->Ln(7);
  $pdf->setX(10);
  $pdf->Cell(15, 7, utf8_decode($row['codigo_grupo']),1,0,'C',0);
  $pdf->Cell(111, 7, utf8_decode($row['detalles']),1,0,'C',0);
  $pdf->Cell(10, 7, utf8_decode($row['alicuota']),1,0,'C',0);
  $pdf->Cell(30, 7, utf8_decode($row['tbruto']),1,0,'C',0);
  $pdf->Cell(30, 7, utf8_decode($row['ttax']),1,0,'C',0);


   
}
$pdf->SetFont('Arial','B',7);
$ftaxt=number_format($taxt,2,',','.');
$ttotal=number_format($total,2,',','.');
$tcodigo=number_format($codigo,2,',','.');
$pdf->Ln(7);
$pdf->Cell(136, 7, utf8_decode(''),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Total de ingresos'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode('Total de impuestos'),1,0,'C',0);



$pdf->Ln(7);
$pdf->Cell(136, 7, utf8_decode(''),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$ttotal.''),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$ftaxt.''),1,0,'C',0);


$pdf->Ln(7);
$pdf->setX(10);
$pdf->Cell(166, 7, utf8_decode('Total Ingreso Bruto en Declaraciones Anticipadas'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$tcodigo.''),1,0,'C',0);
$diferencia=$total-$codigo;
$tdiferencia=number_format($diferencia,2,',','.');
$pdf->Ln(7);
$pdf->setX(10);
$pdf->Cell(166, 7, utf8_decode('Total Ingreso No Declarados o No Pagados por Compensar'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$tdiferencia.''),1,0,'C',0);
$pdf->Ln(7);

$ttaxnpagado=number_format($taxnpagado,2,',','.');
$pdf->setX(10);
$pdf->Cell(166, 7, utf8_decode('Total Impuestos Declarados No Pagados'),1,0,'C',0);
$pdf->Cell(30, 7, utf8_decode(''.$ttaxnpagado.''),1,0,'C',0);

$pdf->Ln(7);
$pdf->setX(10);
$pdf->SetFillColor(25,132,151);
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(98, 6, utf8_decode('NOMBRE Y APELLIDO'),1,0,'C',1);
$pdf->Cell(49, 6, utf8_decode('FIRMA DEL CONTRIBUYENTE'),1,0,'C',1);
$pdf->Cell(49, 6, utf8_decode('FIRMA DEL FUNCIONARIO'),1,0,'C',1);

$pdf->Ln(6);
$pdf->setX(10);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(98, 20, utf8_decode(''),1,0,'C',1);
$pdf->Cell(49, 20, utf8_decode(''),1,0,'C',1);
$pdf->Cell(49, 20, utf8_decode(''),1,0,'C',1);

$pdf->Output('');
?>