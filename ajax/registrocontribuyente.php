<?php 
session_start(); 
require_once "../modelos/Usuarios.php";

$usuarios=new Usuarios();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$tipodocumento=isset($_POST["tipodocumento"])? limpiarCadena($_POST["tipodocumento"]):"";
$numerodocumento=isset($_POST["numerodocumento"])? limpiarCadena($_POST["numerodocumento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefonousuario=isset($_POST["telefonousuario"])? limpiarCadena($_POST["telefonousuario"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$direccionusuario=isset($_POST["direccionusuario"])? limpiarCadena($_POST["direccionusuario"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$rol=isset($_POST["rol"])? limpiarCadena($_POST["rol"]):"";

switch ($_GET["op"]){
        
	case 'guardaryeditar':
        
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
        
		if (empty($idusuario)){
			$rspta=$usuarios->insertar2($nombre,$direccion,$telefono,$login,$clavehash,$imagen);
			echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";
		}
		else {
			$rspta=$usuarios->editar($idusuario,$nombre,$direccion,$telefono,$login,$clavehash,$imagen);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuarios->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuarios->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;
        
	case 'mostrar':
		$rspta=$usuarios->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

case 'listar':
		$rspta=$usuarios->listar2();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-info" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-user"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-edit"></i></button>':
 					'<button class="btn btn-info" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-edit"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>($reg->estado)?'<span class="badge bg-primary">Activado</span>':'<span class="badge bg-danger">Desactivado</span>'
 				);
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