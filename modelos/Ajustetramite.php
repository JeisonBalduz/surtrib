<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ajuste
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	
	
   
	//Implementamos un método para editar registros
	public function editar($id,$period,$totliq,$deferred,$totpag)
	{
		$sql="UPDATE mayor SET 
								  
								  period='$period',
								  totliq='$totliq',
								  deferred='$deferred',
								  totpag='$totpag'
								   
								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($tramite)
	{
		$sql="SELECT m.mcondition,m.id,m.idt,DATE_FORMAT(m.moment, '%d/%m/%y') AS moment,m.totliq,m.deferred,m.totpag,m.mcondition,DATE_FORMAT(m.fpagado, '%d/%m/%y') AS fpagado,m.tramite,u.name,u.rif,u.rfc,t.detalle FROM `mayor` m LEFT JOIN users u ON m.idrfc=u.rfc LEFT JOIN tributes t ON m.idt=t.idt WHERE m.tramite=$tramite";
	    return ejecutarConsulta($sql);		
	}

	public function mostrar($id)
	{
		$sql="SELECT * FROM mayor WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}
	

	public function anular($id)
	{
		$sql="UPDATE mayor SET mcondition ='X', idrfc=1 WHERE id='$id'";
		return ejecutarConsulta($sql);
	}




}
?>