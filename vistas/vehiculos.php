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
                                    <h3 class="card-title">Vehículos</h3>
                               
                                    <a href="vehiculos.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
			           <!--  <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						          <!--   <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar Nueva Tasa </button>
				                        <a href="http://localhost/surtri/vistas/bancos.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                                          </div>
				            </div>
				      </div>-->
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Vehículos </h3>
                              </div>
                              <div class="card-body" id="lista">
                                    <table id="tbllistado" class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>RIF</th>
                                                      <th>Marca</th>
                                                      <th>Modelo</th>
                                                      <th>Puestos</th>
                                                      <th>Peso</th>
                                                      <th>Fecha de Compra</th>
                                                      <th>Tributo</th>
                                                      <th>Último Pago</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                 <!-- iNFORMACION DE DATATABLE -->
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                <th>Opciones</th>
                                                      <th>Contribuyente</th>
                                                      <th>RIF</th>
                                                      <th>Marca</th>
                                                      <th>Modelo</th>
                                                      <th>Puestos</th>
                                                      <th>Peso</th>
                                                      <th>Fecha de Compra</th>
                                                      <th>Tributo</th>
                                                      <th>Último Pago</th>
                              
                                                </tr>     					
                                          </tfoot>
                                    </table>
                              </div>
                        </div>
                  </div>
            </div>
        

            

            <div class="card card-info" id="formularioregistros">  
                  <div class="card-header">
                        <h3 class="card-title">Formulario de Registro y Modificación de Vehículos</h3>
                  </div>
                  <form role="form" name="formulario" id="formulario" method="POST">
                        <div class="card-body"> 
			            <div class="row">
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Placa</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="hidden" name="rfc" id="rfc" class="form-control">
                                                <input type="text" name="licenseplate" id="licenseplate" class="form-control" placeholder="Ingrese Placa" readonly>
                                    </div>
                                    
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Marca</label>
                                          <select class="form-control" name="marca" id="marca" placeholder="Seleccione Marca" required>
                                               <option value="" selected>Seleccione una Marca</option>
                                                <option value="KYA">KYA</option>
                                                <option value="CHEVROLET">CHEVROLET</option>
                                                <option value="HYUNDAI">HYUNDAI</option>
                                                <option value="FORD">FORD</option>
                                                <option value="JEEP">JEEP</option>
                                                <option value="TOYOTA">TOYOTA</option>
                                                <option value="MITSUBISHI">MITSUBISHI</option>
                                                <option value="CHERY">CHERY</option>
                                                <option value="MAZDA">MAZDA</option>
                                                <option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
                                                <option value="HUMMER">HUMMER</option>
                                                <option value="IVECO">IVECO</option>
                                                <option value="RENAULT">RENAULT</option>
                                                <option value="SILVERADO">SILVERADO</option>
                                                <option value="VOLKSWAGEN">VOLKSWAGEN</option>
                                                <option value="VENIRAUTO">VENIRAUTO</option>
                                                <option value="NISSAN">NISSAN</option>
                                                <option value="DAEWOO">DAEWOO</option>
                                                <option value="FIAT">FIAT</option>
                                                <option value="IVECO">IVECO</option>
                                                <option value="DUCATI">DUCATI</option>
                                                <option value="APRILIA">APRILIA</option>
                                                <option value="BMW">BMW</option>
                                                <option value="YAMAHA">YAMAHA</option>
                                                <option value="HONDA">HONDA</option>
                                                <option value="SUZUKI">SUZUKI</option>
                                                <option value="KAWASAKI">KAWASAKI</option>
                                                <option value="KTM">KTM</option>
                                                <option value="TRIUMPH">TRIUMPH</option>
                                                <option value="UM">UM</option>
                                                <option value="VESPA">VESPA</option>
                                                <option value="SKYGO">SKYGO</option>
                                                <option value="EMPIRE">EMPIRE/option>
                                                <option value="BERA">BERA</option>
                                                <option value="HONDA">HONDA</option>
                                                <option value="TORO">TORO</option>
                                                <option value="KTM">KTM</option>
                                                <option value="CFMOTO">CFMOTO</option>
                                                <option value="HJM">HJM</option>
                                                <option value="OWEN">OWEN</option>
                                                <option value="DAIHATSU">DAIHATSU</option>
                                                <option value="DODGE">DODGE</option>
                                                <option value="KEEWAY">KEEWAY</option>
                                                <option value="JAC">JAC</option>
                                                <option value="SAIC">SAIC</option>
                                                <option value="OTRO">OTRO</option>
                                                <option value="ZHONGXING">ZHONGXING</option>
                                                <option value="LONCIN">LONCIN</option>
                                                <option value="DONGFENG">DONGFENG</option>
                                                <option value="SAIPA">SAIPA</option>
                                                <option value="DAYUN">DAYUN</option>
                                                <option value="SEAT">SEAT</option>
                                                <option value="CHANGAN">CHANGAN</option>
                                                <option value="MACK">MACK</option>
                                                <option value="PEGASO">PEGASO</option>
                                                <option value="MERCURY">MERCURY</option>
                                                <option value="PEUGEOT">PEUGEOT</option>
                                                <option value="BLUE BIRD">BLUE BIRD</option>
                                                <option value="HAIMA">HAIMA</option>
                                                <option value="ENCAVA">ENCAVA</option>
                                                <option value="CHANA">CHANA</option>
                                                <option value="KENWORTH">KENWORTH</option>
                                                <option value="REMOLQUES TIUNA">REMOLQUES TIUNA</option>
                                                <option value="METALURGICA COLON">METALURGICA COLON</option>
                                                <option value="SAN CRISTOBAL">SAN CRISTOBAL</option>
                                                <option value="FORMACA">FORMACA</option>
                                                <option value="T&L CA">T&L CA</option>
                                                <option value="LADA">LADA</option>
                                                <option value="KODIAC">KODIAC</option>
                                                <option value="G.M.C">G.M.C</option>
                                                <option value="VOLTRAILER">VOLTRAILER</option>
                                                <option value="INTERNATIONAL ">INTERNATIONAL </option>
                                                <option value="INTERNACIONAL">INTERNACIONAL</option>
                                                <option value="FRAB">FRAB</option>
                                                <option value="FREIGHTLINER">FREIGHTLINER</option>
                                                <option value="VANGUARD">VANGUARD</option>
                                                <option value="IBRANCA">IBRANCA</option>
                                                <option value="INMECA">INMECA</option>
                                                <option value="BATEAS GERLAP">BATEAS GERLAP</option>
                                                <option value="INMECAR BATEA">INMECAR BATEA</option>
                                                <option value="TASCA">TASCA</option>
                                                <option value="HOWO">HOWO</option>
                                                <option value="KODIAC">KODIAC</option>
                                                <option value="UTILITY US2M">UTILITY US2M</option>
                                                <option value="CARONI">CARONI</option>
                                                <option value="REMYVECA">REMYVECA</option>
                                                <option value="DIDI">DIDI</option>
                                                <option value="FABRICACIÓN NACIONAL">FABRICACIÓN NACIONAL</option>
                                                <option value="FABRICACIÓN INTERNACIONAL">FABRICACIÓN INTERNACIONAL</option>
                                                <option value="GURI">GURI</option>
                                                <option value="INMECAR BATEA">INMECAR BATEA</option>
                                                <option value="COMMER">COMMER</option>
                                                <option value="FABR EXTRANJERA">FABR EXTRANJERA</option>
                                                <option value="CLARK">CLARK</option>
                                                <option value="VOLVO">VOLVO</option>
                                                <option value="HINO MOTORS DE VENEZUELA">HINO MOTORS DE VENEZUELA</option>
                                                <option value="EBRO">EBRO</option>
                                                <option value="FARGO">FARGO</option>
                                                <option value="DAEWOO">DAEWOO</option>
                                                <option value="YOUTONG BUS">YOUTONG BUS</option>
                                                <option value="TITAN">TITAN</option>
                                                <option value="HINO">HINO</option>
                                                <option value="KAMAZ">KAMAZ</option>
                                                <option value="INNOCENTI ">INNOCENTI </option>
                                                <option value="OPEL">OPEL</option>
                                                <option value="DFSK">DFSK</option>
                                                <option value="CHRYLER">CHRYLER</option>
                                                <option value="APOLO">APOLO</option>
                                                <option value="CITROEN">CITROEN</option>
                                                <option value="FOTON">FOTON</option>
                                                <option value="CHANGAN">CHANGAN</option>
                                                <option value="BUICK">BUICK</option>

                                          </select>
                                    </div>	 
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>Modelo</label>
                                                <input type="text" name="modelos" id="modelos" class="form-control" placeholder="Ingrese Modelo">
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Año</label>
                                                <input type="text" name="anio" id="anio" class="form-control" placeholder="Ingrese Año">
                                    </div>  
                                    
                              </div>

                              <div class="row">
                                   
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Fecha de Compra</label>
                                                <input type="date" name="fechacompra" id="fechacompra" class="form-control" placeholder="Ingrese Fecha de Compra">
                                    </div>  
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>Puestos</label>
                                                <input type="number" name="puestos" id="puestos" class="form-control" placeholder="Ingrese Puestos" require>
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Peso</label>
                                                <input type="number" name="pesos" id="pesos" class="form-control" placeholder="Ingrese Peso" require>
                                    </div>  
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Fecha de Registro</label>
                                                <input type="text" name="registered" id="registered" class="form-control" placeholder="Ingrese fecha" readonly>
                                    </div>  
                              </div>
                              <div class="row">
                                    <div class="form-group col-sm-12 col-xs-4">
                                          <label>Tasa tributaria</label>
                                          <select class="form-control" name="idtvehiculo" id="idtvehiculo" placeholder="Seleccione Tipo" required></select>
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
        <script type="text/javascript" src="scripts/vehiculos.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

