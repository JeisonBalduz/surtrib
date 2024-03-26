var tabla;
 var id_mayor=0;
 var tramite=0;
 var totliq=0;
 var idt=0;
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
        "searching": false,
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
            url: '../ajax/ajaxpagotaquilla.php?op=obtenerdeudas'+"&r=" + new Date().getTime()+";",
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
        "searching": false,
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
            url: '../ajax/ajaxpagotaquilla.php?op=obtenerdeudas'+query,
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
        url: "../ajax/contrihacienda.php?op=guardaryeditar",
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
   
    $.post("../ajax/contrihacienda.php?op=mostrar", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
        
        document.getElementById('razsocial').innerHTML = data.razsocial;
        document.getElementById('rufrif').innerHTML = data.rfc+' <b>RIF:</b> '+data.tiponac+data.cedularif;
        document.getElementById('direccionfiscal').innerHTML = data.sector+' '+data.calle+' '+data.edificio+' ';
        document.getElementById('correo').innerHTML = data.correo+' <b>Estatus:</b> '+data.estatus;
        
       
    })
   
}

function mostrarliq(tramite) {
   
       alert("tramite="+tramite);return;
    $.post("../ajax/contrihacienda.php?op=mostrarliq", {
        tramite: tramite
    }, function (data, status) {
        data = JSON.parse(data);
      
        document.getElementById('idtipotramite').innerHTML = data.idtipotramite;
        document.getElementById('detalle').innerHTML = data.detalle;
        document.getElementById('monton').innerHTML = data.monton;
        document.getElementById('tramitelig').innerHTML = data.tram;
       
    })
   
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

function guardarPagotaquilla() 
{
   // e.preventDefault(); //No se activará la acción predeterminada del evento
   // $("#btnGuardar").prop("disabled", true);
   // var formData = new FormData($("#formulariopagotaquilla")[0]);
    
 //  alert("Valores="+formData); return false;
    var query="&r=" + new Date().getTime()+";";

           if ($("#txtreferencia").val()==""){  
                   alert("Ingrese la Referencia");$('#txtreferencia').focus();
                   return false;
           }
           else
     if ($("#txtaprobado").val()==""){  
                    alert("Ingrese Valor Aprobado");$('#txtaprobado').focus();
               return false;
            }



           /* if($("#txttotalapagar").val()!=$('#txtmonto').val()){
                 alert("El monto Ingresado no es igual al Total apagar");
                return false;
            }*/
            if($('#txtmonto').val()<=0){  //||$("#txttotalapagar").val()<=0
                 alert("Monto No Valido");$('#txtmonto').focus();
                return false;
            }

              // alert("id_mayo="+$('#id_mayor').val()+" tramite="+$('#tramite').val()+" txtmonto="+$('#txtmonto').val()+" txtaprobado="+$('#txtaprobado').val());
             // return false;
        
            $.post("../ajax/ajaxpagotaquilla.php?op=Pagotaquilla"+query, {
                id_mayor:$('#id_mayor').val(),
                tramite:$('#tramite').val(),
                txtreferencia:$('#txtreferencia').val(),
                txtmonto:$('#txtmonto').val(),
                txtaprobado:$('#txtaprobado').val(),
                idt:$('#idt').val() 
            }, function (data, status) {
               //  alert("Valores="+data);
                var valo=bootbox.alert(data);
               // listarCostruccion(Id_Inmueble);
                var resu=getidrfc();
                $(".modal").trigger('click');
              return true;
            });
      
  //  return false;;
    //  var Id_Cons=$('#Id_Inm_Cons').val();



            
      
    //limpiar();
    return true;
}

function Pagotaquilla(id){

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
   
   $("#titulotamite").html('Procesar Pago Tramite N°:'+tramite);


    $("#id_mayor").val(id_mayor);
    $("#tramite").val(tramite);
    $("#idt").val(idt);
    $("#txttotalapagar").val(totalapagar);
   
}






function mostrartotal(rfc) {
   
    var rfc = $("#comodinbusqueda").val();
   
    $.post("../ajax/contrihacienda.php?op=mostrartotal", {
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
//Función para desactivar registros
function desactivar(rfc) {
    bootbox.confirm("¿Está seguro de desactivar al Contribuyente?", function (result) {
        if (result) {
            $.post("../ajax/contri.php?op=desactivar", {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(rfc) {
    bootbox.confirm("¿Está seguro de activar al Contribuyente?", function (result) {
        if (result) {
            $.post("../ajax/contri.php?op=activar", {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
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