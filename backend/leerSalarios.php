<?php

include_once("db_conexion.php");

$consulta = "SELECT * FROM salarios";
$resultado = mysqli_query($mysqli, $consulta);

$salarios = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    $salarios[] = $fila;
}

echo json_encode($salarios);

mysqli_close($mysqli);
?>