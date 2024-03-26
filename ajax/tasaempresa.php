<?php 
session_start(); 
require_once "../modelos/Tasaempresa.php";

$taxempresa=new Taxempresa();

$idtaxempamb=isset($_POST["idtaxempamb"])? limpiarCadena($_POST["idtaxempamb"]):"";
$idtipotax=isset($_POST["idtipotax"])? limpiarCadena($_POST["idtipotax"]):"";
$idramotax=isset($_POST["idramotax"])? limpiarCadena($_POST["idramotax"]):"";
$idcategoriatax=isset($_POST["idcategoriatax"])? limpiarCadena($_POST["idcategoriatax"]):"";
$tipotax=isset($_POST["tipotax"])? limpiarCadena($_POST["tipotax"]):"";
$ramotax=isset($_POST["ramotax"])? limpiarCadena($_POST["ramotax"]):"";
$categoriatax=isset($_POST["categoriatax"])? limpiarCadena($_POST["categoriatax"]):"";
$tax=isset($_POST["tax"])? limpiarCadena($_POST["tax"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($idtaxempamb)){
			$rspta=$taxempresa->insertar($idtipotax,$idramotax,$idcategoriatax,$tipotax,$ramotax,$categoriatax,$tax);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrarse";
		}
		else {
			$rspta=$taxempresa->editar($idtaxempamb,$idtipotax,$idramotax,$idcategoriatax,$tipotax,$ramotax,$categoriatax,$tax);
			echo $rspta ? "Tasa actualizada" : "Tasa no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$taxempresa->desactivar($idtaxempamb);
 		echo $rspta ? "Tasa desactivada" : "Tasa no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$taxempresa->activar($idtaxempamb);
 		echo $rspta ? "Tasa activada" : "Tasa no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$taxempresa->mostrar($idtaxempamb);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$taxempresa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->idtaxempamb.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idtaxempamb.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->idtaxempamb.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idtaxempamb.')"><i class="fa fa-edit"></i></button>',
				"1"=>$reg->tipotax,
				"2"=>$reg->ramotax,
				"3"=>$reg->categoriatax,
				"4"=>$reg->tax,
				"5"=>($reg->estado)?'<span class="badge bg-primary">Activado</span>':'<span class="badge bg-danger">Desactivado</span>'
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