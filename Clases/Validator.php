<?php

/*Esta clase es para validar cosas: Registro, Login y Imagenes. O hasta campos especificos como Contraseñas, Respuestas de Seguridad, e Emails.*/
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
            'invalidos' => "* Email o contraseña invalidas",
            'imagen' => '* Imagen no valida',
        ];
    }

    public function getErrores(){
            return $this->errores;
    }

    /*SECCION USUARIOS*/
    public function registerValidate($nombre, $apellido, $email, $contrasenia, $contraseniaConfirmar, $preguntaSeguridad, $respuestaSeguridad) {
        global $baseDatos;
        $hayErrores = false;

        /*Controlar que no este vacio*/
        if($nombre == "") {
            $error['errorNombre'] = $this->errores['completar'];
            $hayErrores = true;
        }

        if($apellido == "") {
            $error['errorApellido'] = $this->errores['completar'];
            $hayErrores = true;
        }

        if($email == ""){
            $error['errorEmail'] = $this->errores['completar'];
            $hayErrores = true;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            /*que sea un email valido*/
            $error['errorEmail'] = $this->errores['emailNoValido'];
            $hayErrores = true;
        } elseif($baseDatos->checkEmail($email)) {
            /*Controlamos que no este ya registrado*/
            $error['errorEmail'] = $this->errores['registrado'];
            $hayErrores = true;
        }

        if($contrasenia == ""){
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['completar'];
        } elseif(strlen($contrasenia) < 6 ) {
            /*largo de la contraseña*/
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['corta'];
        } elseif($contrasenia != $contraseniaConfirmar){
            /*que coincidan*/
            $hayErrores = true;
            $error['errorContrasenia'] = $this->errores['coinciden'];
        }

        if ($preguntaSeguridad == ""){
            $hayErrores = true;
            $error['errorPregunta'] =  $this->errores['seleccionar'];
        } elseif($respuestaSeguridad == ""){
            $hayErrores = true;
            $error['errorPregunta'] = $this->errores['completar'];
        }

        if($hayErrores){
            return $error;
        } else {
            return false;
        }

    }

    public function validateLogin($email, $contrasenia){
      global $baseDatos;
      $validarEmail = $this->validateEmail($email);
      $validarContrasenia = $baseDatos->verifyPassword($email, $contrasenia);
      if($validarEmail){
          $errores['errorEmail'] = $validarEmail;
      }
      if($validarContrasenia){
          $errores['errorContrasenia'] = $validarContrasenia;
      }
      if(isset($errores)){
          return $errores;
      } else {
          return false;
      }
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

    public function validateNewPassword($contrasenia, $contraseniaConfirmar){
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

    public function imageValidate($file) {
        if($file["error"] === UPLOAD_ERR_OK){
            $foto = getimagesize($file['tmp_name']);
            $image_type = $foto[2];

            if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))) {
                return true;
            }
            return false;
        }
    }

    /*SECCION PRODUCTOS*/
    public function validateProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion){
        global $baseDatos;

        if($nombre == "") {
            $error['errorNombre'] = $this->errores['completar'];
        }

        if($precio == "") {
            $error['errorPrecio'] = $this->errores['completar'];
        }

        if($descripcion == "") {
            $error['errorPrecio'] = $this->errores['completar'];
        }

        if($categoria == "") {
            $error['errorCategoria'] = $this->errores['completar'];
        }

        if($estado == "") {
            $error['errorEstado'] = $this->errores['completar'];
        }

        if($tipoProducto == "") {
            $error['errorTipoProducto'] = $this->errores['completar'];
        }

        $validarFoto = !$this->imageValidate($foto);
        if($validarFoto) {
            $error['errorFoto'] = $this->errores['imagen'];
        }

        if(isset($error)){
            return $error;
        } else {
            return false;
        }



    }
}
