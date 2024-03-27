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
			            <div class="card-header">
                                    <div class="row">
                                          <div class="form-group col-md-8 col-sm-6 col-xs-1">
                                                <select class="form-control input-sm" name="comodinbusqueda" id="comodinbusqueda" placeholder="Buscar" >
                                                      <option value="">--Seleccionar --</option>
                                                </select>
                                          </div> 
                                          <div class="form-group col-md-4 col-sm-12 col-xs-1">
                                                <button type="submit" onclick="listar()" class="btn btn-info">Mostrar Servicios</button>
                                          </div>
                                    </div>
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
                        <h3 class="card-title">Formulario de Registro de Pago por Caja</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
                              <div class="row">
                                    
                                    <div class="form-group col-sm-2 col-xs-12">
                                          <label>Tipo de Servicio</label>
                                                <select class="form-control select2" name="tipocontri" placeholder="Seleccione Banco" id="tipocontri"  required>
                                                      <option value="">Seleccione Tipo de Pago</option>
                                                      <option value="1">Comercial</option>
                                                      <option value="2">Residencial</option>
                                                      
                                                </select>
                                    </div>
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Contribuyente</label>
                                                <select class="form-control select2" name="contribuyente" placeholder="Seleccione Banco" id="contribuyente"  required>
                                                </select>
                                    </div>
                                    
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Inmuble o Comercio</label>
                                                <select class="form-control select2" name="inmueble" placeholder="Seleccione Banco" id="inmueble"  required>
                                                </select>
                                    </div>
                              </div>
                              <div class="row">  
                                    
                                    <div class="form-group col-sm-8 col-xs-12">
                                          <label>Descripcion</label>
                                                <input type="text" class="form-control" name="prueba" id="prueba">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="tasa" id="tasa">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="ulmepago" id="ulmepago">
                                    </div> 
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Esta</label>
                                                <input type="text" class="form-control" name="nombremoneda" id="nombremoneda">
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Tasa</label>
                                                <input type="text" class="form-control" name="meses" id="meses">
                                    </div>
                                    <div class="form-group col-sm-5 col-xs-12">
                                          <label>Seleccione Inmuble o Comercio</label>
                                                <select class="form-control select2" name="dueda" placeholder="Seleccione Banco" id="dueda"  required>
                                                </select>
                                    </div>
                              </div>
                              
                                             
                         </div>
                        <div class="card-footer">
                              <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                              <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                              <button type="button" onclick="listMonthsBackwards()" class="btn btn-danger float-right">Prueba</button>
                              <button type="button" onclick="pruebaretun()" class="btn btn-danger float-right">esta es la prueva</button>
                        </div>
                  </form>
                  <div class="invoice p-3 mb-3" id="formato-factura">
              <!-- title row -->
             <div id="tablal" class="row">
                                                            <div class="form-group col-sm-12 col-xs-12">
                                                                  <label>Tabla</label>  
                                                                        <table id="tbllistado" class="table table-bordered table-hover">
                                                                               <thead>
                                                                                    <tr>
                                                                                          <th>Fecha</th>
                                                                                          <th>Tramite</th>
                                                                                          <th>Detalle</th>
                                                                                          <th>Monto Liquidado</th>
                                                                                          <th>Monto Deferido</th>
                                                                                          <th>Monto Pagado</th>
                                                                                          <th>Conciliar</th>
                                                                                          
                                                                                    </tr>
                                                                              </thead>
                                                                                    <tbody id="tramites">
                                                                                     
                                                                                    </tbody>
                                                                        </table>       
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
        <script type="text/javascript" src="scripts/pagoservamb.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script src="../vistas/scripts/index.js"></script>
<?php 
}
ob_end_flush();
?>

