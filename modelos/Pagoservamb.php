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
	public function declarar($id,$mes,$rfc,$idusuario)
	{
		$sql="CALL IncluirAseo($id,$rfc,$idusuario,'$mes')";
		return ejecutarConsulta($sql);
	}
   


	//Implementamos un método para desactivar Clientes
	public function desactivar($rfc)
	{
		$sql="UPDATE contri_iagesam SET estado ='0' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($rfc)
	{
		$sql="UPDATE contri_iagesam SET estado ='1' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT a.*,t.idt,t.tipotribute,t.tipotax,t.ramotax,t.categoriatax,t.tax FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt WHERE a.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function tramiteporpagar($id)
	{
		$sql="SELECT a.*, (DATE_FORMAT(a.fechapago, '%Y-%m-%d')) AS fpago,t.idt,t.tipotribute,t.tipotax,t.ramotax,t.categoriatax,t.tax FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt WHERE a.id='$id'";
		return ejecutarConsulta($sql);
	}

	public function buscaid($mes,$idreg)
	{
		$sql="SELECT id FROM gaugingaseo WHERE period = '$mes' AND idrelaseo = '$idreg'";
		return ejecutarConsulta($sql);
	}

	public function compararmes($mes,$idreg)
	{
		$sql="SELECT COUNT(*) AS existe FROM gaugingaseo WHERE period = '$mes' AND idrelaseo = '$idreg'";
		return ejecutarConsulta($sql);
	}

	
	//Implementar un método para listar los registros
	public function listar($busqueda)
	{
		$sql="SELECT a.id,a.rfc,t.tipotribute,a.idtambiente,a.direccion,a.fechapago,a.tipotax,t.tipotax,t.ramotax,t.categoriatax,t.tax FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt WHERE rfc=$busqueda ORDER BY a.id DESC";
		return ejecutarConsulta($sql);		
	}




}
?>