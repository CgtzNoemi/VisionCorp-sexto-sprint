<?php

include_once("db_conexion.php");

$consulta = "SELECT * FROM empleado";
$resultado = mysqli_query($mysqli, $consulta);

$empleados = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    $empleados[] = $fila;
}

echo json_encode($empleados);

mysqli_close($mysqli);
?>