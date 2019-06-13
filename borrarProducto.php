<?php
    require_once('loader.php');

    if($_GET) {
        $producto = new Producto();
        $etapa = 'producto';
        // $consulta = "SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id WHERE productos.id =?";
        //
        // $consultaProducto = $conex->prepare($consulta);
        // $consultaProducto->bindValue(1, $_GET['id'], PDO::PARAM_STR);
        // $consultaProducto->execute();
        // $producto= $consultaProducto->fetch(PDO::FETCH_ASSOC);
        $productoRecuperado = $producto->getByID($_GET['id']);
        $errorPrincipal = "";

        if($_POST){
            /*Si le dan borrar, entonces borralo, sino llevalos de nuevo a la pantalla de listas de productos.*/
            $product_id = $_POST['borrarProducto'];
            $fotoNombre = $producto->getInfoEspecifica($product_id, 'foto');
            $borrar = $producto->delete($product_id);
            if($borrar){
                $errorPrincipal = $borrar;
            } else {
                $borrarFoto = unlink("img/productos/".$fotoNombre);
                // header('location:confirmacion-borrado.php');
                $etapa = 'borrado';
                // echo "<script type='text/javascript'>document.location.href='confirmacion-borrado.php';</script>";
                // echo '<META HTTP-EQUIV="refresh" content="0;URL=confirmacion-borrado.php">';
                // exit;
            }

        }
    } else {
        $etapa = 'error';
    }
    /*Header*/
    $CSS = ['lista-productos'];
    require_once("partials/header.php");
?>
<main class="main-container">

<?php if($etapa == 'error'):?>
    <section class="productos">
        <div class="titulo-seccion">
            <h2>Hubo un problema</h2>
        </div>
        <a href="lista-productos.php">
            <button class="cancelar-button" type="button" name="">Volver</button>
        </a>
    </section>
<?php endif; ?>

<?php if($etapa == 'producto'):?>
    <section class="productos">
        <span class="error-form"><?=$errorPrincipal?></span>
        <div class="titulo-seccion">
            <h2>¿Realmente queres borrar este producto?</h2>
        </div>

        <article class="producto">
            <div class="p-imagen">
                <img src="img/productos/<?=$productoRecuperado["foto"]?>" alt="<?=$productoRecuperado["nombre"]?>">
            </div>
            <div class="producto-texto">
                <h3><?=$productoRecuperado["nombre"]?></h3>
                <p><?=$productoRecuperado['descripcion']?></p>
            </div>
            <div class="producto-texto">
                <h4>Estado:</h4><p><?=$productoRecuperado['estado']?></p>
                <h4>Categoria:</h4><p><?=$productoRecuperado['categoria']?></p>
                <h4>Tipo de Producto:</h4><p><?=$productoRecuperado['tipoProducto']?></p>
            </div>
            <div class="producto-boton">
                <h4>Precio:</h4><p>
                <p class="precio">$<?=$productoRecuperado["precio"]?></p>
                <form action="" method="post">
                    <button class="borrar-button" type="submit" name="borrarProducto" value="<?=$_GET['id']?>">Borrar</button>
                </form>
                <a href="lista-productos.php">
                    <button class="cancelar-button" type="button">Volver</button>
                </a>
            </div>
        </article>
    </section>
<?php endif; ?>


<?php if($etapa == 'borrado'):?>
    <section class="productos">
        <div class="titulo-seccion">
            <h2>El producto ha sido borrado correctamente</h2>
        </div>
        <a href="lista-productos.php">
            <button class="cancelar-button" type="button" name="">Volver</button>
        </a>
    </section>
<?php endif; ?>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
