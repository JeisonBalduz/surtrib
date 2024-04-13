

<?php 
if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==2) {
  //ANUNCIOS DEL LOS CONTRIBUYENTES

  // NOTA: SI SE BORRA EL SPINNER SE DEBE BORRAR LOS SELECTORES DEL JS SPINNER Y CONTENEDOR_SPINNER
  ?>
    <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
    <div class="modal fade modalContribuyente" id="modal-contendor" >
      <div class="modal-dialog" role="document" >
        <div class="modal-content" >
          <!-- CABEZA DEL MODAL 
          <div class="modal-header" >
        
            <div class="titulo__modal container d-flex justify-content-center">
             
              <h5 class="modal-title">Alcaldía Del Municipio Libertador</h5>
            </div>
         
            <button type="button"id="boton-x" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          -->
          <!-- CUERPO DEL MODAL DEL CONTENIDO -->
          <div class="modal-body">
                          
             <!-- CONTENDOR DE IMAGENES RESPONSIVE -->
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                         <div class="carousel-inner">
                          <div class="contenedorSpinner d-flex justify-content-end align-items-center text-secondary position-absolute w-100 " style="z-index: 1;">
                            <div class="d-flex justify-content-center align-items-center mt-2 mx-2">
                                <span id="spinner" class="position-absolute text-primary"></span>
                                <div id="spinner-circulo" class="spinner-border text-primary"></div>
                            </div>
                          </div>
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="../public/images/carrete/oscarOrsini.jpeg" alt="primera img">
                            </div>
                          
                            <div class="carousel-item ">
                              <img class="d-block w-100" src="../public/images/carrete/informacionAmbiente.jpeg" alt="segunda img">
                            </div>
                           
                           <div class="carousel-item ">
                              <img class="d-block w-100" src="../public/images/carrete/recoleccionDesechos.jpeg" alt="tercera img">
                            </div>
                            
                           
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                          <ol class="carousel-indicators mt-3">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            
                          </ol>
              </div>
            <p></p>
          </div>
          <!-- BOTON DE CERRAR LA PUBLICIDAD -->
          <div class="modal-footer">        
            <button type="button" id="boton-cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  <?php
} 
?>




<?php 
if ($_SESSION['Escritorio']==1 & $_SESSION['rol'] > 2) {
  //ANUNCIOS DEL LOS ADMINSITRATIVOS DEL SISTEMA 

  // NOTA: SI SE BORRA EL SPINNER SE DEBE BORRAR LOS SELECTORES DEL JS SPINNER Y CONTENEDOR_SPINNER
  /*
  ?>
    <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
    <div class="modal fade modalAdministrativo" id="modal-contendor" >
      <div class="modal-dialog" role="document" >
        <div class="modal-content" >
          <!-- CABEZA DEL MODAL -->
          <div class="modal-header" >
            <!-- CONTENEDOR DEL CONTENIDO DE LA CABEZA -->
            <div class="titulo__modal container d-flex justify-content-center">
              <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
              <h5 class="modal-title">Alcaldía Del Municipio Libertador</h5>
            </div>
            <!-- BOTON X PARA CERRAR LA PUBLICIDAD -->
            <button type="button"id="boton-x" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- CUERPO DEL MODAL DEL CONTENIDO -->
          <div class="modal-body">
                          <div class="contenedorSpinner d-flex justify-content-end align-items-center text-secondary position-absolute w-100 px-4" style="z-index: 1;">
                            <div class="d-flex justify-content-center align-items-center ">
                                <span id="spinner" class="position-absolute text-primary"></span>
                                <div id="spinner-circulo" class="spinner-border text-primary"></div>
                            </div>
                          </div>
            <!-- CONTENDOR RESPONSIVE DE CONTENIDO -->
                  <div id="anuncio" class="container-fluid d-flex justify-content-center">
                      <img src="../public/images/WA0063.jpg" alt="">
                  </div>
          </div>
          <!-- BOTON DE CERRAR LA PUBLICIDAD -->
          <div class="modal-footer">        
            <button type="button" id="boton-cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  <?php*/
  
} 
?>