<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

require '../../datos/php/conexion.php';

$response = array();

$correo     = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$correo     = htmlspecialchars(filter_var($correo, FILTER_SANITIZE_EMAIL));

$sql = "SELECT id_usuarios, nombres, ap_paterno, ap_materno, numControl, telefono, correo, contrasena 
        FROM usuarios 
        WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);

$stmt->execute();

$stmt->bind_result(
    $idUsuarios,
    $nombres,
    $ap_paterno,
    $ap_materno,
    $nControl,
    $tel,
    $correo,
    $contrasenaU
);

if ($stmt->fetch()) {
    if ($contrasenaU == $contrasena) {
        $response = [
            'idUsuario'     => $idUsuarios,
            'nombres'       => utf8_encode($nombres),
            'ap_paterno'    => utf8_encode($ap_paterno),
            'ap_materno'    => utf8_encode($ap_materno),
            'numControl'    => utf8_encode($nControl),
            'telefono'      => $tel,
            'correo'        => $correo
        ];
    } else {
        $error = 'Contrasena';
        $response = [
            'error' => $error
        ];
    }
} else {
    $error = 'Cuenta';
    $response = [
        'error' => $error
    ];
}
echo json_encode($response);