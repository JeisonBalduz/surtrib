<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

include("../config/Conexion.php");

$rfc = $_SESSION["rfc"];



if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['Escritorio']==1)
{
?>
<style>
    table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    padding-right: 60px !important;
}
</style>
<div class="row">
    <div class="col-md-12">
        <section class="content-header">
            <!-- Modal de envio de mensajes de los usuarios -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content ">
                                <div class="modal-header" >
                                    <div class="titulo__modal container d-flex justify-content-center">
                                        <h5 class="modal-title">Realizar envio de mensaje</h5>
                                    </div>
                                    <button type="button"id="boton-x" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" id="formularioMensajes" method="post" name="formularioc">
                                    <div class="modal-body">
                                    
                                                    <div class="row">
                                                        <div class="input-group mb-3 col-sm-6">
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text" for="inputGroupSelect01">Opciones</label>
                                                            </div>
                                                            <select class="custom-select" id="inputGroupSelect01">
                                                                <option selected>Seleccione una Opción</option>
                                                                <option value="todoC">Todos los contribuyentes</option>
                                                                <option value="todoA">Todos los administrativos</option>
                                                                <option value="contribuyente" class="Contribuyente" id="contri">Un contribuyente</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group mb-3 col-sm-6" id="contentCont" hidden>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="nav-icon fas fa-user"></i></span>
                                                            </div>
                                                            <input type="text" name="personal_resivir" id="personal_resivir" class="form-control input_usuario" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" disabled>
                                                        </div>
                                                    </div>
                                                    <textarea class="form-control form-control-lg"  id="messenger" cols="30" rows="10"></textarea>
                                                
                                    </div>
                                    <div class="modal-footer">  
                                        <input class="btn btn-primary " type="submit" value="Enviar Mensaje" id="boton_envio" >      
                                        <button type="button" id="boton-cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
        <!-- Modal de mostrar los mensajes de los usuarios -->
                <div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                                <div class="modal-header" >
                                    <div class="titulo__modal container d-flex justify-content-center">
                                        <h5 class="modal-title">Mensaje Resivido</h5>
                                    </div>
                                    <button type="button"id="boton-x" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" id="formularioMensajes" method="post" name="formularioc">
                                    <div class="modal-body">
                                                    <div id="mensajes">

                                                    </div>
                                        
                                                    <textarea class="form-control form-control-lg textInfo"  id="messenger_resivido" cols="30" rows="10"></textarea>
                                                
                                    </div>
                                    <div class="modal-footer">       
                                        <button type="button" id="boton-cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PLATAFORMA DE MENSAJERIA</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right" id="conten_home">
                            <li class="breadcrumb-item"><a href="#">concepto</a></li>
                            <li class="breadcrumb-item active">Inbox</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary btn-block mb-3 text-lg" id="button-mensaje" data-toggle="modal" data-target="#exampleModalCenter">Mensaje</button>
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Carpetas</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                
                                <li class="nav-item active">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-inbox mx-2"></i> Bandeja de entrada
                                        <span class="badge bg-primary float-right" id="bandeja_entrada">12</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-envelope mx-2"></i> Enviados
                                        <span class="badge bg-warning float-right" id="bandeja_enviados">65</span>
                                    </a>
                                </li>           
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Labels</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-danger"></i>
                                        Important
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-warning"></i> Promotions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-primary"></i>
                                        Social
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Mensajes</h3>
                            <!-- <div class="card-tools">
                                <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div> 

                    <div class="card-body p-0">
                        <div class="mailbox-controls">
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                <i class="far fa-square"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>

                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="table-responsive mailbox-messages p-3">
                            <table class="table table-hover table-striped" id="tablet">
                                <thead>
                                                    <tr>
                                                        <th>Opción</th>
                                                        <th>Nombre</th>
                                                        <th>Mensaje</th>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>                                                       
                                                    </tr>
                                            </thead>
                                <tbody >
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div class="card-footer p-0">
                            <div class="mailbox-controls">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="far fa-square"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="fas fa-share"></i>
                                    </button>
                                </div>

                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
         
<?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/messenger.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
<script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();

?>
