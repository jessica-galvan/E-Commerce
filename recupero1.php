<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    require_once('includes/funciones.php'); /*Solo es necesario para formularios*/

    if($_POST) {
        $email = trim($_POST['email']);
        //Primero validar que sea un email y este registrado.
        if($email == ""){
            $errorEmail = "* Completa el email";
            $hayErrores = true;
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorEmail = "* Email no válido";
            $hayErrores = true;
            } else if(!checkEmail($email)) {
            $errorEmail = "Ese email no esta registrado.";
            $hayErrores = true;
        }

        if(!$hayErrores) {
            $_SESSION['emailGuardado'] = $_POST['email'];
            $usuarioRecuperado = getUser('email', $email);
            $_SESSION['infoGuardada'] = $usuarioRecuperado;
            echo "<script type='text/javascript'>document.location.href='recupero2.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=recupero2.php">';
        }
    }
    $CSS = ['form'];
    include_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>Olvidé mi contraseña</h2>
            <p>Primero ingresa tu email</p>
        </div>
        <form class="" action="recupero1.php" method="post">
            <div class="form">
                <!-- <label for="email">Email</label> -->
                <input id="email" type="text" name="email" placeholder="Email" value="<?=$email?>" >
                <span class="error-form"><?=$errorEmail?></span>
            </div>

            <div class="login-button">
                <button type="submit" name="recupero1">ENVIAR</button>
            </div>
        </form>
    </div>
</main>

 <!--FOOTER-->
 <?php
    include_once("includes/footer.php");
 ?>
