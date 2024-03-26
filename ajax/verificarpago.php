<?php 
session_start(); 
require_once "../modelos/Verificarpago.php";

$veripago=new Veripago();

$idusuarioamb=$_SESSION['idusuario'];
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

$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";
$comodinbusqueda2=isset($_POST["comodinbusqueda2"])? limpiarCadena($_POST["comodinbusqueda2"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
        
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "application/pdf")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/documentos/" . $imagen);
			}
		}
        
		if (empty($idpagoamb)){
			$rspta=$pagoamb->insertar($monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen);
			echo $rspta ? "Pago registrado" : "Pago no se pudo registrarse";
		}
		else {
			$rspta=$pagoamb->editar($idpagoamb,$monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen);
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

	case 'mostarvfile':
		$rspta=$veripago->mostarvfile($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

	
		$rspta=$veripago->listar();
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="conciliar('.$reg->id.')">Ver Notificacion</button>',
 				"1"=>$reg->fechaliq,
				 "2"=>$reg->rfc,
 				"3"=>$reg->name,
				"4"=>$reg->detalle,
				"5"=>$reg->ctramite,
				"6"=>$reg->mount,
				"7"=>$reg->ref,
				"8"=>'<a  href="../files/documentos/'.$reg->vfile.'" download>Ver</a>',
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

	//$rspta=$contrih->reportedeldia_taquilla($comodinbusqueda,$comodinbusqueda2);
		$rspta=$veripago->listarporfecha($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="conciliar('.$reg->id.')">Ver Notificacion</button>',
 				"1"=>$reg->fechaliq,
				 "2"=>$reg->rfc,
 				"3"=>$reg->name,
				"4"=>$reg->detalle,
				"5"=>$reg->ctramite,
				"6"=>$reg->mount,
				"7"=>$reg->ref,
				"8"=>'<a  href="../files/documentos/'.$reg->vfile.'" download>Ver</a>',
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Informaci¨®n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	
    

	break;

	case 'selectbanco':
        require_once "../modelos/Bancos.php";
		$bancos = new Bancos();
		$rspta = $bancos->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->id . '>' . $reg->nombre. '</option>';
        }
	break;

}
?>