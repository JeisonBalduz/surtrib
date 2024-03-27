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
                                    <h3 class="card-title">Ajuste de Trámite </h3>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                                <input type="text" name="tramite" id="tramite" class="form-control" placeholder="Ingrese N Trámite" required> 
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="listar()" class="btn btn-info">Mostrar</button>
                           
                                                <label>Búsqueda Trámite</label>
				                        <a href="http://localhost/surtri2/vistas/estadocuentahacienda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div> 
                              <div class="card-body" id="resporteestadocuenta">
                                         
                                    
                                    <table id="tbllistado" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>Tributo</th>
                                                      <th>Condición</th>
                                                      <th>Fecha Decla.</th>
                                                       <th>Monto Liq.</th>
                                                      <th>Monto Dif.</th>
                                                      <th>Monto Pag.</th>
                                                      <th>Fecha Pago</th>
                                                
                                                          
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                      
                                                     <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>Tributo</th>
                                                      <th>Condición</th>
                                                      <th>Fecha Decla.</th>
                                                       <th>Monto Liq.</th>
                                                      <th>Monto Dif.</th>
                                                      <th>Monto Pag.</th>
                                                      <th>Fecha Pago</th>
                                                      </tr>											
                                                </tfoot>
                                    </table>
                               </div>
                        </div>
                  </div>		
	      </div>
       

            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro y Modificación de Bancos</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
                              <div class="row">
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Periodo</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="text" name="period" id="period" class="form-control" required>
                        
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Monto Declarado</label>
                                                <input type="text" name="totliq" id="totliq" class="form-control" required>
                        
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Monto Diferido</label>
                                                <input type="text" name="deferred" id="deferred" class="form-control" required>
                                                
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Monto Pagado</label>
                                                <input type="text" name="totpag" id="totpag" class="form-control" required>
                                    </div>



                  
                              </div>
                         </div>
                        <div class="card-footer">
					<button type="button"onclick="guardaryeditar()" class="btn btn-info">Guardar</button>
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
        <script type="text/javascript" src="scripts/ajustetramite.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

