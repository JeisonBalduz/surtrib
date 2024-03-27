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
	$("#idtaxempamb").val("");
	$("#idtipotax").val("");
	$("#idramotax").val("");
	$("#idcategoriatax").val("");
	$("#tipotax").val("");
	$("#ramotax").val("");
	$("#categoriatax").val("");
	$("#tax").val("");
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
            url: '../ajax/tasaservamb.php?op=listar',
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
		url: "../ajax/tasaservamb.php?op=guardaryeditar",
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

function mostrar(idtaxempamb)
{
	$.post("../ajax/tasaempresa.php?op=mostrar",{idtaxempamb : idtaxempamb}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idtaxempamb").val(data.idtaxempamb);
		$("#idtipotax").val(data.idtipotax);
		$("#idramotax").val(data.idramotax);
		$("#idcategoriatax").val(data.idcategoriatax);
		$("#tipotax").val(data.tipotax);
		$("#ramotax").val(data.ramotax);
		$("#categoriatax").val(data.categoriatax);
		$("#tax").val(data.tax);
 	});

}


//Función para desactivar registros
function desactivar(idtaxempamb)
{
	bootbox.confirm("¿Está Seguro de desactivar la tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/tasaempresa.php?op=desactivar", {idtaxempamb : idtaxempamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idtaxempamb)
{
	bootbox.confirm("¿Está Seguro de activar la tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/tasaempresa.php?op=activar", {idtaxempamb : idtaxempamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();