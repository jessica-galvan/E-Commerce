<?php

    class Usuario {

        public function create($nombre, $apellido, $email, $contrasenia, $preguntaSeguridad, $respuestaSeguridad){
            global $conex;
            /*Primero creo el perfil, asi obtengo el ID de esa y se lo puedo agregar al perfil_id en la tabla usuario*/
            $crearPerfil = $conex->query("INSERT INTO perfiles (id) VALUES (null)");
            $perfil_id = $conex->lastInsertId();

            /*Segundo: Hasheo*/
            $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
            $respuestaSeguridad = password_hash($respuestaSeguridad, PASSWORD_DEFAULT);

            /*Tercero: creo el usuario en la base de datos*/
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

            if($contrasenia == ""){
                $errores = $listaErrores['completar'];
            } elseif($this->checkEmail($email)){ /*COMPARAR CONTRASEÑAS*/
                $contraseniaOficial = $this->getInfoEspecifica($email, 'contrasenia');
                if(password_verify($contrasenia, $contraseniaOficial)) {
                    return false;
                } else {
                    $errores = $listaErrores['contraseña'];
                }
            }
            return $errores;
        }

        public function verifyRespuestaSeguridad($email, $dato){
            global $validator;
            $listaErrores = $validator->getErrores();
            $respuestaSeguridad = trim($dato);
            $respuestaOficial = $this->getInfoEspecifica($email, 'respuestaSeguridad');

            if($respuestaSeguridad == "") {
                $errorPregunta = $listaErrores['completar'];
            } elseif(!password_verify($respuestaSeguridad, $respuestaOficial)) {
                $errorPregunta = "Respuesta incorrecta";
            }

            if(isset($errorPregunta)){
                return $errorPregunta;
            } else {
                return false;
            }
        }

        /*UPDATE*/
        public function updateUsuario($email, $indice, $data){
            global $conex;
            $usuarioID = $this->getInfoEspecifica($email, 'id');

            $modificarUsuario = $conex->prepare("UPDATE usuarios SET $indice =:$indice WHERE id = $usuarioID");
            $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
            $modificarUsuario->execute();

            if(!$modificarUsuario) {
                return "* Oops! Hubo un problema";
            } else {
                return false;
            }
        }

        public function updateAvatar($email, $imagen){
            global $conex;
            $perfil_id = $this->getInfoEspecifica($email, 'perfil_id');
            $usuario_id = $this->getInfoEspecifica($email, 'id');

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
            move_uploaded_file($origen,$destino);

            $subir = $this->updatePerfil($email, 'fotoPerfil', $fotoNombre);
            if(!$subir) {
                return false;
            } else {
                return "* Oops! Hubo un problema1";
            }
        }

        public function updatePerfil($email, $indice, $data){
            global $conex;
            $perfil_id = $this->getInfoEspecifica($email, 'perfil_id');

            $modificarUsuario = $conex->prepare("UPDATE perfiles SET $indice =:$indice WHERE id = $perfil_id");
            $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
            $modificarUsuario->execute();

            if(!$modificarUsuario) {
                return "* Oops! Hubo un problema";
            } else {
                return false;
            }
        }

        /*Chequear en base de datos si ese email esta registrado*/
        public function checkEmail($email){
              global $conex;
              $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
              $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
              $consultaUsuarios->execute();
              $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

              if($usuario){
                  return true;
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

        public function getInfoEspecifica($email, $indice){
            global $conex;
            $consultaUsuarios = $conex->prepare("SELECT $indice FROM usuarios WHERE email = ?");
            $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
            $consultaUsuarios->execute();
            $data= $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
            return $data[$indice];
        }

        public function getPerfil($email){
              global $conex;
              $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, perfiles.id AS 'perfil_id', perfiles.fechaNacimiento, perfiles.fotoPerfil, perfiles.tipoDePiel, perfiles.tonoDePiel, perfiles.genero, perfiles.provincia FROM usuarios INNER JOIN perfiles ON usuarios.perfil_id = perfiles.id WHERE usuarios.email = ?";
              $consultaUsuarios = $conex->prepare($consulta);
              $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
              $consultaUsuarios->execute();
              $dato = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

              return $dato;
        }






    }
