<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tasahacienda
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($idt,$partida,$umt,$detalle,$observacion)
	{
		$sql="INSERT INTO tributes (idt,partida,umt,detalle,observacion)
		VALUES ('$idt','$partida','$umt','$detalle','$observacion')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$idt,$partida,$umt,$detalle,$observacion)
	{
		$sql="UPDATE tributes SET 
								   idt='$idt',
								   partida='$partida',
								   umt='$umt', 
								   detalle='$detalle',
								   observacion='$observacion'

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
		$sql="DELETE FROM tributes WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM tributes WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tributes";
		return ejecutarConsulta($sql);		
	}

}
?>