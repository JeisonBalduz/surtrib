<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Vehiculo
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($idtvehiculo,$rfc,$licenseplate,$serialmotor,$serialcarro,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra)
	{
		
		$sql="INSERT INTO vehicle (idtvehiculo,rfc,licenseplate,serialmotor,serialcarro,marca,modelos,puestos,pesos,anio,fechacompra)
		VALUES ('$idtvehiculo','$rfc','$licenseplate','$serialmotor','$serialcarro','$marca','$modelos','$puestos','$pesos','$anio',
		                           '$fechacompra')";
		return ejecutarConsulta($sql);
	}


	public function insertar2($idtvehiculo,$ruf2,$licenseplate,$serialmotor,$serialcarro,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra)
	{
		
		$sql="INSERT INTO vehicle (idtvehiculo,rfc,licenseplate,serialmotor,serialcarro,marca,modelos,puestos,pesos,anio,fechacompra)
		VALUES ('$idtvehiculo','$ruf2','$licenseplate','$serialmotor','$serialcarro','$marca','$modelos','$puestos','$pesos','$anio',
		                           '$fechacompra')";
		return ejecutarConsulta($sql);
	}

	public function insertartramitemv($rfc2,$idtvehiculo,$idv,$idusuario2)
	{

		$sql="CALL IncluirVehiculo($rfc2,$idtvehiculo,$idv,$idusuario2)";
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
		$sql="UPDATE `vehicle` SET `idtvehiculo`='$idtvehiculo',licenseplate='$licenseplate',`marca`='$marca',`modelos`='$modelos',`puestos`='$puestos',`pesos`='$pesos',`anio`='$anio',`fechacompra`='$fechacompra' WHERE `id`='$id'";
								 //  die($sql);
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para editar registros
	public function editarRegistrosAdmin($id,$ruf2,$registered,$idtvehiculo,$licenseplate,$marca,$modelos,$puestos,$pesos,$anio,$fechacompra)
	{
		$sql="UPDATE vehiculos SET 
								   rfc='$ruf2',
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
		$sql="UPDATE `vehicle` SET `idtvehiculo`='$idtvehiculo',`rfc`='$ruf2',licenseplate='$licenseplate',`marca`='$marca',`modelos`='$modelos',`puestos`='$puestos',`pesos`='$pesos',`anio`='$anio',`fechacompra`='$fechacompra' WHERE `id`='$id'";
								 //  die($sql);
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

	public function mostrar($id)
	{
		$sql="SELECT u.rif AS rif,u.id AS idusuario,u.name AS nombreusuario,u.rfc,v.id AS idvehiculo,v.rfc AS rfc, v.registered,v.idtvehiculo,v.licenseplate,v.marca,v.modelos,v.puestos,v.pesos,v.anio,DATE_FORMAT(v.fechacompra,'%Y-%m-%d') AS fechacompra,t.id AS idtv,t.idt,t.detalle FROM vehicle v LEFT JOIN tributes t ON v.idtvehiculo=t.idt LEFT JOIN users u ON u.rfc=v.rfc WHERE v.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function mostrartaxveh()
	{
		$sql="SELECT id AS idtv,idt,detalle FROM tributes WHERE idt BETWEEN 1500 AND 1522";
		return ejecutarConsulta($sql);
	}

	public function mostrartotal($rfc)
	{
		$sql="SELECT SUM(m.totliq) AS stotaliq,SUM(m.deferred) AS sdiferido,SUM(m.descuento) AS sdescuento,SUM(m.totpag) AS stotalp,(SUM(m.totliq)-SUM(m.deferred)-SUM(m.descuento)-SUM(m.totpag)) AS stotaltotal FROM mayorhacienda m INNER JOIN 
		taxhacienda t ON m.idt=t.idt INNER JOIN contrihacienda c ON m.idrfc=c.rfc WHERE m.idrfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT v.*,c.tiponac,c.cedularif,c.razsocial,t.detalle,f.fpago,periodo FROM vehicle v LEFT JOIN citizen c ON v.rfc=c.rfc INNER JOIN tributes t ON v.idtvehiculo=t.idt LEFT JOIN (SELECT DATE_FORMAT(MAX(m.fpagado), '%d/%m/%y') AS fpago,MAX(m.period) AS periodo, m.idrfc AS rfcus FROM mayor m INNER JOIN citizen us ON m.idrfc=us.rfc WHERE m.idt BETWEEN 1500 AND 1522 GROUP BY m.idrfc) AS f ON v.rfc=f.rfcus ORDER BY `v`.`id` DESC";
	    return ejecutarConsulta($sql);		
	}

	public function listarcon($rfc)
	{
		$sql="SELECT MAX(m.period) as period,MAX(g.hashkey) AS tramite,DATE_FORMAT(v.registered, '%d/%m/%y') as fregistro,v.* FROM vehicle v LEFT JOIN gaugingvehicle g ON g.idrelvehicle=v.id INNER JOIN users u ON v.rfc=u.rfc LEFT JOIN mayor m ON g.hashkey=m.tramite WHERE u.rfc='$rfc' GROUP BY v.licenseplate";
	    return ejecutarConsulta($sql);		
	}

	public function listar2($comodinbusqueda)
	{
		$sql="SELECT v.*,c.tiponac,c.cedularif,c.razsocial,t.detalle,f.fpago FROM vehiculos v LEFT JOIN contrihacienda c ON v.rfc=c.rfc INNER JOIN taxhacienda t ON v.idtvehiculo=t.id LEFT JOIN (SELECT DATE_FORMAT(MAX(m.fpagado), '%d/%m/%y') AS fpago, m.idrfc AS rfcus FROM mayorhacienda m INNER JOIN contrihacienda us ON m.idrfc=us.rfc WHERE m.idt BETWEEN 1500 AND 1522 GROUP BY m.idrfc) AS f ON v.rfc=f.rfcus  WHERE a.rfc='$comodinbusqueda'";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
		$sql="SELECT * FROM contrihacienda";
		return ejecutarConsulta($sql);		
	}

	public function estadocuenta($comodinbusqueda)
	{
		$sql="SELECT m.moment AS fecha,m.tramite AS tramite,m.idt AS idtributo,t.detalle AS tributo,m.totliq AS totaliq,m.deferred AS diferido,m.descuento AS descuento,m.totpag AS totalp,(m.totliq-m.deferred-m.descuento-m.totpag) AS totaltotal FROM mayorhacienda m INNER JOIN taxhacienda t ON m.idt=t.idt INNER JOIN 
		contrihacienda c ON m.idrfc=c.rfc WHERE m.idrfc='$comodinbusqueda'";
		return ejecutarConsulta($sql);		
	}
   public function consultarplaca($licenseplate)
	{			   
		$sql="SELECT * FROM vehicle WHERE licenseplate='$licenseplate' limit 1;";
		//die($sql);						   
		return ejecutarConsulta($sql);
	}
	public function getmacas()
	{			   
		$sql="SELECT * FROM vehiclemarca";
		//die($sql);						   
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para buscar registros
    public function buscarUsuario($buscar)
    {
        $sql="SELECT * FROM users WHERE usuario = '$buscar' ";
        return ejecutarConsulta($sql);
    }



}
?>