<?php
  ob_start();
  session_start();
  require_once('actions/user-check.php');  //Esto dejalo en todas las paginas. Es necesario para el menu.
  sinUsuario();
  require_once('includes/funciones.php'); /*Por ahora solo es necesario para formularios. Te deje unos comentarios y la nueva funcion de reemplazar.*/
  require_once("includes/listas-editar.php");

  $email = $_SESSION['email_usuario'];
  getUser('email', $email); /*De acá sale el $usuarioRecuperado*/
  $nombre = $usuarioRecuperado['nombre'];
  $apellido = $usuarioRecuperado['apellido'];

  $nombreCompleto = $nombre." ".$apellido;

  /*Si el usuario completo los datos, se van a ver, sino en el array estan vacios. ¿Quizas habria que hacer algo en caso de que este en blanco?*/
  $genero = $usuarioRecuperado['genero'];
  $tonoDePiel = $usuarioRecuperado['tonoDePiel'];;
  $tipoDePiel = $usuarioRecuperado['tipoDePiel'];
  $provincia = $usuarioRecuperado["provincia"];
  $foto = $usuarioRecuperado["foto"] != ""?$usuarioRecuperado["foto"]: "img/user-profile-basic.jpg";
  $fechaNacimientoOriginal = $usuarioRecuperado["fechaNacimiento"];
  /*Este paso es para invertir la fecha, y que se vea Dia-Mes-Año, en vez de Año-Mes-Dia*/
  $fechaNacimiento = date("d-m-Y", strtotime($fechaNacimientoOriginal));

  $edad = calcularEdad($fechaNacimientoOriginal);
  ob_end_flush();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/perfil.css">
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
          <div class="perfil-container">
            <h2>Mi Perfil</h2>

            <div class="fotoPerfil">
              <img src="<?=$foto?>" alt="Foto Perfil">
            </div>

            <div class="nombreUsuario">
              <h3 id="nombreUsuario"><?=$nombreCompleto;?></h3>
            </div>

            <div class="datosBasicos">
              <h4>Email: </h4><span><?=$email?></span>
              <h4>Genero: </h4> <span><?=$genero?></span>
              <h4>Edad: </h4> <span><?=$edad?></span>
              <h4>Fecha de Nacimiento: </h4><span><?=$fechaNacimiento?></span>
              <h4>Provincia: </h4><span><?=$provincia?></span>
              <h4>Tipo de Piel: </h4><span><?=$tipoDePiel?></span>
              <h4>Tono de Piel: </h4><span><?=$tonoDePiel?></span>
            </div>


            <div class="caja-botones">
              <form class="editar-button-violeta " action="editarPerfil.php" method="post">
                <button type="submit" name="logout">Editar Perfil</button>
              </form>
              <form class="editar-button-amarillo" action="cambiarContrasenia.php" method="post">
                <button type="submit" name="cambiarContrasenia">Cambiar Contraseña</button>
              </form>
              <form class="editar-button-rosa" action="actions/logout.php" method="post">
                <button type="submit" name="logout">Cerra sesión</button>
              </form>
            </div>

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
