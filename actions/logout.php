<?php
  session_start();
  /*SI VIENEN POR $_POST*/
  if($_POST['logout']) {
    if(isset($_COOKIE["email_usuario"])) {   /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
      setcookie("email_usuario", '', $expirar);
      setcookie("nombre_usuario", '', $expirar);
    }
    session_destroy();
    header('location: ../index.php');
    exit;
  }

  /*Si vienen por link, sin $_POST*/
    if(isset($_COOKIE["email_usuario"])) {   /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
      setcookie("email_usuario", '', $expirar);
      setcookie("nombre_usuario", '', $expirar);
    }
  session_destroy();
  header('location: ../index.php');
  exit;
?>
