 <?php
  /*ERRORES VACIOS DE LOS FORMULARIOS*/
  $errorNombre = "";
  $errorApellido = "";
  $errorEmail = "";
  $errorFoto = "";
  $errorContrasenia = "";
  $errorPregunta = "";
  $hayErrores = false;
  /*INFO VACIA DE LOS FORMULARIOS*/
  $usuarioRecuperado = "";
  $nombre = "";
  $apellido = "";
  $email = "";
  $contrasenia = "";
  $contraseniaConfirmar = "";
  $preguntaSeguridad = "";
  $respuestaSeguridad = "";
  $foto = "";
  $recordar = "";
  /*DATA BASE USER: Lista de usuarios es el user.json decodificado. Es el array con todos los usuarios.*/
  $listaJSON = file_get_contents('includes/user.json');
  $listaUsuarios = json_decode($listaJSON, true);
  /*---FUNCIONES PARA LAS VALIDACIONES----*/
   /*getUser es para recuperar la informacion del usuario en nuestra base de datos json. Si el usuario esta logueado,devuelve el array de dicho usarios. Sino la devuelve en blanco.*/
   function getUser($indice, $dato){
     global $listaUsuarios;
     for ($i=0; $i < count($listaUsuarios); $i++) {
       global $usuarioRecuperado;
       $comparar = $listaUsuarios[$i][$indice];
       if($comparar == $dato) {
         $usuarioRecuperado = $listaUsuarios[$i];
         break;
       }
     }
     return $usuarioRecuperado;
   };
   /*checkEmail revisa en el json de usuarios si el email wue provee el usuario esta ahi adentro. Devuelve true o false. */
   function checkEmail($email){
     global $listaUsuarios;
     $resultado = false;
     for($i=0; $i < count($listaUsuarios); $i++) {
       $resultado = false;
       if($listaUsuarios[$i]['email'] == $email) {
         $resultado = true;
         break;
       }
     }
     return $resultado;
   };

   /*Funcion para eliminar cookies*/
   function borrarCookiesLogin() {
     if(isset($_COOKIE["email_usuario"])) {
       $expirar = time() - 900; /*Tiempo negativo de 15 minutos*/
       setcookie('email_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
       setcookie('nombre_usuario', '', $expirar, '/', $_SERVER['HTTP_HOST']);
     }
   }

   /*Funcion para sobrescribir datos en un usuario ya registrado. Tiene dos parametros $indice, que seria el lugar donde se reemplazaria el dato, y $dato, que seria la info nueva.*/
  function reemplazar($email, $indice, $dato){
    global $listaUsuarios;
    // global $dato;
    for ($i=0; $i < count($listaUsuarios); $i++) {
      if(checkEmail($email)){
        $listaUsuarios[$i][$indice] = $dato;
        break;
      }
      return $listaUsuarios;
    }
  };

  /*Funcion para recuperar un dato de las listas en listas-editas.php
  $arra es*/
  function recuperarDato($listaArray, $valor, $nuevaVariable){
    for ($i=0; $i < count($listaArray); $i++) {
      if ($listaArray[$i]['valor'] == $valor) {
        $nuevaVariable = $listaArray[$i]['dato'];
        return $nuevaVariable;
      }
    }
  }
  /*OJO: que al final del archivo si o si tendrias que poner lo de enconde y file_put_contents, para que se actualice el user.json. Por las dudas lo dejo acá comentado. Ponelo al final de todo el editar perfil.*/
  // $listaUsuariosJSON = json_encode($listaUsuarios);
  // file_put_contents('includes/user.json', $listaUsuariosJSON);
  /*Habria que ver si reemplazar funciona si lo usas varias veces en un formulario. Se me acaba de ocurrir.*/


  ?>
