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
            'registrado' => '* Ese email ya esta registrado',
            'noRegistrado' => '* Este mail no esta registrado',
            'emailNoValido' => '* Email no valido',
            'invalidos' => "* Email o contraseña invalidas",
            'imagen' => '* Imagen no valida',
            'contraseña' => '* Contraseña incorrecta.',
            'corta' => '* La contraseña debe tener más de 6 caracteres',
            'coinciden' => '* Las contraseñas no coinciden',
        ];
    }

    public function getErrores(){
            return $this->errores;
    }

    /*SECCION USUARIOS*/
    public function registerValidate($nombre, $apellido, $email, $contrasenia, $contraseniaConfirmar, $preguntaSeguridad, $respuestaSeguridad) {
        global $baseDatos;

        /*Controlar que no este vacio*/
        if($nombre == "") {
            $error['errorNombre'] = $this->errores['completar'];
        }

        if($apellido == "") {
            $error['errorApellido'] = $this->errores['completar'];
        }
        /*Para no repetir codigo, llamo a la funcion dentro de esta clase que Valida Emails*/
        $validarEmail = $this->validateEmail($email);
        if($validarEmail){
            $error['errorEmail'] = $validarEmail;
        }
        /*Ditto, pero para contrasenia y su confirmacion*/
        $validarContrasenia = $this->validateNewPassword($contrasenia, $contraseniaConfirmar);

        if($validarContrasenia){
            $error['errorContrasenia'] = $validarContrasenia;
        }

        if ($preguntaSeguridad == ""){
            $error['errorPregunta'] =  $this->errores['seleccionar'];
        } elseif($respuestaSeguridad == ""){
            $error['errorPregunta'] = $this->errores['completar'];
        }

        if(isset($error)){
            return $error;
        } else {
            return false;
        }

    }

    public function validateLogin($basedatos, $email, $contrasenia){
      $validarEmail = $this->validateEmail($basedatos, $email);
      $validarContrasenia = $basedatos->verifyPassword($email, $contrasenia);
      if($validarEmail){
          $error['errorEmail'] = $validarEmail;
      }
      if($validarContrasenia){
          $error['errorContrasenia'] = $validarContrasenia;
      }
      if(isset($error)){
          return $error;
      } else {
          return false;
      }
    }

    public function validateEmail($basedatos, $dato){
        $email = trim($dato);

        if($email == ""){
            $error = $this->errores['completar'];
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = $this->errores['emailNoValido'];
        } elseif(!$basedatos->checkEmail($email)) {
            $error = $this->errores['noRegistrado'];
        }
        if(isset($error)){
            return $error;
        } else {
            return false;
        }
    }

    public function validateNewPassword($contrasenia, $contraseniaConfirmar){
        $contrasenia = trim($contrasenia);
        $contraseniaConfirmar = trim($contraseniaConfirmar);

        if($contrasenia == ""){
            $errorContrasenia = $this->errores['completar'];
        } elseif(strlen($contrasenia) < 6 ) {
            $errorContrasenia = $this->errores['corta'];
        } elseif($contrasenia != $contraseniaConfirmar){
            $errorContrasenia = $this->errores['coinciden'];
        }
        if(isset($errorContrasenia)){
            return $errorContrasenia;
        } else {
            return false;
        }
    }

    public function imageValidate($file) {
        if($file["error"] === UPLOAD_ERR_OK){
            $foto = getimagesize($file['tmp_name']);
            $image_type = $foto[2];
            if(in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
                return false;
            }

            if(in_array($image_type, array(1, 2, 3, 6))){
                return false;
            }
            return $this->errores['imagen'];
        } else {
            return '* Se produjo un error';
        }
    }

    /*SECCION PRODUCTOS*/
    public function validateProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion){
        $validar = $this->validateProductoEdicion($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion);
        if($validar){
            $error = $validar;
        }

        $validarFoto = $this->imageValidate($foto);
        if($validarFoto) {
            $error['errorFoto'] = $validarFoto;
        }

        if(isset($error)){
            return $error;
        } else {
            return false;
        }
    }

    public function validateProductoEdicion($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion){
      if($nombre == "") {
          $error['error_nombre'] = $this->errores['completar'];
      }
      if($precio == "") {
          $error['error_precio'] = $this->errores['completar'];
      }
      if($descripcion == "") {
          $error['error_precio'] = $this->errores['completar'];
      }
      if($categoria == "") {
          $error['error_categoria'] = $this->errores['completar'];
      }
      if($estado == "") {
          $error['error_estado'] = $this->errores['completar'];
      }
      if($tipoProducto == "") {
          $error['error_tipoProducto'] = $this->errores['completar'];
      }

      if(isset($error)){
          return $error;
      } else {
          return false;
      }

    }
}
