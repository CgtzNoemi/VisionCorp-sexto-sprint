<?php
include_once("db_conexion.php");
   
    $NombreDocumento = $_POST['NombreDocumento'];
    $RutaDocumento = $_POST['RutaDocumento'];
    $FechaCarga = $_POST['FechaCarga']; 
    $EmpleadoID = intval($_POST['EmpleadoID']); 

        
    $sql = "INSERT INTO documento (NombreDocumento, RutaDocumento, FechaCarga, EmpleadoID) VALUES ('$NombreDocumento', '$RutaDocumento', '$FechaCarga','$EmpleadoID')";
    if($mysqli->query($sql) === TRUE) {
        echo json_encode(array("message" => "El archivo PDF se ha subido correctamente y se ha guardado en la base de datos."));
    } else {
        echo json_encode(array("error" => "Error al guardar los datos en la base de datos: " . $mysqli->error));
    }

?>

