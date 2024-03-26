<?php 
session_start(); 
require_once "../modelos/Conciliarpago.php";

$concipago=new Concipago();

$idusuario=$_SESSION['idusuario'];
$idpagoamb=isset($_POST["idpagoamb"])? limpiarCadena($_POST["idpagoamb"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$referencia=isset($_POST["referencia"])? limpiarCadena($_POST["referencia"]):"";
$fechapago=isset($_POST["fechapago"])? limpiarCadena($_POST["fechapago"]):"";
$registro=isset($_POST["registro"])? limpiarCadena($_POST["registro"]):"";
$idusuariosis=isset($_POST["idusuariosis"])? limpiarCadena($_POST["idusuariosis"]):"";
$idbanco=isset($_POST["idbanco"])? limpiarCadena($_POST["idbanco"]):"";
$fechaaprobacion=isset($_POST["fechaaprobacion"])? limpiarCadena($_POST["fechaaprobacion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$idconciliacion=isset($_POST["idconciliacion"])? limpiarCadena($_POST["idconciliacion"]):"";

$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";
$comodinbusqueda2=isset($_POST["comodinbusqueda2"])? limpiarCadena($_POST["comodinbusqueda2"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
        
		if (empty($id)){
			$rspta=$concipago->insertar($idconciliacion,$rfc,$idusuario,$_POST['idcpdv']);
			echo $rspta ? "Pago registrado" : "Pago no se pudo registrarse";
		}
		else {
			$rspta=$concipago->editar($idpagoamb,$monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen);
			echo $rspta ? "Pago actualizado" : "Pago no se pudo actualizarse";
		}
	break;

	case 'conciliar2':
		$rspta=$veripago->conciliar($id);
 		echo $rspta ? "Pago conciliado" : "El pago no pudo ser conciliado";
	break;

	case 'activar':
		$rspta=$pagoamb->activar($idpagoamb);
 		echo $rspta ? "Pago confirmado" : "El pago no puedo confirmarse";
	break;
        
	case 'conciliar':
		$rspta=$veripago->conciliar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrar':
		$rspta=$concipago->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostarvfile':
		$rspta=$veripago->mostarvfile($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

	
		$rspta=$concipago->listar();
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="mostrar('.$reg->id.')">Conciliar</button>',
 				"1"=>$reg->fechad,
				 "2"=>$reg->refencia,
 				"3"=>$reg->amount,
				"4"=>$reg->details,
				"5"=>$reg->saldo,
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //InformaciÃ³n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	
    

	break;

   case 'listarporfecha':

	
		$rspta=$concipago->listarporfecha($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="mostrar('.$reg->id.')">Conciliar</button>',
 				"1"=>$reg->fechad,
				 "2"=>$reg->refencia,
 				"3"=>$reg->amount,
				"4"=>$reg->details,
				"5"=>$reg->saldo
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Informaci¨®n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
    
	break;

	case 'tramitescontri':

	
		$rspta=$concipago->tramitescontri($rfc);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
			$data[]=[
				"0"=>$reg->id,
				"1"=>$reg->fechaliq,
				"2"=>$reg->rfc,
				"3"=>$reg->name,
			   "4"=>$reg->detalle,
			   "5"=>$reg->ctramite,
			   "6"=>$reg->mount,
			   "7"=>$reg->ref,
			   "8"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#capture" onclick="mostarvfile('.$reg->id.')">Capture</button>',
				];

		}
 		$results = array(
 			"sEcho"=>1, //InformaciÃ³n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	
    

	break;

	case 'tramiteporpagar':
		$rspta = $concipago->tramiteporpagar($rfc);
		while ($reg = $rspta->fetch_object())
        {
            echo '	<tr id="det">
						<td>' . $reg->fecha. '</td>
						<td>' . $reg->tramite. '</td>
						<td>' . $reg->detalle. '</td>
						<td>' . $reg->totliq. '</td>
						<td id="monto">' . $reg->mount. '</td>
						<td>' . $reg->totpag. '</td>
						<td><input type="checkbox" id="check" name="idcpdv[]" value="'.$reg->idcpdv.'"></td>
						
		  			</tr>';
        }
	break;

}
?>