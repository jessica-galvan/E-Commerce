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


    <title>Feunty Beauty</title>
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
            <h1>Para todas</h1>
            <p>Fenty Beauty  fue creada para que las mujeres del mundo se sientan incluidas, enfocándonos  en la variedad y cantidad de tonos de piel y creando fórmulas que funcionen de la mejor forma para todos los tipos de pieles. Nuestros productos fueron creados para que te inspires, para que te diviertas, para que crees algo nuevo y diferente. </p>
          </div>
        </section>

        <!--PRODUCTOS MÁS VENDIDOS-->
        <section class="products">
          <!--Titulo Best-sellers-->
          <div class="titulo-seccion">
            <h2>Nuestros productos más populares</h2>
          </div>

          <!--DIV de Productos-->
          <?php
          include("includes/lista-productos.php");

          $totalProductos = count($productos);

          for ($i=0; $i < $totalProductos ; $i++):
            if ($productos[$i]["estado"] === "Best-seller"):?>
              <article class="product">
                <!--imagen-->
                <div class="images">
                  <img src="img/productos/<?=$productos[$i]["foto"]?>" alt="<?=$productos[$i]["nombre"]?>">
                </div>

                <!--texto-->
                <div class="product-text">
                  <h3><?=$productos[$i]["nombre"]?></h3>
                  <p class="price">$<?=$productos[$i]["precio"]?></p>
                  <br>
                </div>
                <!--boton para comprar-->
                <div class="product-button">
                  <button class="add-bag" type="button" name="button">Comprar</button>
                </div>
              </article>
            <?php  endif;?>
          <?php  endfor;?>



          <!--VER MÁS-->
          <div class="more">
            <button class="shop-more" type="button" name="button">Ver más</button>
          </div>
        </section>

        <!--PRODUCTOS NUEVOS-->
        <section class="products">
          <!--Titulo Best-sellers-->
          <div class="titulo-seccion">
            <h2>Lo más nuevo</h2>
          </div>

          <!--DIV de Productos-->
          <?php
          for ($i=0; $i < $totalProductos ; $i++):
            if ($productos[$i]["estado"] === "Nuevo"):?>
              <article class="product">
                <!--imagen-->
                <div class="images">
                  <img src="img/productos/<?=$productos[$i]["foto"]?>" alt="<?=$productos[$i]["nombre"]?>">
                </div>

                <!--texto-->
                <div class="product-text">
                  <h3><?=$productos[$i]["nombre"]?></h3>
                    <p class="price">$<?=$productos[$i]["precio"]?></p>
                </div>
                <br>
                <!--boton para comprar-->
                <div class="product-button">
                  <button class="add-bag" type="button" name="button">Comprar</button>
                </div>
              </article>
            <?php endif;?>
          <?php endfor;?>

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
