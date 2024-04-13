<?php 
session_start(); 
require_once "../modelos/Definitiva.php";

$definitiva=new Definitiva();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$rfc2=isset($_POST["rfc2"])? limpiarCadena($_POST["rfc2"]):"";
$montobrutoanual=isset($_POST["montobrutoanual"])? limpiarCadena($_POST["montobrutoanual"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$tiponac=isset($_POST["tiponac"])? limpiarCadena($_POST["tiponac"]):"";
$cedularif=isset($_POST["cedularif"])? limpiarCadena($_POST["cedularif"]):"";
$razsocial=isset($_POST["razsocial"])? limpiarCadena($_POST["razsocial"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$tlf=isset($_POST["tlf"])? limpiarCadena($_POST["tlf"]):"";
$busqueda=isset($_POST["busqueda"])? limpiarCadena($_POST["busqueda"]):"";
$representante=isset($_POST["representante"])? limpiarCadena($_POST["representante"]):"";
$rcedula=isset($_POST["rcedula"])? limpiarCadena($_POST["rcedula"]):"";
$rtelefono=isset($_POST["rtelefono"])? limpiarCadena($_POST["rtelefono"]):"";
$correlativo=isset($_POST["correlativo"])? limpiarCadena($_POST["correlativo"]):"";

$nacionalidad=isset($_POST["nacionalidad"])? limpiarCadena($_POST["nacionalidad"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$definitiva->insertar($rfc2,$montobrutoanual,$representante,$rcedula,$rtelefono,$correlativo,$nacionalidad);
			echo $rspta ? "Definitiva registrada" : "Definitiva no se pudo registrar";
		}
		else {
			$rspta=$definitiva->editar();
			echo $rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$contrih->desactivar($rfc);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$contrih->activar($rfc);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$definitiva->mostrar($busqueda);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$definitiva->listar();
 		//Vamos a declarar un array
 		$data= Array();


		

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<a target="_blank" href="../reportesPDF/definitiva.php?codigo='.$reg->montobruto.'&codigo2='.$reg->rfc.'&representante='.$reg->representante.'&rtelefono='.$reg->rtelefono.'&rcedula='.$reg->rcedula.'&correlativo='.$reg->correlativo.'");" class="btn btn-info">Ver Definitiva</a>',
				"1"=>$reg->rfc,
				"2"=>$reg->rif,
				"3"=>$reg->name,
				"4"=>$reg->correlativo,
			);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;




	case 'verdefinitiva':
		$rspta=$definitiva->verdefinitiva($busqueda);
		$totalibruto=0;
		$totaltax=0;
		while ($reg = $rspta->fetch_object())
        {

			if ($reg->totpag==0){
				$condicion='<span class="badge bg-danger">Por Pagar</span>';
			}
			else{
				$condicion='<span class="badge bg-info">Pagado</span>';
			}

			

			$totalibruto=$totalibruto + $reg->ibruto;
			$rtotalibruto=number_format($totalibruto,2,',','.');
			$totaltax=$totaltax + $reg->tax;
			$rtotaltax=number_format($totaltax,2,',','.');
            echo '<tr>
						<td>' . $reg->name. '-' . $reg->rif. '</td>
						<td>' . $reg->codigo_grupo. '-' . $reg->detalles. '</td>
						<td>' . $reg->alicuota. '</td>
						<td>' . $reg->annomm. '</td>
						<td>' . $reg->tramite. '</td>
						<td>' . $condicion. '</td>
						<td>' . $reg->ibruto. '</td>
						<td>' . $reg->tax. '</td>
						<td>' . $reg->totpag. '</td>
						
		  			</tr>';
        }

		if (empty($rtotalibruto)){
			echo '<tr>
						<td>No posee declarion de anticipos</td>
					
						
		  			</tr>';
		}
		else {
			echo '<tr>
						<td>TOTAL</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
	
						<td>' . $rtotalibruto. '</td>
						<td>' . $rtotaltax. '</td>
						
		  			</tr>';

		}

		

	break;

	case 'selectasas':
		$rspta = $tasasadm->selectasas();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->id. '>' . $reg->idt. '-' . $reg->detalle. '</option>';
			
        }
	break;

	

}
?>