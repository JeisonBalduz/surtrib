<?php //session_start();
    

    function getIP() {
   if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         return $_SERVER['REMOTE_ADDR'];
      }
   } else {
      if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
         return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
      } else {
         return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
      }
   }
  }

  function getDesumen() {
     $detalle="";
     if($_REQUEST){
      $detalle="Pagina=".basename($_SERVER['PHP_SELF']);
      $detalle.= " Datos Formulario (";
       //$pagina=basename($_SERVER['PHP_SELF']);
      foreach($_REQUEST as $nombre_campo => $valor){ 
              if (is_array($valor)){
                $detalle.= "" . $nombre_campo . "=" .implode($valor). ";";
              }
              else{   
                $detalle.= "" . $nombre_campo . "=" .$valor . ";"; 
              }
              
      //  echo  $asignacion;
            //@ eval($asignacion); 
          }
          $detalle.= ")";

        
       // echo $acceso;
     //echo "".$asignacion; exit;

    }

    return $detalle;
  }

	function agregarBitacora($detalle='Acceso al Sistema',$resumen='',$vsoft='')
	{
		
        $ipaddr=getIP(); //OBTIENE LA IP
        if ($resumen!=''){ 
           $resumen=getDesumen();
           $resumen=substr($resumen, 0, 250);
        }
          
       if (isset($_SESSION['idBitacora']))   
       { 

             
            $idbitacora=$_SESSION['idBitacora'];

           // $sql="INSERT INTO bitacorahistorial(idbitacora,fechaacceso,actividad,detalle,ipaddr) VALUES ($idbitacora,CURRENT_TIMESTAMP,'$actividad','$detalle','$ipaddr')";
             
         $sql="INSERT INTO bitacora(user_id, resumen, detalle, ipaddr, vsoft, moment, status) VALUES ($idbitacora, '$resumen', '$detalle', '$ipaddr', '$vsoft', CURRENT_TIMESTAMP,'A')";

           // die($sql);
            $query = ejecutarConsulta($sql);
       }
/*
        if (isset($_SESSION['idBitacora']))	
	    { 


	         $idbitacora=$_SESSION['idBitacora'];

            $sql="INSERT INTO bitacorahistorial(idbitacora,fechaacceso,actividad,detalle,ipaddr) VALUES ($idbitacora,CURRENT_TIMESTAMP,'$actividad','$detalle','$ipaddr')";
             // die($sql);
            $query = ejecutarConsulta($sql);
	    }
	    else{
             $idusuario=$_SESSION['idusuario'];
           $sql="INSERT INTO bitacora(idusuario,fecha) VALUES($idusuario,CURRENT_TIMESTAMP)";
           $idbitacora=ejecutarConsulta_retornarID($sql);
           $_SESSION['idBitacora']=$idbitacora;

           $sql="INSERT INTO bitacorahistorial(idbitacora,fechaacceso,actividad,detalle,ipaddr) VALUES ($idbitacora,CURRENT_TIMESTAMP,'$actividad','$detalle','$ipaddr')";
           // die($sql);
            $query = ejecutarConsulta($sql);

	    }

*/

		
	}
   function listarBitacora()
   {
      
             $output= array();
      
      //$sql="SELECT I.id,U.nombre,U.login,I.actividad,DATE_FORMAT(I.fechaacceso,'%d/%m/%Y') AS fechaacceso FROM bitacora AS B INNER JOIN bitacorahistorial AS I ON B.id=I.idbitacora INNER JOIN usuarios AS U ON B.idusuario=U.idusuario ";
      
      $sql="SELECT B.id,U.nombre,U.login,B.detalle,DATE_FORMAT(B.moment,'%d/%m/%Y') AS moment,B.ipaddr FROM bitacora AS B INNER JOIN usuarios AS U ON B.user_id=U.idusuario ";
      
       $sql="SELECT B.id,U.name,U.usuario,B.detalle,DATE_FORMAT(B.moment,'%d/%m/%Y %h:%i:%s %p') AS moment,B.ipaddr FROM bitacora AS B INNER JOIN users AS U ON B.user_id=U.id ";

     
      $result= ejecutarConsulta($sql);            //  = mysqli_query($con,$sql);//pg_query($con,$sql);//
      $total_all_rows = $result->num_rows;//mysqli_num_rows($totalQuery);//pg_num_rows($totalQuery);//

            $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'usuario',
            3 => 'detalle',
            4 => 'moment',
            5=>'ipaddr',
            );
      //die("Tota=".$total_all_rows);
    
      if(isset($_POST['search']['value']))
      {
         $search_value = $_POST['search']['value'];
         $sql .= " WHERE U.name like '%".$search_value."%'";
         $sql .= " OR U.usuario like '%".$search_value."%'";
         $sql .= " OR B.detalle like '%".$search_value."%'";
         $sql .= " OR DATE_FORMAT(moment,'%d/%m/%Y') like '%".$search_value."%'";
         $sql .= " OR B.ipaddr like '%".$search_value."%'";
      }
      if(isset($_POST['order']))
         {
            $column_name = $_POST['order'][0]['column'];
            $order = $_POST['order'][0]['dir'];
            $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
         }
         else
         {
            $sql .= " ORDER BY B.id DESC";
         }

      if($_POST['length'] != -1)
      {
         $start = $_POST['start'];
         $length = $_POST['length'];
         $sql .= " LIMIT  ".$length." OFFSET ".$start;
      }
      //  die($sql); 
       $query = ejecutarConsulta($sql);            //mysqli_query($con,$sql);//pg_query($con,$sql);//
       $count_rows =$query->num_rows;
      //$query =ejecutarConsultaSimpleFila($sql);

      //$count_rows = $query->num_rows; //mysqli_num_rows($query);//pg_num_rows($totalQuery);//
      $data = array();//$result->num_rows;
      $cont=0;
      while($row = $query->fetch_object())      //mysqli_fetch_assoc($query)       pg_fetch_assoc($query) )//
      {
         $sub_array = array();
         $sub_array[0] = $row->id;
         $sub_array[1] = $row->name;
         $sub_array[2] = $row->usuario;
         $sub_array[3] = $row->detalle;
         $sub_array[4] = $row->moment;
         $sub_array[5] =$row->ipaddr;
         $sub_array[6] ='';
         // '<a href="#" data-id="'.$row->id.'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="#" data-id="'.$row->id.'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
         $data[$cont] = $sub_array;$cont++;
      }

      $output = array(
         'draw'=> intval($_POST['draw']),
         'recordsTotal' =>$count_rows ,
         'recordsFiltered'=>   $total_all_rows,
         'data'=>$data,
      );
      echo  json_encode($output);




}
 
 function RegistrarEventosBitacora() {
     //$detalle="";
    // agregarBitacora("Otras Consultas","formulario");  
     //$op=$_REQUEST["op"];
     if(isset($_REQUEST["op"]))
      switch ($_REQUEST["op"]){
       case 'listar':
       case 'listar2':
       break;
       case 'guardaryeditar':
            agregarBitacora("Formulario Guardar Editar","formulario",'');  
       break;
       case 'desactivar':
         agregarBitacora("Opccion Desactivar","formulario",'');  
       break;
       case 'activar':
       agregarBitacora("Opccion activar","formulario",'');  
       break;
       case 'verificar':
        agregarBitacora("Iniciar Sesion","formulario",'sesion');  
       break;
       case 'opcionesinmueble':
         switch ($_REQUEST["tipoopcion"]){
          case 'construccionguardar':
              agregarBitacora("Editar construccion","formulario",''); 
            break;
           case 'construccionlistar':
           case 'construccionedit':
           case 'construccion':
           case 'Municipio':
           case 'Ciudad':
           case 'Parroquia':
            break;

          }
        break;
       case 'salir':
        agregarBitacora("Cerrar Sesion","formulario",'');  
       break;
       default:
         agregarBitacora("Otras Consultas","formulario",'');  
        break;
   } 

  }  
 RegistrarEventosBitacora();
?>
