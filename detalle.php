<?php
    require_once('loader.php');

    if($_GET) {
        $etapa = 'producto';
        $productoRecuperado = $producto->getByID($_GET['id']);

        /*Llenamos los campos*/
        $nombre = $productoRecuperado['nombre'];
        $precio = $productoRecuperado['precio'];
        $descripcion = $productoRecuperado['descripcion'];
        $categoria = $productoRecuperado['categoria_id'];
        $estado = $productoRecuperado['estado_id'];
        $tipoProducto = $productoRecuperado['tipoproducto_id'];
        $foto = "img/productos/".$productoRecuperado['foto'];
        $cantidad = 1;

    } else {
        $etapa = 'error';
    }

    /*Header*/
    $CSS = ['infoProducto'];
    require_once("partials/header.php");
?>
<main class="main-container">
<?php if($etapa == 'error'):?>
    <section class="error-caja">
        <div class="error-text">
            <h2>Hubo un problema</h2>
        </div>
        <a href="index.php">
            <button class="return" type="button" name="">Volver</button>
        </a>
    </section>
<?php endif; ?>

<?php if($etapa == 'producto'):?>
    <div class="caja-producto">
        <div class="fotoProducto">
            <img src="<?=$foto?>" alt="Foto Producto">
        </div>

        <div class="textoProducto">
            <?php if ($estado == 'Nuevo'):?>
                <!-- <img class="etiqueta-nuevo" src="img/new/NewRosa.png" alt="Nuevo"> -->
            <?php endif;?>
            <div class="nombreProducto">
                <h2><?=$nombre?></h2>
            </div>
            <div class="infoProducto">
                <p><?=$descripcion?></p>
            </div>
            <form class="formulario-cantidad" action="" method="post">
                <div class="cantidad">
                    <i class='less'>-</i>
                    <input id="cantidad" type="int" name="cantidad" value="<?=$cantidad?>">
                    <i class='more'>+</i>
                </div>
                <div class="precio">
                    <p>$<?=$precio?></p>
                </div>
                <button class="agregar" type="submit" name="button">Agregar a carrito</button>
            </form>
            <a class="link-button" href="index.php">
                <button class="return" type="button">Volver</button>
            </a>
        </div>
    </div>
<?php endif; ?>
</main>
<!-- <script>
$('.cantidad-input i').click(function() {
		val = parseInt($('.cantidad-input input').val());

		if ($(this).hasClass('less')) {
				val = val - 1;
		} else if ($(this).hasClass('more')) {
				val = val + 1;
		}

		if (val < 1) {
				val = 1;
		}

		$('.cantidad-input input').val(val);
})
</script> -->
<?php
/*Footer*/
require_once("partials/footer.php");
?>
