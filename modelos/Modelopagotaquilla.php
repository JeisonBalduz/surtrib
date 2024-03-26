<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class PagoTaqulla
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	
    
	public function pagartaquilla($id_mayor,$idt,$tramite,$txtreferencia,$txtaprobado,$txtmonto,$iduser)
	{
		/*$sql="SELECT u.rif AS rif,u.id AS idusuario,u.name AS nombreusuario,u.rfc,v.id AS idv,v.rfc AS rfc, v.registered,v.idtvehiculo,v.licenseplate,v.marca,v.modelos,v.puestos,v.pesos,v.anio,v.fechacompra,t.id AS idtv,t.idt,t.detalle FROM vehicle v LEFT JOIN tributes t ON v.idtvehiculo=t.id LEFT JOIN users u ON u.rfc=v.rfc WHERE v.id='$id'";*/
	//	$sql="INSERT INTO `cpdv`( `momemt`, `tributo`, `monto`, `discount`, `deferred`, `fecha`, `p`, `falsedeferred`, `tramite`, `ctramite`, `user_id`, `ente`, `vistas`, `fecha_notifica`) VALUES (CURRENT_TIMESTAMP,$idt,$txtmonto,$txtaprobado,0.00,CURDATE(),'C',0,'P','$tramite',$iduser,0,0,NULL)";
		$sql="INSERT INTO `cpdv`( `momemt`, `tributo`, `monto`, `discount`, `deferred`, `fecha`, `p`, `falsedeferred`, `tramite`, `ctramite`, `user_id`, `ente`, `vistas`, `fecha_notifica`) VALUES (CURRENT_TIMESTAMP,$idt,$txtmonto,0.00,0.00,CURDATE(),'C',0,'P','$tramite',$iduser,0,0,NULL)";
		 // die($sql);
		$idcpdv=ejecutarConsulta_retornarID($sql);
		if($idcpdv){
            $sql="INSERT INTO `dtcpdv`(`cpdv_id`, `approval`, `ref`, `ptype`, `mount`, `useamount`, `vfile`) VALUES ($idcpdv,'$txtaprobado','$txtreferencia',0,$txtmonto,0.00,NULL)";
            if(ejecutarConsulta($sql)){
            	$sql="UPDATE mayor SET totpag=totpag+$txtmonto,mcondition='P',fpagado=CURRENT_TIMESTAMP WHERE id=$id_mayor";
            	return ejecutarConsulta($sql);
            }
            else
              return false;	

		}
		else
		return false;
	}

	public function listarcontribuyentes()
	{
		$sql="SELECT `rfc`,`tiponac`,`cedularif`,`razsocial` FROM `citizen` WHERE `estatus`='A'";

		return ejecutarConsulta($sql);
	}


public function getnametributo($tramite){
	$detalle="";
	$cont=0;

		$sql="SELECT t.detalle  FROM mayor m INNER JOIN tributes t ON m.idt=t.idt WHERE m.tramite='$tramite';";

		$rsp = ejecutarConsulta($sql);
		while ($reg=$rsp->fetch_object()){
      $cont++;
      if ($cont==1)
      $detalle=$reg->detalle;
      else
      	$detalle.=", ".$reg->detalle;

		}
		return $detalle;
	}



	public function listardeudacontribuyente($idrfc)
	{
		//$sql="SELECT `rfc`,`tiponac`,`cedularif`,`razsocial` FROM `citizen` WHERE `estatus`='A'";

	//	$sql="SELECT m.id,m.moment,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,t.detalle,SUM(m.totliq) AS totliq,SUM(d.mount) AS montodiferido, (m.totliq-SUM(d.mount)) AS diferencia,m.descuento,m.totpag,(totpag-totliq) AS saldo,t.idt,(m.totliq-m.deferred-m.descuento-m.totpag) AS totalapagar,m.deferred FROM mayor m LEFT JOIN cpdv c ON c.ctramite=m.tramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$idrfc' AND ((m.totpag+m.descuento)<totliq) GROUP BY m.id ORDER BY m.moment DESC";

/*

SELECT m.id,c.momemt,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,(SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='1948' AND ma.tramite=m.tramite GROUP BY ma.tramite) AS totalliquidao,m.deferred AS montodiferido, ((SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='1948' AND ma.tramite=m.tramite GROUP BY ma.tramite)-m.deferred) AS diferencia,m.descuento,m.totpag,(m.totpag-(SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='1948' AND ma.tramite=m.tramite GROUP BY ma.tramite)) AS saldo,(SUM(m.totliq)-m.deferred-m.descuento-m.totpag) AS totalapagar,m.deferred FROM mayor m LEFT JOIN cpdv c ON c.ctramite=m.tramite RIGHT JOIN dtcpdv d ON c.id=d.cpdv_id RIGHT JOIN tributes t ON m.idt=t.idt WHERE  idrfc='1948' AND ((m.totpag+m.descuento)<(SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='1948' AND ma.tramite=m.tramite GROUP BY ma.tramite))  GROUP BY m.tramite ORDER BY m.moment DESC;



SELECT m.id,c.momemt,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,SUM(m.totliq) AS totalliquidao,m.deferred AS montodiferido, (SUM(m.totliq)-m.deferred) AS diferencia,m.descuento,m.totpag,(m.totpag-SUM(m.totliq)) AS saldo,(SUM(m.totliq)-m.deferred-m.descuento-m.totpag) AS totalapagar,m.deferred FROM mayor m LEFT JOIN cpdv c ON m.tramite=c.ctramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='1948' GROUP BY m.tramite ORDER BY m.moment DESC; 


SELECT m.id,c.momemt,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,(SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='1948' AND ma.tramite=m.tramite GROUP BY ma.tramite) AS totliq,m.descuento,m.totpag,m.descuento,m.deferred FROM mayor m LEFT JOIN cpdv c ON m.tramite=c.ctramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='1948' GROUP BY m.tramite ORDER BY m.moment DESC; 

*/

    
  //  $sql="SELECT m.id,m.moment,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq, m.tramite,m.period,t.detalle,SUM(m.totliq) AS totliq,SUM(d.mount) AS montodiferido, (m.totliq-SUM(d.mount)) AS diferencia,m.descuento,m.totpag,(totpag-totliq) AS saldo,t.idt,SUM(m.totliq-m.deferred-m.descuento-m.totpag) AS totalapagar,m.deferred FROM mayor m LEFT JOIN cpdv c ON c.ctramite=m.tramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$idrfc' AND ((m.totpag+m.descuento)<totliq) GROUP BY m.tramite ORDER BY m.moment DESC";


    $sql="SELECT m.id,c.momemt,DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq,m.idt ,m.tramite,m.period,(SELECT SUM(ma.totliq) FROM mayor ma WHERE ma.idrfc='$idrfc' AND ma.tramite=m.tramite GROUP BY ma.tramite) AS totliq,m.descuento,m.totpag,m.deferred FROM mayor m LEFT JOIN cpdv c ON m.tramite=c.ctramite LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$idrfc' GROUP BY m.tramite ORDER BY m.moment DESC";





		//die($sql);
		return ejecutarConsulta($sql);
	}

	
	public function select()
	{
		$sql="SELECT * FROM contrihacienda";
		return ejecutarConsulta($sql);		
	}

	



}
?>