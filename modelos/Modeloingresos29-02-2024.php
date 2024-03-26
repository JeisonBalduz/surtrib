<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ingresos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}

	 public function reportedeldia_taquilla($comodinbusqueda,$comodinbusqueda2)
	{
      	$id_USER=$_SESSION['idusuario'];
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite DATE_FORMAT(m.fpagado, '%Y-%m-%d')='$comodinbusqueda' AND
                   

        $sql="SELECT c.id,d.id AS recibo,'T' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto  FROM cpdv c INNER JOIN dtcpdv d ON c.id=d.cpdv_id  INNER JOIN users u ON (u.id=c.user_id AND u.id='$id_USER') WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";
       



      }
      else{ //GROUP BY m.tramite
      	

        $sql="SELECT c.id,d.id AS recibo,'T' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto FROM cpdv c INNER JOIN dtcpdv d ON c.id=d.cpdv_id  INNER JOIN users u ON (u.id=c.user_id AND u.id='$id_USER') WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";


      }
		//die($sql);
		return ejecutarConsulta($sql);		
	}

  public function reportedeldia($comodinbusqueda,$comodinbusqueda2)
	{
      	
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite DATE_FORMAT(m.fpagado, '%Y-%m-%d')='$comodinbusqueda' AND
                   

        $sql="SELECT c.id,d.id AS recibo,'' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto  FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  LEFT JOIN users u ON (u.id=c.user_id) WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";
       



      }
      else{ //GROUP BY m.tramite
      	

        $sql="SELECT c.id,d.id AS recibo,'' as tramite,DATE_FORMAT(c.fecha, '%d') AS dia,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  LEFT JOIN users u ON (u.id=c.user_id) WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref ORDER BY u.name,d.ref DESC;";


      }
		//die($sql);
		return ejecutarConsulta($sql);		
	}

  public function reportedeldiaConciliacionBancaria($comodinbusqueda,$comodinbusqueda2)
	{
      
      if($comodinbusqueda==$comodinbusqueda2){
           $sql="SELECT u.name AS cajero,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref ORDER BY d.ptype;";
      }
      else{
      	 

      	 $sql="SELECT u.name AS cajero,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref ORDER BY d.ptype;";
      }
     

		//die($sql);
		return ejecutarConsulta($sql);		
	}



	public function reporteIngresos($comodinbusqueda,$comodinbusqueda2)// INGRESOS DIARIO POR PARTIDA

	{
		
   if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite

      

        $sql="SELECT code,rubro,SUM(id) AS id,SUM(ntramite) as ntramite,SUM(monto) as monto FROM (SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv c LEFT JOIN tributes t ON t.idt=c.tributo LEFT JOIN code_onapre co ON co.code=t.partida  LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY co.code UNION SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON c.tributo=t.idt LEFT JOIN code_onapre co ON co.code=t.partida WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and B.refencia=d.ref GROUP BY co.code) a GROUP BY code";

    }
      else{ //GROUP BY m.tramite
      	
          
          $sql="SELECT code,rubro,SUM(id) AS id,SUM(ntramite) as ntramite,SUM(monto) as monto FROM (SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv c LEFT JOIN tributes t ON t.idt=c.tributo LEFT JOIN code_onapre co ON co.code=t.partida  LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY co.code UNION SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON c.tributo=t.idt LEFT JOIN code_onapre co ON co.code=t.partida WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and B.refencia=d.ref GROUP BY co.code) a GROUP BY code";



      }

     //die($sql);

		return ejecutarConsulta($sql);		
	}
 public function resumendeingresos($comodinbusqueda,$comodinbusqueda2)//INGRESOS DIARIO POR TRIBUTO
	{
      
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite

      /*
      SELECT t.partida,t.detalle,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(d.mount) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='2024-02-22' AND d.ptype=0 GROUP BY c.tributo;



      */



         // $sql="SELECT c.id,d.id AS recibo,t.idt,t.partida,t.detalle,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,SUM(d.mount) AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.tributo ORDER BY t.partida,fecha DESC;";

          $sql="SELECT partida,detalle,fecha,tributo,SUM(monto) as monto
FROM (SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.tributo UNION SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref GROUP BY c.tributo) a GROUP BY tributo";


      }
      else{ //GROUP BY m.tramite

      	// $sql="SELECT c.id,d.id AS recibo,t.idt,t.partida,t.detalle,c.user_id,DATE_FORMAT(c.fecha, '%d') AS dia,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,DATE_FORMAT(c.fecha, '%Y-%m-%d') AS fecha2,u.name,c.ctramite,c.tramite,d.approval,d.ref,d.mount AS monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id  LEFT JOIN users u ON u.id=c.user_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.tributo ORDER BY t.partida,fecha DESC;";
      	 $sql="SELECT partida,detalle,fecha,tributo,SUM(monto) as monto
FROM (SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.tributo UNION SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref GROUP BY c.tributo) a GROUP BY tributo";
      }
     

		//die($sql);
		return ejecutarConsulta($sql);		
	}
	



}
?>