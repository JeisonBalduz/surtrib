<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empamb
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($rif,$licencia,$medit)
	{
		$sql="INSERT INTO contri_iagesam (rif,licencia,medit,estado)
		VALUES ('$rif','$licencia','$medit','0')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($rfc,$idusuario,$licencia,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$docrif,$docregistro,$registrado,
							 $conformidaduso,$tieneinmueble,$taseoi,$ultima_declaracion)
	{
		$sql="UPDATE contri_iagesam SET 
								   idusuario='$idusuario',
								   licencia='$licencia',
								   sector='$sector',
								   calle='$calle',
								   edificio='$edificio', 
								   numeroedif='$numeroedif',
								   medit='$medit',
								   representative='$representative',
								   docrif='$docrif', 
								   docregistro='$docregistro',
								   registrado='$registrado',
								   conformidaduso='$conformidaduso',
								   tieneinmueble='$tieneinmueble',
								   taseoi='$taseoi',
								   ultima_declaracion='$ultima_declaracion'
								   
								   WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}

	public function editarTax($rfc,$taseoi)
	{
		$sql="UPDATE contri_iagesam SET taseoi='$taseoi' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}

	
	//Implementamos un método para desactivar Clientes
	public function desactivar($rfc)
	{
		$sql="UPDATE contri_iagesam SET estado ='0' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($rfc)
	{
		$sql="UPDATE contri_iagesam SET estado ='1' WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($rfc)
	{
		$sql="SELECT c.*,t.* FROM contri_iagesam c LEFT JOIN taxempresasambiente t ON c.taseoi=t.idtaxempamb WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function mostrarp($rfc)
	{
		$sql="SELECT c.*,t.* FROM contri_iagesam c LEFT JOIN taxresidenciaambiente t ON c.taseoi=t.idtaxresidencia WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}
	//Implementar un método para listar los registros
	public function listar($idusuario)
	{
		$sql="SELECT * FROM contri_iagesam WHERE idusuario='$idusuario' ORDER BY estado DESC";
		return ejecutarConsulta($sql);		
	}

	public function listar2($busqueda)
	{
		$sql="SELECT c.*,c.estado AS ESTADO,t.* FROM contri_iagesam c LEFT JOIN taxempresasambiente t ON c.taseoi=t.idtaxempamb WHERE `rif`='$busqueda'";
		return ejecutarConsulta($sql);		
	}

	public function listar3($busqueda)
	{
		$sql="SELECT c.*,c.estado AS ESTADO,t.* FROM contri_iagesam c LEFT JOIN taxresidenciaambiente t ON c.taseoi=t.idtaxresidencia WHERE `rif`=$busqueda";
		return ejecutarConsulta($sql);		
	}

	public function selectInmueble($rifbusqueda)
	{
		$sql="SELECT * FROM contri_iagesam WHERE rif='$rifbusqueda' ORDER BY descripcion DESC";
		return ejecutarConsulta($sql);		
	}

	public function mostrartasaind($rfc)
	{
		$sql="SELECT c.taseoi,t.* FROM `contri_iagesam` c LEFT JOIN taxempresasambiente t ON c.taseoi=t.idtaxempamb WHERE `rfc`='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}




}
?>