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
                                    <h3 class="card-title">Declaración de Definitiva<!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                                    <a href="definitiva.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                               <select class="form-control input-sm" name="comodinbusqueda" id="comodinbusqueda" placeholder="Buscar" >
                                                      <option value="">--Seleccionar --</option>
                                                </select> 
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="verdefinitiva()" class="btn btn-info">Mostrar</button>
                           
                                                <label>Búsqueda Contribuyente</label>
				                        
                                          </div>
				            </div>
					</div> 

                              <div class="card-header">
                                    <h3 class="card-title">Listado de Definitivas </h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>RUF</th>
                                                      <th>RIF</th>
                                                      <th>Nombre</th>
                                                      <th>Correlativo</th>
                                                   
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
                                                      <th>Nombre</th>
                                                      <th>Correlativo</th>
                                                     
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                             
                        </div>
                        
                  </div>		
	      </div>
       


            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro de Definitiva</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
                        <div class="row">
                                     <div class="form-group col-sm-3 col-xs-4">
                                          <label>RUF</label>
                                          <input type="hidden" name="id" id="id" class="form-control">
                                          <input type="text" name="rfc2" id="rfc2" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>RIF</label>
                                        
                                          <input type="text" name="rif" id="rif" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-4">
                                          <label>Razón Social</label>
                                        
                                          <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                   
                                
                                    

                                    
                              </div>
                        <div class="row">
                                                            <div class="form-group col-sm-12 col-xs-12">
                                                                  <label>Anticipos Mensuales</label>  
                                                                        <table id="tbllistado" class="table table-bordered table-hover">
                                                                               <thead>
                                                                                    <tr>
                                                                                          <th>Razón Social</th>
                                                                                          <th>Actividad</th>
                                                                                          <th>Alícuota</th>
                                                                                          <th>Periodo</th>
                                                                                          <th>Trámite</th>
                                                                                          <th>Estatus</th>
                                                                                          <th>Monto Bruto</th>
                                                                                          <th>Impuesto Mes</th>
                                                                                          <th>Total Pagado</th>
                                                                                        
                                    
                                                                                          
                                                                                    </tr>
                                                                              </thead>
                                                                                    <tbody id="mesesdefinitiva">
                                                                                     
                                                                                    </tbody>
                                                                        </table>       
                                                            </div>
                                                      </div>
			            
                              <div class="row">
                                    <div class="form-group col-sm-12 col-xs-4">
                                          <label>Monto Bruto Anual Declarado</label>
                                          <input type="text" name="montobrutoanual" id="montobrutoanual" class="form-control" placeholder="Ingrese Monto Bruto Anual Declarado" required>
                                    </div>
                              </div>

                              <div class="row">
                                    <div class="form-group col-sm-4 col-xs-4">
                                          <label>Representante Legal</label>
                                          <input type="text" name="representante" id="representante" class="form-control" placeholder="Nombre Representante" required>
                                    </div>
                                    <div class="form-group col-sm-2 col-xs-4" id="divbanco">
                                <label>Nacionalidad</label>
                                         <select class="form-control" name="nacionalidad" id="nacionalidad" placeholder="Banco" required>
                                            <option value="">Seleccione Nacionalidad</option>
                                           <option value="V">VENEZOLANO(A)</option>
                                           <option value="E">EXTRANJERO</option>
             
                                          </select> 
                                      </div> 
                                    <div class="form-group col-sm-4 col-xs-4">
                                          <label>Cédula Representante</label>
                                          <input type="text" name="rcedula" id="rcedula" class="form-control" placeholder="Cédula Representante" required>
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-4">
                                          <label>Teléfono Representante</label>
                                          <input type="text" name="rtelefono" id="rtelefono" class="form-control" placeholder="Ingrese Teléfono" required>
                                    </div>
                              </div>
                              
                              

                         </div>
                        <div class="card-footer">
                              <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                              <button type="button" onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
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
        <script type="text/javascript" src="scripts/definitiva.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

