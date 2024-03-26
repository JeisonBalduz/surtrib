<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Actividadead
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($rfc,$actividad)
	{
		$sql="INSERT INTO `relcompanyactivity` (`rfc`, `actividad`, `decreto`) VALUES ('$rfc','$actividad','NO')";
		return ejecutarConsulta($sql);
	}

	public function insertar2($rfc,$actividad)
	{
		$sql="INSERT INTO `relcompanyactivity` (`rfc`, `actividad`, `decreto`) VALUES ('$rfc','$actividad','NO')";
		return ejecutarConsulta($sql);
	}

   
	//Implementamos un método para editar registros
	public function editar($id,$actividad)
	{
		$sql="UPDATE relcompanyactivity SET 
								  
								  actividad='$actividad'
								   
								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($rfc)
	{
		$sql="SELECT * FROM relcompanyactivity r LEFT JOIN activities a ON r.actividad=a.id WHERE rfc='$rfc'";
	    return ejecutarConsulta($sql);		
	}

	public function mostrar($id)
	{
		$sql="SELECT r.*,a.codigo_grupo,a.detalles,a.alicuota,a.DECRETO FROM `relcompanyactivity` r LEFT JOIN activities a ON r.actividad=a.id WHERE r.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}
	

	public function listaractividad()
	{
		$sql="SELECT * FROM activities WHERE DECRETO='NO'";
	    return ejecutarConsulta($sql);		
	}

	public function listaractividad2()
	{
		$sql="SELECT * FROM activities";
	    return ejecutarConsulta($sql);		
	}
	
	public function listarad($rfc2)
	{
		$sql="SELECT r.id,r.rfc,r.actividad,a.detalles,a.codigo_grupo FROM relcompanyactivity r LEFT JOIN activities a ON r.actividad=a.id WHERE r.rfc='$rfc2'";
	    return ejecutarConsulta($sql);		
	}




}
?>