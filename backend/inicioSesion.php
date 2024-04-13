<?
//Incluir archivo de conexión a la base de datos
include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    
    $request = json_decode($AngularData);
    $correoElectronico = mysqli_real_escape_string($mysqli, trim($request->correoElectronico));
    $contrasena = mysqli_real_escape_string($mysqli, trim($request->Password));

    $sql = "SELECT * FROM usuarioadministrador WHERE correoElectronico='$correoElectronico' and Password='$contrasena'";
    $resultado = mysqli_query($mysqli,$sql);
    $nrows = mysqli_num_rows($resultado);


    if($nrows>0){
        $data = array('message'=>'success');
        echo json_encode($data);
    }else{
        $data = array('message'=>'failed');
        echo json_encode($data);
    }

}