<?php 
session_start(); 
require_once "../modelos/Liquidarcatastro.php";

$liquicatastro=new Liquicatastro();

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
$registered=isset($_POST["registered"])? limpiarCadena($_POST["registered"]):"";
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$idtc=isset($_POST["idtc"])? limpiarCadena($_POST["idtc"]):"";
$metros=isset($_POST["metros"])? limpiarCadena($_POST["metros"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$liquicatastro->insertar($idtvehiculo,$rfc,$licenseplate,$serialmotor,$serialcarro,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra);
			echo $rspta ? "Vehiculo registrado" : "Vehiculo no se pudo registrar";
		}
		else {
			$rspta=$liquicatastro->editar($id,$registered,$idtvehiculo,$licenseplate,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra);
			echo $rspta ? "Vehiculo actualizado" : "Vehiculo no se pudo actualizar";
		}
	break;

	case 'insertartramitemv':
		$rspta=$liquicatastro->insertartramitemv($id,$rfc,$idtc,$iduser,$metros);
 		echo $rspta ? "Tasa Declarado" : "Tasa no pudo ser declarado";
	break;

	case 'desactivar':
		$rspta=$liquicatastro->desactivar($id);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$liquicatastro->activar($id);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$liquicatastro->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrartaxveh':
		$rspta = $liquicatastro->mostrartaxveh();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idc. '>' . $reg->idc. '-' . $reg->detalle. '</option>';
			
        }
	break;

	case 'listarcon':

		$rspta=$liquicatastro->listarcon($rfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			if ($reg->estado==1){
 				$data[]=[
				"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario2" onclick="declararvehiculo('.$reg->id.')">Declarar</button>',
				"1"=>$reg->rfc,
				"2"=>$reg->rif,
 				"3"=>$reg->name,
				 "4"=>$reg->detalle,
			    "5"=>$reg->metros,
				"6"=>$reg->registered,
 				];

			}
			else {
				$data[]=[
					"0"=>'<a target="_blank" href="../reportesPDF/tramitevehiculo.php?codigo='.$reg->tramite.'");" class="btn btn-danger">Ver Tramite</a>',
					"1"=>$reg->rfc,
					"2"=>$reg->rif,
 					"3"=>$reg->name,
				 	"4"=>$reg->detalle,
			    	"5"=>$reg->metros
					 ];

 		}

	}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
	case 'listar':

		$rspta=$vehiculo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-user"></i></button>',
				"1"=>$reg->razsocial,
				"2"=>$reg->tiponac."".$reg->cedularif,
 				"3"=>$reg->marca,
				"4"=>$reg->modelos,
 				"5"=>$reg->puestos,
 				"6"=>$reg->pesos,
			    "7"=>$reg->fechacompra,
				"8"=>$reg->detalle,
				"9"=>$reg->fpago
				
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listar2':

		$rspta=$liquicatastro->listar2($comodinbusqueda);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-user"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-edit"></i></button>',
			   "1"=>$reg->tiponac."-".$reg->cedularif,
				"2"=>$reg->marca,
			   "3"=>$reg->modelos,
				"4"=>$reg->puestos,
				"5"=>$reg->pesos,
			   "6"=>$reg->fechacompra,
			   "7"=>$reg->detalle,
			   "8"=>$reg->fpago
 				
 				];

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