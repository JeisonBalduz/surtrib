<?php 
session_start(); 
require_once "../modelos/Activeco.php";

$activeco=new Activeco();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$codigo_grupo=isset($_POST["codigo_grupo"])? limpiarCadena($_POST["codigo_grupo"]):"";
$detalles=isset($_POST["detalles"])? limpiarCadena($_POST["detalles"]):"";
$alicuota=isset($_POST["alicuota"])? limpiarCadena($_POST["alicuota"]):"";
$minimo_tributable=isset($_POST["minimo_tributable"])? limpiarCadena($_POST["minimo_tributable"]):"";
$minimo_tributable_ptr=isset($_POST["minimo_tributable_ptr"])? limpiarCadena($_POST["minimo_tributable_ptr"]):"";
$bactividad=isset($_POST["bactividad"])? limpiarCadena($_POST["bactividad"]):"";
$umt=isset($_POST["umt"])? limpiarCadena($_POST["umt"]):"";
$DECRETO=isset($_POST["DECRETO"])? limpiarCadena($_POST["DECRETO"]):"";
$descuento=isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$dias_valido=isset($_POST["dias_valido"])? limpiarCadena($_POST["dias_valido"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$activeco->insertar($codigo_grupo,$detalles,$alicuota,$umt,$DECRETO);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrarse";
		}
		else {
			$rspta=$activeco->editar($id,$codigo_grupo,$detalles,$alicuota,$umt,$DECRETO);
			echo $rspta ? "Tasa actualizada" : "Tasa no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$activeco->desactivar($id);
 		echo $rspta ? "Tasa desactivada" : "Tasa no se pudo desactivar";
	break;

	case 'eliminar':
		$rspta=$activeco->eliminar($id);
 		echo $rspta ? "Tasa eliminada" : "Tasa no se pudo eliminar";
	break;

	case 'activar':
		$rspta=$activeco->activar($id);
 		echo $rspta ? "Tasa activada" : "Tasa no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$activeco->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$activeco->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button><button class="btn btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->codigo_grupo,
				"2"=>$reg->detalles,
				"3"=>$reg->alicuota,
				"4"=>$reg->umt,
				"5"=>$reg->DECRETO
				//"8"=>($reg->estado)?'<span class="badge bg-primary">Activado</span>':'<span class="badge bg-danger">Desactivado</span>'
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