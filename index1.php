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
    <link rel="stylesheet" href="css/index-backup.css">
    <link rel="stylesheet" href="css/product.css">


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
          <div class="main-text">
            <h1>Lorem ipsum dolor sit amet</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </section>

        <!--PRODUCTOS MÁS VENDIDOS-->
        <section class="products">
          <!--Titulo Best-sellers-->
          <div class="Bestsellers">
            <h2>Nuestros productos más populares</h2>
          </div>

          <!--DIV de Productos-->
          <?php
          include("includes/lista-productos.php");

          $totalProductos = count($productos);

          for ($i=0; $i < $totalProductos ; $i++) {
            if ($productos[$i]["estado"] === "Best-seller") {
              echo '<article class="product">
                      <!--imagen-->
                      <div class="images">
                        <img src="img/productos/'.$productos[$i]["foto"].'" alt="'.$productos[$i]["nombre"].'">
                      </div>

                      <!--texto-->
                      <div class="product-text">
                        <h3>'.$productos[$i]["nombre"].'</h3>
                        <p>$'.$productos[$i]["precio"].'</p>
                        <br>
                      <!--boton para comprar-->
                      <button class="add-bag" type="button" name="button">Comprar</button>
                      </div>
                    </article>';
                  };
            };

           ?>

          <!--VER MÁS-->
          <div class="more">
            <button class="shop-more" type="button" name="button">Ver más</button>
          </div>
        </section>

        <!--PRODUCTOS MÁS VENDIDOS-->
        <section class="products">
          <!--Titulo Best-sellers-->
          <div class="Bestsellers">
            <h2>Lo más nuevo</h2>
          </div>

          <!--DIV de Productos-->
          <?php
          include("includes/lista-productos.php");

          $totalProductos = count($productos);

          for ($i=0; $i < $totalProductos ; $i++) {
            if ($productos[$i]["estado"] === "Nuevo") {
              echo '<article class="product">
                      <!--imagen-->
                      <div class="images">
                        <img src="img/productos/'.$productos[$i]["foto"].'" alt="'.$productos[$i]["nombre"].'">
                      </div>

                      <!--texto-->
                      <div class="product-text">
                        <h3>'.$productos[$i]["nombre"].'</h3>
                        <p>$'.$productos[$i]["precio"].'</p>
                        <br>
                      <!--boton para comprar-->
                      <button class="add-bag" type="button" name="button">Comprar</button>
                      </div>
                    </article>';
                  };
            };

           ?>

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
