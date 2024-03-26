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
                                          <div class="form-group col-md-12 col-sm-6 col-xs-1">
						      <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button> 
				                  <a href="http://localhost/surtri/vistas/empambiente.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
					</div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Empresa Industria, Comercio, Instituciones y Sucursales Registradas</h3>    
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
                                                       <label>Tipo de Inmueble</label>
                                                            <select class="form-control" name="licencia" id="licencia" placeholder="Seleccione Tipo de Pago" required>
                                                                  <option value="">Seleccione Tipo de Pago</option>
								                  <option value="Principal">Principal</option>
                                                                  <option value="Sucursal">Sucursal</option>
                                                            </select>
                                                </div>
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Sector</label>
                                                      <input type="text" name="sector" id="sector" class="form-control" placeholder="Ingre el sector" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div>
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Calle</label>
                                                      <input type="text" name="calle" id="calle" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div> 
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>Edificio</label>
                                                <input type="text" name="edificio" id="edificio" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="form-group col-sm-3 col-xs-12">
                                                      <label>N° Edificio</label>
                                                      <input type="text" name="numeroedif" id="numeroedif" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div> 
                                                <div class="form-group col-sm-9 col-xs-12">
                                                      <label>Direccion exacta</label>
                                                      <input type="text" name="medit" id="medit" class="form-control" placeholder="Ingre la direccion segun RIF" onkeyup="this.value = this.value.toUpperCase();" required>
                                                </div> 
		
                                          </div>
                                          <div class="row">	 
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Ultima Fecha de Pago</label>
                                                      <input type="date" name="ultima_declaracion" id="ultima_declaracion" class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Tasa Asignada</label>
                                                <input type="text" name="taseoi" id="taseoi" class="form-control" readonly>
                                                </div> 
                                                </div> 
					            <div class="row">
			                              <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Documento RIF</label>
                                                      <input type="hidden" name="docrifactual" id="docrifactual">
                                                      <input type="file" class="form-control" name="docrif" id="docrif" required>
                                                      <img src="" width="150px" height="120px" id="docrifmuestra">
                                                </div>	 
			                              <div class="form-group col-sm-6 col-xs-12">
                                                      <label>Documento Registro</label>
                                                      <input type="hidden" name="docregistroactual" id="docregistroactual">
                                                      <input type="file" class="form-control" name="docregistro" id="docregistro" required>
                                                      <img src="" width="150px" height="120px" id="docregistromuestra">
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
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

