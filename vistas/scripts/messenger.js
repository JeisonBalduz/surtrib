function init() {
  $("#formularioMensajes").on("submit", function (e) {
    
    guardarContribuyente(e)
  });
  dataTablet();
  Bandejas();
  
}

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
      url: "../ajax/messenger.php?op=buscarUsuarioResivir",
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
                alert("Mensaje enviado");
                Bandejas();
              }
            
            });
        }        
      },
    });
}
//FUNCION DE GUARDAR MENSAJE
function guardarContribuyente(e) {
  e.preventDefault();
    let formData = new FormData($("#formularioMensajes")[0]);
    $.ajax({
      url: "../ajax/messenger.php?op=enviarMensajeContribuyente",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        //PRIMERO SE VALIDA SI EL USUARIO EXISTE SI NO EXISTE SE GENERA LA ALERTA Y SI EXISTE SEGUIRA CORRIENDO
        const datosUsuario  = JSON.parse(data);            
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
      "lengthMenu": [6, 10, 25],
      "pageLength": 6,
      "language": {
        info: 'Vista _START_ a _END_ de _TOTAL_ registros',
        search: 'Buscar',
        previous: 'Previo',
        lengthMenu: 'Ver _MENU_ registro por pagina',
      },
      "order": [[0, "desc"]],
      "ajax": {
        url: '../ajax/messenger.php?op=BustarMensajesResividos',
        type: "get",
        dataType: "json",        
        error: function (e) {
          console.log(e.responseText);
        },
      },
    });
        //Boton de refrescar el data tablet
       const refreshButton = $(".boton-refres"); 
       refreshButton.click(function() {
         tabla.ajax.reload(); 
         alert("tabla actualizada");
       });
      setInterval(function() {
        tabla.ajax.reload(null, false);
      }, 60000);// cada 1 minuto la tabla se actualizara sola
  });
}

//FUNCION PARA MOSTRAR EL MENSAJE QUE FUE RESIVIDO 
function mostrar(id_mensaje){
  $.ajax({
    url: "../ajax/messenger.php?op=verMensajes",
    type: "POST",
    data: {
      id_mensaje : id_mensaje,
      vistomensaje : 0,
    },
    success: function(data, status){
      $("#tablet").DataTable().ajax.reload();
      Bandejas()
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
            `<div class="mensaje d-flex">
                <p>Mensaje enviado por:<strong class="ms-2">${nombre}</strong></P>
                <p>Fecha:<strong class="ms-2">${fecha}</strong></P>
                <p>hora:<strong>${hora}</strong></P>
             </div>`;
            $("#mensajes").html(plantilla);
            $("#messenger_resivido").val(data.messenger);
          },
        });
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

  
//FUNCION DE GUARDAR MENSAJE

// function guardarContribuyente() {
//    const personal_resivir =  2;
//     $.ajax({
//       url: "../ajax/messenger.php?op=buscarUsuariototal",
//       type: "POST",
//       data:{
//         personal_resivir: personal_resivir,
//       },
//       success: function (data) {
//         data_visto= JSON.parse(data);
//       console.log(data_visto); // This will only display user names
//       const chunkSize = 100; // Tamaño de cada parte

//       for (let i = 0; i < data_visto.length; i += chunkSize) {
//         const chunk = data_visto.slice(i, i + chunkSize);
//             $.ajax({
//               url: "../ajax/messenger.php?op=enviarMensajeContribuyente",
//               type: "POST",
//               data: {
//                 personal_resivir: chunk,
                
//               },
//               success: function (data) {
//                 // Manejar la respuesta
//               },
//             });
//         }
      
//     },
//   });
// }
init();


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
  var inputContribuyente = document.getElementById("personal_resivir");
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

