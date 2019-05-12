<?php
  ob_start();
  session_start();
  function logout() {
    if(isset($_COOKIE["email_usuario"])) {   /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
      setcookie('email_usuario', '', $expirar);
      setcookie('nombre_usuario', '', $expirar);
    }
    session_destroy();
    header('location: ../index.php');
    exit;
  }
  if(isset($_POST['logout'])) {
    logout();
  } else {
      logout();
  }
  ob_end_flush();
?>
