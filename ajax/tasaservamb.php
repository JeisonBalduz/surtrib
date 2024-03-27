<?php 
session_start(); 
require_once "../modelos/Tasaservamb.php";

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


 			if ($reg->tipotribute==1){
				$condicion='<span class="badge bg-info">Comercial</span>';
			}
			else{
				$condicion='<span class="badge bg-info">Residencial</span>';
			}


 			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-edit"></i></button>',
				"1"=>$condicion,
				"2"=>$reg->tipotax,
				"3"=>$reg->ramotax,
				"4"=>$reg->categoriatax,
				"5"=>$reg->tax,
				"6"=>($reg->estado)?'<span class="badge bg-info">Activado</span>':'<span class="badge bg-danger">Desactivado</span>'
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