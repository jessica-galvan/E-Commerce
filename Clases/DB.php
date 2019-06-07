<?php
/*Esta clase es para obtener y manipular info de la base de Datos, desde obtener info con los gets, cambiar cosas y hasta controlar el login*/
Class DB {

    /*---------SECCION USUARIOS---------*/
    public function createUser($nombre, $apellido, $email, $contrasenia, $preguntaSeguridad, $respuestaSeguridad, $perfil_id){
        global $conex;
        $crearUsuario = $conex->prepare("INSERT INTO usuarios(nombre, apellido, email, contrasenia, preguntaSeguridad, respuestaSeguridad, perfil_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $crearUsuario->bindValue(1, $nombre, PDO::PARAM_STR);
        $crearUsuario->bindValue(2, $apellido, PDO::PARAM_STR);
        $crearUsuario->bindValue(3, $email, PDO::PARAM_STR);
        $crearUsuario->bindValue(4, $contrasenia, PDO::PARAM_STR);
        $crearUsuario->bindValue(5, $preguntaSeguridad, PDO::PARAM_STR);
        $crearUsuario->bindValue(6, $respuestaSeguridad, PDO::PARAM_STR);
        $crearUsuario->bindValue(7, $perfil_id, PDO::PARAM_INT);
        $crearUsuario->execute();

        if(!$crearUsuario) {
            return "* Oops! Hubo un problema. Proba registrarte de nuevo.";
        } else {
            return false;
        }
    }

    /*VERIFY*/
    public function verifyPassword($email, $contrasenia){
        global $validator;
        $listaErrores = $validator->getErrores();
        $contrasenia = trim($contrasenia);
        $hayErrores = false;

        if($contrasenia == ""){
            $errores = $listaErrores['completar'];
            $hayErrores = true;
        } elseif($this->checkEmail($email)){ /*COMPARAR CONTRASEÑAS*/
            $contraseniaOficial = $this->getInfoEspecificaUsuario($email, 'contrasenia');
            if(password_verify($contrasenia, $contraseniaOficial)) {
                $hayErrores = false;
            } else {
                $hayErrores = true;
                $errores = '* Contraseña incorrecta.';
            }
        }

        if($hayErrores){
            return $errores;
        } else {
            return false;
        }
    }

    public function verifyRespuestaSeguridad($email, $dato){
        $respuestaSeguridad = trim($dato);
        $hayErrores = false;
        $respuestaOficial = $this->getInfoEspecificaUsuario($email, 'respuestaSeguridad');

        if($respuestaSeguridad == "") {
            $errorPregunta = "* Tu respuesta no puede estar vacia";
            $hayErrores = true;
        } elseif(!password_verify($respuestaSeguridad, $respuestaOficial)) {
            $errorPregunta = "Respuesta incorrecta";
            $hayErrores = true;
        }

        if($hayErrores){
            return $errorPregunta;
        } else {
            return false;
        }
    }

    /*Cambiar datos*/
    public function updateUsuario($email, $indice, $data){
        global $conex;
        $usuarioID = $this->getInfoEspecificaUsuario($email, 'id');

        $modificarUsuario = $conex->prepare("UPDATE usuarios SET $indice =:$indice WHERE id = $usuarioID");
        $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
        $modificarUsuario->execute();

        if(!$modificarUsuario) {
            return "* Oops! Hubo un problema";
        } else {
            return false;
        }
    }

    public function changeAvatar($email, $imagen){
        global $conex;
        $perfil_id = $this->getInfoEspecificaUsuario($email, 'perfil_id');
        $usuario_id = $this->getInfoEspecificaUsuario($email, 'id');

        $nombreArchivo = $imagen["name"];
        $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        $origen = $imagen["tmp_name"];

        /*Esto busca donde esta el @ en el sting de $email.*/
        $separar = strpos($email, '@');
        /*Y acá. utilizando la posicion del @, separo en un array numerico -del email hasta el @ en posicion 0 y el resto en posicion 1. */
        $divido  = str_split($email, $separar);
        /*Y aca armo el nombre del archivo. Incluye el ID del usuario, la primera aprte del mail y -avatar, junto con su extension. Este nombre es lo que va a subirse a la base de datos, perfles-fotoPerfil*/
        $fotoNombre = "$usuario_id-$divido[0]-avatar.$ext";

        $destino = "img/user-avatar/";
        $destino = $destino.$fotoNombre;
        $subir = move_uploaded_file($origen,$destino);
        move_uploaded_file($origen,$destino);

        $this->updatePerfil($email, 'fotoPerfil', $fotoNombre);
    }

    public function updatePerfil($email, $indice, $data){
        global $conex;
        $perfil_id = $this->getInfoEspecificaUsuario($email, 'perfil_id');

        $modificarUsuario = $conex->prepare("UPDATE perfiles SET $indice =:$indice WHERE id = $perfil_id");
        $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
        $modificarUsuario->execute();

        if(!$modificarUsuario) {
            // $errorContrasenia = ;
            return "* Oops! Hubo un problema";
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

    /*GETTERS*/
    public function getUser($email){
          global $conex;
          $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
          $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
          $consultaUsuarios->execute();
          $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
          return $usuario;
    }

    public function getInfoEspecificaUsuario($email, $indice){
        global $conex;
        $consultaUsuarios = $conex->prepare("SELECT $indice FROM usuarios WHERE email = ?");
        $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
        $consultaUsuarios->execute();
        $data= $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
        return $data[$indice];
    }

    public function getUserPerfil($email){
          global $conex;
          $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, perfiles.id AS 'perfil_id', perfiles.fechaNacimiento, perfiles.fotoPerfil, perfiles.tipoDePiel, perfiles.tonoDePiel, perfiles.genero, perfiles.provincia FROM usuarios INNER JOIN perfiles ON usuarios.perfil_id = perfiles.id WHERE usuarios.email = ?";
          $consultaUsuarios = $conex->prepare($consulta);
          $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
          $consultaUsuarios->execute();
          $dato = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

          return $dato;
    }

    /*---------SECCION PRODUCTOS---------*/
    public function createProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion){
        global $conex;
        $crearProducto = $conex->prepare("INSERT INTO productos(nombre, precio, categoria_id, estado_id, tipoproducto_id, foto, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $crearProducto->bindValue(1, $nombre, PDO::PARAM_STR);
        $crearProducto->bindValue(2, $precio, PDO::PARAM_INT);
        $crearProducto->bindValue(3, $categoria, PDO::PARAM_STR);
        $crearProducto->bindValue(4, $estado, PDO::PARAM_STR);
        $crearProducto->bindValue(5, $tipoProducto, PDO::PARAM_STR);
        $crearProducto->bindValue(6, $foto, PDO::PARAM_STR);
        $crearProducto->bindValue(7, $descripcion, PDO::PARAM_STR);
        $crearProducto->execute();

        if(!$crearProducto) {
            return "* Oops! Hubo un problema. Proba registrarte de nuevo.";
        } else {
            return false;
        }
    }

    public function updateProducto($producto_id, $indice, $data){
        global $conex;
        $perfil_id = $this->getInfoEspecificaUsuario($email, 'perfil_id');

        $modificarUsuario = $conex->prepare("UPDATE perfiles SET $indice =:$indice WHERE id = $perfil_id");
        $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
        $modificarUsuario->execute();

        if(!$modificarUsuario) {
            // $errorContrasenia = ;
            return "* Oops! Hubo un problema";
        } else {
            return false;
        }
    }

    public function uploadProductPicture($product_id, $imagen){
        global $conex;
        $nombre = $this->getProductoInfoEspecifica($producto_id, 'nombre');

        $nombreArchivo = $imagen["name"];
        $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        $origen = $imagen["tmp_name"];


        $fotoNombre = "$producto_id-$nombre.$ext";

        $destino = "img/productos/";
        $destino = $destino.$fotoNombre;
        $subir = move_uploaded_file($origen,$destino);
        move_uploaded_file($origen,$destino);

        $this->updateProducto($producto_id, 'foto', $fotoNombre);
    }

    public function getProductoInfoEspecifica($producto_id, $indice){
        $consulta = $conex->prepare("SELECT ? FROM productos WHERE id = ?");
        $consulta->bindValue(1, $producto_id, PDO::PARAM_STR);
        $consulta->bindValue(2, $producto_id, PDO::PARAM_INT);
        $consulta->execute();
        $data= $consulta->fetch(PDO::FETCH_ASSOC);
        return $data[$indice];
    }



}
