<?php

include("../config/Conexion.php");

$rfc = $_SESSION["rfc"];


$sql = "SELECT id FROM `relcompanyactivity` WHERE `rfc`='$rfc'";
$idact = ejecutarConsultaSimpleFila($sql);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SURTRIB Alcaldia Libertador</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="../public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link href="../public/datatables/buttons.dataTables.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../public/plugins/jqvmap/jqvmap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/plugins/daterangepicker/daterangepicker.css">
  <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
  <!-- summernote -->
  <link rel="stylesheet" href="../public/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/mapa.css">

  <link rel="stylesheet" href="../public/mapa.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    
 
</head>


<body class="hold-transition sidebar-mini layout-fixed text-sm">

<div class="wrapper" id="theme-wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-navy navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==2)
            {
              echo '<a href="conceptocontribuyente.php" class="nav-link">Inicio</a>';
            }
            ?>
      <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '<a href="conceptocontribuyente.php" class="nav-link">Inicio</a>';
            }
            ?>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <!-- <a href="#" class="nav-link">Contact</a>-->
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">2</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Te informamos
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Desde el 1° de Febrero del 2024 y en lo dispuesto en la Ley de Armonizacion Tributaria la Alcaldia de Libertador inicia con el nuevo sistema de recaudacion fiscal SURTRIB. Conocelo.</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Alcaldia de Libertador</p>
              </div>
            </div>
            <br>
            <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nuevas Actualizaciones
                  <span class="float-right text-sm text-danger"><i class="fas fa-check-circle"></i></span>
                </h3>
                <p class="text-sm">Estimado Contribuyente, como partes las actualizaciones del sistema, desde ya puedes realizar la consulta de los servicios de aseo asociados al Instituto Autónomo Municipal de Gestión Ambiental  (IAGESAM) del Municipio Libertador y próximamente estará disponible el pago en línea de estos servicios.  #GestionOrsini</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Alcaldia de Libertador</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
      <li class="nav-item">
	  
        <a href="../ajax/usuarios.php?op=salir" class="nav-link">Salir</a>
      
        
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->



  
  <aside class="main-sidebar sidebar-dark-navy elevation-4">


 <!-- Brand Logo -->
 <a href="#" class="brand-link navbar-navy">
      <img src="../public/images/libertador2.jpg"
           alt=""
           class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-dark">SURTRIB</span>
    </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
        </div>
        <div class="info">
          <span class="right badge badge-danger" aling="left">En Linea</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      
<!-- Sidebar Menu Contribuyentes-->


   
            <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==2)
            {
              echo '
          <li class="nav-item">
            <a href="conceptocontribuyente.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }

           

            
            ?>

<!-- Sidebar Menu Soporte Tecnico y Desarrollo-->
<?php
 //recorremos los numeros con una iteracion para recorrer si el usuario esta en el ranog de numeros
      for ($rol = 96; $rol <= 99; $rol++) {
        if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == $rol) {
              echo '
              <li class="nav-header">Hacienda</li>
          <li class="nav-item">
            <a href="conceptocontribuyente.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
        }
      }


      // El rol es 96 Soporte Tecnico III (Asistente de Soporte)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 96) {   
        echo 
        '
<!--Contribuyentes-->
        
        <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                 Contribuyentes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="contribuyentehacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contribuyentes Hacienta</p>
                  </a>
                </li>
                 </ul>
        
        
<!-- Estado De Cuentas-->
        
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

<!-- Tasas y Alicuotas-->

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-piggy-bank"></i>
                <p>
                 Tasas y Alicuotas
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="activeco.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Actividad Economica</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tasahacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Hacienda</p>
                  </a>
                </li>
                </ul>
                
<!--Ajuste de Tramite-->
  
         <li class="nav-item">
            <a href="ajustetramite.php" class="nav-link">
            <i class="nav-icon fas fa-marker"></i>
              <p>
                Ajuste Tramite
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
  
<!--Actividades Economicas-->
  
   <li class="nav-item">
            <a href="actividadead.php" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Activ. Economicas
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
  
<!--Vehiculos-->
  
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-car"></i>
              <p>
                Vehiculos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehiculosADM.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestion de Vehiculos</p>
                </a>
              </li>
            </ul>
          </li> 
        
<!--Usuarios-->
        
 <li class="nav-item">
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>      
        
        
        ';    
      }


        ?>

<!-- Sidebar Menu De Hacienda-->
<?php
 //recorremos los numeros con una iteracion para recorrer si el usuario esta en el ranog de numeros
      for ($rol = 80; $rol <= 95; $rol++) {
        if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == $rol) {
              echo '
              <li class="nav-header">Hacienda</li>
          <li class="nav-item">
            <a href="conceptocontribuyente.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
        }
      }
 
      // El rol es 95 Jefe de hacienda
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 95) {   
        echo 
        '
        <!-- Verificar Pagos-->
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                 Verificar Pagos
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <!-- Verificar Pagos Sub Menú-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="verificarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagos por Conciliar</p>
                  </a>
                </li>
              </ul>
              <!-- Cargar Conciliacion Bancaria-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="cargarcvs.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cargar Conciliacion Bancaria</p>
                  </a>
                </li>
              </ul>
              <!-- Conciliar Pagos-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="conciliarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conciliar Pago</p>
                  </a>
                </li>
              </ul>
            </li> 
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!--Pago taquilla-->
        <li class="nav-item">
            <a href="pagostaquilla.php" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pago Taquilla
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="reportedeldia.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Reporte del Dia
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        <!-- Definitiva-->
        <li class="nav-item">
            <a href="definitiva.php" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Definitiva
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>

        <!-- Soporte De Auditoria-->
        
        '      
        ;    
      }

      // El rol es 94 (UN NUMERO SIN ASIGNAR)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 94) {
          
          
          
          
      }

      // El rol es 93 jefe auditores  (le falta contenido)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 93) {
        echo 
        '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!-- Definitiva-->
        <li class="nav-item">
            <a href="definitiva.php" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Definitiva
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>
        
       <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                 Contribuyentes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="contribuyentehacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contribuyentes Hacienta</p>
                  </a>
                </li>
        
        
        <!-- Soporte De Auditoria-->
        
        '      
        ;    
      }

      // El rol es 92 audiroria 
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 92) {
        echo '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!-- Definitiva-->
        <li class="nav-item">
            <a href="definitiva.php" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Definitiva
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>
        ';
      }

      // El rol es 91 Jefe de caja
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 91) {
        echo '
        <!-- Verificar Pagos-->
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                 Verificar Pagos
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <!-- Verificar Pagos Sub Menú-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="verificarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagos por Conciliar</p>
                  </a>
                </li>
              </ul>
              <!-- Cargar Conciliacion Bancaria-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="cargarcvs.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cargar Conciliacion Bancaria</p>
                  </a>
                </li>
              </ul>
              <!-- Conciliar Pagos-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="conciliarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conciliar Pago</p>
                  </a>
                </li>
              </ul>
            </li> 
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!--Pago taquilla-->
        <li class="nav-item">
            <a href="pagostaquilla.php" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pago Taquilla
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>
         <!--Cuadre de caja-->

        ';
        echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Reportes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">6</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="reportedeldia.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte del Dia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="reporteIngresos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de Ingresos</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="reporteIngresosdetalles.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resumen de Ingresos Detalles</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="reporteIngresosdetallesacontribuyente.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resumen de Ingresos Detalles(++)</p>
                  </a>
                </li>
      
              </ul>
            </li>';
      }

      // El rol es 90 Cajero caja (le falta contenido)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 90) {
         echo '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <!--Pago taquilla-->
        <li class="nav-item">
            <a href="pagostaquilla.php" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pago Taquilla
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="reportedeldia_taquilla.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Reporte del Dia
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        <!--Cuadre de caja-->
        
        ';
      }

      // El rol es 89 Jefe De Liquidacion (le falta contenido)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 89) {
        echo '
        
         <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                 Contribuyentes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="contribuyentehacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contribuyentes Hacienta</p>
                  </a>
                </li>
                
               
              </ul>
            </li> 
        
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        
        <li class="nav-item">
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
        ';
      }

      // El rol es 88 Liquidacion y Cobranza (le falta contenido)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 88) {
        echo '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        
        
        ';
      }

      // El rol es 87 Jefe Fiscal (le falta contenido)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 87) {
        echo '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        ';
      
      
      }

      // El rol es 86
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 86) {echo '
        <!-- Verificar Pagos-->
              
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        
          <li class="nav-item">
            <a href="reporteIngresos.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Reporte de Ingresos
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="reporteIngresosdetalles.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Resumen de Ingresos Detalles
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          
        <!--Cuadre de caja-->

        ';
       
        



      }

      // El rol es 85
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 85) {
        





      }

      // El rol es 84 (ANALISTA DE PRESUPUESTO)
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 84) {
         if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 87) {
        echo '
        <!-- Estado De Cuentas-->
        <li class="nav-item">
          <a href="estadocuentahacienda.php" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Estado de Cuenta
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        
        <li class="nav-item">
            <a href="reporteIngresos.php" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Reporte de Ingresos
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        
        
        ';

      }
      }
      // El rol es 83
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 83) {
        





      }
      // El rol es 82
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 82) {
        





      }
      // El rol es 81
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 81) {
        





      }
      // El rol es 80
      if ($_SESSION['Escritorio'] == 1 && $_SESSION['rol'] == 80) {
        





      }
?>



         <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==2)
            {
              echo '

              <!-- Menu Pago-->

              <li class="nav-item">
              <a href="estadocuenta.php" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Notificar Pago
                   <span class="right badge badge-danger">Pagos</span>
                </p>
              </a>
            </li>';
             
           /*
             echo ' <!-- Menu Ambiente -->
              <li class="nav-header">Aseo Urbano</li>
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-tree"></i>
              <p>
                Tramites de IAGESAM
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registro de Pago</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tramites</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reg. de Servicio  Residencial</p>
              </a>
            </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pago de Servicio Residencial</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registro de Servicio Comercial o Empresarial</p>
              </a>
            </li><li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Pago de Servicio Residencial</p>
            </a>
          </li>
            </ul>
          </li>';
          */
               if (empty($idact)){
                     echo '
                     <li class="nav-header">Hacienda</li>
                         <li class="nav-item has-treeview">
                           <a href="#" class="nav-link">
                           <i class="nav-icon fas fas fa-cogs"></i>
                        <p>Actividad Economica<i class="fas fa-angle-left right"></i>
                          <span class="badge badge-info right">1</span>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                      
                      <li class="nav-item">
                     <a href="actividadeco.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registro de Actividad Economica</p>
                </a>
                   </li>
              
                   </ul>
                   </li>' ;
       
             }
             else {

                    echo '
                      <li class="nav-header">Hacienda</li>
                           <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                         <i class="nav-icon fas fas fa-cogs"></i>
                           <p>
                          Actividad Economica
                          <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">2</span>
                          </p>
                                </a>
                            <ul class="nav nav-treeview">
                          <li class="nav-item">
                           <a href="anticipoc.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                              <p>Pago de Anticipo</p>
                                  </a>
                                  </li>
                                <li class="nav-item">
                                <a href="actividadeconomica.php" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                             <p>Solicitud Licencia de Comercio</p>
                                    </a>
                                  </li>
                                   </ul>
                                </li>'
                                      ;
       
            }


            echo '

          

          


          <!-- Menu Vehiculos-->


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-car"></i>
              <p>
                Vehiculos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehiculosc.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pago de Vehiculos</p>
                </a>
              </li>
            </ul>
          </li> 
          
          
          <!-- Menu Catastro -->

          <li class="nav-header">Catastro</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-building"></i>
              <p>
                Catastro
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="CInmueble.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pago de Inmuebles</p>
                </a>
              </li>
            </ul>
          </li>
          
          
          <li class="nav-header">Ambiente</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-leaf"></i>
              <p>
                Ambiente
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pagoservambc.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Servicios de Ambiente</p>
                </a>
              </li>
            </ul>
          </li>
          

          <!-- Menu Salir -->

          <li class="nav-header"> </li>
          <li class="nav-item">
          <a href="../ajax/usuarios.php?op=salir"  class="nav-link">
            <i class="nav-icon fa fa-times"></i>
            <p>
              Salir
            </p>
          </a>
        </li>';
            }
            ?>

<!-- FIN Sidebar Menu Contribuyentes-->



<!--  Sidebar Menu Adminstrativo-->


<!--  Sidebar Menu Hacienda-->
			  <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-header">Hacienda</li>
          <li class="nav-item">
            <a href="conceptocontribuyente.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==0)
            {
              echo '
              <li class="nav-header">Hacienda</li>
          <li class="nav-item">
            <a href="conceptocontribuyente.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            ?>
			 
        	  <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                 Contribuyentes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="contribuyentehacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contribuyentes Hacienta</p>
                  </a>
                </li>
                
               
              </ul>
            </li> ';
            }
            ?>
<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                 Catastro
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="contribuyenteInmueble.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inmuebles</p><br>
                    
                  </a>
                </li>
               
              </ul>
            </li> ';
            }
            ?>
<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                 Verificar Pagos
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="verificarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pagos por Conciliar</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="cargarcvs.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cargar Conciliacion Bancaria</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="conciliarpago.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conciliar Pago</p>
                  </a>
                </li>
              </ul>
            </li> ';
            }
            ?>

<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-piggy-bank"></i>
                <p>
                 Tasas y Alicuotas
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="activeco.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Actividad Economica</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tasahacienda.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Hacienda</p>
                  </a>
                </li>
              </ul>
            </li>';
            }
            ?>

<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Otras Liquidaciones
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasasadministrativas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Administrativas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="multasyotrastasa.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Multas y Otras Tasas</p>
                  </a>
                </li>
      
              </ul>
            </li>';
            }
            ?>





          
  <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="estadocuentahacienda.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Estado de Cuenta
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>

<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="pagostaquilla.php" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pago Taquilla
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
            ';
          
          echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Reportes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">5</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="reportedeldia.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte del Dia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="reporteIngresos.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de Ingresos</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="reporteIngresosdetalles.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resumen de Ingresos Detalles</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="reporteIngresosdetallesacontribuyente.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resumen de Ingresos Detalles(++)</p>
                  </a>
                </li>
                 <li class="nav-item">
                  <a href="compensacion.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compensacion Interterritorial</p>
                  </a>
                </li>
              </ul>
            </li>';
            }
            ?>
            
            <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="definitiva.php" class="nav-link">
            <i class="nav-icon fas fa-coins"></i>
              <p>
                Definitiva
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>
             <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="ajustetramite.php" class="nav-link">
            <i class="nav-icon fas fa-marker"></i>
              <p>
                Ajuste Tramite
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>





<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="actividadead.php" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Activ. Economicas
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>
               <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="bancos.php" class="nav-link">
            <i class="nav-icon fas fa-landmark"></i>
              <p>
                Bancos
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>
			<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="moneda.php" class="nav-link">
            <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Monedas
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>


               <!-- Menu Vehiculos-->
               <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==99)
            {
              echo '

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-car"></i>
              <p>
                Vehiculos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vehiculosADM.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestion de Vehiculos</p>
                </a>
              </li>
            </ul>
          </li> ';
        }
        ?>
             
			<?php 
    
            if ($_SESSION['Usuarios']==1 & $_SESSION['rol']==99)
            {
              echo '
          <li class="nav-item">
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
                   
          
          ';
          echo '
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Log de Acceso
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="usuacriocontraseña.php" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              Cambio de contraseña
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
          ';
            }
            ?>
            
            
      <!--  Sidebar Menu Catastro -->
<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
              <li class="nav-header">Menu Catastro</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            ?>
			 
        	  <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                 Catastro
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="contribuyenteInmueble.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inmuebles</p><br>
                    
                  </a>
                </li>
               
              </ul>
            </li> ';
            }
            ?>
          <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Otras Liquidaciones
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasasadministrativas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Administrativas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="multasyotrastasa.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Multas y Otras Tasas</p>
                  </a>
                </li>
      
              </ul>
            </li>';
            }
            ?>
              <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
          <li class="nav-item">
            <a href="estadocuentahacienda.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Estado de Cuenta
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?> 
             <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
          <li class="nav-item">
            <a href="tasascatastro.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Liquidacion Catastro
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?> 
            <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
          <li class="nav-item">
            <a href="liquidacioncatastro.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Aprobacion Liquidacion
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>
            
            <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==65)
            {
              echo '
          <li class="nav-item">
            <a href="usuarios.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?> 
            
            
            
     <!--  Sidebar Menu Desarrollo Urbano -->
<?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==55)
            {
              echo '
              <li class="nav-header">Menu Desarrollo Urbano</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            ?>
			 
        	  <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==55)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                 Catastro
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <li class="nav-item">
                  <a href="contribuyenteInmueble.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inmuebles</p><br>
                    
                  </a>
                </li>
               
              </ul>
            </li> ';
            }
            ?>
          <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==55)
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Otras Liquidaciones
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasasadministrativas.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Administrativas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="multasyotrastasa.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Multas y Otras Tasas</p>
                  </a>
                </li>
      
              </ul>
            </li>';
            }
            ?>
              <?php 
            if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==69 or $_SESSION['rol']==55)
            {
              echo '
          <li class="nav-item">
            <a href="estadocuentahacienda.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Estado de Cuenta
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>       
            


<!--  Sidebar Menu Amiente -->
<?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==99))
            {
              echo '
              <li class="nav-header">Ambiente</li>
          <li class="nav-item">
            <a href="facturaaseo.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Facturacion IAGESAM
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            ?>
            
           <?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==74))
            {
              echo '
              <li class="nav-header">Ambiente</li>
          <li class="nav-item">
            <a href="concepto.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inicio
                 <span class="right badge badge-danger">Inicio</span>
              </p>
            </a>
          </li>';
            }
            ?>
       
            <?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99))
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fas fa-users"></i>
                <p>
                  Contribuyentes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="contribuyenteambiente.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Contribuyentes</p>
                  </a>
                </li>
              </ul>
            </li>';
            }
            ?>

<?php 

    if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==78 OR $_SESSION['rol']==76 OR $_SESSION['rol']==75 ))
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                  Estado de Cuenta
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="estadocuentaaseo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estado de Cuenta</p>
                  </a>
                </li>
              </ul>
            </li>';
            }
            ?>

<?php 



            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==74))
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-piggy-bank"></i>
                <p>
                 Registro y Ajuste de Tasas
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasaservamb.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Servicios de Aseo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="tributosamb.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas y Tributos</p>
                  </a>
                </li>
                
              </ul>
            </li>';
            }
            ?>
            <?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 or $_SESSION['rol']==99 OR $_SESSION['rol']==78 OR $_SESSION['rol']==76 ))
            {
              echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Liquidacion de Tasas
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasasadministrativasaseo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Administrativas</p>
                  </a>
                </li>
                
      
              </ul>
               <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tasasadministrativasaseom.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tasas Administrativas Manual</p>
                  </a>
                </li>
                
      
              </ul>
            </li>';
            }
            ?>


          
         

            <?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==78))
            {
              echo '
          <li class="nav-item">
            <a href="empambientead.php" class="nav-link">
            <i class="nav-icon fas fa-city"></i>
              <p>
                Registro de Servicios
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>

            <?php 
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==78))
            {
              echo '
          <li class="nav-item">
            <a href="pagoservamb.php" class="nav-link">
            <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Pago de Servicios de Aseo
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>';
            }
            ?>
            
<?php 
        if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99))
            {
              echo '
          <li class="nav-item">
            <a href="listadoambiente.php" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Listado Servicios de
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
              <br>
              <p>
                Aseo Registrados
                
              </p>
            </a>
          </li>';
          
          
            }
             //CAJEROS DIAGESAN
            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==78 OR $_SESSION['rol']==75))
            {
              echo '
          <li class="nav-item">
            <a href="pagotaquilla_aseo.php" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pago Taquilla Aseo
                 <!--<span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Cierre de Caja
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">1</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
             
              <li class="nav-item">
                  <a href="reportedeldia_taquilla_aseo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cierre de Caja</p>
                  </a>
                </li>

                </ul>
                </li>

            ';
           
            }



             if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 OR $_SESSION['rol']==78 OR $_SESSION['rol']==77 ))
            {
             echo '
              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                 Reportes
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="reportedeldia_aseo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte del Dia Aseo</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="reporteIngresos_aseo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de Ingresos Aseo</p>
                  </a>
                </li>
                
              </ul>
            </li>';
          
          
            }



            if ($_SESSION['Escritorio']==1 & ($_SESSION['rol']==79 OR $_SESSION['rol']==99 ))
            {
             
        echo '
          
          <li class="nav-item">
          <a href="usuacriocontraseña.php" class="nav-link">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              Cambio de contraseña
               <!--<span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
          ';
            }
          
          
            

            ?>
          

    











		  
	
		  
		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
<!-- ./wrapper -->

