<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
//Incluir archivo de conexión a la base de datos
include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);
    $correoElectronico = mysqli_real_escape_string($mysqli, trim($request->correoElectronico));
    $contrasena = mysqli_real_escape_string($mysqli, trim($request->Password)); 

    $sql = "SELECT * FROM usuarioadministrador WHERE correoElectronico='$correoElectronico'";
    $resultado = mysqli_query($mysqli,$sql);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $hashAlmacenado = $fila['Password'];

            if (password_verify($contrasena, $hashAlmacenado)) {
                $data = array('message' => 'success', 'token' => crearToken($correoElectronico));
                echo json_encode($data);
            } else {
                $data = array('message' => 'failed', 'error' => 'La contraseña no es válida');
                echo json_encode($data);
            }
        } else {
            $data = array('message' => 'failed', 'error' => 'Usuario no encontrado');
            echo json_encode($data);
        }
    } else {
        $data = array('message' => 'failed', 'error' => 'Error en la consulta: ' . mysqli_error($mysqli));
        echo json_encode($data);
    }

}

function crearToken($correoElectronico){
    $now = strtotime("now");
    $key = 'Vision_Corp';
    $payload = [
    'exp' => $now + 3600,
    'data' => $correoElectronico
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}
?>

