<?php
include_once("db_conexion.php");


if(isset($_GET["EmpleadoID"])) {
    $EmpleadoID = intval($_GET["EmpleadoID"]);

    $sql = "SELECT * FROM documento WHERE EmpleadoID = $EmpleadoID";
    $result = $mysqli->query($sql);

    if($result) {
        $documentos = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($documentos);
    } else {
        echo json_encode(array("error" => "Error al obtener los documentos: " . $mysqli->error));
    }
} else {
    echo json_encode(array("error" => "No se proporcionó el parámetro EmpleadoID."));
}
?>

