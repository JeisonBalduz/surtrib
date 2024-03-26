<?php 


require_once "../modelos/usuariocambios.php";
$usuarios=new Usuarios();
if(empty($_POST['op'] ) || 
empty($_POST['idusuario'] ) || 
empty($_POST['numerodocumento'] ) || 
empty($_POST['clave'] )){
	
	exit();
}else{
	$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
	$rif = isset($_POST["numerodocumento"])? limpiarCadena($_POST["numerodocumento"]):"";
	$clave = $_POST['clave'];
	


// Función para validar los datos
function validarDatos() {
	// Implementar las validaciones necesarias
	// ...
	return true; // Devolver true si los datos son válidos
}

switch (isset($_POST['op'])){

	case 'op':
		
					// Validar los datos antes de insertar o editar
		if (!validarDatos()) {
			// Manejar los errores de validación
			// ...
		} else {
			if (empty($idusuario)) {
				// Insertar usuario
				echo "no";
			} else {
				$clavehash=hash("md5",$clave);
				// Editar usuario
				$rspta = $usuarios->CambioContraseña($idusuario,  $rif, $clavehash);

				echo "ok";
			}
		}
		
	break;
}
}

?>