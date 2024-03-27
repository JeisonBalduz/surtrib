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



function insertartramitemv()
{
	var  idtc= $('#idtc').val();
	var  id= $('#idttc').val();
	var rfc = $('#rfc').val();
	var metros = $('#metros').val();

	bootbox.confirm("¿Está Seguro de declarar el tasa?", function(result){
		if(result)
        {
        	$.post("../ajax/liquidarcatastro.php?op=insertartramitemv", {id: id, rfc : rfc,idtc : idtc, metros : metros}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})

        $('#formulario2').modal('toggle');
	
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
	$("#idtvehiculo").val("");

	
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
            url: '../ajax/liquidarcatastro.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}




function mostrar(id)
{
	$.post("../ajax/liquidarcatastro.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
	
		
		$("#idttc").val(data.id);
		$("#nombre").val(data.name);
		$("#rif").val(data.rif);
		$("#rfc").val(data.rfc);
		$("#detallle").val(data.detalle);
		$("#idtc").val(data.idtc);
		$("#metros").val(data.metros);
		$("#rfc2").val(data.rfc);
		$("#iduser").val(data.iduser);
		$("#idtc").val(data.idtc);
		$("#detalle").val(data.detalle);
		
		
		
		
 	});


}



init();