<?php 
session_start(); 
require_once "../modelos/Comunidad.php";

$comunida=new Comunidad();

$imagen=$_SESSION['imagen'];
$nombre=$_SESSION['nombre'];
$idusuario=$_SESSION['idusuario'];
$idcomunidad=isset($_POST["idcomunidad"])? limpiarCadena($_POST["idcomunidad"]):"";
$comunidad=isset($_POST["comunidad"])? limpiarCadena($_POST["comunidad"]):"";
$codigoubch=isset($_POST["codigoubch"])? limpiarCadena($_POST["codigoubch"]):"";
$nombreubch=isset($_POST["nombreubch"])? limpiarCadena($_POST["nombreubch"]):"";
$idestado=isset($_POST["idestado"])? limpiarCadena($_POST["idestado"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$idmunicipio=isset($_POST["idmunicipio"])? limpiarCadena($_POST["idmunicipio"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$ideje=isset($_POST["ideje"])? limpiarCadena($_POST["ideje"]):"";
$eje=isset($_POST["eje"])? limpiarCadena($_POST["eje"]):"";
$idparroquia=isset($_POST["idparroquia"])? limpiarCadena($_POST["idparroquia"]):"";
$parroquia=isset($_POST["parroquia"])? limpiarCadena($_POST["parroquia"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$mesas=isset($_POST["mesas"])? limpiarCadena($_POST["mesas"]):"";
$electores=isset($_POST["electores"])? limpiarCadena($_POST["electores"]):"";
$nacionalidadjcomunidad=isset($_POST["nacionalidadjcomunidad"])? limpiarCadena($_POST["nacionalidadjcomunidad"]):"";
$cedulajcomunidad=isset($_POST["cedulajcomunidad"])? limpiarCadena($_POST["cedulajcomunidad"]):"";
$nombrejcomunidad=isset($_POST["nombrejcomunidad"])? limpiarCadena($_POST["nombrejcomunidad"]):"";
$apellidojcomunidad=isset($_POST["apellidojcomunidad"])? limpiarCadena($_POST["apellidojcomunidad"]):"";
$operadora1=isset($_POST["operadora1"])? limpiarCadena($_POST["operadora1"]):"";
$telefono1=isset($_POST["telefono1"])? limpiarCadena($_POST["telefono1"]):"";
$operadora2=isset($_POST["operadora2"])? limpiarCadena($_POST["operadora2"]):"";
$telefono2=isset($_POST["telefono2"])? limpiarCadena($_POST["telefono2"]):"";
$correoelectronico=isset($_POST["correoelectronico"])? limpiarCadena($_POST["correoelectronico"]):"";
$direccionjcomunidad=isset($_POST["direccionjcomunidad"])? limpiarCadena($_POST["direccionjcomunidad"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($idcomunidad)){
			$rspta=$comunida->insertar($comunidad,$codigoubch,$nombreubch,$municipio,$idmunicipio,$parroquia,$idparroquia,$eje,$ideje,$direccion,$mesas,$electores,$nacionalidadjcomunidad,$cedulajcomunidad,$nombrejcomunidad,
			$apellidojcomunidad,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjcomunidad);
			echo $rspta ? "Jefe de Comunidad registrado" : "Jefe de Comunidad no se pudo registrar";
		}
		else {
			$rspta=$comunida->editar($idcomunidad,$comunidad,$codigoubch,$nombreubch,$municipio,$idmunicipio,$parroquia,$idparroquia,$eje,$ideje,$direccion,$mesas,$electores,$nacionalidadjcomunidad,$cedulajcomunidad,$nombrejcomunidad,
			$apellidojcomunidad,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjcomunidad);
			echo $rspta ? "Jefe de Comunidad actualizado" : "Jefe de Comunidad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$comunida->desactivar($idcomunidad);
 		echo $rspta ? "Comunidad no registrada" : "Comunidad no se puede cargar";
	break;

	case 'activar':
		$rspta=$comunida->activar($idcomunidad);
 		echo $rspta ? "UBCH registrada" : "UBCH no se puede cargar";
	break;
        
	case 'mostrar':
		$rspta=$comunida->mostrar($idcomunidad);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$comunida->listar($codigoubch);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->idcomunidad.')"><i class="fa fa-user"></i></button>',
 				"1"=>$reg->comunidad,
 				"2"=>$reg->cedulajcomunidad,
			    "3"=>$reg->nombrejcomunidad,
 				"4"=>$reg->operadora1,
 				"5"=>$reg->nombreubch
 				
 				);
				
                
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
	
	case 'selectParroquia':
        require_once "../modelos/Geo.php";
		$parroquia = new Geo();
		$rspta = $parroquia->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idparroquia . '>' . $reg->parroquia . '</option>';
        }
	break;
	

	case 'selectEje':
        require_once "../modelos/Geo.php";
		$eje = new Geo();
		$rspta = $eje->select2($idparroquia);
		$html="";
	foreach ($rspta as $value)
		$html.="<option value='".$value['ideje']."'>".$value['eje']."</option>";
	echo $html;	
	break;

	case 'selectUbch':
        require_once "../modelos/Ubch.php";
		$ubch = new Ubch();
		$rspta = $ubch->select($idparroquia,$ideje);
		$html="";
	foreach ($rspta as $value)
		$html.="<option value='".$value['codigoubch']."'>".$value['nombreubch']."</option>";
	echo $html;	
	break;

}
?>