<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

include("../config/Conexion.php");



$rfc = $_SESSION["rfc"];


$sql = "SELECT COUNT(id) AS nvehiculos FROM `vehicle` WHERE `rfc`='$rfc'";
$sql2 = "SELECT COUNT(id) AS nactividades FROM `relcompanyactivity` WHERE `rfc`='$rfc'";
$sql3 = "SELECT COUNT(Id_Inm) AS ninmuebles FROM `inmuebles` WHERE `rfc`='$rfc'";

$link = $conexion;


if (mysqli_connect_errno()) {
}
 if ($result = mysqli_query($link,$sql)) {

while ($obj = mysqli_fetch_object($result)) {
    $nvehiculos=$obj->nvehiculos;
 }
  mysqli_free_result($result);
}

if (mysqli_connect_errno()) {
}
 if ($result = mysqli_query($link,$sql2)) {

while ($obj = mysqli_fetch_object($result)) {
    $nactividades=$obj->nactividades;
 }
  mysqli_free_result($result);
}

if (mysqli_connect_errno()) {
}
 if ($result = mysqli_query($link,$sql3)) {

while ($obj = mysqli_fetch_object($result)) {
    $ninmuebles=$obj->ninmuebles;
    if ($ninmuebles==null){
       $ninmuebles=0;
    }
   // $ninmuebles=20;
 }
  mysqli_free_result($result);
}

if ($_SESSION['rol'] > 2 && $_SESSION['rol'] <= 98) 
{
  header("Location: concepto.php");
}

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['Escritorio']==1)
{
?>

<style>
  /* estilos para contenedor: de las imagenes dentro del modal de anuncios */
  #anuncio img {
    width: 90%;
    height: 100%;
  }
    
    .carousel-item img{
    height: 500px;
    width: 470px;
  }
  /* CAMBIAR TAMAﾃ前 Y ANCHO DEL VIDEO */
   .modal video{
    width: 498px;
    height: 590px; 
  }
  /* estilos para contenedor: indicador de las imagenes en carrusel */
  #carouselExampleIndicators{
    padding-right: 0px !important;
  }
  /* color y posicion del contendor de los botones del carrucel */
  .carousel-indicators{
    position: relative !important;
    background-color:#6c757d ;
  }
   /* COLOR PARA TODOS LOS MODALES DEL SISTEMA */
  .modal-footer{
    background:#001f3f;
  }
   /* estilos para contenedor MEDIACUERY: de las imagenes dentro del modal de anuncios */
  @media only screen and (max-width: 410px) {
    #anuncio img {
      width: 110%;
      height: auto;
    }
    .carousel-item img{
    height: 400px;
    width: 310px;
    }
    .modal video{
    width: 450px;
    height: 260px; 
  }
  }
</style>
<?php
require './anuncio.php';
?>


<div class="row">

<div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="background: url('../public/images/campo.jpg') center center;">
                <h3 class="widget-user-username text-right">Alcaldia del Municipio Libertador</h3>
                <h5 class="widget-user-desc text-right">Hacienda Municipal</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="../public/images/libertador.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">RECUERDE PAGAR SUS IMPUESTOS ANTES DEL: 15/04/2024</h5>
                      <span class="description-text">Evite Sanciones, Estimado contribuyente mantener sus obligaciones tributarias al día es importante</span>
                    </div>
                    
                    <!-- /.description-block -->
                  </div>
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">39,26 Bs</h5>
                      <span class="description-text">Valor del ITM</span>
                      <span class="description-text">En Fecha 01/04/2024</span>
                    </div>
                    
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>

            </div>
            <!-- /.widget-user -->
          </div>
         
<!--
</div>
<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $nactividades; ?></h3>

                <p>Actividades Economicas Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">Ir a consulta <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col
          <div class="col-lg-3 col-6">
            <!-- small box
            <div class="small-box bg-danger">
              <div class="inner">
              <h3><?php echo $nvehiculos; ?></h3>
                 <!-- <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Vehiculos Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">Ir a consulta <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Publicidades Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">Ir a consulta <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col
          <div class="col-lg-3 col-6">
            <!-- small box
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $ninmuebles; ?></h3>

                <p>Inmuebles Registradas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">Ir a consulta <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col
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
<script type="text/javascript" src="scripts/concepto.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
<script type="text/javascript" src="scripts/cierre-sesion.js"></script>
<?php 
}
ob_end_flush();
?>

