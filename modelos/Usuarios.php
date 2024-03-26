<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuarios
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($tipodocumento,$numerodocumento,$nombre,$login,$email,$telefonousuario,$clave,$direccionusuario,$imagen,$rol,$permisos)
	{
		$sql="INSERT INTO usuarios (tipodocumento,nuemrodocumento,nombre,login,email,telefonousuario,clave,direccionusuario,imagen,rol,estado)
		VALUES ('$tipodocumento','$numerodocumento','$nombreusuario','$login','$email','$telefonousuario','$clave','$rol','1')";
       // return ejecutarConsulta($sql);
        $idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	public function insertar2($tipodocumento,$numerodocumento,$nombre,$direccionusuario,$rol)
	{
		$sql="INSERT INTO usuarios (tipodocumento,numerodocumento,nombre,direccionusuario,rol,estado)
		VALUES ('$tipodocumento','$numerodocumento','$nombre','$direccionusuario','1','1')";
       // return ejecutarConsulta($sql);
        $idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count(1))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuarionew', '1')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$tipodocumento,$numerodocumento,$nombre,$login,$email,$telefonousuario,$clave,$direccionusuario,$imagen,$rol,$permisos)
	{
		$sql="UPDATE usuarios SET 
		 tipodocumento='$tipodocumento',
        numerodocumento='$numerodocumento',
        nombre='$nombre',
        login='$login',
        email='$email',
        telefonousuario='$telefonousuario',
        clave='$clave',
		direccionusuario='$direccionusuario',
        imagen='$imagen',
		rol='$rol' 
        WHERE idusuario='$idusuario'";
		
        ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuariopermiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuariopermiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuarios SET estado='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM users WHERE id='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM users";
		return ejecutarConsulta($sql);		
	}

	public function listar2()
	{
		$sql="SELECT * FROM usuarios WHERE rol=1";
		return ejecutarConsulta($sql);		
	}
    public function listarCambioContraseña()
    	{
    		$sql="SELECT * FROM users";
    		return ejecutarConsulta($sql);		
    	}

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuariopermiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT * FROM users WHERE  usuario='$login' AND contrasena='$clave'"; 
    	return ejecutarConsulta($sql);  
    }
   



}

?>