<?php
// Se importa la base de datos
include "config.php";

// Se crea la sesion
error_reporting(0);
session_start();


// Se verifica si hay algun usuario logueado
if (isset($_SESSION["usuario"])) {
   header("Location: panel.php");
}

// Se verifica si hay datos en el formulario
if ($_POST) {
   // Los datos del formulario se van a asignando a las variables, para despues utilizarlas
   $usuario = $_POST['usuario'];
   $correo = $_POST["correo"];
   // Las contrasenias se hashean(encriptan) por temas de seguridad
   $password = md5($_POST["password"]);
   $cpassword = md5($_POST["cpassword"]);

   // Se comparan las contrasenas 
   if ($password == $cpassword) {
      // Se crea una consulta para saber si hay algun email ya registrado
      $sql = "SELECT * FROM usuarios WHERE email = '$correo'";
      // Se realiza la consulta
      $resultado = mysqli_query($conexion, $sql);
      // Si no habia algun correo ya registrado se insertan los datos
      if (!$resultado->num_rows > 0) {
         $sql = "INSERT INTO usuarios (usuario,email,password) VALUES ('$usuario','$correo','$password')";
         // Se insertan los datos
         $resultado = mysqli_query($conexion, $sql);
         // Si no hubo ningun problema se muestra un mensaje diciendo 'insertado correctamente'
         if ($resultado) {
            echo "<script>alert('insertado correctamente')</script>";
            // Se limpiar las variables por si otro usuario desea registrarse
            $usuario = "";
            $correo = "";
            $_POST["password"] = "";
            $_POST["cpassword"] = "";
         } else {
            echo "<script>alert('No se pudo registrar')</script>";
         }
      } else {
         echo "<script>alert('El correo ya existe')</script>";
      }
   } else {
      echo "<script>alert('Las contraseñas no coinciden')</script>";
   }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>JujuyTours</title>
   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
   <!-- Estilos -->
   <!-- <link rel="stylesheet" href="normalize.css" /> -->
   <link rel="stylesheet" href="style.css" />
</head>

<body>
   <nav class="navegacion">
      <a class="logo" href="">Logo</a>
      <a class="navegacion-item" href="index.html">Inicio</a>
      <a class="navegacion-item" href="categorias.html">Categorias</a>
      <a class="navegacion-item marcado" href="registrarse.php">Registrarse</a>
      <a class="navegacion-item" href="iniciar-sesion.php">Iniciar sesion</a>
   </nav>

   <main class="contenedor">
      <h1>Registrarse</h1>
      <div class="contenedor-formulario">
         <!-- Formulario -->
         <form class="formulario" action="registrarse.php" method="post">
            <div class="campo">
               <label for="">Usuario:</label>
               <input type="text" name="usuario" placeholder="Ingrese un usuario">
            </div>
            <div class="campo">
               <label for="">Correo:</label>
               <input type="email" name="correo" placeholder="Ingrese su correo">
            </div>
            <div class="campo">
               <label for="">Contraseña:</label>
               <input type="password" name="password">
            </div>
            <div class="campo">
               <label for="">Confirrmar contraseña:</label>
               <input type="password" name="cpassword">
            </div>
            <input class="boton-enviar" type="submit" value="Registrarse">
         </form>
      </div>

   </main>
   <footer class="footer">
      <p>San Salvador de JujuyTours</p>
   </footer>
   <script src="script.js"></script>
</body>

</html>