<?php
session_start();
require '../modelos/messenger.php';
$mensajes =new mensajes();
$rfc = $_SESSION['rfc'];
if($rfc == 0){
    $rfc_envio = $_SESSION['usuario'];
 }else{
    $rfc_envio = $_SESSION['rfc'];
 }
$name_enviado = $_SESSION['nombre'];
$buscarUsuario_resivir =isset($_POST["personal_resivir"])? limpiarCadena($_POST["personal_resivir"]):"";
$rfc_resivir =isset($_POST["identificadorUsuario"])? limpiarCadena($_POST["identificadorUsuario"]):"";
$mensajes_texto=isset($_POST["messenger"])? limpiarCadena($_POST["messenger"]):"";
$nombreUsuario = isset($_POST["nombreUsuario"])? limpiarCadena($_POST["nombreUsuario"]):"";
$id_mensaje =isset($_POST["id_mensaje"])? limpiarCadena($_POST["id_mensaje"]):"";
$verMensajes=isset($_POST["vistomensaje"])? limpiarCadena($_POST["vistomensaje"]):"";
switch ($_GET["op"]) {
    case 'buscarUsuario':
        $resf=$mensajes->BuscarUsuario($rfc_envio);
        echo json_encode($resf);
    break;

    case 'buscarUsuarioResivir': 
        $resf=$mensajes->buscarUsuarioResivir($buscarUsuario_resivir);
        echo json_encode($resf);
    break;

    case 'buscarUsuariototal': 
        $resf=$mensajes->buscarUsuariototal($buscarUsuario_resivir);
       //Vamos a declarar un array
       $data= Array();
    
       while ($reg= $resf->fetch_object()){
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
        $resf=$mensajes;
        echo json_encode($resf);
    break;
    case 'buscarUsuarioAdministrativo': 
        $resf=$mensajes;
        echo json_encode($resf);
    break;

    case 'enviarMensaje':
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $visto = 1;
        $resf=$mensajes->EnviarMensaje($rfc_envio, $name_enviado, $rfc_resivir, $nombreUsuario, $mensajes_texto, $visto, $fecha, $hora);
        
    break;

    case 'enviarMensajeContribuyente':
          

        
    break;

    case 'BustarMensajesResividos':
        $resf=$mensajes->BuscarMensajesResividos($rfc_envio);
       
     		//Vamos a declarar un array
     		$data= Array();
    
     		while ($reg= $resf->fetch_object()){
                $visto =$reg->visto;
                if ($visto == 0) {
                    $vistoMensajes = '<div class="bg-danger p-1 text-center rounded" style="width: 130px;">Mensaje Revisado</div>';
                }else{
                    $vistoMensajes = '<div class="bg-success p-1 text-center rounded" style="width: 130px;">Revisar Mensaje</div>';
                }

     			$data[]=array(
     				"0"=>'
                    <button class="btn btn-info d-flex justify-content-center align-items-center text-center boton-refres"
                     onclick="mostrar('.$reg->id_mens.')" id="id_mensaje" data-toggle="modal" data-target="#modalMostrar" style="width: 130px;">
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
    case 'BustarTodosMensajes':
        $resf=$mensajes->BuscarTodosMensajes($id_mensaje);
        echo json_encode($resf);
    break;
    case 'verMensajes':
        $resf=$mensajes->ActualizarVistoMensajes($id_mensaje, $verMensajes);
        echo json_encode($resf);
    break;
    
    case 'bandejaMensajes':
        $rfc_envio_usuario = $rfc_envio;
        $rfc_envio_resividos = $rfc_envio;
        $resf=$mensajes->Bandejas( $rfc_envio_usuario, $rfc_envio_resividos);
        echo json_encode($resf);
    break;
    
    default:
        # code...
    break;
}


 
?>