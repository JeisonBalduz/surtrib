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

if (($_SESSION['Clientes']==1 && $_SESSION['rol']>=91) OR ($_SESSION['Clientes']==1 && $_SESSION['rol']==86))
{
?>
    <!-- Inicio Contenido PHP-->
<section class="content">
      <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
		            <div class="card" id="listadoregistros">
                              <div class="card-header">
                                    <h3 class="card-title"><strong>Reporte de Ingresos</strong><!--  <button class="btn btn-info" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>--> </h3>
                                    <a href="reporteIngresos.php" type="submit" class="btn btn-danger float-right">Limpiar</a>
                              </div>
            
			            <div class="card-header">
			                  <div class="row">
                                          <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Desde</label>
                                           <input type="date" name="fechadia" id="fechadia" class="form-control" placeholder="Ingrese Fecha">
                                          </div> 
                                          <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Hasta</label>
                                           <input type="date" name="fechadia2" id="fechadia2" class="form-control" placeholder="Ingrese Fecha">
                                          </div> 
						      <div class="form-group col-md-3 col-sm-6 col-xs-1">
                                                <label>Busqueda</label><br/>
						            <button type="submit" onclick="reportedeingresos();" class="btn btn-info">Mostrar</button>
                           
                                                
				                        
                                          </div>
				            </div>
					</div> 
                               
                              <div class="card-body" id="resportedeldia">
                                 <div class="card-header" align="text-center">
                                  
                                   <h3 class="card-title" style="text-align: center;"><strong>INGRESOS DIARIO POR PARTIDA </strong></h3>  
                              </div>                                                 
                                    
                                    <table id="reportedeingresospartida" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      
                                                      <th>Partida</th>
                                                      <th>Actividades</th>
                                                      <th>N Tramites</th>
                                                      <th>Monto</th>
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      </tr>											
                                                </tfoot>
                                    </table>
                               <div class="card-header">
                                    <h3 class="card-title">DETALLE DIARIO MOVIMIENTOS BANCO</h3>
                                    </div>
                                 <table id="reportedeingresoportributo" class="table table-bordered table-hover" width=100%>
                                          <thead>
                                                <tr>
                                                      <th>#</th>
                                                      <th>PARTIDA</th>
                                                      <th>FECHA</th>
                                                      <th>MOVIMIENTO</th>
                                                      <th>BANCO</th>
                                                      <th>COD BANCO</th>
                                                      <th>REF</th>
                                                      <th>MONTO</th>
                                                      
                                                </tr>
                                          </thead>
                                          <tbody>
                                     
                                          </tbody>
                                          <tfoot>
                                                <tr>  <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>                                   
                                                      <th></th>
                                                      </tr>                                                             
                                                </tfoot>
                                    </table>
                           <div class="row">
                                  <div class="form-group col-sm-3 col-xs-4">
                                    <button type="button"  id="btn_Imprimir" name="btn_Imprimir" onclick="return imprSelec();" class="btn btn-info float-right">Imprimir</button>
                                   
                                   <a id="dlink" style="display:none;"></a>
        <input type="button" onclick="tablesToExcel(array1, 'Sheet1', 'myfile.xls')" value="Export to Excel">
                                   
                                   
                                    </div>
                                    
                                    </div>
                               </div>
                               
                        </div>
                  </div>		
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
        <script type="text/javascript" src="scripts/reporteingresosdetalles.js?ts=<?php echo date("Y-m-d H:i:s");?>"></script>
        <script type="text/javascript" src="scripts/cierre-sesion.js"></script>
		
<?php 
}
ob_end_flush();
?>
<script type="text/javascript">
    //table to excel (multiple table)
    var array1 = new Array();
    var n = 2; //Total table
   // for ( var x=1; x<=n; x++ ) {
       // array1[x-1] = 'export_table_to_excel_' + x;
  //  }
        array1[0] = 'reportedeingresospartida';
        array1[1] = 'reportedeingresoportributo';
    var tablesToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>'
            , templateend = '</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>'
            , body = '<body>'
            , tablevar = '<table>{table'
            , tablevarend = '}</table>'
            , bodyend = '</body></html>'
            , worksheet = '<x:ExcelWorksheet><x:Name>'
            , worksheetend = '</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>'
            , worksheetvar = '{worksheet'
            , worksheetvarend = '}'
            , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
            , wstemplate = ''
            , tabletemplate = '';

        return function (table, name, filename) {
            var tables = table;
            var wstemplate = '';
            var tabletemplate = '';

            wstemplate = worksheet + worksheetvar + '0' + worksheetvarend + worksheetend;
            for (var i = 0; i < tables.length; ++i) {
                tabletemplate += tablevar + i + tablevarend;
            }

            var allTemplate = template + wstemplate + templateend;
            var allWorksheet = body + tabletemplate + bodyend;
            var allOfIt = allTemplate + allWorksheet;

            var ctx = {};
            ctx['worksheet0'] = name;
            for (var k = 0; k < tables.length; ++k) {
                var exceltable;
                if (!tables[k].nodeType) exceltable = document.getElementById(tables[k]);
                ctx['table' + k] = exceltable.innerHTML;
            }

            document.getElementById("dlink").href = uri + base64(format(allOfIt, ctx));;
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
        }
    })();
</script>
