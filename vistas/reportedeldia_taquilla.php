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
                                    <h3 class="card-title"><strong>Reporte del Dia </strong><!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                                    <a href="reportedeldia.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Desde</label>
                                           <input type="date" name="fechadia" id="fechadia" class="form-control" placeholder="Ingrese Fecha">
                                          </div> 
                                          <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Hasta</label>
                                           <input type="date" name="fechadia2" id="fechadia2" class="form-control" placeholder="Ingrese Fecha">
                                          </div> 
						      <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Busqueda</label><br/>
						            <button type="submit" onclick="reportedeldia_taquilla();" class="btn btn-info">Mostrar</button>
                           
                                                
				                        
                                          </div>
				            </div>
					</div> 
                               
                              <div class="card-body" id="resportedeldia">
                                 <div class="card-header" align="text-center">
                                  
                                   <h3 class="card-title" style="text-align: center;"><strong>REPORTE DE OPERACIONES POR PUNTO DE VENTA </strong></h3>  
                              </div>                                                 
                                    
                                    <table id="tbllistado" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      <th>#</th>
                                                      <th>CAJERO</th>
                                                      <th>FECHA PAG</th>
                                                      <th>TRAMITE</th>
                                                      <th>RECIBO</th>                                   
                                                      <th>APROB.</th>
                                                      <th>REF</th>
                                                      <th>MONTO</th>
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th><spam id="stotaliq"></spam></th>                                   
                                                      <th><spam id="sdiferido"></spam></th>
                                                      <th><spam id="sdescuento"></spam></th>
                                                      <th><spam id="stotalp"></spam></th>
                                                      <th><spam id="stotaltotal"></spam></th>
                                                      </tr>											
                                                </tfoot>
                                    </table>

                                   


                           <div class="row">
                                  <div class="form-group col-sm-3 col-xs-4">
                                    <button type="button"  id="btn_Imprimir" name="btn_Imprimir" onclick="return imprSelec();" class="btn btn-info float-right">Imprimir</button>
                                    </div>
                                    </div>
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
        <script type="text/javascript" src="scripts/reportedeldia_taquilla.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

