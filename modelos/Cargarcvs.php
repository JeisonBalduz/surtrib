<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cvs
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function uploadContacts($lineas)
	{










		
		$sql="INSERT INTO banco (nombre,status,rif,codigo,estado)
		VALUES ('$nombre','$status','$rif','$codigo','1')";
		return ejecutarConsulta($sql);
	}
   


}
?>