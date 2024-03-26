                 <form role="form" name="formulariopagotaquilla" id="formulariopagotaquilla" method="POST">
                    <input type="hidden" name="id_mayor" id="id_mayor" value="">
                    <input type="hidden" name="tramite" id="tramite" value="">
                    <input type="hidden" name="idt" id="idt" value="">
                 
             <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>-->
          
            <div class="modal-body">

              <div class="card-body"> 
                    <div class="row">
                      <div class="form-group col-sm-3 col-xs-12">
                         <label>Referencia</label>
                         <input type="text" name="txtreferencia" id="txtreferencia" />    
                      </div>
                      <div class="form-group col-sm-3 col-xs-12">
                         <label>Aprobado</label>
                         <input type="text" name="txtaprobado" id="txtaprobado" onkeypress="return NumCheck(event, this)" value="0.00" />    
                      </div>
                      <div class="form-group col-sm-3 col-xs-12">
                         <label>Monto</label>
                         <input type="numeric" name="txtmonto"  onkeypress="return NumCheck(event, this)" id="txtmonto" />   
                      </div>
                </div>
                 <div class="row">
                      <div class="form-group col-sm-3 col-xs-12">
                         <label>Total A Pagar:</label>
                         <input type="text" name="txttotalapagar" id="txttotalapagar" value="" disabled="disabled"/>
                      </div>
                </div>
          </div>


           
            </div>
          </form>
       


 <script type="text/javascript">
      
   // $("#tramitelig").html(<?php echo $tramite;  ?>);   
    $("#id_mayor").val(<?php echo $id_mayor;  ?>);
    $("#tramite").val(<?php echo $tramite;  ?>);
    $("#idt").val(<?php echo $idt;  ?>);
    $("#txttotalapagar").val(<?php echo $totliq;  ?>);
            

 </script>