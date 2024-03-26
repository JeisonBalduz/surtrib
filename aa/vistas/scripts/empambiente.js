var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    $("#docrifmuestra").hide();
    $("#docregistromuestra").hide();
    $("#editart").hide();

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
    
    $.post("../ajax/empambiente.php?op=selectUsuario", function(r){
        $("#usuario").append('<option value="" selected>Seleccione una opción</option>'); 
        $("#usuario").append(r);
        $('#usuario').select2();
    
    });
    
}



function agregarnuevo() {
    $.post("../ajax/empambiente.php?op=selectUsuario", function(r){
        $("#idusuario").append('<option value="" selected>Seleccione una opción</option>'); 
        $("#idusuario").append(r);
        $('#idusuario').select2();
    
    });

}




function listartipotax() {
                    $("#tipo2").empty();
                    $("#ramo2").empty();
                    $("#categoria2").empty();
                    $("#taseoi2").empty();
    $.post("../ajax/empambiente.php?op=selecttipo", function(r){
        $("#tipo2").append('<option value="" selected>Seleccione una opción</option>'); 
        $("#tipo2").append(r);
        $('#tipo2').select2();
    
    });

}


$(document).on('change','#tipo2', function()
    {
	 	var idtipotax= $("#tipo2").val();
	 		$.ajax({
                data:{idtipotax: idtipotax},
                url:   '../ajax/empambiente.php?op=selectramo',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) {  
                    $("#ramo2").empty();
                    $("#categoria2").empty();
                    $("#taseoi2").empty();
                    $("#ramo2").append('<option value="" selected>Seleccione una opción</option>');   
                    $("#ramo2").append(response);
					$('#ramo2').select2();
                },
                error:function(){
                	alert("error")
                }
            });
})

$(document).on('change','#ramo2', function()
    {

        var idtipotax= $("#tipo2").val();
	 	var idramotax= $("#ramo2").val();
	 		$.ajax({
                data:{idtipotax: idtipotax, idramotax: idramotax},
                url:   '../ajax/empambiente.php?op=selectcategoria',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) { 
                    $("#categoria2").empty();
                    $("#taseoi2").empty();
                    $("#categoria2").append('<option value="" selected>Seleccione una opción</option>');                 	
                    $("#categoria2").append(response);
					$('#categoria2').select2();
                },
                error:function(){
                	alert("error")
                }
            });
})

$("#categoria2").change(function()
    {
        var idtipotax= $("#tipo2").val();
	 	var idramotax= $("#ramo2").val();
         var idcategoriatax= $("#categoria2").val();
	 		$.ajax({
                data:{idtipotax: idtipotax, idramotax: idramotax,idcategoriatax: idcategoriatax},
                url:   '../ajax/empambiente.php?op=selectasa',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) { 
                    $("#taseoi2").empty();          	
                    $("#taseoi2").append(response);
					$('#taseoi2').select2();
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
    $("#rfc").val("");
    $("#rfc2").val("");
    $("#licencia").val("");
	$("#idusuario").val("");
	$("#sector").val("");
	$("#calle").val("");
    $("#edificio").val("");
    $("#numeroedif").val("");
	$("#medit").val("");
	$("#representative").val("");
	$("#docrifmuestra").attr("src","");
	$("#docrifnactual").val("");
    $("#docregistromuestra").attr("src","");
	$("#docregistroactual").val("");
	$("#conformidaduso").val("");
    $("#tieneinmueble").val("");
	$("#taseoi").val("");
	$("#ultima_declaracion").val("");
    $("#ramo").val("");
	$("#categoria").val("");
	$("#tipo").val("");
    $("#tasa").val("");
}

function limpiar2() {
    $("#ramo2").val("");
	$("#categoria2").val("");
    $("#tipo2").val("");
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

    var busqueda = $("#usuario").val();

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
			url: '../ajax/empambiente.php?op=listar',
            data: {busqueda: busqueda},
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


function guardaryeditar(e) 
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/empambiente.php?op=guardaryeditar",
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

function guardanuevo() 
{
    
    var rif= $("#idusuario").val();
	var licencia= $("#licenciaasignar").val();
    var medit= $("#medit2").val();

    if(rif == ""){
        bootbox.alert("Debe regritar primero el contribuyente")
    }else {
        if(licencia == ""){
            bootbox.alert("Debe seleccionar las opciones")
         }else {
            $.ajax({
            url: "../ajax/empambiente.php?op=insertar2",
            type: "POST",
            data:{rif: rif, licencia: licencia,medit: medit},

            success: function (datos) {
                bootbox.alert(datos);
                $('#formulario3').modal('toggle');
                tabla.ajax.reload();
             }
        });
     }
    }
}

function editarTax() 
{
    
    var rfc= $("#rfc2").val();
	var taseoi= $("#taseoi2").val();
    if(rfc == ""){
        bootbox.alert("Debe regritar primero el contribuyente")
    }else {
        if(taseoi == null){
            bootbox.alert("Debe seleccionar las opciones")
         }else {
            $.ajax({
            url: "../ajax/empambiente.php?op=editarTax",
            type: "POST",
            data:{rfc: rfc, taseoi: taseoi},

            success: function (datos) {
                bootbox.alert(datos);
                $('#formulario2').modal('toggle');
                mostrar(rfc);
                $("#taseoi").val(datos.taseoi);

             }
        });
     }
    }
}




function mostrar(rfc) {
    $.post("../ajax/empambiente.php?op=mostrar", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#rfc").val(data.rfc);
        $("#rfc2").val(data.rfc);
        $("#licencia").val(data.licencia);
		$("#idusuario").val(data.idusuario);
        $("#sector").val(data.sector);
		$("#calle").val(data.calle);
        $("#edificio").val(data.edificio);
		$("#numeroedif").val(data.numeroedif);
		$("#medit").val(data.medit);
		$("#representative").val(data.representative);
		$("#docrifmuestra").show();
		$("#docrifmuestra").attr("src","../files/docempamb/docrif/"+data.docrif);
        $("#docrifactual").val(data.docrif);
		$("#docregistromuestra").show();
		$("#docregistromuestra").attr("src","../files/docempamb/docregistro/"+data.docregistro);
		$("#registradoactual").val(data.registrado);
		$("#conformidaduso").val(data.conformidaduso);
        $("#tieneinmueble").val(data.tieneinmueble);
	    $("#tasa").val(data.tax);
        $("#taseoi").val(data.taseoi);
		$("#ultima_declaracion").val(data.ultima_declaracion);
		$("#estado").val(data.estado);
        $("#tipo").val(data.tipotax);
        $("#ramo").val(data.ramotax);
        $("#categoria").val(data.categoriatax);
        $("#usuario").val(data.idusuario);
        $("#usuario").select2();


    })
}


//Función para desactivar registros
function desactivar(rfc) {
    bootbox.confirm("¿Está seguro de desactivar Empresa?", function (result) {
        if (result) {
            $.post("../ajax/empambiente.php?op=desactivar", {
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
    bootbox.confirm("¿Está seguro de activar Empresa?", function (result) {
        if (result) {
            $.post("../ajax/empambiente.php?op=activar", {
                rfc: rfc
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();