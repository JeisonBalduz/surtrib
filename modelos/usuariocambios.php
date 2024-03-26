<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class usuarios {

    

    // Función para editar registros
    public function CambioContraseña($idusuario,  $rif, $clavehash)
    {
        $sql = "UPDATE users SET
                contrasena='$clavehash',
                rif='$rif'
                WHERE id='$idusuario'";

        return ejecutarConsulta($sql);
    }

}
?>