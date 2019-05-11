<?php
  // session_start();
  $textoBienvenida = "Ingresar";
  $linkUsuario = 'login.php';
  $nombre = "";

  /*SI HAY COOKIE DE USUARIO Y NO HAY $_SESSION - por el recordame*/
  if(isset($_COOKIE['emailUsuario']) && !isset($_SESSION['emailUsuario'])) {
    // global $nombre;
    $_SESSION['emailUsuario'] = $_COOKIE['email'];
    // $_SESSION['usuarioInfo'] = $_COOKIE['usuarioInfo'];
    $_SESSION['nombreUsuario'] = $_COOKIE['nombreUsuario'];
    $nombre = $_COOKIE['nombreUsuario'];

    $linkUsuario = "confirmacion.php";
    $textoBienvenida = "Hola $usuario";

  } else if (isset($_SESSION['emailUsuario'])) {  /*SI HAY ALGUIEN LOGUEADO*/
    // global $nombre;
    $nombre = $_SESSION['nombreUsuario'];

    $linkUsuario = "confirmacion.php";
    $textoBienvenida = "Hola $nombre";
  }
 ?>
