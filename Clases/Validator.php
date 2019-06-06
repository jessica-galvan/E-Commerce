<?php
/*
Necesito: registervalidar() y avatarvalidar(). Quizas necesita un validador de emails solamente, uno de trim, y uno de password por separado, asi tengo los errores en distintos lugares. Ademas, un atributo error con los distintos errores, asi puedo llamarlos en distintos metodos.

*/

Class Validator {
//atributos
    public $errores = [];

//responsabilidades

    public function __construct(){
        $this->errores = [
            'completar' => '* Completar el campo',
            'seleccionar' => '* Selecciona una pregunta',
            'emailNoValido' => '* Email no valido',
            'registrado' => '* Ese email ya esta registrado',
            'noRegistrado' => '* Este mail no esta registrado',
            'corta' => '* La contraseña debe tener más de 6 caracteres',
            'coinciden' => '* Las contraseñas no coinciden',
            'invalidos' => "* Email o contraseña invalidas"
        ];
    }

    public function getErrores(){
            return $this->errores;
    }

    //esta función va a recibir POST y va a validar los campos. El nombre del parámetro puede ser el que ustedes quieran

    /*Quizas sea necesario definir una base de datos como atributo, en el constructor. O no. */
    public function registerValidate($nombre, $apellido, $email, $contrasenia, $contraseniaConfirmar, $preguntaSeguridad, $respuestaSeguridad) {
        global $conex, $baseDatos;
        $consultaUsuarios = $conex->query("SELECT * FROM usuarios");
        // $consultaUsuarios->execute();
        $usuarios = $consultaUsuarios->fetchAll(PDO::FETCH_ASSOC);
        $hayErrores = false;

        /*Controlar que no este vacio*/
        if($nombre == "") {
            // $errorNombre = $this->errores['completar'];
            $error['errorNombre'] = $this->errores['completar'];
            $hayErrores = true;
        }

        if($apellido == "") {
            // $errorApellido = $this->errores['completar'];
            $error['errorApellido'] = $this->errores['completar'];
            $hayErrores = true;
        }

        if($email == ""){
            // $errorEmail = $this->errores['completar'];
            $error['errorEmail'] = $this->errores['completar'];
            $hayErrores = true;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // $errorEmail = $this->errores['emailNoValido'];
            $error['errorEmail'] = $this->errores['emailNoValido'];
            $hayErrores = true;
        } elseif($baseDatos->checkEmail($email)) {
            /*Controlamos que no este ya registrado*/
            // $errorEmail = $this->errores['registrado'];
            $error['errorEmail'] = $this->errores['registrado'];
            $hayErrores = true;
        }

        if($contrasenia == ""){
            // $errorContrasenia = $this->errores['completar'];
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['completar'];
        } elseif(strlen($contrasenia) < 6 ) {
            /*y acá vemos si la contraseña tiene suficientes caracteres*/
            // $errorContrasenia = $this->errores['corta'];
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['corta'];
        } elseif($contrasenia != $contraseniaConfirmar){
            // $errorContrasenia = $this->errores['noCoinciden'];
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['coinciden'];
        }

        if ($preguntaSeguridad == ""){
            // $errorPregunta =  $this->errores['seleccionar'];
            $hayErrores = true;
            $error['errorPregunta'] =  $this->errores['seleccionar'];
        } elseif($respuestaSeguridad == ""){
            // $errorRespuesta = $this->errores['completar'];
            $hayErrores = true;
            $error['errorPregunta'] = $this->errores['completar'];
        }

        if($hayErrores){
            return $error;
        } else {
            return false;
        }

    }

    public function imagenValidate($imagen) {
        // if($imagen["error"] === UPLOAD_ERR_OK){
        //
        //     exif_imagetype($imagen);
        //     $a = getimagesize($imagen);
        // 	$image_type = $a[2];
        //
        // 	if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))) {
        // 		return true;
        // 	}
        // 	return false;
        // } elseif ($imagen["error"] != 4){
        //     $error = "* Hubo un problema";
        // }
        // if (!empty($foto['tmp_name']) {
        //     $image = $foto["name"];
        //     $path_info = pathinfo($image);
        //     if ($path_info['extension'] == 'jpg' || $path_info['extension'] == 'jpeg' || $path_info['extension'] == 'png' || $path_info['extension'] == 'gif'){
        //         // if ($foto["size"] <= $maxFileSize){
        //         //     $image_d = getimagesize($image);
        //         //     if(($image_d[0] >= $minWidth) && ($image_d[1] >= $minHeight)){
        //         //         $errors[]="valid image";
        //         //     }else{
        //         //         $errors[]="invalid dimension";
        //         //     }
        //         // }else{
        //         //     $errors[]="invalid file size";
        //         // }
        //     }else{
        //         $error="El formato no se soporta";
        //     }
        //
        // }else{
        //     $error = 'Por favor selecciona al menos una imagen.';
        // }
        //
        // if($error){
        //     return $error;
        // } else {
        //     return false;
        // }

    }

    public function validateEmail($dato){
        global $baseDatos;
        $hayErrores = false;
        $email = trim($dato);

        if($email == ""){
            $error = $this->errores['completar'];
            $hayErrores = true;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = $this->errores['emailNoValido'];
            $hayErrores = true;
        } elseif(!$baseDatos->checkEmail($email)) {
            $error = $this->errores['noRegistrado'];
            $hayErrores = true;
        }

        if($hayErrores){
            return $error;
        } else {
            return false;
        }
    }

    public function validatePassword($contrasenia, $contraseniaConfirmar){
        $contrasenia = trim($contrasenia);
        $contraseniaConfirmar = trim($contraseniaConfirmar);
        $hayErrores = false;

        if($contrasenia == ""){
            $hayErrores = true;
            $errorContrasenia = $this->errores['completar'];
        } elseif(strlen($contrasenia) < 6 ) {
            $hayErrores = true;
            $errorContrasenia = $this->errores['corta'];
        } elseif($contrasenia != $contraseniaConfirmar){
            $hayErrores = true;
            $errorContrasenia = $this->errores['coinciden'];
        }

        if($hayErrores){
            return $errorContrasenia;
        } else {
            return false;
        }
    }

    public function validateRespuestaSeguridad($dato){
        $respuestaSeguridad = trim($dato);
        $hayErrores = false;

        if($respuestaSeguridad == "") {
            $errorPregunta = "* Tu respuesta no puede estar vacia";
            $hayErrores = true;
        } else if(!password_verify($respuestaSeguridad,     $_SESSION['usuarioInfo']['respuestaSeguridad'])) {
            $errorPregunta = "Respuesta incorrecta";
            $hayErrores = true;
        }

        if($hayErrores){
            return $errorPregunta;
        } else {
            return false;
        }
    }

}
