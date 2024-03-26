<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Moneda
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($nombremoneda,$codigomoneda,$symbol_left,$symbol_right,$decimal_point,$thousands_point,$decimal_places,$value,$mcref,$principal,$last_updated)
	{
		$sql="INSERT INTO currencies (nombremoneda,codigomoneda,symbol_left,symbol_right,decimal_point,thousands_point,decimal_places,value,mcref,principal,last_updated,estado)
		VALUES ('$nombremoneda','$codigomoneda','$symbol_left','$symbol_right','$decimal_point','$thousands_point','$decimal_places','$value','$mcref','$principal','$last_updated','1')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($idmoneda,$value)
	{
		$sql="UPDATE `currencies` SET `value`='$value' WHERE id='$idmoneda'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($idmoneda)
	{
		$sql="UPDATE currencies SET estado ='0' WHERE idmoneda='$idmoneda'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idmoneda)
	{
		$sql="UPDATE currencies SET estado ='1' WHERE idmoneda='$idmoneda'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmoneda)
	{
		$sql="SELECT * FROM currencies WHERE id='$idmoneda'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM currencies";
		return ejecutarConsulta($sql);		
	}

	public function select($idmoneda)
	{
		$sql="SELECT * FROM currencies WHERE idmoneda='$idmoneda'";
		return ejecutarConsulta($sql);		
	}

}
?>