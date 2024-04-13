var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);

  

   	

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




function listar() {
	
    var tramite = $("#tramite").val();


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
			url: '../ajax/ajustetramite.php?op=listar',
			data: {tramite: tramite},
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


function guardaryeditar()
{

	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ajustetramite.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	  

	});	          
	          mostrarform(false);
	          tabla.ajax.reload();
	limpiar();
}





function mostrar(id)
{
    

	$.post("../ajax/ajustetramite.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);
	
		mostrarform(true);
        $("#id").val(data.id);
        $("#tramite2").val(data.tramite);
        $("#periodoviejo").val(data.period);
        $("#periodonuevo").val(data.period);
        $("#montoliqviejo").val(data.totliq);
        $("#montoliqnuevo").val(data.totliq);
        $("#montodifviejo").val(data.deferred);
        $("#montodifnuevo").val(data.deferred);
        $("#montopagviejo").val(data.totpag);
        $("#montopagnuevo").val(data.totpag);
        $("#rfc2").val(data.idrfc);
		
 	});

    

}


function anular(id,rfc,tramite,totliq)
{
	bootbox.confirm("¿Está Seguro de Anular el Tramite?", function(result){
		if(result)
        {
        	$.post("../ajax/ajustetramite.php?op=anular", {id : id, rfc: rfc, tramite:tramite, totliq:totliq}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})

	bootbox.alert(data.totliq);
}


init();