<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Npago
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($tributo,$monto,$tramite,$iduser,$referencia,$imagen,$idtramite)
	{
		 $sw=true;
		$sql="INSERT INTO cpdv (momemt,tributo,monto,discount,deferred,fecha,p,falsedeferred,tramite,ctramite,user_id,ente,vistas, fecha_notifica) VALUES (now(),'$tributo',IF((SELECT SUM(totliq) FROM mayor WHERE tramite=$tramite) > $monto,$monto, (SELECT SUM(totliq) FROM mayor WHERE tramite=$tramite)), '0', IF((SELECT SUM(totliq) FROM mayor WHERE tramite=$tramite) > $monto,$monto, (SELECT SUM(totliq) FROM mayor WHERE tramite=$tramite)) ,curdate(),'D','0',CONCAT('P000', ((SELECT MAX(id) FROM cpdv as cc)+1)), '$tramite','$iduser','0','0',curdate())";
		$cpdv_id=ejecutarConsulta_retornarID($sql);

        $sql_detalle1="INSERT INTO `dtcpdv` (`cpdv_id`, `approval`, `ref`, `ptype`, `mount`, `useamount`, `vfile`) VALUES ('$cpdv_id','N/A','$referencia','1', (SELECT monto FROM cpdv WHERE id=$cpdv_id),'0.00','$imagen')";
		ejecutarConsulta($sql_detalle1) or $sw = false;

		$sql_detalle2="UPDATE `mayor` m INNER JOIN mayor mm ON mm.id=m.id SET m.`deferred`=((mm.deferred)+ (SELECT monto FROM cpdv WHERE id=$cpdv_id)), m.`mcondition`='D' WHERE m.tramite=$tramite";
		ejecutarConsulta($sql_detalle2) or $sw = false;
		
		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idpagoamb,$monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen)
	{
		$sql="UPDATE pagoambiente SET 
								   monto='$monto',
								   tipopago='$tipopago',
								   referencia='$referencia', 
								   fechapago='$fechapago',
								   registro='$registro',
								   idusuarioamb='$idusuarioamb',
								   idusuariosis='$idusuariosis', 
								   idbanco='$idbanco',
								   fechaaprobacion='$fechaaprobacion',
								   imagen='$imagen'
								   
								   WHERE idpagoamb='$idpagoamb'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($idpagoamb)
	{
		$sql="UPDATE pagoambiente SET estado ='0' WHERE idpagoamb='$idpagoamb'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($idpagoamb)
	{
		$sql="UPDATE pagoambiente SET estado ='1' WHERE idpagoamb='$idpagoamb'";
		return ejecutarConsulta($sql);
	}
	

	//Implementar un método para listar los registros
	public function listar($rfc)
	{
		$sql="SELECT DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,m.idt,t.detalle,SUM(m.totliq) AS totliq,SUM(m.deferred) AS montodiferido, (SUM(m.totliq)-SUM(m.deferred)) AS diferencia,SUM(m.descuento) AS descuento,SUM(m.totpag) AS totpag,((SUM(totpag)+SUM(m.descuento))-SUM(totliq)) AS saldo FROM mayor m LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$rfc' GROUP BY m.tramite ORDER BY m.moment DESC";
		return ejecutarConsulta($sql);		
	}

	public function liquidar($tramite)
	{
		$sql="SELECT * FROM mayor WHERE tramite='$tramite'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listardiferido($tramite)
	{
		$sql="SELECT DATE_FORMAT(c.momemt, '%d/%m/%y') AS fecha,d.approval,d.ref,c.tramite AS recibo,d.mount FROM dtcpdv d LEFT JOIN cpdv c ON d.cpdv_id=c.id WHERE c.ctramite='$tramite'";
		return ejecutarConsulta($sql);	
	}

}
?>