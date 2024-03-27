var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#row2").hide();
	$("#row3").hide();
	$("#row4").hide();
	$("#row5").hide();


	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	
}



$(document).on('change','#monto1', function()
    {

	bootbox.confirm("¿Quiere regitras otro Concepto?", function(result){
		if(result)
        {
        	$("#row2").show();
        }
	})
})

$(document).on('change','#monto2', function()
    {

	bootbox.confirm("¿Quiere regitras otro Concepto?", function(result){
		if(result)
        {
        	$("#row3").show();
        }
	})
})

$(document).on('change','#monto3', function()
    {

	bootbox.confirm("¿Quiere regitras otro Concepto?", function(result){
		if(result)
        {
        	$("#row4").show();
        }
	})
})

$(document).on('change','#monto4', function()
    {

	bootbox.confirm("¿Quiere regitras otro Concepto?", function(result){
		if(result)
        {
        	$("#row5").show();
        }
	})
})






function suma() {
  var add = 0;
  var valor1 = 0;

  // Recorremos todos los inputs con nombres que empiezan por "monto"
  for (let i = 0; i < 5; i++) {


    const inputName = `monto${i + 1}`; // Monto, Monto1, Monto2, etc.
    const inputValue = $(`input[name="${inputName}"]`).val();

    if (!isNaN(inputValue)) {
      add += Number(inputValue);
      if (add < 0) {
        add = add * -1;
      }

      valor1 = add; // valor1 = "$ " + add;
    }
  }


  $('#montotal').val(valor1);
}


//Función limpiar
function limpiar()
{
	$("#id").val("");
	$("#nombre").val("");
	$("#rif").val("");
	$("#fechapago").val("");
	$("#direccion").val("");
	$("#conceptopago1").val("");
	$("#monto1").val("");
	$("#conceptopago2").val("");
	$("#monto2").val("");
	$("#conceptopago3").val("");
	$("#monto3").val("");
	$("#conceptopago4").val("");
	$("#monto4").val("");
	$("#conceptopago5").val("");
	$("#monto5").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#montotal").val("");
	$("#formapago").val("");
	$("#row2").hide();
	$("#row3").hide();
	$("#row4").hide();
	$("#row5").hide();
	
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
            url: '../ajax/facturaaseo.php?op=listar',
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
		url: "../ajax/facturaaseo.php?op=guardaryeditar",
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
	$.post("../ajax/facturaaseo.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#id").val(data.id);
		$("#nombre").val(data.nombre);
		$("#status").val(data.status);
		$("#rif").val(data.rif);
		$("#codigo").val(data.codigo);
		
 	});

}


//Función para desactivar registros
function desactivar(id)
{
	bootbox.confirm("¿Está Seguro de desactivar el banco?", function(result){
		if(result)
        {
        	$.post("../ajax/facturaaseo.php?op=desactivar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id)
{
	bootbox.confirm("¿Está Seguro de activar el banco?", function(result){
		if(result)
        {
        	$.post("../ajax/facturaaseo.php?op=activar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();