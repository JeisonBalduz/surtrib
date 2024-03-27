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
                                    <h3 class="card-title">Estado de Cuenta</h3>
                                    <a href="estadocuenta.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
                              <div class="card-header">
                              <h5 class="text-center" margin="0"><b>ESTADO DE CUENTA</b></h1>
                                          <h5 class="text-center" margin="0"><b>Razón Social:</b> <?php echo $_SESSION['nombre']; ?> <b>  N° RIF: </b> <?php echo $_SESSION['rif']; ?> </spam></h5>
                                          <p class="text-center" margin="0"> <b>Fecha de consulta: </b><?php echo date("Y/m/d");?></p>
                               </div>
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Fecha</th>
                                                <th>Trámite</th>
                                                <th>Tributo</th>
                                                 <th>Monto Liq.</th>
                                                 <th>Monto Dif.</th>
                                                  <th>Diferencia</th>
                                                  <th>Crédito Fiscal/Desc.</th>
                                                  <th>Monto Pagado</th>
                                                  <th>Saldo</th>
                                                  <th>Opciones</th>
                                                                             
                                                
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                      <th>Fecha</th>
                                                <th>Trámite</th>
                                                <th>Tributo</th>
                                                 <th>Monto Liq.</th>
                                                 <th>Monto Dif.</th>
                                                  <th>Diferencia</th>
                                                  <th>Crédito Fiscal/Desc.</th>
                                                  <th>Monto Pagado</th>
                                                  <th>Saldo</th>

                                                  <th>Opciones</th>                                   
            
                                                  
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>

          <div class="modal fade" id="listardiferido">
                  <div class="modal-dialog">
                         <div class="modal-content">
                              <div class="modal-header">
                                    <h4 class="modal-title">Pagos Diferidos</h4>
                        
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                     </button>
                              </div>
                              <div class="modal-body">
                              <table id="tbllistado2" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Fecha</th>
                                                <th>Ref./Aprov.</th>
                                                <th>Recibo</th>
                                                <th>Monto</th>

                                                                             
                                                
                                                 
                                          </tr>
                                    </thead>
                                  <tbody id="diferidos">
                                     
                                 </tbody>
      
                                  </table>
                              
                              </div>
                              <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelarform2()">Cerrar</button>
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
                                    <h4 class="modal-title">Notificación de Pago</h4>
                                          <button type="button" class="close" onclick="limpiar()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form role="form" name="formulariopago2" id="formulariopago2" method="POST">
                              <div class="modal-body">
                                    <div class="col-sm-12">
                                          <div class="row">
                                                <div class="form-group col-sm-12 col-xs-12">
                                                      <label>Trámite</label>
                                                      <input type="hidden" name="id" id="id" class="form-control"> 
                                                      <input type="hidden" name="tributo" id="tributo" class="form-control"> 
                                                      <input type="hidden" name="tramite" id="tramite" class="form-control"> 
                                                      <input type="hidden" name="idtramite" id="idtramite" class="form-control">    
                                                      <input type="text" name="tramitev" id="tramitev" class="form-control" disabled>        
                                                </div>
                                          
                                          </div>
                                    </div>
                                    <div class="row">
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>INGRESE EL MONTO DEL COMPROBANTE DE PAGO</label>
                                                            <input style="text-align:right;" class="form-control" type="numeric" value="0.00" name="monto" id="monto" maxlent="9" placeholder="El monto debe ser igual al comprobante de pago" required>        
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-12">
                                                    
                                                      <label>INGRESE EL NÚMERO DE REFERENCIA</label>
                                                            <input style="text-align:right;" class="form-control" type="numeric" value="000000" name="referencia" id="referencia" maxlent="10" placeholder="Ingrese todos los números de la referencia" required>
                                                </div>
                                               
                                    </div>
                                    <div class="row">
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Capture</label>
                                                      <input type="file" class="form-control" name="imagen" id="imagen" maxlength="256" placeholder="Imagen" required>
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Imagen:</label>
                                                            
                                                            <img src="" width="150px" height="120px" id="imagenactual">

                                                </div>
                                               
                                    </div>
                                    <div class="row">
                                    <button type="submit"  id="btnGuardar" class="btn btn-info float-right">Notificar Pago</button>
                                    </div>
                                                                  
                                                               
                                    
                              </div> 
                              
                              </form>
                        </div>
                  </div>
                                               <!-- /.modal-content -->
            </div>
                                           <!-- /.modal-dialog -->
      
          <!-- /.card -->
        
          <div class="modal fade" name="formulariodife" id="formulariodife">
                  <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                              <div class="modal-header" style="background-color: #17a2b8;color: white">
                                    <h4 class="modal-title">Notificación de Pago 2</h4>
                                          <button type="button" class="close" onclick="limpiar()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form role="form" name="formulariodife2" id="formulariodife2" method="POST">
                              <div class="modal-body">
                                    <div class="col-sm-12">
                                          <div class="row">
                                                <div class="form-group col-sm-12 col-xs-12">
                                                      <label>Trámite</label>
                                                      <input type="hidden" name="id" id="id" class="form-control"> 
                                                      <input type="hidden" name="tributo2" id="tributo2" class="form-control"> 
                                                      <input type="hidden" name="tramite2" id="tramite2" class="form-control"> 
                                                      <input type="hidden" name="idtramite2" id="idtramite2" class="form-control">    
                                                      <input type="text" name="tramitev2" id="tramitev2" class="form-control" disabled>        
                                                </div>
                                          
                                          </div>
                                    </div>
                                    <div class="row">
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>INGRESE EL MONTO DEL COMPROBANTE DE PAGO</label>
                                                            <input style="text-align:right;" class="form-control" type="numeric" value="0.00" name="monto" id="monto" maxlent="9" placeholder="El monto debe ser igual al comprobante de pago" required>        
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>INGRESE EL NÚMERO DE REFERENCIA</label>
                                                            <input style="text-align:right;" class="form-control" type="numeric" value="000000" name="referencia" id="referencia" maxlent="10" placeholder="Ingrese todos los números de la referencia" required>

                                                </div>
                                               
                                    </div>
                                    <div class="row">
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Capture</label>
                                                      <input type="file" class="form-control" name="imagen" id="imagen" maxlength="256" placeholder="Imagen" required>
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Imagen:</label>
                                                            
                                                            <img src="" width="150px" height="120px" id="imagenactual">

                                                </div>
                                               
                                    </div>
                                    <div class="row">
                                    <button type="submit"  id="btnGuardar" class="btn btn-info float-right">Notificar Pago</button>
                                    </div>
                                                                  
                                                               
                                    
                              </div> 
                              
                              </form>
                        </div>
                  </div>
                                               <!-- /.modal-content -->
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
        <script type="text/javascript" src="scripts/estadocuenta.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/imagen.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

