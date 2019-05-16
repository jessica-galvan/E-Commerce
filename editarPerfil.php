<?php
  ob_start();
  session_start();
  require_once('actions/user-check.php');
  sinUsuario();
  require_once('includes/funciones.php');
  require_once("includes/listas-editar.php");
  /*Lo primero que necesitamos*/
  $email = $_SESSION['email_usuario'];
  getUser('email', $email);
  // var_dump($usuarioRecuperado);
  /*Segundo, si el usuario ya completo anteriormente la info, que aparesca su respuesta. Excepto la foto. Ya esta armado en el formulario para que si la info esta completada, se marque.*/
  $generoValor = $usuarioRecuperado['generoValor'];
  $genero = $usuarioRecuperado['genero'];
  $tonoDePielValor = $usuarioRecuperado["tonoDePielValor"];
  $tonoDePiel = $usuarioRecuperado['tonoDePiel'];
  $tipoDePielValor = $usuarioRecuperado['tipoDePielValor'];
  $tipoDePiel = $usuarioRecuperado['tipoDePiel'];
  $provinciaValor = $usuarioRecuperado['provinciaValor'];
  $provincia = $usuarioRecuperado['provincia'];
  $fechaNacimiento = $usuarioRecuperado['fechaNacimiento'];

  /*Si hay POST. No hay necesidad de validar. Y solo updatear el array con lo que se completo.*/
  if(isset($_POST['editar']) || isset($_FILES["foto"])) {
    if(isset($_POST['tipoDePiel']) && $_POST['tipoDePiel'] != "") {
      $tipoDePielValor = $_POST['tipoDePiel'];
      $tipoDePiel = recuperarDato($tiposLista, $tipoDePielValor, $tipoDePiel);
      reemplazar($email, 'tipoDePielValor', $tipoDePielValor);
      reemplazar($email, 'tipoDePiel', $tipoDePiel);
    }
    if(isset($_POST['tonoDePiel']) && $_POST['tonoDePiel'] != "") {
      $tonoDePielValor = $_POST['tonoDePiel'];
      $tonoDePiel = recuperarDato($tonosLista, $tonoDePielValor, $tonoDePiel);
      reemplazar($email,'tonoDePielValor', $tonoDePielValor);
      reemplazar($email,'tonoDePiel', $tonoDePiel);
    }
    if(isset($_POST['genero']) && $_POST['genero'] != "") {
      $generoValor = $_POST['genero'];
      $genero = recuperarDato($generosLista, $generoValor, $genero);
      reemplazar($email,'generoValor', $generoValor);
      reemplazar($email,'genero', $genero);
    }
    if(isset($_POST['provincia']) && $_POST['provincia'] != "") {
      $provinciaValor = $_POST['provincia'];
      $provincia = recuperarDato($provinciasLista, $provinciaValor, $provincia);
      reemplazar($email,'provinciaValor', $provinciaValor);
      reemplazar($email,'provincia', $provincia);
    }
    if(isset($_POST['fechaNacimiento'])) {
      $fechaNacimiento =  $_POST['fechaNacimiento'];
      reemplazar($email,'fechaNacimiento', $fechaNacimiento);
    }


    if(isset($_FILES["foto"])){
      if($_FILES["foto"]["error"] === UPLOAD_ERR_OK){
        $nombreArchivo = $_FILES["foto"]["name"];
        $ext = pathinfo($nombreArchivo,PATHINFO_EXTENSION);
        $origen = $_FILES["foto"]["tmp_name"];

        /*para poner parte del email del usuario en el nombre.*/
        $email = $_SESSION['email_usuario']; /*Para que utilice el email de la sesion*/
        $separar = strpos($email, '@'); /*Esto busca donde esta el @ en el sting de $email.*/
        $divido  = str_split($email, $separar); /*Y acá. utilizando la posicion del @, separo en un array numerico -del email hasta el @ en posicion 0 y el resto en posicion 1. */
        $fotoNombre = $divido[0]; /*Para que me ponga lo que separe primero*/
        /*Donde se guarda la foto y como se va a llamar. En este caso va a ir a la carpeta User. Si queres ponerla en otro lado, genial!*/
        $destino = "";
        $destino = $destino."user/";
        $destino = $destino."$fotoNombre-fotoPerfil.".$ext;
        $subir = move_uploaded_file($origen,$destino);
        $foto = $destino;   /*$foto es la ruta a la foto, para guardarla en el array.*/
        reemplazar($email, 'foto', $foto);
        move_uploaded_file($origen,$destino);
      } else if ($_FILES['foto']["error"] != 4){
        $errorFoto = "* Hubo un problema";
        $hayErrores = true;
      }
    }

    /*Una ves que terminaste de reemplazar todo....*/
    $listaUsuariosJSON = json_encode($listaUsuarios);
    file_put_contents('includes/user.json', $listaUsuariosJSON);
    // header('location:perfilUsuario.php');
    if(!$hayErrores) {
      $URL="perfilUsuario.php";
      echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      exit;
    }
  } /*FIN if($_POST)*/
  ob_end_flush();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
          <div class="editar-form">
            <div class="login-text">
              <h2 id="titulo-editar">Editar mi perfil</h2>
            </div>
            <form class="container-editarPerfil" action="editarPerfil.php" method="post" enctype="multipart/form-data">
              <!-- SECCION TIPO -->
              <section class="form-editar">
                <label for="tipoDePiel">Tipo de piel:</label>
                <?php for($i=0; $i < count($tiposLista); $i++):
                  global $tiposLista;
                  ?>

                  <?php if ($tipoDePielValor == $tiposLista[$i]['valor']): ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tiposLista[$i]['valor']?>" checked><span><?=$tiposLista[$i]['dato']?></span>
                    </div>
                    <?php else: ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tiposLista[$i]['valor']?>"><span><?=$tiposLista[$i]['dato']?></span>
                    </div>
                    <?php endif; ?>
                  <?php endfor; ?>
              </section>

              <!-- SECCION TONO -->
              <section class="form-editar">
                <label for="tonoDePiel">Tono de piel:</label>
                  <?php for($i=0; $i < count($tonosLista); $i++):?>
                    <?php if ($tonoDePielValor == $tonosLista[$i]['valor']): ?>
                    <div class="check-box">
                      <input type="radio" name="tonoDePiel" value="<?=$tonosLista[$i]['valor']?>" checked><span><?=$tonosLista[$i]['dato']?></span>
                    </div>
                    <?php else: ?>
                    <div class="check-box">
                      <input type="radio" name="tonoDePiel" value="<?=$tonosLista[$i]['valor']?>"><span><?=$tonosLista[$i]['dato']?></span>
                    </div>
                    <?php endif; ?>
                  <?php endfor; ?>
              </section>

              <!-- SECCION GENERO -->
              <section class="form-editar" id='genero-checkbox'>
                <label for="genero">Género:</label>
                <div class="genero-options">
                  <?php for($i=0; $i < count($generosLista); $i++):?>
                    <?php if ($generoValor == $generosLista[$i]['valor'] ): ?>
                      <input type="radio" name="genero" value="<?=$generosLista[$i]['valor']?>" checked><span><?=$generosLista[$i]['dato']?></span>
                    <?php else: ?>
                      <input type="radio" name="genero" value="<?=$generosLista[$i]['valor']?>"><span><?=$generosLista[$i]['dato']?></span>
                    <?php endif; ?>
                  <?php endfor; ?>
                </div>
              </section>

              <!--SECCION PROVINCIA-->
              <section class="form-editar">
                <label for="ubicacion">Provincia:</label>
                <select class="" name="provincia">
                  <?php if($provinciaValor  == ""): ?>
                    <option hidden value=""> <i>Seleccionar</i> </option>
                  <?php endif; ?>
                  <?php for($i=0; $i < count($provinciasLista); $i++):?>
                     <?php if($provinciaValor == $provinciasLista[$i]['valor']): ?>
                       <option value='<?=$provinciasLista[$i]['valor']?>' selected>
                         <?=$provinciasLista[$i]['dato']?>
                       </option>
                     <?php else: ?>
                       <option value='<?=$provinciasLista[$i]['valor']?>'>
                         <?=$provinciasLista[$i]['dato']?>
                       </option>
                     <?php endif; ?>
                   <?php endfor;?>
                </select>
              </section>

              <!-- FECHA DE NACIMIENTO -->
              <div class="form-editar">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fechaNacimiento" value="<?=$fechaNacimiento?>">
              </div>

              <!--SECCION FOTO-->
              <div class="form-editar">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" name="foto" value="">
                <span class="error-form"><?=$errorFoto?></span>
              </div>


              <!--BOTON ENVIAR-->
              <div class="editar-button">
                <button type="submit" name="editar">ENVIAR</button>
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
