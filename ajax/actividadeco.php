<?php 
session_start(); 
require_once "../modelos/Actividadeco.php";

$actividadeco=new Actividadeco();

$rfc=$_SESSION['rfc'];
$iduser=$_SESSION['idusuario'];
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$idv=isset($_POST["idv"])? limpiarCadena($_POST["idv"]):"";
$registered=isset($_POST["registered"])? limpiarCadena($_POST["registered"]):"";
$idtvehiculo=isset($_POST["idtvehiculo"])? limpiarCadena($_POST["idtvehiculo"]):"";
$licenseplate=isset($_POST["licenseplate"])? limpiarCadena($_POST["licenseplate"]):"";
$serialmotor=isset($_POST["serialmotor"])? limpiarCadena($_POST["coserialmotorrreo"]):"";
$serialcarro=isset($_POST["serialcarro"])? limpiarCadena($_POST["serialcarro"]):"";
$marca=isset($_POST["marca"])? limpiarCadena($_POST["marca"]):"";
$modelos=isset($_POST["modelos"])? limpiarCadena($_POST["modelos"]):"";
$puestos=isset($_POST["puestos"])? limpiarCadena($_POST["puestos"]):"";
$pesos=isset($_POST["pesos"])? limpiarCadena($_POST["pesos"]):"";
$anio=isset($_POST["anio"])? limpiarCadena($_POST["anio"]):"";
$fechacompra=isset($_POST["fechacompra"])? limpiarCadena($_POST["fechacompra"]):"";
$cpropietary=isset($_POST["cpropietary"])? limpiarCadena($_POST["cpropietary"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$tiponac=isset($_POST["tiponac"])? limpiarCadena($_POST["tiponac"]):"";
$cedularif=isset($_POST["cedularif"])? limpiarCadena($_POST["cedularif"]):"";
$fpago=isset($_POST["fpago"])? limpiarCadena($_POST["fpago"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$idt=isset($_POST["idt"])? limpiarCadena($_POST["idt"]):"";
$detalles=isset($_POST["detalles"])? limpiarCadena($_POST["detalles"]):"";
$actividad=isset($_POST["actividad"])? limpiarCadena($_POST["actividad"]):"";
$rfc2=isset($_POST["rfc2"])? limpiarCadena($_POST["rfc2"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$actividadeco->insertar($rfc,$actividad);
			echo $rspta ? "Actividad Economica registrada" : "Actividad Economica no pudo registrarse";
		}
		else {
			$rspta=$vehiculo->editar($id,$registered,$idtvehiculo,$licenseplate,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra);
			echo $rspta ? "Vehiculo actualizado" : "Vehiculo no se pudo actualizar";
		}
	break;


	case 'mostrar':
		$rspta=$actividadeco->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	
	case 'listar':

		$rspta=$actividadeco->listar($rfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				
				"0"=>$reg->codigo_grupo,
				 "1"=>$reg->detalles,
				
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'listarad':

		$rspta=$actividadeco->listarad($rfc2);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-eye"></i>
				</button><button class="btn btn-danger" onclick="mostrar('.$reg->id.')"><i class="fa fa-check"></i></button>',
			 	"1"=>$reg->codigo_grupo,
				"2"=>$reg->detalles,
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;



	case 'listaractividad':

		$rspta = $actividadeco->listaractividad();
		while ($reg = $rspta->fetch_object())
        {
			echo '<option value=' . $reg->id . '>' . $reg->codigo_grupo . ' ' . $reg->detalles . '</option>';
        }

	break;

	case 'listaractividad2':

		$rspta = $actividadeco->listaractividad2();
		while ($reg = $rspta->fetch_object())
        {
			echo '<option value=' . $reg->id . '>' . $reg->codigo_grupo . ' ' . $reg->detalles . '</option>';
        }

	break;

	

	


}
?>