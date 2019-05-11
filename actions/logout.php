<?php
  session_start();
  /*IF($_POST['logout']) --> que haga todo el restoy y el session_destroy. y que luego mande al index. ()*/

  if(isset($_POST['logout'])) { /*SI EL USUARIO LE DIO AL BOTON LOGOUT*/

  /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
    if(isset($_COOKIE['emailUsuario'])) {
      $expirar = time() - 1; /*PARA QUE SE BORRE LA COOKIE ANTERIOR*/
      setcookie("emailGuardado", "", $expirar); /*POR LAS DUDAS PISO EL DATO VACIO.*/
      setcookie("usuarioInfo", "", $expirar);
      setcookie("nombreUsuario", "", $expirar);
    }

    session_destroy();
    header('location: ../index.php');
  }




 ?>
