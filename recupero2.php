<?php
  session_start();
  require_once('actions/user-check.php');
  usuarioLogueado();
  require_once('includes/funciones.php'); /*Solo es necesario para formularios*/
  $email = $_SESSION['emailGuardado'];
  $usuarioRecuperado = $_SESSION['infoGuardada'];
  $preguntaSeguridad = $_SESSION['infoGuardada']['preguntaSeguridad'];

  if($_POST) {
    $respuestaSeguridad= isset($_POST['respuestaSeguridad'])?trim($_POST['respuestaSeguridad']): "";

    if($respuestaSeguridad == "") {
      $errorPregunta = "* Tu respuesta no puede estar vacia";
      $hayErrores = true;
    } else if(!password_verify($respuestaSeguridad, $usuarioRecuperado['respuestaSeguridad'])) {
      $errorPregunta = "Respuesta incorrecta";
      $hayErrores = true;
    }

    if(!$hayErrores) {
      // $_SESSION['infoUsuario'] = $usuarioRecuperado;
      // header('location:recupero3.php');
      $URL="recupero3.php";
      echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
               <p>Contesta tu Pregunta de Seguridad</p>
             </div>

             <form class="" action="recupero2.php" method="post">
               <div class="form">
                 <label for="preguntaSeguridad"><?=$preguntaSeguridad?></label>
                 <input type="text" name="respuestaSeguridad" placeholder="Respuesta" value="<?=$respuestaSeguridad?>">
                 <span class="error-form"><?=$errorPregunta?></span>
               </div>

               <div class="login-button">
                 <button type="submit" name="login">ENVIAR</button>
               </div>
             </form>
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
