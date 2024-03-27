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
	public function insertar($idt,$umtmin,$umtmax,$partida,$detalle)
	{
		$sql="INSERT INTO tributesambiente (`idt`, `detalle`, `umcl`, `partida`, `umtmin`, `umtmax`, `grupot`, `unidadmed`)
		VALUES ('$idt','$detalle',0,'$partida','$umtmin','$umtmax',2,'N/A')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$idt,$umtmin,$umtmax,$partida,$detalle)
	{
		$sql="UPDATE tributesambiente SET 
								   idt='$idt',
								   umtmin='$umtmin',
								   umtmax='$umtmax', 
								   partida='$partida',
								   detalle='$detalle'

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
		$sql="SELECT * FROM tributesambiente WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tributesambiente";
		return ejecutarConsulta($sql);		
	}

}
?>