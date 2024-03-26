var tabla;
var tabla2;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$('.select2').select2()
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $("#formato-factura").hide();
	$("#imagenmuestra").hide();
	$("#lista").hide();
}

$("#tipocontri").change(function(){//Inicio
		var valor = $("#tipocontri").val();
			if(valor == ""){
				$("#contribuyente").empty();
				bootbox.alert("Debe sleccionar el tipo de servicio a cobrar")
		}else {
			if(valor == 1){
				$("#contribuyente").empty();
				$.post("../ajax/caja.php?op=select", function(r){
					$("#contribuyente").append(r);
					$('#contribuyente').select2();
				});
			 }else {
				$("#contribuyente").empty();
				$.post("../ajax/caja.php?op=select2", function(r){
					$("#contribuyente").append(r);
					$('#contribuyente').select2();
				});
		 }
		}


//FIN
})

function mostrarmoneda()
{  var idmoneda = 8
	$.post("../ajax/moneda.php?op=mostrar",{idmoneda : idmoneda}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
		$("#idmoneda").val(data.idmoneda);
		
		$("#codigomoneda").val(data.codigomoneda);
		$("#symbol_left").val(data.symbol_left);
		$("#symbol_right").val(data.symbol_right);
		$("#decimal_point").val(data.decimal_point);
		$("#thousands_point").val(data.thousands_point);
		$("#decimal_places").val(data.decimal_places);
		$("#value").val(data.value);
		$("#mcref").val(data.mcref);
		$("#principal").val(data.principal);
		$("#last_updated").val(data.last_updated);
		var moneda = data.value;
		var taxpagp= $("#tasa").val();
		var prueba = moneda * taxpagp
		var pruebar=prueba.toFixed(2);
		$("#nombremoneda").val(pruebar);
		bootbox.alert("Preuba de"+pruebar)
 	});

}

function calcularDiferenciaMeses() {
	var f= $("#ulmepago").val();
    var fecha1 = new Date(f)
	var fecha2 = new Date()

    if (!(fecha1 instanceof Date) || !(fecha2 instanceof Date)) {
        throw TypeError('Ambos argumentos deben ser objetos de tipo fecha (Date).');
    }

    let meses = (fecha2.getFullYear() - fecha1.getFullYear()) * 12;
    meses -= fecha1.getMonth();
    meses += fecha2.getMonth();
	bootbox.alert("PRIEBAJJSJDJ"+meses);
	$("#meses").val(meses);
	

	
}

function listMonthsBackwards() {
	var numberOfMonths= $("#meses").val();
  let months = [];
  let date = new Date();
  for (let i = 0; i < numberOfMonths; i++) {
    let month = new Intl.DateTimeFormat('es', { month: 'long' }).format(date);
    let year = date.getFullYear();
    months.push(`${month} ${year}`);
    date.setMonth(date.getMonth() - 1);
  }
  bootbox.alert("PRIEBAJJSJDJ"+months)
  $("#dueda").html(months);
  $('#dueda').select2({data: months});
  

}

function mesespago() {
	var numberOfMonths= $("#meses").val();
  let months = [];
  let date = new Date();
  for (let i = 0; i < numberOfMonths; i++) {
    let month = new Intl.DateTimeFormat('es', { month: 'long' }).format(date);
    let year = date.getFullYear();
    months.push(`${month} ${year}`);
    date.setMonth(date.getMonth() - 1);
  }
  bootbox.alert("PRIEBAJJSJDJ"+months)
  
  return months;

}

function pruebaretun() { 
	$("#formato-factura").show();
	let factura = [];
	let pru = mesespago();
	var desc= $("#prueba").val();
	var valormeses= $("#nombremoneda").val();
	var totalm= $("#nombremoneda").val();
	var diezmomes= valormeses*0.1;
	var diesmomes2= diezmomes.toFixed(2)
	var contadoritem = 1
	var contadormeses= 0
	for (let i = 0; i < pru.length; i++){
		factura.push(`${pru[i]}`, valormeses, diesmomes2)
		
	}
	var tabladatos = document.getElementById('tabla-factura');
	for (let i = 0; i < pru.length; i++){
		tabladatos.innerHTML += "<td>" + contadoritem++ + "</td>" + "<td>" + desc + "</td>" + "<td>" + pru[i] + "</td>" + "<td>" + valormeses + "</td>" + "<td><button type='button' class='btn btn-primary float-right' style='margin-right: 5px;'> +v</button></td>";
		tabladatos.innerHTML += "<td>" + contadoritem++ + "</td>" +"<td> DISP. Final" + desc + "</td>" + "<td>" + pru[i] + "</td>" + "<td>" + diesmomes2 + "</td>";
		contadormeses++
	}
     var total=contadormeses*valormeses
	bootbox.alert("La prueba es " + contadormeses+ "por " + valormeses + "es igaul a "+ total )
	$("#totalfactura").val(total);
}








$("#contribuyente").change(function()
    {
		var rifbusqueda= $("#contribuyente").val();
			$.ajax({
			   data:{rifbusqueda: rifbusqueda},
			   url:   '../ajax/caja.php?op=selectInmueble',
			   type:  'post',
			   beforeSend: function () { },
			   success:  function (response) { 
				   $("#inmueble").empty();
				   $("#inmueble").append('<option value="" selected>Seleccione una opción</option>');                 	
				   $("#inmueble").append(response);
				   $('#inmueble').select2();
			   },
			   error:function(){
				   alert("error")
			   }
		   });


})


$("#inmueble").change(function()
    {
		var rfc= $("#inmueble").val();
		var valor = $("#tipocontri").val();
		if(valor == ""){
			bootbox.alert("Debe sleccionar el tipo de servicio a cobrar")
	}else {
		if(valor == 1){
			$.post("../ajax/caja.php?op=mostrartasaind",{rfc : rfc}, function(data, status)
	{
		data = JSON.parse(data);		
		
		$("#prueba").val(data.categoriatax+" "+data.tipotax);
		$("#tasa").val(data.tax);
		$("#ulmepago").val(data.ultima_declaracion);
		mostrarmoneda();
		calcularDiferenciaMeses();
		

 	});
		 }else {
			var prueba = rfc*2
			$("#prueba").val(prueba);
			bootbox.alert("Preuba de CALCULO es "+ prueba)
 
	 }
	}


})

//Función limpiar
function limpiar()
{
	$("#monto").val("");
	$("#tipopago").val("");
	$("#referencia").val("");
	$("#fechapago").val("");
	$("#registro").val("");
	$("#idusuarioamb").val("");
	$("#idusuariosis").val("");
	$("#idbanco").val("");
	$("#fechaaprobacion").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idpagoamb").val("");
	
	
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


function listarfactura() {
	

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
            url: '../ajax/pagoambiente.php?op=listar',
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
		url: "../ajax/pagoambiente.php?op=guardaryeditar",
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

function mostrar(idpagoamb)
{
	$.post("../ajax/caja.php?op=mostrar",{idpagoamb : idpagoamb}, function(data, status)
	{
		data = JSON.parse(data);		
		
		$("#monto").val(data.monto);
		
		$("#contribuyente").val(data.tiponac,data.razsocial);
        $('#contribuyente').selectpicker('refresh');
		$("#referencia").val(data.referencia);
		$("#fechapago").val(data.fechapago);
		$("#registro").val(data.registro);
		$("#idusuarioamb").val(data.$idusuarioamb);
		$("#idusuariosis").val(data.idusuariosis);
		$("#idbanco").val(data.idbanco);
		$("#direccionusuario").val(data.direccionusuario);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/documentos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#fechaaprobacion").val(data.fechaaprobacion);
		$("#idpagoamb").val(data.idpagoamb);
		document.getElementById("contribuyente2").innerHTML = data.tiponac,data.razsocia;
 	});
}


//Función para desactivar registros
function desactivar(idpagoamb)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/pagoambiente.php?op=desactivar", {idpagoamb : idpagoamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idpagoamb)
{
	bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/pagoambiente.php?op=activar", {idpagoamb : idpagoamb}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();