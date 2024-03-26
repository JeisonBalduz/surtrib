var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
	
	//Cargamos los items al select Municipio
	$.post("../ajax/ubch.php?op=selectParroquia", function(r){
	            $("#parroquia").html(r);
				$('#parroquia').append('<option value="" selected>Seleccione una opción</option>');
	});
}

$("#parroquia").change(function()
    {
	 	var idparroquia= $("#parroquia").val();
	 		$.ajax({
                data:{idparroquia: idparroquia},
                url:   '../ajax/ubch.php?op=selectEje',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) {                	
                    $("#eje").html(response);
					$('#eje').append('<option value="" selected>Seleccione una opción</option>');
                },
                error:function(){
                	alert("error")
                }
            });
})


$("#municipio").change(function(){
    var idestado= $("#estado").val();
    var idmunicipio= $("#municipio").val();
    $.ajax({
       data:{idestado: idestado, idmunicipio: idmunicipio},
       url:   '../ajax/ubch.php?op=selectParroquia',
       type:  'post',
       beforeSend: function () { },
       success:  function (response) {                	
           $("#parroquia").html(response);
           $('#parroquia').append('<option value="" selected>Seleccione una opción</option>');
       },
       error:function(){
           alert("error")
       }
   });
})



function mayus(e) {
    e.value = e.value.toUpperCase();
}

//Funcion Limpiar
function limpiar() {
    $("#codigoubch").val("");
    $("#nombreubch").val("");
	$("#idmunicipio").val("");
	$("#municipio2").val("");
    $("#idparroquia2").val("");
    $("#parroquia").val("");
    $("#ideje2").val("");
    $("#eje2").val("");
	$("#electores").val("");
    $("#nacionalidadjubch").val("");
    $("#cedulajubch").val("");
	$("#nombrejubch").val("");
	$("#apellidojubch").val("");
    $("#operadora1").val("");
	$("#telefono1").val("");
	$("#operadora2").val("");
    $("#telefono2").val("");
    $("#correoelectronico").val("");
	$("#direccionjubch").val("");
	$("#sindicato").val("");
	$("#ctp").val("");
    $("#prevencion").val("");
	$("#estado").val("");
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
	
    var ideje = $("#eje").val();
    var idparroquia = $("#parroquia").val();

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
		 
        dom: 'Btrp', //Definimos los elementos del control de tabla
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'pdf'
        ],
        "ajax": {
			url: '../ajax/ubch.php?op=listar',
			data: {ideje: ideje, idparroquia: idparroquia},
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
    }).DataTable();
}


function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/ubch.php?op=guardaryeditar",
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

function mostrar(codigoubch) {
    $.post("../ajax/ubch.php?op=mostrar", {
        codigoubch: codigoubch
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
		
        $("#codigoubch").val(data.codigoubch);
        $("#nombreubch").val(data.nombreubch);
		$("#parroquia2").val(data.parroquia);
		$("#idparroquia2").val(data.idparroquia);
        $("#eje2").val(data.eje);
		$("#ideje2").val(data.ideje);
        $("#direccion").val(data.direccion);
        $("#mesas").val(data.mesas);
	    $("#electores").val(data.electores);
        $("#nacionalidadjubch").val(data.nacionalidadjubch);
        $("#cedulajubch").val(data.cedulajubch);
	    $("#nombrejubch").val(data.nombrejubch);
	    $("#apellidojubch").val(data.apellidojubch);
		$("#operadora1").val(data.operadora1);
        $("#telefono1").val(data.telefono1);
		$("#operadora2").val(data.operadora2);
        $("#telefono2").val(data.telefono2);
		$("#correoelectronico").val(data.correoelectronico);
		$("#direccionjubch").val(data.direccionjubch);
		$("#sindicato").val(data.sindicato);
		$("#ctp").val(data.ctp);
		$("#prevencion").val(data.prevencion);
		$("#estado").val(data.estado);
		
    })
}

//Función para desactivar registros
function desactivar(codigoubch) {
    bootbox.confirm("¿Está seguro de desactivar al Jefe de UBCH?", function (result) {
        if (result) {
            $.post("../ajax/ubch.php?op=desactivar", {
                codigoubch: codigoubch
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(codigoubch) {
    bootbox.confirm("¿Está seguro de activar al Jefe de UBCH?", function (result) {
        if (result) {
            $.post("../ajax/ubch.php?op=activar", {
                codigoubch: codigoubch
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();