<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class actividadecinomica
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	
	public function listar($rfc)
	{
		$sql="SELECT * FROM company_patent WHERE rfc='$rfc'";
		//die($sql);
		return ejecutarConsulta($sql);		
	}
    
	public function pagartaquilla($id_mayor,$tramite,$txtreferencia,$txtaprobado,$txtmonto)
	{
		/*$sql="SELECT u.rif AS rif,u.id AS idusuario,u.name AS nombreusuario,u.rfc,v.id AS idv,v.rfc AS rfc, v.registered,v.idtvehiculo,v.licenseplate,v.marca,v.modelos,v.puestos,v.pesos,v.anio,v.fechacompra,t.id AS idtv,t.idt,t.detalle FROM vehicle v LEFT JOIN tributes t ON v.idtvehiculo=t.id LEFT JOIN users u ON u.rfc=v.rfc WHERE v.id='$id'";
		return ejecutarConsultaSimpleFila($sql);*/
	}

	public function listarcontribuyentes()
	{
		$sql="SELECT `rfc`,`tiponac`,`cedularif`,`razsocial` FROM `citizen` WHERE `estatus`='A'";

		return ejecutarConsulta($sql);
	}
	public function listardeudacontribuyente($idrfc)
	{
		//$sql="SELECT `rfc`,`tiponac`,`cedularif`,`razsocial` FROM `citizen` WHERE `estatus`='A'";

		$sql="SELECT m.id,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,m.idt,t.detalle,m.totliq,SUM(d.mount) AS montodiferido, (m.totliq-SUM(d.mount)) AS diferencia,m.descuento,m.totpag,(totpag-totliq) AS saldo FROM mayor m LEFT JOIN cpdv c ON c.ctramite=m.tramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$idrfc' AND ((m.totpag+m.descuento)<m.totliq) GROUP BY m.id ORDER BY fechaliq ASC";
		return ejecutarConsulta($sql);
	}

	
	public function select()
	{
		$sql="SELECT * FROM contrihacienda";
		return ejecutarConsulta($sql);		
	}

	



}
?>