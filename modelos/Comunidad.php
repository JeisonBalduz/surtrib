<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Comunidad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementamos un método para insertar registros
	public function insertar($comunidad,$codigoubch,$nombreubch,$municipio,$idmunicipio,$parroquia,$idparroquia,$eje,$ideje,$direccion,$mesas,$electores,$nacionalidadjcomunidad,$cedulajcomunidad,$nombrejcomunidad,
	                         $apellidojcomunidad,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjcomunidad)
	{
		$sql="INSERT INTO comunidadesv (comunidad,codigoubch,nombreubch,municipio,idmunicipio,parroquia,idparroquia,eje,ideje,direccion,mesas,electores,nacionalidadjcomunidad,cedulajcomunidad,nombrejcomunidad,
		apellidojcomunidad,operadora1,telefono1,operadora2,telefono2,correoelectronico,direccionjcomunidad,estado)
		VALUES ('$comunidad','$codigoubch','$nombreubch','$municipio','$idmunicipio','$parroquia','$idparroquia','$eje','$ideje','$direccion,$mesas','$electores','$nacionalidadjcomunidad','$cedulajcomunidad','$nombrejcomunidad',
	                         '$apellidojcomunidad','$operadora1','$telefono1','$operadora2','$telefono2','$correoelectronico','$direccionjcomunidad','1')";
		return ejecutarConsulta($sql);
	}
    
	//Implementamos un método para editar registros
	public function editar($idcomunidad,$comunidad,$codigoubch,$nombreubch,$municipio,$idmunicipio,$parroquia,$idparroquia,$eje,$ideje,$direccion,$mesas,$electores,$nacionalidadjcomunidad,$cedulajcomunidad,$nombrejcomunidad,
	$apellidojcomunidad,$operadora1,$telefono1,$operadora2,$telefono2,$correoelectronico,$direccionjcomunidad)
	{
		$sql="UPDATE comunidadesv SET 
		                           comunidad='$comunidad',
		                           eje='$eje',
								   ideje='$ideje',
								   nacionalidadjcomunidad='$nacionalidadjcomunidad',
								   cedulajcomunidad='$cedulajcomunidad',
								   nombrejcomunidad='$nombrejcomunidad',
								   apellidojcomunidad='$apellidojcomunidad', 
								   operadora1='$operadora1',
								   telefono1='$telefono1',
								   operadora2='$operadora2',
								   telefono2='$telefono2', 
								   correoelectronico='$correoelectronico',
								   direccionjcomunidad='$direccionjcomunidad'
								   
								   WHERE idcomunidad='$idcomunidad'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($idcomunidad)
	{
		$sql="UPDATE comunidadesv SET estado ='0' WHERE idcomunidad='$idcomunidad'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idcomunidad)
	{
		$sql="UPDATE comunidadesv SET estado ='1' WHERE idcomunidad='$idcomunidad'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcomunidad)
	{
		$sql="SELECT * FROM comunidadesv WHERE idcomunidad='$idcomunidad'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($codigoubch)
	{

		$sql="SELECT * FROM comunidadesv WHERE codigoubch='$codigoubch'";
		return ejecutarConsulta($sql);		
	}
    
}
?>