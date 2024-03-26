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
        
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "doc/pdf")
			{
				$imagen = round($imagen) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("md5",$clave);
        
		if (empty($idusuario)){
			$rspta=$usuarios->insertar($nombre,$direccion,$telefono,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";
		}
		else {
			$rspta=$usuarios->editar($idusuario,$nombre,$direccion,$telefono,$login,$clavehash,$imagen,$_POST['permiso']);
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
    		$rspta=$usuarios->listar();
     		//Vamos a declarar un array
     		$data= Array();
    
     		while ($reg=$rspta->fetch_object()){
     			$data[]=array(
     				"0"=>'',
     				"1"=>$reg->name,
     				"2"=>$reg->usuario,
     				"3"=>$reg->rif,
     				"4"=>$reg->tel,
    				"5"=>$reg->rfc
     				);
     		}
     		$results = array(
     			"sEcho"=>1, //Información para el datatables
     			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
     			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
     			"aaData"=>$data);
     		echo json_encode($results);
    
    break;
    
    case 'listarUsuarioContraseña':
			$rspta=$usuarios->listarCambioContraseña();
			//Vamos a declarar un array
			$data= Array();

			while ($reg=$rspta->fetch_object()){
				$data[]=array(
					"0"=>'<div class="bg-success container-fluid d-flex p-2 rounded justify-content-center "><i class="fa fa-user"></i></div>',
					"1"=>$reg->name,
					"2"=>$reg->usuario,
					"3"=>$reg->tel,
					"4"=>$reg->rif,
					"5"=>'<button class="btn btn-info" id="botonUsuario" onclick="mostrar('.$reg->id.')">Cambio Contraña</button>',
					);
			}
			$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);

		break;

    case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permisos();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuarios->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->permiso.'</li>';
				}
	break;
        
        case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("md5",$clavea);

		$rspta=$usuarios->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
			$_SESSION['idusuario']=$fetch->id;
			$_SESSION['rif']=$fetch->rif;
	        $_SESSION['nombre']=$fetch->name;
			$_SESSION['usuario']=$fetch->usuario;
			$_SESSION['rol']=$fetch->nivel;
			$_SESSION['rfc']=$fetch->rfc;
			$_SESSION['idBitacora']=$fetch->id;
			
	        //Obtenemos los permisos del usuario
	    	$marcados = $usuarios->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
			in_array(2,$valores)?$_SESSION['Clientes']=1:$_SESSION['Clientes']=0;
			in_array(3,$valores)?$_SESSION['Prestamos']=1:$_SESSION['Prestamos']=0;
			in_array(4,$valores)?$_SESSION['Pagos']=1:$_SESSION['Pagos']=0;
			in_array(5,$valores)?$_SESSION['Usuarios']=1:$_SESSION['Usuarios']=0;
			in_array(6,$valores)?$_SESSION['Gastos']=1:$_SESSION['Gastos']=0;
			in_array(7,$valores)?$_SESSION['Consultas']=1:$_SESSION['Consultas']=0;

	    }
	    echo json_encode($fetch);
	break;
        
    case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al loginPrestamos
        header("Location: ../index.php");

	break;
}
?>