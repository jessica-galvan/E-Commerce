<?php
    ob_start();
    session_start();
    require_once('actions/user-check.php');
    sinUsuarioLogueado();
    require_once('includes/funciones.php');
    $usuarioRecuperado = getUser('email', $_SESSION['email_usuario']);
    $contraseniaOriginal = $usuarioRecuperado['contrasenia'];
    $errorContraseniaVieja = "";

    if(isset($_POST['cambiar'])){
        foreach( $_POST as $variable => $valor ){
          $P[$variable]=trim($valor);
        }

        if($P['contraseniaVieja'] == ""){
            $errorContraseniaVieja = "* Completa la contraseña";
            $hayErrores = true;
        } else if(!password_verify($P['contraseniaVieja'], $contraseniaOriginal)){
            $hayErrores = true;
            $errorContrasenia = "* Contraseña invalida";
        } else if($P['contraseniaNueva'] == ""){
            $errorContrasenia = "* Completa la contraseña";
            $hayErrores = true;
        } else if(strlen($P['contraseniaNueva']) < 6){
            $errorContrasenia = "* La contraseña debe tener más de 6 caracteres";
            $hayErrores = true;
        } else if($P['contraseniaNueva'] !=$P['contraseniaConfirmar']) {
            $errorContrasenia = "* Las contraseñas no coinciden";
            $hayErrores = true;
        }

        if(!$hayErrores) {
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $_SESSION['email_usuario']){
                    $listaUsuarios[$i]['contrasenia'] = password_hash($P['contraseniaNueva'], PASSWORD_DEFAULT);
                    break;
                }
            }

            $listaUsuariosJSON = json_encode($listaUsuarios);
            file_put_contents('includes/user.json', $listaUsuariosJSON);
            // header('location:perfilUsuario.php');
            echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
            exit;
        }
    }
    $CSS = ['form'];
    require_once("includes/header.php");
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
    require_once("includes/footer.php");
?>
