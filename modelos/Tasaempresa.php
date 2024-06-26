<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Taxempresa
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($idtipotax,$idramotax,$idcategoriatax,$tipotax,$ramotax,$categoriatax,$tax)
	{
		$sql="INSERT INTO taxempresasambiente (idtaxempamb,idtipotax,idramotax,idcategoriatax,tipotax,ramotax,categoriatax,tax,estado)
		VALUES ('$idtipotax','$idramotax','$idcategoriatax','$tipotax','$ramotax','$categoriatax','$tax','1')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($idtaxempamb,$idtipotax,$idramotax,$idcategoriatax,$tipotax,$ramotax,$categoriatax,$tax)
	{
		$sql="UPDATE taxempresasambiente SET 
								   idtipotax='$idtipotax',
								   idramotax='$idramotax',
								   idcategoriatax='$idcategoriatax', 
								   tipotax='$tipotax',
								   ramotax='$ramotax',
								   categoriatax='$categoriatax',
								   tax='$tax'
								   
								   WHERE idtaxempamb='$idtaxempamb'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($idtaxempamb)
	{
		$sql="UPDATE taxempresasambiente SET estado ='0' WHERE idtaxempamb='$idtaxempamb'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idtaxempamb)
	{
		$sql="UPDATE taxempresasambiente SET estado ='1' WHERE idtaxempamb='$idtaxempamb'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtaxempamb)
	{
		$sql="SELECT * FROM taxempresasambiente WHERE idtaxempamb='$idtaxempamb'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM taxempresasambiente";
		return ejecutarConsulta($sql);		
	}

	public function selecttipo()
	{
		$sql="SELECT DISTINCT idtipotax,tipotax FROM taxempresasambiente";
		return ejecutarConsulta($sql);		
	}

	public function selectramo($idtipotax)
	{
		$sql="SELECT DISTINCT idramotax,ramotax FROM taxempresasambiente WHERE idtipotax='$idtipotax'";
		return ejecutarConsulta($sql);		
	}

	public function selectcategoria($idtipotax,$idramotax)
	{
		$sql="SELECT DISTINCT idcategoriatax,categoriatax FROM taxempresasambiente WHERE idtipotax='$idtipotax' AND idramotax='$idramotax'";
		return ejecutarConsulta($sql);			
	}
    
	public function selectasa($idtipotax,$idramotax,$idcategoriatax)
	{
		$sql="SELECT idtaxempamb,tax FROM taxempresasambiente WHERE idtipotax='$idtipotax' AND idramotax='$idramotax' AND idcategoriatax='$idcategoriatax'";
		return ejecutarConsulta($sql);		
	}


}
?>