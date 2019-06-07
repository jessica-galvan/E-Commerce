<?php
    require_once('loader.php');
    $auth->usuarioLogueado();
    require_once('partials/preguntaSeguridad.php');

    $etapa = 'primera';
    $errorEmail = "";
    $errorContrasenia = "";
    $errorPregunta = "";
    $email = "";
    $respuestaSeguridad = "";
    $contrasenia = "";
    $contraseniaConfirmar = "";

    //  PARTE 1
    if(isset($_POST['recupero1'])) {
        $usuarios = $consultaUsuarios->fetchAll(PDO::FETCH_ASSOC);
        $validar = $validator->validateEmail($_POST['email']);
        if($validar){
            $errorEmail = $validar;
        }

        if(!$validar) {
            $_SESSION['email'] = trim($_POST['email']);
            $etapa = "segunda";
            $preguntaSeguridadValor = $baseDatos->getInfoEspecificaUsuario($_SESSION['email'], 'preguntaSeguridad');


            /*Recuperamos la pregunta de seguridad*/
            foreach ($preguntas as $pregunta) {
                if($preguntaSeguridadValor == $pregunta['valor']){
                        $_SESSION['preguntaSeguridad'] = $pregunta['pregunta'];
                }
            }
        }
    }

    //PARTE 2
    if(isset($_POST['recupero2'])) {
        $respuestaSeguridad= trim($_POST['respuestaSeguridad']);
        $validar2 = $baseDatos->verifyRespuestaSeguridad($_SESSION['email'], $respuestaSeguridad);
        if($validar2){
            $errorRespuesta = $validar2;
        }

        if(!$validar2) {
            $etapa = 'tercera';
        }
    }
    //PARTE 3
    if(isset($_POST['recupero3'])) {
        $validar3 = $validator->validateNewPassword($_POST['contrasenia'], $_POST['contraseniaConfirmar']);

        if($validar3){
            $errorContrasenia = $validar3;
        }

        if(!$validar3) {
            /*Una vez que no hay errores, reemplazamos la contraseña anterior por la nueva (pisando el dato).*/
            $nuevaContrasenia = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
            $modificarUsuario = $baseDatos->updateUsuario($_SESSION['email'], 'contrasenia', $nuevaContrasenia);

            /*Por ultimo, si sale false en el modificar usuario, tirar un error.*/
            if(!$modificarUsuario) {
                $etapa = 'cuarta';
            }

            // $usuarioID = $_SESSION['usuarioInfo']['id'];
            //
            // $modificarUsuario = $conex->prepare("UPDATE usuarios SET contrasenia =:contrasenia WHERE id = $usuarioID");
            // $modificarUsuario->bindValue(":contrasenia", $nuevaContrasenia, PDO::PARAM_STR);
            // $modificarUsuario->execute();
            //
            // if(!$modificarUsuario) {
            //     $errorContrasenia = "* Oops! Hubo un problema";
            // } else {
            //
            // }
        }
    }
    //PARTE 4
    if(isset($_POST['recupero4'])) {
        session_destroy();
    }

    /*Header*/
    $CSS = ['form','perfil'];
    require_once("partials/header.php");
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
                    <label for="preguntaSeguridad"><?=$_SESSION['preguntaSeguridad']?></label>
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
    require_once("partials/footer.php");
 ?>
