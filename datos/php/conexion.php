<?php

require "config.php";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->errno) {
    die('Error con el servidor');
}

?>