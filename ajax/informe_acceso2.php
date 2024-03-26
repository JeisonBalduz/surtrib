<style>
.content-popup {
    top: 1px;
    width:50%;
    overflow-y: auto;
    height: 98%;

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
<form name="formcostruccion" id="formcostruccion" method="POST">
<div class="panel panel-default" height='100%'>

 <div style="">
    <div class="panel-heading" >
      
        <div class="panel-body"> 
        <strong>DATOS DE LA CONSTRUCCIOM</strong>
        </div>
         
         
    </div>
                      
         
        
         </div> 
       
        <div >
        

<div class="CC_Cons">
    <div data-bl="true"><input type="hidden" name="Id_Inm_Cons" id="Id_Inm_Cons" value="">
      <div class="white-space"></div>
         <div class="Divcontenedor">
                     <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell"> </div>
                      
                      <div class="mitadcell"></div>
                      </div>
                      </div>

                      <div class="contenedor">
                      <div class="contenidos">  
                      <div class="mitadcell" ><label>Uso:</label>
                        <select data-mixed="mixer" data-options=".Uso" data-name="CC_Uso" name="CC_Uso" id="CC_Uso" breakpoint="true">
            <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
            <option value="18" text="RESIDENCIAL">RESIDENCIAL</option>
            <option value="19" text="COMERCIAL">COMERCIAL</option>
            <option value="20" text="INDUSTRIAL">INDUSTRIAL</option>
            <option value="209" text="RECREACIONAL">RECREACIONAL</option>
          </select>
                      </div>
                      <div class="mitadcell" ><label>Tipo:</label>
                        <select data-mixed="mixer" data-options=".Tipo" data-name="CC_Tipo" id="CC_Tipo" name="CC_Tipo" noscan="noscan"  breakpoint="true">
            <option value="-1" >Despliegue para Seleccionar</option>
                                <?php $sql="SELECT * FROM inmconstrutipo WHERE Activo=1;";

                                      $result=ejecutarConsulta($sql);
                                     while ($reg=$result->fetch_object()){
                                        echo '<option value="'.$reg->Id_Inm_Tip.'" text="'.$reg->Descripcion.'">'.$reg->Tipo.'</option>';
                                     }
                        
                                 ?>
          </select>
                      </div>
                        </div>
                      </div>
     </br>
                  
                    <div class="contenedor">
                      <div class="contenidos">  
                      <div class="mitadcell" >
                       <label>Ocupación:</label>
                        <select data-options=".Ocupacion" data-name="CC_Ocup" id="CC_Ocup" name="CC_Ocup" breakpoint="true">
            <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
            <option value="31" text="VIVIENDA PRINCIPAL">VIVIENDA PRINCIPAL</option>
            <option value="32" text="ARRENDADA">ARRENDADA</option>
            <option value="113" text="DESOCUPADA">DESOCUPADA</option>
            <option value="147" text="OCUPADA">OCUPADA</option>
          </select>
                      </div>
                      <div class="mitadcell" ></div>
                        </div>
                      </div>

                      <div class="contenedor">
                       <div class="contenidos"> 
                          <div class="primerCol">
                            
                          </div>
                          <div class="primerCol" >
                            
                          </div>
                          <div class="primerCol" >
                            
                          </div>
                          <div class="primerCol" ></div>
                        </div>
                      </div>

                      <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell"><label>Estructura:</label> 
                        <select data-options=".Estructura" data-name="CC_Estr" id="CC_Estr" name="CC_Estr" multiple>
            <option value="107">CONCRETO</option>
            <option value="108">METALICO</option>
            <option value="109">MADERA</option>
            <option value="110">PREFABRICADO</option>
            <option value="111">PAREDES-CARGA</option>

          </select>
                       </div>
                      
                      <div class="mitadcell"><label>Piso:</label>
                        <select data-options=".Piso" data-name="CC_Piso" id="CC_Piso" name="CC_Piso" breakpoint="true">
            <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
            <option value="74" text="LUJOSO">LUJOSO</option>
            <option value="75" text="BALDOSAS">BALDOSAS</option>
            <option value="76" text="VINIL">VINIL</option>
            <option value="77" text="GRANITO DE PRIMERA">GRANITO DE PRIMERA</option>
            <option value="78" text="GRANITO DE SEGUNDA">GRANITO DE SEGUNDA</option>
            <option value="79" text="MOSAICO">MOSAICO</option>
            <option value="80" text="MADERA">MADERA</option>
            <option value="81" text="CEMENTO PRIMERA">CEMENTO PRIMERA</option>
            <option value="82" text="CEMENTO REGULAR">CEMENTO REGULAR</option>
          </select>
                      </div>
                      </div>
                      </div>
               
              <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"> </div>
                      
                      <div class="primerCol"></div>
                      
                      <div class="primerCol" ></div>
                      <div class="primerCol" id="intereses3"></div>
                        </div>
                      </div>

               <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell"><label>Puertas:</label> 
                         <select data-options=".Puertas"  data-name="CC_Puer" id="CC_Puer" name="CC_Puer" multiple>
            <option value="83">MULTILOCK</option>
            <option value="84">MADERA FINA</option>
            <option value="85">ENTAMB. FINA</option>
            <option value="86">ESTAMB. ECONOMICO</option>
            <option value="87">MADERA RUSTICA</option>
            <option value="88">ESTAMB. METAL</option>
            <option value="89">SANTA MARIA</option>
            <option value="112">PORTON LAMINADO</option>
            <option value="153">METALICA</option>
          </select> 
                       </div>
                      
                      <div class="mitadcell"></div>
                      </div>
                      </div>

           <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
           </div>
            
            <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell"><label>Paredes: </label>
                        </div>
                      
                      <div class="mitadcell">
                        
                      </div>
                      
                      </div>
             </div>

          

          <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ></div>
                      <div class="mitadcell" ></div>
                        </div>
                      </div>
            <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label >Tipo </label><select data-options=".Paredes_Tipo" data-name="CC_Par_Tipo" name="CC_Par_Tipo" id="CC_Par_Tipo" breakpoint="true">
                         <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                         <option value="48" text="BLOQUE">BLOQUE</option>
                         <option value="49" text="LADRILLO">LADRILLO</option>
                         <option value="50" text="PREFABRICADO">PREFABRICADO</option>
                         <option value="51" text="ADOBE-TAPIA">ADOBE-TAPIA</option>
                         <option value="52" text="BAHAREQUE">BAHAREQUE</option>
                         <option value="53" text="TRINCOTE">TRINCOTE</option>
                       </select></div>
                      <div class="mitadcell" ><label >Acabado: </label>
                        <select data-options=".Paredes_Acabado" data-name="CC_Par_Acab" name="CC_Par_Acab" id="CC_Par_Acab" breakpoint="true">
                          <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                          <option value="54" text="LUJOSO">LUJOSO</option>
                          <option value="55" text="FRISO LISO">FRISO LISO</option>
                          <option value="56" text="FRISO RUSTICO">FRISO RUSTICO</option>
                          <option value="57" text="OBRA LIMPIA">OBRA LIMPIA</option>
                          <option value="58" text="SIN FRISO">SIN FRISO</option>

                        </select>
                      </div>
                        </div>
             </div>


             <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>Estructura: </label>
                        <select data-options=".Techo_Estructura" data-name="CC_Tech_Estr" name="CC_Tech_Estr" id="CC_Tech_Estr" breakpoint="true">
                         <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                         <option value="59" text="CONCRETO">CONCRETO</option>
                         <option value="60" text="METALICA">METALICA</option>
                         <option value="61" text="MADERA">MADERA</option>
                         <option value="62" text="VARIAS">VARIAS</option>
                       </select>
                       </div>
                      <div class="mitadcell" ><label>Cubiertas: </label>
                        <select data-options=".Techo_Cubiertas" data-name="CC_Tech_Cubi" id="CC_Tech_Cubi" name="CC_Tech_Cubi" breakpoint="true">
                          <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                          <option value="63" text="CONCRETO">CONCRETO</option>
                          <option value="64" text="MADERA TEJA">MADERA TEJA</option>
                          <option value="65" text="PLATABANDA">PLATABANDA</option>
                          <option value="66" text="ACEROLIT">ACEROLIT</option>
                          <option value="67" text="ASBESTO">ASBESTO</option>
                          <option value="68" text="ALUMINIO">ALUMINIO</option>
                          <option value="69" text="ZINC">ZINC</option>
                          <option value="70" text="CAÑA TEJA">CAÑA TEJA</option>
                          <option value="71" text="PLAFOND">PLAFOND</option>
                          <option value="72" text="RASO LAMINAS">RASO LAMINAS</option>
                          <option value="73" text="RASO ECONOMICO">RASO ECONOMICO</option>
                        </select>

                      </div>
                        </div>
                      </div>
             <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>Eléctricas: </label>
                       <select data-options=".Electricas" data-name="CC_Elec" id="CC_Elec" name="CC_Elec" breakpoint="true">
                         <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                         <option value="90" text="EMBUTIDA">EMBUTIDA</option>
                         <option value="91" text="EXTERNA">EXTERNA</option>
                       </select>
                       </div>
                      <div class="mitadcell" ><label>Ambientes: </label>
                       <select data-options=".Ambientes" selection="multiple" data-name="CC_Amb">
                        <option value="92">SALA</option>
                         <option value="93">COMEDOR</option>
                        <option value="95">COCINA</option>
                        <option value="96">DORMITORIO</option>
                        <option value="97">LAVADERO</option>
                        <option value="98">BAÑO</option>
                        <option value="99">SALA DE ESTAR</option>
                        <option value="100">OFICINA</option>
                        <option value="101">GARAJE</option>
                        <option value="189">CANEY</option>
                        <option value="190">PISCINA</option>
                      </select>
                      </div>
                        </div>
                      </div>
         
         
         
          <div class="contenedor">
                      <div class="contenidos"> 
                      
                      <div class="mitadcell"><label>Estado de conservación: </label>
                        <select data-options=".Estado_Conservacion" data-name="CC_Est_Con" name="CC_Est_Con" id="CC_Est_Con" breakpoint="true">
                        <option value="-1" text="Despliegue para seleccionar...">Despliegue para seleccionar...</option>
                        <option value="102" text="EXCELENTE">EXCELENTE</option>
                        <option value="103" text="BUENA">BUENA</option>
                        <option value="104" text="REGULAR">REGULAR</option>
                        <option value="105" text="MALA">MALA</option>
                      </select>
                      </div>
                      <div class="mitadcell"></div>
                        </div>
         </div>

        <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
         </div>
         <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
         </div>
        
        
         <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                          
                        </div>
          </div>

          <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
           </div>

        <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>Clasificacion:</label>
                           <select data-options=".Clasificacion2" data-name="CC_Clas" id="CC_Clas" name="CT_Clas" breakpoint="true" >
                             
                            <option value="-1" >Despliegue para Seleccionar</option>
                              <?php $sql="SELECT `referencia`,CONCAT(`Descripcion`,' ', `Tipo`) AS DESCRI FROM `inmConstclasificacion` WHERE Anio=DATE_FORMAT(CURDATE(),'%Y')";

                                      $resul=ejecutarConsulta($sql);
                                     while ($reg=$resul->fetch_object()){
                                        echo '<option value="'.$reg->referencia.'" text="'.$reg->DESCRI.'">'.$reg->DESCRI.'</option>';
                                     }
                        
                                 ?> 

                           </select>
                         </div>
                      <div class="mitadcell" ></div>
                     </div>
         </div>

       <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
           </div>
        
        <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>N° de habitaciones:</label> <input type="text" class="solo-numero"  data-name="CC_NH" name="CC_NH" id="CC_NH" breakpoint="true" /></div>
                      <div class="mitadcell" ><label>N° de plantas:</label><input type="text" class="solo-numero" data-name="CC_NP" id="CC_NP" name="CC_NP" breakpoint="true" /></div>
                        </div>
         </div>


         <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      
                      <div class="primerCol"></div>
                      <div class="primerCol"></div>
                        </div>
           </div>
        
        <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" ><label>Dimensiones construcción (m<sup>2</sup>): </label></div>
                      <div class="mitadcell" ></div>
                        </div>
         </div>


       

        
         <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="primerCol"><label>Frente: </label><input data-mixed="mixer" type="text" onkeypress="return NumCheck(event, this)" data-name="CC_Dim_Fre" id="CC_Dim_Fre" name="CC_Dim_Fre" breakpoint="true" /></div>
                      
                      <div class="primerCol"><label>Fondo: </label><input  data-mixed="mixer" type="text" onkeypress="return NumCheck(event, this)" data-name="CC_Dim_Fon" name="CC_Dim_Fon" id="CC_Dim_Fon" breakpoint="true" /></div>
                      
                      <div class="primerCol"><label>Área: </label><input  data-mixed="mixer" type="text" data-name="CC_Dim_Are" id="CC_Dim_Are" name="CC_Dim_Are" breakpoint="true" disabled="disabled" /></div>
                      <div class="primerCol"></div>
                        </div>
           </div> 
        
        <div class="contenedor">
                      <div class="contenidos"> 
                       <div class="mitadcell" >
                          <label>Alicuota: </label>
                            <select data-options=".Alicuota2" data-name="CC_Alic" id="CC_Alic" name="CC_Alic" breakpoint="true">
                                <option value="-1" >Despliegue para Seleccionar</option>
                                <?php $sql="SELECT * FROM inmalicuota WHERE Anio=DATE_FORMAT(CURDATE(),'%Y');";

                                      $result=ejecutarConsulta($sql);
                                     while ($reg=$result->fetch_object()){
                                        echo '<option value="'.$reg->referencia.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
                                     }
                        
                                 ?> 
                            </select>
                       </div>
                      <div class="mitadcell" ></div>
                        </div>
         </div>
              

        <div class="row">
                        <div class="form-group col-sm-6 col-xs-12">
                            
                        </div>

                      </div>
       
       </div>
     </div>
   </div>
        
      
      </div> <!--
      <div class="card-footer" style="position: fixed;bottom: 0px;width: 50%;">
                 <button type="submit" id="btnGuardarConstruccion" name="btnGuardarConstruccion" onclick=" return guardarConstruccion();" class="btn btn-info">Guardar</button>
                                     <button type="button" onclick="" class="btn btn-danger float-right">Cancelar</button>
         <div style="clear: both"></div> 
    </div> -->

 <div style="clear: both"></div> 
</form>
 <script type="text/javascript">
    
           $("#Id_Inm_Cons").val(<?php echo $Id_Inm_Cons;  ?>);
            $("#CC_Uso").val(<?php echo $CC_Uso;  ?>);
            $("#CC_Tipo").val(<?php echo $CC_Tipo;  ?>);
            $("#CC_Ocup").val(<?php echo $CC_Ocup;  ?>);
           
           $("#CC_NP").val(<?php echo $CC_NP;  ?>); 
            $("#CC_Elec").val(<?php echo $CC_Elec;  ?>); 
            <?php  

            $CC_Puer=trim($CC_Puer);  
             $datos = explode(":",$CC_Puer);
             foreach($datos as $elemento)
              {
                if ($elemento!="")
                echo '$("#CC_Puer option[value='.$elemento.']").attr("selected",true);';
             
              }
             
             $CC_Estr=trim($CC_Estr);  
             $datos = explode(":",$CC_Estr);
             foreach($datos as $elemento)
              {
                if ($elemento!="")
                echo '$("#CC_Estr option[value='.$elemento.']").attr("selected",true);';
             
              }


            ?>
             
            //$("#provincia option[value='La Rioja'").attr("selected",true);
           





            $("#CC_Tech_Cubi").val(<?php echo $CC_Tech_Cubi;  ?>); 
            $("#CC_Tech_Estr").val(<?php echo $CC_Tech_Estr;  ?>);
            $("#CC_Par_Acab").val(<?php echo $CC_Par_Acab;  ?>); 
            $("#CC_Par_Tipo").val(<?php echo $CC_Par_Tipo;  ?>); 
             
            
            $("#CC_NH").val(<?php echo $CC_NH;  ?>);
            
           // $("#Anio_Cons").val(<?php echo $Anio_Cons;  ?>);
            
             $("#CC_Piso").val(<?php echo $CC_Piso;  ?>); 

             $("#CC_Dim_Are").val(<?php echo $CC_Dim_Are;  ?>);
            $("#CC_Dim_Fon").val(<?php echo $CC_Dim_Fon;  ?>);
            $("#CC_Dim_Fre").val(<?php echo $CC_Dim_Fre;  ?>);
            $("#CC_Est_Con").val(<?php echo $CC_Est_Con;  ?>);

            $("#CC_Clas").val(<?php echo $CC_Clas;  ?>);
            $("#CC_Alic").val(<?php echo $CC_Alic;  ?>);
function guardarConstruccion() 
{
   // e.preventDefault(); //No se activará la acción predeterminada del evento
   // $("#btnGuardar").prop("disabled", true);
   // var formData = new FormData($("#formcostruccion")[0]);
    /*
    $.ajax({
        url: "../ajax/contrihacienda.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
          //  bootbox.alert(datos);
           
            
        }
    });*/
   // alert("Valores="+formData); return false;
    var query="&r=" + new Date().getTime()+";";
   /* bootbox.confirm("¿Esta seguro que derea continuar?", function (result) {
        if (result) {

          }
    })*/
    //  var Id_Cons=$('#Id_Inm_Cons').val();



            $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
              //  data: formData,
                 Id_Inm_Cons:$('#Id_Inm_Cons').val(),
                tipoopcion:"construccionguardar",
                CC_Dim_Are:$('#CC_Dim_Are').val(),
                CC_Dim_Fon:$('#CC_Dim_Fon').val(),
                CC_Dim_Fre:$('#CC_Dim_Fre').val(), 
                CC_Est_Con: $('#CC_Est_Con').val(),
                CC_NP:$('#CC_NP').val(),
                CC_Elec:$('#CC_Elec').val(),
                CC_Puer:$('#CC_Puer').val(),
                CC_Piso:$('#CC_Piso').val(),
                CC_Estr:$('#CC_Estr').val(),
                CC_Tech_Cubi:$('#CC_Tech_Cubi').val(),
                CC_Tech_Estr:$('#CC_Tech_Estr').val(),
                CC_Par_Acab:$('#CC_Par_Acab').val(),
                CC_Par_Tipo:$('#CC_Par_Tipo').val(),
                CC_Tipo:$('#CC_Tipo').val(),
                CC_Ocup:$('#CC_Ocup').val(),
                CC_NH:$('#CC_NH').val(),
                CC_Uso:$('#CC_Uso').val(),
                CC_Clas:$('#CC_Clas').val(),
                CC_Alic:$('#CC_Alic').val()
            }, function (e) {
                // alert("Valores="+e);
                bootbox.alert(e);
                listarCostruccion(Id_Inmueble);
               // // tabla.ajax.reload();
            });
      
    //limpiar();
     return false;
}
    
</script>