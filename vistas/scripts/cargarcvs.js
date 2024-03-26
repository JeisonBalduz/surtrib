

//Funcion que se ejecuta al inicio

function init() {

}

function uploadContacts()
    {

        var Form = new FormData($('#filesForm')[0]);
        $.ajax({

            url: "../vistas/recibe_excel_validando.php",
            type: "post",
            data : Form,
            processData: false,
            contentType: false,
            success: function(data)
            {
             alert("Registros Agregados!");
            }
        });
    }


init();