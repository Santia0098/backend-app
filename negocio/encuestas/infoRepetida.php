<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

require '../../datos/php/conexion.php';

$response = array();

$numControl   = $_POST['numControl'];
$estatura   = $_POST['estatura'];
$peso   = $_POST['peso'];
$sexo   = $_POST['sexo'];
$telefono   = $_POST['telefono'];
$estadoCivil   = $_POST['estadoCivil'];
$calle   = $_POST['calle'];
$num_ext   = $_POST['num_ext'];
$num_int   = $_POST['num_int'];
$colonia   = $_POST['colonia'];
$fechaNac   = $_POST['fechaNac'];
$edad   = $_POST['edad'];

$numControl    = htmlspecialchars(filter_var($numControl, FILTER_SANITIZE_STRING));
$estatura   = htmlspecialchars(filter_var($estatura, FILTER_SANITIZE_STRING));
$peso   = htmlspecialchars(filter_var($peso, FILTER_SANITIZE_STRING));
$sexo    = htmlspecialchars(filter_var($sexo, FILTER_SANITIZE_STRING));
$telefono    = htmlspecialchars(filter_var($telefono, FILTER_SANITIZE_STRING));
$estadoCivil    = htmlspecialchars(filter_var($estadoCivil, FILTER_SANITIZE_STRING));
$calle    = htmlspecialchars(filter_var($calle, FILTER_SANITIZE_STRING));
$num_ext    = htmlspecialchars(filter_var($num_ext, FILTER_SANITIZE_STRING));
$num_int    = htmlspecialchars(filter_var($num_int, FILTER_SANITIZE_STRING));
$colonia    = htmlspecialchars(filter_var($colonia, FILTER_SANITIZE_STRING));
$fechaNac    = htmlspecialchars(filter_var($fechaNac, FILTER_SANITIZE_STRING));
$edad    = htmlspecialchars(filter_var($edad, FILTER_SANITIZE_STRING));

$sql = "UPDATE usuarios SET (numControl, estatura, peso, sexo, telefono, estadoCivil, calle, num_ext, num_int, colonia, fechaNac, edad) WHERE idUsuario= $idUsuario";

$stmt = $conexion->prepare($sql);

echo $conexion->error;

$stmt->bind_param("sssss", $numControl, $estatura, $peso, $sexo, $telefono, $estadoCivil, $calle, $num_ext, $num_int, $colonia, $fechaNac, $edad);

$stmt->execute();

if ($conexion->affected_rows >= 1) {
    $response = [
        'exito' => 'Actualizacion exitosa'
    ];
} else {
    $response = [
        'error' => 'Ocurrio un error al actualizari'
    ];
}

$conexion->close();
echo json_encode($response);