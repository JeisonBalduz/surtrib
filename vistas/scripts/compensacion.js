var tabla;
var tabla2;
//Funcion que se ejecuta al inicio


function compensacion(){
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
           { extend:'excelHtml5',
          title:'REPORTE DE FONDO DE COMPENSACION INTERTERRITORIAL '+$("#fechadia").val().split("-")[2] +'/' +$("#fechadia").val().split("-")[1] +'/'+$("#fechadia").val().split("-")[0]+' ----'+ $("#fechadia2").val().split("-")[2] +'/' +$("#fechadia2").val().split("-")[1] +'/'+$("#fechadia2").val().split("-")[0]}
            //'pdf'
        ],
        "ajax": {
			url: '../ajax/ajaxingresos.php?op=compensacion',
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



function imprSelec(){
 // var ficha=(historial);
 var idfecha=$("#fechadia").val().split("-")[2] +'/' +$("#fechadia").val().split("-")[1] +'/'+$("#fechadia").val().split("-")[0]+' ----'+ $("#fechadia2").val().split("-")[2] +'/' +$("#fechadia2").val().split("-")[1] +'/'+$("#fechadia2").val().split("-")[0];
    idfecha=$("#idfecha").html()+' '+idfecha;
 $("#idfecha").html(""+idfecha);
 
  var ventimp=window.open(' ','popimpr');
  
  $('#btn_Imprimir').hide();
  ventimp.document.write($('#resportedeldia').html());
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
  $('#btn_Imprimir').show();
  $("#idfecha").html("REPORTE DE FONDO DE COMPENSACION INTERTERRITORIAL");
  return false;
}
