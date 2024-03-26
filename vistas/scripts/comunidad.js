var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
	
	//Cargamos los items al select Municipio
	$.post("../ajax/comunidad.php?op=selectParroquia", function(r){
	            $("#parroquia").html(r);
				$('#parroquia').append('<option value="" selected>Seleccione una opción</option>');
	});
}

$("#parroquia").change(function(){
	 		var idparroquia= $("#parroquia").val();
	 		$.ajax({
                data:{idparroquia: idparroquia},
                url:   '../ajax/comunidad.php?op=selectEje',
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


$("#eje").change(function(){
    var idparroquia= $("#parroquia").val();
    var ideje= $("#eje").val();
    $.ajax({
       data:{idparroquia: idparroquia, ideje: ideje},
       url:   '../ajax/comunidad.php?op=selectUbch',
       type:  'post',
       beforeSend: function () { },
       success:  function (response) {                	
           $("#ubch").html(response);
           $('#ubch').append('<option value="" selected>Seleccione una opción</option>');
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
    $("#idcomunidad").val("");
    $("#comunidad").val("");
    $("#codigoubch").val("");
    $("#nombreubch").val("");
	$("#idmunicipio").val("");
	$("#municipio2").val("");
    $("#idparroquia2").val("");
    $("#parroquia").val("");
    $("#ideje2").val("");
    $("#eje2").val("");
	$("#electores").val("");
    $("#nacionalidadjcomunidad").val("");
    $("#cedulajcomunidad").val("");
	$("#nombrejcomunidad").val("");
	$("#apellidojcomunidadh").val("");
    $("#operadora1").val("");
	$("#telefono1").val("");
	$("#operadora2").val("");
    $("#telefono2").val("");
    $("#correoelectronico").val("");
	$("#direccionjcomunidad").val("");
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
	
    var codigoubch = $("#ubch").val();

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
			url: '../ajax/comunidad.php?op=listar',
			data: {codigoubch: codigoubch},
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
        url: "../ajax/comunidad.php?op=guardaryeditar",
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

function mostrar(idcomunidad) {
    $.post("../ajax/comunidad.php?op=mostrar", {
        idcomunidad: idcomunidad
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
		
        $("#idcomunidad").val(data.idcomunidad);
        $("#comunidad").val(data.comunidad);
        $("#codigoubch").val(data.codigoubch);
        $("#nombreubch").val(data.nombreubch);
		$("#parroquia2").val(data.parroquia);
		$("#idparroquia2").val(data.idparroquia);
        $("#eje2").val(data.eje);
		$("#ideje2").val(data.ideje);
        $("#direccion").val(data.direccion);
        $("#mesas").val(data.mesas);
	    $("#electores").val(data.electores);
        $("#nacionalidadjcomunidad").val(data.nacionalidadjcomunidad);
        $("#cedulajcomunidad").val(data.cedulajcomunidad);
	    $("#nombrejcomunidad").val(data.nombrejcomunidad);
	    $("#apellidojcomunidad").val(data.apellidojcomunidad);
		$("#operadora1").val(data.operadora1);
        $("#telefono1").val(data.telefono1);
		$("#operadora2").val(data.operadora2);
        $("#telefono2").val(data.telefono2);
		$("#correoelectronico").val(data.correoelectronico);
		$("#direccionjcomunidad").val(data.direccionjcomunidad);
		$("#estado").val(data.estado);
		
    })
}

//Función para desactivar registros
function desactivar(idcomunidad) {
    bootbox.confirm("¿Está seguro de desactivar al Jefe de UBCH?", function (result) {
        if (result) {
            $.post("../ajax/comunidad.php?op=desactivar", {
                idcomunidad: idcomunidad
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idcomunidad) {
    bootbox.confirm("¿Está seguro de activar al Jefe de Comunidad?", function (result) {
        if (result) {
            $.post("../ajax/comunidad.php?op=activar", {
                idcomunidad: idcomunidad
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();