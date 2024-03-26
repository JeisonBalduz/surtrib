<?php 
session_start(); 
require_once "../modelos/Contribuyentes.php";
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
$contrih=new Contrih();

$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$tiponac=isset($_POST["tiponac"])? limpiarCadena($_POST["tiponac"]):"";
$cedularif=isset($_POST["cedularif"])? limpiarCadena($_POST["cedularif"]):"";
$razsocial=isset($_POST["razsocial"])? limpiarCadena($_POST["razsocial"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$tlf=isset($_POST["tlf"])? limpiarCadena($_POST["tlf"]):"";
$codcel=isset($_POST["codcel"])? limpiarCadena($_POST["codcel"]):"";
$celular=isset($_POST["celular"])? limpiarCadena($_POST["celular"]):"";
$modo=isset($_POST["modo"])? limpiarCadena($_POST["modo"]):"";
$estado_pk=isset($_POST["estado_pk"])? limpiarCadena($_POST["estado_pk"]):"";
$municipio_pk=isset($_POST["municipio_pk"])? limpiarCadena($_POST["municipio_pk"]):"";
$parroquia_pk=isset($_POST["parroquia_pk"])? limpiarCadena($_POST["parroquia_pk"]):"";
$ciudad_pk=isset($_POST["ciudad_pk"])? limpiarCadena($_POST["ciudad_pk"]):"";
$sector=isset($_POST["sector"])? limpiarCadena($_POST["sector"]):"";
$calle=isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$edificio=isset($_POST["edificio"])? limpiarCadena($_POST["edificio"]):"";
$numeroedif=isset($_POST["numeroedif"])? limpiarCadena($_POST["numeroedif"]):"";
$medit=isset($_POST["medit"])? limpiarCadena($_POST["medit"]):"";
$representative=isset($_POST["representative"])? limpiarCadena($_POST["representative"]):"";
$addresses=isset($_POST["addresses"])? limpiarCadena($_POST["addresses"]):"";
$code=isset($_POST["code"])? limpiarCadena($_POST["code"]):"";
$registrado=isset($_POST["registrado"])? limpiarCadena($_POST["registrado"]):"";
$conformidaduso=isset($_POST["conformidaduso"])? limpiarCadena($_POST["conformidaduso"]):"";
$tieneinmueble=isset($_POST["tieneinmueble"])? limpiarCadena($_POST["tieneinmueble"]):"";
$taseo=isset($_POST["taseo"])? limpiarCadena($_POST["taseo"]):"";
$texpe=isset($_POST["texpe"])? limpiarCadena($_POST["texpe"]):"";
$tapu=isset($_POST["tapu"])? limpiarCadena($_POST["tapu"]):"";
$tilico=isset($_POST["tilico"])? limpiarCadena($_POST["tilico"]):"";
$pkenumerator=isset($_POST["pkenumerator"])? limpiarCadena($_POST["pkenumerator"]):"";
$contrato=isset($_POST["contrato"])? limpiarCadena($_POST["contrato"]):"";
$viejo=isset($_POST["viejo"])? limpiarCadena($_POST["viejo"]):"";
$ultima_declaracion=isset($_POST["ultima_declaracion"])? limpiarCadena($_POST["ultima_declaracion"]):"";
$estatus=isset($_POST["estatus"])? limpiarCadena($_POST["estatus"]):"";
$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";
$comodinbusqueda2=isset($_POST["comodinbusqueda2"])? limpiarCadena($_POST["comodinbusqueda2"]):"";
$codigo_grupo=isset($_POST["codigo_grupo"])? limpiarCadena($_POST["codigo_grupo"]):"";
$detalles=isset($_POST["detalles"])? limpiarCadena($_POST["detalles"]):"";
$alicuota=isset($_POST["alicuota"])? limpiarCadena($_POST["alicuota"]):"";
$minimo_tributable=isset($_POST["minimo_tributable"])? limpiarCadena($_POST["minimo_tributable"]):"";
$minimo_tributable_ptr=isset($_POST["minimo_tributable_ptr"])? limpiarCadena($_POST["minimo_tributable_ptr"]):"";
$bactividad=isset($_POST["bactividad"])? limpiarCadena($_POST["bactividad"]):"";
$umt=isset($_POST["umt"])? limpiarCadena($_POST["umt"]):"";
$DECRETO=isset($_POST["DECRETO"])? limpiarCadena($_POST["DECRETO"]):"";
$descuento=isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$dias_valido=isset($_POST["dias_valido"])? limpiarCadena($_POST["dias_valido"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tramite=isset($_POST["tramite"])? limpiarCadena($_POST["tramite"]):"";
$idtributo=isset($_POST["idtributo"])? limpiarCadena($_POST["idtributo"]):"";
$tributo=isset($_POST["tributo"])? limpiarCadena($_POST["tributo"]):"";
$totaliq=isset($_POST["totaliq"])? limpiarCadena($_POST["totaliq"]):"";
$descuento=isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"";
$diferido=isset($_POST["diferido"])? limpiarCadena($_POST["diferido"]):"";
$totalp=isset($_POST["totalp"])? limpiarCadena($_POST["totalp"]):"";
$totaltotal=isset($_POST["totaltotal"])? limpiarCadena($_POST["totaltotal"]):"";
$fpago=isset($_POST["fpago"])? limpiarCadena($_POST["fpago"]):"";

$totliq=isset($_POST["totliq"])? limpiarCadena($_POST["totliq"]):"";
$fpago=isset($_POST["fpago"])? limpiarCadena($_POST["fpago"]):"";



switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($rfc)){
			$rspta=$contrih->insertar($licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
			echo $rspta ? "Contribuyente registrado" : "Contribuyente no se pudo registrar";
		}
		else {
			$rspta=$contrih->editar($rfc,$licencia,$tiponac,$cedularif,$razsocial,$correo,$tlf,$codcel,$celular,$modo,$estado_pk,$municipio_pk,
	                         $parroquia_pk,$ciudad_pk,$sector,$calle,$edificio,$numeroedif,$medit,$representative,$addresses,$code,$registrado,
							 $conformidaduso,$tieneinmueble,$taseo,$texpe,$tapu,$tilico,$pkenumerator,$contrato,$viejo,$ultima_declaracion);
			echo $rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar";
		}
	break;
	case 'buscarContibuyente':
     global $conexion;
		 $cont=0;
     $data= Array();
  
      	$search_term = $_REQUEST['search'];
      
		$rspta=$contrih->buscarContibuyente($search_term);
		
 		while ($reg=$rspta->fetch_object()){
      $cont++;
      $data[]=Array("id"=>$reg->rfc,"text"=>$reg->rif);

 		}
    if($cont>0){
    	$rspta->free();
    }
 		echo json_encode($data);
 		$conexion->close();
	break;

	case 'desactivar':
		$rspta=$contrih->desactivar($rfc);
 		echo $rspta ? "Contribuyente desactivado" : "Contribuyente no se pudo desactivar";
	break;

	case 'activar':
		$rspta=$contrih->activar($rfc);
 		echo $rspta ? "Contribuyente activado" : "Contribuyente no se pudo activar";
	break;
        
	case 'mostrar':
		$rspta=$contrih->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrartotal':
		$rspta=$contrih->mostrartotal($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrarliq':
		$rspta=$contrih->mostrarliq($tramite);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'listar':

		$rspta=$contrih->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>($reg->estatus)?'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-user"></i></button>'.
				 ' <button class="btn btn-danger" onclick="desactivar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>':
				 '<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-primary" onclick="activar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>',
 				"1"=>$reg->rfc,
				"2"=>$reg->licencia,
 				"3"=>$reg->tiponac."-".$reg->cedularif,
 				"4"=>$reg->razsocial,
				"5"=>'<a href="https://wa.me/58'.$reg->celular.'?text=Estimado%20contribuyente,%20recuerde%20realizar%20su%20delaci%C3%B3n,%20pago%20y%20notificaci%C3%B3n%20de%20pago%20los%20primeros%2015%20d%C3%ADas%20de%20cada%20mes%20para%20evitar%20recargos,%20de%20igual%20forma%20recordar%20que%20si%20realiza%20su%20pago%20en%20los%20primeros%205%20d%C3%ADas%20obtendr%C3%A1%20el%205%25%20de%20descuento.%0A%0A*Alcald%C3%ADa%20del%20Municipio%20Libertador*%0A*Direcci%C3%B3n%20de%20Hacienda*%0A" target="_blank" class="btn btn-info"><i class="fa fa-phone">0'.$reg->celular.'</i></a>',
			    "6"=>$reg->sector." ".$reg->calle." ".$reg->edificio." ".$reg->numeroedif,
				"7"=>$reg->correo,
				"8"=>$reg->codigo_grupo,
				"9"=>$reg->detalles,
				"10"=>$reg->alicuota,
				"11"=>$reg->umt,
				"12"=>$reg->DECRETO,
				"13"=>$reg->fpago
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listar2':

		$rspta=$contrih->listar2($comodinbusqueda);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>($reg->estatus)?'<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-user"></i></button>'.
				 ' <button class="btn btn-danger" onclick="desactivar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>':
				 '<button class="btn btn-info" onclick="mostrar('.$reg->rfc.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-primary" onclick="activar('.$reg->rfc.')"><i class="fa fa-edit"></i></button>',
 				"1"=>$reg->rfc,
				"2"=>$reg->licencia,
 				"3"=>$reg->tiponac."-".$reg->cedularif,
 				"4"=>$reg->razsocial,
				"5"=>'<a href="https://wa.me/58'.$reg->celular.'?text=Estimado%20contribuyente,%20recuerde%20realizar%20su%20delaci%C3%B3n,%20pago%20y%20notificaci%C3%B3n%20de%20pago%20los%20primeros%2015%20d%C3%ADas%20de%20cada%20mes%20para%20evitar%20recargos,%20de%20igual%20forma%20recordar%20que%20si%20realiza%20su%20pago%20en%20los%20primeros%205%20d%C3%ADas%20obtendr%C3%A1%20el%205%25%20de%20descuento.%0A%0A*Alcald%C3%ADa%20del%20Municipio%20Libertador*%0A*Direcci%C3%B3n%20de%20Hacienda*%0A" target="_blank" class="btn btn-info"><i class="fa fa-phone">0'.$reg->celular.'</i></a>',
			    "6"=>$reg->sector." ".$reg->calle." ".$reg->edificio." ".$reg->numeroedif,
				"7"=>$reg->correo,
				 "8"=>$reg->codigo_grupo,
				 "9"=>$reg->detalles,
				 "10"=>$reg->alicuota,
				 "11"=>$reg->umt,
				 "12"=>$reg->DECRETO,
				 "13"=>$reg->fpago
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'estadocuenta':

		$rspta=$contrih->estadocuenta($comodinbusqueda);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			if ($reg->saldo>=0){
				$recibo='<a target="_blank" href="../reportesPDF/recibopago.php?codigo='.$reg->tramite.'");" class="btn btn-info">Recibo</a>';
			}
			else {
				$recibo='<span class="badge bg-danger">Tramite por Pagar</span>';
			}
			
 			$data[]=[
 				"0"=>$reg->fechaliq,
				"1"=>$reg->tramite.'-'.$reg->period.' <button class="btn btn-info" onclick="mostrarliq('.$reg->tramite.')" data-toggle="modal" data-target="#modal-default"><i>Ver Liquidacion</i></button>',
 				"2"=>$reg->idt."-".$reg->detalle,
 				"3"=>$reg->totliq,
				 "4"=>$reg->montodiferido,
				 "5"=>$reg->diferencia,
				  "6"=>$reg->descuento,
			    "7"=>$reg->totpag,
				 "8"=>$reg->saldo,
				 "9"=>$recibo,
				
 				];
				 
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
							"2"=>$reg->fecha,//.user_id
			 				"3"=>$reg->tramite,//totaliq,
							"4"=>"P".$control,
						    "5"=>$reg->modo,
							"6"=>$reg->refencia,
							"7"=>muestrafloat($reg->monto)
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
					"6"=>"<strong style='align:right;'>Total</strong>"."<input type='hidden' name='Totalcoinciliado' id='Totalcoinciliado' value='".$Totalmonto."'><input type='hidden' name='numerocoinciliado' id='numerocoinciliado' value='".$cont."'>",
					"7"=>muestrafloat($Totalmonto)
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
					"7"=>""
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
					"6"=>"<strong style='align:right;'>Total General</strong>",
					"7"=>muestrafloat($Totalmonto)
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
}
?>