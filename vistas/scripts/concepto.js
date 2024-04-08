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

// SELECCION DEL MODAL PRINCIPAL DE BOOTSTRAP
const myModal = document.querySelector("modal-contendor"); 
const myModal2 = document.querySelector("#modal-contendor"); 

//////////////////////////////////////////////
const modalAdministrativo = document.querySelector(".modalAdministrativo");// seleccion del modal principal del administrativo
const modalContribuyente = document.querySelector(".modalContribuyente");// seleccion del modal principal del contribuyente
////////////////////////////////////////////

////////////////////////////////////////////
const body = document.querySelector("body");//Seleccion del body principal del sistema 
const video = document.querySelector("video");//Seleccion del video dentro del modal
const contador_spinner = document.querySelector("#spinner");//Seleccion por ID del contador del spinner 
const spinner =  document.getElementById("spinner-circulo");//Seleccion por ID del spinner
const contenedorbackdrop = document.querySelector("modal-backdrop");//Seleccion por ID del contador del spinner 
////////////////////////////////////////////

////////////////////////////////////////////
var contenedorBoton = document.getElementById("boton-cerrar");//Seleccion del boton cerrar 
var contenedorBotonX = document.getElementById("boton-x");//Seleccion del boton con forma de C 

if(modalAdministrativo){
  //contenedorBotonX.disabled = true;//DESABILITAR BOTON CERRAR
  contenedorBoton.disabled = true;//DESABILITAR BOTON X 
}else{
  //contenedorBotonX.disabled = true; //DESABILITAR BOTON CERRAR
  contenedorBoton.disabled = true;//DESABILITAR BOTON X 
}

////////////////////////////////////////////////////////////////////////////////////////////////

// evento DOM para ejecutar el Boostrap 4
window.addEventListener("load", () => {
  const modalToggle = new bootstrap.Modal(myModal);
  // Se abre el modal después de 1 segundos
  setTimeout(() => {
    modalToggle.show();
    
  }, 1000); // tiempo de espera

});

if(modalContribuyente){
  $('.modalContribuyente').modal({
    backdrop: 'static',
  })

}

if(modalAdministrativo){
  $('.modalAdministrativo').modal({
    
    //CONTENIDO ADMINSITRATIVO DEL MODAL
  })
}
//////////////////////////// FUNCIONAL DE VIDEOS PARA MODALES /////////////////////////////

if (modalAdministrativo) {
  // FUNCION PARA VIDEOS ADMINISTRATIVOS SHOW
  function detectarClaseShow() {
    if (modalAdministrativo.classList.contains("show")) {
      // Se ha encontrado la clase "show"
      
    }else{
      if(video){
        video.remove();
      }
    }
  }
  function ejecutarDeteccion() {
    setInterval(detectarClaseShow, 1000);
  }
  
  ejecutarDeteccion();
  console.log("Modal adminsitrativo del sistema");
}else{
  console.log("No modal adminsitrativo del sistema");
}



if (modalContribuyente) {
  // FUNCION PARA VIDEOS CONTRIBUYENTES SHOW
  function detectarClaseShow2() {
    if (modalContribuyente.classList.contains("show")) {
      // Se ha encontrado la clase "show"
      
    }else{
      if(video){
        video.remove();
      }
    }
  }
  function ejecutarDeteccion2() {
    setInterval(detectarClaseShow2, 1000);
  }
  
  ejecutarDeteccion2();
  console.log("Modal Contribuyente");
}else{
  console.log("No Modal Contribuyente");
}


////////////////////////////////////////////////////////////////////////////////////////////////
//EVENTO PARA ELIMINAR EL VIDEO A LA HORA DE CERRAR EL MODAL  CON EL BOTON CERRAR
contenedorBoton.addEventListener("click", () => {
  // Eliminar el elemento `video`
  video.remove();
});

/*EVENTO PARA ELIMINAR EL VIDEO A LA HORA DE CERRAR EL MODAL  CON EL BOTON X
contenedorBotonX.addEventListener("click", () => {
  // Eliminar el elemento `video`
  video.remove();
});*/


// Comprobar si el spinner existe se le cambia esta clase 
if (spinner) {
  spinner.style.animation = "spinner-border 1.2s linear infinite";
}

//////////////////////// CONTADOR Y DATOS DEL ADMINISTRADOR
if (modalAdministrativo) {
   //funcion para ejecutar el desactivado automatico
   function ocultarModalAutomaticamente() {
    // Contador para mostrar en la consola
    let tiempoRestante = 5;

    // Intervalo para actualizar el contador
    const intervalo = setInterval(() => {
      // Decrementa el tiempo restante
      tiempoRestante--;

      // Muestra el tiempo restante en la consola
      console.log(`Tiempo restante: ${tiempoRestante} segundos`);
      //tiempo dentro del spinner
      // Comprobar si el contendor del spinner existe se le cambia esta clase 
      if (contador_spinner) {
        contador_spinner.textContent = tiempoRestante;
        contador_spinner.style.fontSize = "16px";
      }
        
      // Oculta el modal cuando el tiempo llegue a 0
      if (tiempoRestante === 0) {

        clearInterval(intervalo);
        
         // contenedorBotonX.disabled = false;
          contenedorBoton.disabled = false;

        if(spinner){
          spinner.style.borderRightColor = "#007bff";
        }
      
      }
    }, 1000);
  }
  // Se inicia el temporizador para cerrar el modal
  ocultarModalAutomaticamente();
}

else if (modalContribuyente) {
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
      //tiempo dentro del spinner
      // Comprobar si el contendor del spinner existe se le cambia esta clase 
      if (contador_spinner) {
        contador_spinner.textContent = tiempoRestante;
        contador_spinner.style.fontSize = "16px";
      }
         
      // Oculta el modal cuando el tiempo llegue a 0
      if (tiempoRestante === 0) {
  
        clearInterval(intervalo);
        
          //contenedorBotonX.disabled = false;
          contenedorBoton.disabled = false;      
              
        if(spinner){
          spinner.style.borderRightColor = "#007bff";
        }
        
      }
    }, 1000);
  }
  // Se inicia el temporizador para cerrar el modal
  ocultarModalAutomaticamente();
  
}


$(".haciendaTexto").show();
$(".ambienteTexto").hide();
const contenedorHacienda = document.querySelector(".hacienda");
const contenedorAmbiente = document.querySelector(".ambiente");
const textoBanner = document.querySelector("#municipal");


const verificarClase = () => {
  const tieneClaseHacienda = contenedorHacienda.classList.contains("active");
  const tieneClaseAmbiente = contenedorAmbiente.classList.contains("active");

  if (tieneClaseHacienda) {
    municipal.textContent  = 'Hacienda Municipal';
    $(".haciendaTexto").show();
    $(".ambienteTexto").hide();
  } else if (tieneClaseAmbiente) {
   
    municipal.textContent  = 'Aseo Municipal';
    $(".haciendaTexto").hide();
    $(".ambienteTexto").show();
  }
};

window.onload = verificarClase; // Se ejecuta al cargar la página

setInterval(verificarClase, 320);