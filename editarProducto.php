<?php
    require_once('loader.php');

    if($_GET) {
        $producto = new Producto();
        $etapa = 'producto';
        $product_id = $_GET['id'];
        $productoRecuperado = $producto->getByID($product_id);

        /*Llenamos los campos*/
        $nombre = $productoRecuperado['nombre'];
        $precio = $productoRecuperado['precio'];
        $descripcion = $productoRecuperado['descripcion'];
        $categoria = $productoRecuperado['categoria_id'];
        $estado = $productoRecuperado['estado_id'];
        $tipoProducto = $productoRecuperado['tipoproducto_id'];
        $foto = "img/productos/".$productoRecuperado['foto'];

        /*Errores*/
        $error_nombre = "";
        $error_descripcion = "";
        $error_precio = "";
        $error_foto = "";
        $error_estado = "";
        $error_tipoProducto = "";
        $error_categoria = "";
        $errorPrincipal = "";
        $mensajePrincipal = "";

        /*Listas de Base de datos*/
        $consultaEstados = $conex->query("SELECT * FROM estados");
        $listaEstados = $consultaEstados->fetchAll(PDO::FETCH_ASSOC);
        $consultaTipoProductos = $conex->query("SELECT * FROM tipoProductos");
        $listaTiposProductos = $consultaTipoProductos->fetchAll(PDO::FETCH_ASSOC);

        if($_POST){
          foreach( $_POST as $variable => $valor ){
              $$variable = trim($valor);
          }

          if($_FILES['foto']['name'] != ''){
              $fotoNueva = $_FILES['foto'];
              $validarFoto = !$validator->imageValidate($fotoNueva);
              if($validarFoto){
                  $validar['error_foto'] = $validarFoto;
              }
          }

          /*VALIDAR*/
          $validar = $validator->validateProductoEdicion($nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion);

          /*SI NO HAY ERRORES UBIMOS A LA BASE*/
          if(!$validar) {
            $subirData = $producto->update($product_id, $nombre, $precio, $categoria, $estado, $tipoProducto, $descripcion);

            if($subirData){
                $errorPrincipal = $subirData;
            }

            if(isset($fotoNueva)) {
                $subirFoto = $producto->updatePicture($product_id, $productoRecuperado['foto'], $fotoNueva);

                if($subirFoto){
                    $error['errorFoto'] = $subirFoto;
                }

            }
            if(isset($error) or $errorPrincial != ''){
              foreach ($error as $key => $value) {
                $$key = $value;
              }
            } else {
              header('location:lista-productos.php');
            }
          } else {
              /*Si hay errores, repartime las variables para que se muestren en los campos correctos*/
              foreach($validar as $indice => $valor ){
                $$indice=$valor;
              }
          }
        }
    } else {
        $etapa = 'error';
    }

    /*Header*/
    $CSS = ['editor-productos'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <?php if($etapa == 'error'):?>
        <section class="editar-form">
            <div class="login-text">
                <h2>Hubo un problema</h2>
            </div>
            <a href="lista-productos.php">
                <button class="return" type="button" name="">Volver</button>
            </a>
        </section>
    <?php endif; ?>

    <?php if($etapa == 'producto'):?>
    <div class="editar-form">
      <div class="login-text">
          <h2>Editar Producto</h2>
      </div>

      <span class="error-form"><?=$errorPrincipal?></span>

      <span style="color:blue;" class = "mensajeConfirmar" ><?=$mensajePrincipal?></span>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="fotoProducto">
            <img src="<?=$foto?>" alt="Foto Producto">
        </div>

          <div class="form-editar">
              <label for="foto">Cambiar foto:</label>
              <input type="file" name="foto" value="">
              <span class="error-form"><?=$error_foto?></span>
          </div>


        <div class="form-editar">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="<?=$nombre?>">
            <span class="error-form"><?=$error_nombre?></span>
        </div>

        <div class="form-editar">
            <label for="nombre">Descripcion</label>
            <textarea name="descripcion" rows="8" cols="80"><?=$descripcion?></textarea>
            <span class="error-form"><?=$error_descripcion?></span>
        </div>

        <div class="form-editar">
            <label for="nombre">Precio</label>
            <input id="nombre" step="0.01" type="number" name="precio" value="<?=$precio?>">
            <span class="error-form"><?=$error_precio?></span>
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
            <span class="error-form"><?=$error_estado?></span>
        </section>

        <!-- Categoria -->
        <section class="form-editar">
            <label for="categoria">Categoria:</label>
            <div class="check-product">
                <?php foreach ($categorias as $opcion) {
                    if ($categoria == $opcion['id']):?>
                    <div class="check-box">
                        <input type="radio" name="categoria" value="<?=$opcion['id']?>" checked><span><?=$opcion['nombre']?></span>
                    </div>
                <?php else: ?>
                    <div class="check-box">
                        <input type="radio" name="categoria" value="<?=$opcion['id']?>"><span><?=$opcion['nombre']?></span>
                    </div>
                <?php endif; }?>
            </div>
            <span class="error-form"><?=$error_categoria?></span>
        </section>

        <!--Tipo de Producto-->
        <section class="form-editar">
            <label for="tipoProducto">Tipo de Producto:</label>
            <select name="tipoProducto">
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
            <span class="error-form"><?=$error_tipoProducto?></span>
        </section>

        <div class="login-button">
            <button type="submit" name="crearProducto">ENVIAR</button>
        </div>
    </form>
    <a href="lista-productos.php">
        <button class="return" type="button">Volver</button>
    </a>
</div>
<?php endif; ?>
</main>

<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
