<?php 
session_start(); 
require_once "../modelos/Moneda.php";

$moneda=new Moneda();
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idmoneda=isset($_POST["idmoneda"])? limpiarCadena($_POST["idmoneda"]):"";
$nombremoneda=isset($_POST["nombremoneda"])? limpiarCadena($_POST["nombremoneda"]):"";
$codigomoneda=isset($_POST["codigomoneda"])? limpiarCadena($_POST["codigomoneda"]):"";
$symbol_left=isset($_POST["symbol_left"])? limpiarCadena($_POST["symbol_left"]):"";
$symbol_right=isset($_POST["symbol_right"])? limpiarCadena($_POST["symbol_right"]):"";
$decimal_point=isset($_POST["decimal_point"])? limpiarCadena($_POST["decimal_point"]):"";
$thousands_point=isset($_POST["thousands_point"])? limpiarCadena($_POST["thousands_point"]):"";
$decimal_places=isset($_POST["decimal_places"])? limpiarCadena($_POST["decimal_places"]):"";
$value=isset($_POST["value"])? limpiarCadena($_POST["value"]):"";
$mcref=isset($_POST["mcref"])? limpiarCadena($_POST["mcref"]):"";
$principal=isset($_POST["principal"])? limpiarCadena($_POST["principal"]):"";
$last_updated=isset($_POST["last_updated"])? limpiarCadena($_POST["last_updated"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($idmoneda)){
			$rspta=$moneda->insertar($nombremoneda,$codigomoneda,$symbol_left,$symbol_right,$decimal_point,$thousands_point,$decimal_places,$value,$mcref,$principal,$last_updated);
			echo $rspta ? "Moneda registrada" : "Moneda no se pudo registrarse";
		}
		else {
			$rspta=$moneda->editar($idmoneda,$value);
			echo $rspta ? "Moneda actualizada" : "Moneda no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$moneda->desactivar($idmoneda);
 		echo $rspta ? "Moneda desactivada" : "Moneda no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$moneda->activar($idmoneda);
 		echo $rspta ? "Moneda activada" : "Moneda no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$moneda->mostrar($idmoneda);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$moneda->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>',
				"1"=>$reg->title,
				"2"=>$reg->code,
				"3"=>$reg->value,
				"4"=>$reg->mcref,
				"5"=>$reg->code
			);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

}
?>