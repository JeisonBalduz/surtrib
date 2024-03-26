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
                                    <h3 class="card-title">Registro de Pago de Ambiente</h3>
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
                                    <h3 class="card-title">Listado de Pagos Registrados</h3>
                               </div>
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Opciones</th>
                                                <th>Estatus</th>
                                                <th>Banco</th>
                                                 <th>Monto</th>
                                                  <th>Referencia</th>
                                                  <th>Tipo de Pago</th>
                                                  <th>Fecha de Pago</th>
                                                  <th>Fecha de Aprobacion</th>
                                                  <th>Recibo</th>                                   
                                                
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                      <th>Opciones</th>
                                                <th>Estatus</th>
                                                <th>Banco</th>
                                                 <th>Monto</th>
                                                  <th>Referencia</th>
                                                  <th>Tipo de Pago</th>
                                                  <th>Fecha de Pago</th>
                                                  <th>Fecha de Aprobacion</th>
                                                  <th>Recibo</th>                                      
            
                                                  
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        

          <?php 
            if ($_SESSION['rol']==1)
            {
              echo '

          <div class="card card-info" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro de Pago</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
                 <form role="form" name="formulario" id="formulario" method="POST">
                    <div class="card-body"> 
			      <div class="row">
                              <div class="form-group col-sm-3 col-xs-4">
                                    <label>Tipo de Pago</label>
                                    <input type="hidden" name="idpagoamb" id="idpagoamb">
                                    <input type="hidden" name="estado" id="estado">
                                    <input type="hidden" name="idusuarioamb" id="idusuarioamb">
                                          <select class="form-control" name="tipopago" id="tipopago" placeholder="Seleccione Tipo de Pago" required>
                                                 <option value="">Seleccione Tipo de Pago</option>
								 <option value="Pago Movil">Pago Movil</option>
                                                 <option value="Deposito">Deposito</option>
                                                 <option value="Transferencia">Transferencia</option>
                                        </select>
                              </div>
                              <div class="form-group col-sm-3 col-xs-4">
                                    <label>Banco</label>
                                          <select class="form-control" name="idbanco" id="idbanco" placeholder="Seleccione Banco" required>
                                          </select>
                             </div>	 
			            <div class="form-group col-sm-3 col-xs-12">
                                     <label>Referencia</label>
                                           <input type="number" name="referencia" id="referencia" class="form-control" placeholder="Ingrese Referencia">
                             </div>
                              <div class="form-group col-sm-3 col-xs-12">
                                    <label>Monto</label>
                                          <input type="text" name="monto" id="monto" class="form-control" placeholder="Ingrese Monto">
                              </div>     
                        </div>


                        <div class="row">	 
                               <div class="form-group col-sm-4 col-xs-12">
                                      <label>Fecha de Pago</label>
                                          <input type="date" class="form-control" name="fechapago" id="fechapago" required >
                              </div>
                              <div class="form-group col-sm-4 col-xs-12">
                                    <label>Documento de comprobante</label>
                                    <input type="file" class="form-control" name="imagen" id="imagen">

                               </div>
                               <div class="form-group col-sm-4 col-xs-12">
                                       <input type="hidden" name="imagenactual" id="imagenactual">
                                        <img src="" width="150px" height="120px" id="imagenmuestra">
                               </div>
				             
                        </div>
								   
                  </div>
 	
					
		   <!-- Fin Formulario-->
		   
           <!--  Pie Formulario-->
                    <div class="card-footer">
					       <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                                     <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                                    
                    </div>
				
              </form>
                   </div>
                   ';
            }
            ?>

<?php 
            if ($_SESSION['rol']==99)
            {
              echo '

          <div class="card card-info" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro de Pago</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
                 <form role="form" name="formulario" id="formulario" method="POST">
                    <div class="card-body"> 
			      <div class="row">
                              <div class="form-group col-sm-3 col-xs-4">
                                    <label>Tipo de Pago</label>
                                    <input type="hidden" name="idpagoamb" id="idpagoamb">
                                    <input type="hidden" name="idusuarioamb" id="idusuarioamb">
                                          <select class="form-control" name="tipopago" id="tipopago" placeholder="Seleccione Tipo de Pago" required>
                                                 <option value="">Seleccione Tipo de Pago</option>
								 <option value="Pago Movil">Pago Movil</option>
                                                 <option value="Deposito">Deposito</option>
                                                 <option value="Transferencia">Transferencia</option>
                                        </select>
                              </div>
                              <div class="form-group col-sm-3 col-xs-4">
                                    <label>Banco</label>
                                          <select class="form-control" name="idbanco" id="idbanco" placeholder="Seleccione Banco" required>
                                          </select>
                             </div>	 
			            <div class="form-group col-sm-3 col-xs-12">
                                     <label>Referencia</label>
                                           <input type="number" name="referencia" id="referencia" class="form-control" placeholder="Ingrese Referencia">
                             </div>
                              <div class="form-group col-sm-3 col-xs-12">
                                    <label>Monto</label>
                                          <input type="text" name="monto" id="monto" class="form-control" placeholder="Ingrese Monto">
                              </div>     
                        </div>


                        <div class="row">	 
                               <div class="form-group col-sm-4 col-xs-12">
                                      <label>Fecha de Pago</label>
                                          <input type="date" class="form-control" name="fechapago" id="fechapago" required >
                              </div>
                              <div class="form-group col-sm-4 col-xs-12">
                                    <label>Documento de comprobante</label>
                                    <input type="file" class="form-control" name="imagen" id="imagen">

                               </div>
                               <div class="form-group col-sm-4 col-xs-12">
                                       <input type="hidden" name="imagenactual" id="imagenactual">
                                        <img src="" width="150px" height="120px" id="imagenmuestra">
                               </div>
				             
                        </div>
								   
                  </div>
 	
					
		   <!-- Fin Formulario-->
		   
           <!--  Pie Formulario-->
                    <div class="card-footer">
					       <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                                     <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                                    
                    </div>
				
              </form>
                   </div>
                   ';
            }
            ?>
			
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
        <script type="text/javascript" src="scripts/pagoambiente.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

