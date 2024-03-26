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
                                    <h3 class="card-title">Pagos Taquilla <!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                              </div>
                             <!--
                              <div class="card-header">
                                    <div class="row">
                                    <div class="form-group col-sm-12 col-xs-4">
                                          <label>Contribuyentes</label>
                                          <select class="form-control" name="idrfc" id="idrfc" onchange="getidrfc(this.value);" placeholder="Seleccione Tipo" required></select>
                                    </div>
                              
                              </div>
                              </div>  -->


                               
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                              <select class="form-control input-sm" name="comodinbusqueda" id="comodinbusqueda" placeholder="Buscar" >
                                                      <option value="">--Seleccionar --</option>
                                                </select>
                                          </div> 
						      <div class="form-group col-md-8 col-sm-12 col-xs-1">
                                        
						            <button type="submit" onclick="getidrfc();" class="btn btn-info">Mostrar</button>
                           
                                                <label>Busqueda Contribuyente</label>
				                        <a href="pagostaquilla.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div>  
                              <div class="card-body" id="resporteestadocuenta">
                                          <h1 class="text-center" margin="0"><b>ESTADO DE CUENTA</b></h1>
                                          <h5 class="text-center" margin="0"><b>Razon Social:</b> <spam id="razsocial"></spam>  <b>N° RUC:</b> <spam id="rufrif"></spam></h5>
                                          <p class="text-center" margin="0"> <b>Direccion Fiscal: </b><spam id="direccionfiscal"></spam> <b>Correo:</b> <spam id="correo"></spam></p>
                                          
                                    
                                    <table id="tbllistado" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>  <th>#</th>
                                                      <th>Fecha</th>
                                                      <th>Tramite</th>
                                                      <th>Detalles</th>
                                                      <th>Monto Liq.</th>
                                                                                         
                                                      <th>Monto Dif.</th>
                                                      <th>Total pagado</th>
                                                      <th>Total a pagar</th>
                                                      <th>Marcar <input type="checkbox" name="marcarTodo1" id="marcarTodo1" /></th> 
                                                    
                                                </tr>
                                          </thead>
                                          <tbody id="listadotbody">
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>                                   
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                     
                                                      </tr>											
                                                </tfoot>
                                    </table>
                               </div>
                        </div>
                  </div>		
	      </div>
       
      </div>

     

</section>
	
	
	<div class="modal fade" name="formulario2" id="formulario2">
                                          <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                      <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                            <h4 class="modal-title" id="titulotamite">Procesar Pago Tramite</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
               
                  <input type="hidden" name="id_mayor" id="id_mayor" value="">
                    <input type="hidden" name="tramite" id="tramite" value="">
                    <input type="hidden" name="idt" id="idt" value="">
                    <input type="hidden" name="json_det" id="json_det" />
                                                      <div class="modal-body">
                                                            <div class="col-sm-12">
                                                                  <h6 class="modal-title"></h6>
                                                                        <div class="row">
                                                                              
                                                                            
                                                                        </div>
                                                            </div>      
                                                            <hr>
           <div class="col-sm-12">
           <h6 class="modal-title"></h6>
                                <div class="row">

                                 <div class="form-group col-sm-4 col-xs-12">
                                          <label>Referencia</label>
                                            <input type="text" class="form-control" name="txtreferencia" id="txtreferencia" required/> 
                                    </div> 

                                             <div class="form-group col-sm-4 col-xs-12">
                                                     <label>Aprobado</label>
                         <input type="text" name="txtaprobado" id="txtaprobado" class="form-control"  required/> 
                                                            </div>
                                                            <div class="form-group col-sm-4 col-xs-12">
                                                                 <label>Monto</label>
                         <input type="numeric" name="txtmonto"  class="form-control" id="txtmonto" onkeypress="return NumCheck(event, this)" value="" onblur="CarcularPagoTramite();"  required/> 
                                                            </div> 




                                </div>
                                <div id="cargartramites">
                                 
                                 </div>
                               <div class="row">

                                    <div class="form-group col-sm-4 col-xs-12">
                         <label>Total A Pagar:</label>
                         <input type="text" name="txttotalapagar" class="form-control"   id="txttotalapagar" value="" readonly="readonly" required/>
                      </div>
                                   
                                      
                              </div>
                               <div class="row">
                                    <button type="submit"  id="btn_pagotaqulla" name="btn_pagotaqulla" onclick="return guardarPagotaquilla();" class="btn btn-info float-right">Pagar</button>
                                    
                                    </div>
                                                                        
                                    

                                                            </div> 
                                                      </div> 
                                    
                                               </div>
                                               <!-- /.modal-content -->
                                          </div>
                                           <!-- /.modal-dialog -->
                                    </div>
	

    <!-- Fin Contenido PHP-->
    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/pagotaquilla.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script> 
        
		
<?php 
}
ob_end_flush();
?>

