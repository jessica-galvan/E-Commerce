<?php
    ob_start();
    require_once('loader.php');
    $auth->usuarioNoLogueado();
    require_once("partials/listas-editar.php");
    /*Lo primero que necesitamos*/
    $usuarioRecuperado = $baseDatos->getUserPerfil($_SESSION['email_usuario']);
    $generoRespuesta = $usuarioRecuperado['genero'];
    $tonoDePielRespuesta = $usuarioRecuperado['tonoDePiel'];
    $tipoDePielRespuesta = $usuarioRecuperado['tipoDePiel'];
    $provinciaRespuesta = $usuarioRecuperado['provincia'];
    $fechaNacimientoRespuesta = $usuarioRecuperado['fechaNacimiento'];
    $errorFoto = "";

    $listaTonoDePiel = $listaArray['tonoDePiel'];
    $listaTipoDePiel = $listaArray['tipoDePiel'];
    $listaGenero = $listaArray['genero'];
    $listaProvincia = $listaArray['provincia'];
    /*Si hay POST. No hay necesidad de validar. Y solo updatear el array con lo que se completo.*/
    if(isset($_POST['editar']) || isset($_FILES["foto"])) {
        /*Para todo el $_POST, hago un foreach que lo recorre y sube la data correctamente. La funcion recuperarDato lo que hace es buscar el dato dentro $listaArray en vez de subir a la base de datos el valor seleccionado. Es decir, si eligen Capital Federal, el valor que recibo por POST es caba, y con recuperarDato hago que se suba Capital Federal.*/
        foreach ($_POST as $indice => $valor) {
            if($valor != ""){
                if($indice != 'fechaNacimiento'){
                    $dato = recuperarDato($indice, $valor);
                    $baseDatos->updatePerfil($_SESSION['email_usuario'], $indice, $dato);
                } else {
                    $baseDatos->updatePerfil($_SESSION['email_usuario'], $indice, $valor);
                }
            }
        }

        /*Para imagenes
        PRIMERO habria que validar la foto, luego subir el cambio de avatar y preparar lo que se va a subir a las base de datos.
        SEGUNDO, si todo esta bien, subi la foto a su carpeta correspondiente y actualizar la base de datos*/
        if(isset($_FILES["foto"])){
            // $foto = $_FILES["foto"];
            // $validarFoto = $validator->imageValidate($foto);
            // if($validarFoto){
            //     $baseDatos->changeAvatar($_SESSION['email_usuario'], $_FILES['foto']);
            // } else {
            //     $errores = $validator->getErrores();
            //     $errorFoto = $errores['imagen'];
            // }

            /*Por ahora sulo subi lo que te paso. Esto es temporal y esta mal porque no hay validacion que confirme que recibio todo bien, que el archivo es una imagen y eso*/
            $baseDatos->changeAvatar($_SESSION['email_usuario'], $_FILES['foto']);
        }

        echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
        exit;
    }

    $CSS = ['form', 'perfil'];
    include_once("partials/header.php");
    ob_end_flush();
?>
<main class="main-container">
    <div class="editar-form">
        <div class="login-text">
            <h2 id="titulo-editar">Editar mi perfil</h2>
        </div>
        <form class="container-editarPerfil" action="editarPerfil.php" method="post" enctype="multipart/form-data">
            <!-- SECCION TIPO -->
            <section class="form-editar">
                <label for="tipoDePiel">Tipo de piel:</label>
                <?php
                foreach ($listaTipoDePiel as $tipo) {
                    if ($tipoDePielRespuesta == $tipo['dato']): ?>
                        <div class="check-box">
                            <input type="radio" name="tipoDePiel" value="<?=$tipo['valor']?>" checked><span><?=$tipo['dato']?></span>
                        </div>
                    <?php else: ?>
                        <div class="check-box">
                            <input type="radio" name="tipoDePiel" value="<?=$tipo['valor']?>"><span><?=$tipo['dato']?></span>
                        </div>
                    <?php endif; } ?>
            </section>

            <!-- SECCION TONO -->
            <section class="form-editar">
                <label for="tonoDePiel">Tono de piel:</label>
                <?php foreach ($listaTonoDePiel as $tono) {
                    if ($tonoDePielRespuesta == $tono['dato']):?>
                    <div class="check-box">
                        <input type="radio" name="tonoDePiel" value="<?=$tono['valor']?>" checked><span><?=$tono['dato']?></span>
                    </div>
                <?php else: ?>
                    <div class="check-box">
                        <input type="radio" name="tonoDePiel" value="<?=$tono['valor']?>"><span><?=$tono['dato']?></span>
                    </div>
                <?php endif; }?>
            </section>

            <!-- SECCION GENERO -->
            <section class="form-editar" id='genero-checkbox'>
                <label for="genero">Género:</label>
                <div class="genero-options">
                    <?php foreach ($listaGenero as $generos) {
                        if ($generoRespuesta == $generos['dato']):?>
                        <div class="check-box">
                            <input type="radio" name="genero" value="<?=$generos['valor']?>" checked><span><?=$generos['dato']?></span>
                        </div>
                    <?php else: ?>
                        <div class="check-box">
                            <input type="radio" name="genero" value="<?=$generos['valor']?>"><span><?=$generos['dato']?></span>
                        </div>
                    <?php endif; }?>
                </div>
            </section>

            <!--SECCION PROVINCIA-->
            <section class="form-editar">
                <label for="ubicacion">Provincia:</label>
                <select class="" name="provincia">
                    <?php if($provinciaRespuesta  == ""): ?>
                        <option hidden value=""> <i>Seleccionar</i> </option>
                    <?php endif; ?>
                    <?php foreach ($listaProvincia as $unaProvincia) {
                        if ($provinciaRespuesta == $unaProvincia['dato']):?>
                        <option value='<?=$unaProvincia['valor']?>' selected>
                            <?=$unaProvincia['dato']?>
                        </option>
                        <?php else: ?>
                            <option value='<?=$unaProvincia['valor']?>'>
                                <?=$unaProvincia['dato']?>
                            </option>
                        <?php endif; }?>
                </select>
            </section>

            <!-- FECHA DE NACIMIENTO -->
            <div class="form-editar">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" value="<?=$fechaNacimientoRespuesta?>">
            </div>

            <!--SECCION FOTO-->
            <div class="form-editar">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" name="foto" value="">
                <span class="error-form"><?=$errorFoto?></span>
            </div>

            <!--BOTON ENVIAR-->
            <div class="editar-button">
                <button type="submit" name="editar">ENVIAR</button>
            </div>
        </form>
    </div>
</main>
<!--FOOTER-->
<?php
    include_once("partials/footer.php");
?>
