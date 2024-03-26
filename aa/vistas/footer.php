<!-- Inicio footer PHP -->
</div>
</div>
<!-- Fin row -->
<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../public/plugins/jqvmap/maps/jquery.vmap.south-america.js"></script>
<!-- jQuery Knob Chart -->
<script src="../public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../public/plugins/moment/moment.min.js"></script>
<script src="../public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../public/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../public/dist/js/demo.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../public/js/bootstrap-select.min.js"></script> 
<script src="../public/plugins/select2/js/select2.full.min.js"></script> 

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

<!-- DATATABLES -->
<script src="../public/datatables/jquery.dataTables.min.js"></script>    
<script src="../public/datatables/dataTables.buttons.min.js"></script>
<script src="../public/datatables/buttons.html5.min.js"></script>
<script src="../public/datatables/buttons.colVis.min.js"></script>
<script src="../public/datatables/jszip.min.js"></script>
<script src="../public/datatables/pdfmake.min.js"></script>
<script src="../public/datatables/vfs_fonts.js"></script> 
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../public/plugins/jszip/jszip.min.js"></script>
<script src="../public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../public/js/bootbox.min.js"></script> 
<script src="../public/js/bootstrap-select.min.js"></script> 
<script src="../public/plugins/chart.js/Chart.min.js"></script> 

<!-- ESTAS LIBRERIAS SON PARA LOS MULTISELECT DE CATASTRO -->
<link rel="stylesheet" href="../public/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="../public/bootstrap-select.min.js"></script>
  <script type="text/javascript"> 
  <?php      
    $paginabase=basename($_SERVER['PHP_SELF']);
     echo "var paginabase='".$paginabase."';";
  //  echo '<script type="text/javascript"> alert("'.$paginabase.'");
  //role="menu"
 ?>  

function sumarr(){ //alert("Valor");
  var href="";
  var valor1=0;
  var contador = 0;
  var parenid;

  $('.has-treeview').each(function() {
    //contador++;
       parenid=$(this);
    href=$(this).children().find('a[href="<?php echo $paginabase;?>"]').attr("href");
    if(href=="<?php echo $paginabase;?>"){
      contador = 1;
      parenid.addClass('nav-item menu-is-opening menu-open');//nav-item has-treeview  menu-open
      $(this).children().find('a[href="<?php echo $paginabase;?>"]').addClass('nav-link active');
     
    }
  
  });

  if (contador==0){
    $('.nav-link').each(function() { // alert("Valorbb="+contador);return;
       parenid=$(this);
   
    href=$(this).attr("href");
   // alert("Valor="+href);
    if(href=="<?php echo $paginabase;?>"){
      contador = 1;
     
      $(this).addClass('nav-link active');
    
    }
     });
  }
 
}


 $(document).ready(function(){
  // $('.nav-item has-treeview').find('a[href="<?php echo $paginabase;?>"]').addClass('nav-item has-treeview  menu-open');
  sumarr();
});
  </script>
</body>

</html>
<!-- Fin footer PHP -->