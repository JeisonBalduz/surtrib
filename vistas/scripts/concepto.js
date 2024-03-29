var tabla;

//Funcion que se ejecuta al inicio

function init() {
  listar();
}

function listar() {
  tabla = $("#tbllistado")
    .dataTable({
      aProcessing: true, //Activamos el procesamiento del datatables
      aServerSide: true, //Paginación y filtrado realizados por el servidor
      dom: "", //Definimos los elementos del control de tabla
      buttons: [],
      ajax: {
        url: "../ajax/concepto.php?op=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: false,
      iDisplayLength: 10, //Paginación
      order: [[0, "asc"]], //Ordenar (columna,orden)
    })
    .DataTable();
}

function mostrar(codigoubch) {
  $.post(
    "../ajax/ubch.php?op=mostrar",
    {
      codigoubch: codigoubch,
    },
    function (data, status) {
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
    }
  );
}

init();

const myModal = document.querySelector("modal-contendor"); // Seleccionamos el modal por ID
const body = document.querySelector("body");
var contenedorBoton = document.getElementById("boton-cerrar");
var contenedorBotonX = document.getElementById("boton-x");
const video = document.querySelector("video");
const contador_spinner = document.querySelector("#spinner");
const spinner =  document.getElementById("spinner-circulo");
contenedorBotonX.disabled = true;
contenedorBoton.disabled = true;
const contenedor = document.querySelectorAll(".modal-backdrop");
spinner.style.animation = "spinner-border 1.2s linear infinite";

// evento DOM para ejecutar el Boostrap 4
window.addEventListener("load", () => {
  const modalToggle = new bootstrap.Modal(myModal);
  // Se abre el modal después de 1 segundos
  setTimeout(() => {
    modalToggle.show();
    
  }, 1000); // tiempo de espera

});

$('.modal').modal({
  backdrop: 'static',
})


//EVENTO PARA ELIMINAR EL VIDEO A LA HORA DE CERRAR EL MODAL  CON EL BOTON CERRAR
contenedorBoton.addEventListener("click", () => {
  // Eliminar el elemento `video`
  video.remove();
});

//EVENTO PARA ELIMINAR EL VIDEO A LA HORA DE CERRAR EL MODAL  CON EL BOTON X
contenedorBotonX.addEventListener("click", () => {
  // Eliminar el elemento `video`
  video.remove();
});

//funcion para ejecutar el desactivado automatico
function ocultarModalAutomaticamente() {
  // Contador para mostrar en la consola
  let tiempoRestante = 20;

  // Intervalo para actualizar el contador
  const intervalo = setInterval(() => {
    // Decrementa el tiempo restante
    tiempoRestante--;

    // Muestra el tiempo restante en la consola
    console.log(`Tiempo restante: ${tiempoRestante} segundos`);
    //tiempo dentro del spinner
    contador_spinner.textContent = tiempoRestante;
    contador_spinner.style.fontSize = "16px";
    
    // Oculta el modal cuando el tiempo llegue a 0
    if (tiempoRestante === 0) {
      clearInterval(intervalo);
      spinner.style.borderRightColor = "#007bff";
      
      bootbox.confirm({
        title: "Alerta de Información",
        message: "Ya puede cerrar la publicidad cuando usted desee, dándole clic al botón Cerrar o a la X de la publicidad. Que tenga un feliz día.",
        buttons: {
          confirm: {
            label: "Cerrar Alerta",
            className: "btn-danger",
          },

        },
        callback: function (result) {
          setTimeout(function() {
            document.body.classList.add("modal-open");
          }, 310);
        },
      });

        var botonBOOX = document.querySelector(".bootbox-cancel");
          botonBOOX.remove();

          // Crea un contador que se inicia en 1
        let counter = 0;

        // Función que se ejecuta cada segundo
        const interval = setInterval(function () {
          // Incrementa el contador
          counter++;

          // Cierra el modal después de 10 segundos
          if (counter === 10) {
            clearInterval(interval);
            bootbox.hideAll();
              setTimeout(function() {
                document.body.classList.add("modal-open");
              }, 310);
          }
        }, 1000);

      //Selectores de contenedores
      var body = document.querySelector(".modal-open");
      var modal = document.querySelector(".modal");
      
      contenedorBotonX.disabled = false;
      contenedorBoton.disabled = false;
      // TODO ESTO ES POR SI SE NECESITA BORRAR LOS MODALES //

      //Emiliminacion de clases de Boostrap
      //body.classList.remove("modal-open");
      //body.classList.remove("modal-open");
      
     //Cambio de display del contenedor principal del modal

      //Se le agrega un nuevo atributo al modal principal

      
     // contenedor.parentNode.removeChild(contenedor);
      // se recore el contenedor principal y se eliminan los nodos que queden
      //while (contenedor.firstChild) {
      //contenedor.removeChild(contenedor.firstChild);
      //}
      /////////////////////////
    }
  }, 1000);
}
// Se inicia el temporizador para cerrar el modal
ocultarModalAutomaticamente();


