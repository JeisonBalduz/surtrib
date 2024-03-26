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
<style>
.content-popup {
    top: 1px;
    width:70%;
    overflow-y: auto;
    height: 98%;
    left: 40%;
    margin-left: -320px;
}
.letra {
    font-size: 12px;
}
</style>
<style type="text/css">
   .Divcontenedor,.cuartopasodetalles {  
display: table;
border-spacing: 5px;
overflow: hidden;
width: 100%;
 /*background: -webkit-linear-gradient(left, #FFFFFF, #f0f0f0);
 background: -moz-linear-gradient(left, #FFFFFF,#f0f0f0);
 border: 1px solid gray;
  redondear esquinas*/
 -moz-border-radius: 5px;
 -webkit-border-radius: 5px;
 border-radius: 5px;
}
.contenedor {  
display: table;
border-spacing: 5px;
overflow: hidden;
width: 95%;
/* background: -webkit-linear-gradient(left, #FFFFFF, #f0f0f0);
 background: -moz-linear-gradient(left, #FFFFFF,#f0f0f0);
 border: 1px solid gray;
  redondear esquinas*/
 -moz-border-radius: 5px;
 -webkit-border-radius: 5px;
 border-radius: 5px;
}
.contenidos { /*background:yellow;*/
display: table-row;
 
}
.primerCol, .unida, .mitadcell {
display: table-cell;
/*border: 1px solid gray;*/
}
.primerCol , .mitadcell, .unida {
  font-size: 12px;

}
.primerCol label,  .unida label , .mitadcell label  {
  font-size: 12px;
  font-weight: normal;
  font-style: normal;
}
.primerCol {
width: 25%;
}
.mitadcell {
width: 50%;
}
.unida{
  width: 100%;
}
.ContentPlaceHolder{ 
                  background:#FFFFFF;
                    } 

</style>
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
				            <label>Busqueda de Inmueble</label>
                                     <input type="text" name="comodinbusqueda" id="comodinbusqueda" class="form-control" placeholder="Ficha Catastral o Ingrese RFU" required> 
						            </div> 
						   <div class="form-group col-md-12 col-sm-12 col-xs-1">
						   <button type="submit" onclick="listar2()" class="btn btn-info">Mostrar</button>
				              <a href="http://localhost/surtri2/vistas/contribuy
                                      entehacienda.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
				              
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
                                                  <th>Area_M</th>
                                                  <th>Precio</th>
                                                  <th>Año_Avaluo</th>
                                                  <th>CT_Estatus</th><th>Clasificación</th><th>CT_Dim_Fre</th><th>CT_Dim_Fon</th><th>CT_Dim_Are</th><th>Precio</th><th>Alicuota</th>
                                                 
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
                                                  <th>Area_M</th>
                                                  <th>Precio</th>
                                                  <th>Año_Avaluo</th>
                                                  <th>CT_Estatus</th><th>Clasificación</th><th>CT_Dim_Fre</th><th>CT_Dim_Fon</th><th>CT_Dim_Are</th><th>Precio</th><th>Alicuota</th>
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        



          <div class="card card-info" id="formularioregistros">
		  
		  <!-- Titulos Formulario-->
                 <div class="card-header">
                     <h3 class="card-title">Formulario de Registro o Modificacion</h3>
                  </div>
          <!-- Fin Titulos Formulario-->
		  
		  <!-- Comienzo Formulario-->
                 <form role="form" name="formulario" id="formulario" method="POST">
                    <div class="card-body"> 
                      
                  <input name="Id_Inm" id="Id_Inm" type="hidden" />
               <div id="cuartopasodetalles" class="cuartopasodetalles">
                      <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"><strong>Inscripción Catastral:</strong></div>
                      
                      <div class="primerCol"><strong>Tipo Documento:</strong></div>
                      
                      <div class="primerCol"><strong>Documento N°:</strong></div>
                      <div class="primerCol"><strong>Folio:</strong></div>
                        </div>
                      </div>

                      <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"><input type="text"  data-name="Ficha" id="Ficha_Catastral" name="Ficha_Catastral" text-transform="uppercase" />
                        </div>
                      
                      <div class="primerCol" ><select data-options=".Tipo_Documento" id="Tipo_Documento" name="Tipo_Documento" data-name="T_Documento" breakpoint="true">
                          <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT Id_Val,Etiqueta FROM `inmtipodocumento` WHERE Visible=1";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->Id_Val.'" text="'.$reg->Etiqueta.'">'.$reg->Etiqueta.'</option>';
                                     }
                        
                                 ?> 
                      </select></div>
                      
                      <div class="primerCol" ><input type="numeral"  data-name="N_Documento" id="N_Documento" name="N_Documento" breakpoint="true" /></div>
                      <div class="primerCol" ><input ignore="ignore" type="text"  data-name="Folio" id="Folio" name="Folio" text-transform="uppercase" breakpoint="true" /></div>
                        </div>
                      </div>

                      <div class="contenedor">
                       <div class="contenidos"> 
                          <div class="primerCol"><strong>Tomo:</strong></div>
                          <div class="primerCol" ><strong>Protocolo:</strong></div>
                          <div class="primerCol" ><strong>Fecha:</strong></div>
                          <div class="primerCol" ></div>
                        </div>
                      </div>
                      
                      <div class="contenedor">
                       <div class="contenidos"> 
                          <div class="primerCol"><input ignore="ignore" type="text"  data-name="Tomo" id="Tomo" name="Tomo" text-transform="uppercase" breakpoint="true" /></div>
                          <div class="primerCol" ><input ignore="ignore" type="numeral" id="Protocolo" name="Protocolo" data-name="Protocolo" breakpoint="true" /></div>
                          <div class="primerCol" ><input type="text" data-name="D_Fecha" name="D_Fecha" id="D_Fecha" breakpoint="true" value="11 / 12/ 2023"  /></div>
                          <div class="primerCol" ></div>
                        </div>
                      </div>

                     <div class="contenedor">
                       <div class="contenidos"> 
                          <div class="primerCol"><strong>Área del terreno (m<sup>2</sup>):</strong></div>
                          <div class="primerCol" ><strong>Precio:</strong></div>
                          <div class="primerCol" ></div>
                          <div class="primerCol" ></div>
                        </div>
                      </div>

                      <div class="contenedor">
                       <div class="contenidos"> 
                          <div class="primerCol"><input  text="text" onkeypress="return NumCheck(event, this)" data-name="Area_M" id="Area_M" name="Area_M" data-name="Area_M" breakpoint="true" /></div>
                          <div class="primerCol" ><input type="text" onkeypress="return NumCheck(event, this)" data-name="Precio" id="Precio" name="Precio" breakpoint="true" /></div>
                          <div class="primerCol" ></div>
                          <div class="primerCol" ></div>
                        </div>
                      </div>
                      </br>
                      <div class="contenedor">
                      <div class="contenidos"> 
                        <div class="row">  
                             <div class="form-group col-sm-3 col-xs-12">
                                      <strong >Año avaluo:</strong>
                                        

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
                        </div>
                      </div>

                      <div class="row">
                             <div class="form-group col-sm-3 col-xs-12">
                                   <label>Dirección: </label>
                                        
                             </div>
                        </div>

                     <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" style="text-align:left;"> 
                        <select style="width: auto; border-right: 0;" data-options=".Direccion_E1" id="Direccion_E1" name="Direccion_E1" data-name="Direccion_E1" placeholder="false" breakpoint="true">
                                        <option value="114" text="CALLE">CALLE</option>
                                        <option value="115" text="AVENIDA">AVENIDA</option>
                                        <option value="116" text="VEREDA">VEREDA</option>
                                        <option value="117" text="CARRETERA">CARRETERA</option>
                                        <option value="118" text="ESQUINA">ESQUINA</option>
                                        <option value="119" text="CARRERA">CARRERA</option>
                                        <option value="206" text="MANZANA">MANZANA</option>
                                       </select>
                                       <input type="text"  data-name="Direccion_D1" id="Direccion_D1" name="Direccion_D1" text-transform="uppercase" breakpoint="true"></div>
                      <div class="mitadcell"  style="padding-left: 50px;">
                        <select style="width: auto; border-right: 0;" data-options=".Direccion_E2" id="Direccion_E2" name="Direccion_E2" data-name="Direccion_E2" placeholder="false" onchange="" breakpoint="true">
                                <option value="120" text="EDIFICIO">EDIFICIO</option>
                                <option value="121" text="CC">CC</option>
                                <option value="122" text="QUINTA">QUINTA</option>
                                <option value="123" text="CASA">CASA</option>
                                <option value="124" text="LOCAL">LOCAL</option>
                             </select>
<input ignore="ignore" type="text"  text-transform="uppercase" data-name="Direccion_D2" id="Direccion_D2" name="Direccion_D2" breakpoint="true" />  
                     <input type="text"  value="PISO: " data-min="6" data-name="Direccion_Ext_D2" onclick="" onkeydown="" breakpoint="true" />


                      </div>
                        </div>
                      </div>


                    <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" style="text-align:left;">
                           <select style="width: auto; border-right: 0;" data-options=".Direccion_E3" id="Direccion_E3" name="Direccion_E3" data-name="Direccion_E3" placeholder="false" breakpoint="true">
                                 <option value="125" text="APARTAMENTO"  >APARTAMENTO</option><option value="126" text="LOCAL" selected="selected">LOCAL</option>
                                 <option value="127" text="OFICINA">OFICINA</option>
                                 </select>
                                 <input type="text"  data-name="Direccion_D3" id="Direccion_D3" name="Direccion_D3" text-transform="uppercase" breakpoint="true"/>
                       </div>
                      <div class="mitadcell" style="padding-left: 50px;">
                           <select style="width: auto; border-right: 0;" data-options=".Direccion_E4" id="Direccion_E4" name="Direccion_E4" data-name="Direccion_E4" placeholder="false" breakpoint="true">
                                <option value="128" text="URBANIZACION">URBANIZACION</option>
                                <option value="129" text="ZONA">ZONA</option>
                                <option value="130" text="SECTOR">SECTOR</option>
                                <option value="131" text="CONJUNTO RESIDENCIAL">CONJUNTO RESIDENCIAL</option>
                                <option value="132" text="BARRIO">BARRIO</option>
                                <option value="133" text="CASERIO">CASERIO</option>
                                </select>
                                <input type="text"  data-name="Direccion_D4" text-transform="uppercase" breakpoint="true" />
                      </div>
                        </div>
                      </div>

                     <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" style="text-align:left;">
                           <label>Estado:</label>
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
                      <div class="mitadcell" style="padding-left: 50px;">
                          <label>Municipio:</label>
                                 <select data-options=".Municipio{?}" data-name="Id_Municipio" name="Id_Municipio" id="Id_Municipio" disabled="disabled" noscan="noscan" onchange="gerParroquia(this.value,'');" breakpoint="true">
                                     
                                 </select>
                      </div>
                        </div>
                      </div>
                     
                     <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" style="text-align:left;">
                           <label>Parroquia:</label>
                                 <select data-options=".Parroquia{?}" data-name="Id_Parroquia" id="Id_Parroquia" name="Id_Parroquia" disabled="disabled" noscan="noscan" breakpoint="true">
                                     
                                 </select>
                       </div>
                      <div class="mitadcell" id="totalrecargo" style="padding-left: 50px;">
                           <label>Ciudad:</label>
                                 <select data-options=".Ciudad{?}" data-name="Ciudad" id="Ciudad" name="Ciudad" disabled="disabled" noscan="noscan" breakpoint="true"></select>
                      </div>
                        </div>
                      </div>
                      <div class="row">
                            <div class="form-group col-sm-6 col-xs-12">
                                <label id="lkf">Domicilio fiscal:</label>
                         <input type="text"  data-name="Referencia" id="Referencia" name="Referencia" ignore="ignore"  breakpoint="true"/>
                              </div>
                             
                      </div>

                       <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
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
                      <!--
                      
                      <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      
                      <div class="primerCol" id="intereses1"></div>
                      
                      <div class="primerCol" id="intereses2"></div>
                      <div class="primerCol" id="intereses3"></div>
                        </div>
                      </div>
                                 
                      <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" style="text-align:right;"></div>
                      <div class="mitadcell" id="totalrecargo" ></div>
                        </div>
                      </div>

                        -->

                     </div>

		   
			            
                      

                    
                     <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            <label id="lkf">CARACTERISTICAS DEL TERRENO</label>
                         </div>

                      </div>
                      <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
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
                         <div class="form-group col-sm-6 col-xs-12">
                            <label id="lkf">Forma:</label>
                            <select data-options=".Forma" data-name="CT_Form" id="CT_Form" name="CT_Form" breakpoint="true">
                                <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                                <option value="7" text="REGULAR">REGULAR</option>
                                <option value="8" text="IRREGULAR">IRREGULAR</option>
                                <option value="9" text="MUY IRREGULAR">MUY IRREGULAR</option>
                            </select>
                         </div>
                       <!--
                         <div class="form-group col-sm-6 col-xs-12">
                            <label id="lkf">Servicios:</label>
                            <select data-options=".Servicios" id="Servicios" name="Servicios" selection="multiple" multiple="multiple" data-name="CT_Serv"> 
                                <option value="10">ACUEDUCTO</option>
                                <option value="11">CLOACAS</option>
                                <option value="12">ELECTRICIDAD</option>
                                <option value="13">PAVIMENTO</option>
                                <option value="14">ACERA</option>
                                <option value="15">TELEFONO</option>
                                <option value="16">GAS</option>
                                <option value="17">TRANSPORTE</option>
                                <option value="152">NINGUNO</option>

                            </select>
                         </div>   --->


                      </div>
                      

                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
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
                         <div class="form-group col-sm-6 col-xs-12">
                            <label>Uso: </label>
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
                         <div class="form-group col-sm-6 col-xs-12">
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


                   <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>Clasificacion: </label>
                       <select data-options=".Clasificacion1" data-name="CT_Clas" id="CT_Clas" name="CT_Clas" breakpoint="true">
                                <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `referencia`,CONCAT(`Descripcion`,' ', `Tipo`) AS DESCRI FROM `inmConstclasificacion` WHERE Anio=DATE_FORMAT(CURDATE(),'%Y')";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->referencia.'" text="'.$reg->DESCRI.'">'.$reg->DESCRI.'</option>';
                                     }
                        
                                 ?>   

                            </select>


                       </div>
                      <div class="mitadcell"  ></div>
                        </div>
                      </div>




                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                             
                            
                        </div>

                      </div>

                     <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                             <label>DIMENSIONES TERRENO (m<sup>2</sup>): </label>
                        </div>

                      </div>
                     

                    <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            <label >Frente: </label><input  type="text" onkeypress="return NumCheck(event, this)" data-name="CT_Dim_Fre" id="CT_Dim_Fre" name="CT_Dim_Fre" breakpoint="true" />
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label >Fondo: </label><input  type="text" onkeypress="return NumCheck(event, this)" data-name="CT_Dim_Fon" id="CT_Dim_Fon" name="CT_Dim_Fon" breakpoint="true" />
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                           <label >Área: </label><input type="text" data-name="CT_Dim_Are" id="CT_Dim_Are" name="CT_Dim_Are" breakpoint="true" readonly="readonly"  />
                        </div>

                    </div>
                     <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Características de la construcción (sí el terreno posee más de una edificación debe agregarlas todas)</label>
                        </div>
                       
                    </div>
                     
                   <div class="row">
                    <div class="card-body" >
                                 
                         <div class="card-body">
                                 <table id="tbconstruccion" class="table table-bordered table-hover">
                                    <thead>
                                          <tr> <th>Opciones</th>
                                                <th>Uso</th>
                                                 <th>Tipo</th>
                                                  <th>Ocupación</th>                                   
                                                 <th>Clasificación</th>
                                                 <th>Alicuota</th>
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
                                                 <th>Alicuota</th>
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

                       </div>
                     
                     <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                             <label>Alicuota: </label>
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
					       <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
                                     <button type="button"onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
                                    
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

