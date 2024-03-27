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
    $("#rfc2").val("");
    $("#licencia").val("");
	$("#idusuario").val("");
	$("#sector").val("");
	$("#calle").val("");
    $("#edificio").val("");
    $("#numeroedif").val("");
	$("#medit").val("");
	$("#representative").val("");
	$("#docrifmuestra").attr("src","");
	$("#docrifnactual").val("");
    $("#docregistromuestra").attr("src","");
	$("#docregistroactual").val("");
	$("#conformidaduso").val("");
    $("#tieneinmueble").val("");
	$("#taseoi").val("");
	$("#ultima_declaracion").val("");
    $("#ramo").val("");
	$("#categoria").val("");
	$("#tipo").val("");
    $("#tasa").val("");
    $("#tipo2").empty(); 
                    $("#ramo2").val("");
                    $("#categoria2").val("");
                    $("#taseoi2").val("");
                    $("#tiposervicio").val("");
                    $("#datos").val("");
                    $("#tasaasignada").val("");
                    $("#direccion").val("");
                     $("#tiposer").val("");
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
			url: '../ajax/listadoambiente.php?op=listar',
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
        url: "../ajax/listadoambiente.php?op=guardaryeditar",
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