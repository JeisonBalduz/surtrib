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
	public function insertar($rfc,$sector,$calle,$edificio,$numeroedif,$direccion,$ultima_declaracion,$idt,$idusuario,$tiposer)
	{
		$sql="INSERT INTO `ambiente`(`registered`, `tipotax`, `idtambiente`, `rfc`, `estatus`, `direccion`, `fechapago`, `sector`, `calle`, `edificio`, `nedificio`,`usuarioregis`) VALUES (now(),'$tiposer','$idt','$rfc','A','$direccion','$ultima_declaracion','$sector','$calle','$edificio','$numeroedif','$idusuario');";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$rfc,$sector,$calle,$edificio,$numeroedif,$direccion,$ultima_declaracion,$idt,$tiposer)
	{
		$sql="UPDATE ambiente SET 
					
    								`tipotax` = '$tiposer',
    								`idtambiente` = '$idt',
    								`rfc` = '$rfc',
    								`direccion` = '$direccion,',
    								`fechapago` = '$ultima_declaracion',
    								`sector` = '$sector',
    								`calle` = '$calle',
    								`edificio` = '$edificio',
    								`nedificio` = '$numeroedif'
								   
								   WHERE id='$id'";


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
	public function mostrar($id)
	{
		$sql="SELECT a.*,t.idt,t.tipotribute,t.tipotax,t.ramotax,t.categoriatax,t.tax FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt WHERE a.id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function taxasignada($taseoi)
	{
		$sql="SELECT * FROM taxaseo  WHERE idt='$taseoi'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function selectUsuario2($rfc)
	{
		$sql="SELECT rfc,name FROM users WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function mostrarp($rfc)
	{
		$sql="SELECT c.*,t.* FROM contri_iagesam c LEFT JOIN taxresidenciaambiente t ON c.taseoi=t.idtaxresidencia WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}
	//Implementar un método para listar los registros
	public function listar($busqueda)
	{
		$sql="SELECT a.id,a.rfc,t.tipotribute,a.idtambiente,a.direccion,a.fechapago,a.tipotax,t.tipotax,t.ramotax,t.categoriatax,t.tax FROM ambiente a LEFT JOIN taxaseo t ON a.idtambiente=t.idt WHERE rfc=$busqueda ORDER BY a.id DESC";
		return ejecutarConsulta($sql);		
	}

	public function listar2($busqueda)
	{
		$sql="SELECT c.*,c.estado AS ESTADO,t.* FROM contri_iagesam c LEFT JOIN taxempresasambiente t ON c.taseoi=t.idtaxempamb WHERE `rfc`='$busqueda'";
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