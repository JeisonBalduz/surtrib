var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#imagenmuestra").hide();

	$.post("../ajax/pagoambiente.php?op=selectbanco", function(r){
		$("#idbanco").append(r);
		$('#idbanco').select2();

	



});

	
}


//Función limpiar
function limpiar()
{
	$("#monto").val("");
	$("#tipopago").val("");
	$("#referencia").val("");
	$("#fechapago").val("");
	$("#registro").val("");
	$("#idusuarioamb").val("");
	$("#idusuariosis").val("");
	$("#idbanco").val("");
	$("#fechaaprobacion").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idpagoamb").val("");
	
	
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
            url: '../ajax/pagoambiente.php?op=listar',
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
		url: "../ajax/pagoambiente.php?op=guardaryeditar",
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

function mostrar(idpagoamb)
{
	$.post("../ajax/pagoambiente.php?op=mostrar",{idpagoamb : idpagoamb}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#monto").val(data.monto);
		$("#tipopago").val(data.tipopago);
		$("#referencia").val(data.referencia);
		$("#fechapago").val(data.fechapago);
		$("#registro").val(data.registro);
		$("#idusuarioamb").val(data.$idusuarioamb);
		$("#idusuariosis").val(data.idusuariosis);
		$("#idbanco").val(data.idbanco);
		$("#direccionusuario").val(data.direccionusuario);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/documentos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#fechaaprobacion").val(data.fechaaprobacion);
		$("#idpagoamb").val(data.idpagoamb);
		$("#estado").val(data.estado);

 	});

}

//Función para desactivar registros
function desactivar(idpagoamb)
{
	bootbox.confirm("¿Está Seguro que quiere reversar pago?", function(result){
		if(result)
        {
        	$.post("../ajax/pagoambiente.php?op=desactivar", {idpagoamb : idpagoamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idpagoamb)
{
	bootbox.confirm("¿Está Seguro de confirmar el pago?", function(result){
		if(result)
        {
        	$.post("../ajax/pagoambiente.php?op=activar", {idpagoamb : idpagoamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();