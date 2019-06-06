<?php
    ob_start();
    require_once('loader.php');
    $auth->usuarioLogueado();
    require_once('actions/user-check.php');
    // require_once('partials/funciones.php'); /*Solo es necesario para formularios*/

    $email = "";
    $contrasenia = "";
    $recordar = "";
    $errorEmail = "";
    $errorContrasenia = "";

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];
        $validar = $baseDatos->validateLogin($email, $contrasenia);

        if($validar){
            foreach($validar as $indice => $valor ){
              $$indice=$valor;
            }
            $contrasenia = "";
        }

        if(isset($_POST['recordar'])) {
            $recordar = "checked";
        }

        if(!$validar) {
            $auth->login($email);
            /*SI EL RECORDAR ESTA TILDADO, SETEAR UNA COOKIE.*/
            if(isset($_POST['recordar'])) {
                $auth->recordar($email);
            } else {
                $auth->borrarCookiesLogin();
            }

            /*EN AMBOS CASOS, ANDA A PERFIL.*/
            echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
            // header('location:confirmacion.php');
        }
    }
    $CSS = ['form'];
    require_once("partials/header.php");
    ob_end_flush();
?>
<main class="main-container">
    <div class="form-container">
        <div class="login-text">
            <h2>Ingresá a tu cuenta</h2>
        </div>

        <form class="login-form" action="login.php" method="post">
            <div class="form">
                <input type="text" id="email" name="email" value="<?=$email?>" placeholder="Email">
                <span class="error-form"><?=$errorEmail?></span>
            </div>
            <div class="form">
                <input type="password" id="contrasenia" name="contrasenia" value="" placeholder="Contraseña">
                <span class="error-form"><?=$errorContrasenia?></span>
            </div>
            <div class="remember">
                <label for="recordar">Recordarme</label>
                <input id="recordar" type="checkbox" name="recordar" value="si" <?=$recordar?>>
            </div>
            <div class="login-button">
                <button type="submit" name="login">Ingresar</button>
            </div>
        </form>

        <div class="form-links">
            <a href="recupero.php">¿Olvidó su contraseña?</a>
        </div>
    </div>

    <div class="register-container">
        <div class="login-text">
            <h2>¿No tenés una cuenta?</h2>
            <p>Completa este formulario y crea tu cuenta para obtener varios beneficios.</p>
        </div>
        <form class="login-button" action="register.php" method="post">
            <button type="submit" name="">Registrarse</button>
        </form>
    </div>
</main>
<!--FOOTER-->
<?php
include_once("partials/footer.php");
?>
