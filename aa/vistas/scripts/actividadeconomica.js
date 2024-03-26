var tabla;
 var id_mayor=0;
 var tramite=0;
    var totliq=0;
//Funcion que se ejecuta al inicio

function init() {  
    mostrarform(false);
   // listar();
  
   /* $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });*/

  /*  $.post("../ajax/ajaxpagotaquilla.php?op=listarcontribuyentes", function(r){ // alert("Hola="+r);return;
        $("#idrfc").append('<option value="" selected>Seleccione una opción</option>'); 
        $("#idrfc").append(r);
        $('#idrfc').select2();
    });*/
    var idrfc=$("#idrfc").val();
    //$("#rfc").val(idrfc);
  // mostrar(idrfc);
   listar(idrfc);
	
}



function listar(rfc) {
    var parametros = {
                "idrfc" : rfc
        };
    tabla = $("#tbllistado").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            info: 'Vista _START_ a _END_ de _TOTAL_ registros',
            search: 'Buscar',
            previous: 'Previo',
            lengthMenu: 'Ver _MENU_ registro por pagina',
        },
        buttons: [
              'copyHtml5',
              'excelHtml5',
              'pdf'
          ],
          "ajax": {
            url: '../ajax/ajaxactividadeconomica.php?op=listar'+"&r=" + new Date().getTime()+";",
            type: "post",
            data:  parametros,
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
      })
  

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
     //   $("#resporteestadocuenta").hide();
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
  /*  e.preventDefault(); //No se activará la acción predeterminada del evento
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
    limpiar();*/
}

function Solicitar() {
    var rfc=$("#idrfc").val();   
    if ($("#seltipo").val()==0){
        alert("Seleccione un tipo de solicutud");
        $("#seltipo").focus();
        return false;
    }
   if ($("#motivo").val()==""){
        alert("Ingrese un motivo");
        $("#motivo").focus();
        return false;
    }


    var query="&r=" + new Date().getTime()+";";
  /* bootbox.confirm("¿Está seguro de Hacer la solicutud?", function (result) {
        if (result) {*/
            $.post("../ajax/ajaxactividadeconomica.php?op=solicitud"+query, {
                idrfc:rfc
            }, function (e) {
                bootbox.alert(e);
                $('#formulario2').modal('hide');
               // tabla.ajax.reload();
               //return false;
            });

       /* }
         return true;
    });*/
}



/*
function mostrar(rfc) {
   
    //var rfc = $("#comodinbusqueda").val();
   
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
   
}*/
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








//Función para desactivar registros



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

           regexp = /.[0-9]{10}$/; //PARTE ENTERA 10

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