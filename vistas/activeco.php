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
                                    <h3 class="card-title">Tasas Actividad Economica</h3>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						          <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar Nueva Tasa </button>
				                        <a href="activeco.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Actividades Economicas </h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Codigo grupo</th>
                                                      <th>Concepto</th>
                                                      <th>Alicuota</th>
                                                      <th>ITM</th>
                                                      <th>Decreto</th>
                                                     

                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Opciones</th>
                                                      <th>Codigo grupo</th>
                                                      <th>Concepto</th>
                                                      <th>Alicuota</th>
                                                      <th>ITM</th>
                                                      <th>Decreto</th>
                                                    
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
        

            

            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Tasas</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Codigo Grupo</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="text" name="codigo_grupo" id="codigo_grupo" class="form-control" placeholder="Ingrese Tipo de Ramo" >
                                    </div>
                                    
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Alicuota </label>
                                          <input type="text" name="alicuota" id="alicuota" class="form-control" placeholder="Ingrese detalle" >
                                    </div>	 
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>ITM</label>
                                                <input type="text" name="umt" id="umt" class="form-control" placeholder="Ingrese Tipo de Tasa">
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Decreto</label>
                                                 <select class="form-control" name="DECRETO" id="DECRETO" placeholder="Nacionalidad" required>
                                                            <option value="">Seleccione</option>
											   <option value="NO">NO</option>
                                                                  <option value="SI">SI</option>
                                                                  </select>
                                    </div>  
                              </div>
                              <div class="row">
                                    <div class="form-group col-sm-12 col-xs-4">
                                          <label>Detalles</label>
                                          <textarea type="textarea" name="detalles" id="detalles" class="form-control" placeholder="Ingrese detalle" >  </textarea>
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
        <script type="text/javascript" src="scripts/activeco.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

