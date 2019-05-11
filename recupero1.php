<?php
  session_start();
  require_once('actions/user-check.php');
  if(isset($_SESSION['emailUsuario'])) {  /*Si hay usuario logueado, redireccionalos a index*/
    header('location:index.php');
  }
  require_once('includes/funciones.php'); /*Solo es necesario para formularios*/

  /*Si hay usuario logueado, redireccionalos a index*/
  if($textoBienvenida != "Ingresar") {
    $URL="login.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
  }

  if($_POST) {
    $email = isset($_POST['email'])?trim($_POST['email']): "";
    //Primero validar que sea un email y este registrado.
    if($email == ""){
      $errorEmail = "* Completa el email";
      $hayErrores = true;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorEmail = "* Email no válido";
      $hayErrores = true;
    } else if(!checkEmail($email)) {
      $errorEmail = "Ese email no esta registrado.";
      $hayErrores = true;
    }

    if(!$hayErrores) {
      $_SESSION['emailGuardado'] = $_POST['email'];
      $usuarioRecuperado = getUser('email', $email);
      $_SESSION['infoGuardada'] = $usuarioRecuperado;
      $URL="recupero2.php";
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
           <div class="register-form">
             <div class="login-text">
               <h2>Olvidé mi contraseña</h2>
               <p>Primero ingresa tu email</p>
             </div>

             <form class="" action="recupero1.php" method="post">
               <div class="form">
                 <!-- <label for="email">Email</label> -->
                 <input id="email" type="text" name="email" placeholder="Email" value="<?=$email?>" >
                 <span class="error-form"><?=$errorEmail?></span>
               </div>

               <div class="login-button">
                 <button type="submit" name="recupero1">ENVIAR</button>
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
