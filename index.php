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


    <title>Beauty</title>
  </head>

  <body>
    <div class="body-container">
      <!--HEADER-->
      <?php
        include_once("includes/header.php");
       ?>

      <!--Main Cointainer-->
      <main class="main-container">
        <section class="main-photo">
          <div class="banner">
            <img src="img/banner-example.jpg" alt="Banner de Make Up">
          </div>
          <div class="text">
            <h1>Lorem ipsum dolor sit amet</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </section>

        <!--PRODUCTOS-->
        <section class="products">
          <!--Titulo Best-sellers-->
          <div class="Bestsellers">
            <h2>Best-sellers</h2>
          </div>

          <!--Producto 1-->
          <div class="products-list">
            <article class="product">
              <div class="images">
                <img src="img/producto-2-sombras.jpg" alt="Sombras">
              </div>
              <div class="text">
                <h3>Producto</h3>
                <p>Mini Descripción</p>
                <br>
                <p>Precio</p>
                <button class="add-bag" type="button" name="button">Comprar</button>
              </div>
            </article>

            <!--Producto 2-->
            <article class="product">
              <div class="images">
                <img src="img/producto-3-blush.jpg" alt="Blush">
              </div>
              <div class="text">
                <h3>Producto</h3>
                <p>Mini Descripción</p>
                <br>
                <p>Precio</p>
                <button class="add-bag" type="button" name="button">Comprar</button>
              </div>
            </article>

            <!--Producto 3-->
            <article class="product">
              <div class="images">
                <img src="img/producto-4.jpg" alt="Algo">
              </div>
              <div class="text">
                <h3>Producto</h3>
                <p>Mini Descripción</p>
                <br>
                <p>Precio</p>
                <button class="add-bag" type="button" name="button">Comprar</button>
              </div>
            </article>
          </div>

          <!--VER MÁS-->
          <div class="more">
            <button class="shop-more" type="button" name="button">Ver más</button>
          </div>
        </section>
      </main>

      <!--FOOTER-->
      <?php
      include_once("includes/footer.php");
      ?>
    </div>
  </body>
</html>
