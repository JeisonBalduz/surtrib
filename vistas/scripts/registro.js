function init() {
  $("#formularioc").on("submit", function (e) {
    guardar(e);
  });
}

$("#login").change(function (e) {
  e.preventDefault();
  logina = $("#login").val();

  $.post(
    "../ajax/registro.php?op=verificarlogina",
    { logina: logina },
    function (data) {
      if (data != "null") {
        bootbox.alert("Nombre de Usuario ya Registrado intente con otro");
        $("#login").val("");
      } else {
      }
    }
  );
});

$("#numerodocumento").change(function (e) {
  e.preventDefault();
  numerodocumento = $("#numerodocumento").val();

  $.post(
    "../ajax/registro.php?op=verificarnumerodocumento",
    { numerodocumento: numerodocumento },
    function (data) {
      if (data != "null") {
        bootbox.alert("Numero de RIJ ya registrado");
        $("#numerodocumento").val("");
        $("#tipodocumento").val("");
      } else {
      }
    }
  );
});

function guardar(e) {
  e.preventDefault(); //No se activará la acción predeterminada del evento
  clave = $("#clave").val();
  clave2 = $("#clave2").val();

  if (clave == clave2) {
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formularioc")[0]);

    $.ajax({
      url: "../ajax/registro.php?op=guardar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,

      success: function (datos) {
        bootbox.alert(
          "Se ha completado el registro de usuario con el numero de RFC:" +
            datos +
            " como usuario para ingreso del sistema"
        );
      },
    });
    {
      bootbox.alert("Ingrese al Inicio");
    }
  } else {
    bootbox.alert("Las claves no coinciden");
  }
}

init();
////////////////// FUNCIONES DEL REGISTRO /////////////////////////

////////INPUTS SELECCIONADOS
let rif = document.getElementById("numerodocumento");
let telefono = document.getElementById("telefonousuario");
let inputCorreo = document.getElementById("email");
let candado1 = document.getElementById("candado1");
let candado2 = document.getElementById("candado2");
let select = document.getElementById("tipodocumento");
let nombre = document.getElementById("nombre");
let clave = document.getElementById("clave");
let clave2 = document.getElementById("clave2");
let checkbox = document.querySelector("input[type='checkbox']");
let botonRegistrar = document.getElementById("btnGuardar");

/////// MENSAJES
let mensajeError = document.getElementById("mensajeError");
let mensajeErrorTelefono = document.getElementById("mensajeErrorTelefono");
let mensajeErrorCorreo = document.getElementById("mensajeErrorCorreo");
let mensajeErrorContraseña1 = document.getElementById(
  "mensajeErrorContraseña1"
);
let mensajeErrorContraseña2 = document.getElementById(
  "mensajeErrorContraseña2"
);

////// INPUTS DESABILITADOS
nombre.disabled = true;
rif.disabled = true;
clave.disabled = true;
clave2.disabled = true;
inputCorreo.disabled = true;
telefono.disabled = true;

//función para la cadena de cacteres permitido
function ValidarCantidadCaracteresRIF(input) {
  // Asignamos el evento "keydown" al input
  input.addEventListener("keydown", (event) => {
    // Obtenemos el carácter de la tecla presionada
    const key = event.key;
    const keycode = event.keyCode;
    const valor = input.value;
    // Si la tecla presionada es la tecla backspace, permitimos que se borre el texto
    if (
      key === "Backspace" ||
      key === "ArrowLeft" ||
      key === "ArrowRight" ||
      keycode === 37 ||
      keycode === 39
    ) {
      mensajeError.innerHTML = "";
      return;
    }
  });
  // Asignamos el evento "input" al input
  input.addEventListener("input", (event) => {
    // Obtenemos el valor del input
    const valor = input.value;
    // Obtenemos el valor original del input
    const valorOriginal = input.value.slice(0, 11);
    // Si la longitud del valor ha cambiado y ahora es mayor que 10, establecemos el valor del input al valor original
    if (valor !== valorOriginal) {
      input.value = valorOriginal;
    }
    // Si la longitud del valor es menor que 6, mostramos un mensaje de error
    if (valor.length < 6) {
      nombre.disabled = true;
      mensajeError.innerHTML =
        "El número de documento debe tener 6 caracteres como minimo.";
      mensajeError.classList.add("text-danger");
      //contador2 = 0;
    } else {
      nombre.disabled = false;
      mensajeError.innerHTML = "";
      //contador2 = 2;
    }
  });
}
ValidarCantidadCaracteresRIF(document.getElementById("numerodocumento"));

//funcion de caracteres en el telefono
function CantidadCaracteresTelefono(input) {
  // Asignamos el evento "keydown" al input
  input.addEventListener("keydown", (event) => {
    // Obtenemos el carácter de la tecla presionada
    const key = event.key;
    const keycode = event.keyCode;
    const valor = input.value;
    // Si la tecla presionada es la tecla backspace, permitimos que se borre el texto
    if (
      key === "Backspace" ||
      key === "ArrowLeft" ||
      key === "ArrowRight" ||
      keycode === 37 ||
      keycode === 39
    ) {
      mensajeErrorTelefono.innerHTML = "";
      return;
    }
  });
  // Asignamos el evento "input" al input
  input.addEventListener("input", (event) => {
    // Obtenemos el valor del input
    const valor = input.value;
    // Obtenemos el valor original del input
    const valorOriginal = input.value.slice(0, 11);
    // Si la longitud del valor ha cambiado y ahora es mayor que 11, establecemos el valor del input al valor original
    if (valor !== valorOriginal) {
      input.value = valorOriginal;
    }
    // Si la longitud del valor es menor que 10, mostramos un mensaje de error
    if (valor.length < 11) {
      mensajeErrorTelefono.innerHTML =
        "El número de documento solo puede tener 11 caracteres como máximo.";
      mensajeErrorTelefono.classList.add("text-danger");
      clave.disabled = true;
      //contador5 = 0;
    } else {
      mensajeErrorTelefono.innerHTML = "";
      clave.disabled = false;
      //contador5 = 5;
    }
  });
}
CantidadCaracteresTelefono(document.getElementById("telefonousuario"));

//funcion de caracteres en el telefono
function CantidadCaracteresNombre(input) {
  // Asignamos el evento "keydown" al input
  input.addEventListener("keydown", (event) => {
    // Obtenemos el carácter de la tecla presionada
    const key = event.key;
    const keycode = event.keyCode;
    const valor = input.value;
    // Si la tecla presionada es la tecla backspace, permitimos que se borre el texto
    if (
      key === "Backspace" ||
      key === "ArrowLeft" ||
      key === "ArrowRight" ||
      keycode === 37 ||
      keycode === 39
    ) {
      mensajeErrorNombre.innerHTML = "";
      return;
    }
  });
  // Asignamos el evento "input" al input de nombre
  input.addEventListener("input", (event) => {
    // Obtenemos el valor del input
    const valor = input.value;
    // Si la longitud del valor es menor que 10, mostramos un mensaje de error
    if (valor.length < 3) {
      inputCorreo.disabled = true;
      mensajeErrorNombre.innerHTML =
        "Se debe de colocar un margen de 3 caracteres en este campo";
      mensajeErrorNombre.classList.add("text-danger");
      //contador3 = 0;
      //.log(contador3);
    } else {
      inputCorreo.disabled = false;
      mensajeErrorNombre.innerHTML = "";
      //contador3 = 3;
    }
  });
}
CantidadCaracteresNombre(document.getElementById("nombre"));

//Funcion de permitir solo numeros de rif
function NumerosRif(evt) {
  // code is the decimal ASCII representation of the pressed key.
  var code = evt.which ? evt.which : evt.keyCode;

  if (code == 8) {
    // backspace.
    return true;
  } else if (code >= 48 && code <= 57) {
    // valido.
    mensajeError.innerHTML = "";
    return true;
  } else {
    // invalido.
    mensajeError.innerHTML = "Solo se permiten números dentro de este campo.";
    mensajeError.classList.add("text-danger");
    return false;
  }
}

//Funcion de permitir solo de numeros de telefono
function NumerosTelefono(evt) {
  // code is the decimal ASCII representation of the pressed key.
  var code = evt.which ? evt.which : evt.keyCode;

  if (code == 8) {
    // backspace.
    return true;
  } else if (code >= 48 && code <= 57) {
    // valido.
    mensajeErrorTelefono.innerHTML = "";
    return true;
  } else {
    // invalido.
    mensajeErrorTelefono.innerHTML =
      "Solo se permiten números dentro de este campo.";
    mensajeErrorTelefono.classList.add("text-danger");
    return false;
  }
}

// Asignamos el evento "input" al input
let valorClave1;
function ValidarCantidadClave(input) {
  // Asignamos el evento "keydown" al input
  input.addEventListener("keydown", (event) => {
    // Obtenemos el carácter de la tecla presionada
    const key = event.key;
    const keycode = event.keyCode;
    const valor = input.value;
    // Si la tecla presionada es la tecla backspace, permitimos que se borre el texto
    if (
      key === "Backspace" ||
      key === "ArrowLeft" ||
      key === "ArrowRight" ||
      keycode === 37 ||
      keycode === 39
    ) {
      mensajeError.innerHTML = "";
      return;
    }
  });
  // Asignamos el evento "input" al input
  input.addEventListener("input", (event) => {
    // Obtenemos el valor del input
    const valor = input.value;
    // Obtenemos el valor original del input
    const valorOriginal = input.value.slice(0, 11);
    // Si la longitud del valor ha cambiado y ahora es mayor que 10, establecemos el valor del input al valor original
    if (valor !== valorOriginal) {
      input.value = valorOriginal;
    }
    // Si la longitud del valor es menor que 10, mostramos un mensaje de error
    if (valor.length < 6) {
      mensajeErrorContraseña1.innerHTML =
        "Se debe de colocar un minimo de 6 caracteres en el campo";
      mensajeErrorContraseña1.classList.add("text-danger");
      //contador6 = 0;
      clave2.disabled = true;
    } else {
      clave2.disabled = false;
      mensajeErrorContraseña1.innerHTML = "";
      //contador6 = 6;

      // Asignamos el valor del input a la variable clave1
      valorClave1 = valor;
    }
  });
}
ValidarCantidadClave(document.getElementById("clave"));

//Seleccion de opciones dentro del selec
select.addEventListener("change", (event) => {
  const value = event.target.value;

  if (value === "V" || value === "J" || value === "E" || value === "G" || value === "S") {
    //contador1 + 1;
    //console.log(contador1);
    rif.disabled = false;
  } else {
    rif.disabled = true;
  }
});

// Asignamos el evento "input" al input
clave2.addEventListener("input", (event) => {
  clave2.addEventListener("keydown", (event) => {
    // Obtenemos el carácter de la tecla presionada
    const key = event.key;
    const keycode = event.keyCode;
    const valor =  clave2.value;
    // Si la tecla presionada es la tecla backspace, permitimos que se borre el texto
    if (
      key === "Backspace" ||
      key === "ArrowLeft" ||
      key === "ArrowRight" ||
      keycode === 37 ||
      keycode === 39
    ) {
      mensajeError.innerHTML = "";
      return;
    }
  });
  // Obtenemos el valor del input
  const valor2 = clave2.value;
  // Si la longitud del valor es menor que 10, mostramos un mensaje de error
  if (valor2.length <= 20) {
    var valor20 = valor2;
    console.log(valor20);
    console.log(valorClave1 + "----" + valor20);
    if (valorClave1 === valor20) {
      mensajeErrorContraseña2.innerHTML = "";
      //contador7 = 7;
    } else {
      //contador7 = 0;

      mensajeErrorContraseña2.innerHTML =
        "La contraseña no es igual a la anterior, verificar la contraseña anterior";
      mensajeErrorContraseña2.classList.add("text-danger");
    }
  }
});
// docuemtno para validar el teclado del telefono
document.addEventListener("DOMContentLoaded", function(){
  
  var numerosDocumentos = document.getElementById("numerodocumento"); 
  numerosDocumentos.addEventListener("keypress", function (event){
    var keyCode = event.keycode || event.which;
    if (keyCode < 48 || keyCode > 57) {
      event.preventDefault();
    }
  });
  
  numerosDocumentos.addEventListener("input", function() {
    var value = this.value;
    value = value.replace(/[^0-9]/g, "");
    this.value = value;
  })

});
//checkbox de terminos de registro
checkbox.addEventListener("change", (event) => {
  if (checkbox.checked) {
    contador8 = 8;
  } else {
    contador8 = 0;
  }
});

//evento de @ y gmail.com y hotmail.com en el correo
inputCorreo.addEventListener("keyup", function () {
  // Obtener el texto del input
  const texto = inputCorreo.value;

  // Verificar si contiene el carácter @
  if (!texto.includes("@")) {
    // Mensaje de error
    mensajeErrorCorreo.innerHTML =
      "El correo que se ha colocado le falta @ para su funcionamiento";
    mensajeErrorCorreo.classList.add("text-danger");
    contador4 = 0;

    return;
  }
  // Obtener la cadena después del carácter @

  // Obtener el dominio
  const dominio = texto.substring(texto.indexOf("@") + 1, texto.length);
  // Verificar si el dominio es Gmail o Hotmail
  if (dominio === "gmail.com" || dominio === "hotmail.com") {
    // Mensaje de error oculto
    mensajeErrorCorreo.innerHTML = "";
    //contador4 = 4;
    telefono.disabled = false;
  } else {
    //contador4 = 0;
    telefono.disabled = true;
    // Mensaje de error
    mensajeErrorCorreo.innerHTML =
      "El correo que se ha colocado debe terminar en gmail.com o hotmail.com";
    mensajeErrorCorreo.classList.add("text-danger");
  }
});

candado1.addEventListener("click", function () {
  const clave1 = document.getElementById("clave");

  clave1.type = clave1.type === "password" ? "text" : "password";
});

candado2.addEventListener("click", function () {
  const clave2 = document.getElementById("clave2");

  clave2.type = clave2.type === "password" ? "text" : "password";
});

candado1.style.cursor = "pointer";
candado2.style.cursor = "pointer";

