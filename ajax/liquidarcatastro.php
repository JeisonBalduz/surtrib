<?php 
session_start(); 
require_once "../modelos/Liquidarcatastro.php";

$liquicatastro=new Liquicatastro();

$iduser=$_SESSION['idusuario'];
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
        

	case 'insertartramitemv':
		$rspta=$liquicatastro->insertartramitemv($id,$rfc,$idtc,$iduser,$metros);
 		echo $rspta ? "Tasa Declarado" : "Tasa no pudo ser declarado";
	break;


        
	case 'mostrar':
		$rspta=$liquicatastro->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrartaxcat':
		$rspta = $liquicatastro->mostrartaxcat();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idc. '>' . $reg->idc. '-' . $reg->detalle. '</option>';
			
        }
	break;

	case 'listar':

		$rspta=$liquicatastro->listar($rfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
				$data[]=[
					"0"=>'<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario2" onclick="mostrar('.$reg->id.')">Declarar</button>',
					"1"=>$reg->rfc,
					"2"=>$reg->rif,
 					"3"=>$reg->name,
				 	"4"=>$reg->detalle,
			    	"5"=>$reg->metros
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