<?php
    require_once('loader.php');
    $consultaProductos = $conex->query("SELECT productos.id, productos.nombre, productos.descripcion, productos.foto, productos.precio, tipoProductos.nombre AS 'tipoProducto', categorias.nombre AS 'categoria', estados.nombre AS 'estado'FROM productos INNER JOIN categorias ON productos.categoria_id = categorias.id INNER JOIN tipoProductos ON productos.tipoProducto_id = tipoProductos.id INNER JOIN estados ON productos.estado_id = estados.id");
    $listaProductos = $consultaProductos->fetchAll(PDO::FETCH_ASSOC);

    $CSS = ['index','producto'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <section class="intro">
        <div class="intro-imagen">
            <img src="img/swatches-height.jpg" alt="Swatches">
        </div>
        <div class="intro-texto">
            <h1>Para todas</h1>
            <p>Fancy Beauty  fue creada para que las mujeres del mundo se sientan incluidas, enfocándonos  en la variedad y cantidad de tonos de piel y creando fórmulas que funcionen de la mejor forma para todos los tipos de pieles. Nuestros productos fueron creados para que te inspires, para que te diviertas, para que crees algo nuevo y diferente. </p>
        </div>
    </section>

    <section class="publicidad-mobile">
        <img src="img/publicidad/PublicidadUno.png" alt="Publicidad">
    </section>

    <section class="publicidad-desktop">
        <img src="img/publicidad/BannerUno.png" alt="Publicidad">
    </section>

    <?php /*PRODUCTOS MÁS VENDIDOS*/?>
    <section class="productos">
        <div class="titulo-seccion">
            <h2>Nuestros productos más populares</h2>
        </div>

        <?php foreach ($listaProductos as $producto):
            if($producto['estado'] == 'Popular'):?>
            <article class="producto">
                <div class="p-imagen">
                    <img src="img/productos/<?=$producto["foto"]?>" alt="<?=$producto["nombre"]?>">
                </div>
                <div class="producto-texto">
                    <h3><?=$producto["nombre"]?></h3>
                </div>
                <div class="producto-boton">
                    <p class="precio">$<?=$producto["precio"]?></p>
                    <button class="comprar" type="button" name="button">Comprar</button>
                </div>
            </article>
        <?php endif; endforeach;?>
        <div class="mas">
            <button class="ver-mas" type="button" name="button">Ver más</button>
        </div>
    </section>

    <?php /*OFERTAS*/?>
    <section class="ofertas-mobile">
        <img class="foto" src="img/ofertaUno.png" alt="oferta">
    </section>

    <section class="ofertas">
        <img class="foto" src="img/ofertaUno.png" alt="oferta">
        <img class="foto" src="img/ofertaDos.png" alt="Oferta">
        <img class="foto" src="img/ofertaTres.png" alt="Oferta">
        <img class="foto" src="img/ofertaCuatro.png" alt="Oferta">
    </section>

    <?php /*PRODUCTOS NUEVOS*/?>
    <section class="productos">
        <div class="titulo-seccion">
            <h2>Lo más nuevo</h2>
        </div>
        <?php foreach ($listaProductos as $producto):
            if($producto['estado'] == 'Nuevo'):?>
            <article class="producto">
                <img class="etiqueta-nuevo" src="img/new/NewRosa.png" alt="Nuevo">
                <div class="p-imagen">
                    <img src="img/productos/<?=$producto["foto"]?>" alt="<?=$producto["nombre"]?>">
                </div>
                <div class="producto-texto">
                    <h3><?=$producto["nombre"]?></h3>
                </div>
                <div class="producto-boton">
                    <p class="precio">$<?=$producto["precio"]?></p>
                    <button class="comprar" type="button" name="button">Comprar</button>
                </div>
            </article>
        <?php endif; endforeach;?>
        <div class="mas">
            <button class="ver-mas" type="button" name="button">Ver más</button>
        </div>
    </section>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
