<?php 
session_start(); 
require_once "../modelos/Cargarcvs.php";

$cvs=new Cvs();

$tamanio=isset($_POST["tamanio"])? limpiarCadena($_POST["tamanio"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$archivotmp=isset($_POST["archivotmp"])? limpiarCadena($_POST["archivotmp"]):"";
$lineas=isset($_POST["lineas"])? limpiarCadena($_POST["lineas"]):"";

switch ($_GET["op"]){
        
	case 'uploadContacts':


		$tipo       = $_FILES['dataCliente']['type'];
		$tamanio    = $_FILES['dataCliente']['size'];
		$archivotmp = $_FILES['dataCliente']['tmp_name'];
		$lineas     = file($archivotmp);
		
		$i = 0;
		$d = 0;
		$n = 0;
		
		foreach ($lineas as $linea) {
			$cantidad_registros = count($lineas);
			$cantidad_regist_agregados =  ($cantidad_registros - 1);
		
			if ($i != 0) {
		
				$datos = explode(";", $linea);
			   
				$nombre                = !empty($datos[0])  ? ($datos[0]) : '';
				$correo                = !empty($datos[1])  ? ($datos[1]) : '';
				$celular               = !empty($datos[2])  ? ($datos[2]) : '';
			   
				if( !empty($celular) ){
					$checkemail_duplicidad = ("SELECT celular FROM clientes WHERE celular='".($celular)."' ");
					$ca_dupli = mysqli_query($con, $checkemail_duplicidad);
					$cant_duplicidad = mysqli_num_rows($ca_dupli);
				}   
		
							//No existe Registros Duplicados
				if ( $cant_duplicidad == 0 ) { 
				 $insertarData = "INSERT INTO clientes(nombre,correo,celular) VALUES('$nombre','$correo','$celular')";
				mysqli_query($con, $insertarData);
				$n++;
				} 
		
					/**Caso Contrario actualizo el o los Registros ya existentes*/
					else{
					$updateData =  ("UPDATE clientes SET nombre='" .$nombre. "',correo='" .$correo. "',celular='" .$celular. "'  WHERE celular='".$celular."'");
					$result_update = mysqli_query($con, $updateData);
					$d++;
				} 
		  }
		
			$i++;

        

	break;





}
?>