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

  /*Segundo, si el usuario ya completo anteriormente la info, que aparesca su respuesta. Excepto la foto. Ya esta armado en el formulario para que si la info esta completada, se marque.*/
  $generoValor = $usuarioRecuperado['generoValor'];
  $genero = $usuarioRecuperado['genero'];
  $tonoDePielValor = $usuarioRecuperado["tonoDePielValor"];
  $tonoDePiel = $usuarioRecuperado['tonoDePiel'];
  $tipoDePielValor = $usuarioRecuperado['tipoDePielValor'];
  $tipoDePiel = $usuarioRecuperado['tipoDePiel'];
  $provinciaValor = $usuarioRecuperado["provinciaValor"];
  $provincia = $usuarioRecuperado["provincia"];
  $fechaNacimiento = $usuarioRecuperado["fechaNacimiento"];
  /*Sospecho que va a ser más facil si en el registro, te guardo las tres variables que una. Pero depende de como resuelva el soobrescribir.*/
  $dia = "";
  $mes = "";
  $anio = "";

  /*Si hay POST. No hay necesidad de validar. Solo updatear el array con lo que se completo.*/
  if(isset($_POST['editar'])) {
    echo "PRE";
    var_dump(getUser('email',$email));

    if(isset($_POST['tipoDePiel'])) {
      $tipoDePielValor = $_POST['tipoDePiel'];
      reemplazar($email, 'tipoDePielValor', $tipoDePielValor);
    }
    /*MANDAR LOS DATOS*/
    $listaUsuariosJSON = json_encode($listaUsuarios);
    file_put_contents('includes/user.json', $listaUsuariosJSON);

    echo "DATO";
    var_dump($tipoDePielValor);
    echo "USER";
    getUser('email',$email);
    var_dump(getUser('email',$email));
    exit;
    // if(isset($_POST['tonoDePiel'])) {
    //   reemplazar($email,'tonoDePielValor', $tonoDePielValor);
    //   reemplazar($email,'tonoDePiel', $tonoDePiel);
    // }
    // if(isset($_POST['genero'])) {
    //   reemplazar($email,'generoValor', $generoValor);
    //   reemplazar($email,'genero', $genero);
    // }
    // if(isset($_POST['provincia'])) {
    //   reemplazar($email,'provinciaValor', $provinciaValor);
    //   reemplazar($email,'provincia', $provincia);
    // }
    // if(isset($_POST['fechaNacimiento'])) {
    //   reemplazar($email,'fechaNacimiento', $fechaNacimiento);
    // }
    //
    // /*Una ves que terminaste de reemplazar todo....*/
    // // $listaUsuariosJSON = json_encode($listaUsuarios);
    // // file_put_contents('includes/user.json', $listaUsuariosJSON);
    // // header('location:perfilUsuario.php');
    // $URL="perfilUsuario.php";
    // echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    // echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    // exit;
  }

  /*SECCION FOTOS*/
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
      /*$foto es la ruta a la foto, para guardarla en el array.*/
      $foto = $destino;
    } else {
      $errorFoto = "* Hubo un problema";
      $hayErrores = true;
    }
  }
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
            <form class="container-editarPerfil" action="editarPerfil.php" method="post">
              <?php/*FECHA DE NACIMIENTO*/?>
              <section class="fecha-form">
                <label for="">Fecha de Nacimiento</label>
                <!--DIA-->
                <div class="">
                  <select class="" name="dia">
                    <?php if(($dia  == "")): ?>
                      <option hidden value=""> <i>Dia</i> </option>
                    <?php endif; ?>
                    <?php for($i=0; $i < count($dias); $i++):?>
                       <?php if($dia == $dias[$i]): ?>
                         <option value='<?=$dias[$i]?>' selected>
                           <?=$dias[$i]?>
                         </option>
                       <?php else: ?>
                         <option value='<?=$dias[$i]?>'>
                           <?=$dias[$i]?>
                         </option>
                       <?php endif; ?>
                     <?php endfor;?>
                  </select>
                </div>
                <!--MES-->
                <div class="">
                  <select class="" name="mes">
                    <?php if(($mes  == "")): ?>
                      <option hidden value=""> <i>Mes</i> </option>
                    <?php endif; ?>
                    <?php for($i=0; $i < count($meses); $i++):?>
                       <?php if($mes == $meses[$i]['valor']): ?>
                         <option value='<?=$meses[$i]['valor']?>' selected>
                           <?=$meses[$i]['dato']?>
                         </option>
                       <?php else: ?>
                         <option value='<?=$meses[$i]['valor']?>'>
                           <?=$meses[$i]['dato']?>
                         </option>
                       <?php endif; ?>
                     <?php endfor;?>
                </div>

                <br>
                <!--AÑO-->
                <div class="">
                  <select class="" name="anio">
                    <?php if(($anio  == "")): ?>
                      <option hidden value=""> <i>Año</i> </option>
                    <?php endif; ?>
                    <?php for($i=0; $i < count($anios); $i++):?>
                       <?php if($anio == $anios[$i]): ?>
                         <option value='<?=$anios[$i]?>' selected>
                           <?=$anios[$i]?>
                         </option>
                       <?php else: ?>
                         <option value='<?=$anios[$i]?>'>
                           <?=$anios[$i]?>
                         </option>
                       <?php endif; ?>
                     <?php endfor;?>
                  </select>
                </div>
              </section>

              <?php/*SECCION TIPO*/?>
              <section class="form-editar">
                <label for="tipoDePiel">Tipo de piel:</label>
                <?php for($i=0; $i < count($tiposLista); $i++):?>
                  <?php if ($tipoDePielValor == $tiposLista[$i]['valor']): ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tiposLista[$i]['valor']?>" checked><span><?=$tipoLista[$i]['dato']?></span>
                    </div>
                    <?php else: ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tiposLista[$i]['valor']?>"><span><?=$tiposLista[$i]['dato']?></span>
                    </div>
                    <?php endif; ?>
                  <?php endfor; ?>
              </section>

              <?php/*SECCION TONO*/?>
              <section class="form-editar">
                <label for="tonoDePiel">Tono de piel:</label>
                  <?php for($i=0; $i < count($tonosLista); $i++):?>
                    <?php if ($tonoDePielValor == $tonosLista[$i]['valor']): ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tonosLista[$i]['valor']?>" checked><span><?=$tonosLista[$i]['dato']?></span>
                    </div>
                    <?php else: ?>
                    <div class="check-box">
                      <input type="radio" name="tipoDePiel" value="<?=$tonosLista[$i]['valor']?>"><span><?=$tonosLista[$i]['dato']?></span>
                    </div>
                    <?php endif; ?>
                  <?php endfor; ?>
              </section>

              <?php/*SECCION GENERO*/?>
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

              <?php/*SECCION PROVINCIA*/?>
              <section class="form-editar">
                <label for="ubicacion">Provincia:</label>
                <select class="" name="provincia">
                  <?php if(($provinciaValor  == "")): ?>
                    <option hidden value=""> <i>Seleccionar</i> </option>
                  <?php endif; ?>
                  <?php for($i=0; $i < count($provinciasLista); $i++):?>
                     <?php if($provinciaValor == $provinciasLista[$i]['valor']): ?>
                       <option value='<?=$provinciasLista[$i]['valor']?>' selected>
                         <?=$provinciasListas[$i]['dato']?>
                       </option>
                     <?php else: ?>
                       <option value='<?=$provinciasLista[$i]['valor']?>'>
                         <?=$provinciasLista[$i]['dato']?>
                       </option>
                     <?php endif; ?>
                   <?php endfor;?>
                </select>
              </section>

              <?php/*SECCION FOTO*/?>
              <div class="form-editar">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" name="foto" value="">
                <span class="error-form"><?=$errorFoto?></span>
              </div>


              <?php/*BOTON LOGIN*/?>
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
