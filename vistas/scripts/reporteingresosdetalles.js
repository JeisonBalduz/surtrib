var tabla;
var tabla2;
//Funcion que se ejecuta al inicio


function reportedeingresos(){
	//mostrar();
  //  mostrartotal();
    var comodinbusqueda = $("#fechadia").val();
    var comodinbusqueda2 = $("#fechadia2").val();
  // alert("Reporte="+comodinbusqueda);//return;
   // $("#resportedeldia").show();

   if((comodinbusqueda!=""&&comodinbusqueda2!="")&&(comodinbusqueda<=comodinbusqueda2)){
     // alert("CUMPREN LA CONDICION");//return; 
    


   //  return false;

    tabla = $('#reportedeingresospartida').dataTable({
        "aProcessing": false, //Activamos el procesamiento del datatables
        "aServerSide": false, //Paginación y filtrado realizados por el servidor
		"paging": false,
        "lengthChange": false,
        "searching": false,
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
		dom: 'B', 
        buttons: [
            //'copyHtml5',
          //  'excelHtml5'
            //'pdf'
        ],
        "ajax": {
			url: '../ajax/ajaxingresos.php?op=listaringresos',
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
    reportedeingresoportributo();
  }
  else
    bootbox.alert("Error en Fechas");
    //alert();
}



function imprSelec(){
 // var ficha=(historial);
  var ventimp=window.open(' ','popimpr');
  
  $('#btn_Imprimir').hide();
  ventimp.document.write($('#resportedeldia').html());
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
  $('#btn_Imprimir').show();
  return false;
}

function reportedeingresoportributo(){
    //mostrar();
  //  mostrartotal();
    var comodinbusqueda = $("#fechadia").val();
    var comodinbusqueda2 = $("#fechadia2").val();
  // alert("Reporte="+comodinbusqueda);//return;
   // $("#resportedeldia").show();

   if((comodinbusqueda!=""&&comodinbusqueda2!="")&&(comodinbusqueda<=comodinbusqueda2)){
     // alert("CUMPREN LA CONDICION");//return; 
    


   //  return false;

    tabla2 = $('#reportedeingresoportributo').dataTable({
        "aProcessing": false, //Activamos el procesamiento del datatables
        "aServerSide": false, //Paginación y filtrado realizados por el servidor
        "paging": false,
        "lengthChange": false,
        "searching": false,
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
        dom: 'B', 
        buttons: [
            //'copyHtml5',
          //  'excelHtml5'
           // 'pdf'
        ],
        "ajax": {
            url: '../ajax/ajaxingresos.php?op=resumendeingresosdetalle',
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
   // reportedeldiaCoinciliado();
  }
  else
    bootbox.alert("Error en Fechas");
    //alert();
}
