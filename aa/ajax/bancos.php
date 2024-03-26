<?php 
session_start(); 
require_once "../modelos/Bancos.php";

$bancos=new Bancos();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$status=isset($_POST["status"])? limpiarCadena($_POST["status"]):"";
$rif=isset($_POST["rif"])? limpiarCadena($_POST["rif"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$bancos->insertar($nombre,$status,$rif,$codigo);
			echo $rspta ? "Banco registrado" : "Banco no se pudo registrarse";
		}
		else {
			$rspta=$bancos->editar($id,$nombre,$status,$rif,$codigo);
			echo $rspta ? "Banco actualizado" : "Baqnco no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$bancos->desactivar($id);
 		echo $rspta ? "Banco desactivado" : "Banco no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$bancos->activar($id);
 		echo $rspta ? "Banco activado" : "Banco no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$bancos->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$bancos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>',
				"1"=>$reg->nombre,
				"2"=>$reg->rif,
				"3"=>$reg->codigo
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