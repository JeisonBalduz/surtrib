<?php 
session_start(); 
require_once "../modelos/Contri.php";

$contrib=new Contrib();

$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$tiponac=isset($_POST["tiponac"])? limpiarCadena($_POST["tiponac"]):"";
$cedularif=isset($_POST["cedularif"])? limpiarCadena($_POST["cedularif"]):"";
$razsocial=isset($_POST["razsocial"])? limpiarCadena($_POST["razsocial"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$tlf=isset($_POST["tlf"])? limpiarCadena($_POST["tlf"]):"";
$codcel=isset($_POST["codcel"])? limpiarCadena($_POST["codcel"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$modo=isset($_POST["modo"])? limpiarCadena($_POST["modo"]):"";
$estado_pk=isset($_POST["estado_pk"])? limpiarCadena($_POST["estado_pk"]):"";
$municipio_pk=isset($_POST["municipio_pk"])? limpiarCadena($_POST["municipio_pk"]):"";
$parroquia_pk=isset($_POST["parroquia_pk"])? limpiarCadena($_POST["parroquia_pk"]):"";
$ciudad_pk=isset($_POST["ciudad_pk"])? limpiarCadena($_POST["ciudad_pk"]):"";
$sector=isset($_POST["sector"])? limpiarCadena($_POST["sector"]):"";
$calle=isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$edificio=isset($_POST["edificio"])? limpiarCadena($_POST["edificio"]):"";
$numeroedif=isset($_POST["numeroedif"])? limpiarCadena($_POST["numeroedif"]):"";
$medit=isset($_POST["medit"])? limpiarCadena($_POST["medit"]):"";
$representative=isset($_POST["representative"])? limpiarCadena($_POST["representative"]):"";
$addresses=isset($_POST["addresses"])? limpiarCadena($_POST["addresses"]):"";
$code=isset($_POST["code"])? limpiarCadena($_POST["code"]):"";
$registrado=isset($_POST["registrado"])? limpiarCadena($_POST["registrado"]):"";
$conformidaduso=isset($_POST["conformidaduso"])? limpiarCadena($_POST["conformidaduso"]):"";
$tieneinmueble=isset($_POST["tieneinmueble"])? limpiarCadena($_POST["tieneinmueble"]):"";
$taseo=isset($_POST["taseo"])? limpiarCadena($_POST["taseo"]):"";
$texpe=isset($_POST["texpe"])? limpiarCadena($_POST["texpe"]):"";
$tapu=isset($_POST["tapu"])? limpiarCadena($_POST["tapu"]):"";
$tilico=isset($_POST["tilico"])? limpiarCadena($_POST["tilico"]):"";
$pkenumerator=isset($_POST["pkenumerator"])? limpiarCadena($_POST["pkenumerator"]):"";
$contrato=isset($_POST["contrato"])? limpiarCadena($_POST["contrato"]):"";
$viejo=isset($_POST["viejo"])? limpiarCadena($_POST["viejo"]):"";
$ultima_declaracion=isset($_POST["ultima_declaracion"])? limpiarCadena($_POST["ultima_declaracion"]):"";
$estatus=isset($_POST["estatus"])? limpiarCadena($_POST["estatus"]):"";
$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($rfc)){
			$rspta=$contrib->insertar($licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
			echo $rspta ? "Contribuyente registrado" : "Contribuyente no se pudo registrar";
		}
		else {
			$rspta=$contrib->editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
			echo $rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$contrib->desactivar($rfc);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$contrib->activar($rfc);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$contrib->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$contrib->listar($comodinbusqueda);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>($reg->estatus)?'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-user"></i></button>'.
				 ' <button class="btn btn-danger" onclick="desactivar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>':
				 '<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-primary" onclick="activar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>',
				"1"=>($reg->estatus)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
 				"2"=>$reg->rfc,
				"3"=>$reg->licencia,
 				"4"=>$reg->tiponac,
			    "5"=>$reg->cedularif,
 				"6"=>$reg->razsocial,
				"7"=>$reg->correo,
				"8"=>$reg->celular,
 				"9"=>$reg->modo,
			    "10"=>$reg->sector,
 				"11"=>$reg->calle,
				"12"=>$reg->edificio,
				"13"=>$reg->numeroedif,
 				"14"=>$reg->registrado,
			    "15"=>$reg->ultima_declaracion
 				
 				
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