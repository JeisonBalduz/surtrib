var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();
 
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
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
    $("#rfc2").val("");
    $("#name").val("");
    $("#rif").val("");
    $("#montobrutoanual").val("");
    $("#representante").val("");
    $("#rcedula").val("");
    $("#rtelefono").val("");

   
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



function verdefinitiva()
{

	var busqueda = $("#comodinbusqueda").val();

    $.post("../ajax/definitiva.php?op=mostrar",{busqueda : busqueda}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		
		$("#name").val(data.name);
		$("#rif").val(data.rif);
        $("#rfc2").val(data.rfc);
	

 	});

	$.post("../ajax/definitiva.php?op=verdefinitiva",{busqueda : busqueda}, function(r)
	{
				
		$("#mesesdefinitiva").html(r);
        

		
 	});

}

function listar() {
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
            url: '../ajax/definitiva.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}



function guardaryeditar(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/definitiva.php?op=guardaryeditar",
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

init();