<?php
//Encabezados HTTP
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: application/json; charset=UFT-8');

//Conexión a la base de datos
$host = 'localhost';
$username = 'root';
$password = 'root'; 
$db_name = 'visioncorp';
$mysqli = new mysqli($host, $username, $password, $db_name);

if($mysqli->connect_error){
    die('Error: ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>