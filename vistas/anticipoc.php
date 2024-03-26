<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
$rfc=$_SESSION['rfc'];
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
                                    <h3 class="card-title">Anticipo Mensual</h3>
                                    <h3></h3>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						           <button class="btn btn-info" id="btnagregar" onclick="verificaciones();"><i class="fa fa-plus-circle"></i> Registrar de Anticipio Mensual</button>
				                        <a href="anticipoc.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Anticipios Registrados</h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                    
                                                      <th>Periodo</th>
                                                      <th>Tramite</th>
                                                      <th>Ver tramite</th>
                                                      <th>Ver recibo</th>
                                                     
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                          
                                                      <th>Periodo</th>
                                                      <th>Tramite</th>
                                                      <th>Ver tramite</th>
                                                      <th>Ver recibo</th>
                                                     
                                                      
                                                      
                                                </tr>     					
                                          </tfoot>
                                    </table>


                                   
                              </div>
                              </div>
                        </div>
                  </div>
      

            

                  <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro de Anticipo de Actividad Economica</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    <div class="form-group col-sm-2 col-xs-12">
                                          <label>RFC</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="text" name="rfc" id="rfc" class="form-control" placeholder="" disabled>
                                    </div>
                                    <div class="form-group col-sm-2 col-xs-12">
                                          <label>RIF</label>
                                          <input type="text" name="rif" id="rif" class="form-control" placeholder="" disabled>
                                    </div>
                                    <div class="form-group col-sm-8 col-xs-12">
                                          <label>Razon Social</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="" disabled>
                                    </div>   
                              </div>
                              <div class="row">
                                    <div class="form-group col-sm-6 col-xs-12">
                                          <label>Año</label>
                                                <select class="form-control" name="anno" id="anno" placeholder="Seleccione Año" required>
                                                      <option value="">Seleccione Año Fiscal</option>
                                                      <option value="2022">2022</option>
                                                      <option value="2023">2023</option>
                                                      <option value="2024">2024</option>
                                                </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-xs-12">
                                          <label>Mes</label>
                                                <select class="form-control" name="mes" id="mes" placeholder="Seleccione Año" required>
                                                      <option value="">Seleccione Periodo</option>
                                                      <option value="01">Enero</option>
                                                      <option value="02">Febrero</option>
                                                      <option value="03">Marzo</option>
                                                      <option value="04">Abril</option>
                                                      <option value="05">Mayo</option>
                                                      <option value="06">Junio</option>
                                                      <option value="07">Julio</option>
                                                      <option value="08">Agosto</option>
                                                      <option value="09">Septiembre</option>
                                                      <option value="10">Octubre</option>
                                                      <option value="11">Noviembre</option>
                                                      <option value="12">Diciembre</option>
                                                </select>
                                    </div> 
                              </div>
                              <p id="actv"></p>	
                              <div class="row">
                                                <div class="form-group col-sm-10 col-xs-12">
                                                      <label>Carge Declaracion de Seniat</label>
                                                      <input type="file" class="form-control" name="documento" id="documento" maxlength="256" placeholder="Imagen" required>
                                                </div>
                                                <div class="form-group col-sm-2 col-xs-12">
				  			<label>Ingresos Total</label>
			      			<input type="number" name="montotal" id="montotal" class="form-control" readonly="readonly" required>
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
        <script type="text/javascript" src="scripts/anticipoc.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

