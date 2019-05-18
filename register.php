<?php
    session_start();
    require_once('actions/user-check.php');
    usuarioLogueado();
    require_once('includes/funciones.php');
    require_once('includes/preguntaSeguridad.php');
    if(isset($_POST['registro'])) {
        foreach( $_POST as $variable => $valor ){
          $P[$variable]=trim($valor);
        }
        /*VALIDACIONES*/
        if($P['nombre'] == "") {
            $errorNombre = "* Completar campo";
            $hayErrores = true;
        }
        if ($P['apellido'] == "") {
            $errorApellido = "* Completar campo";
            $hayErrores = true;
        }
        if($P['email']  == ""){
            $errorEmail = "* Completar campo";
            $hayErrores = true;
        } elseif(!filter_var($P['email'] , FILTER_VALIDATE_EMAIL)){
            $errorEmail = "* Email no válido";
            $hayErrores = true;
        } else if(checkEmail($P['email'])) {
            $errorEmail = "* Esta direccion ya  esta registrada. Usa otra.";
            $hayErrores = true;
        }
        if($P['contrasenia'] == ""){
            $errorContrasenia = "* Completar campo";
            $hayErrores = true;
        } elseif(strlen($P['contrasenia']) < 6){
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
        if($P['preguntaSeguridad'] == "") {
            $errorPregunta = "* Selecciona una pregunta";
            $hayErrores = true;
        } else if($P['respuestaSeguridad'] == "") {
            $errorPregunta = "* Completar campo";
            $hayErrores = true;
        }

        /*ARRAY FINAL DEL USUARIO*/
        if(!$hayErrores) {
            /*Este for es para que una vez completado todo, además de guardar el valor de la pregunta, se guarde la pregunta. Asi después en el recordame solo hacemos un echo a la pregunta.*/
            for ($i=0; $i < count($preguntas); $i++) {
                if ($preguntas[$i]['valor'] == $P['preguntaSeguridad']) {
                    $preguntaSeguridad = $preguntas[$i]['pregunta'];
                    break;
                }
            };
            /*Aca tendrian que agregarse todos los valores, hasta los que solo se completarian editando el perfil (pero acá tendrian el valor en blanco)*/
            $listaUsuarios[] = [
                "nombre" => $P['nombre'],
                "apellido" => $P['apellido'],
                "email" => $P['email'],
                "contrasenia" => password_hash($P['contrasenia'], PASSWORD_DEFAULT),
                "foto" => "",
                "preguntaValor" => $P['preguntaSeguridad'],
                "preguntaSeguridad" => $preguntaSeguridad,
                "respuestaSeguridad" => password_hash($P['respuestaSeguridad'], PASSWORD_DEFAULT),
                "generoValor" => "",
                "genero" => "",
                "provinciaValor" => "",
                "provincia" => "",
                "tonoDePielValor" => "",
                "tonoDePiel" => "",
                "tipoDePielValor" => "",
                "tipoDePiel" => "",
                "fechaNacimiento" => "",
            ];
            /*MANDAR A BASE DE DATOS*/
            $listaUsuariosJSON = json_encode($listaUsuarios);
            file_put_contents('includes/user.json', $listaUsuariosJSON);
            // header('location:confirmacion.php');
            $URL="confirmacion.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            exit;
        }
    }
    $CSS = ['form'];
    include_once("includes/header.php");
?>
<main class="main-container">
    <div class="register-form">
        <div class="login-text">
            <h2>Registrate</h2>
        </div>

        <form class="" action="register.php" method="post">
            <div class="form">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" value="<?=$nombre?>">
                <span class="error-form"><?=$errorNombre?></span>
            </div>

            <div class="form">
                <label for="apellido">Apellido</label>
                <input id="apellido" type="text" name="apellido" value="<?=$apellido?>">
                <span class="error-form"><?=$errorApellido?></span>
            </div>

            <div class="form">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" value="<?=$email?>">
                <span class="error-form"><?=$errorEmail?></span>
            </div>

            <div class="form">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="contrasenia" value="<?=$contrasenia?>">
                <span class="error-form"><?=$errorContrasenia?></span>
            </div>

            <div class="form">
                <label for="confirm">Confirmar Contraseña</label>
                <input id="confirm" type="password" name="contraseniaConfirmar" value="<?=$contraseniaConfirmar?>">
            </div>

            <div class="form">
                <label for="preguntaSeguridad">Pregunta de Seguridad</label>
                <select name="preguntaSeguridad">
                    <?php if(($preguntaSeguridad == "")): ?>
                        <option hidden value=""> <i>Seleccionar</i> </option>
                    <?php endif; ?>
                        <?php
                        for($i=0; $i < count($preguntas); $i++):?>
                        <?php if($preguntaValor == $preguntas[$i]['valor']): ?>
                            <option value='<?=$preguntas[$i]['valor']?>' selected>
                                <?=$preguntas[$i]['pregunta']?>
                            </option>
                        <?php else: ?>
                            <option value='<?=$preguntas[$i]['valor']?>'>
                                <?=$preguntas[$i]['pregunta']?>
                            </option>
                        <?php endif; ?>
                    <?php endfor;?>
                </select>
                <input type="text" name="respuestaSeguridad" placeholder="Respuesta" value="<?=$respuestaSeguridad?>">
                <span class="error-form"><?=$errorPregunta?></span>
            </div>

            <div class="login-button">
                <button type="submit" name="registro">ENVIAR</button>
            </div>
        </form>
    </div>
</main>

<!--FOOTER-->
<?php
    include_once("includes/footer.php");
?>
