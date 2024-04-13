<?php

include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");

if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);

    $EmpleadoID = mysqli_real_escape_string($mysqli, trim($request->EmpleadoID)); 

    
    $sql_delete_documentos = "DELETE FROM documento WHERE EmpleadoID = ?";
    $stmt_delete_documentos = mysqli_prepare($mysqli, $sql_delete_documentos);
    mysqli_stmt_bind_param($stmt_delete_documentos, "i", $EmpleadoID);
    $resultado_delete_documentos = mysqli_stmt_execute($stmt_delete_documentos);
    mysqli_stmt_close($stmt_delete_documentos);

    $sql_delete_salarios = "DELETE FROM salarios WHERE EmpleadoID = ?";
    $stmt_delete_salarios = mysqli_prepare($mysqli, $sql_delete_salarios);
    mysqli_stmt_bind_param($stmt_delete_salarios, "i", $EmpleadoID);
    $resultado_delete_salarios = mysqli_stmt_execute($stmt_delete_salarios);
    mysqli_stmt_close($stmt_delete_salarios);

    $sql_delete_historial = "DELETE FROM historialSalario WHERE EmpleadoID = ?";
    $stmt_delete_historial = mysqli_prepare($mysqli, $sql_delete_historial);
    mysqli_stmt_bind_param($stmt_delete_historial, "i", $EmpleadoID);
    $resultado_delete_historial = mysqli_stmt_execute($stmt_delete_historial);
    mysqli_stmt_close($stmt_delete_historial);

    
    $sql = "DELETE FROM empleado WHERE EmpleadoID = ?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "i", $EmpleadoID); 
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo json_encode(['mensaje' => 'Registro eliminado con éxito']);
    } else {
        echo json_encode(['mensaje' => 'Error al eliminar el registro']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
?>



