<!DOCTYPE html>
<html>
  <head>
    <!--Meta TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Links-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Handlee|Open+Sans" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">



    <title>Fenty Beauty</title>
  </head>

  <body>
    <div class="xl-screen">
      <div class="body-container">
        <!--HEADER-->
        <?php
          include_once("includes/header.php");
         ?>

        <!--Main Cointainer: acá tendria que ir todo lo que vayamos a agregar.-->
        <main class="main-container">

          <!--SECCION INTRODUCCION/BANNER-->
          <section class="main-photo">
            <div class="banner">
              <img src="img/banner-example.jpg" alt="Banner de Make Up">
            </div>
            <div class="main-text">
              <h1>Para todas</h1>
              <p>Fenty Beauty  fue creada para que las mujeres del mundo se sientan incluidas, enfocándonos  en la variedad y cantidad de tonos de piel y creando fórmulas que funcionen de la mejor forma para todos los tipos de pieles. Nuestros productos fueron creados para que te inspires, para que te diviertas, para que crees algo nuevo y diferente. </p>
            </div>
          </section>
          <!--FIN SECCION BANNER-->


          <!--PRODUCTOS MÁS VENDIDOS-->
          <section class="products">
            <!--Titulo Best-sellers-->
            <div class="titulo-seccion">
              <h2>Nuestros productos más populares</h2>
            </div>

            <!--DIV de Productos-->
            <?php
            include("includes/lista-productos.php");

            //Para que los productos en la pagina Index no pasen de cierta cantidad, hice un while que frene cuando tenga 5 productos más vendidos. Se puede cambiar el maximo de productos sin problemas.

            $totalProductos = count($productos);
            $maxProductsBestSeller = 0;
            $nBestSeller = 0;

            while($maxProductsBestSeller < 5) {
              if ($productos[$nBestSeller]["estado"] === "Best-seller"):?>
                <article class="product">
                  <!--imagen-->
                  <div class="images">
                    <img src="img/productos/<?=$productos[$nBestSeller]["foto"]?>" alt="<?=$productos[$nBestSeller]["nombre"]?>">
                  </div>

                  <!--texto-->
                  <div class="product-text">
                    <h3><?=$productos[$nBestSeller]["nombre"]?></h3>
                    <!-- <br> -->
                  </div>
                  <!--boton para comprar-->
                  <div class="product-button">
                    <!-- <br> -->
                    <p class="price">$<?=$productos[$nBestSeller]["precio"]?></p>
                    <button class="add-bag" type="button" name="button">Comprar</button>
                  </div>
                </article>

            <?php
              $maxProductsBestSeller++;
            endif;
              $nBestSeller++;
            };?>

            <!--VER MÁS-->
            <div class="more">
              <button class="shop-more" type="button" name="button">Ver más</button>
            </div>
          </section>
          <!--FIN PRODUCTOS MÁS VENDIDOS-->

          <!--PRODUCTOS NUEVOS-->
          <section class="products">
            <!--Titulo Best-sellers-->
            <div class="titulo-seccion">
              <h2>Lo más nuevo</h2>
            </div>

            <!--DIV de Productos-->
            <?php
            //Para que los productos en la pagina Index no pasen de cierta cantidad, hice un while que frene cuando tenga 5 productos Nuevos. Se puede cambiar el maximo de productos sin problemas.

            $maxProductsNuevo = 0;
            $nNuevo = 0;

            while($maxProductsNuevo < 5) {
              if ($productos[$nNuevo]["estado"] === "Nuevo"):?>
                <article class="product">
                  <!--imagen-->
                  <div class="images">
                    <img src="img/productos/<?=$productos[$nNuevo]["foto"]?>" alt="<?=$productos[$nNuevo]["nombre"]?>">
                  </div>

                  <!--texto-->
                  <div class="product-text">
                    <h3><?=$productos[$nNuevo]["nombre"]?></h3>
                    <!-- <br> -->
                  </div>
                  <!--boton para comprar-->
                  <div class="product-button">
                    <p class="price">$<?=$productos[$nNuevo]["precio"]?></p>
                    <button class="add-bag" type="button" name="button">Comprar</button>
                  </div>
                </article>

            <?php
              $maxProductsNuevo++;
            endif;
              $nNuevo++;
            };?>

            <!--VER MÁS-->
            <div class="more">
              <button class="shop-more" type="button" name="button">Ver más</button>
            </div>
          </section>
          <!--FIN PRODUCTOS NUEVOS-->

        </main>
        <!-- FIN Main Cointainer-->
        <!--FOOTER-->
        <?php
        include_once("includes/footer.php");
        ?>
      </div>  <!--FIN BODY-CONTAINER-->
     </div> <!--FIN XL-SCREEN-->
  </body>
</html>
