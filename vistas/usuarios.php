<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Usuarios']==1)
{
?>
<!-- Inicio Contenido PHP-->

<!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->


<section class="content">
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
      
      <div class="card" id="listadoregistros">
            <div class="card-header">
              <h3 class="card-title">Listado de Usuarios</h3>
              <br>
              <!--</h3><button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>-->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbllistado2" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Opciones</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>RIJ</th>
                  <th>Telefono</th> 
                  <th>RUC</th> 
                </tr>
                </thead>
              <tbody>
                </tbody>
                <tfoot>
                <tr>
                <th>Opciones</th>
                <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Rol</th> 
                  <th>Estado</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>


          <div class="card card-info" id="formularioregistros">
              <div class="card-header">
                <h3 class="card-title">Formulario de Registro o Modificacio</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="formulario" id="formulario" method="POST">
                <div class="card-body">
                <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label>Nombre</label>
              <input type="hidden" name="idusuario" id="idusuario">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
              </div>
              <div class="form-group col-sm-6 col-xs-12">
              <label>Login</label>
              <input type="text" name="login" id="login" class="form-control" placeholder="Login" required>
            </div>
              
           </div>
          
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
              <label>Telefono</label>
                <input type="text" name="telefonousuario" id="telefonousuario" class="form-control" placeholder="Telefono">
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label>Correo</label>
              <input type="text" name="direccionusuario" id="direccionusuario" class="form-control" placeholder="Direccion" required>
            </div>
            </div>
            <div class="row">
                
                 <div class="form-group col-sm-6 col-xs-12">
              <label>Clave</label>
              <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" required>
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-info" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
             </div>
             <div class="row">
                 <div class="form-group col-sm-3 col-xs-12">
                 <label>Permisos:</label>
                <ul style="list-style: none;" id="permisos">
                </ul>
                </div>
            
            </div>
           
				</div>
              </form>
            </div>


          </div>
              <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      </div>
</section>
    
<!-- Fin Contenido PHP-->
<?php
}
else
{
  require 'noacceso.php';
}


require 'footer.php';
?>

<!-- DataTables -->

<script type="text/javascript" src="scripts/usuarios.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
<script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();
?>