<?php

    class Producto {

        public function create($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion, $foto){
            global $conex;

            $nombreArchivo = $foto["name"];
            $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
            $origen = $foto["tmp_name"];
            $fotoNombre = rand(1,99)."-$nombre.$ext";
            $destino = "img/productos/";
            $destino = $destino.$fotoNombre;
            move_uploaded_file($origen,$destino);

            $crear = $conex->prepare("INSERT INTO productos(nombre, precio, categoria_id, estado_id, tipoproducto_id, descripcion, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $crear->bindValue(1, $nombre, PDO::PARAM_STR);
            $crear->bindValue(2, $precio, PDO::PARAM_INT);
            $crear->bindValue(3, $categoria, PDO::PARAM_INT);
            $crear->bindValue(4, $estado, PDO::PARAM_INT);
            $crear->bindValue(5, $tipoProducto, PDO::PARAM_INT);
            $crear->bindValue(6, $descripcion, PDO::PARAM_STR);
            $crear->bindValue(7, $fotoNombre, PDO::PARAM_STR);
            $crear->execute();

            if(!$crear) {
                return "* Oops! Hubo un problema. Proba subir el producto de nuevo";
            } else {
                return false;
            }
        }

        // public function insertFoto($producto_id, $foto){
        //     global $conex;
        //     $nombre = $this->getInfoEspecifica($producto_id, 'nombre');
        //     /*SUBIR FOTO a carpeta productos*/
        //     $nombreArchivo = $foto["name"];
        //     $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        //     $origen = $foto["tmp_name"];
        //     $fotoNombre = rand(1,99)."-$nombre.$ext";
        //     $destino = "img/productos/";
        //     $destino = $destino.$fotoNombre;
        //     move_uploaded_file($origen,$destino);
        //
        //     $update = $conex->prepare("UPDATE productos SET foto WHERE id = $producto_id");
        //     $update->bindValue(1, $fotoNombre, PDO::PARAM_STR);
        //     $update->execute();
        //     if($update){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }

        /*UPDATE*/
        public function update($product_id, $nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion){
            global $conex;
            $update = $conex->prepare("UPDATE productos SET categoria_id=:categoria, tipoproducto_id=:tipoproducto, estado_id=:estado, descripcion=:descripcion, nombre=:nombre, precio=:precio WHERE id = :id");
            $update->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $update->bindValue(':precio', $precio, PDO::PARAM_INT);
            $update->bindValue(':categoria', $categoria, PDO::PARAM_INT);
            $update->bindValue('estado', $estado, PDO::PARAM_INT);
            $update->bindValue('tipoproducto', $tipoProducto, PDO::PARAM_INT);
            $update->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
            $update->bindValue(':id', $producto_id, PDO::PARAM_INT);
            $update->execute();

            if($update){
                return false;
            } else {
                return '* Hubo un problema con la subida';
            }
        }

        public function updatePicture($product_id, $fotoNombre,$foto){
            global $conex;
            move_uploaded_file($foto["tmp_name"],"img/productos/".$fotoNombre);

            $update = $conex->prepare("UPDATE productos SET foto=:foto WHERE id = :id");
            $update->bindValue(':foto', $fotoNombre, PDO::PARAM_STR);
            $update->bindValue(':id', $producto_id, PDO::PARAM_INT);
            $update->execute();

            if(!$update){
                return "* Oops! Hubo un problema al subir la foto";
            } else {
                return false;
            }
        }

        /*GET*/
        public function getInfoEspecifica($producto_id, $indice){
            global $conex;
            $consulta = $conex->prepare("SELECT $indice FROM productos WHERE id = :id");
            // $consulta->bindValue(':indice', $indice, PDO::PARAM_STR);
            $consulta->bindValue(':id', $producto_id, PDO::PARAM_INT);
            $consulta->execute();
            $data= $consulta->fetch(PDO::FETCH_ASSOC);
            return $data[$indice];
        }

        public function getByID($product_id){
              global $conex;
              $consulta = $conex->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', tipoProductos.id AS 'tipoproducto_id', categorias.nombre AS 'categoria', categorias.id AS 'categoria_id', estados.nombre AS 'estado', estados.id AS 'estado_id' FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id WHERE productos.id =?");
              $consulta->bindValue(1, $product_id, PDO::PARAM_STR);
              $consulta->execute();
              $producto = $consulta->fetch(PDO::FETCH_ASSOC);
              return $producto;
        }

        public function getAll(){
            global $conex;
            $consulta = $conex->query("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id");
            $consulta->execute();
            $listaProductos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }

        public function searchByTitle($palabra){
            global $conex;
            $consulta = $conex->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id WHERE productos.nombre LIKE '%a%' OR productos.descripcion LIKE '%?%'");
            $consulta->bindValue(1, $palabra, PDO::PARAM_STR);
            $consulta->execute();
            $listaProductos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        }

        /*BORRAR*/
        public function delete($producto_id){
            global $conex;
            $borrar = $conex->query("DELETE FROM productos WHERE id = ".$producto_id);
            $borrar->execute();
            if(!$borrar){
                return 'Hubo un problema, no se pudo completar la operación.';
            }
        }
    }
