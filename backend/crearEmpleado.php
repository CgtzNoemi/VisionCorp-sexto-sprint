<?php

include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);

    $nombre = mysqli_real_escape_string($mysqli, trim($request->Nombre));
    $apellido = mysqli_real_escape_string($mysqli, trim($request->Apellido));
    $edad = mysqli_real_escape_string($mysqli, trim($request->Edad));
    $correoElectronico = mysqli_real_escape_string($mysqli, trim($request->CorreoElectronico));
    $telefono = mysqli_real_escape_string($mysqli, trim($request->Telefono));
    $puesto = mysqli_real_escape_string($mysqli, trim($request->Puesto));
    $departamento = mysqli_real_escape_string($mysqli, trim($request->Departamento));
    $fechaIngreso = mysqli_real_escape_string($mysqli, trim($request->FechaIngreso));

 
    $sql = "INSERT INTO empleado (Nombre, Apellido, Edad, CorreoElectronico, Telefono, Puesto, Departamento, FechaIngreso) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($mysqli, $sql);

  
    mysqli_stmt_bind_param($stmt, "ssisssss", $nombre, $apellido, $edad, $correoElectronico, $telefono, $puesto, $departamento, $fechaIngreso);

   
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo json_encode(['mensaje' => 'Registro creado con éxito']);
    } else {
        echo json_encode(['mensaje' => 'Error al crear el registro']);
    }

 
    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
?>
