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

if ($_SESSION['Escritorio']==1)
{
?>
    <!-- Inicio Contenido PHP-->
	
<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
                        <div class="card" id="listadoregistros">
                              <div class="card-header">
                                    <h3 class="card-title">Liquidacion Catastro</h3>
                                    <h3></h3>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						           <!-- <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar Nuevo Vehiculo </button>-->
				                        <a href="http://localhost/surtri/vistas/bancos.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Liquidaciones por Aprobar </h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>RUF</th>
                                                      <th>RIF</th>
                                                      <th>Razon Social</th>
                                                      <th>Tasa</th>
                                                      <th>Unidad</th>
                                                      <th>Fecha</th>
                                                     
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Opciones</th>
                                                      <th>RUF</th>
                                                      <th>RIF</th>
                                                      <th>Razon Social</th>
                                                      <th>Tasa</th>
                                                      <th>Unidad</th>
                                                      <th>Fecha</th>
                                                      
                                                      
                                                </tr>     					
                                          </tfoot>
                                    </table>


                                    <div class="modal fade" name="formulario2" id="formulario2">
                                          <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                      <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                            <h4 class="modal-title">Declaracion de Tasa Catastro</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <div class="col-sm-12">
                                                                  <h6 class="modal-title">Datos Contribuyentes</h6>
                                                                        <div class="row">
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>Nombre</label>
                                                                                          <input type="hidden" name="idttc" id="idttc" class="form-control" required>
                                                                                          <input type="hidden" name="iduser" id="iduser" class="form-control" required>
                                                                                          <input type="hidden" name="rfc2" id="rfc2" class="form-control" required>
                                                                                          <input type="text" name="nombre" id="nombre" class="form-control" readonly>  
                                                                              </div>
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>RIF</label>
                                                                                          <input type="text" name="rif" id="rif" class="form-control" readonly>  
                                                                              </div>
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>RFC</label>
                                                                                          <input type="text" name="rfc" id="rfc" class="form-control" readonly>  
                                                                              </div>
                                                                        </div>
                                                            </div>      
                                                            <hr>
                                                            <div class="col-sm-12">
                                                                  <h6 class="modal-title">Datos Tasa</h6>
                                                                        <div class="row">
                                                                              <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label>N°</label>
                                                                                          <input type="text" name="idtc" id="idtc" class="form-control" readonly>        
                                                                              </div>
                                                                              <div class="form-group col-sm-6 col-xs-12">
                                                                                    <label>Unidad</label>
                                                                                          <input type="text" name="metros" id="metros" class="form-control" readonly>
                                                                              </div>
                                                                        </div>
                                                                  
                                                                        <div class="row">
                                                                              <div class="form-group col-sm-12 col-xs-12">
                                                                                    <label>Tasa</label>
                                                                                    <input type="text" name="detalle" id="detalle" class="form-control" readonly>
                                                                              </div>
                                                                        </div>
                                                                  
                                                               
                                                                  <button type="submit" onclick="insertartramitemv()" id="btn_declararvehiculo" class="btn btn-info float-right">Declarar</button>
                                                            </div> 
                                                      </div>
                                               </div>
                                               <!-- /.modal-content -->
                                          </div>
                                           <!-- /.modal-dialog -->
                                    </div>
                              </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div id="respuesta_ticket">
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
        <script type="text/javascript" src="scripts/liquidacioncatastro.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

