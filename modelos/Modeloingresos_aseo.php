<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ingresos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	
	public function getrifcontri($tramite){
	$detalle="";
	$cont=0;

		$sql="SELECT CONCAT(c.tiponac,c.cedularif) AS cedularif  FROM mayor_aseo m INNER JOIN citizen c ON m.idrfc=c.rfc WHERE m.tramite='$tramite' LIMIT 1;";

		$rsp = ejecutarConsulta($sql);
		while ($reg=$rsp->fetch_object()){
      $detalle=$reg->cedularif;

		}
		return $detalle;
	}

	 public function reportedeldia_taquilla($comodinbusqueda,$comodinbusqueda2)
	{
      	$id_USER=$_SESSION['idusuario'];
      if($comodinbusqueda==$comodinbusqueda2){ //(case when (d.ptype=1) then 'TRANSFERENCIA' when (d.ptype=0) then 'DEBITO' when (d.ptype=1) then 'EFECTIVO' end) AS modo
                   

        $sql="SELECT c.id,d.id AS recibo,'T' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,d.ptype,(case when (d.ptype=2) then 'TRANSFERENCIA' when (d.ptype=0) then 'DEBITO' when (d.ptype=8) then 'EFECTIVO' end) AS modo,SUM(d.mount) AS monto  FROM cpdv_aseo c INNER JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  INNER JOIN users u ON (u.id=c.user_id AND u.id='$id_USER') WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.ctramite,d.approval,d.ref,d.ptype ORDER BY d.ptype  DESC;";
       



      }
      else{ //GROUP BY m.tramite
      	

        $sql="SELECT c.id,d.id AS recibo,'T' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,d.ptype,(case when (d.ptype=2) then 'TRANSFERENCIA' when (d.ptype=0) then 'DEBITO' when (d.ptype=8) then 'EFECTIVO' end) AS modo,SUM(d.mount) AS monto FROM cpdv_aseo c INNER JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  INNER JOIN users u ON (u.id=c.user_id AND u.id='$id_USER') WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.ctramite,d.approval,d.ref,d.ptype ORDER BY d.ptype DESC;";


      }
		//die($sql);
		return ejecutarConsulta($sql);		
	}

  public function reportedeldia($comodinbusqueda,$comodinbusqueda2)
	{
      	
      if($comodinbusqueda==$comodinbusqueda2){ 
                   

        $sql="SELECT c.id,d.id AS recibo,'' as tramite,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,d.ptype,(case when (d.ptype=2) then 'TRANSFERENCIA' when (d.ptype=0) then 'DEBITO' when (d.ptype=8) then 'EFECTIVO' end) AS modo,SUM(d.mount) AS monto  FROM cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  LEFT JOIN users u ON (u.id=c.user_id) WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.ctramite,d.approval,d.ref,d.ptype ORDER BY d.ptype DESC;";
       



      }
      else{ //GROUP BY m.tramite  
      	

        $sql="SELECT c.id,d.id AS recibo,'' as tramite,DATE_FORMAT(c.fecha, '%d') AS dia,'T' as  idrfc,c.user_id,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,u.name,c.ctramite,d.approval,d.ref,d.ptype,(case when (d.ptype=2) then 'TRANSFERENCIA' when (d.ptype=0) then 'DEBITO' when (d.ptype=8) then 'EFECTIVO' end) AS modo,SUM(d.mount) AS monto FROM cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  LEFT JOIN users u ON (u.id=c.user_id) WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.ctramite,d.approval,d.ref,d.ptype ORDER BY d.ptype DESC;";


      }
		//die($sql);
		return ejecutarConsulta($sql);		
	}

  public function reportedeldiaConciliacionBancaria($comodinbusqueda,$comodinbusqueda2)
	{
      
      if($comodinbusqueda==$comodinbusqueda2){
           $sql="SELECT u.name AS cajero,DATE_FORMAT(c.momemt, '%d/%m/%Y') AS fecha,DATE_FORMAT(B.fechad, '%d/%m/%Y') AS fechad,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank_aseo B, cpdv c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref ORDER BY d.ptype;";
      }
      else{
      	 

      	 $sql="SELECT u.name AS cajero,DATE_FORMAT(c.momemt, '%d/%m/%Y') AS fecha,DATE_FORMAT(B.fechad, '%d/%m/%Y') AS fechad,CONCAT(c.id,'/',c.ctramite) AS tramite,d.id AS control,(case when (d.ptype=1) then 'TRMB' when (d.ptype=5) then 'CoBk' end) AS modo,B.refencia,c.monto,c.user_id,DATE_FORMAT(c.momemt, '%d') AS dia FROM cpdv_bank B, cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN users u ON u.id=c.user_id WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref ORDER BY d.ptype;";
      }


     

		//die($sql);
		return ejecutarConsulta($sql);		
	}



	public function reporteIngresos($comodinbusqueda,$comodinbusqueda2)// INGRESOS DIARIO POR PARTIDA

	{
		
   if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite

      

        $sql="SELECT code,rubro,SUM(id) AS id,SUM(ntramite) as ntramite,SUM(monto) as monto FROM (SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_aseo c LEFT JOIN tributes_aseo t ON t.idt=c.tributo LEFT JOIN code_onapre co ON co.code=t.partida  LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY co.code UNION SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_bank B, cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON c.tributo=t.idt LEFT JOIN code_onapre co ON co.code=t.partida WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and B.refencia=d.ref GROUP BY co.code) a GROUP BY code";

    }
      else{ //GROUP BY m.tramite
      	
          
          $sql="SELECT code,rubro,SUM(id) AS id,SUM(ntramite) as ntramite,SUM(monto) as monto FROM (SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_aseo c LEFT JOIN tributes_aseo t ON t.idt=c.tributo LEFT JOIN code_onapre co ON co.code=t.partida  LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id  WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY co.code UNION SELECT co.code,co.rubro,COUNT(c.id) AS id,COUNT(c.ctramite) as ntramite,SUM(c.monto) as monto FROM cpdv_bank B, cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON c.tributo=t.idt LEFT JOIN code_onapre co ON co.code=t.partida WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and B.refencia=d.ref GROUP BY co.code) a GROUP BY code";



      }

     //die($sql);

		return ejecutarConsulta($sql);		
	}
 public function resumendeingresos($comodinbusqueda,$comodinbusqueda2)//INGRESOS DIARIO POR TRIBUTO
	{
      
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite

       $sql="SELECT partida,detalle,fecha,tributo,SUM(monto) as monto
FROM (SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.tributo UNION SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_bank B, cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref GROUP BY c.tributo) a GROUP BY tributo";



      }
      else{ //GROUP BY m.tramite

      	 $sql="SELECT partida,detalle,fecha,tributo,SUM(monto) as monto
FROM (SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=0 OR d.ptype=2 OR d.ptype=8) GROUP BY c.tributo UNION SELECT t.partida,t.detalle,c.tributo,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,SUM(c.monto) as monto FROM cpdv_bank B, cpdv_aseo c LEFT JOIN dtcpdv_aseo d ON c.id=d.cpdv_id LEFT JOIN tributes_aseo t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref GROUP BY c.tributo) a GROUP BY tributo";
      }
     

		//die($sql);
		return ejecutarConsulta($sql);		
	}


	public function resumendeingresosdetalleDebito($comodinbusqueda,$comodinbusqueda2)//INGRESOS DIARIO DEIALLE
	{
      
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite


     //DEBITO
     $sql="SELECT t.partida,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,'DEBITO' AS movimiento,'BNC' AS banco,'497' AS codbanco,d.ref,c.ctramite,SUM(c.monto) as monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d')='$comodinbusqueda' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref";


      }
      else{ 

      	    
    //DEBITO
     $sql="SELECT t.partida,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,'DEBITO' AS movimiento,'BNC' AS banco,'497' AS codbanco,d.ref,c.ctramite,SUM(c.monto) as monto FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE DATE_FORMAT(c.fecha, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND d.ptype=0 GROUP BY c.ctramite,d.approval,d.ref";

      }
     

	//	die($sql);
		return ejecutarConsulta($sql);		
	}
	

public function resumendeingresosdetalleTrranferencia($comodinbusqueda,$comodinbusqueda2)//INGRESOS DIARIO DEIALLE
	{
      
      if($comodinbusqueda==$comodinbusqueda2){ //GROUP BY m.tramite



     //TRANSFERENCIAS
     $sql="SELECT t.partida,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,'TRANSFERENCIA' AS movimiento,'BNC' AS banco,'497' AS codbanco,d.ref,c.ctramite,c.monto as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref";


      }
      else{ 

      	
    $sql="SELECT t.partida,DATE_FORMAT(c.fecha, '%d/%m/%Y') AS fecha,'TRANSFERENCIA' AS movimiento,'BNC' AS banco,'497' AS codbanco,d.ref,c.ctramite,c.monto as monto FROM cpdv_bank B, cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN tributes t ON t.idt=c.tributo WHERE c.P='C' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND (d.ptype=1 OR d.ptype=5) AND B.isused=1 and  B.refencia=d.ref";



      }
     

	//	die($sql);
		return ejecutarConsulta($sql);		
	}

public function ingresosDeclarados($comodinbusqueda,$comodinbusqueda2)//
	{
      
   // $fechaINI=explode("-",$comodinbusqueda);
   // $fecha=$fechaINI[0].'-'.$fechaINI[1];
		if($comodinbusqueda==$comodinbusqueda2){ 

     $sql="SELECT COUNT(c.rfc) AS cuantosdeclararon,SUM(cc.income) AS TingresosDeclarados,SUM(cc.tax) AS CuantoApagar FROM companye c LEFT JOIN companyeib cc ON c.id=cc.idrelcompanye WHERE c.rfc<>1 AND c.rfc<>11007 AND c.rfc<>0 AND DATE_FORMAT(c.moment,'%Y-%m-%d')='$comodinbusqueda'";
     }
      else{ 
           
           $sql="SELECT COUNT(c.rfc) AS cuantosdeclararon,SUM(cc.income) AS TingresosDeclarados,SUM(cc.tax) AS CuantoApagar FROM companye c LEFT JOIN companyeib cc ON c.id=cc.idrelcompanye WHERE c.rfc<>1 AND c.rfc<>11007 AND c.rfc<>0 AND DATE_FORMAT(c.moment,'%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2'";

      }
	//	die($sql);
		return ejecutarConsulta($sql);		
	}

public function ingresosDeclaradosPagados($comodinbusqueda,$comodinbusqueda2)//
	{
      
   // $fechaINI=explode("-",$comodinbusqueda);
  //  $fecha=$fechaINI[0].'-'.$fechaINI[1];
   if($comodinbusqueda==$comodinbusqueda2){ 
     $sql="SELECT COUNT(c.rfc) as Cuantospagaron 
FROM companye c LEFT JOIN companyeib cc ON c.id=cc.idrelcompanye 
LEFT JOIN mayor m ON c.tramite=m.tramite 
WHERE m.idt=1024 AND (m.mcondition='C' OR m.mcondition='P') AND c.rfc<>1 AND c.rfc<>11007 AND c.rfc<>0 AND DATE_FORMAT(m.fpagado,'%Y-%m-%d')='$comodinbusqueda';";
 
  }else{ 
    
     $sql="SELECT COUNT(c.rfc) as Cuantospagaron 
FROM companye c LEFT JOIN companyeib cc ON c.id=cc.idrelcompanye 
LEFT JOIN mayor m ON c.tramite=m.tramite 
WHERE m.idt=1024 AND (m.mcondition='C' OR m.mcondition='P') AND c.rfc<>1 AND c.rfc<>11007 AND c.rfc<>0 AND DATE_FORMAT(m.fpagado,'%Y-%m-%d')  BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2';";
 

      }
	//	die($sql);
		return ejecutarConsulta($sql);		
	}







}
?>