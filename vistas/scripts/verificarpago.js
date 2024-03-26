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
	$("#nombre").val("");
	$("#status").val("");
	$("#rif").val("");
	$("#codigo").val("");
	
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
            url: '../ajax/verificarpago.php?op=listar',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
	  })
  

}


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
			url: '../ajax/verificarpago.php?op=listarporfecha'+"&r=" + new Date().getTime(),
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




//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/bancos.php?op=guardaryeditar",
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

function conciliar(id)
{
	$.post("../ajax/verificarpago.php?op=conciliar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#id").val(data.id);
		$("#rfc").val(data.rfc);
		$("#name").val(data.name);
		$("#ctramite").val(data.ctramite);
		$("#fecha").val(data.fecha);
		$("#tramite").val(data.tramite);
		$("#ref").val(data.ref);
		$("#totliq").val(data.totliq);
		$("#mount").val(data.mount);
		$("#vfile").attr("src","../files/documentos/"+data.vfile);
		
 	});

}

function mostarvfile(id)
{
	$.post("../ajax/verificarpago.php?op=mostarvfile",{id : id}, function(data, status)
	{
		data = JSON.parse(data);		
		$("#capture2").attr("src","../files/documentos/"+data.vfile);
		
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