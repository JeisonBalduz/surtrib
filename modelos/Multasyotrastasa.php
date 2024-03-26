<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Multas
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros

	public function insertar($rfc,$vidt,$iduser,$resolucion,$monto,$obs)
	{

		$sql="CALL IncluirMulta('$rfc','$vidt','$iduser','$obs','$resolucion','$monto')";
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
	public function mostrar($rfc)
	{
		$sql="SELECT * FROM contrihacienda WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function tasasadmin($busqueda)
	{
		$sql="SELECT id,name,rfc,rif FROM users WHERE rfc='$busqueda'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function selectasas()
	{
		$sql="SELECT * FROM tributes WHERE umt=0";
		return ejecutarConsulta($sql);		
	}

	public function listar()
	{
		$sql="SELECT g.hashkey AS tramite,v.* FROM vehicle v LEFT JOIN gaugingvehicle g ON g.idrelvehicle=v.id INNER JOIN users u ON v.rfc=u.rfc WHERE u.rfc='$rfc' ORDER BY v.id DESC";
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