<?php 
session_start(); 
require_once "../modelos/Modeloactividadecinomica.php";

$actividadecinomica=new actividadecinomica();


$id_mayor=isset($_POST["id_mayor"])? limpiarCadena($_POST["id_mayor"]):"";
$tramite=isset($_POST["tramite"])? limpiarCadena($_POST["tramite"]):"";
$totliq=isset($_POST["totliq"])? limpiarCadena($_POST["totliq"]):"";

$txtreferencia=isset($_POST["txtreferencia"])? limpiarCadena($_POST["txtreferencia"]):"";
$txtaprobado=isset($_POST["txtaprobado"])? limpiarCadena($_POST["txtaprobado"]):"";
$txtmonto=isset($_POST["txtmonto"])? limpiarCadena($_POST["txtmonto"]):"";


//DE AQUI EN ADELAMTE
$idrfc=isset($_POST["idrfc"])? limpiarCadena($_POST["idrfc"]):"";

switch ($_GET["op"]){
	case 'listar':

		$rspta=$actividadecinomica->listar($idrfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->coderegister,
				"1"=>$reg->status,
				"2"=>$reg->representante_legal_nombre
				//"3"=>$reg->codigo
			);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
        
	case 'solicitud': //********
	/*	$rspta=$PagoTaqulla->pagartaquilla($id_mayor,$tramite,$txtreferencia,$txtaprobado,$txtmonto);
 		//echo $rspta ? "Registrado Con Exito" : "Pago No Registrado";*/
 		echo "OJO ACTIVIDA PROCESADA";
	break;
        
	case 'obtenerdeudas':
		
	  /*   $rspta = $PagoTaqulla->listardeudacontribuyente($idrfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){ //onclick="mostrarliq('.$reg->id.')"
 			$data[]=[
 				"0"=>$reg->fechaliq,
				"1"=>$reg->tramite.'-'.$reg->period.'<button class="btn btn-info"  id="btnMyTest001"   data-id_mayor="'.$reg->id.'" data-tramite="'.$reg->tramite.'" data-totliq="'.$reg->totliq.'" data-target="#modal-default"><i>Pagar</i></button>',
 				"2"=>$reg->detalle,   
 				"3"=>$reg->totliq,
				"4"=>$reg->descuento,
			    "5"=>$reg->totpag
			    //"6"=>""
 				];
				
 		}
 			$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);*/

 		break;

	case 'formuprocesarpago':

      //  require_once "htmlprosesarpago.php";
	break;

	

}
?>