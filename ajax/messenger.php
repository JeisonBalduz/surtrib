<?php
session_start();
date_default_timezone_set("America/Caracas");
require '../modelos/Messenger.php';
$mensajes =new mensajes();
$rfc = $_SESSION['rfc'];
if($rfc == 0){
    $rfc_envio = $_SESSION['usuario'];
 }else{
    $rfc_envio = $_SESSION['rfc'];
 }
$name_enviado = $_SESSION['nombre'];
$buscarUsuario_Recibir =isset($_POST["personal_recibir"])? limpiarCadena($_POST["personal_recibir"]):"";
$rfc_recibido =isset($_POST["identificadorUsuario"])? limpiarCadena($_POST["identificadorUsuario"]):"";
$mensajes_texto=isset($_POST["messenger"])? limpiarCadena($_POST["messenger"]):"";
$nombreUsuario = isset($_POST["nombreUsuario"])? limpiarCadena($_POST["nombreUsuario"]):"";
$id_mensaje =isset($_POST["id_mensaje"])? limpiarCadena($_POST["id_mensaje"]):"";
$verMensajes=isset($_POST["vistomensaje"])? limpiarCadena($_POST["vistomensaje"]):"";
$id_mensajeActualizar=isset($_POST["id_mens_actualizar"])? limpiarCadena($_POST["id_mens_actualizar"]):"";
$messenger_actualizar=isset($_POST["textInfoMessenger"])? limpiarCadena($_POST["textInfoMessenger"]):"";
$nivelUsuarioContribuyente=isset($_POST["nivelContribuyente"])? limpiarCadena($_POST["nivelContribuyente"]):"";
switch ($_GET["op"]) {
    case 'buscarUsuario':
        $rspta=$mensajes->BuscarUsuario($rfc_envio);
        echo json_encode($rspta);
    break;

    case 'buscarUsuarioRecibir': 
        $rspta=$mensajes->buscarUsuarioRecibir($buscarUsuario_Recibir);
        echo json_encode($rspta);
    break;

    case 'buscarUsuariototal': 
        $rspta=$mensajes->buscarUsuariototal($buscarUsuario_Recibir);
       //Vamos a declarar un array
       $data= Array();
    
       while ($reg= $rspta->fetch_object()){
           $data[]=array(
                "0"=>$reg->usuario,
                "1"=>$reg->name,
                "2"=>$reg->nivel,
                "3"=>$reg->rfc
               );
       }
       echo json_encode($data);
    break;
    
    case 'buscarUsuarioContribuyente': 
        $rspta=$mensajes;
        echo json_encode($rspta);
    break;

    case 'buscarUsuarioAdministrativo': 
        $rspta=$mensajes;
        echo json_encode($rspta);
    break;

    case 'enviarMensaje':
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $visto = 1;
        $rspta=$mensajes->EnviarMensaje($rfc_envio, $name_enviado, $rfc_recibido, $nombreUsuario, $mensajes_texto, $visto, $fecha, $hora);
        
    break;

    case 'BuscarTodosContribuyentes':
        $rspta=$mensajes->BuscarTodosContribuyentes($nivelUsuarioContribuyente);

        while ($reg= $rspta->fetch_object()){
             $data[]=array(
                "0"=>$reg->usuario,
                "1"=>$reg->name,
                "2"=>$reg->rif,
                 );
         }
         echo json_encode($data);

         
    
    break;

    case 'ActualizarMensaje':
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $visto = 1;

        echo $id_mensajeActualizar." ". $messenger_actualizar;

        $rspta = $mensajes->actualizarMensaje($id_mensajeActualizar, $messenger_actualizar, $visto, $fecha, $hora);
        
    break;

    case 'BustarMensajesRecibidos':
        $rspta=$mensajes->BuscarMensajesRecibidos($rfc_envio);
       
     		//Vamos a declarar un array
     		$data= Array();
    
     		while ($reg= $rspta->fetch_object()){
                $visto =$reg->visto;
                if ($visto == 0) {
                    $vistoMensajes = '<div class="card-tools"><span class="badge badge-danger">Mensaje Revisado</span></div>';
                }else{
                    $vistoMensajes = '<div class="card-tools"><span class="badge badge-success">Revisar Mensaje</span></div>';
                }

     			$data[]=array(
     				"0"=>'
                    <button class="btn btn-info d-flex justify-content-center align-items-center text-center boton-refres"
                     onclick="mostrar('.$reg->id_mens.')" id="id_mensajeResivido" data-toggle="modal" data-target="#modalMostrar" style="width: 130px;">
                    <i class="fa fa-eye ojo-icon"></i><div class = "mx-2">Ver Mensaje</div>
                    </button>',
    				"1"=>$reg->name_enviado,
                    "2"=>$vistoMensajes,
                    "3"=>$reg->fecha_formateada,
                    "4"=>$reg->hora
     				);
     		}
     		$results = array(
     			"sEcho"=>1, //Información para el datatables
     			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
     			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
     			"aaData"=>$data);
     		echo json_encode($results);
        
    break;

    case 'BustarMensajesEnviados':
        $rspta=$mensajes->BustarMensajesEnviados($rfc_envio);
       
     		//Vamos a declarar un array
     		$data= Array();
    
     		while ($reg= $rspta->fetch_object()){
                $visto =$reg->visto;
                if ($visto == 0) {
                    $vistoMensajes = '<div class="card-tools"><span class="badge badge-success">Mensaje Revisado</span></div>';
                }else{
                    $vistoMensajes = '<div class="card-tools"><span class="badge badge-danger">Sin revisar</span></div>';
                }

     			$data[]=array(
     				"0"=>'<button class="btn btn-info d-flex justify-content-center align-items-center text-center boton-refres"
                     onclick="mostrarEnvio('.$reg->id_mens.')" id="id_mensajeEnviado" data-toggle="modal" data-target="#modalMostrar" style="width: 130px;">
                    <i class="fa fa-eye ojo-icon"></i><div class = "mx-2">Ver Mensaje</div>
                    </button>',
    				"1"=>$reg->name_enviado,
                    "2"=>$reg->name_recibido,
                    "3"=>$vistoMensajes,
                    "4"=>$reg->fecha_formateada,
                    "5"=>$reg->hora
     				);
     		}
     		$results = array(
     			"sEcho"=>1, //Información para el datatables
     			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
     			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
     			"aaData"=>$data);
     		echo json_encode($results);
        
    break;
    
    case 'BustarTodosMensajes':
        $rspta=$mensajes->BuscarTodosMensajes($id_mensaje);
        echo json_encode($rspta);
    break;

    case 'verMensajes':
        $rspta=$mensajes->ActualizarVistoMensajes($id_mensaje, $verMensajes);
        echo json_encode($rspta);
    break;
    
    case 'bandejaMensajes':
        $rfc_envio_usuario = $rfc_envio;
        $rfc_envio_recibido = $rfc_envio;
        $rspta=$mensajes->Bandejas( $rfc_envio_usuario, $rfc_envio_recibido);
        echo json_encode($rspta);
    break;
    
    default:
        # code...
    break;
}


 
?>