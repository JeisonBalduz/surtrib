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


	public function buscarUsuarioRecibir($buscarUsuario_Recibir)
	{
	
		$sql="SELECT * FROM users  WHERE usuario= '$buscarUsuario_Recibir' ";
		$resultado = ejecutarConsulta($sql);
		$row = $resultado->fetch_assoc();
		
		return $row;
	}


	public function buscarUsuariototal($buscarUsuario_Recibir)
	{
	
		$sql="SELECT * FROM users  WHERE nivel= '$buscarUsuario_Recibir'  ";
		$resultado = ejecutarConsulta($sql);
		
		return $resultado;
	}


	public function EnviarMensaje($rfc_envio, $name_enviado, $rfc_recibido, $nombreUsuario, $mensajes_texto, $visto, $fecha, $hora)
	{
		$sql="INSERT INTO messenger(rfc_envio, name_enviado, rfc_recibido, name_recibido, messenger, visto, fecha, hora) 
		VALUES ('$rfc_envio','$name_enviado','$rfc_recibido','$nombreUsuario', '$mensajes_texto', $visto,'$fecha','$hora')";
		$resultado = ejecutarConsulta($sql);
		
		return $resultado;
	}


	public function actualizarMensaje($id_mensajeActualizar, $messenger_actualizar, $visto, $fecha, $hora)
	{
		$sql="UPDATE messenger 
		SET messenger = '$messenger_actualizar', visto = '$visto', fecha = '$fecha', hora = '$hora' 
		WHERE id_mens= '$id_mensajeActualizar' ";	
		return ejecutarConsulta($sql);
	}


	public function BuscarTodosContribuyentes($nivelUsuarioContribuyente)

	{
		$sql = "SELECT * FROM users WHERE nivel= '$nivelUsuarioContribuyente' LIMIT 10";
		$resultado = ejecutarConsulta($sql);
		return $resultado ;
	}


	public function BuscarMensajesRecibidos($rfc)
	{
		$sql="SELECT *, DATE_FORMAT(m.fecha, '%d-%m-%Y') AS fecha_formateada FROM messenger m WHERE  m.rfc_recibido= '$rfc' ORDER BY m.id_mens DESC";		
		return ejecutarConsulta($sql);
	}


	public function BustarMensajesEnviados($rfc)
	{
		$sql="SELECT *, DATE_FORMAT(m.fecha, '%d-%m-%Y') AS fecha_formateada FROM messenger m WHERE  m.rfc_envio= '$rfc' ORDER BY m.id_mens DESC";		
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


	public function Bandejas( $rfc_envio_usuario, $rfc_envio_recibido)
	{
		$sql1="SELECT COUNT(id_mens) AS numero_mensaje FROM messenger WHERE  rfc_recibido = '$rfc_envio_recibido' and  visto = '1'";
		$resultado1 = ejecutarConsultaSimpleFila($sql1);

		$sql2="SELECT COUNT(id_mens) AS numeros_mensaje FROM messenger WHERE  rfc_envio = '$rfc_envio_usuario' ";
		$resultado2 = ejecutarConsultaSimpleFila($sql2);

		$resultados = array(
			"mensajes_recibidos" => $resultado1,
			"mensajes_enviados" =>$resultado2,
		  );
		
		  return $resultados;
	}
}
?>