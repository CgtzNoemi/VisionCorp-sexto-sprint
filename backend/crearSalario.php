<?php

include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);

    $EmpleadoID = mysqli_real_escape_string($mysqli, trim($_GET['id']));
    $salarioBase = mysqli_real_escape_string($mysqli, trim($request->salarioBase));
    $bonificaciones = mysqli_real_escape_string($mysqli, trim($request->bonificaciones));
    $comisiones = mysqli_real_escape_string($mysqli, trim($request->comisiones));
    $fechaIngreso = mysqli_real_escape_string($mysqli, trim($request->fechaIngreso));
    $estadoPago = mysqli_real_escape_string($mysqli, trim($request->estadoPago));

    $sqlSalarios = "INSERT INTO salarios (EmpleadoID, salarioBase, bonificaciones, comisiones, fechaIngreso, estadoPago) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmtSalarios = mysqli_prepare($mysqli, $sqlSalarios);
    mysqli_stmt_bind_param($stmtSalarios, "idddss", $EmpleadoID, $salarioBase, $bonificaciones, $comisiones, $fechaIngreso, $estadoPago);
    $resultadoSalarios = mysqli_stmt_execute($stmtSalarios);

    
    $sqlHistorial = "INSERT INTO historialSalario (EmpleadoID, salarioBase, bonificaciones, comisiones, fechaIngreso, estadoPago) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmtHistorial = mysqli_prepare($mysqli, $sqlHistorial);
    mysqli_stmt_bind_param($stmtHistorial, "idddss", $EmpleadoID, $salarioBase, $bonificaciones, $comisiones, $fechaIngreso, $estadoPago);
    $resultadoHistorial = mysqli_stmt_execute($stmtHistorial);

    if ($resultadoSalarios && $resultadoHistorial) {
        echo json_encode(['mensaje' => 'Registro creado con éxito']);
    } else {
        echo json_encode(['mensaje' => 'Error al crear el registro']);
    }

    mysqli_stmt_close($stmtSalarios);
    mysqli_stmt_close($stmtHistorial);
    mysqli_close($mysqli);
}

?>

