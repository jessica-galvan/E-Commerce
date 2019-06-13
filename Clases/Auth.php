<?php

Class Auth {


  public function __construct(){
      session_start();
  }

/*Necesito:
login(), logout(), sessionStart(), check(), guest()*/

  public function login($email){
      global $usuario;
      $_SESSION["email_usuario"] = $email;
        $_SESSION["nombre_usuario"] = $usuario->getInfoEspecifica($_SESSION["email_usuario"], 'nombre');
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
      $expirar = time() + 60*60*24*30; /*30 DIAS*/
      setcookie('email_usuario', $email, $expirar, '/', $_SERVER['HTTP_HOST']);
  }

  public function borrarCookiesLogin(){
      if(isset($_COOKIE["email_usuario"])) {
          $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
          setcookie('email_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
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
      global $usuario;
      if(isset($_SESSION["email_usuario"])) {
        return true;
      } elseif (isset($_COOKIE["email_usuario"])) {
        $_SESSION["email_usuario"] = $_COOKIE["email_usuario"];
        $_SESSION["nombre_usuario"] = $baseDatos->getInfoEspecificaUsuario($_SESSION["email_usuario"], 'nombre');
        return true;
    }
      return false;
  }
}
