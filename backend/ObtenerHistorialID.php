<?php

include_once("db_conexion.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM historialSalario WHERE EmpleadoID = ?";
    
    
    $stmt = $mysqli->prepare($sql);

    
    $stmt->bind_param("i", $id);

   
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $historial = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode($historial);
    } else {
        echo json_encode('Historial no encontrado');
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['mensaje' => 'ID de empleado no proporcionado']);
}

?>