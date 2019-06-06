<?php
/*No estoy segura de si necesito un DB. O que. En algun lado tengo que poder pisar la info, sea en usuario o DB. */


Class DB {

  // private $file;
  //
  // public function __construct($file) {
  //   $this->file = $file;
  // }


  /*Validar Login*/
  public function validateLogin($emailValidar, $contraseniaValidar){
      global $validator;
      $listaErrores = $validator->getErrores();
      $email = trim($emailValidar);
      $contrasenia = trim($contraseniaValidar);
      $hayErrores = false;

      if($email == ""){
          $errores['errorEmail'] = $listaErrores['completar'];
          $hayErrores = true;
      } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errores['errorEmail'] = $listaErrores['emailNoValido'];
          $hayErrores = true;
      } elseif(!$this->checkEmail($email)) {
          $errores['errorEmail'] = $listaErrores['noRegistrado'];
          $hayErrores = true;
      }

      if($contrasenia == ""){
          $errores['errorContrasenia'] = $listaErrores['completar'];
          $hayErrores = true;
      } elseif($this->checkEmail($email)){ /*COMPARAR CONTRASEÑAS*/
          $usuario = $this->getUser($email);
          if(password_verify($contrasenia, $usuario['contrasenia'])) {
              $hayErrores = false;
          } else {
              $hayErrores = true;
              $errores['errorContrasenia'] = $listaErrores['invalidos'];
          }
      }

      if($hayErrores){
          return $errores;
      } else {
          return false;
      }
    }

    /*Controlar si un email esta en la base de datos*/
      public function checkEmail($email){
          global $conex;
          $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
          $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
          $consultaUsuarios->execute();
          $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

          if($usuario){
              return true;
          } else {
              return false;
          }
      }

    /*Recuperar info usuario*/
    public function getUser($email){
          global $conex;
          $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
          $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
          $consultaUsuarios->execute();
          $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
          return $usuario;
    }

    /*Recupera la info necesaria para perfilUsuario*/
    public function getUserPerfil($email){
          global $conex;
          $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, perfiles.id AS 'perfil_id', perfiles.fechaNacimiento, perfiles.fotoPerfil, perfiles.tipoDePiel, perfiles.tonoDePiel, perfiles.genero, perfiles.provincia FROM usuarios INNER JOIN perfiles ON usuarios.perfil_id = perfiles.id WHERE usuarios.email = ?";
          $consultaUsuarios = $conex->prepare($consulta);
          $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
          $consultaUsuarios->execute();
          $dato = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

          return $dato;
    }

    public function changeAvatar($imagen){
        global $usuarioRecuperado, $conex;

        $nombreArchivo = $imagen["name"];
        $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        $origen = $imagen["tmp_name"];

        $separar = strpos($email, '@'); /*Esto busca donde esta el @ en el sting de $email.*/
        $divido  = str_split($email, $separar); /*Y acá. utilizando la posicion del @, separo en un array numerico -del email hasta el @ en posicion 0 y el resto en posicion 1. */
        $fotoNombre = $usuarioRecuperado['id'].$divido[0]; /*Para que me ponga el id del usuario y la primera parte del email.*/
        /*Donde se guarda la foto y como se va a llamar. En este caso va a ir a la carpeta User. Si queres ponerla en otro lado, genial!*/
        $destino = "";
        $destino = $destino."img/users-avatars/";
        $destino = $destino."$fotoNombre-avatar.".$ext;
        $subir = move_uploaded_file($origen,$destino);
        move_uploaded_file($origen,$destino);

        // $subirFoto = $conex->query("UPDATE `perfiles` SET `fotoPerfil`= $fotoNombre WHERE `id` = $usuarioRecuperado['perfil_id']");
        // $subirFoto->bindValue(1, $fotoNombre, PDO::PARAM_STR);
        // $subirFoto->execute();
        /*Devuelvo solo $fotoNombre porque es lo que la base de datos necesita.*/
    }









}
