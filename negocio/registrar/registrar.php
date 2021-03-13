<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

require '../../datos/php/conexion.php';

$response = array();

$nombres    = $_POST['nombres'];
$ap_paterno     = $_POST['ap_paterno'];
$ap_materno     = $_POST['ap_materno'];
$correo     =   $_POST['correo'];
$contrasena = $_POST['contrasena'];

$nombres    = htmlspecialchars(filter_var($nombres, FILTER_SANITIZE_STRING));
$ap_materno     = htmlspecialchars(filter_var($ap_materno, FILTER_SANITIZE_STRING));
$ap_paterno     = htmlspecialchars(filter_var($ap_paterno, FILTER_SANITIZE_STRING));
$correo     = htmlspecialchars(filter_var($correo, FILTER_SANITIZE_EMAIL));
$contrasena = htmlspecialchars(filter_var($contrasena, FILTER_SANITIZE_STRING));


$sql = "INSERT INTO usuarios(nombres, ap_paterno, ap_materno, correo, contrasena)  VALUES nombres=?, 
    ap_materno=?, ap_paterno=?, correo=?,
    contrasena=?,";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("sssss", $nombres, $ap_paterno, $ap_materno, $correo, $contrasena);

$stmt->execute();

if ($conexion->affected_rows >= 1) {
    $response = [
        'exito' => 'Registro exitoso'
    ];
} else {
    $response = [
        'error' => 'Ocurrio un error al registrar'
    ];
}

$conexion->close();

echo json_encode($response);