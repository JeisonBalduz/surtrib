function init() {
  $("#formularioMensajes").on("submit", function (e) {
    e.preventDefault();
      const tipoUsuario = $("#inputGroupSelect01").val(); // Obtener el valor del selector

      if (tipoUsuario === "contribuyente") {
        alert("un solo contribuyente");
        guardar(e);
      } else if (tipoUsuario === "todosAdministrativos") {
        alert("todos los administrativos");
        guardarAdministrativos(e)
      } else if (tipoUsuario === "todosContribuyentes") {
        alert("todos los contribuyentes");
        guardarContribuyentes(e);
      } else {
        // Manejar el caso si el valor del selector no es válido
        console.error("Tipo de usuario no válido:", tipoUsuario);
      }
  });
  dataTablet();
  Bandejas();
  dataTabletEnviados();
}

var botonBandejaEnvio = document.getElementById("bandejaEnvio");
var botonBandejaEntrada = document.getElementById("bandejaEntrada");
var tablaEntrada = document.getElementById("tabla_entada");
var tablaenvio = document.getElementById("tabla_envio");
var botonEditar = document.querySelector("#editar");
var refreshButtonEnvio = $(".boton-refresEnviados").hide(); 
var refreshButton = $(".boton-refres"); 

//FASE Prueba buscar el usuario
var conten_home = document.getElementById("conten_home");
$(document).ready(function() {
  $.ajax({
    type: 'GET', 
    url: "../ajax/messenger.php?op=buscarUsuario",
    success: function(data) {
      data = JSON.parse(data);
      console.log(data);
  
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("AJAX Error:", textStatus, errorThrown);
      alert("Se produjo un error al recuperar datos. Inténtalo de nuevo."); 
    }
  });
});

//FUNCION DE GUARDAR MENSAJE
function guardar(e) {
  e.preventDefault();
    let formData = new FormData($("#formularioMensajes")[0]);
    $.ajax({
      url: "../ajax/messenger.php?op=buscarUsuarioRecibir",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        //PRIMERO SE VALIDA SI EL USUARIO EXISTE SI NO EXISTE SE GENERA LA ALERTA Y SI EXISTE SEGUIRA CORRIENDO
        const datosUsuario  = JSON.parse(data);     

        if (datosUsuario == null) {
          alert ("no existe esta persona a la que le intentas enviar el mensaje");
        }
        var nombreUsuario = datosUsuario.name;
        
        //SE VALIDA SI EL USUARIO QUE SE BUSCO EN ADMINISTRATIVO O CONTRIBUYENTE (SI TIENE UN RFC 0 ES ADMIN Y SI NO ES CONTIBUYENTE)
        if (datosUsuario.rfc == 0) {
          var identificadorUsuario = datosUsuario.usuario;
        }else{
          var identificadorUsuario = datosUsuario.rfc;
        }
       
        var nivelUsuario = datosUsuario.nivel;
        var rifUsuario = datosUsuario.rif;
        var messenger = document.getElementById("messenger").value
        if (messenger === "") {
          // El mensaje está vacío
          alert("El mensaje está vacío");
          
        } else {
            $.ajax({
              url: "../ajax/messenger.php?op=enviarMensaje",
              type: "POST",
              data: {
                nombreUsuario: nombreUsuario,
                identificadorUsuario: identificadorUsuario,
                messenger: messenger,
              },
              error: function(){
                alert("mensaje no enviado");
              },
              success: function (data, status) {
                $("#tablet").DataTable().ajax.reload();
                $("#tabletEnviados").DataTable().ajax.reload();
                $("#personal_recibir").val("");
                $("#messenger").val("");
                alert("Mensaje enviado");
            
                Bandejas();
              }
            
            });
        }        
      },
    });
    
}

 
//FUNCION DE GUARDAR MENSAJE

function guardarContribuyentes(e) {
  const nivelContribuyente = 2;
  var messenger = document.getElementById("messenger").value;

  $.ajax({
    url: "../ajax/messenger.php?op=BuscarTodosContribuyentes",
    type: "POST",
    data: {
      nivelContribuyente: nivelContribuyente,
    },
    success: function(data) {
      var data_visto = JSON.parse(data);
        // ... Otros datos necesarios para el registro
              // Recorre data_visto y registra cada usuario de forma asincrónica
            for (let datos of data_visto) {
                  // Función para registrar un solo usuario de forma asincrónica
            const idUsuario = data_visto.usuario; // Suponiendo que "usuario" tiene una propiedad "usuario"
            const nombreUsuario = data_visto.nombre; // Suponiendo que "usuario" tiene una propiedad "nombre"
            console.log(idUsuario)
            function registrarUsuario(datos){
              $.ajax({
                url: "../ajax/messenger.php?op=BuscarTodosContr",
                type: "POST",
                data: {
                  id_usuario: idUsuario,
                  nombre_usuario: nombreUsuario,
                  // ... Otros datos
                },
                success: function(respuesta) {
                  console.log("Usuario registrado:", nombreUsuario);
                },
                error: function(error) {
                  console.error("Error al registrar usuario:", nombreUsuario, error);
                }
              });
            }
            registrarUsuario(datos)
      }
       
 
      
    },
    error: function(error) {
      console.error("Error al obtener usuarios:", error);
    }
  });
}


function guardarAdministrativos(e) {
  const personal_recibir =  2;
  var messenger = document.getElementById("messenger").value
   $.ajax({
     url: "../ajax/messenger.php?op=buscarUsuariototal",
     type: "POST",
     data:{
       personal_recibir: personal_recibir,
     },
     success: function (data) {
       data_visto= JSON.parse(data);
     console.log(data_visto); // This will only display user names
   

    
           $.ajax({
             url: "../ajax/messenger.php?op=enviarMensajeContribuyente",
             type: "POST",
             data: {
               personal_recibir: chunk,
               
             },
             success: function (data) {
               // Manejar la respuesta
             },
           });
   },
 });
}

//FUNCION PARA GENERAR EL DATATABLET
function dataTablet() {
  $(document).ready(function() {
   const tabla = $("#tablet").DataTable({
      "responsive": true,
      "autoWidth": false,
      "info": false,
      "lengthMenu": [1, 6, 10, 25],
      "pageLength": 6,
      "language": {
        info: 'Vista _START_ a _END_ de _TOTAL_ registros',
        search: 'Buscar',
        previous: 'Previo',
        lengthMenu: 'Ver _MENU_ registro por pagina',
      },
      "order": [[0, "desc"]],
      "ajax": {
        url: '../ajax/messenger.php?op=BustarMensajesRecibidos',
        type: "get",
        dataType: "json",        
        error: function (e) {
          console.log(e.responseText);
        },
      },
    });
        //Boton de refrescar el data tablet
       refreshButton.click(function() {
         tabla.ajax.reload(); 
         alert("tabla recibidos actualizada");
       });
      setInterval(function() {
        Bandejas();
        tabla.ajax.reload(null, false);
      }, 60000);// cada 1 minuto la tabla se actualizara sola
  });
}

function dataTabletEnviados() {
  $(document).ready(function() {
   const tabla2 = $("#tabletEnviados").DataTable({
      "responsive": true,
      "autoWidth": false,
      "info": false,
      "lengthMenu": [1, 6, 10, 25],
      "pageLength": 6,
      "language": {
        info: 'Vista _START_ a _END_ de _TOTAL_ registros',
        search: 'Buscar',
        previous: 'Previo',
        lengthMenu: 'Ver _MENU_ registro por pagina',
      },
      "order": [[0, "desc"]],
      "ajax": {
        url: '../ajax/messenger.php?op=BustarMensajesEnviados',
        type: "get",
        dataType: "json",        
        error: function (e) {
          console.log(e.responseText);
          
        },
      },
    });
        //Boton de refrescar el data tablet
       refreshButtonEnvio.click(function() {
         tabla2.ajax.reload(); 
         alert("tabla envio actualizada");
       });
      setInterval(function() {
        Bandejas();
        tabla2.ajax.reload(null, false);
      }, 60000);// cada 1 minuto la tabla se actualizara sola
  });
}

//FUNCION PARA MOSTRAR EL MENSAJE QUE FUE RESIVIDO 
function mostrar(id_mensaje){
  botonEditar.hidden = true;
  $.ajax({
    url: "../ajax/messenger.php?op=verMensajes",
    type: "POST",
    data: {
      id_mensaje : id_mensaje,
      vistomensaje : 0,
    },
    success: function(data, status){
      $("#tablet").DataTable().ajax.reload();
      $("#tabletEnviados").DataTable().ajax.reload();
      Bandejas();

      data_visto= JSON.parse(data);
      const textInfo = document.querySelector(".textInfo");
      textInfo.disabled = true;
        $.ajax({
          url: "../ajax/messenger.php?op=BustarTodosMensajes",
          type: "POST",
          data: {
            id_mensaje: id_mensaje,
          },
          success: function (data, status) {
            data = JSON.parse(data);
            console.log(data.visto);
           var nombre = data.name_enviado;
           var fecha=  data.fecha;
           var hora=  data.hora;

            const plantilla = 
            `<div class="mensaje d-flex mb-2">
                <div class="card-tools mr-2">
                  <span class="badge badge-info p-2">Mensaje Enviado Por:<strong class="ml-1">${nombre}</strong></span>
                </div>
                <div class="card-tools mr-2">
                  <span class="badge badge-secondary p-2">Fecha Del Envio:<strong class="ml-1">${fecha}</strong></span>
                </div>
                <div class="card-tools mr-2">
                  <span class="badge badge-secondary p-2">Hora Del Envio:<strong class="ml-1">${hora}</strong></span>
                </div>
            </div>`;
            $("#mensajes").html(plantilla);
            $("#messenger_resivido").val(data.messenger);
          },
        });
    }  
  });
  
}

function mostrarEnvio(id_mensaje){
      const textInfo = document.querySelector(".textInfo");
  
const inputActualizar = document.getElementById("inputActualizar");
      
      textInfo.disabled = true;
      inputActualizar.disabled = true ;
        $.ajax({
          url: "../ajax/messenger.php?op=BustarTodosMensajes",
          type: "POST",
          data: {
            id_mensaje: id_mensaje,
          },
          success: function (data, status) {
            data = JSON.parse(data);
            console.log(data.visto);
            var id_mens = id_mensaje;
           var nombre = data.name_enviado;
           var recibido = data.name_recibido;
           var fecha=  data.fecha;
           var hora=  data.hora;

            const plantilla = 
            `<div class="mensaje d-flex mb-2" style = "flex-wrap: wrap;">
                <input class="" id="id_actualizar" type="text" value="${id_mens}" id="boton_envio" hidden>      
                <div class="card-tools mr-2 mt-2">
                  <span class="badge badge-info p-2">Mensaje Enviado Por:<strong class="ml-1 ">${nombre}</strong></span>
                </div>
                <div class="card-tools mr-2 mt-2">
                  <span class="badge badge-secondary p-2">Mensaje Recibido Por:<strong class="ml-1">${recibido}</strong></span>
                </div>
                <div class="card-tools mr-2 mt-2">
                  <span class="badge badge-secondary p-2">Fecha Del Envio:<strong class="ml-1 ">${fecha}</strong></span>
                </div>
                <div class="card-tools mr-2 mt-2">
                  <span class="badge badge-secondary p-2">Hora Del Envio:<strong class="ml-1">${hora}</strong></span>
                </div>
             </div>`;
              $("#mensajes").html(plantilla);
              $("#messenger_resivido").val(data.messenger);
                    botonEditar.hidden = false;
                botonEditar.addEventListener('click', function(){
                  textInfo.disabled = false;
                  inputActualizar.disabled = false;
                });  
                
          },
         
        });
        
        
}
inputActualizar.addEventListener('click', function() {
  MensajeActualizado(); 
});
      
function MensajeActualizado() {
  const textInfoMessenger = document.querySelector(".textInfo").value;
  const id_mens_actualizar = document.querySelector("#id_actualizar").value;

  $.ajax({
    url: "../ajax/messenger.php?op=ActualizarMensaje",
    type: "POST",
    data: {
      id_mens_actualizar:id_mens_actualizar,
      textInfoMessenger:textInfoMessenger,
    },
    success: function (data, status) {
      $("#tablet").DataTable().ajax.reload();
      $("#tabletEnviados").DataTable().ajax.reload();
      Bandejas();
      alert("Mensaje actualizado");
    },
    error: function () {
      
    }
  });
}


//FUNCION DE BANDEJAS DE ENTRADA Y ENVIADAS DE MENSAJES
function Bandejas(){
  $.ajax({
    url: "../ajax/messenger.php?op=bandejaMensajes",
    type: "POST",
    success: function(data){
      data_visto= JSON.parse(data);
      $("#bandeja_enviados").text(data_visto.mensajes_enviados.numeros_mensaje);
      $("#bandeja_entrada").text(data_visto.mensajes_recibidos.numero_mensaje);
    }  
  });
  
}

init();


botonBandejaEnvio.addEventListener('click',function(){
  tablaenvio.hidden = false;
  tablaEntrada.hidden = true;
  refreshButtonEnvio.show();
  refreshButton.hide();
  $("#tabletEnviados").DataTable().ajax.reload();
  $('#tbodyResividos').empty();

});

botonBandejaEntrada.addEventListener('click',function(){
  tablaenvio.hidden = true;
  tablaEntrada.hidden = false;
  refreshButtonEnvio.hide();
  refreshButton.show();
  $('#tbodyEnviados').empty();
  $("#tablet").DataTable().ajax.reload();
 
});
//MODAL para generar un mensaje
window.onload = function() {
  var boton_mensaje = document.getElementById("button-mensaje");
  boton_mensaje.addEventListener('click', function(){
    const modal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));
    modal.show();
  });
}

//Seleccion del modal de mensajes
window.onload = function() {
  var selectorContribuyente = document.getElementById("inputGroupSelect01");
  var inputContribuyente = document.getElementById("personal_recibir");
  selectorContribuyente.addEventListener('click', function() {
    if (selectorContribuyente.value === "contribuyente") {
      let contenedorContribuyente = document.getElementById("contentCont");
      inputContribuyente.disabled = false;
      contenedorContribuyente.hidden = false;


      
    }else{
      let contenedorContribuyente = document.getElementById("contentCont");
      let input_usuario = document.querySelector(".input_usuario");
      input_usuario.value = '';
      inputContribuyente.disabled = true;
      contenedorContribuyente.hidden = true;
    }
  });

  var botonCerrar = document.getElementById("boton-cerrar");
  var XCerrar = document.getElementById("boton-x");

}

 