<?php
  /*SI HAY SESION*/
  if(isset($_SESSION['email_usuario'])) {
    $nombre_usuario  = $_SESSION['nombre_usuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $nombre_usuario";
    $textoHamburguesa = "Perfil";
  } else if (isset($_COOKIE['email_usuario']) && $_COOKIE['email_usuario'] != "") {  /*SI HAY COOKIE DEL RECORDAME, INICIA SESSION*/
    $_SESSION['email_usuario'] = $_COOKIE['email_usuario'];
    $_SESSION['nombre_usuario'] = $_COOKIE['nombre_usuario'];
    $nombre_usuario = $_COOKIE['nombre_usuario'];
    $linkUsuario = "perfilUsuario.php";
    $textoBienvenida = "Hola $nombre_usuario";
    $textoHamburguesa = "Perfil";
  } else {
    $textoBienvenida = "Ingresar";
    $textoHamburguesa = "Ingresar";
    $linkUsuario = 'login.php';
    $nombre_usuario = "";
  }
  /*SI HAY COOKIE DE USUARIO Y NO HAY $_SESSION - por el recordame*/
  // if(isset($_COOKIE['email_usuario']) != "" && !isset($_SESSION['email_usuario'])) {
  //   $_SESSION['email_usuario'] = $_COOKIE['email_usuario'];
  //   $_SESSION['nombre_usuario'] = $_COOKIE['nombre_usuario'];
  //   $nombre_usuario = $_COOKIE['nombre_usuario'];
  //   $linkUsuario = "perfilUsuario.php";
  //   $textoBienvenida = "Hola $nombre_usuario";
  //   $textoHamburguesa = "Perfil";
  // } else if (isset($_SESSION['email_usuario'])) {  /*SI HAY ALGUIEN LOGUEADO*/
  //   $nombre_usuario  = $_SESSION['nombre_usuario'];
  //   $linkUsuario = "perfilUsuario.php";
  //   $textoBienvenida = "Hola $nombre_usuario";
  //   $textoHamburguesa = "Perfil";
  // }

 /*Funcion para eliminar cookies*/
  function borrarCookies() {
    if(isset($_COOKIE["email_usuario"])) {
      unset($_COOKIE["email_usuario"]);
      unset($_COOKIE["nombre_usuario"]);
      // $expirar = time() - 3600; /*PARA QUE SE BORRE LA COOKIE ANTERIOR, POR LAS DUDAS PISO EL DATO VACIO.*/
      $expire = time()+1;
      setcookie("email_usuario", '', $expirar);
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

    /*LOGOUT*/
    if(isset($_POST['logout'])) {
    /*Y SI HAY UNA COOKIE SETEADA CON EL RECORDAME?*/
      borrarCookies();
      session_destroy();
      header('location: ../index.php');
    }



  }

 ?>
