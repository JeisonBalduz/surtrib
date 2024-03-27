<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contria
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion)
	{
		$sql="INSERT INTO citizen (licencia,tiponac,cedularif,razsocial,correo,tlf,codcel,celular,modo,estado_pk,municipio_pk,
		                           parroquia_pk,ciudad_pk,sector,calle,edificio,numeroedif,medit,representative,addresses,code,registrado,
		                           conformidaduso,tieneinmueble,taseo,texpe,tapu,tilico,pkenumerator,contrato,viejo,ultima_declaracion,estatus)
		VALUES ('$licencia','$tiponac','$cedularif','$razsocial','$correo','$tlf','$codcel','$celular','$modo','$estado_pk','$municipio_pk',
		                           '$parroquia_pk','$ciudad_pk','$sector','$calle','$edificio','$numeroedif','$medit','$representative','$addresses','$code','$registrado',
                                   '$conformidaduso','$tieneinmueble','$taseo','$texpe','$tapu','$tilico','$pkenumerator','$contrato','$viejo','$ultima_declaracion','A')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion)
	{
		$sql="UPDATE citizen SET 
								   licencia='$licencia',
								   tiponac='$tiponac',
								   cedularif='$cedularif', 
								   razsocial='$razsocial',
								   correo='$correo',
								   tlf='$tlf',
								   codcel='$codcel', 
								   celular='$celular',
								   modo='$modo',
								   estado_pk='$estado_pk',
								   municipio_pk='$municipio_pk',
								   parroquia_pk='$parroquia_pk',
								   ciudad_pk='$ciudad_pk',
								   sector='$sector',
								   calle='$calle',
								   edificio='$edificio', 
								   numeroedif='$numeroedif',
								   medit='$medit',
								   representative='$representative',
								   addresses='$addresses', 
								   code='$code',
								   registrado='$registrado',
								   conformidaduso='$conformidaduso',
								   tieneinmueble='$tieneinmueble',
								   taseo='$taseo',
								   texpe='$texpe',
								   tapu='$tapu',
								   tilico='$tilico',
								   pkenumerator='$pkenumerator', 
								   contrato='$contrato',
								   viejo='$viejo',
								   ultima_declaracion='$ultima_declaracion'
								   
								   WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($rfc)
	{
		$sql="UPDATE citizen SET estatus ='D' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($rfc)
	{
		$sql="UPDATE citizen SET estatus ='A' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($rfc)
	{
		$sql="SELECT * FROM citizen WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrarliq($tramite)
	{
		$sql="SELECT m.tramite AS tram,m.idt AS idtipotramite,t.detalle AS detalle, m.totpag AS monton FROM mayor m INNER JOIN 
		tributes t ON m.idt=t.idt WHERE m.tramite='$tramite'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrartotal($rfc)
	{
		$sql="SELECT SUM(m.totliq) AS stotaliq,SUM(m.deferred) AS sdiferido,(SUM(m.totliq)-SUM(m.deferred)-SUM(m.descuento)-SUM(m.totpag)) AS stotaltotal,SUM(m.descuento) AS sdescuento,SUM(m.totpag) AS stotalp FROM mayor m INNER JOIN 
		tributes t ON m.idt=t.idt INNER JOIN users c ON m.idrfc=c.rfc WHERE m.idrfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{

	
		$sql="SELECT a.*,p.*,f.fpago FROM citizen a LEFT JOIN relcompanyactivity c ON a.rfc=c.rfc INNER JOIN activities p ON c.actividad=p.id 
		LEFT JOIN (SELECT DATE_FORMAT(MAX(m.fpagado), '%d/%m/%y') AS fpago, m.idrfc AS rfcus FROM mayor m INNER JOIN citizen us ON m.idrfc=us.rfc 
		WHERE m.idt=1024 GROUP BY m.idrfc) AS f ON a.rfc=f.rfcus";
		return ejecutarConsulta($sql);		
	}

	public function listar2($comodinbusqueda)
	{
		$sql="SELECT a.*,p.*,f.fpago FROM citizen a LEFT JOIN relcompanyactivity c ON a.rfc=c.rfc INNER JOIN activities p ON c.actividad=p.id 
		LEFT JOIN (SELECT DATE_FORMAT(MAX(m.fpagado), '%d/%m/%y') AS fpago, m.idrfc AS rfcus FROM mayor m INNER JOIN citizen us ON m.idrfc=us.rfc 
		WHERE m.idt=1024 GROUP BY m.idrfc) AS f ON a.rfc=f.rfcus WHERE a.rfc='$comodinbusqueda' OR CONCAT(a.tiponac,a.cedularif) LIKE '%".$comodinbusqueda."%' OR a.razsocial LIKE '%".$comodinbusqueda."%'";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
		$sql="SELECT * FROM contrihacienda";
		return ejecutarConsulta($sql);		
	}

	public function estadocuenta($comodinbusqueda)
	{
		$sql="SELECT DATE_FORMAT(m.moment, '%d/%m/%y') AS fechaliq,m.moment, m.tramite,m.period,m.idt,t.detalle,SUM(m.totliq) AS totliq,SUM(m.deferred) AS montodiferido, (SUM(m.totliq)-(SUM(m.descuento)+SUM(m.totpag))) AS diferencia,SUM(m.descuento) AS descuento,SUM(m.totpag) AS totpag,((SUM(totpag)+SUM(m.descuento))-SUM(totliq)) AS saldo FROM mayor m LEFT JOIN tributes t ON m.idt=t.idt WHERE idrfc='$comodinbusqueda' GROUP BY m.tramite ORDER BY m.moment DESC";
		return ejecutarConsulta($sql);		
	}
   public function reportedeldia($comodinbusqueda,$comodinbusqueda2)
	{
      
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite DATE_FORMAT(m.fpagado, '%Y-%m-%d')='$comodinbusqueda' AND
         // $sql="SELECT c.id,d.id AS recibo,m.tramite,c.ctramite,m.idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE  DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 AND m.mcondition='P' GROUP BY m.tramite,c.tributo,d.approval,d.ref ORDER BY u.name,d.ref,c.ctramite DESC;";
       // $sql="SELECT c.id,d.id AS recibo,m.tramite,m.idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,d.mount AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY m.tramite,c.tributo,d.approval,d.ref ORDER BY u.name,d.ref DESC;";
        $sql="SELECT c.id,d.id AS recibo,'' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,(SELECT  SUM(d.mount) AS monto FROM  cpdv c1 LEFT JOIN dtcpdv d1 ON c1.id=d1.cpdv_id WHERE c1.id=c.id GROUP BY c1.ctramite,c1.tributo,d1.approval,d1.ref) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  LEFT JOIN users u ON u.id=c.user_id WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";
        
          
      }
      else{ //GROUP BY m.tramite
      	 //$sql="SELECT c.id,d.id AS recibo,m.tramite,m.idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d') AS dia,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,DATE_FORMAT(c.fecha, '%Y-%m-%d') AS fecha2,u.name,c.ctramite,c.tramite,d.approval,d.ref,SUM(d.mount) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE  DATE_FORMAT(c.fecha, '%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 AND m.mcondition='P' GROUP BY m.tramite,c.tributo,d.approval,d.ref ORDER BY fecha2,u.name,d.ref,c.ctramite DESC;";
         $sql="SELECT c.id,d.id AS recibo,'' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,(SELECT  SUM(d.mount) AS monto FROM  cpdv c1 LEFT JOIN dtcpdv d1 ON c1.id=d1.cpdv_id WHERE c1.id=c.id GROUP BY c1.ctramite,c1.tributo,d1.approval,d1.ref) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  LEFT JOIN users u ON u.id=c.user_id WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";
      }
		//die($sql);
		return ejecutarConsulta($sql);		
	}

  public function reportedeldiaConciliacionBancaria($comodinbusqueda,$comodinbusqueda2)
	{
      
      if($comodinbusqueda==$comodinbusqueda2){
           $sql="SELECT u.name AS cajero,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND  B.refencia=d.ref ORDER BY d.ptype;";
      }
      else{
      	 

      	 $sql="SELECT u.name AS cajero,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'  AND (d.ptype=1 OR d.ptype=5) AND  B.refencia=d.ref ORDER BY d.ptype;";
      }
     

		//die($sql);
		return ejecutarConsulta($sql);		
	}
	public function buscarContibuyente($rfc)
	{
		$sql="SELECT rfc,CONCAT(rfc,' ',tiponac,cedularif,' ',razsocial) AS rif FROM citizen WHERE rfc='$rfc' OR CONCAT(tiponac,cedularif,razsocial) LIKE '%".$rfc."%'  AND estatus ='A' LIMIT 20;";
		//die($sql);
		return ejecutarConsulta($sql);
	}
}
?>