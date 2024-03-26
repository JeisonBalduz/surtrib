<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Taxresidencia
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($idtzona,$idzona,$tzona,$zona,$tasazona)
	{
		$sql="INSERT INTO taxresidenciaambiente (idtzona,idzona,tzona,zona,tasazona,estado)
		VALUES ('$idtzona','$idzona','$tzona','$zona','$tasazona','1')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($idtaxresidencia,$idtzona,$idzona,$tzona,$zona,$tasazona)
	{
		$sql="UPDATE taxresidenciaambiente SET 
								   idtzona='$idtzona',
								   idzona='$idzona',
								   tzona='$tzona', 
								   zona='$zona',
								   tasazona='$tasazona'
								   
								   WHERE idtaxresidencia='$idtaxresidencia'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($idtaxresidencia)
	{
		$sql="UPDATE taxresidenciaambiente SET estado ='0' WHERE idtaxresidencia='$idtaxresidencia'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idtaxresidencia)
	{
		$sql="UPDATE taxresidenciaambiente SET estado ='1' WHERE idtaxresidencia='$idtaxresidencia'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtaxresidencia)
	{
		$sql="SELECT * FROM taxresidenciaambiente WHERE idtaxresidencia='$idtaxresidencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM taxresidenciaambiente";
		return ejecutarConsulta($sql);		
	}

	public function select($idtaxresidencia)
	{
		$sql="SELECT * FROM taxresidenciaambiente WHERE idtaxresidencia='$idtaxresidencia'";
		return ejecutarConsulta($sql);		
	}


	public function selecttipo()
	{
		$sql="SELECT DISTINCT idtzona,tzona FROM taxresidenciaambiente";
		return ejecutarConsulta($sql);		
	}

	public function selectzona($idtzona)
	{
		$sql="SELECT DISTINCT idzona,zona FROM taxresidenciaambiente WHERE idtzona='$idtzona'";
		return ejecutarConsulta($sql);		
	}

	public function selecttasaresidencial($idtzona,$idzona)
	{
		$sql="SELECT idtaxresidencia,tasazona FROM taxresidenciaambiente WHERE idtzona='$idtzona' AND idzona='$idtzona'";
		return ejecutarConsulta($sql);			
	}
    
}
?>