function init() {
  $("#formularioMensajes").on("submit", function (e) {
    guardar(e);
  });
  dataTablet()
Bandejas()
}

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


function guardar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento

    
    let formData = new FormData($("#formularioMensajes")[0]);
    
    //Primera solicitud para buscar los datos del usuario a resivir el mensajes 
    $.ajax({
      url: "../ajax/messenger.php?op=buscarUsuarioResivir",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (data) {
        const datosUsuario  = JSON.parse(data);        
        if (datosUsuario == null) {
          alert ("no existe esta persona a la que le intentas enviar el mensaje");
        }
        var nombreUsuario = datosUsuario.name;
      
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
           //Segunda solicitus envio de menjsaes con los datos del respectivo usuario
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
                alert("Mensaje enviado");
              
              }
            
            });
        }        
      },
    });
}
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
    // Mueve la llamada a setInterval dentro de $(document).ready()
    setInterval(function() {
      tabla.ajax.reload(null, false);
    }, 3000);
  });
}

function mostrar(id_mensaje){
  $.ajax({
    url: "../ajax/messenger.php?op=verMensajes",
    type: "POST",
    data: {
      id_mensaje : id_mensaje,
      vistomensaje : 0,
    },
    success: function(data, status){
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

            const plantilla = `<div class="mensaje d-flex">
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
function Bandejas(){
  $.ajax({
    url: "../ajax/messenger.php?op=bandeja",
    type: "POST",
    success: function(data){
      data_visto= JSON.parse(data);
      
    }  
  });
  
}
 

init();


    
window.onload = function() {
  var boton_mensaje = document.getElementById("button-mensaje");
  boton_mensaje.addEventListener('click', function(){
    const modal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));
    modal.show();
  });
}

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

