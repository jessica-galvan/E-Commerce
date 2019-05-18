<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    require_once('includes/funciones.php'); /*Solo es necesario para formularios*/
    $usuarioRecuperado = $_SESSION['infoGuardada'];
    $email = $_SESSION['emailGuardado'];

    if($_POST) {
        foreach( $_POST as $variable => $valor ){
          $P[$variable]=trim($valor);
        }
        // $contrasenia = trim($_POST['contrasenia']);
        // $contraseniaConfirmar = trim($_POST['contraseniaConfirmar']);

        if($P['contrasenia'] == ""){
            $errorContrasenia = "* Completa la contraseña";
            $hayErrores = true;
            } else if(strlen($P['contrasenia']) < 6){
            $errorContrasenia = "* La contraseña debe tener más de 6 caracteres";
            $hayErrores = true;
            $contrasenia = "";
            $contraseniaConfirmar = "";
        } else if($P['contrasenia'] != $P['contraseniaConfirmar']) {
            $errorContrasenia = "* Las contraseñas no coinciden";
            $hayErrores = true;
            $contrasenia = "";
            $contraseniaConfirmar = "";
        }

        if(!$hayErrores) {
            /*Una vez que no hay errores, reemplazamos la contraseña anterior por la nueva (pisando el dato).*/
            for ($i=0; $i < count($listaUsuarios); $i++) {
                if($listaUsuarios[$i]['email'] == $email){
                    $listaUsuarios[$i]['contrasenia'] =  password_hash($P['contrasenia'], PASSWORD_DEFAULT);
                    break;
                }
            }

            $listaUsuariosJSON = json_encode($listaUsuarios);
            file_put_contents('includes/user.json', $listaUsuariosJSON);
            // header('location:recupero4.php');
            $URL="recupero4.php";
            echo "<script type='text/javascript'>document.location.href='recupero4.php';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=recupero4.php">';
        }
    }
    $CSS=['form'];
    include_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>Olvidé mi contraseña</h2>
            <p>Ingresa tu nueva contraseña</p>
        </div>

        <form class="" action="recupero3.php" method="post">
            <div class="form">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="contrasenia" value="<?=$contrasenia?>">
                <span class="error-form"><?=$errorContrasenia?></span>
            </div>

            <div class="form">
                <label for="confirm">Confirmar Contraseña</label>
                <input id="confirm" type="password" name="contraseniaConfirmar" value="<?=$contraseniaConfirmar?>">
            </div>
            <div class="login-button">
                <button type="submit" name="login">ENVIAR</button>
            </div>
        </form>
    </div>
</main>

<!--FOOTER-->
<?php
    include_once("includes/footer.php");
?>
