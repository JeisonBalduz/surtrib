var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	
}


//Función limpiar
function limpiar()
{
	$("#id").val("");
	$("#codigo_grupo").val("");
	$("#detalles").val("");
	$("#umt").val("");
	$("#alicuota").val("");
	$("#DECRETO").val("");
	
}

//Función mostrar formulario
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

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
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
            url: '../ajax/activeco.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/activeco.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id)
{
	$.post("../ajax/activeco.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#id").val(data.id);
		$("#codigo_grupo").val(data.codigo_grupo);
		$("#detalles").val(data.detalles);
		$("#umt").val(data.umt);
		$("#alicuota").val(data.alicuota);
		$("#DECRETO").val(data.DECRETO);
 	});

}


//Función para desactivar registros
function desactivar(id)
{
	bootbox.confirm("¿Está Seguro de desactivar la tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/activeco.php?op=desactivar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(id)
{
	bootbox.confirm("¿Está Seguro de eliminar la tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/activeco.php?op=eliminar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idtaxresidencia)
{
	bootbox.confirm("¿Está Seguro de activar la tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/activeco.php?op=activar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();