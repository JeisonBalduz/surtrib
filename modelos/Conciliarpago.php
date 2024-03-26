<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Concipago
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($idconciliacion,$rfc,$idusuario,$idcpdv)
	{
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idcpdv))
		{
			$sql="INSERT INTO `cpdv`( `momemt`, `tributo`, `monto`,`discount`, `deferred`, `fecha`, `p`, `falsedeferred`, `tramite`, `ctramite`, 
								`user_id`, `ente`, `vistas`, `fecha_notifica`) VALUES (now(),(SELECT tributo FROM cpdv as n WHERE id=$idcpdv[$num_elementos]),
								IF((SELECT monto FROM cpdv as n WHERE id=$idcpdv[$num_elementos])>(SELECT saldo FROM cpdv_bank WHERE id=$idconciliacion),(SELECT saldo FROM cpdv_bank WHERE id=$idconciliacion),(SELECT monto FROM cpdv as n WHERE id=$idcpdv[$num_elementos])),'0.00','0.00',
							(SELECT fecha FROM cpdv as n WHERE id=$idcpdv[$num_elementos]),'C','0',
									((SELECT MAX(id) FROM cpdv AS n)+1),(SELECT ctramite FROM cpdv as n WHERE id=$idcpdv[$num_elementos]),'$idusuario','0','0',NULL)";
			$idcpdvn = ejecutarConsulta_retornarID($sql);

			$sql_detalle = "INSERT INTO `dtcpdv`(`cpdv_id`, `approval`, `ref`, `ptype`, `mount`, `useamount`, `vfile`) VALUES ($idcpdvn,'C/E',
									(SELECT c.refencia FROM cpdv_bank AS c WHERE id=$idconciliacion),'5','0.00',(SELECT monto FROM cpdv AS a WHERE id=$idcpdvn),NULL)";
			ejecutarConsulta($sql_detalle) or $sw = false;


			$sql_detalle2 = "UPDATE `mayor` m
SET `deferred` = (SELECT MAX(m.deferred) FROM (SELECT * FROM mayor) as m WHERE tramite IN (SELECT ctramite FROM cpdv WHERE id=$idcpdvn )) - (SELECT monto FROM cpdv WHERE id=$idcpdvn ),
    `totpag` = (SELECT MAX(m.totpag) FROM (SELECT * FROM mayor) as m WHERE tramite IN (SELECT ctramite FROM cpdv WHERE id=$idcpdvn )) + (SELECT monto FROM cpdv WHERE id=$idcpdvn ),
    `mcondition` = IF((m.totliq - (m.totpag+(SELECT monto FROM cpdv AS a WHERE id=$idcpdvn ))) <= 0, 'C', 'D'),
    `fpagado` = now(),
    `id_user`='$idusuario'
WHERE tramite = (SELECT ctramite FROM cpdv WHERE id=$idcpdvn);";
			ejecutarConsulta($sql_detalle2) or $sw = false;


			$sql_detalle3="UPDATE `cpdv_bank` AS b
SET `isused` = IF((b.saldo - (SELECT monto FROM cpdv AS a WHERE id=$idcpdvn)) <= 0, '1', '0'),
    `saldo` = (b.saldo - (SELECT monto FROM cpdv AS a WHERE id=$idcpdvn))
WHERE b.`id` = '$idconciliacion'";
			ejecutarConsulta($sql_detalle3) or $sw = false;

			
			$num_elementos=$num_elementos + 1;

		}

		
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
		$sql="SELECT u.rfc,u.name,c.ctramite,c.tramite,m.totliq,c.fecha,d.mount,d.ref,d.vfile FROM cpdv c LEFT JOIN dtcpdv d ON c.id=d.id LEFT JOIN mayor m ON m.tramite=c.ctramite LEFT JOIN users u ON u.id=c.user_id WHERE c.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrar($id)
	{
		$sql="SELECT * FROM `cpdv_bank` WHERE id='$id'";
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
		$sql="SELECT * FROM cpdv_bank WHERE `isused`=0 ORDER BY `cpdv_bank`.`id` DESC";
		return ejecutarConsulta($sql);		
	}
	
	public function listarporfecha($comodinbusqueda,$comodinbusqueda2)
	{

        if($comodinbusqueda==$comodinbusqueda2){
		   $sql="SELECT * FROM cpdv_bank WHERE `isused`=0 AND DATE_FORMAT(fechad, '%Y-%m-%d')='$comodinbusqueda' ORDER BY `cpdv_bank`.`id` DESC";

      	}else{

			 $sql="SELECT * FROM cpdv_bank WHERE `isused`=0 AND DATE_FORMAT(fechad, '%Y-%m-%d') BETWEEN '$comodinbusqueda' AND '$comodinbusqueda2' ORDER BY `cpdv_bank`.`id` DESC";
		}

		return ejecutarConsulta($sql);		
	}
	
	public function tramitescontri($rfc)
	{
		$sql="SELECT c.id,DATE_FORMAT(c.momemt, '%d/%m/%y') AS fechaliq,u.rfc,u.name,t.detalle,c.ctramite,d.mount,d.approval,d.ref,d.vfile FROM dtcpdv d LEFT JOIN cpdv c ON c.id=d.cpdv_id LEFT JOIN users u ON c.user_id=u.id LEFT JOIN tributes t ON t.idt=c.tributo WHERE c.p='D' AND c.ctramite NOT IN (SELECT ctramite FROM cpdv WHERE p='C') AND d.ptype=1 AND u.rfc='$rfc'";
		return ejecutarConsulta($sql);		
	}
	
	public function tramiteporpagar($rfc)
	{
		$sql="SELECT d.ref, d.mount, c.id AS idcpdv, c.fecha, m.id AS idmayor, m.totliq, m.totpag, m.tramite, t.detalle FROM mayor m INNER JOIN tributes t ON m.idt = t.idt INNER JOIN cpdv c ON c.ctramite = m.tramite AND c.p = 'D' INNER JOIN dtcpdv d ON c.id = d.cpdv_id WHERE m.mcondition = 'D' AND idrfc = '$rfc' AND totliq > totpag AND NOT EXISTS ( SELECT 1  FROM cpdv  WHERE cpdv.ctramite = c.ctramite AND cpdv.monto = c.monto AND cpdv.p = 'C' )";
		return ejecutarConsulta($sql);		
	}
	
}
?>