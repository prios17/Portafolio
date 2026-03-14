<?php
$conexion = new mysqli("localhost", "root", "", "portafolio_db");

if ($conexion->connect_error) {
    die("Error conectando a la base de datos: " . $conexion->connect_error);
}
?>