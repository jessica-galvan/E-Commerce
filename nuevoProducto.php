<?php
    require_once('loader.php');
    $nombre = "";
    $precio = "";
    $descripcion = "";
    $categoria = "";
    $estado = "";
    $tipoProducto = "";
    $errorNombre = "";
    $errorDescripcion = "";
    $errorPrecio = "";
    $errorFoto = "";
    $errorEstado = "";
    $errorTipoProducto = "";
    $errorCategoria = "";
    $errorPrincipal = "";
    $mensajePrincipal = "";

    /*Listas de Base de datos*/
    $consultaEstados = $conex->query("SELECT * FROM estados");
    $listaEstados = $consultaEstados->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($listaEstados);
    // exit;
    $consultaTipoProductos = $conex->query("SELECT * FROM tipoProductos");
    $listaTiposProductos = $consultaTipoProductos->fetchAll(PDO::FETCH_ASSOC);
    $consultaCategorias = $conex->query("SELECT * FROM categorias");
    $listaCategorias = $consultaCategorias->fetchAll(PDO::FETCH_ASSOC);

    if($_POST){
        foreach( $_POST as $variable => $valor ){
            $$variable = trim($valor);
        }

        $foto = $_FILES['foto'];
        var_dump($_POST);
        var_dump($foto);
        $check = $validator->imageValidate($foto);
        var_dump($check);

        exit;

        /*VALIDAR*/
        $validar = $validator->validateProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $foto, $descripcion);

        /*SI NO HAY ERRORES UBIMOS A LA BASE*/
        if(!$validar) {
            $crear = $baseDatos->createProducto($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion);

            $product_id = $conex->lastInsertId();

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
    $CSS = ['editor-productos'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <div class="editar-form">
      <div class="login-text">
          <h2>Nuevo Producto</h2>
      </div>

      <form action="nuevoProducto.php" method="post" enctype="multipart/form-data">
          <div class="form-editar">
              <label for="foto">Foto Producto:</label>
              <input type="file" name="foto" value="">
              <span class="error-form"><?=$errorFoto?></span>
          </div>


        <div class="form-editar">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="<?=$nombre?>">
            <span class="error-form"><?=$errorNombre?></span>
        </div>

        <div class="form-editar">
            <label for="nombre">Descripcion</label>
            <textarea name="descripcion" rows="8" cols="80"><?=$descripcion?></textarea>
            <span class="error-form"><?=$errorDescripcion?></span>
        </div>

        <div class="form-editar">
            <label for="nombre">Precio</label>
            <input id="nombre" type="text" name="precio" value="<?=$precio?>">
            <span class="error-form"><?=$errorPrecio?></span>
        </div>

        <!-- Estado -->
        <section class="form-editar">
            <label for="estado">Estado:</label>
            <div class="check-product">
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

        <!-- Categoria -->
        <section class="form-editar">
            <label for="categoria">Categoria:</label>
            <div class="check-product">
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
            <select name="tipoProducto">
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
