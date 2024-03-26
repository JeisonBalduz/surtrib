<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();


include("../config/Conexion.php");

$rfc = $_SESSION["rfc"];


$sql = "SELECT id FROM `relcompanyactivity` WHERE `rfc`='$rfc'";
$idact = ejecutarConsultaSimpleFila($sql);

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if (empty($idact) )
{
?>
    <!-- Inicio Contenido PHP-->
	
<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
                        <div class="card" id="listadoregistros">
                              <div class="card-header">
                                    <h3 class="card-title">Registro de Actividad Economica</h3>
                                    <h3></h3>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						           <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar de Actividad Economica</button>
				                        <a href="actividadeco.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Actividades Economicas Registradas</h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      
                                                      <th>Codigo</th>
                                                      <th>Detalle</th>
                                          
                                                     
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                
                                                      <th>Codigo</th>
                                                      <th>Detalle</th>
                                                      
                                                      
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
      </div>


            

            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro de Actividad Economica</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			      

                              <div class="row">
                                   
                                    <div class="form-group col-sm-12 col-xs-12">
                                    <label>Selecciones Actividad</label>
                                    <input type="hidden" name="id" id="id" class="form-control">
                                        <select name="actividad" id="actividad" class="form-control" data-live-search="true" required>Seleccione un Actividad Economica</select>
                                          
                                    </div>  
                              </div>
					   
                         </div>
                        <div class="card-footer">
					<button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                              <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                        </div>


                        

			</form>
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
        <script type="text/javascript" src="scripts/actividadeco.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

