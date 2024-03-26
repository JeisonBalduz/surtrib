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
/*
$(document).on('change','#ingresobruto1', function()
    {
		sumartotal();
	
})

$(document).on('change','#ingresobruto2', function()
    {
		sumartotal();
	
})

$(document).on('change','#ingresobruto3', function()
    {
		sumartotal();
	
})
$(document).on('change','#ingresobruto4', function()
    {
		sumartotal();
	
})
*/

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
$("#documento").val("");
	
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
            url: '../ajax/anticipo.php?op=listar',
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
		url: "../ajax/anticipo.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(data)
	    {                    
	          bootbox.alert(data);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
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

function verificaciones()
{   
  $.ajax({
		url: "../ajax/anticipo.php?op=consultarultimopago",
	    type: "POST",
	    data: "",
	    contentType: false,
	    processData: false,

	    success: function(data)
	    {  // alert(data); return;   
	    //{"ul_pago":"202312","ultilo_ano_pago":2023,"ultilo_mes_pago":12,"dia_actual":13,"mes_actual":1,"ano_actual":2024}
          var json = JSON.parse(data);
                 if (json) {
                 	if(json.ul_pago==null) {
                 	 	mostraractividades();return false;
                 	}
                 	mostraractividades();return false;
                 	if(json.ultilo_ano_pago<json.ano_actual) {
                     
                    	switch (json.ano_actual-json.ultilo_ano_pago) {
                          case 1:
                            if (json.ultilo_mes_pago>json.mes_actual){

                            	if((json.ultilo_mes_pago-json.mes_actual)==11){
                                   mostraractividades();return false;
                            	}
                            	else{
                            		bootbox.alert("Estimado Contribuyente Usted posee Deudas de Anticipo de Meses Anteriores por favor Diríjase a las Oficinas de Hacienda del Municipio Libertador");return false;
                            	}

                            }
                          break;
                          default:
                          	bootbox.alert("Estimado Contribuyente Usted posee Deudas de Anticipo de Meses Anteriores por favor Diríjase a las Oficinas de Hacienda del Municipio Libertador");return false;
                          	break;

                 		}
                      	
                        
                 	}
                 	else if(json.ultilo_ano_pago==json.ano_actual) {
                      	
                        switch (json.mes_actual-json.ultilo_mes_pago) {
                         case  0:
                           bootbox.alert("Ya Cancelo el Mes actual");return false;	
                          break;
                         case  1:
                           mostraractividades();return false;	
                          break;
                          default:
                          	bootbox.alert("Estimado Contribuyente Usted posee Deudas de Anticipo de Meses Anteriores por favor Diríjase a las Oficinas de Hacienda del Municipio Libertador");return false;
                          	break;
                        }
                      	
                 
                 	}

                 }
                 else{ //CUANDO NO POSEE REGISTRO
                 	mostraractividades();return false;
                 
                 }

	    	
	    }

	});



}


function mostraractividades()
{
	$.post("../ajax/anticipo.php?op=mostrar",function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#rfc").val(data.rfc);
		$("#name").val(data.name);
		$("#rif").val(data.rif);

 	});
 	$.post("../ajax/anticipo.php?op=mostraractividades",function(r){
	        $("#actv").html(r);
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
/*
function sumartotal()
{
	var a = document.getElementById("ingresobruto1");
	var b = document.getElementById("ingresobruto2");
	var c = document.getElementById("ingresobruto3");
	
	var montotal = document.getElementById("montotal");

	var va = parseFloat(a.value) || 0;
	var vb = parseFloat(b.value) || 0;
	var vc = parseFloat(c.value) || 0;
	

	var suma = va +vb+vc;

	montotal.value =suma;

}

*/
function suma(){
  var add = 0;
  var valor1=0;
  //contador = 1;
  $('.cla').each(function() {
    if (!isNaN($(this).val())) {
      add += Number($(this).val());
      if (add < 0) {
        add = add * -1;
      }

      valor1 =add;//valor1 = "$ " + add;
    }
  });
  $('#montotal').val(valor1);
}
init();