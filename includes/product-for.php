<?php
  include("includes/lista-productos.php");

  $totalProductos = count($productos);

  for ($i=0; $i < $totalProductos ; $i++) {
    echo '<article class="product">
            <!--imagen-->
            <div class="images">
              <img src="img/productos/'.$productos[$i]["foto"].'" alt="'.$productos[$i]["nombre"].'">
            </div>

            <!--texto-->
            <div class="product-text">
              <h3>'.$productos[$i]["nombre"].'</h3>
              <p>$'.$productos[$i]["precio"].'</p>

            <!--boton para comprar-->
            <button class="add-bag" type="button" name="button">Comprar</button>
            </div>
          </article>';
    };
 ?>
