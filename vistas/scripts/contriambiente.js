var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
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
    $("#codcel").val("");
	$("#modo").val("");
    $("#estado").val("");
    $("#estado_pk").val("");
	$("#municipio_pk").val("");
	$("#parroquia_pk").val("");
    $("#ciudad_pk").val("");
	$("#sector").val("");
	$("#calle").val("");
    $("#edificio").val("");
    $("#numeroedif").val("");
	$("#medit").val("");
	$("#representative").val("");
	$("#addresses").val("");
    $("#code").val("");
	$("#registrado").val("");
	$("#conformidaduso").val("");
    $("#tieneinmueble").val("");
	$("#taseo").val("");
	$("#texpe").val("");
	$("#tapu").val("");
    $("#tilico").val("");
	$("#pkenumerator").val("");
	$("#viejo").val("");
	$("#ultima_declaracion").val("");
	$("#estatus").val("");
    $("#comodinbusqueda").val("");
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


function listar() {
	
    var comodinbusqueda = $("#comodinbusqueda").val();

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
		"paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
			info: 'Vista _START_ a _END_ de _TOTAL_ registros',
			search: 'Buscar',
			previous: 'Previo',
			lengthMenu: 'Ver _MENU_ registro por pagina',
		},
		 dom: 'Btrp',
        buttons:  [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
			url: '../ajax/contriambiente.php?op=listar',
			
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    }).DataTable();
}

function listar2() {
	
    var comodinbusqueda = $("#comodinbusqueda").val();

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        "autoWidth": false,
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
			url: '../ajax/contriambiente.php?op=listar2',
			data: {comodinbusqueda: comodinbusqueda},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
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
        url: "../ajax/contriambiente.php?op=guardaryeditar",
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
    $.post("../ajax/contriambiente.php?op=mostrar", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
		
        $("#rfc").val(data.rfc);
        $("#licencia").val(data.licencia);
		$("#tiponac").val(data.tiponac);
		$("#cedularif").val(data.cedularif);
        $("#razsocial").val(data.razsocial);
		$("#correo").val(data.correo);
        $("#tlf").val(data.tlf);
        $("#celular").val(data.celular);
        $("#codcel").val(data.codcel);
	    $("#modo").val(data.modo);
        $("#estado_pk").val(data.estado_pk);
	    $("#municipio_pk").val(data.municipio_pk);
	    $("#parroquia_pk").val(data.parroquia_pk);
		$("#ciudad_pk").val(data.ciudad_pk);
        $("#sector").val(data.sector);
		$("#calle").val(data.calle);
        $("#edificio").val(data.edificio);
		$("#numeroedif").val(data.numeroedif);
		$("#medit").val(data.medit);
		$("#representative").val(data.representative);
		$("#addresses").val(data.addresses);
		$("#code").val(data.code);
		$("#registrado").val(data.registrado);
		$("#conformidaduso").val(data.conformidaduso);
        $("#tieneinmueble").val(data.tieneinmueble);
	    $("#taseo").val(data.taseo);
	    $("#texpe").val(data.texpe);
		$("#tapu").val(data.tapu);
        $("#tilico").val(data.tilico);
		$("#pkenumerator").val(data.pkenumerator);
        $("#viejo").val(data.viejo);
		$("#ultima_declaracion").val(data.ultima_declaracion);
		$("#estatus").val(data.estatus);
    })
}

//Función para desactivar registros
function desactivar(rfc) {
    bootbox.confirm("¿Está seguro de desactivar al Contribuyente?", function (result) {
        if (result) {
            $.post("../ajax/contriambiente.php?op=desactivar", {
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
            $.post("../ajax/contriambiente.php?op=activar", {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();