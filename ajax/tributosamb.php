<?php 
session_start(); 
require_once "../modelos/Tributosamb.php";

$activeco=new Activeco();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idt=isset($_POST["idt"])? limpiarCadena($_POST["idt"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$alicuota=isset($_POST["alicuota"])? limpiarCadena($_POST["alicuota"]):"";
$umtmin=isset($_POST["umtmin"])? limpiarCadena($_POST["umtmin"]):"";
$umtmax=isset($_POST["umtmax"])? limpiarCadena($_POST["umtmax"]):"";
$partida=isset($_POST["partida"])? limpiarCadena($_POST["partida"]):"";
$umt=isset($_POST["umt"])? limpiarCadena($_POST["umt"]):"";
$DECRETO=isset($_POST["DECRETO"])? limpiarCadena($_POST["DECRETO"]):"";
$descuento=isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$dias_valido=isset($_POST["dias_valido"])? limpiarCadena($_POST["dias_valido"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$activeco->insertar($idt,$umtmin,$umtmax,$partida,$detalle);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrarse";
		}
		else {
			$rspta=$activeco->editar($id,$idt,$umtmin,$umtmax,$partida,$detalle);
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
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i>',
				"1"=>$reg->idt,
				"2"=>$reg->detalle,
				"3"=>$reg->partida,
				"4"=>$reg->umtmin,
				"5"=>$reg->umtmax,
				"6"=>$reg->unidadmed
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