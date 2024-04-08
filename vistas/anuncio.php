

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
                          <div class="contenedorSpinner d-flex justify-content-end align-items-center text-secondary position-absolute w-100 px-4" style="z-index: 1;">
                            <div class="d-flex justify-content-center align-items-center ">
                                <span id="spinner" class="position-absolute text-primary"></span>
                                <div id="spinner-circulo" class="spinner-border text-primary"></div>
                            </div>
                          </div>
             <!-- CONTENDOR DE IMAGENES RESPONSIVE -->
             <div id="anuncio" class="container-fluid d-flex justify-content-center">
                      <img src="../public/images/carrete/feriaDelPescado-min.jpeg" alt="">
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
  
  ?>
    <!-- MODAL DE PUBLICIDAD DEL SISTEMA -->
    <div class="modal fade modalAdministrativo" id="modal-contendor" >
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

  <?php
  
} 
?>