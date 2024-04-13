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
                                    <h3 class="card-title">Registro de Servicio Residencial, Empresa, Industria, Comercio, Instituciones y Sucursales</h3>
                              </div>
			            <div class="card-header">
                                    <div class="row">
                                          <div class="form-group col-md-4 col-sm-6 col-xs-1">
                                                <select class="form-control input-sm" name="comodinbusqueda" id="comodinbusqueda" placeholder="Buscar" >
                                                      <option value="">--Seleccionar --</option>
                                                </select>
                                          </div> 
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
                                                <button type="submit" onclick="listar()" class="btn btn-info">Mostrar</button>
                                                <button type="button" class="btn btn-info" onclick="mostrarform(true)"></i> Nuevo</button>
                                                
                                                <a href="http://localhost/surtri/vistas/empambientead.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
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
                                                      <th>Periodo Pagado</th>
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
                                                      <th>Periodo Pagado</th>
                                                      <th>Tasa</th>   
                                                      			
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
        
      <div class="card card-info" id="formularioregistros">
            <div class="card-header">
                  <h3 class="card-title">Formulario de Registro o Modificacion</h3>
            </div>
            <form role="form" name="formulario" id="formulario" method="POST">
                  <div class="card-body">
                        <div class="row">
                              <div class="form-group col-sm-2 col-xs-12">
                                    <label>RUC</label>
                                          <input type="hidden" name="id" id="id">
                                          <input type="text" name="rfc" id="rfc" class="form-control" placeholder="Ingrese RUC" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div>       
                              <div class="form-group col-sm-10 col-xs-12">
                                    <label>Nombre</label>
                                          <input type="text" name="datos" id="datos" class="form-control" placeholder=""  required disabled>
                              </div>
                        </div>
                        <div class="row">	 
                             
                              <div class="form-group col-sm-3 col-xs-12">
                                    <label>Sector</label>
                                          <input type="text" name="sector" id="sector" class="form-control" placeholder="Ingre el sector" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div>
                              <div class="form-group col-sm-3 col-xs-12">
                                    <label>Calle</label>
                                          <input type="text" name="calle" id="calle" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div> 
                              <div class="form-group col-sm-3 col-xs-12">
                                    <label>Edificio/Casa</label>
                                          <input type="text" name="edificio" id="edificio" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div>
                              <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Nro Edificio/Casa</label>
                                                      <input type="text" name="numeroedif" id="numeroedif" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div> 
                        </div>
                        <div class="row">
                              <div class="form-group col-sm-9 col-xs-12">
                                    <label>Direccion exacta</label>
                                                      <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                              </div>
                              <div class="form-group col-sm-3 col-xs-12">
                                          <label>Ultimo Periodo Pagado</label>
                                                      <input type="date" name="ultima_declaracion" id="ultima_declaracion" class="form-control" required>
                              </div>
	                  </div>
                        <div class="row">
                              <div class="form-group col-sm-1 col-xs-12">
                                    <label>Tasa</label>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario2" onclick="listartipotax()"></i>Asignar</button>
                              </div> 
                              <div class="form-group col-sm-11 col-xs-12">
                                                      <label>Tasa Asignada</label>
                                                      <input type="hidden" name="idt" id="idt">
                                                      <input type="hidden" name="tiposer" id="tiposer">
                                                            <input type="text" name="tasaasignada" id="tasaasignada" class="form-control">
                              </div> 
                              
                        </div> 
                  </div> 
                  <div class="card-footer">
					            <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                                          <button type="button" onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                  </div>
            </form>

                              <div class="modal fade" name="formulario2" id="formulario2">
                                    <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                                <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                      <h4 class="modal-title">Asignacion de Tasa</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo Servicio</label>
                                                                  <select class="form-control" name="tiposervicio" id="tiposervicio" placeholder="Seleccione Tipo de Pago" required>
                                          <option value="">Seleccione Tipo de Servicio</option>
                                                                  <option value="1">Comercial</option>
                                                                  <option value="2">Residencial</option>
                                          </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo de Tasa</label>
                                                                  
                                                                  <select class="form-control" name="tipo2" id="tipo2" placeholder="Seleccione Tipo" required>
                                                                  </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo de Ramo</label>
                                                                  <select class="form-control" name="ramo2" id="ramo2" placeholder="Seleccione Ramo" required>
                                                                  </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo de Categoria</label>
                                                                  <select class="form-control" name="categoria2" id="categoria2" placeholder="Seleccione Categoria" required>
                                                                  </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tasa</label>
                                                                  <select class="form-control" name="taseoi2" id="taseoi2" placeholder="Seleccione Categoria" required>
                                                                  </select>
                                                      </div>
                                                            <button type="submit" onclick="editarTax()" class="btn btn-info float-right">Guardar</button>
                                                            
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
        <script type="text/javascript" src="scripts/empambiente.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script src="../vistas/scripts/index.js"></script>
<?php 
}
ob_end_flush();
?>

