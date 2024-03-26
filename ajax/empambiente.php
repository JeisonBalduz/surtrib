<?php 
session_start(); 
require_once "../modelos/Empambiente.php";

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
$docrif=isset($_POST["docrif"])? limpiarCadena($_POST["docrif"]):"";
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
$idtzona=isset($_POST["idtzona"])? limpiarCadena($_POST["idtzona"]):"";
$idzona=isset($_POST["idzona"])? limpiarCadena($_POST["idzona"]):"";


switch ($_GET["op"]){
        
	case 'guardaryeditar':

		 if (!file_exists($_FILES['docrif']['tmp_name']) || !is_uploaded_file($_FILES['docrif']['tmp_name']))
		{
			$docrif=$_POST["docrifactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["docrif"]["name"]);
			if ($_FILES['docrif']['type'] == "image/jpg" || $_FILES['docrif']['type'] == "image/jpeg" || $_FILES['docrif']['type'] == "image/png" || $_FILES['docrif']['type'] == "application/pdf")
			{
				$docrif = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["docrif"]["tmp_name"], "../files/docempamb/docrif/" . $docrif);
			}
		}

		if (!file_exists($_FILES['docregistro']['tmp_name']) || !is_uploaded_file($_FILES['docregistro']['tmp_name']))
		{
			$docregistro=$_POST["docregistroactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["docregistro"]["name"]);
			if ($_FILES['docregistro']['type'] == "image/jpg" || $_FILES['docregistro']['type'] == "image/jpeg" || $_FILES['docregistro']['type'] == "image/png" || $_FILES['docregistro']['type'] == "application/pdf")
			{
				$docregistro = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["docregistro"]["tmp_name"], "../files/docempamb/docregistro/" . $docregistro);
			}
		}

		if (empty($rfc)){
			$rspta=$empamb->insertar($rif,$licencia,$medit);
			echo $rspta ? "Empresa o Sucursal registrada" : "Empresa o Sucursal no se pudo registrarse";
		}
		else {
			$rspta=$empamb->editar($rfc,$idusuario,$licencia,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$docrif,$docregistro,$registrado,
									$conformidaduso,$tieneinmueble,$taseoi,$ultima_declaracion);
			echo $rspta ? "Empresa o Sucursal actualizada" : "ContrEmpresa o Sucursal no se pudo actualizarse";
		}
	break;

	case 'insertar2':
		$rspta=$empamb->insertar($rif,$licencia,$medit);
			echo $rspta ? "Empresa o Sucursal registrada" : "Empresa o Sucursal no se pudo registrarse";
	break;


	case 'desactivar':
		$rspta=$empamb->desactivar($rfc);
 		echo $rspta ? "Empresa o Sucursal desactivada" : "Empresa o Sucursal no se pudo desactivar";
	break;

	case 'editarTax':
		$rspta=$empamb->editarTax($rfc,$taseoi);
 		echo $rspta ? "Tasa actualizada" : "Tasa no se puedo actualizar";
	break;

	

	case 'activar':
		$rspta=$empamb->activar($rfc);
 		echo $rspta ? "Empresa o Sucursal activado" : "Empresa o Sucursal no se pudo activar";
	break;
        
	case 'mostrarp':
		$rspta=$empamb->mostrarp($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrar':
		$rspta=$empamb->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		if ($_SESSION['rol']==1){
		$rspta=$empamb->listar($idusuario);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				"0"=>'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-user"></i></button>',
				"1"=>($reg->estado)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
				"2"=>$reg->licencia,
 				"3"=>$reg->sector,
			    "4"=>$reg->medit,
				"5"=>$reg->ultima_declaracion,
				"6"=>"<a  href='../files/docempamb/docrif/".$reg->docrif."' download>Ver</a>",
 				"7"=>"<a  href='../files/docempamb/docregistro/".$reg->docregistro."' download>Ver</a>",
				"8"=>$reg->taseoi
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
        
	}
	else {

		$rspta=$empamb->listar2($busqueda);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				"0"=>($reg->ESTADO)?'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-info" onclick="activar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>',
				 "1"=>($reg->ESTADO)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
				 "2"=>$reg->licencia,
				  "3"=>$reg->sector,
				 "4"=>$reg->medit,
				 "5"=>$reg->ultima_declaracion,
				 "6"=>"<a  href='../files/docempamb/docrif/".$reg->docrif."' download>Ver</a>",
				  "7"=>"<a  href='../files/docempamb/docregistro/".$reg->docregistro."' download>Ver</a>",
				 "8"=>$reg->ramotax."-".$reg->categoriatax."-".$reg->tipotax
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 	 	echo json_encode($results);
       }

	break;

	case 'listar2':

		$rspta=$empamb->listar3($busqueda);
 		//Vamos a declarar un array
 		$data= Array();
		 
 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
				"0"=>($reg->ESTADO)?'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>':
				'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-info" onclick="activar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>',
				 "1"=>($reg->ESTADO)?'<span class="badge bg-primary">Activo</span>':'<span class="badge bg-danger">Desactivo</span>',
				 "2"=>$reg->licencia,
				  "3"=>$reg->sector,
				 "4"=>$reg->medit,
				 "5"=>$reg->ultima_declaracion,
				 "6"=>"<a  href='../files/docempamb/docrif/".$reg->docrif."' download>Ver</a>",
				  "7"=>"<a  href='../files/docempamb/docregistro/".$reg->docregistro."' download>Ver</a>",
				 "8"=>$reg->tzona."-".$reg->zona
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 	 	echo json_encode($results);

	break;



	case 'selecttipon':
        require_once "../modelos/Tasaresidencias.php";
		$taxresidencia = new Taxresidencia();
		$rspta = $taxresidencia->selecttipo();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtzona . '>' . $reg->tzona. '</option>';
        }
	break;

	case 'selectzona':
        require_once "../modelos/Tasaresidencias.php";
		$taxresidencia = new Taxresidencia();
		$rspta = $taxresidencia->selectzona($idtzona);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idzona . '>' . $reg->zona. '</option>';
        }
	break;

	case 'selecttasaresidencial':
        require_once "../modelos/Tasaresidencias.php";
		$taxresidencia = new Taxresidencia();
		$rspta = $taxresidencia->selecttasaresidencial($idtzona,$idzona);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtaxresidencia . '>' . $reg->tasazona. '</option>';
        }
	break;

	case 'selecttipo':
        require_once "../modelos/Tasaempresa.php";
		$taxempresa = new Taxempresa();
		$rspta = $taxempresa->selecttipo();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtipotax . '>' . $reg->tipotax. '</option>';
        }
	break;
    
	case 'selectramo':
        require_once "../modelos/Tasaempresa.php";
		$taxempresa = new Taxempresa();
		$rspta = $taxempresa->selectramo($idtipotax);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idramotax . '>' . $reg->ramotax. '</option>';
        }
	break;

	case 'selectcategoria':
        require_once "../modelos/Tasaempresa.php";
		$taxempresa = new Taxempresa();
		$rspta = $taxempresa->selectcategoria($idtipotax,$idramotax);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idcategoriatax . '>' . $reg->categoriatax. '</option>';
        }
	break;

	case 'selectasa':
        require_once "../modelos/Tasaempresa.php";
		$taxempresa = new Taxempresa();
		$rspta = $taxempresa->selectasa($idtipotax,$idramotax,$idcategoriatax);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idtaxempamb . '>' . $reg->tax. '</option>';
        }
	break;

	case 'selectUsuario':
        require_once "../modelos/Usuarios.php";
		$usuarios = new Usuarios();
		$rspta = $usuarios->selectUsuario();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->numerodocumento . '>'. $reg->tipodocumento.' '.$reg->numerodocumento.' '.$reg->nombre. '</option>';
        }
	break;

	case 'selectUsuario2':
        require_once "../modelos/Usuarios.php";
		$usuarios = new Usuarios();
		$rspta = $usuarios->selectUsuario2();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->numerodocumento . '>'. $reg->tipodocumento.' '.$reg->numerodocumento.' '.$reg->nombre. '</option>';
        }
	break;


}
?>