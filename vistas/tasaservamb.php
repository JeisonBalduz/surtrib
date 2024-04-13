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
                                    <h3 class="card-title">Tasa de Servicios Residencial, Empresas, Comercios e Instituciones</h3>
                              </div>
                              
                                    <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">                      
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Tipo Serv.</th>
                                                      <th>Tasa</th>
                                                      <th>Tipo Ramo o Zona</th>
                                                      <th>Categoria o Zona</th>
                                                      <th>Tasa</th>
                                                      <th>Estado</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Opciones</th>
                                                      <th>Tipo Serv.</th>
                                                      <th>Tasa</th>
                                                      <th>Tipo Ramo o Zona</th>
                                                      <th>Categoria o Zona</th>
                                                      <th>Tasa</th>
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
                        <h3 class="card-title">Formulario de Registro y Modificacion de Bancos</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
                              <div class="row">
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Tipo</label>
                                                <input type="hidden" name="id" id="id" class="form-control" placeholder="Ingrese Tipo de Tasa">
                                                <input type="text" name="tipotax" id="tipotax" class="form-control" placeholder="Ingrese Tipo de Ramo" readonly>
                                    </div>
                                    
                                    <div class="form-group col-sm-3 col-xs-4">
                                          <label>Ramo</label>
                                          <input type="text" name="ramotax" id="ramotax" class="form-control" placeholder="Ingrese Tipo de Categoria" readonly>
                                    </div>       
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Categoria</label>
                                                <input type="text" name="categoriatax" id="categoriatax" class="form-control" placeholder="Ingrese Tipo de Tasa" readonly>
                                    </div> 
                                     <div class="form-group col-sm-3 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" name="tax" id="tax" class="form-control" placeholder="Ingrese Tipo de Tasa">
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
        <script type="text/javascript" src="scripts/tasaservamb.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

