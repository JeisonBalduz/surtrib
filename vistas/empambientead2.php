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
                                    <h3 class="card-title">Registro de Empresa Industria, Comercio, Instituciones y Sucursales</h3>
                              </div>
			            <div class="card-header">
                                    <div class="row">
                                          <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                                <label>Contribuyente</label>
                                                      <select name="usuario" id="usuario" class="form-control" data-live-search="true" required>Seleccione un Opcion</select>
                                        </div> 
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
                                                <button type="submit" onclick="listar()" class="btn btn-info">Mostrar</button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario3" onclick="agregarnuevo()"></i> Nuevo</button>
                                                <a href="http://localhost/surtri/vistas/empambientead.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                     <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Estado</th>
                                                      <th>Tipo</th>
                                                      <th>Sector</th>
                                                      <th>Direccion</th>                                   
                                                      <th>Ultima Fecha de Pago</th>
                                                      <th>Copia Rif</th>
                                                      <th>Copia Registro</th>
                                                      <th>Tasa de Pago</th>
                                                 
                                                </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Estado</th>
                                                      <th>Tipo</th>
                                                      <th>Sector</th>
                                                      <th>Direccion</th>                                   
                                                      <th>Ultima Fecha de Pago</th>
                                                      <th>Copia Rif</th>
                                                      <th>Copia Registro</th>
                                                      <th>Tasa de Pago</th>
                                                      			
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
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <input type="hidden" name="rfc" id="rfc" class="form-control" >
                                                       <label>Tipo de Servicio</label>
                                                            <select class="form-control select2" name="licencia" id="licencia" placeholder="Seleccione Tipo Servicio" required>

								                  <option value="Comercial">Comercial</option>
                                                                  <option value="Residencial">Residencial</option>
                                                            </select>
                                                </div>
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Sector</label>
                                                      <input type="text" name="sector" id="sector" class="form-control" placeholder="Ingre el sector" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                <div class="form-group col-sm-2 col-xs-12">
                                                      <label>Calle</label>
                                                      <input type="text" name="calle" id="calle" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div> 
                                                <div class="form-group col-sm-2 col-xs-12">
                                                      <label>Edificio</label>
                                                <input type="text" name="edificio" id="edificio" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                <div class="form-group col-sm-2 col-xs-12">
                                                      <label>N° Edificio</label>
                                                      <input type="text" name="numeroedif" id="numeroedif" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div> 
                                          </div>
                                          <div class="row">
                                                
                                                <div class="form-group col-sm-9 col-xs-12">
                                                      <label>Direccion exacta</label>
                                                      <input type="text" name="medit" id="medit" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Ultima Fecha de Pago</label>
                                                      <input type="date" name="ultima_declaracion" id="ultima_declaracion" class="form-control" required>
                                                </div>
		
                                          </div>
                                          <div class="row">

                                          <div class="form-group col-sm-1 col-xs-12">
                                                <label>Editar Tasa</label>
                                                      
                                                            
                                                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario2" onclick="listartipotax()"></i> +   </button>
                                                
                                                            
                                          </div> 
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Tipo de Zona</label>
                                                      
                                                            <input type="text" name="tipo" id="tipo" class="form-control">
                                                      
                                                </div> 
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Zona</label>
                                                      <input type="text" name="ramo" id="ramo" class="form-control">
                                                </div>
                                                <div class="form-group col-sm-4 col-xs-12">
                                                      <label>Tasa</label>
                                                      <input type="text" name="categoria" id="categoria" class="form-control">
                                                      <input type="hidden" name="taseoi" id="taseoi" class="form-control" >
                                                            </select>
                                                </div>
                                                
                                          </div> 
					            <div class="row">

                                          <!-- <div id="mapa"></div>-->
			                              <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Documento RIF</label>
                                                      <input type="hidden" name="docrifactual" id="docrifactual">
                                                      <input type="file" class="form-control" name="docrif" id="docrif">
                                                      <img src="" width="150px" height="120px" id="docrifmuestra">
                                                </div>	 
			                              <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Documento Registro</label>
                                                      <input type="hidden" name="docregistroactual" id="docregistroactual">
                                                      <input type="file" class="form-control" name="docregistro" id="docregistro">
                                                      <img src="" width="150px" height="120px" id="docregistromuestra">
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
                                                      <h4 class="modal-title">Asignacion de Zona</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo de Zona</label>
                                                                  <input type="hidden" name="rfc2" id="rfc2" class="form-control" required>
                                                                  <select class="form-control" name="tzona2" id="tzona2" placeholder="Seleccione Tipo" required>
                                                                  </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Zona</label>
                                                                  <select class="form-control" name="zona2" id="zona2" placeholder="Seleccione Ramo" required>
                                                                  </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tasa</label>
                                                                  <select class="form-control" name="tasaresidencial2" id="tasaresidencial2" placeholder="Seleccione Categoria" required>
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
			

                        <div class="modal fade" name="formulario3" id="formulario3">
                                    <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                                <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                      <h4 class="modal-title">Nuevo Registro</h4>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="row">	 
                                                <div class="form-group col-sm-12 col-xs-12">
                                                       <label>Contribuyente</label>
                                                            <select class="form-control select2" name="idusuario" id="idusuario" placeholder="Seleccione Tipo de Pago" required>
                                                            </select>
                                                            </div>
                                                      </div> 
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Tipo de servicio</label>
                                                            <select class="form-control select2" name="licenciaasignar" id="licenciaasignar" placeholder="Seleccione Tipo de Pago" required>
                                                                  <option value="">Seleccione Tipo de Pago</option>
								                  <option value="Residencial">Residencial</option>
                                                                  <option value="Comercial">Comercial</option>
                                                            </select>
                                                      </div>
                                                      <div class="form-group col-sm-12 col-xs-12">
                                                            <label>Direccion</label>
                                                            <input type="text" name="medit2" id="medit2" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                      </div>
                                                            <button type="submit" onclick="guardanuevo()" class="btn btn-info float-right">Guardar</button>
                                                            
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
        <script type="text/javascript" src="scripts/empambiente2.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script src="../vistas/scripts/index.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();
?>

