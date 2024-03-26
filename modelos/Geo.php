<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Geo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM geovalencia";
		return ejecutarConsulta($sql);		
	}
	
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT DISTINCT idparroquia,parroquia FROM geovalencia";
		return ejecutarConsulta($sql);		
	}
	
	public function select2($idparroquia)
	{
		$sql="SELECT DISTINCT ideje,eje FROM geovalencia WHERE idparroquia='$idparroquia'";
		return ejecutarConsulta($sql);		
	}

}


?>