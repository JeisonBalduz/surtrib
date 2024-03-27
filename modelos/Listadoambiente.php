<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empamb
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	
	
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.id,a.rfc,t.tipotribute,a.idtambiente,a.direccion,a.fechapago,a.tipotax,t.tipotax,t.ramotax,t.categoriatax,t.tax,u.name,u.rif FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt LEFT JOIN users u ON a.rfc=u.rfc ORDER BY a.id DESC";
		return ejecutarConsulta($sql);		
	}




}
?>