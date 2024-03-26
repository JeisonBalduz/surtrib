<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Anticipio
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($rfc,$iduser,$documento,$montotal,$idact,$montobruto,$anno,$mes)
	{
		
        $sql="INSERT INTO `companye` (`moment`, `tramite`, `rfc`, `deductible`, `fiat`, `ecryptocurrency`, `user_id`, `modo`, `ip`, `status`) 
		VALUES (now(),(SELECT Gsgenhashkey ('$rfc') AS tramite),'$rfc','0',NULL,NULL,'$iduser','SCC','190.120.249.34','A')";
		$idrelcompanye = ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idact))
		{
			$sql_detalle = "INSERT INTO `companyeib` (`idrelcompanye`, `idactivity`, `annomm`, `income`, `tax`, `deductible`, `fiat`, `incomefiat`, `eqincomefiat`, 
											`taxfiat`, `eqfiat`, `ecryptocurrency`, `currencies_id`, `modality`, `pathc`, `status`) 
											VALUES ('$idrelcompanye','$idact[$num_elementos]',CONCAT('$anno','$mes'),'$montobruto[$num_elementos]',
											(SELECT CalcularPagoAnticipo ('$idact[$num_elementos]','$montobruto[$num_elementos]') AS tax),
											'0','EU',0,0,0,0,NULL,'1','E','$documento','A')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		$sql="CALL IncluirAnticipo3($idrelcompanye,$rfc,$iduser,'$anno','$mes')";
		return ejecutarConsulta($sql);
		
		return $sw;

	}

	public function insertartramitemv($rfc,$idtvehiculo,$idv,$iduser)
	{

		$sql="CALL IncluirVehiculo($rfc,$idtvehiculo,$idv,$iduser)";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$registered,$idtvehiculo,$licenseplate,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra)
	{
		$sql="UPDATE vehiculos SET 
								   registered='$registered',
								   idtvehiculo='$idtvehiculo',
								   licenseplate='$licenseplate',
								   marca='$marca',
								   modelos='$modelos',
								   puestos='$puestos',
								   pesos='$pesos',
								   anio='$anio',
								   fechacompra='$fechacompra'
								   
								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($id)
	{
		$sql="UPDATE vehiculos SET estado ='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($id)
	{
		$sql="UPDATE vehiculos SET estado ='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar

	public function mostrar($rfc)
	{
		$sql="SELECT rfc,rif,name FROM `users` WHERE `rfc`='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostraractividades($rfc)
	{
		$sql="SELECT a.* FROM relcompanyactivity r LEFT JOIN activities a ON r.actividad=a.id WHERE r.rfc='$rfc'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($rfc)
	{
		$sql="SELECT m.mcondition,c.id,m.period AS fecha,DATE_FORMAT(c.moment, '%Y')AS anno,c.tramite FROM companye c LEFT JOIN mayor m ON c.tramite=m.tramite WHERE c.rfc='$rfc' GROUP BY c.tramite ORDER BY id DESC";
	    return ejecutarConsulta($sql);		
	}
	public function verificasiondepago($rfc)
	{
		//$sql="SELECT c.id,DATE_FORMAT(c.moment, '%Y%m') AS fecha,tramite FROM companye c WHERE c.rfc='$rfc' ORDER BY id DESC";
		$sql="SELECT MAX(annomm) as ul_pago,DATE_FORMAT(now(), '%d') as dia_actual,DATE_FORMAT(now(), '%m') as mes_actual,DATE_FORMAT(now(), '%Y') as ano_actual FROM companyeib c LEFT JOIN companye e ON c.idrelcompanye=e.id WHERE e.rfc=$rfc;";
	    return ejecutarConsulta($sql);		
	}

}
?>