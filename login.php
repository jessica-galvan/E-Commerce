<?php
    ob_start();
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    require_once('includes/funciones.php'); /*Solo es necesario para formularios*/
    if(isset($_POST['login'])) {
        foreach( $_POST as $variable => $valor ){
          $P[$variable]=trim($valor);
        }
        /*VALIDACIONES*/
        if($P['email']== ""){
            $errorEmail = "* Completa el email";
            $hayErrores = true;
        } else if(!filter_var($P['email'], FILTER_VALIDATE_EMAIL)){
            $errorEmail = "* Email no válido";
            $hayErrores = true;
        } else if (!checkEmail($P['email'])) {
            $errorEmail = "Ese email no esta registrado.";
            $hayErrores = true;
        }
        if($P['contrasenia'] == ""){
            $errorContrasenia = "* Completa la contraseña";
            $hayErrores = true;
        } else if(checkEmail($P['email'])){ /*COMPARAR CONTRASEÑAS*/
            getUser('email', $P['email']);
            if(password_verify($P['contrasenia'], $usuarioRecuperado['contrasenia'])){
                $hayErrores = false;
            } else {
                $hayErrores = true;
                $errorContrasenia = "* Email o contraseña invalidas";
            }
        }

        if(isset($_POST['recordar'])) {
            $recordar = "checked";
        }

        if(!$hayErrores) {
            global $usuarioRecuperado;
            $_SESSION["email_usuario"] = $P['email'];
            $_SESSION["nombre_usuario"] = $usuarioRecuperado["nombre"];
            /*SI EL RECORDAR ESTA TILDADO, SETEAR UNA COOKIE.*/
            if(isset($_POST['recordar'])) {
                $expirar = time() + 60*60*24*30; /*30 DIAS*/
                setcookie('email_usuario', $P['email'], $expirar, '/', $_SERVER['HTTP_HOST']);
                setcookie('nombre_usuario', $usuarioRecuperado["nombre"], $expirar, '/', $_SERVER['HTTP_HOST']);
            } else {
                borrarCookiesLogin();
            }
            /*EN AMBOS CASOS, ANDA A CONFIRMAR.*/
            echo "<script type='text/javascript'>document.location.href='perfilUsuario.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=perfilUsuario.php">';
            // header('location:confirmacion.php');
        }
    }
    $CSS = ['form'];
    include_once("includes/header.php");
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
            <a href="recupero1.php">¿Olvidó su contraseña?</a>
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
include_once("includes/footer.php");
?>
