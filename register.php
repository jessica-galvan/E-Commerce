<?php
  session_start();
  require_once('actions/user-check.php');
  require_once('includes/funciones.php');

  if(isset($_POST['registro'])) {
    $nombre =isset($_POST['nombre'])?trim($_POST['nombre']): "";
    $apellido = isset($_POST['apellido'])?trim($_POST['apellido']): "";
    $email = isset($_POST['email'])?trim($_POST['email']): "";
    $contrasenia = isset($_POST['contrasenia'])?trim($_POST['contrasenia']): "";
    $contraseniaConfirmar = isset($_POST['contraseniaConfirmar'])?trim($_POST['contraseniaConfirmar']): "";
    $preguntaValor = isset($_POST['preguntaSeguridad'])?$_POST['preguntaSeguridad']: "";
    $preguntaSeguridad = "";
    $respuestaSeguridad= isset($_POST['respuestaSeguridad'])?trim($_POST['respuestaSeguridad']): "";

    if($nombre == "") {
      $errorNombre = "* Completa el nombre";
      $hayErrores = true;
    }

    if ($apellido == "") {
      $errorApellido = "* Completa el apellido";
      $hayErrores = true;
    }

    if($email == ""){
      $errorEmail = "* Completa el email";
      $hayErrores = true;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errorEmail = "* Email no válido";
      $hayErrores = true;
    } else if(checkEmail($email)) {
      $errorEmail = "* Esta direccion ya  esta registrada. Usa otra.";
      $hayErrores = true;
    }


    if($contrasenia == ""){
      $errorContrasenia = "* Completa la contraseña";
      $hayErrores = true;
    } else if(strlen($contrasenia) < 6){
      $errorContrasenia = "* La contraseña debe tener más de 6 caracteres";
      $hayErrores = true;
      $contrasenia = "";
      $contraseniaConfirmar = "";
    } else if($contrasenia != $contraseniaConfirmar) {
      $errorContrasenia = "* Las contraseñas no coinciden";
      $hayErrores = true;
      $contrasenia = "";
      $contraseniaConfirmar = "";
    }

    if($preguntaValor == "") {
      $errorPregunta = "* Selecciona una pregunta";
      $hayErrores = true;
    } else if($respuestaSeguridad == "") {
      $errorPregunta = "* Tu respuesta no puede estar vacia";
      $hayErrores = true;
    }

    if($foto == "") {
      $errorFoto = "Elegi una foto";
    }

    if(isset($_FILES["foto"])){
      if($_FILES["foto"]["error"] === UPLOAD_ERR_OK){
        $nombreArchivo = $_FILES["foto"]["name"];
        $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        $origen = $_FILES["foto"]["tmp_name"];

        /*para poner parte del email del usuario en el nombre*/
        $separar = strpos($email, '@');
        $divido  = str_split($email, $separar);
        $fotoNombre = $divido[0];

        $destino = "";
        $destino = $destino."user/";
        $destino = $destino."$fotoNombre-fotoPerfil.".$ext;

        move_uploaded_file($origen,$destino);
        $foto = $destino."$fotoNombre-fotoPerfil.".$ext;
      }
    } else {
      $errorFoto = "Elegi una foto";
      $hayErrores = true;
    }

    /*ARRAY FINAL DEL USUARIO*/
    if(!$hayErrores) {
      require_once('includes/preguntaSeguridad.php');
      for ($i=0; $i < count($preguntas); $i++) {
        if ($preguntas[$i]['valor'] == $preguntaValor) {
          $preguntaSeguridad = $preguntas[$i]['pregunta'];
          break;
        }
        return $preguntaSeguridad;
      };

      $usuarioEnArray = [
        "nombre" => $nombre,
        "apellido" => $apellido,
        "email" => $email,
        "contrasenia" => password_hash($contrasenia, PASSWORD_DEFAULT),
        "preguntaValor" => $preguntaValor,
        "preguntaSeguridad" => $preguntaSeguridad,
        "respuestaSeguridad" => password_hash($respuestaSeguridad, PASSWORD_DEFAULT),
        "foto" => $foto,
      ];

      /*MANDAR A BASE DE DATOS*/
      $listaUsuarios[] = $usuarioEnArray;
      $listaUsuariosJSON = json_encode($listaUsuarios);
      file_put_contents('includes/user.json', $listaUsuariosJSON);
      // header('location:confirmacion.php');
      $URL="confirmacion.php";
      echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      exit;
    }
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Fancy Beauty</title>
  </head>
  <body>
    <div class="xl-screen">
      <div class="body-container">
        <!--HEADER-->
        <?php
          include_once("includes/header.php");
        ?>
         <main class="main-container">
           <div class="register-form">
             <div class="login-text">
               <h2>Registrate</h2>
             </div>

             <form class="" action="register.php" method="post" enctype="multipart/form-data">
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
                    include_once("includes/preguntaSeguridad.php");
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

               <div class="form">
                 <label for="fotoPerfil">Foto de Perfil</label>
                 <input type="file" name="foto" value="">
                 <span class="error-form"><?=$errorFoto?></span>
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
       </div>
      </div>
  </body>
</html>
