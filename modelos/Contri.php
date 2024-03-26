<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contrib
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
		$sql="INSERT INTO contri (licencia,tiponac,cedularif,razsocial,correo,tlf,codcel,celular,modo,estado_pk,municipio_pk,
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
		$sql="UPDATE contri SET 
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
		$sql="UPDATE contri SET estatus ='D' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($rfc)
	{
		$sql="UPDATE contri SET estatus ='A' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($rfc)
	{
		$sql="SELECT * FROM contriambiente WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($comodinbusqueda)
	{
		$sql="SELECT * FROM contri WHERE rfc='$comodinbusqueda'";
		return ejecutarConsulta($sql);		
	}

	public function select()
	{
		$sql="SELECT * FROM contriambiente";
		return ejecutarConsulta($sql);		
	}

}
?>