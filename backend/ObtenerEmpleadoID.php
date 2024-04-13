<?php

include_once("db_conexion.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM empleado WHERE EmpleadoID = ?";
    
    $stmt = mysqli_prepare($mysqli, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id); 

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        echo json_encode($fila);
    } else {
        echo json_encode(['mensaje' => 'Empleado no encontrado']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
} else {
    echo json_encode(['mensaje' => 'ID de empleado no proporcionado']);
}
?>
