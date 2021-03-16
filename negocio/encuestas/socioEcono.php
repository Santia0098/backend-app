<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

require '../../datos/php/conexion.php';

$response = array();

$numHijos   = $_POST['numHijos'];
$edadHijos   = $_POST['edadHijos'];
$delegMun   = $_POST['delegMun'];
$cp   = $_POST['cp'];
$actualVives   = $_POST['actualVives'];
$ingresoMens   = $_POST['ingresoMens'];
$casaEs   = $_POST['casaEs'];
$materialCasa   = $_POST['materialCasa'];
$trabajas   = $_POST['trabajas'];
$endonde   = $_POST['endonde'];
$sueldoMens   = $_POST['sueldoMens'];
$horario   = $_POST['horario'];
$gastosPersMens = $_POST['gastosPersMens'];
$quienCubreEst   = $_POST['quieCubreEst'];
$cuantoDanPadres   = $_POST['cuantoDanPadresTutores'];
$otraBecaApoyo   = $_POST['otraBecaApoyo'];



$numHijos    = htmlspecialchars(filter_var($$numHijos, FILTER_SANITIZE_NUMBER_INT));
$edadHijos   = htmlspecialchars(filter_var($edadHijos, FILTER_SANITIZE_NUMBER_INT));
$delegMun   = htmlspecialchars(filter_var($delegMun, FILTER_SANITIZE_STRING));
$cp    = htmlspecialchars(filter_var($cp, FILTER_SANITIZE_NUMBER_INT));
$actualVives    = htmlspecialchars(filter_var($actualVives, FILTER_SANITIZE_STRING));
$ingresoMens    = htmlspecialchars(filter_var($ingresoMens, FILTER_SANITIZE_NUMBER_INT));
$casaEs    = htmlspecialchars(filter_var($casaEs, FILTER_SANITIZE_STRING));
$materialCasa    = htmlspecialchars(filter_var($materialCasa, FILTER_SANITIZE_STRING));
$trabajas    = htmlspecialchars(filter_var($trabajas, FILTER_SANITIZE_STRING));
$endonde    = htmlspecialchars(filter_var($endonde, FILTER_SANITIZE_STRING));
$sueldoMens    = htmlspecialchars(filter_var($sueldoMens, FILTER_SANITIZE_NUMBER_INT));
$horario    = htmlspecialchars(filter_var($horario, FILTER_SANITIZE_STRING));
$gastosPersMens    = htmlspecialchars(filter_var($gastosPersMens, FILTER_SANITIZE_STRING));
$quienCubreEst    = htmlspecialchars(filter_var($quienCubreEst, FILTER_SANITIZE_STRING));
$cuantoDanPadres    = htmlspecialchars(filter_var($cuantoDanPadres, FILTER_SANITIZE_NUMBER_INT));
$otraBecaApoyo    = htmlspecialchars(filter_var($otraBecaApoyo, FILTER_SANITIZE_STRING));

$sql = "INSERT INTO socios_econos(
    num_hijos, edad_hijos, deleg_mun, cod_post, actualmenteVives, ingreMensFam, 
    laCasaEs, materialCasa, trabajas, enDonde, sueldoMens, horario, gastosPersonalesMensuales, quienCubreEstudios,
    cuantoTeDanPadresTutores, otraBecaApoyo
    ) VALUES 
    num_hijos=?, edad_hijos=?, deleg_mun=?, cod_post=?, 
    actualmenteVives=?, ingreMensFam=?, 
    laCasaEs=?, materialCasa=?, trabajas=?, enDonde=?, sueldoMens=?, horario=?, 
    gastosPersonalesMensuales=?, quienCubreEstudios=?,
    cuantoTeDanPadresTutores=?, otraBecaApoyo=?, ";

$stmt = $conexion->prepare($sql);

echo $conexion->error;

$stmt->bind_param("iisisissssisisis", $numHijos, $edadHijos, $delegMun, $actualVives, $ingresoMens, 
$casaEs, $materialCasa, $trabajas, $endonde, $sueldoMens, $horario, $gastosPersMens, $gastosPersMens, $quienCubreEst, $cuantoDanPadres, $otraBecaApoyo);

$stmt->execute();

if ($conexion->affected_rows >= 1) {
    $response = [
        'exito' => 'Insertado correctamente'
    ];
} else {
    $response = [
        'error' => 'Ocurrio un error al actualizar'
    ];
}

$conexion->close();
echo json_encode($response);