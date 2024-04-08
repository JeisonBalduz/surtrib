<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Concepto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($codigoubch)
	{
		$sql="SELECT * FROM ubchv WHERE codigoubch='$codigoubch'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT g.*,SUM(electores) AS electores,COUNT(codigoubch) as ubch FROM geovalencia g INNER JOIN ubchv u ON g.idparroquia=u.idparroquia AND g.ideje=u.ideje GROUP BY idgeo";
		return ejecutarConsulta($sql);		
	}
    
	public function mostrarMoneda()
	{
		$sql = "SELECT FORMAT(value, 2) AS ITM FROM currencies WHERE code ='EUR' ";
		$resultado = ejecutarConsulta($sql);
	
		// Obtener el valor de la suma
		$row = $resultado->fetch_assoc();
		$suma = $row["ITM"];
	
		// Retornar la suma como una cadena
		return $suma;		
		 
	}
}


?>