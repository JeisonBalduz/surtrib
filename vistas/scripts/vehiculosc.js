var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listarcon();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});

	/*$.post("../ajax/vehiculos.php?op=cargarmarca", function(r){
		$('#marca').append('<option value="" selected>Seleccione una Marca</option>'); 
		$('#marca').append(r);
		$('#marca').select2();
		$('#marca2').append('<option value="" selected>Seleccione una Marca</option>'); 
		$('#marca2').append(r);
		$('#marca2').select2();
	});*/
	$('#marca').select2();
   // $('#marca2').select2();
	$.post("../ajax/vehiculos.php?op=mostrartaxveh", function(r){
		$("#idtvehiculo").append('<option value="" selected>Seleccione una opción</option>'); 
		$("#idtvehiculo").append(r);
		$('#idtvehiculo').select2();
	});

}



function insertartramitemv()
{
	var idtvehiculo = $('#idt').val();
	var idv = $('#idvehiculo').val();
	var rfc2 = $('#rfc5').val();
	var idusuario2 = $('#idusuario').val();



	bootbox.confirm("¿Está Seguro de declarar el vehiculo?", function(result){
		if(result)
        {
        	$.post("../ajax/vehiculos.php?op=insertartramitemv", {rfc2 : rfc2,idtvehiculo : idtvehiculo, idv : idv, idusuario2 : idusuario2}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})

        $('#formulario2').modal('toggle');
		limpiar();
	
	
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
	$("#idtvehiculo2").val("");


	
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

function listarcon() {
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
            url: '../ajax/vehiculos.php?op=listarcon',
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
		url: "../ajax/vehiculos.php?op=guardaryeditar",
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
    $.post("../ajax/vehiculos.php?op=cargarmarca", function(r){
		$("#marca").append('<option value="" selected>Seleccione una Marca</option>'); 
		$("#marca").append(r);
		$('#marca').select2();
	});


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

function consultarplaca(valor)
{  
	
	
	if(valor!=""){ 
	$.post("../ajax/vehiculos.php?op=consultarplaca",{licenseplate : valor}, function(data, status)
	{
		
		var json = JSON.parse(data);	
		if (json){
			if(json.placa==1){
				bootbox.alert("Esta Registrada esa Placa");
                $("#licenseplate").val("");$('#licenseplate').focus();
               		return false;
			} 
                 
		}
		
 	});
 	}
   return false;
}

function consultarplaca2(valor)
{  if(valor!=""){ 
	$.post("../ajax/vehiculos.php?op=consultarplaca",{licenseplate : valor}, function(data, status)
	{
		
		var json = JSON.parse(data);	
		if (json){
			if(json.placa==1){
				bootbox.alert("Esta Registrada esa Placa");
                $("#placa").val("");$('#placa').focus();
               		return false;
			} 
                 
		}
		
 	});
 	}
   return false;
}


function declararvehiculo(id)
{
	$.post("../ajax/vehiculos.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
	
		
		$("#idvehiculo").val(data.idvehiculo);
		$("#detalle").val(data.detalle);
		$("#idtv").val(data.idtv);
		$("#idt").val(data.idt);
		$("#rfc2").val(data.rfc);
		$("#marca2").val(data.marca);
		$("#rif2").val(data.rif);
		$("#modelos2").val(data.modelos);
		$("#anio2").val(data.anio);
		$("#idtvehiculo2").val(data.idtvehiculo);
		$('#idtvehiculo2').select2();
		$("#fechacompra2").val(data.puestos);
		$("#puestos2").val(data.puestos);
		$("#pesos2").val(data.pesos);
		$("#idusuario").val(data.idusuario);
		$("#nombreusuario").val(data.nombreusuario);
		$("#rfc5").val(data.rfc);
		$("#placa").val(data.licenseplate);
		document.getElementById('rfc3').innerHTML = data.rfc;
		document.getElementById('idv2').innerHTML = data.idv;
		
		
		
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