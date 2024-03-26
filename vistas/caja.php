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
                                    <h3 class="card-title">Caja de Pago</h3>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						            <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar Nuevo Pago </button>
				                        <a href="http://localhost/surtri/vistas/pagoambiente.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Pagos por Caja</h3>
                              </div>
                              <div class="card-body" id="lista2">
                                    <table id="tbllistado2" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>Tipo</th>
                                                      <th>Cedula/RIF</th>
                                                      <th>Monto</th>
                                                      <th>Tipo de Pago</th>
                                                      <th>Fecha de Pago</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>Tipo</th>
                                                      <th>Cedula/RIF</th>
                                                      <th>Monto</th>
                                                      <th>Tipo de Pago</th>                                  
                                                      <th>Fecha de Pago</th>
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
        



            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro de Pago por Caja</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    
                                    <div class="form-group col-sm-2 col-xs-12">
                                          <label>Tipo de Servicio</label>
                                                <select class="form-control select2" name="tipocontri" placeholder="Seleccione Banco" id="tipocontri"  required>
                                                      <option value="">Seleccione Tipo de Pago</option>
								      <option value="1">Comercial</option>
                                                      <option value="2">Residencial</option>
                                                      
                                                </select>
                                    </div>
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Contribuyente</label>
                                                <select class="form-control select2" name="contribuyente" placeholder="Seleccione Banco" id="contribuyente"  required>
                                                </select>
                                    </div>
                                    
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Inmuble o Comercio</label>
                                                <select class="form-control select2" name="inmueble" placeholder="Seleccione Banco" id="inmueble"  required>
                                                </select>
                                    </div>
                              </div>
                              <div class="row">	 
                                    
                                    <div class="form-group col-sm-8 col-xs-12">
                                          <label>Descripcion</label>
                                                <input type="text" class="form-control" name="prueba" id="prueba">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="tasa" id="tasa">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="ulmepago" id="ulmepago">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Esta</label>
                                                <input type="text" class="form-control" name="nombremoneda" id="nombremoneda">
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="meses" id="meses">
                                    </div>
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Inmuble o Comercio</label>
                                                <select class="form-control select2" name="dueda" placeholder="Seleccione Banco" id="dueda"  required>
                                                </select>
                                    </div>
                              </div>
                              
                              		   
                         </div>
                        <div class="card-footer">
					<button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                              <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                              <button type="button" onclick="listMonthsBackwards()" class="btn btn-danger float-right">Prueba</button>
                              <button type="button" onclick="pruebaretun()" class="btn btn-danger float-right">esta es la prueva</button>
                        </div>
			</form>
                  <div class="invoice p-3 mb-3" id="formato-factura">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <img src="../public/images/logoa.jpg" width="100" height="50">
                    <small class="float-right"><? echo date("l jS \of F Y h:i:s A"); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <address>
                    <strong>INSTITUTO AUTONOMO DE GESTION AMBIENTAL DEL MUNCIPIO LIBERTADOR DEL ESTADO CARABOBO</strong><br>
                    RIF: G-2000000<br>
                    Carretera Vieja Tovuyito CC Libertador Local 18 Sector Tocuyito<br>
                    (0214)617.72.29<br>
                    Email: 
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Nombre o Razon Social
                  <address>
                    <strong id="contribuyente2"></strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-2 invoice-col">
                  <b>Invoice #007612</b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" id="tabla-factura">
                    <thead>
                    <tr>
                      <th>Item</th>
                      <th>Descripcion</th>
                      <th>Periodo</th>
                      <th>Precio (Bs)</th>
                      <th>Precio (Bs)</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                 <!-- <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>-->
                </div>
                <!-- /.col -->
                <div class="col-3">
                 <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                  <div class="table-responsive">
                    <!--<table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>-->
                        <th>Total Bs:</th>
                        <td><input type="text" name="totalfactura" id="totalfactura"></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                 <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>-->
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generar PDF
                  </button>
                </div>
              </div>
            </div>







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
        <script type="text/javascript" src="scripts/caja.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
		<script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();
?>

