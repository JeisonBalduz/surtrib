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
	$("#licenseplate").val("");
	$("#anio").val("");
	$("#marca").val("");
	$("#modelos").val("");
	$("#fechacompra").val("");
	$("#idtvehiculo").val("");
	$("#puestos").val("");
	$("#pesos").val("");
	$("#registered").val("");

	
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
		listar2();

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
            url: '../ajax/actividadeco.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}


function listar2() {
	$.post("../ajax/actividadeco.php?op=listaractividad", function(r){
		$('#actividad').append('<option value="" selected>Seleccione una opción</option>');
		$("#actividad").append(r);
		$('#actividad').select2();
});
}


function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = $("#actividadeco");

              
	          bootbox.alert(formData);	          
	
}


//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/actividadeco.php?op=guardaryeditar",
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
	$(location).attr("href","concepto.php"); 
}

function mostrar(id)
{
	$.post("../ajax/vehiculos.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		
		$("#id").val(data.idv);
		$("#licenseplate").val(data.licenseplate);
		$("#marca").val(data.marca);
		$("#anio").val(data.anio);
		$("#modelos").val(data.modelos);
		$("#fechacompra").val(data.fechacompra);
		$("#idtvehiculo").val(data.idtvehiculo);
		$('#idtvehiculo').select2();
		$("#puestos").val(data.puestos);
		$("#pesos").val(data.pesos);
		$("#registered").val(data.registered);
		
 	});

}


//Función para desactivar registros
function desactivar(id)
{
	bootbox.confirm("¿Está Seguro de desactivar el vehiculo?", function(result){
		if(result)
        {
        	$.post("../ajax/vehiculos.php?op=desactivar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id)
{
	bootbox.confirm("¿Está Seguro de activar el vehiculo?", function(result){
		if(result)
        {
        	$.post("../ajax/vehiculos.php?op=activar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();