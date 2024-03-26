<?php 
session_start(); 
require_once "../modelos/Registro.php";

$registro=new Registro();

$tipodocumento=isset($_POST["tipodocumento"])? limpiarCadena($_POST["tipodocumento"]):"";
$numerodocumento=isset($_POST["numerodocumento"])? limpiarCadena($_POST["numerodocumento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefonousuario=isset($_POST["telefonousuario"])? limpiarCadena($_POST["telefonousuario"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$rol=isset($_POST["rol"])? limpiarCadena($_POST["rol"]):"";
$logina=isset($_POST["logina"])? limpiarCadena($_POST["logina"]):"";


switch ($_GET["op"]){
	
	case 'guardar':
		$clavehash=hash("md5",$clave);
			$rspta=$registro->insertar($tipodocumento,$numerodocumento,$nombre,$email,$telefonousuario,$clavehash);
			echo json_encode($rspta);
	break;


	case 'buscarnombre':
		$rspta=$registro->buscarnombre($nombre);
		echo json_encode($rspta);
	break;


	case 'verificarlogina':

		
		$rspta=$registro->verificarlogina($logina);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
			
			$_SESSION['login']=$fetch->login;

	    }
	    echo json_encode($fetch);
	break;

	case 'verificarnumerodocumento':

		
		$rspta=$registro->verificarnumerodocumento($numerodocumento);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
			
			$_SESSION['numerodocumento']=$fetch->numerodocumento;

	    }
	    echo json_encode($fetch);
	break;

	
}
?>