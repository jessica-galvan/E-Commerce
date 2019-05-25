<?php
    ob_start();
    session_start();
    /*Cree una funcion, por si en algun momento necesitamos ponerla en la parte de user-check.php o funciones.php. No se si es necesaria.*/
    function logout() {
    if(isset($_COOKIE["email_usuario"])) {   /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
      setcookie('email_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
      setcookie('nombre_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
    }
    session_destroy();
    header('location: ../index.php');
    exit;
    }
    logout();
    ob_end_flush();
?>
