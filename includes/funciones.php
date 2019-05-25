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
            $comparar = $listaUsuarios[$i][$indice];
            if($comparar == $dato) {
                $usuarioRecuperado = $listaUsuarios[$i];
                break;
            }
        }
        return $usuarioRecuperado;
    }
    /*checkEmail revisa en el json de usuarios si el email que provee el usuario esta ahi adentro. Devuelve true o false. */
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
    }

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
        for ($i=0; $i < count($listaUsuarios); $i++) {
            if($email == $listaUsuarios[$i]['email']){
                $listaUsuarios[$i][$indice] = $dato;
                break;
            }
        }
        return $listaUsuarios;
    }
    /*OJO: que al final del archivo si o si tendrias que poner lo de enconde y file_put_contents, para que se actualice el user.json. Por las dudas lo dejo acá comentado. pONELO DESPUES de usar la funcion reemplazar.*/
    // $listaUsuariosJSON = json_encode($listaUsuarios);
    // file_put_contents('includes/user.json', $listaUsuariosJSON);

    /*Funcion para recuperar un dato de las listas en listas-editar.php, solo funciona si la lista tiene dos variables, valor y dato.*/
    function recuperarDato($listaArray, $valor, $nuevaVariable){
        for ($i=0; $i < count($listaArray); $i++) {
            if ($listaArray[$i]['valor'] == $valor) {
                $nuevaVariable = $listaArray[$i]['dato'];
            }
        }
        return $nuevaVariable;
    }

    /*Funcion para calcular Edad. No necesito explicar nada más*/
    function calcularEdad($fecha){
        $dia = date("j");
        $mes = date("n");
        $anio = date("Y");
        $anioNacimiento = substr($fecha, 0, 4);
        $mesNacimiento = substr($fecha, 5, 2);
        $diaNacimiento = substr($fecha, 8, 2);

        if($mesNacimiento > $mes){
            $edad = $anio - $anioNacimiento-1;
        } else {
            if($mes == $mesNacimiento && $diaNacimiento > $dia){
                $edad = $anio - $anioNacimiento -1;
            } else {
                $edad = $anio - $anioNacimiento;
            }
        }
        return $edad;
    }
?>
