<?php /*Esto es lo necesario para que el header funcione, independientemente de funciones.php*/
  /*SI HAY SESION*/
  if(isset($_SESSION['email_usuario'])) {
    $nombre_usuario  = $_SESSION['nombre_usuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $nombre_usuario";
    $textoHamburguesa = "Perfil";
    $textoLogout = "Cerrar Sesión";
  } else if (isset($_COOKIE['email_usuario']) && $_COOKIE['email_usuario'] != "") {  /*SI HAY COOKIE DEL RECORDAME, INICIA SESSION*/
    $_SESSION['email_usuario'] = $_COOKIE['email_usuario'];
    $_SESSION['nombre_usuario'] = $_COOKIE['nombre_usuario'];
    $nombre_usuario = $_COOKIE['nombre_usuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $nombre_usuario";
    $textoHamburguesa = "Perfil";
    $textoLogout = "Cerrar Sesión";
  } else {
    $textoBienvenida = "Ingresar";
    $textoHamburguesa = "Ingresar";
    $linkUsuario = 'login.php';
    $nombre_usuario = "";
    $textoLogout = "";
  }

  /*Funcion que controla (donde la pagina donde se llama a la funcion), si hay un usuario logueado. Si esta alguien logueado, automaticamente lo redirecciona a index.php*/
  function usuarioLogueado(){
    if(isset($_SESSION['email_usuario'])) {  /*Si hay usuario logueado, redireccionalos a index*/
      header('location:index.php');
      // $URL="index.php";
      // echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      // echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      exit;
    }
  }

  /*Al revez de usuarioLogueado, te redirigue a los no logueados a login.php para poder acceder a esa pagina*/
  function sinUsuario(){
    if(!isset($_SESSION['email_usuario'])) {  /*Si no hay usuario logueado, redireccionalos a login*/
      header('location:login.php');
      exit;
    }
  }
 ?>
