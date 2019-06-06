<?php

Class Auth {


  public function __construct(){
      session_start();
  }

/*Necesito:
login(), logout(), sessionStart(), check(), guest()*/

  public function login($email){
      global $baseDatos;
      $usuarioRecuperado = $baseDatos->getUser($email);
      $_SESSION["email_usuario"] = $email;
      $_SESSION["nombre_usuario"] = $usuarioRecuperado["nombre"];
      $_SESSION["id_usuario"] = $usuarioRecuperado["id"];
  }

  public function logout(){
    if(isset($_SESSION["email_usuario"])){
      session_destroy();
      if(isset($_COOKIES["email_usuario"])) {
          $this->borrarCookiesLogin();
      }
      header("Location:../login.php");
    }else{
      header("Location:register.php");
    }
  }

  public function recordar($email){
      global $baseDatos;
      $usuarioRecuperado = $baseDatos->getUser($email);
      $expirar = time() + 60*60*24*30; /*30 DIAS*/
      setcookie('email_usuario', $email, $expirar, '/', $_SERVER['HTTP_HOST']);
      setcookie('nombre_usuario', $usuarioRecuperado["nombre"], $expirar, '/', $_SERVER['HTTP_HOST']);
  }

  public function borrarCookiesLogin(){
      if(isset($_COOKIE["email_usuario"])) {
          $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
          setcookie('email_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
          setcookie('nombre_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
      }
  }

  public function usuarioLogueado(){
      if(isset($_SESSION['email_usuario'])) {
          header('Location:perfilUsuario.php');
      }
  }

  public function usuarioNoLogueado(){
      if(!isset($_SESSION['email_usuario'])) {
          header('Location:login.php');
      }
  }

  public function checkSessionEmail(){
      global $baseDatos;
      $email = false;
      if(isset($_SESSION["email_usuario"])) {
        $email = $_SESSION["email_usuario"];
      } elseif (isset($_COOKIE["email_usuario"])) {
        $email = $_COOKIE["email_usuario"];
        $usuarioRecuperado = $baseDatos->getUser($email);
        $_SESSION["email_usuario"] = $email;
        $_SESSION["nombre_usuario"] = $usuarioRecuperado["nombre"];
        $_SESSION["id_usuario"] = $usuarioRecuperado["id"];
    }
      return $email;
  }
}
