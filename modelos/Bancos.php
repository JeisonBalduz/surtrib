<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Bancos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($nombre,$status,$rif,$codigo)
	{
		$sql="INSERT INTO banco (nombre,status,rif,codigo,estado)
		VALUES ('$nombre','$status','$rif','$codigo','1')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$nombre,$status,$rif,$codigo)
	{
		$sql="UPDATE banco SET 
								   nombre='$nombre',
								   status='$status',
								   rif='$rif', 
								   codigo='$codigo'
								   
								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($id)
	{
		$sql="UPDATE banco SET estado ='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($id)
	{
		$sql="UPDATE banco SET estado ='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM banco WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM banco";
		return ejecutarConsulta($sql);		
	}

	public function select()
	{
		$sql="SELECT * FROM banco WHERE estado='1'";
		return ejecutarConsulta($sql);		
	}

}
?>