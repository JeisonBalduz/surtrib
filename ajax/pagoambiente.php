<?php 
session_start(); 
require_once "../modelos/Pagosambiente.php";

$pagoamb=new Pagoamb();

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

	case 'desactivar':
		$rspta=$pagoamb->desactivar($idpagoamb);
 		echo $rspta ? "Pago no confirmado" : "El pago no pudo reversarse";
	break;

	case 'activar':
		$rspta=$pagoamb->activar($idpagoamb);
 		echo $rspta ? "Pago confirmado" : "El pago no puedo confirmarse";
	break;
        
	case 'mostrar':
		$rspta=$pagoamb->mostrar($idpagoamb);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		if ($_SESSION['rol']==1){
		$rspta=$pagoamb->listar($idusuarioamb);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->idpagoamb.')"><i class="fa fa-eye"></i></button>',
 				"1"=>($reg->estado)?'<span class="badge bg-info">Confirmado</span>':'<span class="badge bg-danger">Por Confirmar</span>',
 				"2"=>$reg->idbanco,
				"3"=>$reg->monto,
				"4"=>$reg->referencia,
				"5"=>$reg->tipopago,
				"6"=>$reg->fechapago,
				"7"=>$reg->fechaaprobacion,
				"8"=>"<a href='../files/documentos/".$reg->imagen."' download>Ver</a>"
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	}

		
		$rspta=$pagoamb->listar2();
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->idpagoamb.')"><i class="fa fa-eye"></i></button>'.
				 ' <button class="btn btn-danger" onclick="desactivar('.$reg->idpagoamb.')"><i class="fa fa-edit"></i></button>':
				 '<button class="btn btn-info" onclick="mostrar('.$reg->idpagoamb.')"><i class="fa fa-eye"></i></button>'.
				 ' <button class="btn btn-info" onclick="activar('.$reg->idpagoamb.')"><i class="fa fa-edit"></i></button>',
				"1"=>($reg->estado)?'<span class="badge bg-info">Confirmado</span>':'<span class="badge bg-danger">Por Confirmar</span>',
 				"2"=>$reg->idbanco,
				"3"=>$reg->monto,
				"4"=>$reg->referencia,
				"5"=>$reg->tipopago,
				"6"=>$reg->fechapago,
				"7"=>$reg->fechaaprobacion,
				"8"=>"<a href='../files/documentos/".$reg->imagen."' download>Ver</a>"
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
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