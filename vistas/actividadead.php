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
                                    <h3 class="card-title">Registro de Actividad Economica  <button class="btn btn-info" id="btnagregar" onclick="incluir(true)"><i class="fa fa-plus-circle"></i> Nueva Actividad</button> </h3>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                                <input type="text" name="rfc2" id="rfc2" class="form-control" placeholder="Ingrese RUC" required> 
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="listar2()" class="btn btn-info">Mostrar</button>
                           
                                                <label>Busqueda Contribuyente</label>
				                        <a href="http://localhost/surtri2/vistas/estadocuentahacienda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div> 
                              <div class="card-body" id="resporteestadocuenta">
                                         
                                    
                                    <table id="tbllistado" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Codigo</th>
                                                      <th>Detalles</th>
                                                          
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                      
                                                     <th>Opciones</th>
                                                      <th>Codigo</th>
                                                      <th>Detalles</th>
                                                      </tr>											
                                                </tfoot>
                                    </table>
                               </div>
                        </div>
                  </div>		
	      </div>
       

            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro y Modificacion de Bancos</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
                        <div class="row">
                                    <div class="form-group col-sm-2 col-xs-12">
                                          <label>RUC</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="text" name="rfctabla" id="rfctabla" class="form-control" required>
                        
                                    </div>
                                    <div class="form-group col-sm-10 col-xs-12">
                                          <label>Actividad</label>
                                                <input type="text" name="actividad2" id="actividad2" class="form-control" required placeholder="Seleccione la Actividad">
                        
                                    </div>
                                    <div class="form-group col-sm-12 col-xs-12">
                                          <label>Seleccione Actividad</label>
                                               
                                                <select class="form-control" name="actividad" id="actividad" placeholder="Seleccione Categoria" required >
                                                </select>
                                    </div>



                  
                              </div>
                         </div>
                        <div class="card-footer">
					<button type="button"onclick="guardaryeditar2()" class="btn btn-info">Guardar</button>
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
        <script type="text/javascript" src="scripts/actividadead.js"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

