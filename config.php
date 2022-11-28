<?php
// URL de la base de datos
$server = "localhost";
// Usuario
$user = "root";
// Password
$pass = '';
// Nombre de la base de datos
$database = 'jujuytours';

// Se hace la conexion a la base de datos
$conexion = mysqli_connect($server, $user, $pass, $database);

if (!$conexion) {
    die("conexion fallida");
}
