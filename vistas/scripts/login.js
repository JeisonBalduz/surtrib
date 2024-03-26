
$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../ajax/usuarios.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {
            data2 = JSON.parse(data);
           if (data2.nivel == 2) {
                console.log("es nivel contribuyente")
           } else {
            console.log("no es nivel contribuyente")
           }
           
        }
        else
        {
            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
})

let candado= document.getElementById("candado");
candado.addEventListener("click", function () {
    const clave2 = document.getElementById("clavea");
  
    clave2.type = clave2.type === "password" ? "text" : "password";
});
candado.style.cursor = "pointer";