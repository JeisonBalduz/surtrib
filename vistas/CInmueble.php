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
    require "../config/Conexion.php";
?>
    <!-- Inicio Contenido PHP-->

<section class="content">
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
		
		
          <div class="card" id="listadoregistros">
                     <div class="card-header">
                            <h3 class="card-title">Inmueble  </h3>
                            <a href="CInmueble.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                       </div>
            <!-- /.card-header -->
			                                           
                                  <div class="card-body">
                                 <table id="tbllistado" class="table table-bordered table-hover">
                                    <thead>
                                          <tr> 
                                               
                                                 <th>INSCRIPCIÓN CATASTRAL</th>
                                                  <th>TÍTULO</th>                                   
                                                  <th>AÑO DE AVALUO</th>
                                                  <th>USO</th>
                                                  <th>TENENCIA</th>
                                                 <th>ÚLTIMO PAGO</th>
                                                 <th>AÑO AVALUO</th>
                                                 
                                                 
                                          </tr>
                                    </thead>
                                  <tbody>
                                     
                                 </tbody>
                                   <tfoot>
                                      <tr> 
                                               
                                                 <th>INSCRIPCIÓN CATASTRAL</th>
                                                  <th>TÍTULO</th>                                   
                                                  <th>AÑO DE AVALUO</th>
                                                  <th>USO</th>
                                                  <th>TENENCIA</th>
                                                 <th>ÚLTIMO PAGO</th>
                                                 <th>AÑO AVALUO</th>
                                                 
                                                 
                                          </tr>
											
                                      </tfoot>
                                  </table>
                             </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        

			
	</div>
        <!-- /.col -->
      </div>
 </div>
</section>
	
	
	
<!-- The Modal -->
<style type="text/css">
      label div{
            font-weight: normal;
      }
</style>

	


    
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
        <script type="text/javascript" src="scripts/Cinmueble.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>

