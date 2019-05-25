<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    $CSS = ['form', 'perfil'];
    require_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>¡Gracias por registrarte!</h2>
        </div>
        <div class="caja-botones">
            <form class="editar-button-amarillo" action="login.php" method="post">
                <button type="submit" name="">Iniciar Sesión</button>
            </form>
            <form class="editar-button-rosa" action="index.php" method="post">
                <button type="submit" name="">Volver al Index</button>
            </form>
        </div>
    </div>
</main>
<!--FOOTER-->
<?php
    require_once("includes/footer.php");
?>
