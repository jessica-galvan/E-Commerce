<?php
  session_start();
  require_once('actions/user-check.php');
  // require_once('includes/funciones.php');
  if($_POST) {
    session_destroy();
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css">
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
               <h2>Olvidé mi contraseña</h2>
               <p>Listo, ya cambiaste tu contraseña. Ahora proba ingresar de nuevo.</p>
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
