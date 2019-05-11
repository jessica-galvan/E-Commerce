<?php
  session_start();
  require_once('actions/user-check.php');
  usuarioLogueado();
  require_once('includes/funciones.php'); /*Solo es necesario para formularios*/
  $usuarioRecuperado = $_SESSION['infoGuardada'];
  $email = $_SESSION['emailGuardado'];


  if($_POST) {
    $contrasenia = isset($_POST['contrasenia'])?trim($_POST['contrasenia']): "";
    $contraseniaConfirmar = isset($_POST['contraseniaConfirmar'])?trim($_POST['contraseniaConfirmar']): "";

    if($contrasenia == ""){
      $errorContrasenia = "* Completa la contraseña";
      $hayErrores = true;
    } else if(strlen($contrasenia) < 6){
      $errorContrasenia = "* La contraseña debe tener más de 6 caracteres";
      $hayErrores = true;
      $contrasenia = "";
      $contraseniaConfirmar = "";
    } else if($contrasenia != $contraseniaConfirmar) {
      $errorContrasenia = "* Las contraseñas no coinciden";
      $hayErrores = true;
      $contrasenia = "";
      $contraseniaConfirmar = "";
    }

    if(!$hayErrores) { /*Una vez que no hay errores, reemplazamos la contraseña anterior por la nueva (pisando el dato).*/
      $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

      for ($i=0; $i < count($listaUsuarios); $i++) {
        if(checkEmail($email)){
          $listaUsuarios[$i]['contrasenia'] = $contrasenia;
          break;
        }
        return $listaUsuarios;
      }

      $listaUsuariosJSON = json_encode($listaUsuarios);
      file_put_contents('includes/user.json', $listaUsuariosJSON);
      // header('location:recupero4.php');
      $URL="recupero4.php";
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
               <p>Ingresa tu nueva contraseña</p>
             </div>

             <form class="" action="recupero3.php" method="post">
               <div class="form">
                 <label for="password">Contraseña</label>
                 <input id="password" type="password" name="contrasenia" value="<?=$contrasenia?>">
                <span class="error-form"><?=$errorContrasenia?></span>
               </div>

               <div class="form">
                 <label for="confirm">Confirmar Contraseña</label>
                 <input id="confirm" type="password" name="contraseniaConfirmar" value="<?=$contraseniaConfirmar?>">
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
