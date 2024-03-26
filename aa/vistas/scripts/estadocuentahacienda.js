var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();
  
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
	
}

$(document).ready(function() {
    $('#comodinbusqueda').select2();
    $("#comodinbusqueda").select2({ 
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

   
});

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




function listar2() {
	mostrar();
    mostrartotal();
    var comodinbusqueda = $("#comodinbusqueda").val();
    $("#resporteestadocuenta").show();

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
			url: '../ajax/contrihacienda.php?op=estadocuenta',
			data: {comodinbusqueda: comodinbusqueda},
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
    }).DataTable();
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

init();