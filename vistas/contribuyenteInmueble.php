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
    require "../config/Conexion.php";
?>
    <!-- Inicio Contenido PHP-->








<section class="content">
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
		
		
          <div class="card" id="listadoregistros">
                     <div class="card-header">
                            <h3 class="card-title">Inmueble <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)" disabled="disabled"><i class="fa fa-plus-circle"></i> Nuevo</button> </h3>
                       </div>
            <!-- /.card-header -->
			           <div class="card-header">
			              <div class="row">
                   <div class="form-group col-md-4 col-sm-6 col-xs-1">
				            <label>Búsqueda de Inmueble</label>
                                     <input type="text" name="comodinbusqueda" id="comodinbusqueda" class="form-control" placeholder="Ingrese Ficha Catastral o RUC" required> 
						            </div> 
						   <div class="form-group col-md-12 col-sm-12 col-xs-1">
						   <button type="submit" onclick="listar2()" class="btn btn-info">Mostrar</button>
				              <a href="contribuyenteInmueble.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
				              
                                     </div>
				         </div>
					     </div>
                                  
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr> <th>Opciones</th>
                                                <th>RIF_CI</th>
                                                 <th>INSCRIPCIÓN CATASTRAL</th>
                                                  <th>TÍTULO</th>                                   
                                                  <th>AÑO DE AVALUO</th>
                                                  <th>USO</th>
                                                  <th>TENENCIA</th>
                                                 <th>ÁREA (MTS2)</th>
                                                  <th>ÚLTIMO PAGO</th>
                                                  <th></th>
                                                  <th>Folio</th>
                                                  <th>Tomo</th>
                                                  <th>Protocolo</th>
                                                  <th>D_Fecha</th>
                                                  <th>Área_M</th>
                                                  <th>Precio</th>
                                                  <th>Año_Avaluo</th>
                                                  <th>CT_Estatus</th><th>Clasificación</th><th>CT_Dim_Fre</th><th>CT_Dim_Fon</th><th>CT_Dim_Are</th><th>Precio</th><th>Alícuota</th>
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                     <th>Opciones</th>
                                                <th>RIF_CI</th>
                                                 <th>INSCRIPCIÓN CATASTRAL</th>
                                                  <th>TÍTULO</th>                                   
                                                  <th>AÑO DE AVALUO</th>
                                                  <th>USO</th>
                                                  <th>TENENCIA</th>
                                                 <th>ÁREA (MTS2)</th>
                                                  <th>ÚLTIMO PAGO</th>
                                                  <th></th>
                                                  <th>Folio</th>
                                                  <th>Tomo</th>
                                                  <th>Protocolo</th>
                                                  <th>D_Fecha</th>
                                                  <th>Área_M</th>
                                                  <th>Precio</th>
                                                  <th>Año_Avaluo</th>
                                                  <th>CT_Estatus</th><th>Clasificación</th><th>CT_Dim_Fre</th><th>CT_Dim_Fon</th><th>CT_Dim_Are</th><th>Precio</th><th>Alícuota</th>
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        



          <div class="card card-info" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro o Modificación</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
        <form role="form" name="formulario" id="formulario" method="POST">
            <input name="Id_Inm" id="Id_Inm" type="hidden" value="" />
                 <div class="card-body"> 
                    <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                          <label>Inscripción Catastral:</label>
                             <input type="text"  data-name="Ficha" id="Ficha_Catastral" name="Ficha_Catastral" text-transform="uppercase" readonly="readonly"/>
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                                          <label>Tipo Documento:</label>
                                          <select data-options=".Tipo_Documento" id="Tipo_Documento" name="Tipo_Documento" data-name="T_Documento" breakpoint="true">
                          <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT Id_Val,Etiqueta FROM `inmtipodocumento` WHERE Visible=1";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->Id_Val.'" text="'.$reg->Etiqueta.'">'.$reg->Etiqueta.'</option>';
                                     }
                        
                                 ?> 
                      </select>
                                    </div>   
                              <div class="form-group col-sm-3 col-xs-12">
                                          <label>Documento N°:</label>
                                                <input type="numeral"  data-name="N_Documento" id="N_Documento" name="N_Documento" breakpoint="true" />
                                    </div> 
                                 <div class="form-group col-sm-3 col-xs-12">
                                         <label>Folio:</label><br/>
                                               <input  type="text"  data-name="Folio" id="Folio" name="Folio"  breakpoint="true" />
                                    </div>   

                    </div>
                    <div class="row">
                          <div class="form-group col-sm-3 col-xs-12">
                                          <label>Tomo:</label><br/>
                                                <input ignore="ignore" type="text"  data-name="Tomo" id="Tomo" name="Tomo" text-transform="uppercase" breakpoint="true" />
                                    </div> 
                                 <div class="form-group col-sm-3 col-xs-12">
                                         <label>Protocolo:</label><br/>
                                               <input ignore="ignore" type="numeral" id="Protocolo" name="Protocolo" data-name="Protocolo" breakpoint="true" />
                                    </div> 
                                <div class="form-group col-sm-3 col-xs-12">
                                         <label>Fecha:</label><br/>
                                               <input type="text" data-name="D_Fecha" name="D_Fecha" id="D_Fecha" breakpoint="true" value=""  />
                                    </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                          <label>Área del terreno (m<sup>2</sup>):</label><br/>
                                                <input  text="text" onkeypress="return NumCheck(event, this)" data-name="Area_M" id="Area_M" name="Area_M" data-name="Area_M" breakpoint="true" />
                                    </div> 
                       <div class="form-group col-sm-3 col-xs-12">
                                          <label>Precio:</label><br/>
                                                <input type="text" onkeypress="return NumCheck(event, this)" data-name="Precio" id="Precio" name="Precio" breakpoint="true" />
                                    </div> 

                    </div>


                    <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                          <label>Año avaluo:</label><br/>
                                              <select  id="Ano_Avaluo" name="Ano_Avaluo" >
                                       <option value="" >Seleccionar</option>
                                         <?php    
                                           $hoy = date("Y");
                                           for ($i=$hoy;$i>=$hoy-30;$i--){
                                            echo '<option value="'.$i.'" >'.$i.'</option>';
                                           }
                                         ?>
                                       </select>
                                    </div> 
                      </div>

                     <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                          <label>Dirección:</label>
                                              
                                    </div> 
                      </div>
                   
                 <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                 <select style="width: auto; border-right: 0;" data-options=".Direccion_E1" id="Direccion_E1" name="Direccion_E1" data-name="Direccion_E1" placeholder="false" breakpoint="true">
                                        <option value="114" text="CALLE">CALLE</option>
                                        <option value="115" text="AVENIDA">AVENIDA</option>
                                        <option value="116" text="VEREDA">VEREDA</option>
                                        <option value="117" text="CARRETERA">CARRETERA</option>
                                        <option value="118" text="ESQUINA">ESQUINA</option>
                                        <option value="119" text="CARRERA">CARRERA</option>
                                        <option value="206" text="MANZANA">MANZANA</option>
                                       </select>        
                                          
                                      </div>
                          <div class="form-group col-sm-3 col-xs-12">
                              <input type="text"  data-name="Direccion_D1" id="Direccion_D1" name="Direccion_D1" text-transform="uppercase" breakpoint="true"/> 
                            </div>
                         <div class="form-group col-sm-3 col-xs-12">
                              <select  data-options=".Direccion_E2" id="Direccion_E2" name="Direccion_E2" data-name="Direccion_E2" placeholder="false" onchange="" breakpoint="true">
                                <option value="120" text="EDIFICIO">EDIFICIO</option>
                                <option value="121" text="CC">CC</option>
                                <option value="122" text="QUINTA">QUINTA</option>
                                <option value="123" text="CASA">CASA</option>
                                <option value="124" text="LOCAL">LOCAL</option>
                             </select><input ignore="ignore" type="text"  text-transform="uppercase" data-name="Direccion_D2" id="Direccion_D2" name="Direccion_D2" breakpoint="true" />
                            </div>
                                     
                      
                            <div class="form-group col-sm-3 col-xs-12">
                            <input type="text"  value="PISO: " data-min="6" data-name="Direccion_Ext_D2" onclick="" onkeydown="" breakpoint="true" />
                               </div>

                   </div>

                    <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                <select style="width: auto; border-right: 0;" data-options=".Direccion_E3" id="Direccion_E3" name="Direccion_E3" data-name="Direccion_E3" placeholder="false" breakpoint="true">
                                 <option value="125" text="APARTAMENTO"  >APARTAMENTO</option><option value="126" text="LOCAL" selected="selected">LOCAL</option>
                                 <option value="127" text="OFICINA">OFICINA</option>
                                 </select>
                                              
                                    </div>
                         <div class="form-group col-sm-3 col-xs-12">
                                 <input type="text"  data-name="Direccion_D3" id="Direccion_D3" name="Direccion_D3" text-transform="uppercase" breakpoint="true"/>
                                              
                                    </div>
                          <div class="form-group col-sm-3 col-xs-12">
                                 <select style="width: auto; border-right: 0;" data-options=".Direccion_E4" id="Direccion_E4" name="Direccion_E4" data-name="Direccion_E4" placeholder="false" breakpoint="true">
                                <option value="128" text="URBANIZACION">URBANIZACIÓN</option>
                                <option value="129" text="ZONA">ZONA</option>
                                <option value="130" text="SECTOR">SECTOR</option>
                                <option value="131" text="CONJUNTO RESIDENCIAL">CONJUNTO RESIDENCIAL</option>
                                <option value="132" text="BARRIO">BARRIO</option>
                                <option value="133" text="CASERIO">CASERIO</option>
                                </select>
                                              
                                    </div>
                            <div class="form-group col-sm-3 col-xs-12">
                                  <input type="text"  data-name="Direccion_D4" text-transform="uppercase" breakpoint="true" />
                                              
                                    </div>

                      </div>

                      <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                                          <label>Estado:</label><br/>
                                   <select data-options=".Estado" data-name="Estado" id="Id_Estado" name="Id_Estado" onchange="gerMunicipio(this.value);" breakpoint="true">
                                    <option value="-1" >Despliegue para Seleccionar</option>
                                   <?php $sql='SELECT * FROM inmestados;';

                                      $result=ejecutarConsulta($sql);
                                     while ($reg=$result->fetch_object()){
                                        echo '<option value="'.$reg->Id_Estado.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
                                     }
                        
                                 ?>  
                                 </select>           
                          </div> 
                          <div class="form-group col-sm-3 col-xs-12">
                                <label>Municipio:</label>
                                 <select data-options=".Municipio{?}" data-name="Id_Municipio" name="Id_Municipio" id="Id_Municipio" disabled="disabled" noscan="noscan" onchange="gerParroquia(this.value,'');" breakpoint="true">
                                     
                                 </select>   
                                              
                                    </div>
                            <div class="form-group col-sm-3 col-xs-12">
                               <label>Parroquia:</label>
                                      <select data-options=".Parroquia{?}" data-name="Id_Parroquia" id="Id_Parroquia" name="Id_Parroquia" disabled="disabled" noscan="noscan" breakpoint="true">
                                     
                                 </select>        
                                    </div> 
                      </div>

                      <div class="row">
                        
                        <div class="form-group col-sm-3 col-xs-12">
                               <label>Ciudad:</label><br/>
                                 <select data-options=".Ciudad{?}" data-name="Ciudad" id="Ciudad" name="Ciudad" disabled="disabled" noscan="noscan" breakpoint="true"></select>        
                                    </div>
                      </div>
                      <div class="row">
                         <div class="form-group col-sm-3 col-xs-12">
                               <label>Domicilio fiscal:</label>
                                     <input type="text"  data-name="Referencia" id="Referencia" name="Referencia" ignore="ignore"  breakpoint="true"/>        
                                    </div>  

                      </div>

                    <div class="row">
                        

                            <div class="form-group col-sm-3 col-xs-12">
                            <label id="lkf">Comunidad: </label>
                            <select data-options=".Comunidades" data-name="Comunidad" id="Comunidad" name="Comunidad" style="width: 90%;">
                               <option value="-1" >Despliegue para Seleccionar</option> 
                               <?php $sql='SELECT * FROM inmcomunidad;';

                                      $result=ejecutarConsulta($sql);
                                     while ($reg=$result->fetch_object()){
                                        echo '<option value="'.$reg->Id_Zon_Com.'" text="'.$reg->Comunidad.'">'.$reg->Comunidad.'</option>';
                                     }
                        
                                 ?> 
                            </select>
                        </div>
                        
                      </div>

                  <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label id="lkf">CARACTERISTICAS DEL TERRENO</label>
                         </div>

                      </div>

                   <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label id="lkf">Topografía:</label>
                            <select data-options=".Topografia" data-name="CT_Top" id="CT_Top" name="CT_Top" breakpoint="true">
                                <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                                <option value="1" text="PLANO">PLANO</option>
                                <option value="2" text="SOBRE NIVEL">SOBRE NIVEL</option>
                                <option value="3" text="BAJO NIVEL">BAJO NIVEL</option>
                                <option value="4" text="RELLENO">RELLENO</option>
                                <option value="5" text="CORTE">CORTE</option>
                                <option value="6" text="INCLINADO">INCLINADO</option>
                            </select>
                         </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label id="lkf">Forma:</label><br/>
                            <select data-options=".Forma" data-name="CT_Form" id="CT_Form" name="CT_Form" breakpoint="true">
                                <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                                <option value="7" text="REGULAR">REGULAR</option>
                                <option value="8" text="IRREGULAR">IRREGULAR</option>
                                <option value="9" text="MUY IRREGULAR">MUY IRREGULAR</option>
                            </select>
                         </div>

                      </div>

                       <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                           <label>Tenencia: </label>
                            <select data-options=".Tenencia" data-name="CT_Tene" id="CT_Tene" name="CT_Tene" breakpoint="true">
                                 <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `Id_Val`,Etiqueta FROM `inmcaractenencia` WHERE   Visible=1;";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->Id_Val.'" text="'.$reg->Etiqueta.'">'.$reg->Etiqueta.'</option>';
                                     }
                        
                                 ?> 

                            </select> 
                         </div>
                         <div class="form-group col-sm-3 col-xs-12">
                            <label>Uso: </label><br/>
                            <select data-options=".Uso" data-name="CT_Uso" id="CT_Uso" name="CT_Uso" breakpoint="true">
                                <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `Id_Val`,Etiqueta FROM `inmcaracuso` WHERE   Visible=1;";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->Id_Val.'" text="'.$reg->Etiqueta.'">'.$reg->Etiqueta.'</option>';
                                     }
                        
                                 ?>
                            </select>
                         </div>
                       


                      </div>

                    <div class="row">
                        
                         <div class="form-group col-sm-3 col-xs-12">
                           <label>Estatus: </label>
                            <select data-options=".Uso_Terreno" data-name="CT_Est" id="CT_Estatus" name="CT_Estatus" breakpoint="true">
                                 <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `Id_Val`,Etiqueta FROM `inmestatus` WHERE   Visible=1;";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->Id_Val.'" text="'.$reg->Etiqueta.'">'.$reg->Etiqueta.'</option>';
                                     }
                        
                                 ?>
                            </select>
                         </div>

                      </div>

                    <div class="row">
                        
                         <div class="form-group col-sm-3 col-xs-12">
                           <label>Clasificación: </label>
                       <select data-options=".Clasificacion1" data-name="CT_Clas" id="CT_Clas" name="CT_Clas" breakpoint="true">
                                <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `referencia`,CONCAT(`Descripcion`,' ', `Tipo`) AS DESCRI FROM `inmclasificacion` WHERE Anio=DATE_FORMAT(CURDATE(),'%Y')";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->referencia.'" text="'.$reg->DESCRI.'">'.$reg->DESCRI.'</option>';
                                     }
                        
                                 ?>   

                            </select>
                         </div>

                      </div>

                  <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                             <label>DIMENSIONES TERRENO (m<sup>2</sup>): </label>
                        </div>

                      </div>
                 

                 <div class="row">
                        <div class="form-group col-sm-3 col-xs-12">
                            <label >Frente: </label><input  type="text" onkeypress="return NumCheck(event, this)" data-name="CT_Dim_Fre" id="CT_Dim_Fre" name="CT_Dim_Fre" breakpoint="true" />
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                            <label >Fondo: </label><input  type="text" onkeypress="return NumCheck(event, this)" data-name="CT_Dim_Fon" id="CT_Dim_Fon" name="CT_Dim_Fon" breakpoint="true" />
                        </div>
                        <div class="form-group col-sm-3 col-xs-12">
                           <label >Área: </label><input type="text" data-name="CT_Dim_Are" id="CT_Dim_Are" name="CT_Dim_Are" breakpoint="true" readonly="readonly"  />
                        </div>

                    </div>

                   <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Características de la construcción (sí el terreno posee más de una edificación debe agregarlas todas)</label>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                           </h3><button type="button" class="btn btn-info" id="btnnuevaconstruccion" onclick="getnuevaconstruccion();" ><i class="fa fa-plus-circle"></i> Nueva</button>
                        </div>
                       
                    </div>
                   <div class="row">
                        <div class="card-body">
                                 <table id="tbconstruccion" class="table table-bordered table-hover">
                                    <thead>
                                          <tr> <th>Opciones</th>
                                                <th>Uso</th>
                                                 <th>Tipo</th>
                                                  <th>Ocupación</th>                                   
                                                 <th>Clasificación</th>
                                                 <th>Alícuota</th>
                                                  <!--
                                                  <th>Estructura</th>
                                                  <th>Piso</th>
                                                  <th>Puertas</th>
                                                 <th>Tipo</th>
                                                  <th>Acabado</th>
                                                  <th>Estructura</th>
                                                  <th>Cubiertas</th>
                                                  <th>Eléctricas</th>
                                                  <th>Ambientes</th>
                                                  <th>Estado de conservación</th>
                                                  <th>N° de habitaciones</th>
                                                  <th>N° de plantas</th>
                                                  
                                                  <th>Frente</th>
                                                  <th>Fondo</th><th>Área</th> -->
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr>
                                      
                                     <th>Opciones</th>
                                                <th>Uso</th>
                                                 <th>Tipo</th>
                                                  <th>Ocupación</th>                                   
                                                 <th>Clasificación</th>
                                                 <th>Alícuota</th>
                                                  <!--
                                                  <th>Estructura</th>
                                                  <th>Piso</th>
                                                  <th>Puertas</th>
                                                 <th>Tipo</th>
                                                  <th>Acabado</th>
                                                  <th>Estructura</th>
                                                  <th>Cubiertas</th>
                                                  <th>Eléctricas</th>
                                                  <th>Ambientes</th>
                                                  <th>Estado de conservación</th>
                                                  <th>N° de habitaciones</th>
                                                  <th>N° de plantas</th>
                                                  
                                                  <th>Frente</th>
                                                  <th>Fondo</th><th>Área</th> -->
                                            
                                      </tfoot>
                                  </table>
                             </div> 
                    </div>

                     <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                             <label>Alícuota: </label>
                            <select data-options=".Alicuota" data-name="CT_Alic" id="CT_Alic" name="CT_Alic" breakpoint="true">
                                <option value="-1" >Despliegue para Seleccionar</option>
                                <?php $sql="SELECT * FROM inmalicuota WHERE Anio=DATE_FORMAT(CURDATE(),'%Y');";

                                      $result=ejecutarConsulta($sql);
                                     while ($reg=$result->fetch_object()){
                                        echo '<option value="'.$reg->referencia.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
                                     }
                        
                                 ?> 
                            </select>
                        </div>
                       
                    </div>

                 </div>

               
		   <!-- Fin Formulario-->
		   
           <!--  Pie Formulario-->
                    <div class="card-footer">
					       <button type="button" id="btnGuardar" onclick="guardaryeditar();"  class="btn btn-info">Guardar</button>
                                     <button type="button" onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                                    
                    </div>
				
              </form>
                   </div>
			
	</div>
        <!-- /.col -->
      </div>
 </div>
</section>
	
	
	
<!-- The Modal -->
<style type="text/css">
      label div{
            font-weight: normal;
      }
</style>
<div class="modal" id="myModal" style="overflow-y:scroll;height:90%;">
  <div class="modal-dialog">
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Datos de la construcción</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
         <div class="form-group">

          <!--<input type="text" id="username" placeholder="User Name" class="form-control"/>-->
          <!-- <div id="confirmdetails">Confirmation details go here...</div>-->
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
	

<div id="popup" style="display: none;">

    <div class="content-popup">

        <div class="close" ><a href="#" id="close">X</a></div>
        
        <div id="contenidoPopup">
        </div>

                                    
                    </div>
    </div>
    
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
        <script type="text/javascript" src="scripts/contriinmueble.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

