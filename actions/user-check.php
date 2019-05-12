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

 /*Funcion para eliminar cookies*/
  function borrarCookiesLogin() {
    if(isset($_COOKIE["email_usuario"])) {
      $_COOKIE['email_usuario'] = "";
      $_COOKIE['nombre_usuario'] = "";
      unset($_COOKIE["email_usuario"]);
      unset($_COOKIE["nombre_usuario"]);
      $expirar = time() - 60*60*24*30; /*Tiempo negativo de 60 minutos*/
      setcookie("email_usuario", "s", $expirar);
      setcookie("nombre_usuario", '', $expirar);
    }
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
  /*NO FUNCIONA como deberia. Por alguna razon, me redirecciona cuando estoy logueada.*/
  function sinUsuario(){
    if(!isset($_SESSION['emailUsuario'])){  /*Si no hay usuario logueado, redireccionalos a login*/
      header('location:login.php');
      exit;
    } else if (!isset($_COOKIE['email_usuario']) || $_COOKIE['email_usuario'] == "") {
      header('location:login.php');
      exit;
      }
    }

  function logout() {
    if(isset($_COOKIE["email_usuario"])) {   /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
      setcookie("email_usuario", 'vacio', $expirar);
      setcookie("nombre_usuario", 'vacio', $expirar);
    }
    session_destroy();
    // header('location: ../index.php');
    header('location: ../perfilUsuario.php');
    exit;
  }


  /*LOGOUT*/
  if(isset($_POST['logout'])) {
    logout();
    // /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
    // borrarCookiesLogin();
    // session_destroy();
    // header('location: ../index.php');
  }


 ?>
