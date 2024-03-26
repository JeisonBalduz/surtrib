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


const myModal = document.querySelector("#miModal"); // Seleccionamos el modal por ID
var contenedorBoton = document.getElementById("boton-cerrar");
var contenedorBotonX = document.getElementById("boton-x");
contenedorBoton.disabled = true;
contenedorBotonX.disabled = true;


// evento DOM para ejecutar el Boostrap 4
window.addEventListener("load", () => {
  const modalToggle = new bootstrap.Modal(myModal);
  // Se abre el modal después de 1 segundos
  setTimeout(() => {
    modalToggle.show();
  }, 1000); // tiempo de espera

  // Se inicia el temporizador para cerrar el modal
  ocultarModalAutomaticamente();
});

//funcion para ejecutar el desactivado automatico 
function ocultarModalAutomaticamente() {
  
  // Contador para mostrar en la consola
  let tiempoRestante = 15;

  // Intervalo para actualizar el contador
  const intervalo = setInterval(() => {
    // Decrementa el tiempo restante
    tiempoRestante--;

    // Muestra el tiempo restante en la consola
    console.log(`Tiempo restante: ${tiempoRestante} segundos`);
   
    // Oculta el modal cuando el tiempo llegue a 0
    if (tiempoRestante === 0) {
      clearInterval(intervalo);
      
      //Selectores de contenedores 
      var body = document.querySelector(".modal-open");
      var modal = document.querySelector(".modal");
      var contenedor = document.querySelector(".modal-backdrop");
     
      contenedorBoton.disabled = false;
      contenedorBotonX.disabled = false;
      // TODO ESTO ES POR SI SE NECESITA BORRAR LOS MODALES //

      //Emiliminacion de clases de Boostrap
           // body.classList.remove("modal-open");
            //body.classList.remove("modal-open");
            //modal.classList.remove("show");

      

      //Cambio de display del contenedor principal del modal 
      
      //modal.style.display = "none";

      //Se le agrega un nuevo atributo al modal principal
      
      //modal.setAttribute("aria-hidden", "true");
      //contenedor.parentNode.removeChild(contenedor);
      // se recore el contenedor principal y se eliminan los nodos que queden 
        //while (contenedor.firstChild) {
          //contenedor.removeChild(contenedor.firstChild);
        //}
        /////////////////////////

    }
  }, 1000);
}
