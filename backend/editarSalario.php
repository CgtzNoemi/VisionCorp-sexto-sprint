<?php

include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);

    $id = mysqli_real_escape_string($mysqli, trim($_GET['id']));
    $EmpleadoID = mysqli_real_escape_string($mysqli, trim($request->EmpleadoID));
    $salarioBase = mysqli_real_escape_string($mysqli, trim($request->salarioBase));
    $bonificaciones = mysqli_real_escape_string($mysqli, trim($request->bonificaciones));
    $comisiones = mysqli_real_escape_string($mysqli, trim($request->comisiones));
    $estadoPago = mysqli_real_escape_string($mysqli, trim($request->estadoPago));
    $fechaIngreso = mysqli_real_escape_string($mysqli, trim($request->fechaIngreso));


    $sqlUpdate = "UPDATE salarios SET salarioBase = ?, bonificaciones = ?, comisiones = ?, estadoPago = ?, fechaIngreso = ? WHERE id = ?";
    $stmtUpdate = mysqli_prepare($mysqli, $sqlUpdate);
    mysqli_stmt_bind_param($stmtUpdate, "ddsssi", $salarioBase, $bonificaciones, $comisiones, $estadoPago, $fechaIngreso, $id);
    $resultadoUpdate = mysqli_stmt_execute($stmtUpdate);

    if ($resultadoUpdate) {
        $sqlHistorial = "INSERT INTO historialSalario (salarioBase, bonificaciones, comisiones, fechaIngreso, estadoPago, EmpleadoID) 
                        SELECT salarioBase, bonificaciones, comisiones, fechaIngreso, estadoPago, ? FROM salarios WHERE id = ?";
        $stmtHistorial = mysqli_prepare($mysqli, $sqlHistorial);
        mysqli_stmt_bind_param($stmtHistorial, "ii", $EmpleadoID, $id);
        $resultadoHistorial = mysqli_stmt_execute($stmtHistorial);

    if ($resultadoHistorial) {
            echo json_encode(['mensaje' => 'Registro actualizado y historial guardado con éxito']);
        } else {
            echo json_encode(['mensaje' => 'Error al guardar el historial']);
        }
    } else {
        echo json_encode(['mensaje' => 'Error al actualizar el registro']);
    }

    mysqli_stmt_close($stmtUpdate);
    mysqli_stmt_close($stmtHistorial);
    mysqli_close($mysqli);

}
?>


