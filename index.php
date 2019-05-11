<?php
  session_start();
  require_once('actions/user-check.php');
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/producto.css">
    <title>Fancy Beauty</title>
  </head>
  <body>
    <div class="xl-screen">
      <div class="body-container">
        <!--HEADER-->
        <?php
            include_once("includes/header.php");
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

          <!--PRODUCTOS MÁS VENDIDOS-->
          <section class="productos">
            <div class="titulo-seccion">
              <h2>Nuestros productos más populares</h2>
            </div>
            <?php
            include("includes/lista-productos.php");
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

          <!--OFERTAS-->
          <section class="ofertas-mobile">
            <img class="foto" src="img/ofertaUno.png" alt="oferta">
          </section>

          <section class="ofertas">
            <img class="foto" src="img/ofertaUno.png" alt="oferta">
            <img class="foto" src="img/ofertaDos.png" alt="Oferta">
            <img class="foto" src="img/ofertaTres.png" alt="Oferta">
            <img class="foto" src="img/ofertaCuatro.png" alt="Oferta">
          </section>

          <!--PRODUCTOS NUEVOS-->
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
                  <img class="etiqueta-nuevo" src="img/new/NewVioleta.png" alt="">

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

        <!--FOOTER-->
        <?php
        include_once("includes/footer.php");
        ?>
      </div>
     </div>
  </body>
</html>
