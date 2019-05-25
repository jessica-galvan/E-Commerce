<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    require_once('includes/funciones.php'); /*Solo es necesario para formularios*/
    $etapa = 'primera';

    //  PARTE 1
    if(isset($_POST['recupero1'])) {
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
            $etapa = "segunda";
            $_SESSION['usuarioInfo'] = getUser('email', $email);
            $preguntaSeguridad = $_SESSION['usuarioInfo']['preguntaSeguridad'];
        }
    }

    //PARTE 2
    if(isset($_POST['recupero2'])) {
        $respuestaSeguridad= trim($_POST['respuestaSeguridad']);

        if($respuestaSeguridad == "") {
            $errorPregunta = "* Tu respuesta no puede estar vacia";
            $hayErrores = true;
        } else if(!password_verify($respuestaSeguridad, $_SESSION['usuarioInfo']['respuestaSeguridad'])) {
            $errorPregunta = "Respuesta incorrecta";
            $hayErrores = true;
        }

        if(!$hayErrores) {
            $etapa = 'tercera';
        }
    }
    //PARTE 3
    if(isset($_POST['recupero3'])) {
        foreach( $_POST as $variable => $valor ){
          $P[$variable]=trim($valor);
        }

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
            reemplazar($_SESSION['usuarioInfo']['email'], 'contrasenia', password_hash($P['contrasenia'], PASSWORD_DEFAULT));
            $listaUsuariosJSON = json_encode($listaUsuarios);
            file_put_contents('includes/user.json', $listaUsuariosJSON);
            $etapa = 'cuarta';
        }
    }
    //PARTE 4
    if(isset($_POST['recupero4'])) {
        session_destroy();
    }

    /*Header*/
    $CSS = ['form','perfil'];
    require_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <?php if($etapa == "primera"):?>
        <div class="">
            <div class="login-text">
                <h2>Olvidé mi contraseña</h2>
                <p>Primero ingresa tu email</p>
            </div>
            <form class="" action="recupero.php" method="post">
                <div class="form">
                    <input id="email" type="text" name="email" placeholder="Email" value="<?=$email?>" >
                    <span class="error-form"><?=$errorEmail?></span>
                </div>

                <div class="login-button">
                    <button type="submit" name="recupero1">ENVIAR</button>
                </div>
            </form>
        </div>
        <?php endif; ?>
        <?php if($etapa == "segunda"):?>
        <div class="">
            <div class="login-text">
                <h2>Olvidé mi contraseña</h2>
                <p>Contesta tu Pregunta de Seguridad</p>
            </div>

            <form class="" action="recupero.php" method="post">
                <div class="form">
                    <label for="preguntaSeguridad"><?=$preguntaSeguridad?></label>
                    <input type="text" name="respuestaSeguridad" placeholder="Respuesta" value="<?=$respuestaSeguridad?>">
                    <span class="error-form"><?=$errorPregunta?></span>
                </div>

                <div class="login-button">
                    <button type="submit" name="recupero2">ENVIAR</button>
                </div>
        </div>
        <?php endif; ?>
        <?php if($etapa == "tercera"):?>
        <div class="">
            <div class="login-text">
                <h2>Olvidé mi contraseña</h2>
                <p>Ingresa tu nueva contraseña</p>
            </div>

            <form class="" action="recupero.php" method="post">
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
                    <button type="submit" name="recupero3">ENVIAR</button>
                </div>
            </form>
        </div>
        <?php endif; ?>
        <?php if($etapa == "cuarta"):?>
        <div class="">
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
        <?php endif; ?>
    </div>
</main>
 <?php
    /*Footer*/
    require_once("includes/footer.php");
 ?>
