<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pagoamb
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	//Implementamos un método para insertar registros
	public function insertar()
	{
		$sql="INSERT INTO cpdv (momemt,tributo,monto,discount,deferred,fecha,p,falsedeferred,tramite,ctramite,user_id,ente,vistas, fecha_notifica) 
		VALUES (now(),'$TRIBUTO','$monto','$descuento','$diferido',curdate(),'D','0','000012','$tramite','$user','0','0',curdate()";
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
	public function desactivar($idpagoamb)
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
	public function mostrar($idpagoamb)
	{
		$sql="SELECT * FROM pagoambiente WHERE idpagoamb='$idpagoamb'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($idusuarioamb)
	{
		$sql="SELECT * FROM pagoambiente WHERE idusuarioamb='$idusuarioamb'";
		return ejecutarConsulta($sql);		
	}

	public function listar2()
	{
		$sql="SELECT * FROM pagoambiente";
		return ejecutarConsulta($sql);		
	}

}
?>