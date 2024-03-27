<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Facturaaseo
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar($nombre,$rif,$fechapago,$direccion,$conceptopago1,$monto1,$conceptopago2,$monto2,$conceptopago3,$monto3,$conceptopago4,$monto4,$conceptopago5,$monto5,$montotal,$telefono,$correo,$formapago,$iduser)
	{
		$sql="INSERT INTO `facturaambiente`(`nombre`, `rif`, `fechapago`, `direccion`, `conceptopago1`, `monto1`, `conceptopago2`, `monto2`, `conceptopago3`, `monto3`, `conceptopago4`, `monto4`, `conceptopago5`, `monto5`, `montotal`,`nfactura`,`momento`, `telefono`,`correo`,`formapago`,`useregistro`) VALUES ('$nombre','$rif','$fechapago','$direccion','$conceptopago1','$monto1','$conceptopago2','$monto2','$conceptopago3','$monto3','$conceptopago4','$monto4','$conceptopago5','$monto5','$montotal',((SELECT MAX(nfactura) FROM facturaambiente as nf)+1),now(),'$telefono','$correo','$formapago','$iduser')";
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($id,$nombre,$status,$rif,$codigo)
	{
		$sql="UPDATE banco SET 
								   nombre='$nombre',
								   status='$status',
								   rif='$rif', 
								   codigo='$codigo'
								   
								   WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($id)
	{
		$sql="UPDATE banco SET estado ='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($id)
	{
		$sql="UPDATE banco SET estado ='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql="SELECT * FROM banco WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM facturaambiente ORDER BY `facturaambiente`.`id` DESC";
		return ejecutarConsulta($sql);		
	}



}
?>