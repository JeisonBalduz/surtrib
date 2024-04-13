var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
 
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    $.post("../ajax/tasasadministrativasaseom.php?op=selectasas", function(r){
		$("#vidt").append('<option value="" selected>Seleccione una opción</option>'); 
		$("#vidt").append(r);
		$('#vidt').select2();
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

	$.post("../ajax/tasasadministrativasaseom.php?op=tasasadmin",{busqueda : busqueda}, function(data, status)
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
        url: "../ajax/tasasadministrativasaseom.php?op=guardaryeditar",
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