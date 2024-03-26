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



// Vincular el manejador de eventos a las casillas de verificación
$("#displayTotal").on("change", mostrarMontoYSumar);

function mostrarMontoYSumar() {

  // Obtener todas las casillas de verificación con nombre "idcpdv[]" que estén activadas
  const checkedBoxes = $("input[name='idcpdv[]']:checked");

  // Inicializar el monto total a 0
  let totalAmount = 0;

  // Recorrer cada casilla de verificación activada
  checkedBoxes.each(function() {

    // Obtener la fila "tr" más cercana (asumiendo que la casilla está dentro de una fila de la tabla)
    const row = $(this).closest("tr");

    // Obtener la celda "td" con id "monto" dentro de la misma fila
    const montoCell = row.find("td#monto");

    // Verificar si la celda "monto" existe y contiene un valor numérico
    if (montoCell.length > 0 && !isNaN(montoCell.text())) {

      // Extraer el valor de "monto" como un número
      const monto = parseFloat(montoCell.text());

      // Agregar el monto al total
      totalAmount += monto;
    }
  });

  // Obtener el valor del input `saldo2`
  const saldo2 = parseFloat($("#saldo").val());

  // Restar la suma al valor del saldo
  const nuevoSaldo = saldo2 - totalAmount;

  // Mostrar alertas según el nuevo saldo
  if (nuevoSaldo < 0) {
    alert("El monto a conciliar es superior al saldo disponible.");
    $("#btnGuardar").hide();

  } else {
    // Mostrar el nuevo saldo en el input `saldo2`
    $("#saldo2").val(nuevoSaldo.toFixed(2));
    $("#btnGuardar").show();
  }

  // Mostrar el monto total en el input `sumas`
  $("#sumas").val(totalAmount.toFixed(2));


  if (totalAmount === 0) {
    alert("No ha seleccionado ningún monto para conciliar.");
    $("#btnGuardar").hide();
    return; // Detiene la ejecución de la función
    
  }
}


//Función limpiar
function limpiar()
{
	$("#id").val("");
	$("#nombre").val("");
	$("#status").val("");
	$("#rif").val("");
	$("#codigo").val("");
	$("#tramites").val("");
		$("#idconciliacion").val("");
		$("#refencia").val("");
		$("#fechad").val("");
		$("#amount").val("");
		$("#details").val("");
		$("#isused").val("");
		$("#saldo").val("");
		$("#formulariopago").val("");
		$("#rfc").val("");
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
            url: '../ajax/conciliarpago.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}


/*function listarporfecha(){
	//mostrar();
  //  mostrartotal();
    var comodinbusqueda = $("#fechadia").val();
    var comodinbusqueda2 = $("#fechadia2").val();
  // alert("Reporte="+comodinbusqueda);//return;
   // $("#resportedeldia").show();

   if((comodinbusqueda!=""&&comodinbusqueda2!="")&&(comodinbusqueda<=comodinbusqueda2)){
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
            url: '../ajax/conciliarpago.php?op=listarporfecha'+"&r=" + new Date().getTime(),
            data: {comodinbusqueda: comodinbusqueda,comodinbusqueda2: comodinbusqueda2},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  });
  }
  else
    bootbox.alert("Error en Fechas");

}*/

function listarporfecha(){
	//mostrar();
  //  mostrartotal();
    var comodinbusqueda = $("#fechadia").val();
    var comodinbusqueda2 = $("#fechadia2").val();
  // alert("Reporte="+comodinbusqueda);//return;
   // $("#resportedeldia").show();

   if((comodinbusqueda!=""&&comodinbusqueda2!="")&&(comodinbusqueda<=comodinbusqueda2)){
     // alert("CUMPREN LA CONDICION");//return; 
    


   //  return false;

    tabla = $('#tbllistado').dataTable({
        "aProcessing": false, //Activamos el procesamiento del datatables
        "aServerSide": false, //Paginación y filtrado realizados por el servidor
		"paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true,
        "responsive": true,

        "language": {
			info: 'Vista _START_ a _END_ de _TOTAL_ registros',
			search: 'Buscar',
			previous: 'Previo',
			lengthMenu: 'Ver _MENU_ registro por pagina',
		},
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
			url: '../ajax/conciliarpago.php?op=listarporfecha'+"&r=" + new Date().getTime(),
			data: {comodinbusqueda: comodinbusqueda,comodinbusqueda2: comodinbusqueda2},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
    
        "bDestroy": true,
        "iDisplayLength": 50, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
    
  }
  else
    bootbox.alert("Error en Fechas");
    //alert();
}




function tramitescontri() {
  
	var rfc= $("#rfc").val();

    tabla = $("#tbllistado2").DataTable({
		  "ajax": {
            url: '../ajax/conciliarpago.php?op=tramitescontri',
			data: {rfc: rfc},
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
		url: "../ajax/conciliarpago.php?op=guardaryeditar",
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
	$('#formulariopago').modal('toggle');
	limpiar();
}


function mostrar(id)
{
	$.post("../ajax/conciliarpago.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#idconciliacion").val(data.id);
		$("#refencia").val(data.refencia);
		$("#fechad").val(data.fechad);
		$("#amount").val(data.amount);
		$("#details").val(data.details);
		$("#isused").val(data.isused);
		$("#saldo").val(data.saldo);
		
 	});

 	$("#btnGuardar").hide();
 	$("#tablal").hide();
 	$("#cal").hide();
 

}

function mostarvfile(id)

{
	$.post("../ajax/verificarpago.php?op=mostarvfile",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#capture2").attr("src","../files/documentos/"+data.vfile);
		
 	});

}

function tramiteporpagar()
{
$("#tablal").show();
$("#cal").show();

	var rfc = $("#rfc").val();
	$.post("../ajax/conciliarpago.php?op=tramiteporpagar",{rfc : rfc}, function(r)
	{
				
		$("#tramites").html(r);
		
 	});

}







//Función para desactivar registros
function conciliar2(id,mount)
{
	bootbox.confirm("¿Está Seguro de Conciliar este Pago ?", function(result){
		if(result)
        {
        	$.post("../ajax/verificarpago.php?op=conciliar", {id : id, mount:mount}, function(e){
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
        	$.post("../ajax/bancos.php?op=activar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();