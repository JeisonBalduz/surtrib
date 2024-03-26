<?php 
require "../config/Conexion.php";
//require_once "../modelos/Bitacora.php";




   // $op=$_GET["op"];  

   switch ($_GET["op"]){
    case 'listar':
      listarBitacora();
    break;
    case 'verregistro':
      listarBitacora();
    break;
   }          
    

?>