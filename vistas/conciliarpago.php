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
                                    <h3 class="card-title">Conciliación de Pagos</h3>
                                    <a href="conciliarpago.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
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
                                              <label>Búsqueda</label><br/>
                                                <button type="submit" onclick="listarporfecha();" class="btn btn-info">Mostrar</button>
                                          </div>  
                                    </div>
				      </div>
				
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Pagos por Conciliar</h3>
                               </div>
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Opciones</th>
                                                <th>Fecha</th>
                                                <th>Referencia</th>
                                                <th>Monto</th>
                                                 <th>Detalle</th>
                                                  <th>Saldo</th>
                                                     
                                                
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                      <th>Opciones</th>
                                                <th>Fecha</th>
                                                <th>Referencia</th>
                                                <th>Monto</th>
                                                 <th>Detalle</th>
                                                  <th>Saldo</th>
                                                  
											
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
                                    <h4 class="modal-title">Conciliación</h4>
                                          <button type="button" class="close" onclick="limpiar()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                                    <form role="form" name="formulario" id="formulario" method="POST">
                                          <div class="modal-body">
                                                <div class="col-sm-12">
                                                      <div class="row">
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <label>Referencia</label>
                                                                  <input type="hidden" name="id" id="id" class="form-control"> 
                                                                  <input type="hidden" name="idconciliacion" id="idconciliacion" class="form-control"> 
                                                                  <input type="hidden" name="tributo" id="tributo" class="form-control"> 
                                                      
                                                                  <input type="hidden" name="idtramite" id="idtramite" class="form-control">    
                                                                  <input type="text" name="refencia" id="refencia" class="form-control" disabled>        
                                                            </div>
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <label>Fecha</label> 
                                                                  <input type="text" name="fechad" id="fechad" class="form-control" disabled>        
                        
                                                             </div>
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <label>Monto</label>  
                                                                  <input type="text" name="amount" id="amount" class="form-control" disabled>         
                                                            </div>
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <label>Saldo</label> 
                                                                  <input type="text" name="saldo" id="saldo" class="form-control" disabled>        
                                                            </div>
                                                      </div>
                                                      <div class="row">
                                                            <div class="form-group col-sm-12 col-xs-12">
                                                                  <label>Detalles</label>  
                                                                  <input type="select" name="details" id="details" class="form-control" disabled>        
                                                            </div>
                                                      </div>
                                                      
                                                      <div class="row">
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <button type="button"  onclick="tramiteporpagar()" class="btn btn-info form-control" >Buscar RUC</button>
                                                            </div>
                                                            <div class="form-group col-sm-9 col-xs-12">  
                                                                  <input type="text" name="rfc" id="rfc" class="form-control">        
                                                             </div>
                                                      </div>
                                                      <div id="tablal" class="row">
                                                            <div class="form-group col-sm-12 col-xs-12">
                                                                  <label>Tabla</label>  
                                                                        <table id="tbllistado" class="table table-bordered table-hover">
                                                                               <thead>
                                                                                    <tr>
                                                                                          <th>Fecha</th>
                                                                                          <th>Trámite</th>
                                                                                          <th>Detalle</th>
                                                                                          <th>Monto Liquidado</th>
                                                                                          <th>Monto Deferido</th>
                                                                                          <th>Monto Pagado</th>
                                                                                          <th>Conciliar</th>
                                                                                          
                                                                                    </tr>
                                                                              </thead>
                                                                                    <tbody id="tramites">
                                                                                     
                                                                                    </tbody>
                                                                        </table>       
                                                            </div>
                                                      </div>
                                                      <div id="cal" class="row">
                                                            <div class="form-group col-sm-3 col-xs-12">

                                                                 <div class="col-sm-6">
                                                                  <div class="form-group">
                                                                        <div class="form-check">
                                                                              <input name="displayTotal" id="displayTotal"  class="form-check-input" type="checkbox">
                                                                              <label class="form-check-label">Calcular</label>
                                                                        </div>
                                                                         </div>
                                                                          </div>
                                                            </div>
                                                            <div class="form-group col-sm-4 col-xs-12">
                                                                   <label>Montos a Conciliar</label>
                                                                  <input type="text" name="sumas" id="sumas" class="form-control">        
                                                            </div>
                                                            <div class="form-group col-sm-4 col-xs-12">
                                                                   <label>Saldo Disponible</label>
                                                                  <input type="text" name="saldo2" id="saldo2" class="form-control">        
                                                            </div> 
 
                                                      </div>
                                                      <div class="row">
                                                            <div class="form-group col-sm-3 col-xs-12">
                                                                  <button type="submit"  id="btnGuardar" class="btn btn-info">Notificar Pago</button>
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
        <script type="text/javascript" src="scripts/conciliarpago.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
		
<?php 
}
ob_end_flush();
?>

