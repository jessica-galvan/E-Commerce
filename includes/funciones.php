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
  ?>
