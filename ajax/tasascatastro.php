<?php 
session_start(); 
require_once "../modelos/Tasascatastro.php";

$tasascatastro=new Tasascatastro();

$iduser=$_SESSION['idusuario'];
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$vidc=isset($_POST["vidc"])? limpiarCadena($_POST["vidc"]):"";
$obs=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";
$busqueda=isset($_POST["busqueda"])? limpiarCadena($_POST["busqueda"]):"";
$unidad=isset($_POST["unidad"])? limpiarCadena($_POST["unidad"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$tasascatastro->insertar($rfc,$vidc,$iduser,$unidad,$obs);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrar";
		}
		else {
			$rspta=$tasascatastro->editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
			echo $rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tasascatastro->desactivar($rfc);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$tasascatastro->activar($rfc);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$tasascatastro->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'tasasadmin':
		$rspta=$tasascatastro->tasasadmin($busqueda);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'selectasas':
		$rspta = $tasascatastro->selectasas();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idc. '>' . $reg->idc. '-' . $reg->detalle. '</option>';
			
        }
	break;

	

}
?>