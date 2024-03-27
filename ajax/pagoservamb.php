<?php 
session_start(); 
require_once "../modelos/Pagoservamb.php";

$empamb=new Empamb();

$idusuario=$_SESSION['idusuario'];
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$rif=isset($_POST["rif"])? limpiarCadena($_POST["rif"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$sector=isset($_POST["sector"])? limpiarCadena($_POST["sector"]):"";
$calle=isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$edificio=isset($_POST["edificio"])? limpiarCadena($_POST["edificio"]):"";
$numeroedif=isset($_POST["numeroedif"])? limpiarCadena($_POST["numeroedif"]):"";
$medit=isset($_POST["medit"])? limpiarCadena($_POST["medit"]):"";
$representative=isset($_POST["representative"])? limpiarCadena($_POST["representative"]):"";
$tiposervicio=isset($_POST["tiposervicio"])? limpiarCadena($_POST["tiposervicio"]):"";
$docregistro=isset($_POST["docregistro"])? limpiarCadena($_POST["docregistro"]):"";
$registrado=isset($_POST["registrado"])? limpiarCadena($_POST["registrado"]):"";
$conformidaduso=isset($_POST["conformidaduso"])? limpiarCadena($_POST["conformidaduso"]):"";
$tieneinmueble=isset($_POST["tieneinmueble"])? limpiarCadena($_POST["tieneinmueble"]):"";
$taseoi=isset($_POST["taseoi"])? limpiarCadena($_POST["taseoi"]):"";
$ultima_declaracion=isset($_POST["ultima_declaracion"])? limpiarCadena($_POST["ultima_declaracion"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$idtaxempamb=isset($_POST["idtaxempamb"])? limpiarCadena($_POST["idtaxempamb"]):"";
$idramotax=isset($_POST["idramotax"])? limpiarCadena($_POST["idramotax"]):"";
$idcategoriatax=isset($_POST["idcategoriatax"])? limpiarCadena($_POST["idcategoriatax"]):"";
$idtipotax=isset($_POST["idtipotax"])? limpiarCadena($_POST["idtipotax"]):"";
$busqueda=isset($_POST["busqueda"])? limpiarCadena($_POST["busqueda"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$idt=isset($_POST["idt"])? limpiarCadena($_POST["idt"]):"";
$tiposer=isset($_POST["tiposer"])? limpiarCadena($_POST["tiposer"]):"";
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$tipotribute=isset($_POST["tipotribute"])? limpiarCadena($_POST["tipotribute"]):"";



switch ($_GET["op"]){
        
	case 'guardaryeditar':

		if (empty($id)){
			$rspta=$empamb->insertar($rfc,$sector,$calle,$edificio,$numeroedif,$direccion,$ultima_declaracion,$idt,$idusuario,$tiposer);
			echo $rspta ? "Empresa o Sucursal registrada" : "Empresa o Sucursal no se pudo registrarse";
		}
		else {
			$rspta=$empamb->editar($id,$rfc,$sector,$calle,$edificio,$numeroedif,$direccion,$ultima_declaracion,$idt,$idusuario,$tiposer);
			echo $rspta ? "Empresa o Sucursal actualizada" : "ContrEmpresa o Sucursal no se pudo actualizarse";
		}
	break;




	case 'desactivar':
		$rspta=$empamb->desactivar($rfc);
 		echo $rspta ? "Empresa o Sucursal desactivada" : "Empresa o Sucursal no se pudo desactivar";
	break;

	

	

	case 'activar':
		$rspta=$empamb->activar($rfc);
 		echo $rspta ? "Empresa o Sucursal activado" : "Empresa o Sucursal no se pudo activar";
	break;
        
	

	case 'mostrar':
		$rspta=$empamb->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


case 'tramiteporpagar':

  // Obtener la última fecha de pago
  $rspta = $empamb->tramiteporpagar($id);

  // Si la consulta no devuelve un registro, mostrar un mensaje de error
  if (!$rspta) {
    echo '<tr>
      <td colspan="7">No se encontraron registros.</td>
    </tr>';
    break;
  }

  // Obtener el objeto con la información del registro
  $reg = $rspta->fetch_object();

  // Si el campo `fechapago` es nulo, mostrar un mensaje de error
  if (is_null($reg->fpago)) {
    echo '<tr>
      <td colspan="7">La fecha de pago no está disponible.</td>
    </tr>';
    break;
  }

  // Convertir la fecha de pago a un objeto DateTime
  $fechaUltimaPago = DateTime::createFromFormat('Y-m-d', $reg->fpago);

  // Si la fecha de pago no es válida, mostrar un mensaje de error
  if (!$fechaUltimaPago) {
    echo '<tr>
      <td colspan="7">La fecha de pago no es válida.' . $reg->fechaUltimaPago . '</td>
    </tr>';
    break;
  }

  // Calcular el mes siguiente
  $fechaUltimaPago->modify('+1 month');

  $fechaUltimaPago->date($fechaUltimaPago);

  // Generar el array de meses a pagar
  $mesesPagar = array();
  $fechaLimite = date('Y-m-d', strtotime('+1 month')); // Fecha límite del día de la consulta
  while ($fechaUltimaPago <= $fechaLimite) {
    $mesesPagar[] = date('Ym', $fechaUltimaPago->getTimestamp());
    $fechaUltimaPago->modify('+1 month');
  }
print_r($fechaUltimaPago);
print_r($fechaLimite);


  // Mostrar los meses a pagar
  foreach ($mesesPagar as $mes) {
  	print_r($mes);
    echo '<tr>
      <td>' . $mes . '</td>
      <td></td>
      <td></td>
      <td></td>
      <td id="monto"></td>
      <td></td>
      <td><input type="checkbox" name="mesesPagar[]" value="' . $mes . '"></td>
    </tr>';
  }

break;








	case 'taxasignada':
		$rspta=$empamb->taxasignada($taseoi);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$empamb->listar($busqueda);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){

 			if ($reg->tipotribute==1){
				$tipos='<span class="badge bg-info">Comercial</span>';
			}
			else{
				$tipos='<span class="badge bg-info">Residencial</span>';
			}


 			$data[]=[
				"0"=>'<button class="btn btn-info">Liquidar</button>',
				"1"=>$tipos,
				"2"=>$reg->direccion,
				"3"=>$reg->fechapago,
				"4"=>$reg->tipotax.'-'.$reg->ramotax.'-'.$reg->categoriatax
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