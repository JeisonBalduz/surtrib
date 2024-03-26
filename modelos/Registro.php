<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros

	public function insertar($tipodocumento,$numerodocumento,$nombreusuario,$email,$telefonousuario,$clave)
	{

		$sql="INSERT INTO `citizen`(`licencia`, `tiponac`, `cedularif`, `razsocial`, `correo`,`celular`, `modo`, `estado_pk`, `sector`, `calle`, `edificio`, `numeroedif`, `registrado`, `estatus`) 
		VALUES ('0','$tipodocumento','$numerodocumento','$nombreusuario','$email','$telefonousuario','Contr','5','0','0','0','0',now(),'A')";
        $idrfc=ejecutarConsulta_retornarID($sql);

		
		$sql="INSERT INTO `users` (`usuario`, `contrasena`, `estatus`, `name`,`nivel`, `correo`, `tel`, `alias`, `ws`, `wp`, `registro`, `collector_id`, `rif`, `rfc`) VALUES 
		('$idrfc','$clave','R','$nombreusuario','2','$email',NULL,NULL,NULL,NULL,now(),'1','$tipodocumento$numerodocumento','$idrfc')";
        $idusuarionew=ejecutarConsulta_retornarID($sql);

        $sw=true;

		
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '1')";
			ejecutarConsulta($sql_detalle) or $sw = false;

		return $idrfc;


		
		
	}

	
	public function verificarlogina($logina)
    {
    	$sql="SELECT login FROM usuarios WHERE login='$logina' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }

	public function verificarnumerodocumento($numerodocumento)
    {
    	$sql="SELECT cedularif FROM citizen WHERE cedularif='$numerodocumento' AND estatus='A'"; 
    	return ejecutarConsulta($sql);  
    }

  
}

?>