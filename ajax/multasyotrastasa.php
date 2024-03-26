<?php 
session_start(); 
require_once "../modelos/Multasyotrastasa.php";

$multas=new Multas();

$iduser=$_SESSION['idusuario'];
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$vidt=isset($_POST["vidt"])? limpiarCadena($_POST["vidt"]):"";
$obs=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";
$resolucion=isset($_POST["resolucion"])? limpiarCadena($_POST["resolucion"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$tlf=isset($_POST["tlf"])? limpiarCadena($_POST["tlf"]):"";
$busqueda=isset($_POST["busqueda"])? limpiarCadena($_POST["busqueda"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($id)){
			$rspta=$multas->insertar($rfc,$vidt,$iduser,$resolucion,$monto,$obs);
			echo $rspta ? "Tasa registrada" : "Tasa no se pudo registrar";
		}
		else {
			$rspta=$contrih->editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
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
		$rspta=$tasasadm->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'tasasadmin':
		$rspta=$multas->tasasadmin($busqueda);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'selectasas':
		$rspta = $multas->selectasas();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idt. '>' . $reg->idt. '-' . $reg->detalle. '</option>';
			
        }
	break;

	

}
?>