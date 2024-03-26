<?php

include('conexion.php');

$fileContacts = $_FILES['dataCliente']; 
$fileContacts = file_get_contents($fileContacts['tmp_name']); 
$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts); 

// preparar contactos (convertirlos en array)
foreach ($fileContacts as $contact) 
{
	$contactList[] = explode(",", $contact);
}

// insertar contactos
foreach ($contactList as $contactData) 
{
	$conexion->query("INSERT INTO clientes (nombre,correo,celular,fecha) VALUES ('{$contactData[0]}','{$contactData[1]}', '{$contactData[2]}','{$contactData[3]}')"); 
}


?>