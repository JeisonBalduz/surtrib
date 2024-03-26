var tabla;
var tabla2;
var Id_Inmueble;
//Funcion que se ejecuta al inicio

function init() {

    mostrarform(false);
    listarinmueblec();


  /*  $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });*/
	
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
  
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
  /*  if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }*/
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}


function listarinmueblec() {
	var query="&r=" + new Date().getTime()+";";
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
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
			url: '../ajax/ajaxInmueble.php?op=listarinmueblec'+query,
			
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
    });
}

function listar2() {
	var query="&r=" + new Date().getTime()+";";
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
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
			url: '../ajax/ajaxInmueble.php?op=listarinmueblec'+query,
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
    });
}


   

init();





