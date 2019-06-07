<?php
    require_once('loader.php');
    $auth->usuarioLogueado();
    require_once('actions/user-check.php');
    require_once('partials/preguntaSeguridad.php');

    /*Data vacia*/
    $nombre = "";
    $apellido = "";
    $email = "";
    $contrasenia = "";
    $contraseniaConfirmar = "";
    $preguntaSeguridad = "";
    $respuestaSeguridad = "";
    $errorNombre = "";
    $errorApellido = "";
    $errorEmail = "";
    $errorContrasenia = "";
    $errorPregunta = "";
    $errorPrincial = "";


    if(isset($_POST['registro'])) {
        /*Este foreach es para pisar la variable de los campos. Asi persisten si hay errores.*/
        foreach( $_POST as $variable => $valor ){
          $$variable = trim($valor);
          /*el $$ es para que lo que va en variable (que seria un indice de $_POST), me lo haga variable fuera del foreach. No se porque, pero funciona, no lo cuestionen. El $P[$variable] funcionaba, pero era un quilombo hacer la persistencia de datos, y haciendo esto de la $$, resuelvo eso sin tener que cambiar nada del formulario.*/
        }

        $validar = $validator->registerValidate($nombre, $apellido, $email, $contrasenia, $contraseniaConfirmar, $preguntaSeguridad, $respuestaSeguridad);

        if($validar){
            foreach($validar as $indice => $valor ){
              $$indice=$valor;
            }
            $contrasenia = "";
            $contraseniaConfirmar = "";
        }
        /*Este foreach es para que si hay algun error en la validacion del registro. Si no lo hay, registerValidate va a devolver false. Si la hay, va a hacer que el indice del error reemplace a la variable donde esta el error y que aparezca abajo del campo deseado en el formulario
        Además piso las variables de contrasenia y contraseniaConfirmar para que el usuario las tenga que reescribir*/

        /*ARRAY FINAL DEL USUARIO*/
        if(!$validar) {
            /*Primero creo el perfil, asi obtengo el ID de esa y se lo puedo agregar al perfil_id en la tabla usuario*/
            $crearPerfil = $conex->query("INSERT INTO perfiles (id) VALUES (null)");
            $perfil_id = $conex->lastInsertId();

            /*Segundo: Hasheo*/
            $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
            $respuestaSeguridad = password_hash($respuestaSeguridad, PASSWORD_DEFAULT);

            /*Tercero: creo el usuario en la base de datos*/
            $crear = $baseDatos->createUser($nombre, $apellido, $email, $contrasenia, $preguntaSeguridad, $respuestaSeguridad, $perfil_id);

            /*Cuarto: check si hubo problemas. Si no hubo, envialos a confirmacion.php, sino, tirar error.*/
            if(!$crear){
                header('location:confirmacion.php');
                echo "<script type='text/javascript'>document.location.href='confirmacion.php';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=confirmacion.php">';
                exit;
            } else {
                $errorPrincial = $crear;
            }
        }
    }
    /*Header*/
    $CSS = ['form'];
    require_once("partials/header.php");
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
                        <?php if($preguntaSeguridad == $preguntas[$i]['valor']): ?>
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

            <span class="error-form"><?=$errorPrincial?></span>
            <div class="login-button">
                <button type="submit" name="registro">ENVIAR</button>
            </div>
        </form>
    </div>
</main>

<?php
    /*Footer*/
    require_once("partials/footer.php");
?>
