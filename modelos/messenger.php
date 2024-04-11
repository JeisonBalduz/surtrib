<?php

require '../config/Conexion.php';

Class Mensajes {
    
	public function BuscarUsuario($rfc_envio)
	{
		$sql="SELECT usuario AS resultado, nivel AS nivel FROM users WHERE  usuario= '$rfc_envio' ";
		$resultado = ejecutarConsulta($sql);
		$row = $resultado->fetch_assoc();
		
		return $row;
	}
	public function buscarUsuarioResivir($buscarUsuario_resivir)
	{
		$sql="SELECT * FROM users  WHERE usuario= '$buscarUsuario_resivir' ";
		$resultado = ejecutarConsulta($sql);
		$row = $resultado->fetch_assoc();
		
		return $row;
	}

	public function EnviarMensaje($rfc_envio, $name_enviado, $rfc_resivir, $nombreUsuario, $mensajes_texto, $visto, $fecha, $hora)
	{
		$sql="INSERT INTO messenger(rfc_envio, name_enviado, rfc_resivido, name_resivido, messenger, visto, fecha, hora) 
		VALUES ('$rfc_envio','$name_enviado','$rfc_resivir','$nombreUsuario', '$mensajes_texto', $visto,'$fecha','$hora')";
		$resultado = ejecutarConsulta($sql);
		
		return $resultado;
	}

	public function BuscarMensajesResividos($rfc)
	{
		$sql="SELECT *, DATE_FORMAT(m.fecha, '%d-%m-%Y') AS fecha_formateada FROM messenger m WHERE  m.rfc_resivido= '$rfc' ORDER BY m.id_mens DESC";		
		return ejecutarConsulta($sql);
	}
	public function BuscarTodosMensajes($id_mensaje)
	{
		$sql="SELECT * FROM messenger m WHERE  m.id_mens= '$id_mensaje' ";	
		$resultado = ejecutarConsulta($sql);
		$row = $resultado->fetch_assoc();	
		return $row;
	}
	public function ActualizarVistoMensajes($id_mensaje, $verMensajes)
	{
		$sql="UPDATE messenger SET visto = '$verMensajes' WHERE id_mens= '$id_mensaje' ";	
		return ejecutarConsulta($sql);
	}
	public function Bandejas($rfc_envio)
	{
		$sql="SELECT * FROM messenger WHERE  rfc_resivido = '$rfc_envio' ";
		$resultado = ejecutarConsulta($sql);

		return $resultado;
	}
}
?>