<?php 
session_start(); 
require_once "../modelos/Facturaaseo.php";

$facturaaseo=new Facturaaseo();

$iduser=$_SESSION['idusuario'];

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$fechapago=isset($_POST["fechapago"])? limpiarCadena($_POST["fechapago"]):"";
$rif=isset($_POST["rif"])? limpiarCadena($_POST["rif"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$rif=isset($_POST["rif"])? limpiarCadena($_POST["rif"]):"";
$conceptopago1=isset($_POST["conceptopago1"])? limpiarCadena($_POST["conceptopago1"]):"";
$monto1=isset($_POST["monto1"])? limpiarCadena($_POST["monto1"]):"";
$conceptopago2=isset($_POST["conceptopago2"])? limpiarCadena($_POST["conceptopago2"]):"";
$monto2=isset($_POST["monto2"])? limpiarCadena($_POST["monto2"]):"";
$conceptopago3=isset($_POST["conceptopago3"])? limpiarCadena($_POST["conceptopago3"]):"";
$monto3=isset($_POST["monto3"])? limpiarCadena($_POST["monto3"]):"";
$conceptopago4=isset($_POST["conceptopago4"])? limpiarCadena($_POST["conceptopago4"]):"";
$monto4=isset($_POST["monto4"])? limpiarCadena($_POST["monto4"]):"";
$conceptopago5=isset($_POST["conceptopago5"])? limpiarCadena($_POST["conceptopago5"]):"";
$monto5=isset($_POST["monto5"])? limpiarCadena($_POST["monto5"]):"";
$montotal=isset($_POST["montotal"])? limpiarCadena($_POST["montotal"]):"";

$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";

$formapago=isset($_POST["formapago"])? limpiarCadena($_POST["formapago"]):"";



switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$facturaaseo->insertar($nombre,$rif,$fechapago,$direccion,$conceptopago1,$monto1,$conceptopago2,$monto2,$conceptopago3,$monto3,$conceptopago4,$monto4,$conceptopago5,$monto5,$montotal,$telefono,$correo,$formapago,$iduser);
			echo $rspta ? "Factura registrada" : "Factura no se pudo registrarse";
		}
		else {
			$rspta=$facturaaseo->editar($id,$nombre,$status,$rif,$codigo);
			echo $rspta ? "Banco actualizado" : "Baqnco no se pudo actualizarse";
		}
	break;

	case 'desactivar':
		$rspta=$facturaaseo->desactivar($id);
 		echo $rspta ? "Banco desactivado" : "Banco no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$facturaaseo->activar($id);
 		echo $rspta ? "Banco activado" : "Banco no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$facturaaseo->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$facturaaseo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<a target="_blank" href="../reportesPDF/facturaaseopdf.php?codigo='.$reg->id.'");" class="btn btn-info">Ver Factura</a>',
				"1"=>$reg->nfactura,
				"2"=>$reg->rif,
				"3"=>$reg->nombre,
				"4"=>$reg->fechapago
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