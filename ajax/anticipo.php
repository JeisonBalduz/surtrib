<?php 
session_start(); 
require_once "../modelos/Anticipio.php";

$anticipio=new Anticipio();

$rfc=$_SESSION['rfc'];
$iduser=$_SESSION['idusuario'];
$cogigo_grupo=isset($_POST["cogigo_grupo"])? limpiarCadena($_POST["cogigo_grupo"]):"";
$documento=isset($_POST["documento"])? limpiarCadena($_POST["documento"]):"";
$montotal=isset($_POST["montotal"])? limpiarCadena($_POST["montotal"]):"";
$anno=isset($_POST["anno"])? limpiarCadena($_POST["anno"]):"";
$mes=isset($_POST["mes"])? limpiarCadena($_POST["mes"]):"";




switch ($_GET["op"]){
        
	case 'guardaryeditar':
	
	
		if (!file_exists($_FILES['documento']['tmp_name']) || !is_uploaded_file($_FILES['documento']['tmp_name']))
		{
			$documento=$_POST["documento"];
		}
		else 
		{
			$ext = explode(".", $_FILES["documento"]["name"]);
			if ($_FILES['documento']['type'] == "image/jpg" || $_FILES['documento']['type'] == "image/jpeg" || $_FILES['documento']['type'] == "image/png" || $_FILES['documento']['type'] == "application/pdf")
			{
				$documento = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["documento"]["tmp_name"], "../files/anticipo/" . $documento);
			}
		}
		
        
		if (empty($id)){
			$rspta=$anticipio->insertar($rfc,$iduser,$documento,$montotal,$_POST['idact'],$_POST['montobruto'],$anno,$mes);
			echo $rspta ? "Pago registrado" : "Pago no se pudo registrarse";
		}
		else {
			$rspta=$anticipio->editar($idpagoamb,$monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen);
			echo $rspta ? "Pago actualizado" : "Pago no se pudo actualizarse";
		}
	break;

	case 'insertartramitemv':
		$rspta=$vehiculo->insertartramitemv($rfc,$idtvehiculo,$idv,$iduser);
 		echo $rspta ? "Vehiculo Declarado" : "Vehiculo no pudo ser declarado";
	break;

	case 'desactivar':
		$rspta=$vehiculo->desactivar($id);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$vehiculo->activar($id);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$anticipio->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrartaxveh':
		$rspta = $vehiculo->mostrartaxveh();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtv. '>' . $reg->idtv. '-' . $reg->detalle. '</option>';
			
        }
	break;

	case 'mostraractividades':
		$rspta = $anticipio->mostraractividades($rfc);
		$i=0;
		while ($reg = $rspta->fetch_object())

        {
			$i++;
            echo '<div class="row">
				  		<div class="form-group col-sm-2 col-xs-12">
				  			<label>Codigo</label>
				  				<input type="hidden" name="idact[]" id="id" class="form-control" value="' . $reg->id. '">
			      				<input type="text" name="actividades" id="actividades" class="form-control" value="' . $reg->codigo_grupo. '" disabled>
				  		</div>
				  
				  		<div class="form-group col-sm-8 col-xs-12">
				  			<label>Actividad</label>
			      				<input type="text" name="detalles" id="detalles" class="form-control" value="' . $reg->detalles. '" disabled>
				  		</div> 
				   
				  		<div class="form-group col-sm-2 col-xs-12">
				  			<label>Ingresos Brutos</label>
			      			<input type="number" step="0.01" name="montobruto[]" id="ingresobruto'.$i.'" onChange="suma();" class="cla form-control" required>
				  		</div> 
				  </div>
				  '
				  
				  ;
			
        }
	break;
	
	case 'listar':

		$rspta=$anticipio->listar($rfc);
 		//Vamos a declarar un array
 		$data= Array();
		
 		while ($reg=$rspta->fetch_object()){
 		    if ($reg->mcondition!='L'){
				$recibo='<a target="_blank" href="../reportesPDF/recibopago.php?codigo='.$reg->tramite.'");" class="btn btn-info">Recibo</a>';
			}
			else {
				$recibo='<span class="badge bg-danger">Tramite por Pagar</span>';
			}

			 if ($reg->anno==2023 OR $reg->anno==2022){
				$reporte='<a target="_blank" href="../reportesPDF/tramiteactividadeco.php?codigo='.$reg->id.'");" class="btn btn-info">Ver Tramite</a>';
			}
			else {
				$reporte='<a target="_blank" href="../reportesPDF/tramiteactividadeco2.php?codigo='.$reg->id.'");" class="btn btn-info">Ver Tramite</a>';
			}
 		    
 			$data[]=[
				 "0"=>$reg->fecha,
				 "1"=>$reg->tramite,
				"2"=>$reporte,
 				"3"=>$recibo,
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case 'consultarultimopago':

		$rspta=$anticipio->verificasiondepago($rfc);
 		//Vamos a declarar un array
 		$data= Array();
		
 		if($reg=$rspta->fetch_object()){
 			$ultilo_ano_pago=(integer)substr($reg->ul_pago,0,4);
 			$ultilo_mes_pago=(integer)substr($reg->ul_pago,-2);

 			$data=Array("ul_pago"=>$reg->ul_pago,"ultilo_ano_pago"=>$ultilo_ano_pago,"ultilo_mes_pago"=>$ultilo_mes_pago,"dia_actual"=>(integer)$reg->dia_actual,"mes_actual"=>(integer)$reg->mes_actual,"ano_actual"=>(integer)$reg->ano_actual);

 		}
 		
 		echo json_encode($data);

	break;

}
?>