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
	$("#idmoneda").val("");
	$("#nombremoneda").val("");
	$("#codigomoneda").val("");
	$("#symbol_left").val("");
	$("#symbol_right").val("");
	$("#decimal_point").val("");
	$("#thousands_point").val("");
	$("#decimal_places").val("");
	$("#value").val("");
	$("#mcref").val("");
	$("#principal").val("");
	$("#last_updated").val("");
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
            url: '../ajax/moneda.php?op=listar',
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
		url: "../ajax/moneda.php?op=guardaryeditar",
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

function mostrar(idmoneda)
{
	$.post("../ajax/moneda.php?op=mostrar",{idmoneda : idmoneda}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idmoneda").val(data.id);
		$("#nombremoneda").val(data.title);
		$("#codigomoneda").val(data.code);
		$("#symbol_left").val(data.symbol_left);
		$("#symbol_right").val(data.symbol_right);
		$("#decimal_point").val(data.decimal_point);
		$("#thousands_point").val(data.thousands_point);
		$("#decimal_places").val(data.decimal_places);
		$("#value").val(data.value);
		$("#mcref").val(data.mcref);
		$("#principal").val(data.principal);
		$("#last_updated").val(data.last_updated);
 	});

}


//Función para desactivar registros
function desactivar(idmoneda)
{
	bootbox.confirm("¿Está Seguro de desactivar la moneda?", function(result){
		if(result)
        {
        	$.post("../ajax/moneda.php?op=desactivar", {idmoneda : idmoneda}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idmoneda)
{
	bootbox.confirm("¿Está Seguro de activar la moneda?", function(result){
		if(result)
        {
        	$.post("../ajax/moneda.php?op=activar", {idmoneda : idmoneda}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();