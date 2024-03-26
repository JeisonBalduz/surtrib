var tabla;
var tabla2;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();
    $("#imagenactual").hide();

    $("#formulariopago2").on("submit", function (e) {
        guardaryeditar(e);
    });
    
}



function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
    

         $("#id").val("");
         $("#tributo").val("");
        $("#tramitev").val("");
        $("#tramite").val("");
        $("#idtramite").val("");
        $("#tramitedife").val("");
        $("#tramite2").val("");
        $("#tramitev2").val("");
        $("#tributo2").val("");
        $("#idtramite2").val("");
        $("#monto").val("");
        $("#referencia").val("");
        $("#imagen").val("");
        $("#imagenactual").val("");
        $("#imagenmuestra").val("");
        

        
   
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btn_notificarpago").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#resporteestadocuenta").hide();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
    limpiar();
}


function cancelarform2() {
    limpiar();
    tabla2.ajax.reload();
}

function readURL(input) {
    $("#imagenmuestra").show();
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        // Asignamos el atributo src a la tag de imagen
        $('#imagenmuestra').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // El listener va asignado al input
  $("#imagen").change(function() {
    readURL(this);
  });



function listar() {
    tabla = $("#tbllistado").DataTable({
        'pageLength': 25,
		"responsive": true,
		"autoWidth": false,
        "ordering": false,
        "orderData": false,
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
            url: '../ajax/notificarpago.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}

function listardiferido($tramite) {
   
    var tramite = $tramite;

    tabla2 = $("#tbllistado2").DataTable({
        'pageLength': 25,
		"responsive": true,
		"autoWidth": false,
        "info": false,
        "ordering": false,
        "paging": false,
        "Search": false,
        
		"language": {
			info: 'Vista _START_ a _END_ de _TOTAL_ registros',
			search: 'Buscar',
			previous: 'Previo',
			lengthMenu: 'Ver _MENU_ registro por pagina',
		},
	
		  "ajax": {
            url: '../ajax/notificarpago.php?op=listardiferido',
            type: "POST",
            data: {tramite: tramite},
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })

      table.destroy();
  
}

function listardiferido2($tramite)
{

    var tramite = $tramite;
	$.post("../ajax/notificarpago.php?op=listardiferido2",{tramite : tramite}, function(r)
	{
				
		$("#diferidos").html(r);
		
 	});

}


function guardaryeditar(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    
    var formData = new FormData($("#formulariopago2")[0]);

    $.ajax({
        url: "../ajax/notificarpago.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    $('#formulariopago').modal('toggle');
    limpiar();
    
}



function liquidar(tramite)
{
	$.post("../ajax/notificarpago.php?op=liquidar",{tramite : tramite}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#tramite").val(data.tramite);
        $("#tramitev").val(data.tramite);
        $("#tributo").val(data.idt);
        $("#idtramite").val(data.id);
        $("#tramitedife").val(data.tramite);
        $("#tramite2").val(data.tramite);
        $("#tramitev2").val(data.tramite);
        $("#tributo2").val(data.idt);
        $("#idtramite2").val(data.id);
        

 	});
    

}




init();