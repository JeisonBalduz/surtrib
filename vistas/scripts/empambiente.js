var tabla;

//Funcion que se ejecuta al inicio

function init() {
    mostrarform(false);
    


    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
    

    

    
}

$(document).ready(function() {
    $('#comodinbusqueda').select2();
    $("#comodinbusqueda").select2({ 
        ajax: {
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            url: "../ajax/contriambiente.php?op=buscarContibuyente"+"&r=" + new Date().getTime(),
            dataType: 'json',
          //  data:'rfc=' + 
              delay: 650,
             data: function (params) {
                    var SearchParamsSent = {
                        search: params.term
                        //tblname: editor.field('itemtype').inst('val')
                    }
 
                    return SearchParamsSent;
                }
            
            ,
            processResults: function (data) {
                return {
                    results: data
                }
            }
        },
        cache: true,
        placeholder: 'Buscar Contribuyente...',
        minimumInputLength: 1
    });

   
});




$(document).on('change','#tiposervicio', function()
    {
        var tiposervicio= $("#tiposervicio").val();
            $.ajax({
                data:{tiposervicio: tiposervicio},
                url:   '../ajax/empambiente.php?op=selecttipo',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) { 
                $("#tipo2").empty(); 
                    $("#ramo2").empty();
                    $("#categoria2").empty();
                    $("#taseoi2").empty();
                    $("#tipo2").append('<option value="" selected>Seleccione una opción</option>');   
                    $("#tipo2").append(response);
                    $('#tipo2').select2();
                },
                error:function(){
                    alert("error")
                }
            });
})


$(document).on('change','#tipo2', function()
    {
	 	var idtipotax= $("#tipo2").val();
        var tiposervicio= $("#tiposervicio").val();
	 		$.ajax({
                data:{idtipotax: idtipotax, tiposervicio: tiposervicio},
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
        var tiposervicio= $("#tiposervicio").val();
	 		$.ajax({
                data:{idtipotax: idtipotax, idramotax: idramotax,tiposervicio: tiposervicio},
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
         var tiposervicio= $("#tiposervicio").val();
	 		$.ajax({
                data:{idtipotax: idtipotax, idramotax: idramotax,idcategoriatax: idcategoriatax,tiposervicio: tiposervicio},
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
    $("#tipo2").empty(); 
                    $("#ramo2").val("");
                    $("#categoria2").val("");
                    $("#taseoi2").val("");
                    $("#tiposervicio").val("");
                    $("#datos").val("");
                    $("#tasaasignada").val("");
                    $("#direccion").val("");
                     $("#tiposer").val("");
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

    var busqueda = $("#comodinbusqueda").val();

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



function editarTax() 
{
    
	var taseoi= $("#taseoi2").val();
    if(taseoi == ""){
        bootbox.alert("Debe regritar primero el contribuyente")
    }else {
        if(taseoi == null){
            bootbox.alert("Debe seleccionar las opciones")
         }else {
            $.post("../ajax/empambiente.php?op=taxasignada", {
        taseoi: taseoi
    }, function (data, status) {
        data = JSON.parse(data);
        $("#idt").val(data.idt);
        $("#tiposer").val(data.tipotribute);
        $("#tasaasignada").val(data.idt+"-"+data.tipotax+"-"+data.ramotax+"-"+data.categoriatax+"-"+data.tax);
        


    });
     }
    }
    $("#formulario2").modal('hide');
}


$(document).on('change','#rfc', function()

    {
        var rfc= $("#rfc").val();
        $.post("../ajax/empambiente.php?op=selectUsuario2", {
        rfc: rfc
    }, function (data, status) {
        data = JSON.parse(data);
       
        $("#datos").val(data.rfc+"-"+data.name);
        


    })
})


function mostrar(id) {
    $.post("../ajax/empambiente.php?op=mostrar", {
        id: id
    }, function (data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#rfc").val(data.rfc);
        $("#id").val(data.id);
         $("#idt").val(data.idtambiente);
         $("#tiposer").val(data.tipotax);
        $("#direccion").val(data.direccion);
        $("#ultima_declaracion").val(data.fechapago);
		$("#idusuario").val(data.idusuario);
        $("#sector").val(data.sector);
		$("#calle").val(data.calle);
        $("#edificio").val(data.edificio);
		$("#numeroedif").val(data.nedificio);
        $("#tasaasignada").val(data.idt+'-'+data.tipotax+'-'+data.ramotax+'-'+data.categoriatax+'-'+data.tax);


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