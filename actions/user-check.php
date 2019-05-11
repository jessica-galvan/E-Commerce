<?php
  // session_start();
  $textoBienvenida = "Ingresar";
  $textoHamburguesa = "Ingresar";
  $linkUsuario = 'login.php';
  $usuarioNombre  = "";
  /*SI HAY COOKIE DE USUARIO Y NO HAY $_SESSION - por el recordame*/
  if(isset($_COOKIE['emailUsuario']) && !isset($_SESSION['emailUsuario'])) {
    // global $nombre;
    $_SESSION['emailUsuario'] = $_COOKIE['email'];
    // $_SESSION['usuarioInfo'] = $_COOKIE['usuarioInfo'];
    $_SESSION['nombreUsuario'] = $_COOKIE['nombreUsuario'];
    $usuarioNombre = $_COOKIE['nombreUsuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $usuario";
    $textoHamburguesa = "Perfil";
  } else if (isset($_SESSION['emailUsuario'])) {  /*SI HAY ALGUIEN LOGUEADO*/
    // global $nombre;
    $usuarioNombre  = $_SESSION['nombreUsuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $usuarioNombre";
    $textoHamburguesa = "Perfil";
  }
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
  /*FUNCION QUE CONTROLA EN LAS PAGINAS DONDE SE LLAMA, SI HAY ALGUIEN LOGUEADO. EN CASO DE QUE ESTE, AUTOMATICAMENTE LOS REDIRIGE A INDEX*/
  function usuarioLogueado(){
    if(isset($_SESSION['emailUsuario'])) {  /*Si hay usuario logueado, redireccionalos a index*/
      header('location:index.php');
    }
  }

 ?>
