<?php
// Se importa la base de datos
include "config.php";
//Se crea una sesion
session_start();
error_reporting(0);

// Se verifica si hay algun usuario logueado
if (isset($_SESSION["usuario"])) {
   // Lo manda a la pagina panel.php
   header("Location: panel.php");
}

//  Se verifica si hay datos en el formulario
if ($_POST) {
   // Los datos del formulario se van a asignando a las variables, para despues utilizarlas
   $correo = $_POST["email"];
   // La contrasenias se hashean por temas de seguridad
   $password = md5($_POST["password"]);
   // Se crea una consulta donde se compara el email y la contrasenia del formulario con alguna coincidencia en la base de datos
   $sql = "SELECT * FROM usuarios WHERE email = '$correo' AND password = '$password'";
   // Se ejecuta la consulta
   $resultado = mysqli_query($conexion, $sql);
   // Si se encontro una coincidiencia, se guardan en la sesion el nombre de usuario y lo redirige a la pagina panel.php
   if ($resultado->num_rows > 0) {
      $fila = mysqli_fetch_assoc($resultado);
      $_SESSION["usuario"] = $fila["usuario"];
      header("Location: panel.php");
   } else {
      echo "La contraseña o el email son incorrectos";
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
      <a class="navegacion-item" href="registrarse.php">Registrarse</a>
      <a class="navegacion-item marcado" href="iniciar-sesion.php">Iniciar sesion</a>
   </nav>
   <main class="contenedor">
      <h1>Iniciar Sesion</h1>

      <div class="contenedor-formulario">
         <form class="formulario" action="iniciar-sesion.php" method="post">
            <div class="campo">
               <label for="">Correo:</label>
               <input type="email" name="email" placeholder="Ingrese su correo">
            </div>
            <div class="campo">
               <label for="">Contraseña:</label>
               <input type="password" name="password" placeholder="Ingrese su contraseña">
            </div>

            <input class="boton-enviar" type="submit" value="Ingresar">
         </form>
      </div>

   </main>
   <footer class="footer">
      <p>San Salvador de JujuyTours</p>
   </footer>
   <script src="script.js"></script>
</body>

</html>