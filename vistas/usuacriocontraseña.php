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

<style>
  .custom-select-sm {
      font-size: 110% !important; 
  }
 .contenedor-input{
  display: flex;
  justify-content: center;
  align-items: center;
  
 }
 /*
 .contenedor-input div{
  position: relative;
  right: 1.8rem;
  background-color: #e2e3e7;
  padding: 8px;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
  cursor: pointer;
 }
 */
</style>
<section class="content">
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
      
      <div class="card" id="listadoregistros">
            <div class="card-header">
              <h3 class="card-title">Listado de Usuarios</h3>
              <br>
              <!--ALERTA  </h3><button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>-->
              <div id="mensaje">

            <!--ALERTA  -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbllistado22" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th id="idcolumna">#</th>
                  <th>Nombre</th>
                  <th>Login</th>
                  <th>Teléfono</th>
                  <th>RIF/C.I</th>
                  <th>Opciones</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>


          <div class="card card-info" id="formularioregistros">
              <div class="card-header">
                <h3 class="card-title">Formulario De Cambio De Contraseña</h3>
              </div>
             
              <!-- /.card-header -->
              <!-- form start -->
              <form name="formulario" id="formulario" method="POST">
                <div class="card-body">
                <div class="row">
            <div class="form-group col-sm-6 col-xs-12">
              <label>Nombre</label>
              <input type="hidden" name="idusuario" id="idusuario" >
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" readonly required>
              </div>
              <div class="form-group col-sm-6 col-xs-12">
              <label>Login</label>
              <input type="text" name="login" id="login" class="form-control" placeholder="Login" readonly required>
            </div>
              
           </div>
          
            <div class="row">
                <div class="form-group col-sm-6 col-xs-12">
              <label>Teléfono</label>
                <input type="text" name="telefonousuario" id="telefonousuario" class="form-control" placeholder="Teléfono" readonly required>
            </div>
            
            <div class="form-group col-sm-6 col-xs-12"> 
            <label>Rif/C.I</label>
            <input type="text" name="numerodocumento" id="rif" class="form-control" placeholder="RIF/C.I" readonly required>
            </div>

            </div>

            <div class="row">
                
            <div class="form-group col-sm-6 col-xs-12">
              <label>Clave Nueva</label>
              <div class=" contenedor-input">
                <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave Nueva" required>
                 <div class="contenedor-imagen" id="candado">
                 
                 </div> 
              </div>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
                <input type="hidden" value="botonguardar" name="op">
            </div>


            <div class="row">
                
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-info" type="" name="botonguardar" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>

            <div >
              <!--
                 <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <label>Permisos:</label>
                <ul style="list-style: none;" id="permisos">
                </ul>
                </div>
                -->
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
<script type="text/javascript" src="scripts/usuariocontrasena.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
<script type="text/javascript" src="scripts/cierre-sesion.js"></script>

<?php 
}


ob_end_flush();
?>
