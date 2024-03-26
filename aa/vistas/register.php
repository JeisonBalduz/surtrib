<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Surtrib | Pagina de Registro</title>
 <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Font Awesome -->
 <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.all.min.js">
 
 <!-- icheck bootstrap -->
 <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 <!-- Theme style -->
 <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 <link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
 <style>
    /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
 </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="login.html"><b>SURTRIB</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registro de Nuevo Usuario</p>
      <form name="formularioc" id="formularioc" method="post">
        <div class="input-group mb-2">
          <select class="form-control" name="tipodocumento" id="tipodocumento" placeholder="Tipo Documento" required>
            <option value="">Seleccione su documento</option>
            <option value="V">V</option>
             <option value="E">E</option>
             <option value="J">J</option>
             <option value="G">G</option>
             <option value="S">S</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-bars"></span>
            </div>
          </div>
        </div>

        <p class=" mb-0 mt-0 text-sm text-muted">(Ejemplo:4323767611)</p>
        <div class="input-group mb-3 ">
          <input type="number" name="numerodocumento" id="numerodocumento"class="form-control" placeholder="RIF/CI" onkeypress="return NumerosRif(event);" pattern="[0-9]+" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeError"></p>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre o Razon Social" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeErrorNombre"></p>
        </div>

        <p class=" mb-0 mt-0 text-sm text-muted">(Ejemplo:juan@gmail.com/hotmail.com)</p>
        <div class="input-group mb-2">
          <input type="email" name="email" id="email" class="form-control" placeholder="Email"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeErrorCorreo"></p>
        </div>

        <p class=" mb-0 mt-0 text-sm text-muted">(Ejemplo:04127821884)</p>
        <div class="input-group mb-3">
          <input type="text" name="telefonousuario" id="telefonousuario" class="form-control" placeholder="Teléfono" onkeypress="return NumerosTelefono(event);" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeErrorTelefono"></p>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock cursor-help" id="candado1"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeErrorContraseña1"></p>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Repita la clave" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" id="candado2"></span>
            </div>
          </div>
          <p class="mb-0 mt-1 text-sm" id="mensajeErrorContraseña2"></p>
        </div>
        <input type="hidden" name="rol" id="rol" class="form-control" placeholder="Repita la clave" value='1' required>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               Yo acepto los <a href="#" data-toggle="modal" data-target="#modal-default">términos</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="btnGuardar"  >Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="social-auth-links text-center mb-3">
        <p>______________________</p>
        <td style="text-align:left"><img src="../public/images/libertador2.jpg" width="210" height="100"/></td>                           
								
      </div>
      <p class="login-box-msg">
      <a href="login.html" class="text-center">Ya tengo Usuario</a>
      </p>
    </div>
    
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Terminos de Uso del Sistema</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Establecer lo terminos legales del usuario y los limites legales de responsabilidad de la Alcaldia</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/dist/js/adminlte.min.js"></script>
<script src="../public/js/bootbox.all.min.js"></script>

<script type="text/javascript" src="scripts/registro.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
</body>
</html>
