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
                                    <h3 class="card-title">Monedas</h3> <a href="moneda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
			            <div class="card-header">
			                 
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Monedas </h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Moneda</th>
                                                      <th>Codigo</th>
                                                      <th>Valor</th>
                                                      <th>Tasa de Valor al Petro</th>
                                                      <th>Estado</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Opciones</th>
                                                      <th>Moneda</th>
                                                      <th>Codigo</th>
                                                      <th>Valor</th>
                                                      <th>Tasa de Valor al Petro</th>
                                                      <th>Estado</th>
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
        


          
            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro y Modificacion de Monedas</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Moneda</label>
                                                <input type="hidden" name="idmoneda" id="idmoneda" class="form-control" placeholder="Ingrese Tipo de Tasa">
                                                <input type="text" name="nombremoneda" id="nombremoneda" class="form-control" placeholder="Ingrese Tipo de Ramo" readonly>
                                    </div>
                                    
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Codigo</label>
                                          <input type="text" name="codigomoneda" id="codigomoneda" class="form-control" placeholder="Ingrese Tipo de Categoria" readonly>
                                    </div>	 
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>Simbolo</label>
                                                <input type="text" name="symbol_left" id="symbol_left" class="form-control" placeholder="Ingrese Tipo de Tasa" readonly>
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Valor</label>
                                                <input type="text" name="value" id="value" class="form-control" placeholder="Ingrese Monto de la Tasa">
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
        <script type="text/javascript" src="scripts/moneda.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

