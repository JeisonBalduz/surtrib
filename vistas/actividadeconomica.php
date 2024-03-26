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
{     echo '<input type="hidden" name="idrfc" id="idrfc" value="'.$_SESSION['rfc'].'"/>';
?>
    <!-- Inicio Contenido PHP-->
<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
		            <div class="card" id="listadoregistros">
                             
                             <div class="card-header">
                                    <h3 class="card-title">Solicitud de Licencia de Comercio</h3>
                                    <h3></h3>
                              </div>
                              

                <div class="card-header">
                                    <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
                                               <button class="btn btn-info" data-toggle="modal" data-target="#formulario2" id="btnagregar" onclick=""><i class="fa fa-plus-circle"></i> Nueva Solicitud </button>
                                                
                                          </div>
                                    </div>
                              </div>


                              <div class="card-header">
                                    <h3 class="card-title">Listado Patente Registradas</h3>
          </div>


        
              
              <!-- Titulos Formulario-->
              
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Serial Digital</th>
                                                      <th>Estado</th>
                                                      <th>Descripción/Doc</th>
                                                      
                                                   
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Serial Digital</th>
                                                      <th>Estado</th>
                                                      <th>Descripción/Doc</th>
                                                     
                                                </tr>                               
                                          </tfoot>
                                    </table>
                              </div>


                 

                   <div class="modal fade" name="formulario2" id="formulario2">
                                          <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                      <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                            <h4 class="modal-title">Nueva Solicitud</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body">
                                                                 
                                                            <hr>
                                                            <div class="col-sm-12">
                                                                  
                                                                        <div class="row">
                                                                              <div class="form-group col-sm-4 col-xs-12">
                                                                                    <label>Tipo de solitud</label>
                                                                                       <select id="seltipo" name="seltipo" class="input" onchange="">
                                    <option value="0" selected="">Seleccione </option>
                                     <option value="1">Nueva Actividad</option>
                                                                            <option value="2">Actualizar Datos</option>
                                        <option value="3">Modificar actividad</option>

                                                                    </select>        
                                                                              </div>


                                                                         
                                                                            <label>Descripción o motivo</label>
                                                                              <div class="form-group col-sm-4 col-xs-12">
                                                                                    
                                                                                          <input class="input" type="text" id="motivo" name="motivo" placeholder="Motivo" required="">
                                                                              </div>
                                                                              
                                                                        </div>
                                                                        
                                                                        
                                                                  
                                                               
                                                                  <button type="submit" onclick="Solicitar();" id="btn_declararvehiculo" class="btn btn-info">Solicitar</button>
                                                            </div> 
                                                      </div>
                                               </div>
                                               <!-- /.modal-content -->
                                          </div>
                                           <!-- /.modal-dialog -->
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
        <script type="text/javascript" src="scripts/actividadeconomica.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

