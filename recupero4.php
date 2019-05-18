<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    if($_POST) {
    session_destroy();
    }
    $CSS = ['form','perfil'];
    include_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>Olvidé mi contraseña</h2>
            <p>Listo, ya cambiaste tu contraseña. Ahora proba ingresar de nuevo.</p>
            <div class="caja-botones">
                <form class="editar-button-amarillo" action="login.php" method="post">
                    <button type="submit" name="">Iniciar Sesión</button>
                </form>
                <form class="editar-button-rosa" action="index.php" method="post">
                    <button type="submit" name="">Volver al Index</button>
                </form>
            </div>
        </div>
    </div>
</main>
<!--FOOTER-->
<?php
    include_once("includes/footer.php");
?>
