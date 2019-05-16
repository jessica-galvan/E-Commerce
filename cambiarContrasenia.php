<?php
  ob_start();
  session_start();
  require_once('actions/user-check.php');
  sinUsuario();
  require_once('includes/funciones.php');
  $email = $_SESSION['email_usuario'];
  getUser('email', $email);

  $contraseniaOriginal = $usuarioRecuperado['contrasenia'];
  $errorContraseniaVieja = ""; /*Esta es la que el usuario ingresa en el campo "Contraseña Original"*/

    if(isset($_POST['cambiar'])){
      $contraseniaVieja = isset($_POST['contraseniaVieja'])?trim($_POST['contraseniaVieja']): "";
      $contraseniaNueva = isset($_POST['contraseniaNueva'])?trim($_POST['contraseniaNueva']): "";
      $contraseniaConfirmar = isset($_POST['contraseniaConfirmar'])?trim($_POST['contraseniaConfirmar']): "";

      if($contraseniaVieja == ""){
        $errorContraseniaVieja = "* Completa la contraseña";
        $hayErrores = true;
      } else if(!password_verify($contraseniaVieja, $contraseniaOriginal)){
        $hayErrores = true;
        $errorContrasenia = "* Contraseña invalida";
      } else if($contraseniaNueva == ""){
        $errorContrasenia = "* Completa la contraseña";
        $hayErrores = true;
      } else if(strlen($contraseniaNueva) < 6){
        $errorContrasenia = "* La contraseña debe tener más de 6 caracteres";
        $hayErrores = true;
      } else if($contraseniaNueva != $contraseniaConfirmar) {
        $errorContrasenia = "* Las contraseñas no coinciden";
        $hayErrores = true;
      }

      if(!$hayErrores) {
        $contraseniaNueva = password_hash($contraseniaNueva, PASSWORD_DEFAULT);
        reemplazar($email, 'contrasenia', $contraseniaNueva);

        $listaUsuariosJSON = json_encode($listaUsuarios);
        file_put_contents('includes/user.json', $listaUsuariosJSON);
        // header('location:perfilUsuario.php');
        $URL="perfilUsuario.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      }
    }
  ob_end_flush();
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
              <h2>Cambiar Contraseña</h2>
            </div>

            <form class="cambiarContraseña" action="cambiarContrasenia.php" method="post">
              <!--Contraseña Vieja-->
              <div class="form">
                <label for="passwordOld">Contraseña Original:</label>
                <input class="cambiarContrasenia" id="passwordOld" type="password" name="contraseniaVieja" value="">
               <span class="error-form"><?=$errorContraseniaVieja?></span>
              </div>

              <!--Contraseña Nueva-->
              <div class="form">
                <label for="password">Contraseña Nueva</label>
                <input class="cambiarContrasenia" id="password" type="password" name="contraseniaNueva" value="">
               <span class="error-form"><?=$errorContrasenia?></span>
              </div>

              <!--Confirmar Contraseña Nueva-->
              <div class="form">
                <label for="confirm">Confirmar Contraseña</label>
                <input class="cambiarContrasenia" id="confirm" type="password" name="contraseniaConfirmar" value="">
              </div>

              <div class="login-button">
                <button type="submit" name="cambiar">ENVIAR</button>
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
