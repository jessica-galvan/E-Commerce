<?php
    require_once('loader.php');
    $nombre = "";
    $precio = "";
    $descripcion = "";
    $categoria = "";
    $estado = "";
    $tipoProducto = "";
    $errorDescripcion = "";
    $errorPrecio = "";
    $errorFoto = "";
    $errorEstado = "";
    $errorTipoProducto = "";
    $errorCategoria = "";
    $errorPrincipal = "";
    $mensajePrincipal = "";

    /*Listas de Base de datos*/
    $listaEstado = "";
    $listaTiposProductos = "";
    $listaCategorias = "";

    if($_POST){
        foreach( $_POST as $variable => $valor ){
            $$variable = trim($valor);
        }

        $foto = $_FILES['foto'];

        /*VALIDAR*/
        $validar = $validator->validateProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion);

        /*SI NO HAY ERRORES UBIMOS A LA BASE*/
        if(!$validar) {
            $crear = $baseDatos->createProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion);
            if(!$crear){
                $mensajePrincipal = "El producto a sido agregado.";
            } else {
                $errorPrincial = $crear;
            }
        } else {
            /*Si hay errores, repartime las variables para que se muestren en los campos correctos*/
            foreach($validar as $indice => $valor ){
              $$indice=$valor;
            }
        }
      }


    /*Header*/
    $CSS = ['form', 'perfil'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <div class="register-form">
      <div class="login-text">
          <h2>Nuevo Producto</h2>
      </div>

      <div class="form-editar">
          <label for="foto">Foto Producto:</label>
          <input type="file" name="foto" value="">
          <span class="error-form"><?=$errorFoto?></span>
      </div>


      <form class="" action="nuevoProducto.php" method="post" enctype="multipart/form-data">
        <div class="form">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="<?=$nombre?>">
            <span class="error-form"><?=$errorNombre?></span>
        </div>

        <div class="form">
            <label for="nombre">Descripcion</label>
            <textarea name="descripcion" rows="8" cols="80"><?=$descripcion?></textarea>
            <span class="error-form"><?=$errorDescripcion?></span>
        </div>

        <div class="form">
            <label for="nombre">Precio</label>
            <input id="nombre" type="text" name="precio" value="<?=$precio?>">
            <span class="error-form"><?=$errorPrecio?></span>
        </div>

        <!-- Categoria -->
        <section class="form-editar">
            <label for="categoria">Categoria:</label>
            <div class="check-box">
                <?php foreach ($listaCategorias as $categorias) {
                    if ($categoria == $categorias['id']):?>
                    <div class="check-box">
                        <input type="radio" name="categoria" value="<?=$categorias['id']?>" checked><span><?=$categorias['nombre']?></span>
                    </div>
                <?php else: ?>
                    <div class="check-box">
                        <input type="radio" name="categoria" value="<?=$categorias['id']?>"><span><?=$categorias['nombre']?></span>
                    </div>
                <?php endif; }?>
            </div>
            <span class="error-form"><?=$errorCategoria?></span>
        </section>

        <!--Tipo de Producto-->
        <section class="form-editar">
            <label for="tipoProducto">Tipo de Producto:</label>
            <select class="" name="tipoProducto">
                <?php if($provinciaRespuesta  == ""): ?>
                    <option hidden value=""> <i>Seleccionar</i> </option>
                <?php endif; ?>
                <?php foreach ($listaTiposProductos as $TiposProductos) {
                    if ($tipoProducto == $TiposProductos['id']):?>
                    <option value='<?=$TiposProductos['id']?>' selected>
                        <?=$TiposProductos['nombre']?>
                    </option>
                    <?php else: ?>
                        <option value='<?=$TiposProductos['id']?>'>
                            <?=$TiposProductos['nombre']?>
                        </option>
                    <?php endif; }?>
            </select>
            <span class="error-form"><?=$errorTipoProducto?></span>
        </section>

        <!-- Estado -->
        <section class="form-editar">
            <label for="estado">Estado:</label>
            <div class="check-box">
                <?php foreach ($listaEstados as $estados) {
                    if ($estado == $estados['id']):?>
                    <div class="check-box">
                        <input type="radio" name="estado" value="<?=$estados['id']?>" checked><span><?=$estados['nombre']?></span>
                    </div>
                <?php else: ?>
                    <div class="check-box">
                        <input type="radio" name="estado" value="<?=$estados['id']?>"><span><?=$estados['nombre']?></span>
                    </div>
                <?php endif; }?>
            </div>
            <span class="error-form"><?=$errorEstado?></span>
        </section>

        <div class="login-button">
            <button type="submit" name="crearProducto">ENVIAR</button>
        </div>
    </form>
    <span class="error-form"><?=$errorPrincipal?></span>
    <span class = "confirm-message" ><?=$mensajePrincipal?></span>

</div>
</main>

<?php
/*Footer*/
require_once("partials/footer.php");
?>
