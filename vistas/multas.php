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
                                    <h3 class="card-title">Tramite por otras Tasas <!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                                <input type="text" name="comodinbusqueda" id="comodinbusqueda" class="form-control" placeholder="Ingrese RFU" required> 
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="tasasadmin()" class="btn btn-info">Mostrar</button>
                           
                                                <label>Busqueda Contribuyente</label>
				                        <a href="multas.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div> 
                             
                        </div>
                  </div>		
	      </div>
       


            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro de Otras Tasas</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    <div class="form-group col-sm-2 col-xs-4">
                                          <label>RIF</label>
                                          <input type="text" name="rif" id="rif" class="form-control" placeholder="Ingrese Tipo de Categoria" readonly>
                                    </div>	 
			                  <div class="form-group col-sm-2 col-xs-12">
                                          <label>Codigo</label>
                                                <input type="text" name="rfc" id="rfc" class="form-control" placeholder="Ingrese Tipo de Tasa" readonly>
                                    </div>
                                    
                                    <div class="form-group col-sm-8 col-xs-4">
                                          <label>Nombre</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese Tipo de Ramo" readonly>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="form-group col-sm-10 col-xs-12">
                                          <label>Tasa Administrativa</label>
                                                <select class="form-control" name="vidt" id="vidt" placeholder="Seleccione Categoria">
                                                </select>
                                    </div>
                                    <div class="form-group col-sm-2 col-xs-4">
                                          <label>Cant.</label>
                                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese cant.">
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="form-group col-sm-12 col-xs-4">
                                          <label>Nombre</label>
                                                <textarea name="obs" id="obs" class="form-control" rows="1" placeholder="Ingrese observaciones ..."></textarea>
                                    </div>
                              </div>
                              
                              

                         </div>
                        <div class="card-footer">
					<button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
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
        <script type="text/javascript" src="scripts/tasasadministrativas.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

