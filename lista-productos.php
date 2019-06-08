<?php
    require_once('loader.php');
    /*Traigo los productos en base de datos*/
    $consultaProductos = $conex->query("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id");
    $listaProductos = $consultaProductos->fetchAll(PDO::FETCH_ASSOC);


    /*Header*/
    $CSS = ['lista-productos'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <section class="productos">
        <div class="titulo-seccion">
            <h2>Lista de Productos</h2>
        </div>
        <?php foreach ($listaProductos as $producto):?>
            <article class="producto">
                <div class="p-imagen">
                    <img src="img/productos/<?=$producto["foto"]?>" alt="<?=$producto["nombre"]?>">
                </div>
                <div class="producto-texto">
                    <h3><?=$producto["nombre"]?></h3>
                    <p><?=$producto['descripcion']?></p>
                </div>
                <div class="producto-texto">
                    <h4>Estado:</h4><p><?=$producto['estado']?></p>
                    <h4>Categoria:</h4><p><?=$producto['categoria']?></p>
                    <h4>Tipo de Producto:</h4><p><?=$producto['tipoProducto']?></p>
                </div>
                <div class="producto-boton">
                    <h4>Precio:</h4><p>
                    <p class="precio">$<?=$producto["precio"]?></p>
                    <a href="editarProducto.php?id=<?=$producto['id']?>">
                        <button class="editar-button" type="button" name="button">Editar</button>
                    </a>
                    <a href="borrarProducto.php?id=<?=$producto['id']?>">
                        <button class="borrar-button" type="button" name="button">Borrar</button>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
    <section class="productos agregar">
        <a href="nuevoProducto.php">
            <button class="cancelar-button" type="button" style='margin-bottom: 15px;' name="button">Agregar un nuevo producto</button>
        </a>
    </section>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
