var tabla;
var tabla2;
var Id_Inmueble;
//Funcion que se ejecuta al inicio

function init() {

    mostrarform(false);
    listar();


    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
	
}

function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
    $("#Id_Inm").val("");
        $("#Ficha_Catastral").val("");
        $("#Tipo_Documento").val(-1);
        $("#N_Documento").val("");
        $("#Folio").val("");
        $("#Tomo").val("");
        $("#Protocolo").val("");
        $("#D_Fecha").val("");
        $("#Area_M").val("");
        $("#Precio").val("");
        $("#CT_Est").val(-1);
        $("#Ano_Avaluo").val(-1);

        $("#Direccion_E1").val("");
        $("#Direccion_D1").val("");
        $("#Direccion_E2").val("");
        $("#Direccion_D2").val("");
        $("#Direccion_Ext_D2").val("");
        $("#Direccion_E3").val("");
        $("#Direccion_D3").val("");
        $("#Direccion_E4").val("");
        $("#Direccion_D4").val("");
         $("#Id_Estado").val(-1);

        /*if (data.Id_Estado!=''){
         
        //  gerMunicipio(data.Id_Estado,data.Id_Municipio);
          
          //  $("#Id_Municipio").val(data.Id_Municipio);
          //gerParroquia(IdCiudad,idparroquia)
         // gerParroquia(data.Id_Municipio,data.Id_Parroquia);
         // $("#Id_Parroquia").val(data.Id_Parroquia);
        
        }   */
        
        
        $("#Referencia").val("");


        $("#Comunidad").val("");
        $("#CT_Top").val("");
        $("#CT_Form").val("");
        $("#CT_Tene").val("");
        $("#CT_Uso").val("");
        $("#CT_Dim_Fre").val("");
        $("#CT_Dim_Fon").val("");
        $("#CT_Dim_Are").val("");
        $("#CT_Clas").val("-1");
        $("#CT_Alic").val("-1");
        $("#Observa").val("");
    $("#comodinbusqueda").val("");
}

//Mostrar Formulario

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform() {
    limpiar();
    mostrarform(false);
}


function listar() {
	var query="&r=" + new Date().getTime()+";";
    var comodinbusqueda = $("#comodinbusqueda").val();

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
		"paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
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
			url: '../ajax/ajaxInmueble.php?op=listar'+query,
			
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
}

function listar2() {
	var query="&r=" + new Date().getTime()+";";
    var comodinbusqueda = $("#comodinbusqueda").val();

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
		"paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
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
			url: '../ajax/ajaxInmueble.php?op=listar2'+query,
			data: {comodinbusqueda: comodinbusqueda},
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
}


function listarCostruccion(IdInm) { //alert("La Construccion="+IdInm);
      var query="&r=" + new Date().getTime()+";";
    //var comodinbusqueda = $("#comodinbusqueda").val();

     tabla2 = $('#tbconstruccion').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            info: 'Vista _START_ a _END_ de _TOTAL_ registros',
           // search: 'Buscar',
            previous: 'Previo',
            lengthMenu: 'Ver _MENU_ registro por pagina',
        },
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/ajaxInmueble.php?op=opcionesinmueble&tipoopcion=construccionlistar&Id_Inm='+IdInm+query,
            
            type: "POST",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
        "order": [
            [2, "asc"]
        ] //Ordenar (columna,orden)
    });
}


function guardaryeditar(e) 
{   var query="&r=" + new Date().getTime()+";";
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    $('[data-name="Area_M"]').val( $('[data-name="Area_M"]').val().replace(',', '.'));
    $('[data-name="Precio"]').val( $('[data-name="Precio"]').val().replace(',', '.'));
   $('[data-name="CT_Dim_Fre"]').val( $('[data-name="CT_Dim_Fre"]').val().replace(',', '.'));
    $('[data-name="CT_Dim_Are"]').val($('[data-name="CT_Dim_Are"]').val().replace(',', '.'));
    $('[data-name="CT_Dim_Fon"]').val($('[data-name="CT_Dim_Fon"]').val().replace(',', '.'));
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ajaxInmueble.php?op=guardaryeditar"+query,
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
    limpiar();
}

function mostrar(Id_Inm) {
    var query="&r=" + new Date().getTime()+";";
    $.post("../ajax/ajaxInmueble.php?op=mostrar"+query, {
        Id_Inm: Id_Inm
    }, function (data, status) { //alert("Hola");
        data = JSON.parse(data);
        mostrarform(true);
        
       
		
        $("#Id_Inm").val(data.Id_Inm);
        $("#Ficha_Catastral").val(data.Ficha_Catastral);
		$("#Tipo_Documento").val(data.Tipo_Documento);
		$("#N_Documento").val(data.N_Documento);
        $("#Folio").val(data.Folio);
		$("#Tomo").val(data.Tomo);
        $("#Protocolo").val(data.Protocolo);
        $("#D_Fecha").val(data.D_Fecha);
        $("#Area_M").val(data.Area_M);
	    $("#Precio").val(data.Precio);
        $("#CT_Est").val(data.CT_Estatus);
	    $("#Ano_Avaluo").val(data.Ano_Avaluo);
        
         $('[data-name="Area_M"]').val( $('[data-name="Area_M"]').val().replace(',', '.'));
    $('[data-name="Precio"]').val( $('[data-name="Precio"]').val().replace(',', '.'));
   $('[data-name="CT_Dim_Fre"]').val( $('[data-name="CT_Dim_Fre"]').val().replace(',', '.'));
    $('[data-name="CT_Dim_Are"]').val($('[data-name="CT_Dim_Are"]').val().replace(',', '.'));
    $('[data-name="CT_Dim_Fon"]').val($('[data-name="CT_Dim_Fon"]').val().replace(',', '.'));

	    $("#Direccion_E1").val(data.Direccion_E1);
		$("#Direccion_D1").val(data.Direccion_D1);
        $("#Direccion_E2").val(data.Direccion_E2);
		$("#Direccion_D2").val(data.Direccion_D2);
        $("#Direccion_Ext_D2").val(data.Direccion_Ext_D2);
		$("#Direccion_E3").val(data.Direccion_E3);
		$("#Direccion_D3").val(data.Direccion_D3);
		$("#Direccion_E4").val(data.Direccion_E4);
		$("#Direccion_D4").val(data.Direccion_D4);
		 $("#Id_Estado").val(data.Id_Estado);

        if (data.Id_Estado!=''){
         
          gerMunicipio(data.Id_Estado,data.Id_Municipio);
          
          //  $("#Id_Municipio").val(data.Id_Municipio);/****************/
          //gerParroquia(IdCiudad,idparroquia)
          gerParroquia(data.Id_Municipio,data.Id_Parroquia);
         // $("#Id_Parroquia").val(data.Id_Parroquia);
        
        }
        
		
        $("#Referencia").val(data.Referencia);


	    $("#Comunidad").val(data.Comunidad);
	    $("#CT_Top").val(data.CT_Top);
		$("#CT_Form").val(data.CT_Form);
        $("#CT_Tene").val(data.CT_Tene);
		$("#CT_Uso").val(data.CT_Uso);
        $("#CT_Dim_Fre").val(data.CT_Dim_Fre);
        $("#CT_Dim_Fon").val(data.CT_Dim_Fon);
        $("#CT_Dim_Are").val(data.CT_Dim_Are);
        $("#CT_Clas").val(data.CT_Clas);
        $("#CT_Alic").val(data.CT_Alic);
        $("#Observa").val(data.Observa);  
        Id_Inmueble=Id_Inm;
        listarCostruccion(Id_Inm);    
    })
}

//Función para desactivar registros
function desactivar(rfc) {
    var query="&r=" + new Date().getTime()+";";
    bootbox.confirm("¿Está seguro de desactivar al Contribuyente?", function (result) {
        if (result) {
            $.post("../ajax/contri.php?op=desactivar"+query, {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(rfc) {
    var query="&r=" + new Date().getTime()+";";
    bootbox.confirm("¿Está seguro de activar al Contribuyente?", function (result) {
        if (result) {
            $.post("../ajax/contri.php?op=activar"+query, {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}
$(document).on("click", "#btnMyTest001", function (e) { 
    var Id_Inm=$(this).attr("data-Id_Inm");
    var query="&r=" + new Date().getTime()+";";

    // $('#myModal #Ficha_Catastral').attr("html", $(this).attr("data-Ficha_Catastral"));
  /*  $('#Ficha_Catastral').html(""+$(this).attr("data-Ficha_Catastral")+"");
    $('#T_Documento').html(""+$(this).attr("data-Tipo_Documento")+"");
    $('#N_Documento').html(""+$(this).attr("data-N_Documento")+"");
    $('#Folio').html(""+$(this).attr("data-Folio")+"");
    $('#Tomo').html(""+$(this).attr("data-Tomo")+"");
    $('#Protocolo').html(""+$(this).attr("data-Protocolo")+"");
    $('#D_Fecha').html(""+$(this).attr("data-D_Fecha")+"");
    $('#Area_M').html(""+$(this).attr("data-Area_M")+"");
    $('#Precio').html(""+$(this).attr("data-Precio")+"");
     $('#Anio_Avaluo').html(""+$(this).attr("data-Ano_Avaluo")+"");
     $('#CT_Tene').html(""+$(this).attr("data-CT_Tene")+"");
     $('#CT_Uso').html(""+$(this).attr("data-CT_Uso")+"");
     $('#CT_Estatus').html(""+$(this).attr("data-CT_Estatus")+"");
     $('#CT_Clas').html(""+$(this).attr("data-CT_Clas")+"");
     $('#CT_Dim_Fre').html(""+$(this).attr("data-CT_Dim_Fre")+"");
     $('#CT_Dim_Fon').html(""+$(this).attr("data-CT_Dim_Fon")+"");
     $('#CT_Dim_Are').html(""+$(this).attr("data-CT_Dim_Are")+"");
     $('#CT_Alic').html(""+$(this).attr("data-CT_Alic")+"");*/
    $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Id_Inm: Id_Inm,
                tipoopcion:"construccion"
            }, function (e) {
               // alert("Hola="+e);
              $('.modal-body').html(e);

            });

 });
$(document).on("click", "#btnMyTest002", function (e) { 
    var Id_Inm=$(this).attr("data-Id_Inm");
    var Id_Const=$(this).attr("data-Id_Const");
    var query="&r=" + new Date().getTime()+";";
      $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Id_Inm: Id_Inm,
                Id_Const:Id_Const,
                tipoopcion:"construccionedit"
            }, function (e) {
               // alert("Hola="+e);
              $('.modal-body').html(e);

            });
 });   
function EditCinstruccion(Id_Inm,Id_Const){//
   //  alert("Id_Const="+Id_Const);
   var query="&r=" + new Date().getTime()+";";
     $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Id_Inm: Id_Inm,
                Id_Const:Id_Const,
                tipoopcion:"construccionedit"
            }, function (e) {
               // alert("Hola="+e);
              $('.modal-body').html(e);

            });

   }
function gerMunicipio(IdEstado,idmunicipio){//
    // alert("IdEstado="+IdEstado);
   var query="&r=" + new Date().getTime()+";";
    $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Id_Estado:IdEstado,
               tipoopcion:"Municipio",
               id_municipio:idmunicipio
            }, function (e) {
               // alert("Hola="+e);
              $('#Id_Municipio').html(e);
             // $('#Municipio').disabled
              $( "#Id_Municipio" ).prop( "disabled",false);
              gerCiudad(IdEstado,'');


            });

   }
 function gerCiudad(IdEstado,idciudad){//
   var query="&r=" + new Date().getTime()+";";
    $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Id_Estado:IdEstado,
               tipoopcion:"Ciudad",
               id_ciudad:idciudad
            }, function (e) {
               // alert("Hola="+e);
              $('#Ciudad').html(e);
              $( "#Ciudad" ).prop( "disabled",false);
            });

   }
   function gerParroquia(Id_municipio,idparroquia){//
   var query="&r=" + new Date().getTime()+";";
    $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
                Idmunicipio:Id_municipio,
               tipoopcion:"Parroquia",
               id_parroquia:idparroquia
            }, function (e){
               // alert("Hola="+e);
              $('#Id_Parroquia').html(e);
              $( "#Id_Parroquia" ).prop("disabled",false);
            });

   }
   

init();
$(document).ready(function(){ 
  $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

    $('[data-toggle="tooltip"]').tooltip();

$("input[data-name='CT_Dim_Fre']").change(function() {
      if ($("input[data-name='CT_Dim_Fre']").val() != '' && $("input[data-name='CT_Dim_Fon']").val() != '') {
        $("input[data-name='CT_Dim_Are']").val(parseFloat($("input[data-name='CT_Dim_Fre']").val().replace(',', '.')) * parseFloat($("input[data-name='CT_Dim_Fon']").val().replace(',', '.')) + ''.replace('.', ','));
       // $("input[data-name='CT_Dim_Are']").val(parseFloat($("input[data-name='CT_Dim_Are']").val()).toFixed(2).replace('.', ','));
        $("input[data-name='CT_Dim_Are']").trigger("change");
      }
    });

    $("input[data-name='CT_Dim_Fon']").change(function() {
      if ($("input[data-name='CT_Dim_Fre']").val() != '' && $("input[data-name='CT_Dim_Fon']").val() != '') {
        $("input[data-name='CT_Dim_Are']").val(parseFloat($("input[data-name='CT_Dim_Fre']").val().replace(',', '.')) * parseFloat($("input[data-name='CT_Dim_Fon']").val().replace(',', '.')));
       // $("input[data-name='CT_Dim_Are']").val(parseFloat($("input[data-name='CT_Dim_Are']").val()).toFixed(2).replace('.', ','));
        $("input[data-name='CT_Dim_Are']").trigger("change");
      }
    });

$('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      //  this.value = this.value.replace(/[^0-9,]/g, '').replace(/,/g, '.');
      });






});

function NumCheck2(e, field) {

  key = e.keyCode ? e.keyCode : e.which

  // backspace

  if (key == 8) return true

  // 0-9

  if (key > 47 && key < 58) {

    if (field.value == "") return true

    regexp = /.[0-9]{2}$/

    return !(regexp.test(field.value))

  }

  // .

  if (key == 46) {

    if (field.value == "") return false

    regexp = /^[0-9]+$/

    return regexp.test(field.value)

  }

  // other key

  return false

 

}
function NumCheck(e, id) {

     //PARA LLAMARLO EN EL OBJETO ---> onkeypress="solo_JQdecimal(this.id)"



     // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46

     var field = $(id);

     key = e.keyCode ? e.keyCode : e.which;

 

     if (key == 8) return true;

     if (key > 47 && key < 58) {

       if (field.val() === "") return true;

       var existePto = (/[.]/).test(field.val());

       if (existePto === false){

           regexp = /.[0-9]{10}$/; //PARTE ENTERA 10

       }

       else {

         regexp = /.[0-9]{2}$/; //PARTE DECIMAL2

       }

       return !(regexp.test(field.val()));

     }

     if (key == 46) {

       if (field.val() === "") return false;

       regexp = /^[0-9]+$/;

       return regexp.test(field.val());

     }

     return false;

 

}
  $(document).on("click", "a.consulta", function (e) { 
   // var href=window.location+"/"+$(this).attr("href"); 
  //  alert("Hola="+this.href); return false;
  //  var Id_Const=$(this).attr("data-Id_Const");
    var query="&r=" + new Date().getTime()+";";
   /* 
      $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
         $('#contenidoPopup').load(this.href+query, function(){
            $(this).fadeIn();
          });
      */
  //  var href=$(this).attr("href");
    
          
          var Id_Inm_Cons=$(this).attr("data-Id_Const");
        //  alert("Hola="+Id_Inm_Cons); return false;
   $.post("../ajax/ajaxInmueble.php?op=opcionesinmueble"+query, {
              // op:"opcionesinmueble",
               tipoopcion:"construccionedit",
               Id_Const:Id_Inm_Cons
            }, function (e) {
              //  alert("Hola="+e);
             // $('#Ciudad').html(e);
              //$( "#Ciudad" ).prop( "disabled",false);
               /* bootbox.alert({
                                message: ''+e,
                                size: 'extra-large'
                                });*/



            bootbox.confirm({
                                message: ''+e,
                                size: 'extra-large',
                                buttons: {
                                confirm: {
                                label: 'Guardar',
                                className: 'btn-success'
                                },
                                cancel: {
                                label: 'Cancelar',
                                className: 'btn-danger'
                                }
                                },
                                callback: function (result) {
                                    if (result){
                                        guardarConstruccion();

                                        //tabla2.ajax.reload();
                                       // alert("Hola");
                                    }
                               // console.log('This was logged in the callback: ' + result);
                                }
                                });


          });




      return false;
     
 });



  /*
function yenarcombo(){
var d = new Date();
  var ano = $("#Ano_Avaluo");
      ano.append("<option value=''>Despliegue para Seleccionar</option>");

      anoactual=d.getFullYear();
      mesactual=d.getMonth()+1;//Get the month as a number (0-11)
      //alert("mes actual="+mesactual);
  for (var i = d.getFullYear(); i >= d.getFullYear()-20; i--) {
         ano.append("<option value=\"" + i + "\">" + i + "</option>");
      }
} 
$(document).ready(function(){
  $('a.consulta').click(function(){ // alert("fgdfgdfg");
        var query="?r=" + new Date().getTime()+";";
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
         $('#contenidoPopup').load(this.href, function(){
            $(this).fadeIn();
          });
        return false;
    });
    
    $('#close').click(function(){
        $('#popup').fadeOut('slow');
        $('.popup-overlay').fadeOut('slow');
        return false;
    });

    $('[data-toggle="tooltip"]').tooltip();
});*/
//yenarcombo();
