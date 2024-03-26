function buscar_datos(event) {
  event.preventDefault();
  // Dato de busqueda en la base de datos personal
  ruf = $("#ruf").val();
  console.log(ruf);
  var parametros = {
    buscar: "1",
    ruf: ruf,
  };

  var op = "buscarRegistro";
  ///peticion en ajaxx
  $.ajax({
    data: parametros,
    dataType: "json",
    url: "../ajax/vehiculos.php?op=" + op,
    type: "POST",
    beforeSend: function () {},
    //error busqueda del personal no encontrada
    error: function () {
      alert("la peticion no se pudo enviar ");
    },
    // al completarse las funciones sea de error a de peticion se ba a ejecutar esta funcion
    complete: function () {
     
    },

    // incorporar datos  buscados en php para incorporarlos en los inputs
    success: function (valores) {
      if (valores.existe == "1") {
        bootbox.alert("Usuario encontrado con exito!.");
        //Aqui usamos la variable que NO use en el vídeo
        $("#nombre").val(valores.name);
        $("#rif").val(valores.rif);
      }
      // personal no encontrado en la base de datos
      else {
        bootbox.alert("La persona no fue encontrada, no se encuentra en nuestra base de datos.");
      }
    },
  });
}



//limpiar();
