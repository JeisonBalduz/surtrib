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
	public function editar($id,$rfc2,$tramite2,$periodoviejo,$montoliqviejo,$montodifviejo,$montopagviejo,$periodonuevo,$montoliqnuevo,$montodifnuevo,$montopagnuevo,$obs,$iduser)
	{
		
      $sw=true;

		$sql="INSERT INTO `gaugingadjustmentramicsurtrib` (`tramite`,`rfc`, `moment`, `montoliqviejo`, `montoliqnuevo`, `montodifviejo`, `montodifnuevo`, `montopagviejo`, `montopagnuevo`, `obs`, `peridoviejo`, `peridonuevo`, `iduser`) VALUES ('$tramite2','$rfc2',now(),'$montoliqviejo','$montoliqnuevo','$montodifviejo','$montodifnuevo','$montopagviejo','$montopagnuevo','$obs','$periodoviejo','$periodonuevo','$iduser')";
		ejecutarConsulta($sql);

		$sql="UPDATE mayor SET 
								  
								  period='$periodonuevo',
								  totliq='$montoliqnuevo',
								  deferred='$montodifnuevo',
								  totpag='$montopagnuevo'
								   
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
	

	public function anular($id,$rfc,$tramite,$iduser,$totliq)

	{

     $sql="INSERT INTO `gaugingtramiteseliminados`(`tramite`, `rfc`, `moment`,`iduser`,`amount`) VALUES ('$tramite','$rfc',now(),'$iduser','$totliq')";
	ejecutarConsulta($sql);

		$sql="UPDATE mayor SET mcondition ='X', idrfc=1 WHERE id='$id'";
		return ejecutarConsulta($sql);
	}


}
?>