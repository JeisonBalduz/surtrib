<?php 
session_start(); 
require_once "../modelos/Concepto.php";

$concepto=new Concepto();

//$imagen=$_SESSION['imagen'];
$nombre=$_SESSION['nombre'];
$idusuario=$_SESSION['idusuario'];
$codigoubch=isset($_POST["codigoubch"])? limpiarCadena($_POST["codigoubch"]):"";
$nombreubch=isset($_POST["nombreubch"])? limpiarCadena($_POST["nombreubch"]):"";
$idestado=isset($_POST["idestado"])? limpiarCadena($_POST["idestado"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$idmunicipio=isset($_POST["idmunicipio"])? limpiarCadena($_POST["idmunicipio"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$ideje=isset($_POST["ideje"])? limpiarCadena($_POST["ideje"]):"";
$eje=isset($_POST["eje"])? limpiarCadena($_POST["eje"]):"";
$idparroquia=isset($_POST["idparroquia"])? limpiarCadena($_POST["idparroquia"]):"";
$parroquia=isset($_POST["parroquia"])? limpiarCadena($_POST["parroquia"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$mesas=isset($_POST["mesas"])? limpiarCadena($_POST["mesas"]):"";
$electores=isset($_POST["electores"])? limpiarCadena($_POST["electores"]):"";
$nacionalidadjubch=isset($_POST["nacionalidadjubch"])? limpiarCadena($_POST["nacionalidadjubch"]):"";
$cedulajubch=isset($_POST["cedulajubch"])? limpiarCadena($_POST["cedulajubch"]):"";
$nombrejubch=isset($_POST["nombrejubch"])? limpiarCadena($_POST["nombrejubch"]):"";
$apellidojubch=isset($_POST["apellidojubch"])? limpiarCadena($_POST["apellidojubch"]):"";
$operadora1=isset($_POST["operadora1"])? limpiarCadena($_POST["operadora1"]):"";
$telefono1=isset($_POST["telefono1"])? limpiarCadena($_POST["telefono1"]):"";
$operadora2=isset($_POST["operadora2"])? limpiarCadena($_POST["operadora2"]):"";
$telefono2=isset($_POST["telefono2"])? limpiarCadena($_POST["telefono2"]):"";
$correoelectronico=isset($_POST["correoelectronico"])? limpiarCadena($_POST["correoelectronico"]):"";
$direccionjubch=isset($_POST["direccionjubch"])? limpiarCadena($_POST["direccionjubch"]):"";
$sindicato=isset($_POST["sindicato"])? limpiarCadena($_POST["sindicato"]):"";
$ctp=isset($_POST["ctp"])? limpiarCadena($_POST["ctp"]):"";
$prevencion=isset($_POST["prevencion"])? limpiarCadena($_POST["prevencion"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";


switch ($_GET["op"]){
           
	case 'mostrar':
		$rspta=$concepto->mostrar($codigoubch);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$concepto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->municipio,
 				"1"=>$reg->parroquia,
			    "2"=>$reg->eje,
 				"3"=>$reg->electores,
 				"4"=>$reg->ubch,
 			
 				
 				);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'mostrarMoneda':
		$rspta = $concepto->mostrarMoneda();

		// Codificar la respuesta en JSON
		echo json_encode($rspta);
	break;
	

}
?>