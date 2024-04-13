<?php 
session_start(); 
require_once "../modelos/Modelopagotaquilla_aseo.php";
function muestrafloat($monto){//se7ho
  return number_format($monto, 2, ',', '.');
}
function guardafloat($monto){//se7ho
  return str_replace(',','.',str_replace('.','',$monto));
}
$PagoTaqulla=new PagoTaqulla();




//DE AQUI EN ADELAMTE
$idrfc=isset($_POST["idrfc"])? limpiarCadena($_POST["idrfc"]):"";
$id_mayor=isset($_POST["id_mayor"])? limpiarCadena($_POST["id_mayor"]):"";
$tramite=isset($_POST["tramite"])? limpiarCadena($_POST["tramite"]):"";
$totliq=isset($_POST["totliq"])? limpiarCadena($_POST["totliq"]):"";
$idt=isset($_POST["idt"])? limpiarCadena($_POST["idt"]):"";

$txtreferencia=isset($_POST["txtreferencia"])? limpiarCadena($_POST["txtreferencia"]):"";
$txtaprobado=isset($_POST["txtaprobado"])? limpiarCadena($_POST["txtaprobado"]):"";
$txtmonto=isset($_POST["txtmonto"])? limpiarCadena($_POST["txtmonto"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$idbanco=isset($_POST["banco"])? limpiarCadena($_POST["banco"]):"";


switch ($_GET["op"]){
        
	case 'Pagotaquilla': //********OJO POR AQUI
	 $resultado="";
	 $listramite="";

	 
	  $json_det = $_REQUEST['json_det'];
   $JsonRec =json_decode(str_replace("\\","",$json_det));
   // die(var_dump($JsonRec->comprobantes));
   // $JsonRec = new Services_JSON();//2201407051  2201508847
     $cont=0;
     $cad="";
     //myArray.push({ "id_mayor": comprobantes[i].id_mayor, "tramite":comprobantes[i].tramite,"totalapagar":parseFloat(total.toFixed(2)),"idt":comprobantes[i].idt });
		if(is_array($JsonRec->comprobantes)){ 
			foreach($JsonRec->comprobantes as $comprobantes){
				$cont++;
				if($cont==1){
					$listramite=$comprobantes->tramite;
				}
				else
					$listramite.=",".$comprobantes->tramite;
			//	$cad.=" mayor=".$comprobantes->id_mayor." idt=".$comprobantes->idt." tramite=".$comprobantes->tramite." totalapagar=".$comprobantes->totalapagar."<br/>";
				
				$rspta=$PagoTaqulla->pagartaquilla($comprobantes->id_mayor,$comprobantes->idt,$comprobantes->tramite,$txtreferencia,$txtaprobado,$comprobantes->totalapagar,$tipopago,$idbanco,$_SESSION['idusuario']);
				
				if(!$rspta){
					 if($cont==1){
             $listramite=str_replace($comprobantes->tramite, "", $listramite);
             $cont=0;
             $resultado.="Pago No Registrado Tramite:".$comprobantes->tramite."<br/>";
					 }
           else{
           	 $listramite=str_replace(",".$comprobantes->tramite, "", $listramite);
           	 $resultado.="Pago No Registrado Tramite:".$comprobantes->tramite."<br/>";
           }
				}
				else
					$resultado.=" Registrado Con Exito Tramite:".$comprobantes->tramite."<br/>";


      
       }
       $recibo='<a target="_blank" href="../reportesPDF/recibopago_aseo.php?codigo='.$listramite.'" class="btn btn-info">Recibo de Pago</a>';
            $resultado.=$recibo;
       echo $resultado;

     }//BIENEN CON LOS TRAMITES
     else
     	  echo "Datos No Procesados Error";
    //echo $cad;

	//	$rspta=$PagoTaqulla->pagartaquilla($id_mayor,$idt,$tramite,$txtreferencia,$txtaprobado,$txtmonto,$_SESSION['idusuario']);
 	//	echo $rspta ? "Registrado Con Exito".$recibo : "Pago No Registrado";
 		//echo "id_mayor=".$id_mayor." tramite=".$tramite." txtreferencia=".$txtreferencia." txtaprobado=".$txtaprobado." txtmonto=".$txtmonto." idt=".$idt;
	break;

	case 'consultarReferencia':
        
        $rspta=$PagoTaqulla->consultarreferencia($txtreferencia,$tipopago,$idbanco);
        $reg=$rspta->fetch_object();
         if($reg){
           echo json_encode(array("Referencia"=>1));
        }
        else
        	echo json_encode(array("Referencia"=>0));

   break;
        
	case 'obtenerdeudas':
		
	     $rspta = $PagoTaqulla->listardeudacontribuyente($idrfc);
 		//Vamos a declarar un array
 		$data= Array();
        $cont=0;
         $totliq=0;
		 $deferred=0;
		 $totpag=0;
		 $tp=0;//totalapagar
		 $totalapagar=0;
		 $detalle="";
 		while ($reg=$rspta->fetch_object()){ //onclick="mostrarliq('.$reg->id.')"
 		 
      if(($reg->totpag+$reg->descuento)<$reg->totliq){

 		    $tp=$reg->totliq-$reg->deferred-$reg->descuento-$reg->totpag;
 		    $tp=guardafloat(muestrafloat($tp));
 		      $detalle=$PagoTaqulla->getnametributo($reg->tramite);
         	$data[$cont]=[
 				"0"=>$cont+1,
 				"1"=>$reg->fechaliq,  
				
               "2"=>$reg->tramite.'-'.$reg->period. '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#formulario2"  data-id_mayor="'.$reg->id.'" data-tramite="'.$reg->tramite.'"  data-idt="'.$reg->idt.'" data-totliq="'.$reg->totliq.'" data-totalapagar="'.$tp.'"  name="idpago'.$cont.'" id="idpago'.$cont.'" onclick="document.getElementById(\'listramite'.$cont.'\').checked=true;vermarcados();Pagotaquilla(this.id);">Pagar</button>',

 				"3"=>$detalle,  
 				"4"=>$reg->totliq,
				"5"=>$reg->deferred,
			    "6"=>$reg->totpag,
			    "7"=>muestrafloat($tp),
			    "8"=>'<input name="listramite[]" id="listramite'.$cont.'" type="checkbox" value="'.$reg->tramite.'" data-idt="'.$reg->idt.'" data-id_mayor="'.$reg->id.'" data-totalapagar="'.$tp.'" onchange="vermarcados();" />'
 				];
 			 
 		 		$totliq+=$reg->totliq;
		 		$deferred+=$reg->deferred;
				$totpag+=$reg->totpag;
		 		$totalapagar+=$tp;
				$cont++;

       }


 		}
 		if($cont>0){
          $data[$cont]=[
          "0"=>"",
		  "1"=>"",//.user_id
		  "2"=>"",//totaliq,
		  "3"=>"",
	      "4"=>"<strong>".muestrafloat($totliq)."</strong>",
          "5"=>"<strong>".muestrafloat($deferred)."</strong>",
		  "6"=>"<strong>".muestrafloat($totpag)."</strong>",
		  "7"=>"<strong>".muestrafloat($totalapagar)."</strong>",
		  "8"=>'<strong id="totalapagar"></strong>' 
	 				];
               
           }
 			$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

 		break;

	
	break;

	

}
?>