var tabla;
 var id_mayor=0;
 var tramite=0;
 var totliq=0;
 var idt=0;
 var  myArray=[];
 var totalapagartramite=0;
 var listramite="";
var comprobantes=[];


//Funcion que se ejecuta al inicio

function init() {  
    mostrarform(false);
   // listar();
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

  /*  $.post("../ajax/ajaxpagotaquilla.php?op=listarcontribuyentes", function(r){ // alert("Hola="+r);return;
        $("#idrfc").append('<option value="" selected>Seleccione una opción</option>'); 
        $("#idrfc").append(r);
        $('#idrfc').select2();
    });*/
   
    
}
function vermarcados(){ 
     var sumatramite=0;
     var totalapagar;
     totalapagartramite=0;
     listramite="";
    // myArray=[];
     comprobantes=[];
    $("#listadotbody input:checkbox:checked").each(function(){
        id_mayor=$(this).attr("data-id_mayor");
        tramite=$(this).val();
        totalapagar=$(this).attr("data-totalapagar");
        idt=$(this).attr("data-idt");
   // myArray.push(""+id_mayor+"|"+tramite+"|"+totalapagar+"|"+idt);
    sumatramite=sumatramite+parseFloat(totalapagar);//.toFixed(2)
   // myArray.push(array(id_mayor,tramite, idt,parseFloat(totalapagar)));
   comprobantes.push({ "id_mayor": id_mayor, "tramite":tramite,"totalapagar":totalapagar,"idt":idt });
         listramite=listramite+" - "+tramite;
   
      });
        
        if (comprobantes.length>0){
             totalapagartramite=sumatramite.toFixed(2);
            $("#totalapagar").html(""+sumatramite.toFixed(2));
           }
         //  alert("tamaño del array="+sumatramite);
          
}

$(document).ready(function() {
    

    
    
    
    $("#marcarTodo1").change(function () {//$("#resultado").html("");
       // myArray=[];
        comprobantes=[];
        var sumatramite=0;
        var totalapagar;
        totalapagartramite=0;
        listramite="";
        if ($(this).is(':checked')) {
            
            //$("input[type=checkbox]").prop('checked', true); //todos los check
            $("#tbllistado input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
        } else {
                 //$("input[type=checkbox]").prop('checked', false);//todos los check
            $("#tbllistado input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
        }
        
        $("#listadotbody input:checkbox:checked").each(function(){
        id_mayor=$(this).attr("data-id_mayor");
        tramite=$(this).val();
        totalapagar=$(this).attr("data-totalapagar");
        idt=$(this).attr("data-idt");
    //myArray.push(array(id_mayor,tramite, idt,parseFloat(totalapagar)));
      //   myArray.push(""+id_mayor+"|"+tramite+"|"+totalapagar+"|"+idt);
    sumatramite=sumatramite+parseFloat(totalapagar);//.toFixed(2)
         comprobantes.push({ "id_mayor": id_mayor, "tramite":tramite,"totalapagar":totalapagar,"idt":idt });
         listramite=listramite+" - "+tramite;
   
      });
        
        if (comprobantes.length>0){
            totalapagartramite=sumatramite.toFixed(2);
            $("#totalapagar").html(""+sumatramite.toFixed(2));//alert("tamaño del array="+sumatramite);
           }
           else{
            $("#totalapagar").html("");
           }
            

            });



    $('#comodinbusqueda').select2();
    $("#comodinbusqueda").select2({   //
        ajax: {
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            url: "../ajax/contriambiente.php?op=buscarContibuyente"+"&r=" + new Date().getTime(),
            dataType: 'json',
          //  data:'rfc=' + 
              delay: 650,
             data: function (params) {
                    var SearchParamsSent = {
                        search: params.term
                        //tblname: editor.field('itemtype').inst('val')
                    }
 
                    return SearchParamsSent;
                }
            
            ,
            processResults: function (data) {
                return {
                    results: data
                }
            }
        },
        cache: true,
        placeholder: 'Buscar Contribuyente...',
        minimumInputLength: 1
    });

   
});

function getidrfc(){ 
    mostrar();
  //  mostrartotal();
    var comodinbusqueda = $("#comodinbusqueda").val();
    $("#resporteestadocuenta").show();
      //  alert("valor="+comodinbusqueda);
    tabla = $('#tbllistado').dataTable({
        "aProcessing": false, //Activamos el procesamiento del datatables
        "aServerSide": false, //Paginación y filtrado realizados por el servidor
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true,
        "responsive": true,

        "language": {
            info: 'Vista _START_ a _END_ de _TOTAL_ registros',
            search: 'Buscar',
            previous: 'Previo',
            lengthMenu: 'Ver _MENU_ registro por pagina',
        },
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/ajaxpagotaquilla_aseo.php?op=obtenerdeudas'+"&r=" + new Date().getTime()+";",
            data: {idrfc: comodinbusqueda},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
    
        "bDestroy": true,
        "iDisplayLength": 50, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
    return false;
}




function getidrfc2(idrfc) {
    var query="&r=" + new Date().getTime()+";";
    //mostrar();
   // mostrartotal();
    var comodinbusqueda = $("#comodinbusqueda").val();
   // $("#resporteestadocuenta").show();

    tabla = $('#tbllistado').dataTable({
        "aProcessing": false, //Activamos el procesamiento del datatables
        "aServerSide": false, //Paginación y filtrado realizados por el servidor
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true,
        "responsive": true,

        "language": {
            info: 'Vista _START_ a _END_ de _TOTAL_ registros',
            search: 'Buscar',
            previous: 'Previo',
            lengthMenu: 'Ver _MENU_ registro por pagina',
        },
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/ajaxpagotaquilla_aseo.php?op=obtenerdeudas'+query,
            data: {idrfc: idrfc},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
    
        "bDestroy": true,
        "iDisplayLength": 50, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
    $("#rfc").val("");
    $("#licencia").val("");
    $("#tiponac").val("");
    $("#cedularif").val("");
    $("#razsocial").val("");
    $("#correo").val("");
    $("#tlf").val("");
    $("#celular").val("");
   
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#resporteestadocuenta").hide();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}

function mostrarlig() {
    limpiar();
    mostrarform(false);
}






function guardaryeditar(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/contrihacienda_aseo.phpop=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrar(rfc) {
   
    var rfc = $("#comodinbusqueda").val();
   
    $.post("../ajax/contrihacienda_aseo.php?op=mostrar", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
        
        document.getElementById('razsocial').innerHTML = data.razsocial;
        document.getElementById('rufrif').innerHTML = data.rfc+' <b>RIF:</b> '+data.tiponac+data.cedularif;
        document.getElementById('direccionfiscal').innerHTML = data.sector+' '+data.calle+' '+data.edificio+' ';
        document.getElementById('correo').innerHTML = data.correo+' <b>Estatus:</b> '+data.estatus;
        
       
    })
   
}

function tipo_pago(value){
    if(value==0){
       $("#divaprovado").show(); $("#divreferencia").show();
        $("#txtreferencia").val("");
        $("#txtaprobado").val(""); 
        $("#divbanco").show();
          $("#banco").val("0");
    }
    else
     if (value==2){
        $("#divaprovado").hide(); $("#divreferencia").show();
        $("#txtreferencia").val("");
        $("#txtaprobado").val("Transferencia");
        $("#divbanco").show();
          $("#banco").val("0");  
       
         
    }
    else
    if (value==8){
        $("#divaprovado").hide(); $("#divreferencia").hide();
        $("#txtreferencia").val("Efectivo");
        $("#txtaprobado").val("Efectivo");
        $("#banco").val("0");
         $("#divbanco").hide();

         
    }
     
}

function chequear_ampos(){
    if($("#txtreferencia").val()==""){
        alert("Ingrese la Referencia");
        $('#txtreferencia').focus();
         return false;
    }
    else
     if ($("#txtaprobado").val()==""){
        alert("Ingrese el Monto Aprobado");$('#txtaprobado').focus();
         return false;
    }
    else
     if ($("#txtmonto").val()==""){
        alert("Ingrese el Monto");$('#txtmonto').focus();
         return false;
    }
     return true;
}

function consultarReferencia(valor)
{  
    var tipopag=$("#tipopago").val();
    var banc=$("#banco").val();
    if(valor.length!=6&&tipopag==2){ 
       alert("Referencia no Valida, Ingrese 6 Digitos");
       $("#txtreferencia").val("");
       $('#txtreferencia').focus();
       return false;
    }
   // alert("valor.length="+valor.length);
    if(valor.length==6&&tipopag==2){ 
    $.post("../ajax/ajaxpagotaquilla_aseo.php?op=consultarReferencia",{txtreferencia : valor,tipopago:tipopag,banco:banc}, function(data, status)
    {
        
        var json = JSON.parse(data);    
        if (json){
            if(json.Referencia==1){
                bootbox.alert("Esta Registrada esa Referencia");
                $("#txtreferencia").val("");$('#txtreferencia').focus();
                    return false;
            } 
                 
        }
        
    });
    }
   return false;
}

function guardarPagotaquilla() 
{   $("#btn_pagotaqulla").hide();
   // e.preventDefault(); //No se activará la acción predeterminada del evento
   // $("#btnGuardar").prop("disabled", true);
   // var formData = new FormData($("#formulariopagotaquilla")[0]);
     var txtreferencia=$("#txtreferencia").val();
     var txtaprobado=$("#txtaprobado").val();
     var txtmonto=$("#txtmonto").val();//cargartramites
     var msg="¿Está Seguro Desea continuar? <br/><strong>Referencia:"+txtreferencia+" Aprobado: "+txtaprobado+" Monto: "+txtmonto+"</strong> <br/>"+$("#cargartramites").html();
    // var msg="¿Está Seguro Desea continuar? <br/>"+$("#cargartramites").html();
 //  alert("Valores="+formData); return false;
    var query="&r=" + new Date().getTime()+";";

       if ($('#tipopago').val()==""){  
                    alert("Seleccione Tipo de pago");$('#tipopago').focus();
                    $("#btn_pagotaqulla").show();
               return false;
            }

           if ($("#txtreferencia").val()==""){  
                   alert("Ingrese la Referencia");$('#txtreferencia').focus();
                   $("#btn_pagotaqulla").show();
                   return false;
           }
           else
     if ($("#txtaprobado").val()==""){  
                    alert("Ingrese Valor Aprobado");$('#txtaprobado').focus();
                    $("#btn_pagotaqulla").show();
               return false;
            }
       


           /* if($("#txttotalapagar").val()!=$('#txtmonto').val()){
                 alert("El monto Ingresado no es igual al Total apagar");
                return false;
            }*/
            if($('#txtmonto').val()<=0){  //||$("#txttotalapagar").val()<=0
                 alert("Monto No Valido");$('#txtmonto').focus();
                 $("#btn_pagotaqulla").show();
                return false;
            }
            var txtrefe=$("#txtreferencia").val();
           
            
            if ($("#tipopago").val()==2&&(txtrefe.length<6|| txtrefe.length>6 )  ){  
                   alert("Debe Ingresar los ultimos 6 Dogitos de su Referencia"); 
                   $('#txtreferencia').focus();
                      // $('#txtreferencia').focus();
                 //  $("#btn_pagotaqulla").show();
                   return false;
           }


              // alert("id_mayo="+$('#id_mayor').val()+" tramite="+$('#tramite').val()+" txtmonto="+$('#txtmonto').val()+" txtaprobado="+$('#txtaprobado').val());
             // return false;

      // alert("json_det="+$('#json_det').val());


        bootbox.confirm(""+msg, function(result){
        if(result)
        {
          
         $.post("../ajax/ajaxpagotaquilla_aseo.php?op=Pagotaquilla"+query, {
               // id_mayor:$('#id_mayor').val(),
               // tramite:$('#tramite').val(),
                txtreferencia:$('#txtreferencia').val(),
                txtmonto:$('#txtmonto').val(),
                txtaprobado:$('#txtaprobado').val(),
                tipopago:$('#tipopago').val(),
                banco:$('#banco').val(),
                json_det:$('#json_det').val()

                //idt:$('#idt').val() 
            }, function (data, status) {
               //  alert("Valores="+data);
                var valo=bootbox.alert(data);
               // listarCostruccion(Id_Inmueble);
                var resu=getidrfc();
                $(".modal").trigger('click');
              return true;
            });


        }
        $("#btn_pagotaqulla").show();
    });

       
      
    //limpiar();
    return true;
}

function CarcularPagoTramite(){
  var total=0.00;
  var JsonAux;
  myArray=[];
    if($('#txtmonto').val()>0){  //||$("#txttotalapagar").val()<=0
        total=parseFloat($('#txtmonto').val());
          if(comprobantes.length>0){
            for(var i=0;i<comprobantes.length;i++){
                $('#asignado'+comprobantes[i].tramite).html('<label> Monto:</label>');
            }

             for(var i=0;i<comprobantes.length;i++){
                if(comprobantes[i].totalapagar<=total){
                    total=total-comprobantes[i].totalapagar;
                   // alert("total="+parseFloat(total));
                  //  console.log("total="+total);
                    $('#asignado'+comprobantes[i].tramite).html('<label> Monto:'+comprobantes[i].totalapagar+'</label>');
                    if(i+1==comprobantes.length){
                      total=parseFloat(comprobantes[i].totalapagar)+parseFloat(total);  
                       $('#asignado'+comprobantes[i].tramite).html('<label> Monto:'+parseFloat(total.toFixed(2))+'</label>');
                       myArray.push({ "id_mayor": comprobantes[i].id_mayor, "tramite":comprobantes[i].tramite,"totalapagar":parseFloat(total.toFixed(2)),"idt":comprobantes[i].idt });
                    }
                    else{

                      //  total=total-comprobantes[i].totalapagar;
                   // alert("total="+parseFloat(total));
                  //  console.log("total="+total);
                    $('#asignado'+comprobantes[i].tramite).html('<label> Monto:'+comprobantes[i].totalapagar+'</label>');
                    myArray.push({ "id_mayor": comprobantes[i].id_mayor, "tramite":comprobantes[i].tramite,"totalapagar":parseFloat(comprobantes[i].totalapagar),"idt":comprobantes[i].idt });

                    

                    }

                }
                else if((comprobantes[i].totalapagar>total)&&(total>0)){
                   //  alert("total2="+comprobantes[i].totalapagar+" total="+total);
                    $('#asignado'+comprobantes[i].tramite).html('<label> Monto:'+parseFloat(total.toFixed(2))+'</label>');//.toFixed(2)
                   
                    myArray.push({ "id_mayor": comprobantes[i].id_mayor, "tramite":comprobantes[i].tramite,"totalapagar":parseFloat(total.toFixed(2)),"idt":comprobantes[i].idt });
                    
                    total=0;
                }

             }

            JsonAux={"comprobantes":myArray};
            $("#json_det").val(JSON.stringify(JsonAux));
           
          }


    }

}

function Pagotaquilla(id){
     var cargartramites=$("#cargartramites");
     cargartramites.html("");
    $("#id_mayor").val("");
    $("#tramite").val("");
    $("#idt").val("");
    $("#txttotalapagar").val("");
     
   $("#txtreferencia").val("");
   $("#txtaprobado").val("");
   $("#txtmonto").val("");
    id_mayor=$("#"+id).attr("data-id_mayor");
    tramite=$("#"+id).attr("data-tramite");
    totliq=$("#"+id).attr("data-totliq");
    var totalapagar=$("#"+id).attr("data-totalapagar");
    idt=$("#"+id).attr("data-idt");
   // alert("id_mayor="+totliq);return;    

    //myArray.push(""+id_mayor+"|"+tramite+"|"+totalapagar+"|"+idt);debt1.toFixed(2).toString().toMoney()
   //comprobantes.push({ "Num_comp": k[0].Id_Pla_Dec, "Monto": debt1.toFixed(2).toString().toMoney() });
   

    if(comprobantes.length>0){

        for(var i=0;i<comprobantes.length;i++){
           cargartramites.append(
             '<div class="row" id="tramite'+comprobantes[i].tramite+'">'
             +'<div class="form-group col-sm-4 col-xs-12"><label>Tramite: '+comprobantes[i].tramite
             +'</label></div>'
             +'<div class="form-group col-sm-4 col-xs-12"><label> Pagar:'+comprobantes[i].totalapagar+'</label></div>'
             +'<div class="form-group col-sm-4 col-xs-12" id="asignado'+comprobantes[i].tramite+'"><label> Monto:</label></div>'
             +'</div>'
           );

        }

    }
   $("#titulotamite").html('Procesar Pago Tramite ');//+listramite


    $("#id_mayor").val(id_mayor);
    $("#tramite").val(tramite);
    $("#idt").val(idt);
    $("#txttotalapagar").val(totalapagartramite);
    // $("#btn_pagotaqulla").show();
}






function mostrartotal(rfc) {
   
    var rfc = $("#comodinbusqueda").val();
   
    $.post("../ajax/contrihacienda_aseo.php?op=mostrartotal", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
        
        document.getElementById('stotaliq').innerHTML = data.stotaliq;
        document.getElementById('sdiferido').innerHTML = data.sdiferido;
        document.getElementById('sdescuento').innerHTML = data.sdescuento;
        document.getElementById('stotalp').innerHTML = data.stotalp;
        document.getElementById('stotaltotal').innerHTML = data.stotaltotal;
       
    })
   
}


function NumCheck(e, id) {

     //PARA LLAMARLO EN EL OBJETO ---> onkeypress="solo_JQdecimal(this.id)"



     // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46

     var field = $(id);

     key = e.keyCode ? e.keyCode : e.which;

 

     if (key == 8) return true;

     if (key > 47 && key < 58) {

       if (field.val() === "") return true;

       var existePto = (/[.]/).test(field.val());

       if (existePto === false){

           regexp = /.[0-9]{20}$/; //PARTE ENTERA 10

       }

       else {

         regexp = /.[0-9]{2}$/; //PARTE DECIMAL2

       }

       return !(regexp.test(field.val()));

     }

     if (key == 46) {

       if (field.val() === "") return false;

       regexp = /^[0-9]+$/;

       return regexp.test(field.val());

     }

     return false;

 

}

init();