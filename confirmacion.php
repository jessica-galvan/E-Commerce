<?php
  session_start();
  require_once('actions/user-check.php');
  usuarioLogueado();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/perfil.css">
    <title>Fancy Beauty</title>
  </head>
  <body>
    <div class="xl-screen">
      <div class="body-container">
        <!--HEADER-->
        <?php
          include_once("includes/header.php");
         ?>
        <main class="main-container">
          <div class="register-form">
              <div class="login-text">
                <h2>¡Gracias por registrarte!</h2>
              </div>
              <div class="caja-botones">
                <form class="editar-button-amarillo" action="login.php" method="post">
                  <button type="submit" name="logout">Iniciar Sesión</button>
                </form>
                <form class="editar-button-rosa" action="index.php" method="post">
                  <button type="submit" name="cambiarContrasenia">Volver al Index</button>
                </form>
              </div>
          </div>
        </main>
       <!--FOOTER-->
       <?php
       include_once("includes/footer.php");
       ?>
      </div>
    </div>
   </body>
 </html>
