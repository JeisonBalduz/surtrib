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

if ($_SESSION['Clientes']==1)
{
?>
    <!-- Inicio Contenido PHP-->
<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
		            <div class="card" id="listadoregistros">
                              <div class="card-header">
                                    <h3 class="card-title">Estado de Cuenta <!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                                <input type="text" name="comodinbusqueda" id="comodinbusqueda" class="form-control" placeholder="Ingrese RFU" required> 
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="listar2()" class="btn btn-info">Mostrar</button>
                           
                                                <label>Busqueda Contribuyente</label>
				                        <a href="http://localhost/surtri2/vistas/estadocuentahacienda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div> 
                              <div class="card-body" id="resporteestadocuenta">
                                          <h1 class="text-center" margin="0"><b>ESTADO DE CUENTA</b></h1>
                                          <h5 class="text-center" margin="0"><b>Razon Social:</b> <spam id="razsocial"></spam>  <b>N° RUC:</b> <spam id="rufrif"></spam></h5>
                                          <p class="text-center" margin="0"> <b>Direccion Fiscal: </b><spam id="direccionfiscal"></spam> <b>Correo:</b> <spam id="correo"></spam></p>
                                          
                                    
                                    <table id="tbllistado" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      <th>Fecha</th>
                                                      <th>Tramite</th>
                                                      <th>Tributo</th>
                                                      <th>Monto Liq.</th>                                   
                                                      <th>Monto Dif.</th>
                                                      <th>Diferencia</th>
                                                      <th>Crd. Fis/Desc.</th>
                                                      <th>Pagado</th>    
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                      
                                                      <th></th>
                                                      <th></th>
                                                      <th>Total</th>
                                                      <th><spam id="stotaliq"></spam></th>                                   
                                                      <th><spam id="sdiferido"></spam></th>
                                                      <th><spam id="sdescuento"></spam></th>
                                                      <th><spam id="stotalp"></spam></th>
                                                      <th><spam id="stotaltotal"></spam></th>
                                                      </tr>											
                                                </tfoot>
                                    </table>
                               </div>
                        </div>
                  </div>		
	      </div>
       
      </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title">Liquidacion Tramite N°: <spam id="tramitelig"></spam></h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
           
              <table class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>ID</th>
                                                      <th>Triuto</th>
                                                      <th>Monto Liq.</th>
                                                         
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                      
                                                      <th><spam id="idtipotramite"></spam></th>                                   
                                                      <th><spam id="detalle"></spam></th>
                                                      <th><spam id="monton"></spam></th>
                                                     
                                                      </tr>											
                                                </tfoot>
                                    </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
        <script type="text/javascript" src="scripts/estadocuentahacienda.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
		<script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();
?>

