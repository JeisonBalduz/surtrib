<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Clientes']==1)
{
   // require "../config/Conexion.php";
?>
    <!-- Inicio Contenido PHP-->
<style>
.content-popup {
    top: 1px;
    width:70%;
    overflow-y: auto;
    height: 98%;
    left: 40%;
    margin-left: -320px;
}
.letra {
    font-size: 12px;
}
</style>
<style type="text/css">
   .Divcontenedor,.cuartopasodetalles {  
display: table;
border-spacing: 5px;
overflow: hidden;
width: 100%;
 /*background: -webkit-linear-gradient(left, #FFFFFF, #f0f0f0);
 background: -moz-linear-gradient(left, #FFFFFF,#f0f0f0);
 border: 1px solid gray;
  redondear esquinas*/
 -moz-border-radius: 5px;
 -webkit-border-radius: 5px;
 border-radius: 5px;
}
.contenedor {  
display: table;
border-spacing: 5px;
overflow: hidden;
width: 95%;
/* background: -webkit-linear-gradient(left, #FFFFFF, #f0f0f0);
 background: -moz-linear-gradient(left, #FFFFFF,#f0f0f0);
 border: 1px solid gray;
  redondear esquinas*/
 -moz-border-radius: 5px;
 -webkit-border-radius: 5px;
 border-radius: 5px;
}
.contenidos { /*background:yellow;*/
display: table-row;
 
}
.primerCol, .unida, .mitadcell {
display: table-cell;
/*border: 1px solid gray;*/
}
.primerCol , .mitadcell, .unida {
  font-size: 12px;

}
.primerCol label,  .unida label , .mitadcell label  {
  font-size: 12px;
  font-weight: normal;
  font-style: normal;
}
.primerCol {
width: 25%;
}
.mitadcell {
width: 50%;
}
.unida{
  width: 100%;
}
.ContentPlaceHolder{ 
                  background:#FFFFFF;
                    } 

</style>
<section class="content">
  <div class="container-fluid">
      
    

       <div class="container-fluid">
    <h2 class="text-center">Bienvenidos al log Acceso</h2>
    <p class="datatable design text-center">Lista de Conexión</p>
    <div class="row">
      <div class="container"><!--
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>
        </div>  -->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Actividad</th>
                <th>fecha</th>
                <th>IP</th>
                
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>





 </div>
</section>
	
	
	
<!-- The Modal -->
<style type="text/css">
      label div{
            font-weight: normal;
      }
</style>
<div class="modal" id="myModal" style="overflow-y:scroll;height:90%;">
  <div class="modal-dialog">
    <div class="modal-content" >

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Datos de la construcción</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
         <div class="form-group">

          <!--<input type="text" id="username" placeholder="User Name" class="form-control"/>-->
          <!-- <div id="confirmdetails">Confirmation details go here...</div>-->
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
	

<div id="popup" style="display: none;">

    <div class="content-popup">

        <div class="close" ><a href="#" id="close">X</a></div>
        
        <div id="contenidoPopup">
        </div>

                                    
                    </div>
    </div>
    
</div>
    

    <!-- Fin Contenido PHP-->
    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript">
            $(document).ready(function() {
              
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
         },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        
        'ajax': {
          'url': '../ajax/ajaxadmin.php?op=listar',        //fetch_data.php
          'type': 'post','op':'listar' ,
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });
        </script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

