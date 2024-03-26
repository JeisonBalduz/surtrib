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
                                    <h3 class="card-title">Pago Por Conciliar</h3>
                                    <a href="verificarpago.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
			            <div class="card-header">
                                     <div class="row">
                                          <div class="form-group col-sm-5 col-xs-4">
                                                <label>Desde</label>
                                                <input type="date" name="fechadia" id="fechadia" class="form-control" placeholder="today()">
                                          </div>
                                          <div class="form-group col-sm-5 col-xs-4">
                                                <label>Hasta</label>
                                                <input type="date" name="fechadia2" id="fechadia2"  class="form-control" placeholder="today()">
                                          </div>  
                                          <div class="form-group col-sm-2 col-xs-4">
                                              <label>Busqueda</label><br/>
                                                <button type="submit" onclick="listarporfecha();" class="btn btn-info">Mostrar</button>
                                          </div>  
                                    </div>
				      </div>
				
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Pagos Registrados</h3>
                               </div>
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Opciones</th>
                                                <th>Fecha</th>
                                                <th>RUC</th>
                                                <th>Nombre</th>
                                                 <th>Tributo</th>
                                                  <th>Tramite</th>
                                                  <th>Monto</th>
                                                  <th>Referencia</th>
                                                  <th>Soporte</th>
                                                                                   
                                                
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                      <th>Opciones</th>
                                                <th>Fecha</th>
                                                <th>RUC</th>
                                                <th>Nombre</th>
                                                 <th>Tributo</th>
                                                  <th>Tramite</th>
                                                  <th>Monto</th>
                                                  <th>Referencia</th>
                                                  <th>Soporte</th>                                     
            
                                                  
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>

            <div class="modal fade" id="capture">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                                    <h5 class="modal-title">Capture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                    </button>
                              </div>
                              <div class="modal-body">
                              <div class="form-group col-sm-12 col-xs-12">
                                                      <label>Imagen</label>
                                                      <div class="col-12">
                                                            <img src="" name="capture2" id="capture2">
                                                      </div>
                                                </div>
                              </div>
                        </div>
          <!-- /.modal-content -->
                  </div>
        <!-- /.modal-dialog -->
             </div>



          <div class="modal fade" name="formulariopago" id="formulariopago">
                  <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                              <div class="modal-header" style="background-color: #17a2b8;color: white">
                                    <h4 class="modal-title">Conciliacion</h4>
                                          <button type="button" class="close" onclick="limpiar()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form role="form" name="formulariopago2" id="formulariopago2" method="POST">
                              <div class="modal-body">
                                    <div class="col-sm-12">
                                          <div class="row">
                                                <div class="form-group col-sm-2 col-xs-12">
                                                      <label>RUC</label>
                                                      <input type="hidden" name="id" id="id" class="form-control"> 
                                                      <input type="hidden" name="tributo" id="tributo" class="form-control"> 
                                                      
                                                      <input type="hidden" name="idtramite" id="idtramite" class="form-control">    
                                                      <input type="text" name="rfc" id="rfc" class="form-control" disabled>        
                                                </div>
                                                <div class="form-group col-sm-10 col-xs-12">
                                                      <label>Razon Social</label> 
                                                      <input type="text" name="name" id="name" class="form-control" disabled>        
                        
                                                </div>
                                          </div>
                                          <div class="row">
                                                
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Tramite</label>  
                                                      <input type="text" name="ctramite" id="ctramite" class="form-control" disabled>         
                                                </div>
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Recibo</label>  
                                                      <input type="text" name="tramite" id="tramite" class="form-control" disabled>        
                                                </div>
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Referencia</label> 
                                                      <input type="text" name="ref" id="ref" class="form-control" disabled>        
                                                </div>
                                          </div>
                                          <div class="row">
                                                
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Fecha</label> 
                                                      <input type="text" name="fecha" id="fecha" class="form-control" disabled>        
                                                </div>
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Monto Liquidado</label>  
                                                      <input type="text" name="totliq" id="totliq" class="form-control" disabled>        
                                                </div>
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Monto Diferido</label> 
                                                      <input type="text" name="mount" id="mount" class="form-control" disabled>        
                                                </div>
                                          </div>

                                          <div class="row">
                                                <div class="form-group col-sm-12 col-xs-12">
                                                      <label>Imagen</label>
                                                      <div class="col-6">
                                                            <img src="" name="vfile" id="vfile" class="product-image" alt="Product Image">
                                                      </div>
                                                </div>
                                          </div>
                                    </div>   
                              </div> 
                              </form>
                        </div>
                  </div>
                                               <!-- /.modal-content -->
            </div>
			
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
        <script type="text/javascript" src="scripts/verificarpago.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
		
<?php 
}
ob_end_flush();
?>

