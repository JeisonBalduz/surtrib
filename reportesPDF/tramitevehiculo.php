<?php
require('fpdf/fpdf.php');
include("../config/Conexion.php");
date_default_timezone_set('America/Caracas');


$codigo = $_GET['codigo'];


$tramite = "SELECT g.hashkey AS tramite,u.rif AS rif,u.name AS nombre,v.licenseplate AS placa, v.marca AS marca,v.modelos 
AS modelo,v.puestos AS puesto,v.pesos AS peso,v.anio AS anio,t.detalle,v.rfc FROM gaugingvehicle g INNER JOIN vehicle v ON g.idrelvehicle=v.id 
INNER JOIN users u ON g.iduser=u.id INNER JOIN tributes t ON t.idt=v.idtvehiculo WHERE g.hashkey='$codigo'";

$link = $conexion;


if (mysqli_connect_errno()) {
}

 if ($result = mysqli_query($link,$tramite)) {

while ($obj = mysqli_fetch_object($result)) {
    $tramite=$obj->tramite;
    $nombre=$obj->nombre;
    $placa=$obj->placa;
    $marca=$obj->marca;
    $modelo=$obj->modelo;
    $puesto=$obj->puesto;
    $peso=$obj->peso;
    $anio=$obj->anio;
    $detalle=$obj->detalle;
    $rif=$obj->rif;
    $rfc=$obj->rfc;
    
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
        $this->SetY(85);
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
$pdf->Cell(196, 8, utf8_decode('FICHA TRIBUTARIA DE VEHICULOS TRAMITE N°: '.$tramite.''),1,0,'C',1);

$pdf->SetX(10);
$pdf->SetY(32);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Datos del Contribuyente'),1,0,'C',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
/*$pdf->SetFont('Arial','B',8);
$pdf->SetX(10);
$pdf->SetY(38);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40, 7,'RIF: '.$rif.'',1,0,'L',0);
$pdf->Cell(156, 7, utf8_decode('Razon Social: '.$nombre.' '),1,0,'L',0);
*/
$pdf->SetTextColor(0,0,0);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(40,40,116));
$pdf->Row(array('RIF: '.$rif,'RUC: '.$rfc,utf8_decode('Razon Social: '.$nombre.' ')));






//-------------Datos Tramite

//$pdf->SetX(10);
//$pdf->SetY(45);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(196, 6, utf8_decode('Informacion del Vehiculo '),1,0,'C',1);

/*
$pdf->SetX(10);
$pdf->SetY(51);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(196, 9,'Placa: '.$placa.' ',1,0,'C',0);
*/
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',12);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(196));
$pdf->Row(array('Placa: '.$placa));




/*

$pdf->SetX(10);
$pdf->SetY(60);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(98, 7, utf8_decode('Marca: '.$marca.' '),1,0,'L',0);
$pdf->Cell(98, 7, utf8_decode('Modelo: '.$modelo.''),1,0,'L',0);
*/
$pdf->SetFont('Arial','B',8);
$pdf->SetAligns(array('J','J'));
$pdf->SetWidths(array(98,98));
$pdf->Row(array(utf8_decode('Marca: '.$marca.' '),utf8_decode('Modelo: '.$modelo.'')));




/*

$pdf->SetX(10);
$pdf->SetY(67);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(65, 7, utf8_decode('N° Puestos: '.$puesto.''),1,0,'L',0);
$pdf->Cell(65, 7, utf8_decode('Peso: '.$peso.' '),1,0,'L',0);
$pdf->Cell(66, 7, utf8_decode('Año: '.$anio.' '),1,0,'L',0);
*/
$pdf->SetFont('Arial','B',8);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(65.333333333,65.333333333,65.333333333));
$pdf->Row(array(utf8_decode('N° Puestos: '.$puesto.''),utf8_decode('Peso: '.$peso.' '),utf8_decode('Año: '.$anio.' ')));


/*
$pdf->SetX(10);
$pdf->SetY(74);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(196, 7, utf8_decode('Tasa: '.$detalle.''),1,0,'L',0);

*/


$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(196));
$pdf->Row(array(utf8_decode('Tasa: '.$detalle.'')));






$pdf->SetFont('Arial','',10);

for ($i = 0; $i <0 ; $i++) {

  $pdf->SetX(15);//posicionamos en x

  //-------------INTERCALAMOS COLOR LOS PARES DE UN COLOR Y LOS QUE NO DE OTRO

if($i%2==0){
$pdf->SetFillColor(232, 232, 232 );
$pdf->SetDrawColor(65, 61, 61);
}else{
$pdf->SetFillColor(255, 255, 255 );
$pdf->SetDrawColor(65, 61, 61);
}
//--------------------------------TERMINAMOS DE PINTAR----------------------------

//                          DATOS
$pdf->Cell(12, 8, $i+1,'B',0,'C',1);
$pdf->Cell(80, 8, utf8_decode('Titan Colosal'),'B',0,'C',1);
$pdf->Cell(30, 8, utf8_decode('$20.50'),'B',0,'C',1);
$pdf->Cell(30, 8, utf8_decode('4'),'B',0,'C',1);
$pdf->Cell(30, 8, utf8_decode('$82.00'),'B',1,'C',1);
$pdf->Ln(0.5);

}

$pdf->Output('D');
?>