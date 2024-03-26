<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Liquicatastro
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}

	public function insertartramitemv($id,$rfc,$idtc,$iduser,$metros)
	{

		$sql= "SELECT `GenerarTramite`('$rfc') AS `GenerarTramite`";
		$t = ejecutarConsultaSimpleFila($sql);
		$tramite = $t[];


       $sql= "SELECT CalcularPagoCatastro($idtc,$metros) AS monto";
	   $m = ejecutarConsultaSimpleFila($sql);
	   $monto = $m[];


	   $sql1= "INSERT INTO gaugingpenalty (tramite,rfc,moment, amount,femision) VALUES ('$tramite','$rfc',now(),'$monto',now())";
	   ejecutarConsulta($sql1);

	   $sql4= "INSERT INTO receipts (`moment`,`idtramitep`,`benefitoflaw`,`idtprimary`) VALUES (now(),'$tramite',0,1011)";
	   ejecutarConsulta($sql4);

	   $sql2= "INSERT INTO mayor (`moment`,`period`,`idrfc`,`idt`,`totliq`,`tramite`,`id_user`) VALUES (now(), YEAR(NOW()),'$rfc',1011,'$monto','$tramite','$iduser')";
	   ejecutarConsulta($sql2);

	   $sql3= "UPDATE `catastro` SET `tramite`='$tramite',`estado`='0' WHERE `id`='$id'";
	   ejecutarConsulta($sql3);
	}
 
	public function mostrar($id)
	{
		$sql="SELECT c.id,c.rfc,u.id AS iduser,u.name,u.rif,u.name,t.detalle,c.idtc,c.metros FROM catastro c LEFT JOIN tributescatastro t ON c.idtc=t.idc LEFT JOIN users u ON u.rfc=c.rfc WHERE c.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrartaxcat()
	{
		$sql="SELECT idc,detalle FROM tributescatastro";
		return ejecutarConsulta($sql);
	}


	public function listar($rfc)
	{
		$sql="SELECT c.id,c.registered,c.tramite,c.metros,c.estado,u.name,u.rfc,u.rif,t.idc,t.detalle FROM catastro c LEFT JOIN users u ON u.rfc=c.rfc LEFT JOIN tributescatastro t ON c.idtc=t.idc";
	    return ejecutarConsulta($sql);		
	}


}
?>