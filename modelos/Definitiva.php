<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Definitiva
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($rfc2,$montobrutoanual,$representante,$rcedula,$rtelefono)
	{
		$sql="INSERT INTO `definitiva`(`rfc`, `montobruto`,`representante`, `rcedula`, `rtelefono`,`correlativo`) VALUES ('$rfc2','$montobrutoanual','$representante','$rcedula','$rtelefono',((SELECT MAX(correlativo) FROM `definitiva` as de)+1))";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion)
	{
		$sql="UPDATE contrihacienda SET 
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
		$sql="UPDATE contrihacienda SET estatus ='D' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($rfc)
	{
		$sql="UPDATE contrihacienda SET estatus ='A' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($comodinbusqueda)
	{
		$sql="SELECT name,id,rfc,rif FROM users WHERE rfc='$comodinbusqueda'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function verdefinitiva($busqueda)
	{
		$sql="SELECT m.period,m.mcondition,u.rfc,u.name,u.rif,c.annomm,m.period,ROUND(c.income,2) AS ibruto,ROUND(c.tax,2) as tax,m.totpag,cc.tramite,a.codigo_grupo,a.detalles,a.alicuota FROM companyeib c LEFT JOIN companye cc ON c.idrelcompanye =cc.id LEFT JOIN activitiesenero2024 a ON c.idactivity=a.id LEFT JOIN users u ON u.rfc=cc.rfc LEFT JOIN mayor m ON m.tramite=cc.tramite WHERE cc.rfc='$busqueda' AND m.idt=1024 AND CONVERT(`annomm` USING utf8) LIKE '%2023%'";
		return ejecutarConsulta($sql);
	}

	public function listar()
	{
		$sql="SELECT d.correlativo,u.name,u.rif,u.rfc,d.id,d.montobruto,d.representante,d.rcedula,d.rtelefono FROM `definitiva` d LEFT JOIN users u ON d.rfc=u.rfc GROUP BY d.id";
		return ejecutarConsulta($sql);		
	}

	public function selectasas()
	{
		$sql="SELECT * FROM tributes WHERE grupot=5 OR grupot=20 OR grupot=7";
		return ejecutarConsulta($sql);		
	}

	public function estadocuenta($comodinbusqueda)
	{
		$sql="SELECT m.moment AS fecha,m.tramite AS tramite,m.idt AS idtributo,t.detalle AS tributo,m.totliq AS totaliq,m.deferred AS diferido,m.descuento AS descuento,m.totpag AS totalp,(m.totliq-m.deferred-m.descuento-m.totpag) AS totaltotal FROM mayorhacienda m INNER JOIN taxhacienda t ON m.idt=t.idt INNER JOIN 
		contrihacienda c ON m.idrfc=c.rfc WHERE m.idrfc='$comodinbusqueda'";
		return ejecutarConsulta($sql);		
	}



}
?>