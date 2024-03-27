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
                                    <h3 class="card-title">Subir Estado Bancario por fecha</h3>
                                   <!-- <a href="http://localhost/surtri/vistas/pagoambiente.php" type="submit" class="btn btn-danger float-right">Limpiar</a>-->
                              </div>
			            <div class="card-header">
                                    
                                          <div class="row">
                                                <div class="form-group col-sm-6 col-xs-4">
                                                      <label>Elegir Archivo Excel</label>
                                                            <input type="hidden" value="upload" name="action" />
                                                            <input type="hidden" value="usuarios" name="mod">
                                                            <input type="hidden" value="masiva" name="acc">
                                                            <input class="form-control" type="file" name="archivo" id="archivo">
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-4">
                                                      <label>Cargar</label>
                                                            
                                                            <button type="submit" id="btn_lectura" name="btn_lectura" class="btn btn-info form-control" >Subir Registro</button>
                                                </div>
                                               <!-- <div class="form-group col-sm-4 col-xs-4">
                                                      <label>Ejecutar Conciliacion</label>
                                                      <button type="submit" name="subir" class="btn btn-danger form-control" >Subir Excel</button>
                                                </div>-->
                                          </div>
                                    
				      </div>
                              <div class="card-header">
                                    <h3 class="card-title">Listado de Movimientos Bancarios</h3>
                              </div>
                              <div class="card-body" id="lista2">
                              <p id="respuesta">
                                                      </p>
                                                      <p id="contador">
                                                      </p>
                                    <table class="table table-bordered table-hover">
                                          <thead>
                                                <tr>
                                                      <th>Fecha</th>
                                                      <th>Código Trans.</th>
                                                      <th>Tipo Trans.</th>
                                                      <th>Tipo Oper.</th>
                                                      <th>Descripción</th>
                                                      <th>Referencia</th>
                                                      <th>Debe</th>
                                                      <th>Haber</th>
                                                      <th>Saldo</th>
                                                </tr>
                                          </thead>
                                          <tbody id="tbody">
                                          
                                    </table>

                                                     
                              </div>
                        </div>
                  </div>
                  
            </div>
      </div>  

       

<script src="../files/xlxs/dist/xlsx.full.min.js"></script>
<script src="scripts/jquery-1.9.1.js"></script>
<script>
(async() => {
  /* parse workbook */
  const fileInput = document.getElementById('archivo');
  fileInput.addEventListener('change', async () => {
    const file = fileInput.files[0];
    const arrayBuffer = await file.arrayBuffer();
    const workbook = XLSX.read(arrayBuffer);

    /* get first worksheet */
    const worksheet = workbook.Sheets[workbook.SheetNames[0]];
    const raw_data = XLSX.utils.sheet_to_json(worksheet, {header:1});

    /* fill years */
    var last_year = 0;
    raw_data.forEach(r => last_year = r[2] = (r[2] != null ? r[2] : last_year));

    /* select data rows */
    const rows = raw_data.filter(r => r[2] >= 1 && r[2] <= 999);

    /* generate row objects */
    const objects = rows.map(r => ({fecha: r[1], codigotrans: r[2], tipotrans: r[3], tipoopera: r[6], detalle: r[7], referencia: r[12], debe: r[13], haber: r[15], saldo: r[16]}));

    /* add rows to table body */
    const tbody = document.getElementById('tbody');
    tbody.innerHTML = '';
    objects.forEach(o => {
      const row = document.createElement("TR");
      row.innerHTML = `<td>${o.fecha}</td><td>${o.codigotrans}</td><td>${o.tipotrans}</td><td>${o.tipoopera}</td><td>${o.detalle}</td><td>${o.referencia}</td><td>${o.debe}</td><td>${o.haber}</td><td>${o.saldo}</td>`;
      tbody.appendChild(row);
    });
  });
})();
</script>




<script>
    $('#btn_lectura').click(function () {
        valores=new Array();
        var contador = 0;
        $('#tbody tr').each(function () {

            var d1= $(this).find('td').eq(0).html();
            var detalle = $(this).find('td').eq(4).html();
            var referencia = $(this).find('td').eq(5).html();
            var monto = $(this).find('td').eq(7).html();

            
        
         const fecha = d1;
         const [dia, mes, anio] = fecha.split("/");
        const nuevaFecha = `${anio}-${mes}-${dia}`;

            if (monto == 0) {
             } 
             else {
            valor=new Array(nuevaFecha, detalle, referencia, monto);
            valores.push(valor);
            console.log (valor);
           //alert(nuevaFecha);
            $.post('../modelos/Insertarcvs.php', {nuevaFecha:nuevaFecha, detalle:detalle, referencia:referencia, monto:monto}, function (datos) {
                $('#respuesta').html(datos);
            });
            //alert(valores);
            contador = contador + 1;
            $('#contador').html("Se registro "+contador+" registros validos y correctamente.");
            
           }
           
           
        });

        limpiar();

    });
</script>
        	
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
		
<?php 
}
ob_end_flush();
?>

