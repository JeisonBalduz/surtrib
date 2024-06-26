//Datatablet
/*$(document).ready(function () {
  $("#tbllistado22").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    lengthMenu: [6, 10, 25],
    pageLength: 6,
    ajax: "../ajax/usuarios.php?op=listar",
    type: "POST",
    language: {
      processing: "Procesando...",
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      emptyTable: "Ningún dato disponible en esta tabla",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      search: "Buscar:",
      infoThousands: ",",
      loadingRecords: "Cargando...",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
      aria: {
        sortAscending: ": Activar para ordenar la columna de manera ascendente",
        sortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
      buttons: {
        copy: "Copiar",
        colvis: "Visibilidad",
        collection: "Colección",
        colvisRestore: "Restaurar visibilidad",
        copyKeys:
          "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
        copySuccess: {
          1: "Copiada 1 fila al portapapeles",
          _: "Copiadas %ds fila al portapapeles",
        },
        copyTitle: "Copiar al portapapeles",
        csv: "CSV",
        excel: "Excel",
        pageLength: {
          "-1": "Mostrar todas las filas",
          _: "Mostrar %d filas",
        },
        pdf: "PDF",
        print: "Imprimir",
        renameState: "Cambiar nombre",
        updateState: "Actualizar",
        createState: "Crear Estado",
        removeAllStates: "Remover Estados",
        removeState: "Remover",
        savedStates: "Estados Guardados",
        stateRestore: "Estado %d",
      },
      autoFill: {
        cancel: "Cancelar",
        fill: "Rellene todas las celdas con <i>%d</i>",
        fillHorizontal: "Rellenar celdas horizontalmente",
        fillVertical: "Rellenar celdas verticalmentemente",
      },
      decimal: ",",
      searchBuilder: {
        add: "Añadir condición",
        button: {
          0: "Constructor de búsqueda",
          _: "Constructor de búsqueda (%d)",
        },
        clearAll: "Borrar todo",
        condition: "Condición",
        conditions: {
          date: {
            after: "Despues",
            before: "Antes",
            between: "Entre",
            empty: "Vacío",
            equals: "Igual a",
            notBetween: "No entre",
            notEmpty: "No Vacio",
            not: "Diferente de",
          },
          number: {
            between: "Entre",
            empty: "Vacio",
            equals: "Igual a",
            gt: "Mayor a",
            gte: "Mayor o igual a",
            lt: "Menor que",
            lte: "Menor o igual que",
            notBetween: "No entre",
            notEmpty: "No vacío",
            not: "Diferente de",
          },
          string: {
            contains: "Contiene",
            empty: "Vacío",
            endsWith: "Termina en",
            equals: "Igual a",
            notEmpty: "No Vacio",
            startsWith: "Empieza con",
            not: "Diferente de",
            notContains: "No Contiene",
            notStartsWith: "No empieza con",
            notEndsWith: "No termina con",
          },
          array: {
            not: "Diferente de",
            equals: "Igual",
            empty: "Vacío",
            contains: "Contiene",
            notEmpty: "No Vacío",
            without: "Sin",
          },
        },
        data: "Data",
        deleteTitle: "Eliminar regla de filtrado",
        leftTitle: "Criterios anulados",
        logicAnd: "Y",
        logicOr: "O",
        rightTitle: "Criterios de sangría",
        title: {
          0: "Constructor de búsqueda",
          _: "Constructor de búsqueda (%d)",
        },
        value: "Valor",
      },
      searchPanes: {
        clearMessage: "Borrar todo",
        collapse: {
          0: "Paneles de búsqueda",
          _: "Paneles de búsqueda (%d)",
        },
        count: "{total}",
        countFiltered: "{shown} ({total})",
        emptyPanes: "Sin paneles de búsqueda",
        loadMessage: "Cargando paneles de búsqueda",
        title: "Filtros Activos - %d",
        showMessage: "Mostrar Todo",
        collapseMessage: "Colapsar Todo",
      },
      select: {
        cells: {
          1: "1 celda seleccionada",
          _: "%d celdas seleccionadas",
        },
        columns: {
          1: "1 columna seleccionada",
          _: "%d columnas seleccionadas",
        },
        rows: {
          1: "1 fila seleccionada",
          _: "%d filas seleccionadas",
        },
      },
      thousands: ".",
      datetime: {
        previous: "Anterior",
        next: "Proximo",
        hours: "Horas",
        minutes: "Minutos",
        seconds: "Segundos",
        unknown: "-",
        amPm: ["AM", "PM"],
        months: {
          0: "Enero",
          1: "Febrero",
          10: "Noviembre",
          11: "Diciembre",
          2: "Marzo",
          3: "Abril",
          4: "Mayo",
          5: "Junio",
          6: "Julio",
          7: "Agosto",
          8: "Septiembre",
          9: "Octubre",
        },
        weekdays: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
      },
      editor: {
        close: "Cerrar",
        create: {
          button: "Nuevo",
          title: "Crear Nuevo Registro",
          submit: "Crear",
        },
        edit: {
          button: "Editar",
          title: "Editar Registro",
          submit: "Actualizar",
        },
        remove: {
          button: "Eliminar",
          title: "Eliminar Registro",
          submit: "Eliminar",
          confirm: {
            _: "¿Está seguro que desea eliminar %d filas?",
            1: "¿Está seguro que desea eliminar 1 fila?",
          },
        },
        error: {
          system:
            'Ha ocurrido un error en el sistema (<a target="\\" rel="\\ nofollow" href="\\">Más información&lt;\\/a&gt;).</a>',
        },
        multi: {
          title: "Múltiples Valores",
          info: "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
          restore: "Deshacer Cambios",
          noMulti:
            "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
        },
      },
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      stateRestore: {
        creationModal: {
          button: "Crear",
          name: "Nombre:",
          order: "Clasificación",
          paging: "Paginación",
          search: "Busqueda",
          select: "Seleccionar",
          columns: {
            search: "Búsqueda de Columna",
            visible: "Visibilidad de Columna",
          },
          title: "Crear Nuevo Estado",
          toggleLabel: "Incluir:",
        },
        emptyError: "El nombre no puede estar vacio",
        removeConfirm: "¿Seguro que quiere eliminar este %s?",
        removeError: "Error al eliminar el registro",
        removeJoiner: "y",
        removeSubmit: "Eliminar",
        renameButton: "Cambiar Nombre",
        renameLabel: "Nuevo nombre para %s",
        duplicateError: "Ya existe un Estado con este nombre.",
        emptyStates: "No hay Estados guardados",
        removeTitle: "Remover Estado",
        renameTitle: "Cambiar Nombre Estado",
      },
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "login" },
      { data: "telefono" },
      { data: "rifci" },
      { data: "actions" },
    ],
  });
});
*/

var tabla;

//Función que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit", function (e) {
    guardaryeditar(e);
  });

  $("#imagenmuestra").hide();
  //Mostramos los permisos
  $.post("../ajax/usuarios.php?op=permisos&id=", function (r) {
    $("#permisos").html(r);
  });
}

//Función limpiar
function limpiar() {
  $("#tipodocumento").val("");
  $("#numerodocumento").val("");
  $("#nombre").val("");
  $("#login").val("");
  $("#email").val("");
  $("#telefonousuario").val("");
  $("#clave").val("");
  $("#direccionusuario").val("");
  $("#imagenmuestra").attr("src", "");
  $("#imagenactual").val("");
  $("#rol").val("");
  $("#rif").val("");
}

//Función mostrar formulario
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

//Función cancelarform
function cancelarform() {
  limpiar();
  mostrarform(false);
}

function mostrar(idusuario) {
  $.post(
    "../ajax/usuarios.php?op=mostrar",
    { idusuario: idusuario },
    function (data, status) {
      data = JSON.parse(data);
      mostrarform(true);

      $("#tipodocumento").val(data.tipodocumento);
      $("#numerodocumento").val(data.numerodocumento);
      $("#nombre").val(data.name);
      $("#login").val(data.usuario);
      $("#email").val(data.email);
      $("#telefonousuario").val(data.tel);
      $("#clave").val(data.clave);

      $("#rif").val(data.rif);
      $("#direccionusuario").val(data.correo);
      $("#imagenmuestra").show();
      $("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen);
      $("#imagenactual").val(data.imagen);
      $("#rol").val(data.rol);
      $("#idusuario").val(data.id);
    }
  );
  $.post("../ajax/usuarios.php?op=permisos&id=" + idusuario, function (r) {
    $("#permisos").html(r);
  });
}
function listar() {
  $("#tbllistado22")
    .DataTable({
      responsive: true,
      autoWidth: false,
      language: {
        info: "Vista _START_ a _END_ de _TOTAL_ registros",
        search: "Buscar",
        previous: "Previo",
        lengthMenu: "Ver _MENU_ registro por pagina",
      },
      buttons: ["copyHtml5", "excelHtml5", "pdf"],
      ajax: {
        url: "../ajax/usuarios.php?op=listarUsuarioContraseña",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
    })
    .DataTable();
}

//Función para guardar o editar
$(document).ready(function () {
  $("#formulario").on("submit", function (e) {
    e.preventDefault();
    var formulario = $(this).serialize();
    $.ajax({
      method: "POST",
      url: "../ajax/usuariocambios.php",
      data: formulario,
    }).done(function (info) {
      if (info === "ok") {
        $("#mensaje").append(
          '<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert" id="contenedor">' +
            '<i class="bi bi-check-circle"></i>' +
            "<strong>Actualización exitosa!</strong> Los datos se actualizaron correctamente." +
            "</div>"
        );
        setTimeout(() => {
          $("#contenedor").remove();
        }, 10000);
        //limpiamos todos los inputs
        limpiar();
        $("#formularioregistros").hide();
        $("#listadoregistros").show();
      } else {
        $("#mensaje").append(
          '<div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert" id="contenedor">' +
            '<i class="bi bi-check-circle"></i>' +
            "<strong>Error en la actualizacion!</strong> Los datos no se pudieron actualizar correctamente, revise si todos los campos fueron llenados correctamente" +
            "</div>"
        );
        setTimeout(() => {
          $("#contenedor").remove();
        }, 13000);

        limpiar();
        $("#formularioregistros").hide();
        $("#listadoregistros").show();
      }
    });
  });
});

init();
