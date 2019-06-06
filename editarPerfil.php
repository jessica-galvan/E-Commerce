<?php
    ob_start();
    require_once('loader.php');
    $auth->usuarioNoLogueado();
    require_once("partials/listas-editar.php");
    /*Lo primero que necesitamos*/
    $email = $_SESSION['email_usuario'];
    $usuarioRecuperado = $baseDatos->getUserPerfil($email);
    $genero = $usuarioRecuperado['genero'];
    $tonoDePiel = $usuarioRecuperado['tonoDePiel'];
    $tipoDePiel = $usuarioRecuperado['tipoDePiel'];
    $provincia = $usuarioRecuperado['provincia'];
    $fechaNacimiento = $usuarioRecuperado['fechaNacimiento'];
    $errorFoto = "";

    /*Si hay POST. No hay necesidad de validar. Y solo updatear el array con lo que se completo.*/
    if(isset($_POST['editar']) || isset($_FILES["foto"])) {
        if(isset($_POST['tipoDePiel']) && $_POST['tipoDePiel'] != "") {
            $tipoDePielValor = $_POST['tipoDePiel'];
            $tipoDePiel = recuperarDato($tiposLista, $tipoDePielValor, $tipoDePiel);
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['tipoDePielValor'] = $tipoDePielValor;
                    $listaUsuarios[$i]['tipoDePiel'] = $tipoDePiel;
                    break;
                }
            }
        }
        if(isset($_POST['tonoDePiel']) && $_POST['tonoDePiel'] != "") {
            $tonoDePielValor = $_POST['tonoDePiel'];
            $tonoDePiel = recuperarDato($tonosLista, $tonoDePielValor, $tonoDePiel);
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['tonoDePielValor'] = $tonoDePielValor;
                    $listaUsuarios[$i]['tonoDePiel'] = $tonoDePiel;
                    break;
                }
            }
        }
        if(isset($_POST['genero']) && $_POST['genero'] != "") {
            $generoValor = $_POST['genero'];
            $genero = recuperarDato($generosLista, $generoValor, $genero);
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['generoValor'] = $generoValor;
                    $listaUsuarios[$i]['genero'] = $genero;
                    break;
                }
            }
        }
        if(isset($_POST['provincia']) && $_POST['provincia'] != "") {
            $provinciaValor = $_POST['provincia'];
            $provincia = recuperarDato($provinciasLista, $provinciaValor, $provincia);
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['provinciaValor'] = $provinciaValor;
                    $listaUsuarios[$i]['provincia'] = $provincia;
                    break;
                }
            }
        }
        if(isset($_POST['fechaNacimiento'])) {
            $fechaNacimiento =  $_POST['fechaNacimiento'];
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['fechaNacimiento'] = $fechaNacimiento;
                    break;
                }
            }
        }

        if(isset($_FILES["foto"])){
            /*Primero habria que validar la foto, luego subir el cambio de avatar y preparar lo que se va a subir a las base de datos. */
            $foto = $_FILES["foto"];
            $validarFoto = $validator->imagenValidate($foto);

            var_dump($validarFoto);
            exit;

            // if(!$validarFoto){
            //     $fotoNombre = $baseDatos->changeAvatar($foto);
            // } else {
            //     $errorFoto = $validarFoto;
            // }


            // if($_FILES["foto"]["error"] === UPLOAD_ERR_OK){
            //     $nombreArchivo = $_FILES["foto"]["name"];
            //     $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
            //     $origen = $_FILES["foto"]["tmp_name"];
            //
            //     /*para poner parte del email del usuario en el nombre.*/
            //     $email = $_SESSION['email_usuario']; /*Para que utilice el email de la sesion*/
            //     $separar = strpos($email, '@'); /*Esto busca donde esta el @ en el sting de $email.*/
            //     $divido  = str_split($email, $separar); /*Y acá. utilizando la posicion del @, separo en un array numerico -del email hasta el @ en posicion 0 y el resto en posicion 1. */
            //     $fotoNombre = $divido[0]; /*Para que me ponga lo que separe primero*/
            //     /*Donde se guarda la foto y como se va a llamar. En este caso va a ir a la carpeta User. Si queres ponerla en otro lado, genial!*/
            //     $destino = "";
            //     $destino = $destino."img/user-avatar/";
            //     $destino = $destino."$fotoNombre-fotoPerfil.".$ext;
            //     $subir = move_uploaded_file($origen,$destino);
            //     move_uploaded_file($origen,$destino);
            //     $foto = $destino;   /*$foto es la ruta a la foto, para guardarla en el array.*/
            //     for ($i=0; $i < count($listaUsuarios); $i++) {
            //         if($listaUsuarios[$i]['email'] == $email){
            //             $listaUsuarios[$i]['foto'] = $foto;
            //             break;
            //         }
            //     }
            // } else if ($_FILES['foto']["error"] != 4){
            //     $errorFoto = "* Hubo un problema";
            //     $hayErrores = true;
            // }
        }

        /*Una ves que terminaste de reemplazar todo....*/
        $listaUsuariosJSON = json_encode($listaUsuarios);
        file_put_contents('includes/user.json', $listaUsuariosJSON);
        // header('location:perfilUsuario.php');
        if(!$hayErrores) {
            echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
            exit;
        }
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
                foreach ($tiposLista as $tipo) {
                    if ($tipoDePiel == $tipo['dato']): ?>
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
                <?php foreach ($tonosLista as $tono) {
                    if ($tonoDePiel == $tono['dato']):?>
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
                    <?php foreach ($generosLista as $generos) {
                        if ($genero == $generos['dato']):?>
                        <div class="check-box">
                            <input type="radio" name="tonoDePiel" value="<?=$generos['valor']?>" checked><span><?=$generos['dato']?></span>
                        </div>
                    <?php else: ?>
                        <div class="check-box">
                            <input type="radio" name="tonoDePiel" value="<?=$generos['valor']?>"><span><?=$generos['dato']?></span>
                        </div>
                    <?php endif; }?>
                </div>
            </section>

            <!--SECCION PROVINCIA-->
            <section class="form-editar">
                <label for="ubicacion">Provincia:</label>
                <select class="" name="provincia">
                    <?php if($provincia  == ""): ?>
                        <option hidden value=""> <i>Seleccionar</i> </option>
                    <?php endif; ?>
                    <?php foreach ($provinciasLista as $provincias) {
                        if ($provincia == $provincias['dato']):?>
                        <option value='<?=$provincias['valor']?>' selected>
                            <?=$provincias['dato']?>
                        </option>
                        <?php else: ?>
                            <option value='<?=$provincias['valor']?>'>
                                <?=$provincias['dato']?>
                            </option>
                        <?php endif; }?>
                </select>
            </section>

            <!-- FECHA DE NACIMIENTO -->
            <div class="form-editar">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" value="<?=$fechaNacimiento?>">
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
