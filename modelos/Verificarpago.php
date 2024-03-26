<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Veripago
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($monto,$tipopago,$referencia,$fechapago,$registro,$idusuarioamb,$idusuariosis,$idbanco,$fechaaprobacion,$imagen)
	{
		$sql="INSERT INTO pagoambiente (monto,tipopago,referencia,fechapago,registro,idusuarioamb,idusuariosis,idbanco,fechaaprobacion,imagen,estado)
		VALUES ('$monto','$tipopago','$referencia','$fechapago','$registro','$idusuarioamb','$idusuariosis','$idbanco','$fechaaprobacion','$imagen','1')";
		return ejecutarConsulta($sql);
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
	public function desacconciliartivar($id,$mount)
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
	//Implementar un método para mostrar los datos de un registro a modificar
	public function conciliar($id)
	{
		$sql="SELECT u.rfc,u.name,c.ctramite,c.tramite,m.totliq,c.fecha,d.mount,d.ref,d.vfile FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.cpdv_id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE c.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostarvfile($id)
	{
		$sql="SELECT d.vfile FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE c.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT c.id,DATE_FORMAT(c.momemt, '%d/%m/%y') AS fechaliq,u.rfc,u.name,t.detalle,c.ctramite,d.mount,d.approval,d.ref,d.vfile,SUM(m.totliq) AS totliq,SUM(m.totpag) AS totpag FROM dtcpdv d LEFT JOIN cpdv c ON c.id=d.cpdv_id LEFT JOIN users u ON c.user_id=u.id LEFT JOIN tributes t ON t.idt=c.tributo LEFT JOIN mayor m ON m.tramite= c.ctramite WHERE c.p='D' AND c.ctramite NOT IN (SELECT ctramite FROM cpdv WHERE p='C') AND d.ptype=1 AND totliq>totpag GROUP BY c.ctramite ORDER BY c.id DESC;";
		return ejecutarConsulta($sql);		
	}
	
	public function listarporfecha($comodinbusqueda,$comodinbusqueda2)
	{  if($comodinbusqueda==$comodinbusqueda2){
		$sql="SELECT c.id,DATE_FORMAT(c.momemt, '%d/%m/%y') AS fechaliq,u.rfc,u.name,t.detalle,c.ctramite,d.mount,d.approval,d.ref,d.vfile,SUM(m.totliq) AS totliq,SUM(m.totpag) AS totpag FROM dtcpdv d LEFT JOIN cpdv c ON c.id=d.cpdv_id LEFT JOIN users u ON c.user_id=u.id LEFT JOIN tributes t ON t.idt=c.tributo LEFT JOIN mayor m ON m.tramite= c.ctramite WHERE c.p='D' AND DATE_FORMAT(c.momemt, '%Y-%m-%d')='$comodinbusqueda'  AND c.ctramite NOT IN (SELECT ctramite FROM cpdv WHERE p='C') AND d.ptype=1 AND totliq>totpag GROUP BY c.ctramite ORDER BY c.id DESC;";
		}else{

			$sql="SELECT c.id,DATE_FORMAT(c.momemt, '%d/%m/%y') AS fechaliq,u.rfc,u.name,t.detalle,c.ctramite,d.mount,d.approval,d.ref,d.vfile,SUM(m.totliq) AS totliq,SUM(m.totpag) AS totpag FROM dtcpdv d LEFT JOIN cpdv c ON c.id=d.cpdv_id LEFT JOIN users u ON c.user_id=u.id LEFT JOIN tributes t ON t.idt=c.tributo LEFT JOIN mayor m ON m.tramite= c.ctramite WHERE c.p='D' AND DATE_FORMAT(c.momemt, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' AND c.ctramite NOT IN (SELECT ctramite FROM cpdv WHERE p='C') AND d.ptype=1 AND totliq>totpag GROUP BY c.ctramite ORDER BY c.id DESC;";
		}


		return ejecutarConsulta($sql);		
	}

	public function listar2()
	{
		$sql="SELECT * FROM pagoambiente";
		return ejecutarConsulta($sql);		
	}

}
?>