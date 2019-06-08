<?php
    require_once('loader.php');
    /*Header*/
    $CSS = ['lista-productos'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <section class="productos">
        <div class="titulo-seccion">
            <h2>El producto ha sido borrado correctamente</h2>
        </div>
        <a href="lista-productos.php">
            <button class="cancelar-button" type="button" name="">Volver</button>
        </a>
    </section>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
