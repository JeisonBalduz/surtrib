<?php 
session_start(); 
require_once "../modelos/Notificarpagos.php";

$npago=new Npago();

$rfc=$_SESSION['rfc'];
$iduser=$_SESSION['idusuario'];
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
$tramite=isset($_POST["tramite"])? limpiarCadena($_POST["tramite"]):"";
$tributo=isset($_POST["tributo"])? limpiarCadena($_POST["tributo"]):"";
$idtramite=isset($_POST["idtramite"])? limpiarCadena($_POST["idtramite"]):"";

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
        
		if (empty($id)){
			$rspta=$npago->insertar($tributo,$monto,$tramite,$iduser,$referencia,$imagen,$idtramite);
			echo $rspta ? "PAGO REGISTRADO CON EXITO" : "SU PAGO NO PUDO SER REGISTRADO: Estimado Contribuyente verifique por favor que el monto ingresado sea exactamente igual al monto del comprobante del banco y utilice punto (.) para la separacion decimal, no utilice coma (,). De igual forma es importante que al momento de ingresar el numero de Referencia de su operacion coloque todos los numeros correspondientes y no solo las ultimas cuatro cifras.";
		}
		else {
			$rspta=$npago->editar($idpagoamb,$monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen);
			echo $rspta ? "Pago actualizado" : "Pago no pudo actualizarse";
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

	case 'liquidar':
		$rspta=$npago->liquidar($tramite);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
	
	case 'listar':

		$rspta=$npago->listar($rfc);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){


			if (($reg->totpag+$reg->totpag)>=$reg->totliq){
				$totliq=$reg->totliq;
			}
			else  if ($reg->montodiferido!=0){
				$totliq=$reg->totliq;
			}
			else{
				$totliq='<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="liquidar('.$reg->tramite.')"><abbr title="Pagar">'.$reg->totliq.'</abbr></button>';
			}

			if ($reg->montodiferido==0 OR $reg->totliq<=$reg->totpag){
				$montodiferido=$reg->montodiferido;
			}
			else {
				$montodiferido='<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#listardiferido" onclick="listardiferido2('.$reg->tramite.')"><abbr title="Diferido">'.$reg->montodiferido.'</abbr></button>';
			}

			if ($reg->diferencia<=0){
				$diferencia=$reg->diferencia;
			}
			else  if ($reg->montodiferido>0){
				$diferencia='<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="liquidar('.$reg->tramite.')"><abbr title="Pagar">Diferencia</abbr></button>';
			}
			
		 		
			else {
				$diferencia='<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulariopago" onclick="liquidar('.$reg->tramite.')"><abbr title="Pagar">Diferencia</abbr></button>';
			}
			

			if (($reg->totpag)>=$reg->totliq){
				$recibo='<a target="_blank" href="../reportesPDF/recibopago.php?codigo='.$reg->tramite.'");" class="btn btn-info">Recibo</a>';
			}
			else {
				$recibo='<span class="badge bg-danger">Tramite por Pagar</span>';
			}

 			$data[]=array(
				"0"=>$reg->fechaliq,
				"1"=>$reg->tramite.' '.$reg->period,
				"2"=>'<p class="text-center" margin="0">'.$reg->idt.'   <b>'.$reg->detalle.'</b></p>',
				"3"=>$totliq,
				"4"=>$montodiferido,
				"5"=>$diferencia,
				"6"=>$reg->descuento,
				"7"=>$reg->totpag,
				"8"=>$reg->saldo,
				"9"=>$recibo
			);
		
		}
                
 		
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'listardiferido':

		$rspta=$npago->listardiferido($tramite);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>$reg->fecha,
				"1"=>$reg->ref,
				"2"=>$reg->recibo,
				"3"=>$reg->mount
			);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Informacion para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'listardiferido2':
		$rspta = $npago->listardiferido($tramite);
		$tt=0;
		while ($reg = $rspta->fetch_object())
        {
			$tt=$tt + $reg->mount;
            echo '	<tr>
						<td>' . $reg->fecha. '</td>
						<td>' . $reg->ref. '</td>
						<td>' . $reg->recibo. '</td>
						<td>' . $reg->mount. '</td>
		  			</tr>
					 
					
					';
        }

		echo '	
	  <tr>
	  <td>TOTAL</td>
	  <td>TOTAL</td>
	  <td>TOTAL</td>
	  <td>' . $tt. '</td>
	</tr>
	
	';


	break;


}
?>