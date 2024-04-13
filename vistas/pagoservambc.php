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
                                    <h3 class="card-title">Pago de Servicio Residencial, Empresa, Industria, Comercio, Instituciones y Sucursales</h3>
                              </div>
			            
                              <div class="card-body">
                                     <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Tipo Serv.</th>
                                                      <th>Direccion</th>
                                                      <th>Fecha de Pago</th>
                                                      <th>Tasa</th>                                   
                                                </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Tipo Serv.</th>
                                                      <th>Direccion</th>
                                                      <th>Fecha de Pago</th>
                                                      <th>Tasa</th>   
                                                      			
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
        
      <div class="card card-info" id="formularioregistros">  
            <div class="card-header">
                  <h3 class="card-title">Listado de Peridos del Servicio</h3>
            </div>
            <div class="card-body">
                  <div id="tablal" class="row">
                        <div class="form-group col-sm-12 col-xs-12">
                              <label>Tabla</label>  
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Periodo</th>
                                                      <th>Estatus</th>
                                                      <th>Opciones</th>
                                                
                                                </tr>
                                          </thead>
                                          <tbody id="tramites">
                                          </tbody>
                                    </table>       
                        </div>
                  </div>
            </div>
            <div class="card-footer">
                              
                              <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
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
        <script type="text/javascript" src="scripts/pagoservambc.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script src="../vistas/scripts/index.js"></script>
<?php 
}
ob_end_flush();
?>

