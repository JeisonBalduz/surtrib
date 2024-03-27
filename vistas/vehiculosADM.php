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
                               
                                    <a href="vehiculosADM.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-12 col-sm-12 col-xs-1">
						             <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Registrar Nuevo Vehículo</button>
				                        <!--<a href="http://localhost/surtri/vistas/bancos.php" type="submit" class="btn btn-danger float-right">Limpiar</a>-->
                                          </div>
				            </div>
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Vehículos </h3>
                              </div>
                              <div id="mensaje"></div>
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
                                                      <th>RUC</th>
                                                      <th>Placa</th>
                                                      <th>Tributo</th>
                                                      
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
                                                      <th>RUC</th>
                                                      <th>Placa</th>
                                                      <th>Tributo</th>
                                                      
                                                      
                              
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
                                    <div class="form-group col-sm-3 col-xs-12" id="conenterdorRUF">
                                         
                                          <input type="hidden" name="id" id="id" class="form-control" placeholder="Ingrese el identificador" readonly > 
                                          <label>RUC</label>
                                          <input type="text" name="ruf2" id="ruf" class="form-control" placeholder="Ingrese RUC"required  > 

                                          <button type="submit" name="buscarRUF" id="buscarRUF" onclick="buscar_datos(event);" class="btn btn-info mt-2">Mostrar</button>
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12" id="contenedornombre">
                                          <label>Nombre</label>
                                          
                                          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre" readonly required> 
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12" id="contenedorRif">
                                          <label>Rif/C.I</label>
                                          <input type="text" name="rif" id="rif" class="form-control" placeholder="RIF/C.I" readonly required> 
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Placa</label>
                                          
                                          <input type="text" name="licenseplate" id="licenseplate" class="form-control" placeholder="Ingrese Placa" required>
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
                                                   
                                          </select>
                                    </div>	 
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>Modelo</label>
                                                <input type="text" name="modelos" id="modelos" class="form-control" placeholder="Ingrese Modelo" required>
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Año</label>
                                                <input type="text" name="anio" id="anio" class="form-control" placeholder="Ingrese Año" required>
                                    </div>  
                                    
                               
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Fecha de Compra</label>
                                                <input type="date" name="fechacompra" id="fechacompra" class="form-control" placeholder="Ingrese Fecha de Compra" required>
                                    </div>  
			                  <div class="form-group col-sm-3 col-xs-12">
                                          <label>Puestos</label>
                                                <input type="number" name="puestos" id="puestos" class="form-control" placeholder="Ingrese Puestos" required >
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Peso</label>
                                                <input type="number" name="pesos" id="pesos" class="form-control" placeholder="Ingrese Peso"  required>
                                    </div>  
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Fecha de Registro</label>
                                                <input type="date" name="registered" id="registered" class="form-control" placeholder="Ingrese fecha" required>
                                    </div>  
                              
                              
                                    <div class="form-group col-sm-3 col-xs-12">
                                          <label>Tasa tributaria</label>
                                          <select class="form-control" name="idtvehiculo" id="idtvehiculo" placeholder="Seleccione Tipo" required></select>
                                    </div>	
                              					   
                              </div>
                         
                              <div class="card-footer">
                                    
                                    <input type="hidden" name="registrar" id="" class="form-control" > 
                                    <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                                    <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                              </div>
                        </div>
			</form>

                 



            </div>
            
            <div class="modal fade" name="formulario2" id="formulario2">
                                          <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                      <div class="modal-header" style="background-color: #17a2b8;color: white">
                                                            <h4 class="modal-title">Declaración de Vehículo</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <div class="col-sm-12">
                                                                  <h6 class="modal-title">Datos Contribuyentes</h6>
                                                                        <div class="row">
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>Nombre</label>
                                                                                          <input type="hidden" name="idvehiculo" id="idvehiculo" class="form-control" required>
                                                                                          <input type="hidden" name="idt" id="idt" class="form-control" required>
                                                                                          <input type="hidden" name="idusuario" id="idusuario" class="form-control">
                                                                                          <input type="hidden" name="rfc2" id="rfc2" class="form-control" required>
                                                                                          <input type="text" name="nombreusuario" id="nombreusuario" class="form-control" readonly="readonly">  
                                                                              </div>
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>RIF</label>
                                                                                          <input type="text" name="rif2" id="rif2" class="form-control" readonly="readonly">  
                                                                              </div>
                                                                              <div class="col-4 col-sm-4">
                                                                                    <label>RFC</label>
                                                                                          <input type="text" name="rfc5" id="rfc5" class="form-control" readonly="readonly">  
                                                                              </div>
                                                                        </div>
                                                            </div>      
                                                            <hr>
                                                            <div class="col-sm-12">
                                           <h6 class="modal-title">Datos Vehículo</h6>
                                <div class="row">

                                 <div class="form-group col-sm-4 col-xs-12">
                                          <label>Placa</label>
                                                <input type="hidden" name="id" id="id" class="form-control">
                                                <input type="text" name="placa" id="placa" maxlength="10" size="20" class="form-control" placeholder="Ingrese Placa" onblur="consultarplaca2(this.value);" required readonly="readonly">
                                    </div>




                                  <div class="form-group col-sm-4 col-xs-12">
                                                 <label>Marca</label>
                                           <select class="form-control" name="marca2" id="marca2" placeholder="Seleccione Marca" required disabled>
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
                                                   
                                                   </select>
                                                   
                                                   
                                                  </div>
                                                                             

                                                             <div class="form-group col-sm-4 col-xs-12">
                                                                  <label>Modelo</label>
                                                                        <input type="text" name="modelos2" id="modelos2" class="form-control" placeholder="Ingrese Modelo" required readonly="readonly">
                                                            </div>
                                                            <div class="form-group col-sm-4 col-xs-12">
                                                                  <label>Año</label>
                                                                  
                                                                   <select class="form-control select2" name="anio2" id="anio2" placeholder="Seleccione Año" required disabled>
                                                               <option value="">Seleccione Año</option>
                                                                 <?php    
                                                                   $hoy = date("Y");
                                                                   for ($i=$hoy;$i>=$hoy-90;$i--){
                                                                    echo '<option value="'.$i.'" >'.$i.'</option>';
                                                                   }
                                                                 ?>
                                                               </select>
                                                            </div> 




                                                                        </div>
                               <div class="row">
                                   
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Fecha de Compra</label>
                                                <input type="date" name="fechacompra2" id="fechacompra2" class="form-control" placeholder="Ingrese Fecha de Compra" required readonly="readonly">
                                    </div>  
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Puestos</label>
                                                <input type="number" name="puestos2" id="puestos2" class="form-control" placeholder="Ingrese Numero de Puestos" required readonly="readonly">
                                    </div>
                                    <div class="form-group col-sm-4 col-xs-12">
                                          <label>Peso</label>
                                                <input type="number" name="pesos2" id="pesos2" class="form-control" placeholder="Ingrese Peso" required readonly="readonly">
                                    </div>  
                                    <div class="form-group col-sm-4 col-xs-12">
                                          
                                    </div>  
                              </div>
                                                                        <div class="row">
                                                                              <div class="form-group col-sm-12 col-xs-12">
                                                                                    <label>Tipo de Categoría</label>
                                                                                    <input type="text" name="detalle" id="detalle" class="form-control" placeholder="Ingrese categoría" required readonly="readonly">
                                                                              </div>
                                                                        </div>
                                                                  
                                                               
                                                                  <button type="submit" onclick="insertartramitemv()" id="btn_declararvehiculo" class="btn btn-info float-right">Declarar</button>
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
        <script type="text/javascript" src="scripts/vehiculosADM.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/vehiculos.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

