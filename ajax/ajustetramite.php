<?php 
session_start(); 
require_once "../modelos/Ajustetramite.php";

$ajuste=new Ajuste();

$rfc=$_SESSION['rfc'];
$iduser=$_SESSION['idusuario'];
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idv=isset($_POST["idv"])? limpiarCadena($_POST["idv"]):"";
$tramite=isset($_POST["tramite"])? limpiarCadena($_POST["tramite"]):"";
$period=isset($_POST["period"])? limpiarCadena($_POST["period"]):"";
$totliq=isset($_POST["totliq"])? limpiarCadena($_POST["totliq"]):"";
$deferred=isset($_POST["deferred"])? limpiarCadena($_POST["deferred"]):"";
$totpag=isset($_POST["totpag"])? limpiarCadena($_POST["totpag"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$ajuste->insertar($rfc,$period,$totliq,$deferred,$deferred);
			echo $rspta ? "Actividad Economica registrada" : "Actividad Economica no pudo registrarse";
		}
		else {
			$rspta=$ajuste->editar($id,$period,$totliq,$deferred,$totpag);
			echo $rspta ? "Tramite actualizado" : "Tramite no se pudo actualizar";
		}
	break;

	


	case 'mostrar':
		$rspta=$ajuste->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	
	case 'listar':

		$rspta=$ajuste->listar($tramite);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

           if ($reg->mcondition=='L'){
				$condicion='Liquidado';
			}
			else if($reg->mcondition=='D'){
				$condicion='Diferido';
			}
			else if($reg->mcondition=='C'){
				$condicion='Consolidado';
			}
			else if($reg->mcondition=='X'){
				$condicion='Anulado';
			}
				else if($reg->mcondition=='P'){
				$condicion='Pagado';
			}


			if ($reg->mcondition=='L'){
				$botones='<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button><button class="btn btn-danger" onclick="anular('.$reg->id.')"><i class="fa fa-cut"></i></button>';
			}
			else if($reg->mcondition=='D'){
				$botones='<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button><button class="btn btn-danger" onclick="anular('.$reg->id.')"><i class="fa fa-cut"></i></button>';
			}
			else if($reg->mcondition=='C'){
				$botones='<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>';
			}
			else if($reg->mcondition=='X'){
				$botones='<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>';
			}
			else if($reg->mcondition=='P'){
				$botones='<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i></button>';
			}


			if ($reg->fpagado==NULL){
				$fpagado='No pagado';
			}
			else {
				$fpagado=$reg->fpagado;
			}
			
 			$data[]=[
				
				"0"=>$botones,
				"1"=>$reg->rfc.'-'.$reg->rif.'-'.$reg->name,
				"2"=>$reg->idt.'-'.$reg->detalle,
				"3"=>$condicion,
				"4"=>$reg->moment,
				"5"=>$reg->totliq,
				"6"=>$reg->deferred,
				"7"=>$reg->totpag,
				"8"=>$fpagado,
				
				
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

case 'anular':
		$rspta=$ajuste->anular($id);
 		echo $rspta ? "Tramite anulado" : "Tramite no se pudo anular";
	break;
	

	


}
?>