<?php 
session_start(); 
require_once "../modelos/Tasaresidencias.php";

$taxresidencia=new Taxresidencia();

$idtaxresidencia=isset($_POST["idtaxresidencia"])? limpiarCadena($_POST["idtaxresidencia"]):"";
$idtzona=isset($_POST["idtzona"])? limpiarCadena($_POST["idtzona"]):"";
$idzona=isset($_POST["idzona"])? limpiarCadena($_POST["idzona"]):"";
$tzona=isset($_POST["tzona"])? limpiarCadena($_POST["tzona"]):"";
$zona=isset($_POST["zona"])? limpiarCadena($_POST["zona"]):"";
$tasazona=isset($_POST["tasazona"])? limpiarCadena($_POST["tasazona"]):"";




switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($idtaxresidencia)){
			$rspta=$taxresidencia->insertar($idtzona,$idzona,$tzona,$zona,$tasazona);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrarse";
		}
		else {
			$rspta=$taxresidencia->editar($idtaxresidencia,$idtzona,$idzona,$tzona,$zona,$tasazona);
			echo $rspta ? "Tasa actualizada" : "Tasa no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$taxresidencia->desactivar($idtaxresidencia);
 		echo $rspta ? "Tasa desactivada" : "Tasa no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$taxresidencia->activar($idtaxresidencia);
 		echo $rspta ? "Tasa activada" : "Tasa no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$taxresidencia->mostrar($idtaxresidencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$taxresidencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->idtaxresidencia.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idtaxresidencia.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->idtaxresidencia.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idtaxresidencia.')"><i class="fa fa-edit"></i></button>',
				"1"=>$reg->tzona,
				"2"=>$reg->zona,
				"3"=>$reg->tasazona,
				"4"=>($reg->estado)?'<span class="badge bg-primary">Activado</span>':'<span class="badge bg-danger">Desactivado</span>'
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