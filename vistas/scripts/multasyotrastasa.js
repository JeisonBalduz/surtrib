var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
 
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    $.post("../ajax/multasyotrastasa.php?op=selectasas", function(r){
		$("#vidt").append('<option value="" selected>Seleccione una opción</option>'); 
		$("#vidt").append(r);
		$('#vidt').select2();
	});
	
	$('#comodinbusqueda').select2();
    $("#comodinbusqueda").select2({   //
        ajax: {
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            url: "../ajax/contrihacienda.php?op=buscarContibuyente"+"&r=" + new Date().getTime(),
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


function tasasadmin()
{
   
    var busqueda = $("#comodinbusqueda").val();

	$.post("../ajax/multasyotrastasa.php?op=tasasadmin",{busqueda : busqueda}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		
		$("#name").val(data.name);
		$("#rfc").val(data.rfc);
		$("#rif").val(data.rif);
		
 	});

}



function guardaryeditar(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/multasyotrastasa.php?op=guardaryeditar",
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

$(document).ready(function(){ 

    $("input[data-name='monto']").change(function() {
      if ($("input[data-name='monto']").val() != '' ) {
        $("input[data-name='monto']").val(parseFloat($("input[data-name='monto']").val().replace(',', '.')) );
       // $("input[data-name='CT_Dim_Are']").val(parseFloat($("input[data-name='CT_Dim_Are']").val()).toFixed(2).replace('.', ','));
       
      }
    });

});

init();