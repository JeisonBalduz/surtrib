
<?php if ($_SESSION['Escritorio']==1 & $_SESSION['rol']==2) {
  ?>
    <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
    <div class="modal fade" id="modal-contendor" >
      <div class="modal-dialog" role="document" >
        <div class="modal-content" >
          <!-- CABEZA DEL MODAL -->
          <div class="modal-header" >
            <!-- CONTENEDOR DEL CONTENIDO DE LA CABEZA -->
            <div class="titulo__modal container d-flex justify-content-center">
              <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
              <h5 class="modal-title">Alcaldia Del Municipio Libertador</h5>
            </div>
            <!-- BOTON X PARA CERRAR LA PUBLICIDAD -->
            <button type="button"id="boton-x" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- CUERPO DEL MODAL DEL CONTENIDO -->
          <div class="modal-body">
            <!-- CONTENDOR DE IMAGENES RESPONSIVE -->
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                         <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="../public/images/carrete/operativoConjunto.jpeg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="../public/images/carrete/feriaDelPescado.jpeg" alt="Second slide">
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
                            
                          </ol>
              </div>
            <p></p>
          </div>
          <!-- BOTON DE CERRAR LA PUBLICIDAD -->
          <div class="modal-footer">
            <div class="spinner-border text-secondary" id="spinner-circulo"></div>
            <button type="button" id="boton-cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  <?php
} 
?>