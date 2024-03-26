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

	public function insertar($tipodocumento,$numerodocumento,$nombreusuario,$login,$email,$telefonousuario,$clave,$rol)
	{
		$sql="INSERT INTO usuarios (tipodocumento,numerodocumento,nombre,login,email,telefonousuario,clave,rol,estado)
		VALUES ('$tipodocumento','$numerodocumento','$nombreusuario','$login','$email','$telefonousuario','$clave','$rol','1')";
        $idusuarionew=ejecutarConsulta_retornarID($sql);

        $sw=true;

		
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '1')";
			ejecutarConsulta($sql_detalle) or $sw = false;

		return $sw;
		
		
	}

	
	public function verificarlogina($logina)
    {
    	$sql="SELECT login FROM usuarios WHERE login='$logina' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }

	public function verificarnumerodocumento($numerodocumento)
    {
    	$sql="SELECT numerodocumento FROM usuarios WHERE numerodocumento='$numerodocumento' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }

  
}

?>