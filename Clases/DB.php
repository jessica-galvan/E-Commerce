<?php
/*Esta clase es para hacer ABM de la base de datos, recuperar info de la base de datos y veirifcar la contraseña y la respuesta de seguridad. No tiene atributos*/
Class DB {
    private $user;
    private $pass;
    private $database;
    private $conex;

    public function __construct($database, $user, $pass){
        $this->conex = new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8mb4;port=3306', $user, $pass);
    }

    public function getConex(){
        return $this->conex;
    }

    /*---------SECCION USUARIOS---------*/
    // public function createUser($nombre, $apellido, $email, $contrasenia, $preguntaSeguridad, $respuestaSeguridad, $perfil_id){
    //     $crearUsuario = $this->conex->prepare("INSERT INTO usuarios(nombre, apellido, email, contrasenia, preguntaSeguridad, respuestaSeguridad, perfil_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //     $crearUsuario->bindValue(1, $nombre, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(2, $apellido, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(3, $email, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(4, $contrasenia, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(5, $preguntaSeguridad, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(6, $respuestaSeguridad, PDO::PARAM_STR);
    //     $crearUsuario->bindValue(7, $perfil_id, PDO::PARAM_INT);
    //     $crearUsuario->execute();
    //
    //     if(!$crearUsuario) {
    //         return "* Oops! Hubo un problema. Proba registrarte de nuevo.";
    //     } else {
    //         return false;
    //     }
    // }
    //
    /*VERIFY*/
    // public function verifyPassword($email, $contrasenia){
    //     global $validator;
    //     $listaErrores = $validator->getErrores();
    //     $contrasenia = trim($contrasenia);
    //
    //     if($contrasenia == ""){
    //         $errores = $listaErrores['completar'];
    //     } elseif($this->checkEmail($email)){ /*COMPARAR CONTRASEÑAS*/
    //         $contraseniaOficial = $this->getInfoEspecificaUsuario($email, 'contrasenia');
    //         if(password_verify($contrasenia, $contraseniaOficial)) {
    //             return false;
    //         } else {
    //             $errores = $listaErrores['contraseña'];
    //         }
    //     }
    //     return $errores;
    // }
    //
    // public function verifyRespuestaSeguridad($email, $dato){
    //     global $validator;
    //     $listaErrores = $validator->getErrores();
    //     $respuestaSeguridad = trim($dato);
    //     $respuestaOficial = $this->getInfoEspecificaUsuario($email, 'respuestaSeguridad');
    //
    //     if($respuestaSeguridad == "") {
    //         $errorPregunta = $listaErrores['completar'];
    //     } elseif(!password_verify($respuestaSeguridad, $respuestaOficial)) {
    //         $errorPregunta = "Respuesta incorrecta";
    //     }
    //
    //     if(isset($errorPregunta)){
    //         return $errorPregunta;
    //     } else {
    //         return false;
    //     }
    // }
    //
    /*UPDATE*/
    // public function updateUsuario($email, $indice, $data){
    //     global $conex;
    //     $usuarioID = $this->getInfoEspecificaUsuario($email, 'id');
    //
    //     $modificarUsuario = $conex->prepare("UPDATE usuarios SET $indice =:$indice WHERE id = $usuarioID");
    //     $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
    //     $modificarUsuario->execute();
    //
    //     if(!$modificarUsuario) {
    //         return "* Oops! Hubo un problema";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // public function updateAvatar($email, $imagen){
    //     global $conex;
    //     $perfil_id = $this->getInfoEspecificaUsuario($email, 'perfil_id');
    //     $usuario_id = $this->getInfoEspecificaUsuario($email, 'id');
    //
    //     $nombreArchivo = $imagen["name"];
    //     $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
    //     $origen = $imagen["tmp_name"];
    //
    //     /*Esto busca donde esta el @ en el sting de $email.*/
    //     $separar = strpos($email, '@');
    //     /*Y acá. utilizando la posicion del @, separo en un array numerico -del email hasta el @ en posicion 0 y el resto en posicion 1. */
    //     $divido  = str_split($email, $separar);
    //     /*Y aca armo el nombre del archivo. Incluye el ID del usuario, la primera aprte del mail y -avatar, junto con su extension. Este nombre es lo que va a subirse a la base de datos, perfles-fotoPerfil*/
    //     $fotoNombre = "$usuario_id-$divido[0]-avatar.$ext";
    //
    //     $destino = "img/user-avatar/";
    //     $destino = $destino.$fotoNombre;
    //     move_uploaded_file($origen,$destino);
    //
    //     $this->updatePerfil($email, 'fotoPerfil', $fotoNombre);
    // }
    //
    // public function updatePerfil($email, $indice, $data){
    //     global $conex;
    //     $perfil_id = $this->getInfoEspecificaUsuario($email, 'perfil_id');
    //
    //     $modificarUsuario = $conex->prepare("UPDATE perfiles SET $indice =:$indice WHERE id = $perfil_id");
    //     $modificarUsuario->bindValue($indice, $data, PDO::PARAM_STR);
    //     $modificarUsuario->execute();
    //
    //     if(!$modificarUsuario) {
    //         return "* Oops! Hubo un problema";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // /*Chequear en base de datos si ese email esta registrado*/
    // public function checkEmail($email){
    //       global $conex;
    //       $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
    //       $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
    //       $consultaUsuarios->execute();
    //       $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
    //
    //       if($usuario){
    //           return true;
    //       }
    //   }
    //
    // /*GETTERS*/
    // public function getUser($email){
    //       global $conex;
    //       $consultaUsuarios = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
    //       $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
    //       $consultaUsuarios->execute();
    //       $usuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
    //       return $usuario;
    // }
    //
    // public function getInfoEspecificaUsuario($email, $indice){
    //     global $conex;
    //     $consultaUsuarios = $conex->prepare("SELECT $indice FROM usuarios WHERE email = ?");
    //     $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
    //     $consultaUsuarios->execute();
    //     $data= $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
    //     return $data[$indice];
    // }
    //
    // public function getUserPerfil($email){
    //       global $conex;
    //       $consulta = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, perfiles.id AS 'perfil_id', perfiles.fechaNacimiento, perfiles.fotoPerfil, perfiles.tipoDePiel, perfiles.tonoDePiel, perfiles.genero, perfiles.provincia FROM usuarios INNER JOIN perfiles ON usuarios.perfil_id = perfiles.id WHERE usuarios.email = ?";
    //       $consultaUsuarios = $conex->prepare($consulta);
    //       $consultaUsuarios->bindValue(1, $email, PDO::PARAM_STR);
    //       $consultaUsuarios->execute();
    //       $dato = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);
    //
    //       return $dato;
    // }

    /*---------SECCION PRODUCTOS---------*/
    // public function createProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion, $foto){
    //     global $conex;
    //     /*SUBIR FOTO a carpeta productos*/
    //     $nombreArchivo = $foto["name"];
    //     $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
    //     $origen = $foto["tmp_name"];
    //     $fotoNombre = rand(1,99)."-$nombre.$ext";
    //     $destino = "img/productos/";
    //     $destino = $destino.$fotoNombre;
    //     move_uploaded_file($origen,$destino);
    //
    //     $crearProducto = $conex->prepare("INSERT INTO productos(nombre, precio, categoria_id, estado_id, tipoproducto_id, foto, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //
    //     $crearProducto->bindValue(1, $nombre, PDO::PARAM_STR);
    //     $crearProducto->bindValue(2, $precio, PDO::PARAM_INT);
    //     $crearProducto->bindValue(3, $categoria, PDO::PARAM_INT);
    //     $crearProducto->bindValue(4, $estado, PDO::PARAM_INT);
    //     $crearProducto->bindValue(5, $tipoProducto, PDO::PARAM_INT);
    //     $crearProducto->bindValue(6, $fotoNombre, PDO::PARAM_STR);
    //     $crearProducto->bindValue(7, $descripcion, PDO::PARAM_STR);
    //     $crearProducto->execute();
    //
    //     if(!$crearProducto) {
    //         return "* Oops! Hubo un problema. Proba registrarte de nuevo.";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // /*UPDATE*/
    // public function updateProduct($product_id, $nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion){
    //     global $conex;
    //     $update = $conex->prepare("UPDATE productos SET categoria_id=:categoria, tipoproducto_id=:tipoproducto, estado_id=:estado, descripcion=:descripcion, nombre=:nombre, precio=:precio WHERE id = $product_id");
    //     $update->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    //     $update->bindValue(':precio', $precio, PDO::PARAM_INT);
    //     $update->bindValue(':categoria', $categoria, PDO::PARAM_INT);
    //     $update->bindValue('estado', $estado, PDO::PARAM_INT);
    //     $update->bindValue('tipoproducto', $tipoProducto, PDO::PARAM_INT);
    //     $update->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    //     $update->execute();
    //
    //     if($update){
    //         return false;
    //     } else {
    //         return '* Hubo un problema con la subida';
    //     }
    // }
    //
    // public function updateProductPicture($product_id, $fotoNombre,$foto){
    //     global $conex;
    //     move_uploaded_file($foto["tmp_name"],"img/productos/".$fotoNombre);
    //
    //     $update = $conex->prepare("UPDATE productos SET foto=:foto WHERE id = $product_id");
    //     $update->bindValue(':foto', $fotoNombre, PDO::PARAM_STR);
    //     $update->execute();
    //
    //     if(!$update){
    //         return "* Oops! Hubo un problema al subir la foto";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // /*GET*/
    // public function getInfoEspecificaProducto($producto_id, $indice){
    //     global $conex;
    //     $consulta = $conex->prepare("SELECT $indice FROM productos WHERE id = ?");
    //     $consulta->bindValue(1, $producto_id, PDO::PARAM_INT);
    //     $consulta->execute();
    //     $data= $consulta->fetch(PDO::FETCH_ASSOC);
    //     return $data[$indice];
    // }
    //
    // public function getProduct($product_id){
    //       global $conex;
    //       $consulta = $conex->prepare("SELECT * FROM productos WHERE id = ?");
    //       $consulta->bindValue(1, $product_id, PDO::PARAM_STR);
    //       $consulta->execute();
    //       $producto = $consulta->fetch(PDO::FETCH_ASSOC);
    //       return $producto;
    // }
    //
    // /*BORRAR*/
    // public function deleteProduct($producto_id){
    //     global $conex;
    //
    //     $borrar = $conex->query("DELETE FROM productos WHERE id = $producto_id");
    //     $borrar->bindValue(1, PDO::PARAM_INT);
    //     $borrar->execute();
    //
    //     if(!$borrar){
    //         return 'Hubo un problema, no se pudo completar la operación.';
    //     }
    // }

    // /*---------SECCION CARRITO---------*/
    // public function crearCarrito($email){
    //     if(!$this->getCarrito_id($email)){
    //             global $conex;
    //             $user_id = $this->getInfoEspecificaUsuario($email, 'id');
    //             $crear = $conex->prepare("INSERT INTO carritos(usuario_id) VALUES (?)");
    //             $crear->bindValue(1, $user_id, PDO::PARAM_STR);
    //             $crear->execute();
    //     } else {
    //         return false;
    //     }
    // }
    //
    // public function getCarrito_id($email){
    //     global $conex;
    //     $consulta = $conex->prepare("SELECT carritos.id FROM carritos INNER JOIN usuarios ON carritos.usuario_id = usuarios.id WHERE usuarios.email=?");
    //     $consulta->bindValue(1, $email, PDO::PARAM_STR);
    //     $consulta->execute();
    //     $dato = $consulta->fetch(PDO::FETCH_ASSOC);
    //     return $dato['id'];
    // }
    //
    // public function updateCarritoDireccion($email, $dato){
    //     global $conex;
    //     $carrito_id = $this->getCarrito_id($email);
    //     $update = $conex->prepare("UPDATE carritos SET direccionEnvio = ? WHERE id = $carrito_id");
    //     $update->bindValue(1, $dato, PDO::PARAM_STR);
    //     $update->execute();
    //
    //     if(!$update) {
    //         return "* Oops! Hubo un problema";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // /*Es para agregar algo a la tabla carrito_producto*/
    // public function agregarACarrito($producto_id, $cantidad, $email){
    //     global $conex;
    //     $carrito_id = $this->getCarrito_id($email);
    //
    //     if($this->checkProductoRepetido($producto_id, $email)){
    //         // $update = $conex->prepare("UPDATE carrito_producto SET cantidad WHERE carrito_id = $carrito_id AND producto_id = $producto_id");
    //         // $update->bindValue(1, $cantidad, PDO::PARAM_INT);
    //         // $update->execute();
    //     } else {
    //         $crear = $conex->prepare("INSERT INTO carrito_producto(producto_id, carrito_id, cantidad) VALUES (?, ?, ?)");
    //         $crear->bindValue(1, $producto_id, PDO::PARAM_INT);
    //         $crear->bindValue(2, $carrito_id, PDO::PARAM_INT);
    //         $crear->bindValue(3, $cantidad, PDO::PARAM_INT);
    //     }
    //
    // }
    //
    // /*Es para modificar la cantidad de algo que ya esta en la tabla carrito_producto*/
    // public function updateCantidad($producto_id, $cantidad, $email){
    //     global $conex;
    //     $carrito_id = $this->getCarrito_id($email);
    //     $update = $conex->prepare("UPDATE carrito_producto SET cantidad WHERE carrito_id = $carrito_id AND producto_id = $producto_id");
    //     $update->bindValue(1, $cantidad, PDO::PARAM_INT);
    //     $update->execute();
    //
    //     if(!$update) {
    //         return "* Oops! Hubo un problema";
    //     } else {
    //         return false;
    //     }
    // }
    //
    // /*No se si esta funcion es necesaria o no. En teoria, seria para chequear que si lo que el usuario quiere agregar al carrito, ya esta... de verdadero.*/
    // public function checkProductoRepetido($producto_id, $email){
    //     $carrito_id = $this->getCarrito_id($email);
    //     $consulta = $conex->query("SELECT * FROM carrito_producto WHERE producto_id = $producto_id AND carrito_id = $carrito_id");
    //     $dato = $consulta->fetch(PDO::FETCH_ASSOC);
    //
    //     if($dato){
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
