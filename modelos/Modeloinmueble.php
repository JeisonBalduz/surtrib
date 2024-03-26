<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contriinmueble
{
	//Implementamos nuestro constructor
	public function __construct()
	{
		
	}
	//Implementamos un método para insertar registros
	public function insertar($Ficha_Catastral,$Tipo_Documento,$N_Documento,$Folio,$Tomo,$Protocolo,$D_Fecha,$Area_M,$Precio,$Ano_Avaluo,$Direccion_E1,$Direccion_D1,$Direccion_E2,$Direccion_D2,$Direccion_Ext_D2,$Direccion_E3,$Direccion_D3,$Direccion_E4,$Direccion_D4,$Id_Estado,$Id_Municipio,$Id_Parroquia,$Referencia,$Comunidad,$CT_Top,$CT_Form,$CT_Tene,$CT_Uso,$CT_Estatus,$CT_Dim_Fre,$CT_Dim_Fon,$CT_Dim_Are,$CT_Clas,$CT_Alic)
	{
          /* FALTA ESTE */

	 $sql="INSERT INTO inmuebles(rfc, Id_Inm, RIF_CI, Ficha_Catastral, Tipo_Documento, N_Documento, Folio, Tomo, Protocolo, D_Fecha, Area_M, Precio, Ano_Avaluo, Direccion_E1, Direccion_D1, Direccion_E2, Direccion_D2, Direccion_Ext_D2, Direccion_E3, Direccion_D3, Direccion_E4, Direccion_D4, Id_Estado, Id_Municipio, Id_Parroquia, Referencia, Comunidad, CT_Top, CT_Form, CT_Tene, CT_Uso, CT_Estatus, CT_Dim_Fre, CT_Dim_Fon, CT_Dim_Are, Observa, FechaVerificacion, Anio_Cons, CT_Clas, CT_Alic, FechaUlt_Declar, LatLang) VALUES(rfc,$Id_Inm , $RIF_CI, $Ficha_Catastral, $Tipo_Documento, $N_Documento, $Folio, $Tomo, $Protocolo, $D_Fecha, $Area_M, $Precio, $Ano_Avaluo, $Direccion_E1, $Direccion_D1, $Direccion_E2, $Direccion_D2, $Direccion_Ext_D2, $Direccion_E3, $Direccion_D3, $Direccion_E4, $Direccion_D4, $Id_Estado, $Id_Municipio, $Id_Parroquia, $Referencia, $Comunidad, $CT_Top, $CT_Form, $CT_Tene, $CT_Uso, $CT_Estatus, $CT_Dim_Fre, $CT_Dim_Fon, $CT_Dim_Are, $Observa, $FechaVerificacion, $Anio_Cons, $CT_Clas, $CT_Alic, $FechaUlt_Declar, $LatLang)";

		die($sql);
		return ejecutarConsulta($sql);
	}
   
	//Implementamos un método para editar registros
	public function editar($Id_Inm,$Ficha_Catastral,$Tipo_Documento,$N_Documento,$Folio,$Tomo,$Protocolo,$D_Fecha,$Area_M,$Precio,$Ano_Avaluo,$Direccion_E1,$Direccion_D1,$Direccion_E2,$Direccion_D2,$Direccion_Ext_D2,$Direccion_E3,$Direccion_D3,$Direccion_E4,$Direccion_D4,$Id_Estado,$Id_Municipio,$Id_Parroquia,$Referencia,$Comunidad,$CT_Top,$CT_Form,$CT_Tene,$CT_Uso,$CT_Estatus,$CT_Dim_Fre,$CT_Dim_Fon,$CT_Dim_Are,$CT_Clas,$CT_Alic)
	{ 
	       $sql="UPDATE inmuebles SET Ficha_Catastral='$Ficha_Catastral',Tipo_Documento=$Tipo_Documento,N_Documento=$N_Documento,Folio='$Folio',Tomo='$Tomo',Protocolo='$Protocolo',D_Fecha='$D_Fecha',Area_M='$Area_M',Precio='$Precio',Ano_Avaluo=$Ano_Avaluo,Direccion_E1=$Direccion_E1,Direccion_D1='$Direccion_D1',Direccion_E2=$Direccion_E2,Direccion_D2='$Direccion_D2',Direccion_Ext_D2='$Direccion_Ext_D2',Direccion_E3=$Direccion_E3,Direccion_D3='$Direccion_D3',Direccion_E4=$Direccion_E4,Direccion_D4='$Direccion_D4',Id_Estado=$Id_Estado,Id_Municipio=$Id_Municipio,Id_Parroquia=$Id_Parroquia,Referencia='$Referencia',Comunidad='$Comunidad',CT_Top=$CT_Top,CT_Form=$CT_Form,CT_Tene=$CT_Tene,CT_Uso=$CT_Uso,CT_Estatus=$CT_Estatus,CT_Dim_Fre=$CT_Dim_Fre,CT_Dim_Fon=$CT_Dim_Fon,CT_Dim_Are=$CT_Dim_Are,CT_Clas=$CT_Clas,CT_Alic=$CT_Alic WHERE Id_Inm=$Id_Inm";
         // die($sql);
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para desactivar Clientes
	public function desactivar($Id_Inm)
	{
		$sql="UPDATE inmuebles SET CT_Estatus ='D' WHERE Id_Inm='$Id_Inm'";
		return ejecutarConsulta($sql);
	}
    //Implementamos un método para Activar Clientes
	public function activar($Id_Inm)
	{
		$sql="UPDATE inmuebles SET CT_Estatus ='A' WHERE Id_Inm='$Id_Inm'";
		return ejecutarConsulta($sql);
	}
	public function municipio($Id_estado)
	{
		$sql="SELECT * FROM inmmunicipio  WHERE  Id_Estado=$Id_estado";
		//die($sql);
		return ejecutarConsulta($sql);
	}
    public function setconstruccion($Id_Inm_Cons,$CC_Dim_Are,$CC_Dim_Fon,$CC_Dim_Fre,$CC_Est_Con,$CC_NP,$CC_Elec,$CC_Puer,$CC_Piso,$CC_Estr,$CC_Tech_Cubi,$CC_Tech_Estr,$CC_Par_Acab,$CC_Par_Tipo,$CC_Tipo,$CC_Ocup,$CC_NH,$CC_Uso,$CC_Clas,$CC_Alic)
	{   //$cadena = explode(",",$_REQUEST['institutos']);
	    
       $sql="UPDATE inmcontruccion SET CC_Dim_Are=$CC_Dim_Are,CC_Dim_Fon='$CC_Dim_Fon',CC_Dim_Fre='$CC_Dim_Fre',CC_Est_Con=$CC_Est_Con,CC_NP=$CC_NP,CC_Elec=$CC_Elec,CC_Puer='$CC_Puer',CC_Piso=$CC_Piso,CC_Estr='$CC_Estr',CC_Tech_Cubi=$CC_Tech_Cubi,CC_Tech_Estr=$CC_Tech_Estr,CC_Par_Acab=$CC_Par_Acab,CC_Par_Tipo=$CC_Par_Tipo,CC_Tipo=$CC_Tipo,CC_Ocup=$CC_Ocup,CC_NH=$CC_NH,CC_Uso=$CC_Uso,CC_Clas=$CC_Clas,CC_Alic=$CC_Alic WHERE Id_Inm_Cons=$Id_Inm_Cons";

        



      // die($sql);
    return ejecutarConsulta($sql);
	}

	public function parroquia($Id_municipio)
	{
		$sql="SELECT * FROM inmparroquia  WHERE  Id_Mun=$Id_municipio";
		return ejecutarConsulta($sql);
	}
	public function ciudad($Id_estado)
	{
		$sql="SELECT * FROM inmciudad  WHERE  Id_Estado=$Id_estado";
		return ejecutarConsulta($sql);
	}
	public function getconstrucion($Id_Cost)
	{
		$sql="SELECT * FROM inmcontruccion  WHERE  Id_Inm_Cons=$Id_Cost limit 1";
		//die($sql);
		return ejecutarConsulta($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($Id_Inm)
	{
		$sql="SELECT rfc ,Id_Inm, RIF_CI, Ficha_Catastral,Id_Con,Tipo_Documento,Url_Documento,Ultimo_Anio_Pago,N_Documento,Folio,Tomo,Protocolo,(case when (D_Fecha is null) then '' when (D_Fecha <>'') then DATE_FORMAT(D_Fecha,'%d/%m/%Y')  end) AS D_Fecha,Area_M,Precio,Estatus,Activo,Ano_Avaluo,Direccion_E1,Direccion_D1,Direccion_E2,Direccion_D2,Direccion_Ext_D2,Direccion_E3,Direccion_D3,Direccion_E4,Direccion_D4,Id_Estado,Id_Municipio,Id_Parroquia, Referencia,Comunidad,CT_Top,CT_Form,CT_Tene,CT_Uso,CT_Estatus,CT_Dim_Fre,CT_Dim_Fon,CT_Dim_Are,FechaVerificacion,Anio_Cons,CT_Clas,CT_Alic,FechaUlt_Declar,LatLang,Observa FROM inmuebles WHERE Id_Inm='$Id_Inm' limit 1;";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{   
       /*
       SELECT Id_Inm,Ficha_Catastral,Ultimo_Anio_Pago,Area_M,(case when (CT_Tene is null) then 'VACIO'  when (CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=CT_Tene) end) AS CT_Tene,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CT_Uso) end) AS CT_Uso  FROM inmuebles WHERE rfc is not null;
       $sql="SELECT Id_Inm,RIF_CI,Ficha_Catastral,Ultimo_Anio_Pago,Area_M,Ano_Avaluo,(case when (CT_Tene is null) then 'VACIO'  when (CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=CT_Tene) end) AS CT_Tene,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CT_Uso) end) AS CT_Uso,(case when (CT_Estatus<> 195) then 'VACIO'  when (CT_Estatus=195) then '<button type=\'button\' class=\'btn btn-success\' id=\'btnMyTest001\' data-toggle=\'modal\' data-target=\'#myModal\' data-age=\'51\'>Construccion</button> ' end) AS CT_Estatus  FROM inmuebles WHERE rfc is not null or rfc is null";

	*/

		$sql="SELECT Id_Inm,RIF_CI,Ficha_Catastral,Ultimo_Anio_Pago,Area_M,Ano_Avaluo,(case when (CT_Tene is null) then 'VACIO'  when (CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=CT_Tene) end) AS CT_Tene,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CT_Uso) end) AS CT_Uso,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,N_Documento,Folio,Tomo,Protocolo,(case when (D_Fecha is null) then 'VACIO'  when (D_Fecha is NOT null) then date_format(D_Fecha, '%d-%m-%Y') end) AS D_Fecha,Area_M,Precio,Ano_Avaluo,(case when (CT_Estatus is null) then 'VACIO'  when (CT_Estatus is NOT null) then (SELECT Etiqueta FROM inmestatus where Id_Val=CT_Estatus) end) AS CT_Estatus,(case when (CT_Clas is null) then 'VACIO' when (CT_Clas =-1) then 'VACIO' when (CT_Clas is NOT null) then (SELECT Descripcion FROM inmclasificacion where Id_Inm_Val_Tie2=CT_Clas) end) AS CT_Clas,CT_Dim_Fre,CT_Dim_Fon,CT_Dim_Are,Precio,(case when (CT_Alic is null) then 'VACIO' when (CT_Alic =-1) then 'VACIO' when (CT_Alic is NOT null) then (SELECT Descripcion FROM inmalicuota where Id_Alicuota=CT_Alic) end) AS CT_Alic,(case when (CT_Estatus<> 195) then 'VACIO'  when (CT_Estatus=195) then CONCAT('<button type=\'button\' class=\'btn btn-success\' id=\'btnMyTest001\' data-toggle=\'modal\' data-target=\'#myModal\' data-Id_Inm=\'',Id_Inm,'\'>Construccion</button> ') end) AS constru  FROM inmuebles WHERE rfc is not null or rfc is null";

		return ejecutarConsulta($sql);		
	}    
      
    public function listarcontri($rfc)
	{   
       

		$sql="SELECT Id_Inm,RIF_CI,Ficha_Catastral,Ultimo_Anio_Pago,Area_M,Ano_Avaluo,(case when (CT_Tene is null) then 'VACIO'  when (CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=CT_Tene) end) AS CT_Tene,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CT_Uso) end) AS CT_Uso,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=Tipo_Documento) end) AS Tipo_Documento,N_Documento,Folio,Tomo,Protocolo,(case when (D_Fecha is null) then 'VACIO'  when (D_Fecha is NOT null) then date_format(D_Fecha, '%d-%m-%Y') end) AS D_Fecha,Area_M,Precio,Ano_Avaluo,(case when (CT_Estatus is null) then 'VACIO'  when (CT_Estatus is NOT null) then (SELECT Etiqueta FROM inmestatus where Id_Val=CT_Estatus) end) AS CT_Estatus,(case when (CT_Clas is null) then 'VACIO' when (CT_Clas =-1) then 'VACIO' when (CT_Clas is NOT null) then (SELECT Descripcion FROM inmclasificacion where Id_Inm_Val_Tie2=CT_Clas) end) AS CT_Clas,CT_Dim_Fre,CT_Dim_Fon,CT_Dim_Are,Precio,(case when (CT_Alic is null) then 'VACIO' when (CT_Alic =-1) then 'VACIO' when (CT_Alic is NOT null) then (SELECT Descripcion FROM inmalicuota where Id_Alicuota=CT_Alic) end) AS CT_Alic,(case when (CT_Estatus<> 195) then 'VACIO'  when (CT_Estatus=195) then CONCAT('<button type=\'button\' class=\'btn btn-success\' id=\'btnMyTest001\' data-toggle=\'modal\' data-target=\'#myModal\' data-Id_Inm=\'',Id_Inm,'\'>Construccion</button> ') end) AS constru  FROM inmuebles WHERE rfc='$rfc'";
		//  die($sql);

		return ejecutarConsulta($sql);		
	} 

	public function listar2($comodinbusqueda)
	{
		
          $sql="SELECT I.Id_Inm,I.RIF_CI,I.Ficha_Catastral,I.Ultimo_Anio_Pago,I.Area_M,I.Ano_Avaluo,(case when (I.CT_Tene is null) then 'VACIO'  when (I.CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=I.CT_Tene) end) AS CT_Tene,(case when (Tipo_Documento is null) then 'VACIO'  when (Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmtipodocumento where Id_Val=I.Tipo_Documento) end) AS Tipo_Documento,(case when (I.Tipo_Documento is null) then 'VACIO'  when (I.Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=I.CT_Uso) end) AS CT_Uso,I.N_Documento,I.Folio,I.Tomo,I.Protocolo,(case when (I.D_Fecha is null) then 'VACIO'  when (I.D_Fecha is NOT null) then date_format(I.D_Fecha, '%d-%m-%Y') end) AS D_Fecha,I.Area_M,I.Precio,I.Ano_Avaluo,(case when (I.CT_Tene is null) then 'VACIO'  when (I.CT_Tene is NOT null) then (SELECT Etiqueta FROM inmcaractenencia where Id_Val=I.CT_Tene) end) AS CT_Tene,(case when (I.Tipo_Documento is null) then 'VACIO'  when (I.Tipo_Documento is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=I.CT_Uso) end) AS CT_Uso,(case when (I.CT_Estatus is null) then 'VACIO'  when (I.CT_Estatus is NOT null) then (SELECT Etiqueta FROM inmestatus where Id_Val=I.CT_Estatus) end) AS CT_Estatus,(case when (I.CT_Clas is null) then 'VACIO' when (I.CT_Clas =-1) then 'VACIO' when (I.CT_Clas is NOT null) then (SELECT Descripcion FROM inmclasificacion where Id_Inm_Val_Tie2=I.CT_Clas) end) AS CT_Clas,I.CT_Dim_Fre,I.CT_Dim_Fon,I.CT_Dim_Are,I.Precio,(case when (I.CT_Alic is null) then 'VACIO' when (I.CT_Alic =-1) then 'VACIO' when (I.CT_Alic is NOT null) then (SELECT Descripcion FROM inmalicuota where Id_Alicuota=I.CT_Alic) end) AS CT_Alic,(case when (CT_Estatus<> 195) then 'VACIO'  when (CT_Estatus=195) then '<button type=\'button\' class=\'btn btn-success\' id=\'btnMyTest001\' data-toggle=\'modal\' data-target=\'#myModal\' data-Id_Inm=\'',Id_Inm,'\'>Construccion</button> ' end) AS constru  FROM  inmuebles AS I left join contrihacienda AS C ON C.rfc=I.rfc WHERE C.rfc LIKE '%".$comodinbusqueda."%' or I.RIF_CI LIKE CONCAT('%".$comodinbusqueda."%') or I.Ficha_Catastral LIKE '%".$comodinbusqueda."%';";

		return ejecutarConsulta($sql);		
	}
	public function construccionInm($Id_Inm)
	{  // (case when (CC_Estr is null) then 'VACIO'  when (CC_Estr is NOT null) then (SELECT Etiqueta FROM inmconstrucupasion where Id_Val LIKE '%CC_Estr%') end) AS CC_Estr
		
          $sql="SELECT (case when (CC_Uso is null) then 'VACIO'  when (CC_Uso is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CC_Uso) end) AS CC_Uso,(case when (CC_Tipo is null) then 'VACIO'  when (CC_Tipo is NOT null) then (SELECT Descripcion FROM inmconstrutipo where Id_Inm_Tip=CC_Tipo) end) AS CC_Tipo,(case when (CC_Ocup is null) then 'VACIO'  when (CC_Ocup is NOT null) then (SELECT Etiqueta FROM inmconstrucupasion where Id_Val=CC_Ocup) end) AS CC_Ocup,(case when (CC_Piso is null) then 'VACIO'  when (CC_Piso is NOT null) then (SELECT Etiqueta FROM inmpiso where Id_Val=CC_Piso) end) AS CC_Piso,(case when (CC_Par_Tipo is null) then 'VACIO'  when (CC_Par_Tipo is NOT null) then (SELECT Etiqueta FROM inmparedestipo where Id_Val=CC_Par_Tipo) end) AS CC_Par_Tipo,(case when (CC_Par_Acab is null) then 'VACIO'  when (CC_Par_Acab is NOT null) then (SELECT Etiqueta FROM inmacabado where Id_Val=CC_Par_Acab) end) AS CC_Par_Acab,(case when (CC_Tech_Estr is null) then 'VACIO'  when (CC_Tech_Estr is NOT null) then (SELECT Etiqueta FROM inmconstrutecho where Id_Val=CC_Tech_Estr) end) AS CC_Tech_Estr,(case when (CC_Tech_Cubi is null) then 'VACIO'  when (CC_Tech_Cubi is NOT null) then (SELECT Etiqueta FROM inmcubiertas where Id_Val=CC_Tech_Cubi) end) AS CC_Tech_Cubi,(case when (CC_Elec is null) then 'VACIO'  when (CC_Elec is NOT null) then (SELECT Etiqueta FROM inmelectricas where Id_Val=CC_Elec) end) AS CC_Elec,(case when (CC_Est_Con is null) then 'VACIO'  when (CC_Est_Con is NOT null) then (SELECT Etiqueta FROM inmconservacion where Id_Val=CC_Est_Con) end) AS CC_Est_Con,CC_NH,CC_NP,(case when (CC_Clas is null) then 'VACIO' when (CC_Clas =-1) then 'VACIO' when (CC_Clas is NOT null) then (SELECT CONCAT(Descripcion,Tipo) as Descripcion FROM inmConstclasificacion where Id_Inm_Val_Cons2=CC_Clas) end) AS CC_Clas,CC_Dim_Fre,CC_Dim_Fon,CC_Dim_Are FROM inmcontruccion WHERE Id_Inm=".$Id_Inm.";";

		return ejecutarConsulta($sql);	
	}
	public function construccionListarInm($Id_Inm)
	{  // (case when (CC_Estr is null) then 'VACIO'  when (CC_Estr is NOT null) then (SELECT Etiqueta FROM inmconstrucupasion where Id_Val LIKE '%CC_Estr%') end) AS CC_Estr
		
          $sql="SELECT `Id_Inm_Cons`, `Id_Inm`, `CC_Dim_Are`, `CC_Dim_Fon`, `CC_Dim_Fre`, `CC_Est_Con`, `CC_NP`, `CC_Elec`, `CC_Puer`, `CC_Piso`, `CC_Estr`, `CC_Tech_Cubi`, `CC_Tech_Estr`, `CC_Par_Acab`, `CC_Par_Tipo`, `CC_Tipo`, `CC_Ocup`, `CC_NH`, `CC_Uso`, `Anio_Cons`, `CC_Clas`, `CC_Alic`,(case when (CC_Uso is null) then 'VACIO'  when (CC_Uso is NOT null) then (SELECT Etiqueta FROM inmcaracuso where Id_Val=CC_Uso) end) AS CC_Usoo,(case when (CC_Tipo is null) then 'VACIO'  when (CC_Tipo is NOT null) then (SELECT Descripcion FROM inmconstrutipo where Id_Inm_Tip=CC_Tipo) end) AS CC_Tipoo,(case when (CC_Ocup is null) then 'VACIO'  when (CC_Ocup is NOT null) then (SELECT Etiqueta FROM inmconstrucupasion where Id_Val=CC_Ocup) end) AS CC_Ocupp,(case when (CC_Clas is null) then 'VACIO' when (CC_Clas =-1) then 'VACIO' when (CC_Clas is NOT null) then (SELECT CONCAT(Descripcion,Tipo) as Descripcion FROM inmConstclasificacion where Id_Inm_Val_Cons2=CC_Clas) end) AS CC_Class,(case when (CC_Alic is null) then 'VACIO' when (CC_Alic =-1) then 'VACIO' when (CC_Alic is NOT null) then (SELECT Descripcion FROM inmalicuota where Id_Alicuota=CC_Alic) end) AS CC_Alicc FROM inmcontruccion WHERE Id_Inm=".$Id_Inm.";";
         //die($sql);
		return ejecutarConsulta($sql);	
	}
	public function select()
	{
		$sql="SELECT * FROM inmuebles";
		return ejecutarConsulta($sql);		
	}
	public function calcular_impuesto_Inmobiliario($id_inm)
	{
		/*$sql="SELECT * FROM inmuebles";
    $Anio=0;
	$Terreno=0.0;
	$Construccion=0.0;
	$Avaluo=0.0;
	$Impuesto=0.0;
	$Descuento=0.0;
	$Multa=0.0;
	$Intereses=0.0;
	$Total=0.0;

*/



		return ejecutarConsulta($sql);		
	}

}     
?>
