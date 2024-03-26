<?php 
session_start(); 
require_once "../modelos/Tasahacienda.php";

$tasahacienda=new Tasahacienda();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idt=isset($_POST["idt"])? limpiarCadena($_POST["idt"]):"";
$partida=isset($_POST["partida"])? limpiarCadena($_POST["partida"]):"";
$umt=isset($_POST["umt"])? limpiarCadena($_POST["umt"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";
$bactividad=isset($_POST["bactividad"])? limpiarCadena($_POST["bactividad"]):"";
$umt=isset($_POST["umt"])? limpiarCadena($_POST["umt"]):"";
$DECRETO=isset($_POST["DECRETO"])? limpiarCadena($_POST["DECRETO"]):"";
$descuento=isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$dias_valido=isset($_POST["dias_valido"])? limpiarCadena($_POST["dias_valido"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$tasahacienda->insertar($idt,$partida,$umt,$detalle,$observacion);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrarse";
		}
		else {
			$rspta=$tasahacienda->editar($id,$idt,$partida,$umt,$detalle,$observacion);
			echo $rspta ? "Tasa actualizada" : "Tasa no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$activeco->desactivar($id);
 		echo $rspta ? "Tasa desactivada" : "Tasa no se pudo desactivar";
	break;

	case 'eliminar':
		$rspta=$tasahacienda->eliminar($id);
 		echo $rspta ? "Tasa eliminada" : "Tasa no se pudo eliminar";
	break;

	case 'activar':
		$rspta=$activeco->activar($id);
 		echo $rspta ? "Tasa activada" : "Tasa no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$tasahacienda->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$tasahacienda->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button><button class="btn btn-danger" onclick="eliminar('.$reg->id.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->idt,
				"2"=>$reg->detalle,
				"3"=>$reg->umt,
				"4"=>$reg->partida,
				"5"=>$reg->observacion
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