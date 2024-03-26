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
$rifbusqueda=isset($_POST["rifbusqueda"])? limpiarCadena($_POST["rifbusqueda"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";

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
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$pagoamb->activar($idpagoamb);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
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
 				"0"=>'<div class="btn-group btn-group-sm"><a onclick="mostrar('.$reg->idpagoamb.')" class="btn btn-info"><i class="fas fa-eye"></i></a></div>',
 				"1"=>($reg->estado)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
				"2"=>$reg->monto,
				"3"=>$reg->tipopago,
				"4"=>"<img src='../files/documentos/".$reg->imagen."' height='50px' width='50px' >"
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	}
	else {

		$rspta=$pagoamb->listar();
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>($reg->estado)?'<div class="btn-group btn-group-sm"><a onclick="mostrar('.$reg->idpagoamb.')" class="btn btn-info"><i class="fas fa-eye"></i></a></div>'.
				 '<div class="btn-group btn-group-sm"><a onclick="desactivar('.$reg->idpagoamb.')" class="btn btn-danger"><i class="fas fa-check"></i></a></div>':
				 '<div class="btn-group btn-group-sm"><a onclick="mostrar('.$reg->idpagoamb.')" class="btn btn-info"><i class="fas fa-eye"></i></a></div>'.
				 '<div class="btn-group btn-group-sm"><a onclick="activar('.$reg->idpagoamb.')" class="btn btn-info"><i class="fas fa-times"></i></a></div>',
				"1"=>($reg->estado)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
 				"2"=>$reg->monto,
				"3"=>$reg->tipopago,
				"4"=>"<a href='../files/documentos/".$reg->imagen."' download>Ver</a>"
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 	 	echo json_encode($results);
       }

	break;

	case 'select':
        require_once "../modelos/Usuarios.php";
		$usuarios = new Usuarios();
		$rspta = $usuarios->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->numerodocumento . '>'. $reg->tipodocumento.' '.$reg->numerodocumento.' '.$reg->nombre. '</option>';
        }
	break;

	case 'select2':
        require_once "../modelos/Usuarios.php";
		$usuarios = new Usuarios();
		$rspta = $usuarios->select2();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->numerodocumento . '>'. $reg->tipodocumento.' '.$reg->numerodocumento.' '.$reg->nombre. '</option>';
        }
	break;

	case 'selectInmueble':
        require_once "../modelos/Empambiente.php";
		$empamb = new Empamb();
		$rspta = $empamb->selectInmueble($rifbusqueda);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->rfc . '>'. $reg->licencia.' '.$reg->medit. '</option>';
        }
	break;

	case 'mostrartasaind':
		require_once "../modelos/Empambiente.php";
		$empamb = new Empamb();
		$rspta=$empamb->mostrar($rfc);
 		echo json_encode($rspta);
	break;



}
?>