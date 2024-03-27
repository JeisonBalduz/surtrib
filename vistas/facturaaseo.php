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

if ($_SESSION['Escritorio']==1)
{
?>
    <!-- Inicio Contenido PHP-->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card" id="listadoregistros">
          <div class="card-header">
            <h3 class="card-title">Modulo de Facturacion de IAGESAM</h3>
          </div>
          <div class="card-header">
            <div class="row">
              <div class="form-group col-md-12 col-sm-12 col-xs-1">
                <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)">
                  <i class="fa fa-plus-circle"></i> Registrar Nueva Factura
                </button>
              </div>
            </div>
          </div>
          <div class="card-header">
            <h3 class="card-title">Listado de Bancos</h3>
          </div>
          <div class="card-body" id="lista">
            <table id="tbllistado" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Opciones</th>
                  <th>N Factura</th>
                  <th>Rif</th>
                  <th>Nombre</th>
                  <th>Fecha de Pago</th>
                </tr>
              </thead>
              <tbody>
                </tbody>
              <tfoot>
                <tr>
                  <th>Opciones</th>
                  <th>N Factura</th>
                  <th>Rif</th>
                  <th>Nombre</th>
                  <th>Fecha de Pago</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-info" id="formularioregistros">
      <div class="card-header">
        <h3 class="card-title">Formulario de Registro y Modificacion de Bancos</h3>
      </div>
      <form role="form" name="formulario" id="formulario" method="POST">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-sm-4 col-xs-4">
              <label>Nombre</label>
              <input type="hidden" name="id" id="id" class="form-control">
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombre o Razon Social" required>
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>RIF</label>
              <input type="text" name="rif" id="rif" class="form-control" placeholder="Ingrese Cedula o RIF" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label>Fecha de Pago</label>
              <input type="date" name="fechapago" id="fechapago" class="form-control" placeholder="Ingrese Fecha de Pago" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-12 col-xs-4">
              <label>Direccion</label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Direccion" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-4 col-xs-4">
              <label>Telefono</label>
              
              <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Nombre o Razon Social" required>
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Correo</label>
              <input type="text" name="correo" id="correo" class="form-control" placeholder="Ingrese Cedula o RIF" required>
            </div>
            <div class="form-group col-sm-4 col-xs-12">
              <label>Forma de Pago</label>
              <select class="form-control" name="formapago" id="formapago" placeholder="Seleccione Marca" required>
              <option value="" selected>Seleccione una Marca</option>
                                               <option value="DEBITO">DEBITO</option>
                                                <option value="TRANFERENCIA BANCARIA">TRANFERENCIA BANCARIA</option>
                                                <option value="TRANFERENCIA PAGO MOVIL">TRANFERENCIA PAGO MOVIL</option>
                                                <option value="EFECTIVO">EFECTIVO</option>
                                                

                                          </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-8 col-xs-4">
              <label>Concepto</label>
              <input type="text" name="conceptopago1" id="conceptopago1" class="form-control" placeholder="Ingrese Concepto de Pago" required>
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Monto</label>
              <input type="text" name="monto1" id="monto1" onChange="suma();" class="form-control" placeholder="Ingrese Monto" required>
            </div>
          </div>

          <div class="row" id="row2">
            <div class="form-group col-sm-8 col-xs-4">
              <label>Concepto 2</label>
              <input type="text" name="conceptopago2" id="conceptopago2" class="form-control" placeholder="Ingrese Concepto de Pago">
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Monto</label>
              <input type="text" name="monto2" id="monto2" onChange="suma();" class="form-control" placeholder="Ingrese Monto">
            </div>
          </div>
          <div class="row" id="row3">
            <div class="form-group col-sm-8 col-xs-4">
              <label>Concepto</label>
              <input type="text" name="conceptopago3" id="conceptopago3" class="form-control" placeholder="Ingrese Concepto de Pago">
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Monto</label>
              <input type="text" name="monto3" id="monto3" onChange="suma();" class="form-control" placeholder="Ingrese Monto">
            </div>
          </div>
          <div class="row" id="row4">
            <div class="form-group col-sm-8 col-xs-4">
              <label>Concepto</label>
              <input type="text" name="conceptopago4" id="conceptopago4" class="form-control" placeholder="Ingrese Concepto de Pago">
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Monto</label>
              <input type="text" name="monto4" id="monto4"  onChange="suma();"class="form-control" placeholder="Ingrese Monto">
            </div>
          </div>

          <div class="row" id="row5">
            <div class="form-group col-sm-8 col-xs-4">
              <label>Concepto</label>
              <input type="text" name="conceptopago5" id="conceptopago5" class="form-control" placeholder="Ingrese Concepto de Pago">
            </div>
            <div class="form-group col-sm-4 col-xs-4">
              <label>Monto</label>
              <input type="text" name="monto5" id="monto5" onChange="suma();" class="form-control" placeholder="Ingrese Monto">
            </div>
          </div>
<div class="row">
        <div class="form-group col-sm-4 col-xs-4">
          <label>Total a Pagar</label>
          <input type="text" name="montotal" id="montotal" class="form-control" placeholder="Total" readonly>
        </div>
      </div>



        </div>
        <div class="card-footer">
          <button type="submit" id="btnGuardar" class="btn btn-info">Guardar</button>
          <button type="button" onclick="cancelarform()" class="btn btn-danger float-right">Cancelar</button>
        </div>
      </form>
    </div>
  </div>

</section>
	
	
	
	

    <!-- Fin Contenido PHP-->
    <?php
}
else
{
 require 'noacceso.php';
}

require 'footer.php';
?>
        <script type="text/javascript" src="scripts/facturaaseo.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>


    



		
<?php 
}
ob_end_flush();
?>

