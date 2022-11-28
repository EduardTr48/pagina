<?php
// Se crea una sesion
session_start();
// Si no hay algun usuario logueado, lo redirecciona a inicar-sesion.php
if (!isset($_SESSION["usuario"])) {
    header("Location: iniciar-sesion.php");
}


?>
<!-- Muestra un mensaje de bienvenido con el nombre de usuario -->
<h1>Bievenido a su cuenta <?php echo $_SESSION["usuario"] ?> </h1>
<a href="logout.php">Cerrar sesion</a>