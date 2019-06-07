<?php
    ob_start();
    require_once('loader.php');
    $auth->usuarioNoLogueado();

    $errorContraseniaVieja = "";
    $errorContrasenia = "";
    // $usuarioRecuperado = $baseDatos->getUser($_SESSION['email_usuario']);

    if(isset($_POST['cambiar'])){
        /*Primero chequeamos que la contrasenia vieja sea la correcta*/
        $verificar = $baseDatos->verifyPassword($_SESSION['email_usuario'], $_POST['contraseniaVieja']);

        if($verificar) {
            /* Si sale un error, imprimilo*/
            $errorContraseniaVieja = $verificar;
        } else {
            /*Si esta todo bien, valida la nueva contrasenia y su confirmacion*/
            $validar = $validator->validateNewPassword($_POST['contraseniaNueva'], $_POST['contraseniaConfirmar']);

            if($validar){
                /*De nuevo, si la validacion de la nueva contrasenia esta mal, imprimila*/
                $errorContrasenia = $validar;
            } else {
                /*Sino, cambiala en la base de datos*/
                $nuevaContrasenia = password_hash($_POST['contraseniaNueva'], PASSWORD_DEFAULT);
                $modificarUsuario = $baseDatos->updateUsuario($_SESSION['email_usuario'], 'contrasenia', $nuevaContrasenia);

                /*Por ultimo, si sale false en el modificar usuario, tirar un error.*/
                if(!$modificarUsuario) {
                    echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
                    exit;
                }
            }
        }
    }
    $CSS = ['form'];
    require_once("partials/header.php");
    ob_end_flush();
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>Cambiar Contraseña</h2>
        </div>

        <form class="cambiarContraseña" action="cambiarContrasenia.php" method="post">
            <?php /*Contraseña Vieja*/?>
            <div class="form">
                <label for="passwordOld">Contraseña Original:</label>
                <input class="cambiarContrasenia" id="passwordOld" type="password" name="contraseniaVieja" value="">
                <span class="error-form"><?=$errorContraseniaVieja?></span>
            </div>

            <?php /*Contraseña Nueva*/?>
            <div class="form">
                <label for="password">Contraseña Nueva</label>
                <input class="cambiarContrasenia" id="password" type="password" name="contraseniaNueva" value="">
                <span class="error-form"><?=$errorContrasenia?></span>
            </div>

            <?php /*Confirmar Contraseña*/?>
            <div class="form">
                <label for="confirm">Confirmar Contraseña</label>
                <input class="cambiarContrasenia" id="confirm" type="password" name="contraseniaConfirmar" value="">
            </div>

            <div class="login-button">
                <button type="submit" name="cambiar">ENVIAR</button>
            </div>
        </form>
    </div>
</main>
<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
