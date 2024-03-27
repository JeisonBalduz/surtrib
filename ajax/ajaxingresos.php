<?php 
session_start(); 
require_once "../modelos/Modeloingresos.php";
function muestrafloat($monto){//se7ho
  return number_format($monto, 2, ',', '.');
}
function guardafloat($monto){//se7ho
  return str_replace(',','.',str_replace('.','',$monto));
}
if (!isset($_SESSION["Totalmonto"]))
{
  $_SESSION["Totalmonto"]=0; $_SESSION["numeroregistro"]=0;
}
$contrih=new ingresos();

$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";
$comodinbusqueda2=isset($_POST["comodinbusqueda2"])? limpiarCadena($_POST["comodinbusqueda2"]):"";


switch ($_GET["op"]){
   
	case 'listaringresos': //AGRUPADO POR PARTIDA
    $cont=0;
		$rspta=$contrih->reporteIngresos($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
    $Total=0;
    $ntramite=0;
 		while ($reg=$rspta->fetch_object()){
 			$data[$cont]=[
 				"0"=>$reg->code,
 				"1"=>$reg->rubro,
				"2"=>$reg->ntramite,
 				"3"=>muestrafloat($reg->monto)
 				
 				];
 				$ntramite+=$reg->ntramite;
 				$Total+=$reg->monto;
      $cont++;
 		}

    if($cont>0){
          $data[$cont]=[
          "0"=>"",
	 				"1"=>"",
					"2"=>"<strong >".$ntramite."</strong>",
					"3"=>"<strong >".muestrafloat($Total)."</strong>"
	 				];
           ;
           }





 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
  case 'reportedeldia_taquilla':
	 $rspta=$contrih->reportedeldia_taquilla($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
       if($comodinbusqueda==$comodinbusqueda2){
 		while ($reg=$rspta->fetch_object()){ $cont2++;
            if($cont==0){
            	$user_id=$reg->user_id;
                $data[$cont]=[
                "0"=>$cont2,
 				"1"=>$reg->name,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
				"4"=>"P".$reg->recibo,
			    "5"=>$reg->approval,
				"6"=>$reg->ref,
				"7"=>muestrafloat($reg->monto) 
 				];
 				$TotalmontoUser=$reg->monto;
 				$Totalmonto=$reg->monto;
            }
            else{
            	if($user_id!=$reg->user_id){
                   $data[$cont]=[
                   	"0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
	 				$TotalmontoUser=0.00;
	 				$cont++;
		 			$data[$cont]=[
		 			"0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto)
	 				];
            	  $user_id=$reg->user_id;
            	  $TotalmontoUser=$reg->monto;
            	  $Totalmonto+=$reg->monto;
            	}
            	else{
                   
                    $data[$cont]=[
                    "0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto)
	 				];
                    $TotalmontoUser+=$reg->monto;
            	    $Totalmonto+=$reg->monto;

            	}


            }


 			
			$cont++;	 
 		}
           if($cont>0){
             $data[$cont]=[
             	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
               $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total General</strong>",
					"7"=>muestrafloat($Totalmonto)
	 				];
	 				//$_SESSION["Totalmonto"]=$Totalmonto;$_SESSION["numeroregistro"]=$cont2;
           }
          }//FIN DIAS IGUALES
          else{ ///////////////////////////////////////////
             while ($reg=$rspta->fetch_object()){ $cont2++;
	               if($cont==0){ 
	            	$user_id=$reg->user_id;
	            	$dia=$reg->dia;
	                $data[$cont]=[
	                "0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto) 
	 				];
	 				$TotalmontoUser=$reg->monto;
	 				$TotalDiamonto=$reg->monto;
	 				$Totalmonto=$reg->monto;
	               }
	               else{
                      if(($user_id!=$reg->user_id)&&$dia==$reg->dia){//MISMO DIA DIFERENTE CAJERO
		                   $data[$cont]=[
		                   	"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total</strong>",
							"7"=>muestrafloat($TotalmontoUser)
			 				];
			 				$TotalmontoUser=0.00;
			 				$cont++;
				 			$data[$cont]=[
				 			"0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		            	  $user_id=$reg->user_id;
		            	  $TotalmontoUser=$reg->monto;
		            	  $TotalDiamonto+=$reg->monto;
		            	  $Totalmonto+=$reg->monto;
		            	}
		            	else if(($user_id==$reg->user_id)&&$dia==$reg->dia){//MISMO CAJERO EN EL MISMO DIA
                   
		                    $data[$cont]=[
		                    "0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		                    $TotalmontoUser+=$reg->monto;
		                    $TotalDiamonto+=$reg->monto;
		            	    $Totalmonto+=$reg->monto;

		            	}
		            	else if($dia!=$reg->dia){//SI EL DIA ES DIFERENTE IMPRIME TOTALES Y SE CAMBIAN VARIABLES
                           $user_id=$reg->user_id;
	            	       $dia=$reg->dia;
                           $data[$cont]=[
                           	"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total</strong>",
							"7"=>muestrafloat($TotalmontoUser)
			 				];

			 				$cont++;
			 				$data[$cont]=[
			 				"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total Dia</strong>",
							"7"=>muestrafloat($TotalDiamonto)
			 				];

                            $TotalDiamonto=0.00;
			 				$TotalmontoUser=0.00;
			 				$cont++;
				 			$data[$cont]=[
				 			"0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		            	  $user_id=$reg->user_id;
		            	  $TotalmontoUser=$reg->monto;
		            	  $TotalDiamonto+=$reg->monto;
		            	  $Totalmonto+=$reg->monto;

		            	}


	               }

              $cont++;
             }
             
             if($cont>0){
             $data[$cont]=[
             	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
               $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total Dia</strong>",
					"7"=>muestrafloat($TotalDiamonto)
	 				];
	 		  $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total General</strong>",
					"7"=>muestrafloat($Totalmonto)
	 				];
	 				$_SESSION["Totalmonto"]=$Totalmonto;$_SESSION["numeroregistro"]=$cont2;
           }

          }


 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;


  case 'reportedeldia':
	 $rspta=$contrih->reportedeldia($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
       if($comodinbusqueda==$comodinbusqueda2){
 		while ($reg=$rspta->fetch_object()){ $cont2++;
            if($cont==0){
            	$user_id=$reg->user_id;
                $data[$cont]=[
                "0"=>$cont2,
 				"1"=>$reg->name,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
				"4"=>"P".$reg->recibo,
			    "5"=>$reg->approval,
				"6"=>$reg->ref,
				"7"=>muestrafloat($reg->monto) 
 				];
 				$TotalmontoUser=$reg->monto;
 				$Totalmonto=$reg->monto;
            }
            else{
            	if($user_id!=$reg->user_id){
                   $data[$cont]=[
                   	"0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
	 				$TotalmontoUser=0.00;
	 				$cont++;
		 			$data[$cont]=[
		 			"0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto)
	 				];
            	  $user_id=$reg->user_id;
            	  $TotalmontoUser=$reg->monto;
            	  $Totalmonto+=$reg->monto;
            	}
            	else{
                   
                    $data[$cont]=[
                    "0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto)
	 				];
                    $TotalmontoUser+=$reg->monto;
            	    $Totalmonto+=$reg->monto;

            	}


            }


 			
			$cont++;	 
 		}
           if($cont>0){
             $data[$cont]=[
             	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
               $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total General</strong>",
					"7"=>muestrafloat($Totalmonto)
	 				];
	 				$_SESSION["Totalmonto"]=$Totalmonto;$_SESSION["numeroregistro"]=$cont2;
           }
          }//FIN DIAS IGUALES
          else{ ///////////////////////////////////////////
             while ($reg=$rspta->fetch_object()){ $cont2++;
	               if($cont==0){ 
	            	$user_id=$reg->user_id;
	            	$dia=$reg->dia;
	                $data[$cont]=[
	                "0"=>$cont2,
	 				"1"=>$reg->name,
					"2"=>$reg->fecha,//.user_id
	 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
					"4"=>"P".$reg->recibo,
				    "5"=>$reg->approval,
					"6"=>$reg->ref,
					"7"=>muestrafloat($reg->monto) 
	 				];
	 				$TotalmontoUser=$reg->monto;
	 				$TotalDiamonto=$reg->monto;
	 				$Totalmonto=$reg->monto;
	               }
	               else{
                      if(($user_id!=$reg->user_id)&&$dia==$reg->dia){//MISMO DIA DIFERENTE CAJERO
		                   $data[$cont]=[
		                   	"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total</strong>",
							"7"=>muestrafloat($TotalmontoUser)
			 				];
			 				$TotalmontoUser=0.00;
			 				$cont++;
				 			$data[$cont]=[
				 			"0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		            	  $user_id=$reg->user_id;
		            	  $TotalmontoUser=$reg->monto;
		            	  $TotalDiamonto+=$reg->monto;
		            	  $Totalmonto+=$reg->monto;
		            	}
		            	else if(($user_id==$reg->user_id)&&$dia==$reg->dia){//MISMO CAJERO EN EL MISMO DIA
                   
		                    $data[$cont]=[
		                    "0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		                    $TotalmontoUser+=$reg->monto;
		                    $TotalDiamonto+=$reg->monto;
		            	    $Totalmonto+=$reg->monto;

		            	}
		            	else if($dia!=$reg->dia){//SI EL DIA ES DIFERENTE IMPRIME TOTALES Y SE CAMBIAN VARIABLES
                           $user_id=$reg->user_id;
	            	       $dia=$reg->dia;
                           $data[$cont]=[
                           	"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total</strong>",
							"7"=>muestrafloat($TotalmontoUser)
			 				];

			 				$cont++;
			 				$data[$cont]=[
			 				"0"=>"",
			 				"1"=>"",
							"2"=>"",//.user_id
			 				"3"=>"",//totaliq,
							"4"=>"",
						    "5"=>"",
							"6"=>"<strong style='align:right;'>Total Dia</strong>",
							"7"=>muestrafloat($TotalDiamonto)
			 				];

                            $TotalDiamonto=0.00;
			 				$TotalmontoUser=0.00;
			 				$cont++;
				 			$data[$cont]=[
				 			"0"=>$cont2,
			 				"1"=>$reg->name,
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->idrfc.'-'.$reg->ctramite,//totaliq,
							"4"=>"P".$reg->recibo,
						    "5"=>$reg->approval,
							"6"=>$reg->ref,
							"7"=>muestrafloat($reg->monto)
			 				];
		            	  $user_id=$reg->user_id;
		            	  $TotalmontoUser=$reg->monto;
		            	  $TotalDiamonto+=$reg->monto;
		            	  $Totalmonto+=$reg->monto;

		            	}


	               }

              $cont++;
             }
             
             if($cont>0){
             $data[$cont]=[
             	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total</strong>",
					"7"=>muestrafloat($TotalmontoUser)
	 				];
               $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total Dia</strong>",
					"7"=>muestrafloat($TotalDiamonto)
	 				];
	 		  $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"<strong style='align:right;'>Total General</strong>",
					"7"=>muestrafloat($Totalmonto)
	 				];
	 				$_SESSION["Totalmonto"]=$Totalmonto;$_SESSION["numeroregistro"]=$cont2;
           }

          }


 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;
    case 'reportedeldiacoinciliacion':
	 $rspta=$contrih->reportedeldiaConciliacionBancaria($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
           while ($reg=$rspta->fetch_object()){ $cont2++;
              $length = 7;
              $control = substr(str_repeat('0', $length).$reg->control, - $length);
               $data[$cont]=[
		                    "0"=>$cont2,
			 				"1"=>$reg->cajero,
			 				"2"=>$reg->fechad,//.user_id
							"3"=>$reg->fecha,//.user_id

			 				"4"=>$reg->tramite,//totaliq,
							"5"=>"P".$control,
						    "6"=>$reg->modo,
							"7"=>$reg->refencia,
							"8"=>muestrafloat($reg->monto)
			 				];
                  $Totalmonto+=$reg->monto;
               $cont++;
           }
           if($cont>0){
           	   $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
				    "6"=>"",
					"7"=>"<strong style='align:right;'>Total</strong>"."<input type='hidden' name='Totalcoinciliado' id='Totalcoinciliado' value='".$Totalmonto."'><input type='hidden' name='numerocoinciliado' id='numerocoinciliado' value='".$cont."'>",
					"8"=>muestrafloat($Totalmonto)
	 				];
               $cont++;
              $data[$cont]=[
              	    "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
					"6"=>"",
					"7"=>"",
					"8"=>""
	 				];        
	 				 $cont++;
	 				 $Totalmonto+=$_SESSION["Totalmonto"];
	 				 $cont2+=$_SESSION["numeroregistro"];
              $data[$cont]=[
              	    "0"=>$cont2,
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"",//totaliq,
					"4"=>"",
				    "5"=>"",
				    "6"=>"",
					"7"=>"<strong style='align:right;'>Total General</strong>",
					"8"=>muestrafloat($Totalmonto)
	 				];
	 				//$_SESSION["Totalmonto"]=$Totalmonto;$_SESSION["numeroregistro"]=$cont2;
           }

           $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

      break;
	case "resumendeingresos":
        $rspta=$contrih->resumendeingresos($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
   
 		while ($reg=$rspta->fetch_object()){ $cont2++;
          
         $data[$cont]=[
         "0"=>$cont2,
 				"1"=>$reg->partida,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->detalle,//totaliq,  
				"4"=>muestrafloat($reg->monto) 
 				];
 				//$TotalmontoUser=$reg->monto;
 				$Totalmonto+=$reg->monto;
         			
			$cont++;	 
 		}
           if($cont>0){
            
          $data[$cont]=[
          "0"=>"",
	 				"1"=>"",
					"2"=>"",//.user_id
	 				"3"=>"<strong style='align:right;'>Total</strong>",//totaliq,
					"4"=>"<strong >".muestrafloat($Totalmonto)."</strong>"
	 				];
	 
           }
       

           $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
     break;
     case "resumendeingresosdetalle":


      //  $rspta=$contrih->resumendeingresosdetalle($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
          $TotalDebitomonto=0.00;
         $TotalTranferenciamonto=0.00;
   
       $rspta=$contrih->resumendeingresosdetalleDebito($comodinbusqueda,$comodinbusqueda2);
 		while ($reg=$rspta->fetch_object()){ $cont2++;
          
         $data[$cont]=[
         "0"=>$cont2,
 				"1"=>$reg->partida,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->movimiento,//totaliq, 
 				"4"=>$reg->banco,
				"5"=>$reg->codbanco,//.user_id
 				"6"=>$reg->ref,//totaliq, 
				"7"=>$reg->monto //muestrafloat($reg->monto) 
 				];
 				//$TotalmontoUser=$reg->monto;
 				$Totalmonto+=$reg->monto;
         		$TotalDebitomonto+=$reg->monto;	
			$cont++;	 
 		}
 		
 		if($cont>0){
            
          $data[$cont]=[
            "0"=>"",
 				"1"=>"",
				"2"=>"",//.user_id
 				"3"=>"",//totaliq, 
 				"4"=>"",
				"5"=>"",//.user_id
 				"6"=>"<strong style='align:right;'>Total Debito</strong>",//totaliq, 
				"7"=>"<strong >".muestrafloat($TotalDebitomonto)."</strong>" 
             ];
	      $cont++;	
           }
 		
      $rspta=$contrih->resumendeingresosdetalleTrranferencia($comodinbusqueda,$comodinbusqueda2);
 		while ($reg=$rspta->fetch_object()){ $cont2++;
          
         $data[$cont]=[
         "0"=>$cont2,
 				"1"=>$reg->partida,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->movimiento,//totaliq, 
 				"4"=>$reg->banco,
				"5"=>$reg->codbanco,//.user_id
 				"6"=>$reg->ref,//totaliq, 
				"7"=>$reg->monto //muestrafloat($reg->monto)  
 				];
 				//$TotalmontoUser=$reg->monto;
 				$Totalmonto+=$reg->monto;
         		$TotalTranferenciamonto+=$reg->monto;	
			$cont++;	 
 		}
        if($cont>0){
            
          $data[$cont]=[
            "0"=>"",
 				"1"=>"",
				"2"=>"",//.user_id
 				"3"=>"",//totaliq, 
 				"4"=>"",
				"5"=>"",//.user_id
 				"6"=>"<strong style='align:right;'>Total Transferencia</strong>",//totaliq, 
				"7"=>"<strong >".muestrafloat($TotalTranferenciamonto)."</strong>" 
             ];
	      $cont++;	
           }
        if($cont>0){
            
          $data[$cont]=[
            "0"=>"",
 				"1"=>"",
				"2"=>"",//.user_id
 				"3"=>"",//totaliq, 
 				"4"=>"",
				"5"=>"",//.user_id
 				"6"=>"<strong style='align:right;'>Total</strong>",//totaliq, 
				"7"=>"<strong >".muestrafloat($Totalmonto)."</strong>" 
             ];
	 
           }
       

           $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
     break;
     case "resumendeingresosdetallecontribulente":


      //  $rspta=$contrih->resumendeingresosdetalle($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
        $iduser=0;
         $cont=0;
         $cont2=0;
         $user_id=0;
         $dia=0;
         $TotalmontoUser=0.00;
         $TotalDiamonto=0.00;
         $Totalmonto=0.00;
   
       $rspta=$contrih->resumendeingresosdetalleDebito($comodinbusqueda,$comodinbusqueda2);
 		while ($reg=$rspta->fetch_object()){ $cont2++;
          $rif=$contrih->getrifcontri($reg->ctramite);
         $data[$cont]=[
         "0"=>$cont2,
 				"1"=>$reg->partida,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->movimiento,//totaliq, 
 				"4"=>$reg->banco,
				"5"=>$reg->codbanco,//.user_id
 				"6"=>$reg->ref,//totaliq, 
 				"7"=>$reg->ctramite,
 				"8"=>$rif,
				"9"=>muestrafloat($reg->monto) 
 				];
 				//$TotalmontoUser=$reg->monto;
 				$Totalmonto+=$reg->monto;
         			
			$cont++;	 
 		}
      $rspta=$contrih->resumendeingresosdetalleTrranferencia($comodinbusqueda,$comodinbusqueda2);
 		while ($reg=$rspta->fetch_object()){ $cont2++;
          $rif=$contrih->getrifcontri($reg->ctramite);
         $data[$cont]=[
         "0"=>$cont2,
 				"1"=>$reg->partida,
				"2"=>$reg->fecha,//.user_id
 				"3"=>$reg->movimiento,//totaliq, 
 				"4"=>$reg->banco,
				"5"=>$reg->codbanco,//.user_id
 				"6"=>$reg->ref,//totaliq, 
 				"7"=>$reg->ctramite,
 				"8"=>$rif,
				"9"=>muestrafloat($reg->monto) 
 				];
 				//$TotalmontoUser=$reg->monto;
 				$Totalmonto+=$reg->monto;
         			
			$cont++;	 
 		}

        if($cont>0){
            
          $data[$cont]=[
            "0"=>"",
 				"1"=>"",
				"2"=>"",//.user_id
 				"3"=>"",//totaliq, 
 				"4"=>"",
				"5"=>"",
				"6"=>"",
				"7"=>"",
 				"8"=>"<strong style='align:right;'>Total</strong>",//totaliq, 
				"9"=>"<strong >".muestrafloat($Totalmonto)."</strong>" 
             ];
	 
           }
       

           $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
     break;
     
    case 'compensacion': //AGRUPADO POR PARTIDA
    $cont=0;
		$rspta=$contrih->ingresosDeclarados($comodinbusqueda,$comodinbusqueda2);
 		//Vamos a declarar un array
 		$data= Array();
    $Total=0;
    $ntramite=0;
 		if ($reg=$rspta->fetch_object()){
 			$data[0]=[
 				"0"=>1,
 				"1"=>"Monto Total de Ingresos brutos declarado por los contibuyentes. En esta opción se requiere informe la sumatoria de todos los ingresos brutos obtenidos por los contribuyentes durante el periodo",
				"2"=>muestrafloat($reg->TingresosDeclarados)
 				
 				];
 				$data[1]=[
 				"0"=>2,
 				"1"=>"Numero total de contibuyentes que declararon ingresos brutos, Deberia indicar el numero total de contibuyentes que declararon ingresos durante el periodo indicado",
				"2"=>$reg->cuantosdeclararon
 				
 				];
 				$data[2]=[
 				"0"=>3,
 				"1"=>"Monto Total de los impuestos generados por las declaraciones de ingresos brutos. Se requiere informe el monto total del impuesto generado por las declaraciones de ingresos brutos en el periodo indicado",
				"2"=>muestrafloat($reg->CuantoApagar)
 				
 				];
            $cont=3;
 		}
 		$rspta2=$contrih->ingresosDeclaradosPagados($comodinbusqueda,$comodinbusqueda2);
         if ($reg=$rspta2->fetch_object()){
 			$data[$cont]=[
 				"0"=>4,
 				"1"=>"Numero total de contibuyentes que pagaron los impuestos derivados de la declaracion de ingresos. Deberia indicar el numero total de contribuyentes que pagaron los impuestos derivados de la declaracion de imgresos  brutos en el periodo indicado",
				"2"=>$reg->Cuantospagaron
 				
 				];
 		  }

 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>