<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Activeco
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($codigo_grupo,$detalles,$alicuota,$umt,$DECRETO)
	{
		$sql="INSERT INTO activities (codigo_grupo,detalles,alicuota,umt,DECRETO)
		VALUES ('$codigo_grupo','$detalles','$alicuota','$umt','$DECRETO')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$codigo_grupo,$detalles,$alicuota,$umt,$DECRETO)
	{
		$sql="UPDATE activities SET 
								   codigo_grupo='$codigo_grupo',
								   detalles='$detalles',
								   alicuota='$alicuota', 
								   umt='$umt',
								   DECRETO='$DECRETO'

								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($id)
	{
		$sql="UPDATE activitiesh SET estado ='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($id)
	{
		$sql="UPDATE activitiesh SET estado ='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($id)
	{
		$sql="DELETE FROM `activities` WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM activities WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM activities";
		return ejecutarConsulta($sql);		
	}

}
?>