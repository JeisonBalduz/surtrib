var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
 
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    $.post("../ajax/tasasadministrativasaseo.php?op=selectasas", function(r){
		$("#vidt").append('<option value="" selected>Seleccione una opción</option>'); 
		$("#vidt").append(r);
		$('#vidt').select2();
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

	$.post("../ajax/tasasadministrativasaseo.php?op=tasasadmin",{busqueda : busqueda}, function(data, status)
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
        url: "../ajax/tasasadministrativasaseo.php?op=guardaryeditar",
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





init();