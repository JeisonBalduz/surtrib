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
                            <h3 class="card-title">Contribuyentes</h3>
                       </div>
            <!-- /.card-header -->
			           <div class="card-header">
			              <div class="row">
                   <div class="form-group col-md-4 col-sm-6 col-xs-1">
				            <label>Busqueda de Contribuyente</label>
                                     <input type="text" name="comodinbusqueda" id="comodinbusqueda" class="form-control" placeholder="Ingrese RUC" required> 
						            </div> 
						   <div class="form-group col-md-12 col-sm-12 col-xs-1">
						   <button type="submit" onclick="listar2()" class="btn btn-info">Mostrar</button>
				              <a href="contribuyentehacienda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
				              
                                     </div>
				         </div>
					     </div>
                                  
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr>
                                                <th>Opciones</th>
                                                <th>RUC</th>
                                                 <th>Licencia</th>
                                                  <th>Cedula/RIF</th>                                   
                                                  <th>Razon Social</th>
                                                  <th>Telefono</th>
                                                  <th>Direccion</th>
                                                 <th>Correo</th>
                                                 
                                                      
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                      <th>Opciones</th>
                                                <th>RUC</th>
                                                 <th>Licencia</th>
                                                  <th>Cedula/RIF</th>                                   
                                                  <th>Razon Social</th>
                                                  <th>Telefono</th>
                                                  <th>Direccion</th>
                                                 <th>Correo</th>
                                                                       
                                                  
                                              
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        



          <div class="card card-info" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro o Modificacion</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
                 <form role="form" name="formulario" id="formulario" method="POST">
                    <div class="card-body"> 
				<div class="row">	 
			                 <div class="form-group col-sm-1 col-xs-12">
                                      <label>RUC</label>
                                         <input type="text" name="rfc" id="rfc" class="form-control" >
                                    </div>
                             <div class="form-group col-sm-1 col-xs-12">
                                   <label>Licencia</label>
                                         <input type="text" name="licencia" id="licencia" class="form-control" >
                             </div>
                             <div class="form-group col-sm-1 col-xs-12">
                                   <label>Tipo Doc</label>
                                         <input type="text" name="tiponac" id="tiponac" class="form-control" >
                             </div>
                             <div class="form-group col-sm-2 col-xs-12">
                                   <label>Numero Cedula/RIF</label>
                                         <input type="text" name="cedularif" id="cedularif" class="form-control" >
                             </div>
                             <div class="form-group col-sm-7 col-xs-12">
                                  <label>Razon Social</label>
                                       <input type="text" name="razsocial" id="razsocial" class="form-control" >
                             </div>  
                        </div>
               
	
						 <div class="row">
                             
			 
			                 <div class="form-group col-sm-4 col-xs-12">
                                  <label>Correo</label>
                                        <input type="text" name="correo" id="correo" placeholder="Correo" class="form-control">
                             </div>
							 
			                 <div class="form-group col-sm-2 col-xs-12">
                                   <label>Telefono</label>
                                         <input type="text" name="celular" id="celular" class="form-control" placeholder="Telefono Ejem (4123421342)">
                             </div>
				             <div class="form-group col-sm-2 col-xs-12">
                                    <label>Modo</label>
                                          <input type="text" name="modo" id="modo" class="form-control" placeholder="Modo">
                             </div>
                             <div class="form-group col-sm-4 col-xs-12">
                                   <label>Registrado en el Sistema</label>
                                         <input type="text" name="registrado" id="registrado" class="form-control" placeholder="Registro anterior" disabled>
                             </div>
                        </div>
                        <div class="row">	 
			                 <div class="form-group col-sm-3 col-xs-12">
                                      <label>Direccion</label>
                                         <input type="text" name="sector" id="sector" class="form-control">
                                    </div>
                             <div class="form-group col-sm-3 col-xs-12">
                                   <label>Calle</label>
                                         <input type="text" name="calle" id="calle" class="form-control">
                             </div>
                             <div class="form-group col-sm-3 col-xs-12">
                                   <label>Edificio</label>
                                         <input type="text" name="edificio" id="edificio" class="form-control">
                             </div>
                             <div class="form-group col-sm-3 col-xs-12">
                                   <label>N° Edificio</label>
                                         <input type="text" name="numeroedif" id="numeroedif" class="form-control">
                             </div>
				             
                        </div>
								   

 	
						 <div class="row">
           
							 
			            
				             <div class="form-group col-sm-6 col-xs-12">
                                    <label>Ultima Declaracion</label>
                                          <input type="number" name="ultima_declaracion" id="ultima_declaracion" class="form-control">
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
        <script type="text/javascript" src="scripts/contriambiente.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

