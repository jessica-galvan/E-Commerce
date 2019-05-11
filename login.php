<?php
  session_start();
  require_once('actions/user-check.php');
  if(isset($_SESSION['emailUsuario'])) {  /*Si hay usuario logueado, redireccionalos a index*/
    header('location:index.php');
  }
  require_once('includes/funciones.php'); /*Solo es necesario para formularios*/

  if($_POST) {
    $email = isset($_POST['email'])?trim($_POST['email']): "";
    $contrasenia = isset($_POST['contrasenia'])?trim($_POST['contrasenia']): "";
    $contraseniaOriginal = "";

    /*VALIDACIONES*/
    if($email == ""){
      $errorEmail = "* Completa el email";
      $hayErrores = true;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errorEmail = "* Email no válido";
      $hayErrores = true;
    } else if (!checkEmail($email)) {
      $errorEmail = "Ese email no esta registrado.";
      $hayErrores = true;
    }

    if($contrasenia == ""){
      $errorContrasenia = "* Completa la contraseña";
      $hayErrores = true;
    } else if(checkEmail($email)){ /*COMPARAR CONTRASEÑAS*/
      getUser('email', $email);
      $contraseniaOriginal =  $usuarioRecuperado['contrasenia'];
      if(password_verify($contrasenia, $contraseniaOriginal)){
        $hayErrores = false;
      } else {
        $hayErrores = true;
        $errorContrasenia = "* Email o contraseña invalidas";
      }
    }

    if(!$hayErrores) {
      global $usuarioRecuperado;
      $_SESSION['emailUsuario'] = $email;
      $_SESSION['usuarioInfo'] = $usuarioRecuperado;
      $_SESSION['nombreUsuario'] = $usuarioRecuperado['nombre'];

      /*SI EL RECORDAR ESTA TILDADO, SETEAR UNA COOKIE.*/
      if(isset($_POST['recordar'])) {
        $expirar = time() + 43200; /*30 DIAS.*/
        setcookie("emailUsuario", $email, $expirar);
        setcookie("nombreUsuario", $usuarioRecuperado['nombre'], $expirar);
      } else {
        $expirar = time() - 1; /*PARA QUE SE BORRE LA COOKIE ANTERIOR*/
        setcookie("emailGuardado", "", $expirar); /*POR LAS DUDAS PISO EL DATO VACIO.*/
        setcookie("nombreUsuario", "", $expirar);
      }

      /*EN AMBOS CASOS, ANDA A CONFIRMAR.*/
      // header('location:confirmacion.php');
      $URL="confirmacion.php";
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
            <div class="form-container">
              <div class="login-text">
                <h2>Ingresá a tu cuenta</h2>
              </div>

              <form class="login-form" action="login.php" method="post">
               <div class="form">
                 <input type="text" id="email" name="email" value="<?=$email?>" placeholder="Email">
                 <span class="error-form"><?=$errorEmail?></span>
               </div>
               <div class="form">
                 <input type="password" id="contrasenia" name="contrasenia" value="" placeholder="Contraseña">
                 <span class="error-form"><?=$errorContrasenia?></span>
               </div>
               <div class="remember">
                 <label for="recordar">Recordarme</label>
                 <input id="recordar" type="checkbox" name="recordar" value="si">
               </div>
               <div class="login-button">
                 <button type="submit" name="login">Ingresar</button>
               </div>
              </form>

              <div class="form-links">
                <a href="recupero1.php">¿Olvidó su contraseña?</a>
              </div>
            </div>

            <div class="register-container">
              <div class="login-text">
                <h2>¿No tenés una cuenta?</h2>
                <p>Completa este formulario y crea tu cuenta para obtener varios beneficios.</p>
              </div>
              <form class="login-button" action="register.php" method="post">
                <button type="submit" name="">Registrarse</button>
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
