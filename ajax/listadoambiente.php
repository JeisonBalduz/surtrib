<?php 
session_start(); 
require_once "../modelos/Listadoambiente.php";

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
        
	


	case 'listar':

		$rspta=$empamb->listar();
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
				"0"=>$tipos,
				"1"=>$reg->rfc,
				"2"=>$reg->rif.'-'.$reg->name,
				"3"=>$reg->direccion,
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