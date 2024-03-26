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
                            <h3 class="card-title">Listado de UBCH</h3><!-- <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--></h2> 
                       </div>
            <!-- /.card-header -->
			           <div class="card-header">
			              <div class="row">
                                    
                                           <div class="form-group col-md-6 col-sm-6 col-xs-1">
				                      <label>Parroquia</label>
                                               <select name="parroquia" id="parroquia" class="form-control" data-live-search="true" required>Seleccione un Parroquia</select>
						            </div> 
                                                <div class="form-group col-md-6 col-sm-6 col-xs-1">
				             <label>Eje</label>
                                        <select name="eje" id="eje" class="form-control" data-live-search="true" required>Seleccione un Parroquia</select>
						            </div> 
						   <div class="form-group col-md-12 col-sm-12 col-xs-1">
						   <button type="submit" onclick="listar()" class="btn btn-info">Mostrar</button>
				              <a href="http://localhost/valencia/vistas/ubch.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
				              
                                     </div>
					         </div>
					     </div>
                                  
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Opciones</th>
                                                 <th>UBCH</th>
                                                  <th>Cedula</th>
                                                  <th>Nombre</th>                                   
                                                  <th>Telefono</th>
                                                  <th>Electores</th>
											
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                    
                                      <th>Opciones</th>
                                                 <th>UBCH</th>
                                                  <th>Cedula</th>
                                                  <th>Nombre</th>                                   
                                                  <th>Telefono</th>
                                                  <th>Electores</th> 
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        



          <div class="card card-primary" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro o Modificacio</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
                 <form role="form" name="formulario" id="formulario" method="POST">
                    <div class="card-body">
                         
						 
						  <div class="row">
                             
							 
			                 <div class="form-group col-sm-2 col-xs-12">
                                   <label>Parroquia</label>
                                   <input type="hidden" name="codigoubch" id="codigoubch">
                                         <input type="text" name="parroquia2" id="parroquia2" class="form-control" disabled>
                             </div>
                             <div class="form-group col-sm-2 col-xs-12">
                                   <label>Eje</label>
                                         <input type="text" name="eje2" id="eje2" class="form-control" disabled>
                             </div>
                             <div class="form-group col-sm-6 col-xs-12">
                                   <label>UBCH</label>
                                         <input type="text" name="nombreubch" id="nombreubch" class="form-control" disabled>
                             </div>
                             <div class="form-group col-sm-2 col-xs-12">
                                   <label>Electores</label>
                                         <input type="text" name="electores" id="electores" class="form-control" disabled>
                             </div>
				             
                        </div>
						
						 <div class="row">
                             <div class="form-group col-sm-2 col-xs-4">
                                  <label>Nacionalidad</label>
                                        <select class="form-control" name="nacionalidadjubch" id="nacionalidadjubch" placeholder="Nacionalidad" required>
                                               <option value="">Seleccione</option>
											   <option value="V">V</option>
                                                <option value="E">E</option>
                                        </select>
                             </div>
			 
			                 <div class="form-group col-sm-2 col-xs-12">
                                  <label>Cedula</label>
                                        <input type="number" name="cedulajubch" id="cedulajubch" min="999999" max="99999999" class="form-control" placeholder="Cedula" required>
                             </div>
							 
			                 <div class="form-group col-sm-4 col-xs-12">
                                   <label>Nombres</label>
                                         <input type="text" name="nombrejubch" id="nombrejubch" class="form-control" onkeyup="mayus(this);" placeholder="Nombres" required>
                             </div>
				             <div class="form-group col-sm-4 col-xs-12">
                                    <label>Apellidos</label>
                                          <input type="text" name="apellidojubch" id="apellidojubch" class="form-control" onkeyup="mayus(this);" placeholder="Apellidos" required>
                             </div>
                        </div>
            
			            <div class="row">
		                      <div class="form-group col-sm-1 col-xs-4">
                                    <label>Telefono</label>
					                      <select class="form-control" name="operadora1" id="operadora1" placeholder="Linea1" required>
                                              <option value="">Seleccione</option>
											  <option value="416">0416</option>
                                              <option value="426">0426</option>
						                      <option value="414">0414</option>
                                              <option value="424">0424</option>
						                      <option value="412">0412</option>
                                          </select>
                              </div>
			                  <div class="form-group col-sm-2 col-xs-12">
                                     <label>1</label>
                                             <input type="number" name="telefono1" id="telefono1" class="form-control"  min="0100000" max="9999999" placeholder="Telefono1" required>
                              </div>
			                  <div class="form-group col-sm-1 col-xs-4">
                                    <label>Telefono</label>
                                           <select class="form-control" name="operadora2" id="operadora2" placeholder="Linea2" >
                                               <option value="">Seleccione</option>
											   <option value="416">0416</option>
                                                <option value="426">0426</option>
						                        <option value="414">0414</option>
                                                 <option value="424">0424</option>
						                         <option value="412">0412</option>
                                            </select>
                              </div>
			                  <div class="form-group col-sm-2 col-xs-12">
                                    <label>2</label>
                                           <input type="number" name="telefono2" id="telefono2" min="0100000" max="9999999" class="form-control" placeholder="Telefono2" >
                              </div>
                              <div class="form-group col-sm-6 col-xs-12">
                                    <label>Correo Electronico</label>
                                           <input type="email" name="correoelectronico" id="correoelectronico" class="form-control" placeholder="Correo Electronico" >
                              </div>
                        </div>
                        <div class="row">
                                <div class="form-group col-sm-12 col-xs-12">
                                  <label>Direccion</label>
                                        <input type="text" name="direccionjubch" id="direccionjubch" onkeyup="mayus(this);" class="form-control" placeholder="Direccion">
                                 </div>
                        </div>
                      
                    </div>
		   <!-- Fin Formulario-->
		   
           <!--  Pie Formulario-->
                    <div class="card-footer">
					       <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                           <button type="submit" onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                           
                    </div>
				
              </form>
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
        <script type="text/javascript" src="scripts/ubch.js"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

