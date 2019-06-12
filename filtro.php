<?php
    require_once('loader.php');
    if($_GET['id'] && $_GET['tabla']) {
        var_dump($_GET);
        if($_GET['tabla'] = 'categorias') {
            $consultaProductos = $conex->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, categorias.id AS 'categoria_id', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN estados ON productos.estado_id = estados.id WHERE categoria.id = :id");
            $consultaProductos->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
            $listaProductos = $consultaProductos->fetchAll(PDO::FETCH_ASSOC);

            // "SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, categorias.id AS 'categoria_id', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN estados ON productos.estado_id = estados.id WHERE categoria_id = 1";

            var_dump($listaProductos);
            exit;
        }
    }



    $CSS = ['index','producto'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <section class="productos">
        <div class="titulo-seccion">
            <h2><?=$listaProductos[0]['categoria']?></h2>
        </div>

        <?php foreach ($listaProductos as $producto):?>
            <article class="producto">
                <a style="text-decoration:none;" href="producto.php?id=<?=$producto['id']?>">
                    <?php if($producto['estado'] == 'Nuevo'):?>
                        <div class="etiqueta-nuevo">
                            <img src="img/new/NewRosa.png" alt="Nuevo">
                        </div>
                    <?php endif;?>
                    <div class="p-imagen">
                        <img src="img/productos/<?=$producto["foto"]?>" alt="<?=$producto["nombre"]?>">
                    </div>
                    <div class="producto-texto">
                        <h3><?=$producto["nombre"]?></h3>
                    </div>
                </a>
                <div class="producto-boton">
                    <p class="precio">$<?=$producto["precio"]?></p>
                    <button class="comprar" type="button" name="button">Comprar</button>
                </div>
            </article>
        <?php endforeach;?>
        <div class="mas">
            <button class="ver-mas" type="button" name="button">Ver más</button>
        </div>
    </section>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
