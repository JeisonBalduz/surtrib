<?php 
session_start(); 
require_once "../modelos/Modeloinmueble.php";
$contrih=new Contriinmueble();


$comodinbusqueda=isset($_POST["comodinbusqueda"])? limpiarCadena($_POST["comodinbusqueda"]):"";

$rfc=$_SESSION['rfc'];
$rif=$_SESSION['rif'];
$iduser=$_SESSION['idusuario'];
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";

$Id_Inm=isset($_POST["Id_Inm"])? limpiarCadena($_POST["Id_Inm"]):"";  
$Ficha_Catastral=isset($_POST["Ficha_Catastral"])? limpiarCadena($_POST["Ficha_Catastral"]):"";  
$Tipo_Documento=isset($_POST["Tipo_Documento"])? limpiarCadena($_POST["Tipo_Documento"]):"";  
$N_Documento=isset($_POST["N_Documento"])? limpiarCadena($_POST["N_Documento"]):"";  
$Folio=isset($_POST["Folio"])? limpiarCadena($_POST["Folio"]):"";  
$Tomo=isset($_POST["Tomo"])? limpiarCadena($_POST["Tomo"]):"";  
$Protocolo=isset($_POST["Protocolo"])? limpiarCadena($_POST["Protocolo"]):"";  
$D_Fecha=isset($_POST["D_Fecha"])? limpiarCadena($_POST["D_Fecha"]):"";  
$Area_M=isset($_POST["Area_M"])? limpiarCadena($_POST["Area_M"]):"";  
$Precio=isset($_POST["Precio"])? limpiarCadena($_POST["Precio"]):"";  
//$Activo=isset($_POST["Id_Inm"])? limpiarCadena($_POST["Id_Inm"]):"";  
$Ano_Avaluo=isset($_POST["Ano_Avaluo"])? limpiarCadena($_POST["Ano_Avaluo"]):"";
$Direccion_E1=isset($_POST["Direccion_E1"])? limpiarCadena($_POST["Direccion_E1"]):""; 
$Direccion_D1=isset($_POST["Direccion_D1"])? limpiarCadena($_POST["Direccion_D1"]):""; 
$Direccion_E2=isset($_POST["Direccion_E2"])? limpiarCadena($_POST["Direccion_E2"]):""; 
$Direccion_D2=isset($_POST["Direccion_D2"])? limpiarCadena($_POST["Direccion_D2"]):"";
$Direccion_Ext_D2=isset($_POST["Direccion_Ext_D2"])? limpiarCadena($_POST["Direccion_Ext_D2"]):"";
$Direccion_E3=isset($_POST["Direccion_E3"])? limpiarCadena($_POST["Direccion_E3"]):"";
$Direccion_D3=isset($_POST["Direccion_D3"])? limpiarCadena($_POST["Direccion_D3"]):"";
$Direccion_E4=isset($_POST["Direccion_E4"])? limpiarCadena($_POST["Direccion_E4"]):"";
$Direccion_D4=isset($_POST["Direccion_D4"])? limpiarCadena($_POST["Direccion_D4"]):"";
$Id_Estado=isset($_POST["Id_Estado"])? limpiarCadena($_POST["Id_Estado"]):"";
$Id_Municipio=isset($_POST["Id_Municipio"])? limpiarCadena($_POST["Id_Municipio"]):"";
$Id_Parroquia=isset($_POST["Id_Parroquia"])? limpiarCadena($_POST["Id_Parroquia"]):"";
$Referencia=isset($_POST["Referencia"])? limpiarCadena($_POST["Referencia"]):"";
$Comunidad=isset($_POST["Comunidad"])? limpiarCadena($_POST["Comunidad"]):"";
$CT_Top=isset($_POST["CT_Top"])? limpiarCadena($_POST["CT_Top"]):"";
$CT_Form=isset($_POST["CT_Form"])? limpiarCadena($_POST["CT_Form"]):"";
$CT_Tene=isset($_POST["CT_Tene"])? limpiarCadena($_POST["CT_Tene"]):"";
$CT_Uso=isset($_POST["CT_Uso"])? limpiarCadena($_POST["CT_Uso"]):"";
$CT_Estatus=isset($_POST["CT_Estatus"])? limpiarCadena($_POST["CT_Estatus"]):"";
$CT_Dim_Fre=isset($_POST["CT_Dim_Fre"])? limpiarCadena($_POST["CT_Dim_Fre"]):"";
$CT_Dim_Fon=isset($_POST["CT_Dim_Fon"])? limpiarCadena($_POST["CT_Dim_Fon"]):"";
$CT_Dim_Are=isset($_POST["CT_Dim_Are"])? limpiarCadena($_POST["CT_Dim_Are"]):"";
$CT_Clas=isset($_POST["CT_Clas"])? limpiarCadena($_POST["CT_Clas"]):"";
$CT_Alic=isset($_POST["CT_Alic"])? limpiarCadena($_POST["CT_Alic"]):"";

$nuevacons=isset($_POST["nuevacons"])? limpiarCadena($_POST["nuevacons"]):"";                   
        
switch ($_GET["op"]){
        
	case 'guardaryeditar':
		if (empty($Id_Inm)){
			$rspta=$contrih->insertar($Ficha_Catastral,$Tipo_Documento,$N_Documento,$Folio,$Tomo,$Protocolo,$D_Fecha,$Area_M,$Precio,$Ano_Avaluo,$Direccion_E1,$Direccion_D1,$Direccion_E2,$Direccion_D2,$Direccion_Ext_D2,$Direccion_E3,$Direccion_D3,$Direccion_E4,$Direccion_D4,$Id_Estado,$Id_Municipio,$Id_Parroquia,$Referencia,$Comunidad,$CT_Top,$CT_Form,$CT_Tene,$CT_Uso,$CT_Estatus,$CT_Dim_Fre,$CT_Dim_Fon,$CT_Dim_Are,$CT_Clas,$CT_Alic);
			echo $rspta ? "Contribuyente registrado" : "Contribuyente no se pudo registrar";
		}
		else {
			$rspta=$contrih->editar($Id_Inm,$Ficha_Catastral,$Tipo_Documento,$N_Documento,$Folio,$Tomo,$Protocolo,$D_Fecha,$Area_M,$Precio,$Ano_Avaluo,$Direccion_E1,$Direccion_D1,$Direccion_E2,$Direccion_D2,$Direccion_Ext_D2,$Direccion_E3,$Direccion_D3,$Direccion_E4,$Direccion_D4,$Id_Estado,$Id_Municipio,$Id_Parroquia,$Referencia,$Comunidad,$CT_Top,$CT_Form,$CT_Tene,$CT_Uso,$CT_Estatus,$CT_Dim_Fre,$CT_Dim_Fon,$CT_Dim_Are,$CT_Clas,$CT_Alic);
			echo $rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar";
     // //agregarBitacora($rspta ? "Contribuyente actualizado" : "Contribuyente no se pudo actualizar","formulario");
		}
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
		$rspta=$contrih->mostrar($Id_Inm);
 		//Codificar el resultado utilizando json

 		echo json_encode($rspta);
     //agregarBitacora("Datos de Inmueble","formulario");
	break;

	case 'listar':

		$rspta=$contrih->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=[
 				"0"=>'<button class="fa fa-user" onclick="mostrar('.$reg->Id_Inm.')"><i class="fa fa-pencil"></i></button> <button class="btn btn-primary" onclick="activar('.$reg->Id_Inm.')"><i class="fa fa-edit"></i></button>',
 				"1"=>$reg->RIF_CI,
				"2"=>$reg->Ficha_Catastral,
				"3"=>$reg->Tipo_Documento,
 				"4"=>$reg->Ano_Avaluo,
 				"5"=>$reg->CT_Uso,
				"6"=>$reg->CT_Tene,
				"7"=>$reg->Area_M,
 				"8"=>$reg->Ultimo_Anio_Pago,
 				"9"=>$reg->constru,
 				"10"=>$reg->Folio,
 				"11"=>$reg->Tomo,
 				"12"=>$reg->Protocolo,
 				"13"=>$reg->D_Fecha,
 				"14"=>$reg->Area_M,
 				"15"=>$reg->Precio,
 				"16"=>$reg->Ano_Avaluo,
 				"17"=>$reg->CT_Estatus,"18"=>$reg->CT_Clas,"19"=>$reg->CT_Dim_Fre,"20"=>$reg->CT_Dim_Fon,"21"=>$reg->CT_Dim_Are,"22"=>$reg->Precio,"23"=>$reg->CT_Alic
                 
 				
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
 				"0"=>'<button class="fa fa-user" onclick="mostrar('.$reg->Id_Inm.')"><i class="fa fa-pencil"></i></button>'.
				 ' <button class="btn btn-primary" onclick="activar('.$reg->Id_Inm.')"><i class="fa fa-edit"></i></button>',
 				"1"=>$reg->RIF_CI,
				"2"=>$reg->Ficha_Catastral,
				"3"=>$reg->Tipo_Documento,
 				"4"=>$reg->Ano_Avaluo,
 				"5"=>$reg->CT_Uso,
				"6"=>$reg->CT_Tene,
				"7"=>$reg->Area_M,
 				"8"=>$reg->Ultimo_Anio_Pago,
 				"9"=>$reg->constru,
 				"10"=>$reg->Folio,
 				"11"=>$reg->Tomo,
 				"12"=>$reg->Protocolo,
 				"13"=>$reg->D_Fecha,
 				"14"=>$reg->Area_M,
 				"15"=>$reg->Precio,
 				"16"=>$reg->Ano_Avaluo,
 				"17"=>$reg->CT_Estatus,"18"=>$reg->CT_Clas,"19"=>$reg->CT_Dim_Fre,"20"=>$reg->CT_Dim_Fon,"21"=>$reg->CT_Dim_Are,"22"=>$reg->Precio,"23"=>$reg->CT_Alic
 				
 				
 				];

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case 'opcionesinmueble':

	 switch ($_REQUEST["tipoopcion"]){
	 	case 'construccionguardar':
	 	    $CC_Puer=$_POST["CC_Puer"];
	 	    $CC_Estr=$_POST["CC_Estr"];
	 	if($CC_Puer!=null)
         $CC_Puer = implode(":",$CC_Puer);
        else
          $CC_Puer="";
        if($CC_Estr!=null)
        $CC_Estr = implode(":",$CC_Estr);
       else
          $CC_Estr="";



       if ($nuevacons<>""){
     $rspta=$contrih->insertarconstruccion($Id_Inm,$_POST["CC_Dim_Are"],$_POST["CC_Dim_Fon"],$_POST["CC_Dim_Fre"],$_POST["CC_Est_Con"],$_POST["CC_NP"],$_POST["CC_Elec"],$CC_Puer,$_POST["CC_Piso"],$CC_Estr,$_POST["CC_Tech_Cubi"],$_POST["CC_Tech_Estr"],$_POST["CC_Par_Acab"],$_POST["CC_Par_Tipo"],$_POST["CC_Tipo"],$_POST["CC_Ocup"],$_POST["CC_NH"],$_POST["CC_Uso"],$_POST["Anio_Cons"],$_POST["CC_Clas"],$_POST["CC_Alic"]);
           echo $rspta ? "Registrada con  Exito" : "No se Pudo Registrar";;
       }
      else {
      $rspta=$contrih->setconstruccion($_POST["Id_Inm_Cons"],$_POST["CC_Dim_Are"],$_POST["CC_Dim_Fon"],$_POST["CC_Dim_Fre"],$_POST["CC_Est_Con"],$_POST["CC_NP"],$_POST["CC_Elec"],$CC_Puer,$_POST["CC_Piso"],$CC_Estr,$_POST["CC_Tech_Cubi"],$_POST["CC_Tech_Estr"],$_POST["CC_Par_Acab"],$_POST["CC_Par_Tipo"],$_POST["CC_Tipo"],$_POST["CC_Ocup"],$_POST["CC_NH"],$_POST["CC_Uso"],$_POST["Anio_Cons"],$_POST["CC_Clas"],$_POST["CC_Alic"]);
           echo $rspta ? "Actualizacion Exitosa" : "No se Pudo Actualizar";;
        }








	 	       
           //agregarBitacora($rspta ? "actualizo Construccion" : "No se Actualizo la Construccion","formulario");
	 	  break;
    case 'construccionlistar':
	  $contcontru=0;
	  $Id_Inm=$_REQUEST['Id_Inm'];
         $rspta=$contrih->construccionListarInm($Id_Inm);
 		//Vamos a declarar un array
 		$data=Array();//onclick="EditCinstruccion('.$reg->Id_Inm.','.$reg->Id_Inm_Cons.')"
 		    /*<button class="btn btn-primary" onclick="activarConstru('.$reg->Id_Inm_Cons.')"><i class="fa fa-edit"></i></button>'.'<input type="hidden" name="CC_Uso" id="CC_Uso" value="'.$reg->CC_Uso.'"><input type="hidden" name="CC_Tipo" id="CC_Tipo" value="'.$reg->CC_Tipo.'"><input type="hidden" name="CC_Ocup" id="CC_Ocup" value="'.$reg->CC_Ocup.'"><input type="hidden" name="CC_Estr" id="CC_Estr" value="'.$reg->CC_Estr.'"><input type="hidden" name="CC_Estr" id="CC_Estr" value="'.$reg->CC_Estr.'">*/
 		    /*
 		    "0"=>'<a class="consulta" href="../ajax/contriInmueble.php?op=opcionesinmueble&tipoopcion=construccionedit&Id_Inm='.$reg->Id_Inm.'&Id_Const='.$reg->Id_Inm_Cons.'" data-Id_Inm="'.$reg->Id_Inm.'" data-Id_Const="'.$reg->Id_Inm_Cons.'" ><button class="fa fa-user" ><i class="fa fa-pencil"></i></button> </a>',
 		    */
      while ($reg=$rspta->fetch_object()){
        $data[]=[
 				"0"=>'<a class="consulta" href="#" data-Id_Inm="'.$reg->Id_Inm.'" data-Id_Const="'.$reg->Id_Inm_Cons.'" ><button class="fa fa-user" ><i class="fa fa-pencil"></i></button> </a>',
 				"1"=>$reg->CC_Usoo,
				"2"=>$reg->CC_Tipoo,
				"3"=>$reg->CC_Ocupp,
				"4"=>$reg->CC_Class,
        "5"=>$reg->CC_Alicc

 				/*"4"=>$reg->CC_Estr,
 				"5"=>$reg->CC_Piso,
				"6"=>$reg->CC_Puer,
				"7"=>$reg->CC_Par_Tipo,
 				"8"=>$reg->CC_Par_Acab,
 				"9"=>$reg->CC_Tech_Estr,
 				"10"=>$reg->CC_Tech_Cubi,
 				"11"=>$reg->CC_Elec,
 				"12"=>"AMBIENTE",
 				"13"=>$reg->CC_Est_Con,
 				"14"=>$reg->CC_NH,
 				"15"=>$reg->CC_NP,
 				"16"=>$reg->CC_Clas,
 				"17"=>$reg->CC_Dim_Fre,"18"=>$reg->CC_Dim_Fon,"19"=>$reg->CC_Dim_Are,"20"=>$reg->CC_Alic*/
                 
 				
 				];
             

      }
     $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

     break;
    case 'construccionedit':
       $Id_Const=$_REQUEST["Id_Const"]; //echo "Hola=".$_REQUEST["Id_Const"];break;
       $Id_Inm_Cons=""; $Id_Inm=""; $CC_Dim_Are=""; $CC_Dim_Fon=""; $CC_Dim_Fre=""; $CC_Est_Con=""; $CC_NP=""; $CC_Elec=""; $CC_Puer=""; $CC_Piso=""; $CC_Estr=""; $CC_Tech_Cubi=""; $CC_Tech_Estr=""; 
       $CC_Par_Acab=""; $CC_Par_Tipo=""; $CC_Tipo=""; $CC_Ocup=""; $CC_NH=""; $CC_Uso=""; $Anio_Cons=""; $CC_Clas=""; $CC_Alic="";
       if ($Id_Const<>''){

           $rspta=$contrih->getconstrucion($Id_Const);
          if ($reg=$rspta->fetch_object()){
             $Id_Inm_Cons=$reg->Id_Inm_Cons; $Id_Inm=$reg->Id_Inm; $CC_Dim_Are=$reg->CC_Dim_Are; $CC_Dim_Fon=$reg->CC_Dim_Fon; $CC_Dim_Fre=$reg->CC_Dim_Fre; $CC_Est_Con=$reg->CC_Est_Con; $CC_NP=$reg->CC_NP; $CC_Elec=$reg->CC_Elec; $CC_Puer=$reg->CC_Puer; $CC_Piso=$reg->CC_Piso; $CC_Estr=$reg->CC_Estr; $CC_Tech_Cubi=$reg->CC_Tech_Cubi; $CC_Tech_Estr=$reg->CC_Tech_Estr; $CC_Par_Acab=$reg->CC_Par_Acab; $CC_Par_Tipo=$reg->CC_Par_Tipo; $CC_Tipo=$reg->CC_Tipo;
              $CC_Ocup=$reg->CC_Ocup; $CC_NH=$reg->CC_NH; $CC_Uso=$reg->CC_Uso; $Anio_Cons=$reg->Anio_Cons; $CC_Clas=$reg->CC_Clas; $CC_Alic=$reg->CC_Alic;
           }
       }  
       require_once "informe_acceso.php";
     break;
	 	case 'construccion':
	  $contcontru=0;
        //echo $IdInm;
        $rspta=$contrih->construccionInm($Id_Inm);
 		//Vamos a declarar un array
 		$data=Array();
 		echo '<table class="table-bordered"><thead></thead><tbody>';
      while ($reg=$rspta->fetch_object()){
        $contcontru++;
             echo '<tr><td colspan="3"><strong>Características de la construcción '.$contcontru.'</strong></td></tr>';  
              echo '<tr><td><strong>USO:</strong><div >'.$reg->CC_Uso.'</div></td>';
              echo '<td><strong>Tipo:</strong><div >'.$reg->CC_Tipo.'</div></td>';
              echo '<td><strong>Ocupación:</strong><div >'.$reg->CC_Ocup.'</div></td> </tr>';    
           
           echo '<tr><td><strong>Estructura:</strong><div ></div></td>';
              echo '<td><strong>Piso:</strong><div >'.$reg->CC_Piso.'</div></td>';
              echo '<td><strong>Puertas:</strong><div ></div></td> </tr>';  

          echo '<tr><td colspan="3"><strong>Paredes</strong></td></tr>';          
          echo '<tr><td><strong>Tipo:</strong><div>'.$reg->CC_Par_Tipo.'</div></td>';
              echo '<td><strong>Acabado:</strong><div>'.$reg->CC_Par_Acab.'</div></td>';
              echo '<td><strong></strong><div></div></td> </tr>';  
                 
         // echo '<tr><td colspan="3"><strong></strong></td></tr>';          
          echo '<tr><td><strong>Eléctricas:</strong><div>'.$reg->CC_Elec.'</div></td>';
              echo '<td><strong>Ambientes:</strong><div></div></td>';
              echo '<td><strong>Estado de conservación:</strong><div>'.$reg->CC_Est_Con.'</div></td> </tr>';         
           echo '<tr><td><strong>N° de habitaciones:</strong><div>'.$reg->CC_NH.'</div></td>';
              echo '<td><strong></strong><div></div></td>';
              echo '<td><strong>N° de plantas:</strong><div>'.$reg->CC_NP.'</div></td> </tr>';

          echo '<tr><td colspan="3"><strong>Clasificación:</strong> '.$reg->CC_Clas.'</td></tr>';

           echo '<tr><td colspan="3"><strong>Dimensiones construcción (m2):</strong></td></tr>';   
           
            echo '<tr><td><strong>Frente:</strong><div >'.$reg->CC_Dim_Fre.'</div></td>';
              echo '<td><strong>Fondo:</strong><div >'.$reg->CC_Dim_Fon.'</div></td>';
              echo '<td><strong>Área:</strong><div >'.$reg->CC_Dim_Are.'</div></td> </tr>';  
           

      }
     echo '</tbody></table>';
        break;
      case 'Municipio':
         $Id_Estado=$_POST['Id_Estado'];
         $id_municipio=$_POST['id_municipio'];
        // echo "Id_Estado=".$Id_Estado;break;
         $cad="";
        //echo $IdInm;
        $rspta=$contrih->municipio($Id_Estado);
          $cad= '<option value="-1" text="Despliegue para Seleccionar">Despliegue para Seleccionar</option>';
        while ($reg=$rspta->fetch_object()){
        	if ($id_municipio==$reg->Id_Mun){
        	 $cad.='<option value="'.$reg->Id_Mun.'" text="'.$reg->Descripcion.'"  selected>'.$reg->Descripcion.'</option>';
        	  }
        	  else{
        	  	$cad.='<option value="'.$reg->Id_Mun.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
        	  }
        }
        echo $cad;
       break;
       case 'Ciudad':
         $Id_Estado=$_POST['Id_Estado'];
         $id_ciudad=$_POST['id_ciudad'];
         $cad="";
        //echo $IdInm;
        $rspta=$contrih->ciudad($Id_Estado);
          $cad= '<option value="-1" text="Despliegue para Seleccionar">Despliegue para Seleccionar</option>';
        while ($reg=$rspta->fetch_object()){
        	  if ($id_ciudad==$reg->Id_Ciudad){
              $cad.='<option value="'.$reg->Id_Ciudad.'" text="'.$reg->Descripcion.'" selected>'.$reg->Descripcion.'</option>';
        	  }else{
        	  	$cad.='<option value="'.$reg->Id_Ciudad.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
        	  }
        	
        }
        echo $cad;
       break;
       case 'Parroquia':
         $Id_municipio=$_POST['Idmunicipio'];
         $id_parroquia=$_POST['id_parroquia'];
         $cad="";
        //echo $IdInm;
        $rspta=$contrih->parroquia($Id_municipio);
          $cad= '<option value="-1" text="Despliegue para Seleccionar">Despliegue para Seleccionar</option>';
        while ($reg=$rspta->fetch_object()){
        	if ($id_parroquia==$reg->Id_Parroquia){
        	$cad.='<option value="'.$reg->Id_Parroquia.'" text="'.$reg->Descripcion.'"  selected>'.$reg->Descripcion.'</option>';
        	}else{
        	  	$cad.='<option value="'.$reg->Id_Parroquia.'" text="'.$reg->Descripcion.'">'.$reg->Descripcion.'</option>';
        	  }
        }
        echo $cad;
       break;
    }
    break;
    case 'listarinmueblec':

        $rspta=$contrih->listarcontri($rfc);
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=[
             //   "0"=>'<button class="fa fa-user" onclick="mostrar('.$reg->Id_Inm.')"><i class="fa fa-pencil"></i></button> <button class="btn btn-primary" onclick="activar('.$reg->Id_Inm.')"><i class="fa fa-edit"></i></button>',
              //  "1"=>$reg->RIF_CI,
                "0"=>$reg->Ficha_Catastral,
                "1"=>$reg->Tipo_Documento,
                "2"=>$reg->Ano_Avaluo,
                "3"=>$reg->CT_Uso,
                "4"=>$reg->CT_Tene,
                "5"=>$reg->Ultimo_Anio_Pago,
                "6"=>$reg->Ano_Avaluo
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