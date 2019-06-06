<?php
    require_once('loader.php');
    include_once("partials/lista-productos.php");
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
        <?php

        $totalProductos = count($productos);
        $maxProductosPopulares = 0;
        $nPopulares = 0; /*$nPopulares es el $i de un for. Como lo hice con while, lo cree.*/

        while($maxProductosPopulares < 5) {
        if ($productos[$nPopulares]["estado"] === "Best-seller"):?>
        <article class="producto">
            <div class="p-imagen">
                <img src="img/productos/<?=$productos[$nPopulares]["foto"]?>" alt="<?=$productos[$nPopulares]["nombre"]?>">
            </div>
            <div class="producto-texto">
                <h3><?=$productos[$nPopulares]["nombre"]?></h3>
            </div>
            <div class="producto-boton">
                <p class="precio">$<?=$productos[$nPopulares]["precio"]?></p>
                <button class="comprar" type="button" name="button">Comprar</button>
            </div>
        </article>
        <?php $maxProductosPopulares++;
            endif;
            $nPopulares++;
        };?>
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
        <?php
        $maxProductosNuevos = 0;
        $nNuevos = 0;
        while($maxProductosNuevos < 5) {
        if ($productos[$nNuevos]["estado"] === "Nuevo"):?>
        <article class="producto">
            <img class="etiqueta-nuevo" src="img/new/NewRosa.png" alt="">

            <div class="p-imagen">
                <img src="img/productos/<?=$productos[$nNuevos]["foto"]?>" alt="<?=$productos[$nNuevos]["nombre"]?>">
            </div>
            <div class="producto-texto">
                <h3><?=$productos[$nNuevos]["nombre"]?></h3>
            </div>
            <div class="producto-boton">
                <p class="precio">$<?=$productos[$nNuevos]["precio"]?></p>
                <button class="comprar" type="button" name="button">Comprar</button>
            </div>
        </article>
        <?php
            $maxProductosNuevos++;
            endif;
            $nNuevos++;
        };?>
        <div class="mas">
            <button class="ver-mas" type="button" name="button">Ver más</button>
        </div>
    </section>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
