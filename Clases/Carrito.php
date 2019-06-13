<?php

    class Carrito {

        public function crearCarrito($email){
            if(!$this->getCarrito_id($email)){
                    global $conex;
                    $user_id = $this->getInfoEspecificaUsuario($email, 'id');
                    $crear = $conex->prepare("INSERT INTO carritos(usuario_id) VALUES (?)");
                    $crear->bindValue(1, $user_id, PDO::PARAM_STR);
                    $crear->execute();
            } else {
                return false;
            }
        }

        public function getCarrito_id($email){
            global $conex;
            $consulta = $conex->prepare("SELECT carritos.id FROM carritos INNER JOIN usuarios ON carritos.usuario_id = usuarios.id WHERE usuarios.email=?");
            $consulta->bindValue(1, $email, PDO::PARAM_STR);
            $consulta->execute();
            $dato = $consulta->fetch(PDO::FETCH_ASSOC);
            return $dato['id'];
        }

        public function updateCarritoDireccion($email, $dato){
            global $conex;
            $carrito_id = $this->getCarrito_id($email);
            $update = $conex->prepare("UPDATE carritos SET direccionEnvio = ? WHERE id = $carrito_id");
            $update->bindValue(1, $dato, PDO::PARAM_STR);
            $update->execute();

            if(!$update) {
                return "* Oops! Hubo un problema";
            } else {
                return false;
            }
        }

        /*Es para agregar algo a la tabla carrito_producto*/
        public function agregarACarrito($producto_id, $cantidad, $email){
            global $conex;
            $carrito_id = $this->getCarrito_id($email);

            if($this->checkProductoRepetido($producto_id, $email)){
                // $update = $conex->prepare("UPDATE carrito_producto SET cantidad WHERE carrito_id = $carrito_id AND producto_id = $producto_id");
                // $update->bindValue(1, $cantidad, PDO::PARAM_INT);
                // $update->execute();
            } else {
                $crear = $conex->prepare("INSERT INTO carrito_producto(producto_id, carrito_id, cantidad) VALUES (?, ?, ?)");
                $crear->bindValue(1, $producto_id, PDO::PARAM_INT);
                $crear->bindValue(2, $carrito_id, PDO::PARAM_INT);
                $crear->bindValue(3, $cantidad, PDO::PARAM_INT);
            }

        }

        /*Es para modificar la cantidad de algo que ya esta en la tabla carrito_producto*/
        public function updateCantidad($producto_id, $cantidad, $email){
            global $conex;
            $carrito_id = $this->getCarrito_id($email);
            $update = $conex->prepare("UPDATE carrito_producto SET cantidad WHERE carrito_id = $carrito_id AND producto_id = $producto_id");
            $update->bindValue(1, $cantidad, PDO::PARAM_INT);
            $update->execute();

            if(!$update) {
                return "* Oops! Hubo un problema";
            } else {
                return false;
            }
        }

        /*No se si esta funcion es necesaria o no. En teoria, seria para chequear que si lo que el usuario quiere agregar al carrito, ya esta... de verdadero.*/
        public function checkProductoRepetido($producto_id, $email){
            $carrito_id = $this->getCarrito_id($email);
            $consulta = $conex->query("SELECT * FROM carrito_producto WHERE producto_id = $producto_id AND carrito_id = $carrito_id");
            $dato = $consulta->fetch(PDO::FETCH_ASSOC);

            if($dato){
                return true;
            } else {
                return false;
            }
        }
