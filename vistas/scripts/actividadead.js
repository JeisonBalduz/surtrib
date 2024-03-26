var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();
  

   	

}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
    $("#id").val("");
    $("#actividad").val("");
	$("#actividad2").val("");
    $("#rfc2").val("");
	$("#rfctabla").val("");
   
}

//Mostrar Formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}




function listar2() {
	
    var rfc2 = $("#rfc2").val();


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
			url: '../ajax/actividadead.php?op=listarad',
			data: {rfc2: rfc2},
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


function guardaryeditar2()
{

	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/actividadead.php?op=guardaryeditar2",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	  

	});	          
	          mostrarform(false);
	          tabla.ajax.reload();
	limpiar();
}


function incluir()
{
    mostrarform(true);
    $.post("../ajax/actividadead.php?op=listaractividad2", function(r){
		$('#actividad').append('<option value="" selected>Seleccione una opción</option>');
		$("#actividad").append(r);
		$('#actividad').select2();
    });

}


function mostrar(id)
{
    
    $.post("../ajax/actividadead.php?op=listaractividad2", function(r){
		$('#actividad').append('<option value="" selected>Seleccione una opción</option>');
		$("#actividad").append(r);
		$('#actividad').select2();
    });

	$.post("../ajax/actividadead.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);
	
		mostrarform(true);
        $("#id").val(data.id);
        $("#actividad2").val(data.codigo_grupo+'   '+data.detalles+'   Alicuota: '+data.alicuota);
        $("#rfctabla").val(data.rfc);
		
 	});

    

}


init();