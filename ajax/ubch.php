<?php 
session_start(); 
require_once "../modelos/Ubch.php";

$ubch=new Ubch();

$imagen=$_SESSION['imagen'];
$nombre=$_SESSION['nombre'];
$idusuario=$_SESSION['idusuario'];
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
$nacionalidadjubch=isset($_POST["nacionalidadjubch"])? limpiarCadena($_POST["nacionalidadjubch"]):"";
$cedulajubch=isset($_POST["cedulajubch"])? limpiarCadena($_POST["cedulajubch"]):"";
$nombrejubch=isset($_POST["nombrejubch"])? limpiarCadena($_POST["nombrejubch"]):"";
$apellidojubch=isset($_POST["apellidojubch"])? limpiarCadena($_POST["apellidojubch"]):"";
$operadora1=isset($_POST["operadora1"])? limpiarCadena($_POST["operadora1"]):"";
$telefono1=isset($_POST["telefono1"])? limpiarCadena($_POST["telefono1"]):"";
$operadora2=isset($_POST["operadora2"])? limpiarCadena($_POST["operadora2"]):"";
$telefono2=isset($_POST["telefono2"])? limpiarCadena($_POST["telefono2"]):"";
$correoelectronico=isset($_POST["correoelectronico"])? limpiarCadena($_POST["correoelectronico"]):"";
$direccionjubch=isset($_POST["direccionjubch"])? limpiarCadena($_POST["direccionjubch"]):"";
$sindicato=isset($_POST["sindicato"])? limpiarCadena($_POST["sindicato"]):"";
$ctp=isset($_POST["ctp"])? limpiarCadena($_POST["ctp"]):"";
$prevencion=isset($_POST["prevencion"])? limpiarCadena($_POST["prevencion"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($codigoubch)){
			$rspta=$ubch->insertar($nombreubch,$municipio,$idmunicipio,$parroquia,$idparroquia,$direccion,$mesas,$electores,$nacionalidadjubch,$cedulajubch,$nombrejubch,
	                         $apellidojubch,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjubch,$sindicato,$ctp,$prevencion,$estado);
			echo $rspta ? "Jefe de UBCH registrado" : "Jefe de UBCH no se pudo registrar";
		}
		else {
			$rspta=$ubch->editar($codigoubch,$nacionalidadjubch,$cedulajubch,$nombrejubch,$apellidojubch,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjubch,$sindicato,$ctp,$prevencion);
			echo $rspta ? "Jefe de UBCH actualizado" : "Jefe de UBCH no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ubch->desactivar($codigoubch);
 		echo $rspta ? "UBCH no registrada" : "UBCH no se puede cargar";
	break;

	case 'activar':
		$rspta=$ubch->activar($codigoubch);
 		echo $rspta ? "UBCH registrada" : "UBCH no se puede cargar";
	break;
        
	case 'mostrar':
		$rspta=$ubch->mostrar($codigoubch);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$ubch->listar($idparroquia,$ideje);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->codigoubch.')"><i class="fa fa-user"></i></button>',
 				"1"=>$reg->nombreubch,
 				"2"=>$reg->cedulajubch,
			    "3"=>$reg->nombrejubch,
 				"4"=>$reg->telefono1,
				"5"=>$reg->electores,
 				
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

}
?>