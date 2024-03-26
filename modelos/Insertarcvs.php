<?php
/**
 * Created by PhpStorm.
 * User: HILARI
 * Date: 02/01/2020
 * Time: 10:40
 */

define('SERVIDOR','localhost');
define('USUARIO','surtribc_root');
define('PASSWORD','Ifaoriire.2102');
define('BD','surtribc_2024');

$servidor="mysql:dbname=".BD.";host=".SERVIDOR;
try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
    );
    //echo "<script>alert('Conexión con exito a la base de datos');</script>";
}catch (PDOException $e){
    echo "<script>alert('error al conectar con la base de datos');</script>";
}


$nuevaFecha = $_POST['nuevaFecha'];
$detalle = $_POST['detalle'];
$referencia = $_POST['referencia'];
$monto = $_POST['monto'];
$chksum = hash("md5","$referencia+$monto");

$isused = "0";
$momento = date("Y-m-d H:i:s");

//echo '<td>'.$cont.'</td>';

$sentencia = $pdo->prepare("INSERT INTO cpdv_bank
      ( refencia, fechad, amount, details, chksum, isused, moment,saldo) 
VALUES(:referencia,:fechad,:amount,:details,:chksum, :isused,:moment,:saldo)");

$sentencia->bindParam(':referencia',$referencia);
$sentencia->bindParam(':fechad',$nuevaFecha);
$sentencia->bindParam(':amount',$monto);

$sentencia->bindParam(':details',$detalle);
$sentencia->bindParam(':saldo',$monto);
$sentencia->bindParam(':moment',$momento);
$sentencia->bindParam(':chksum',$chksum);

$sentencia->bindParam(':isused',$isused);
$sentencia->execute();