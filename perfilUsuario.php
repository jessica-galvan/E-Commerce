<?php
  ob_start();
  session_start();
  require_once('actions/user-check.php');  //Esto dejalo en todas las paginas. Es necesario para el menu.
  sinUsuarioLogueado();
  require_once('includes/funciones.php'); /*Por ahora solo es necesario para formularios. Te deje unos comentarios y la nueva funcion de reemplazar.*/
  require_once("includes/listas-editar.php");

  $email = $_SESSION['email_usuario'];
  $usuarioRecuperado = getUser('email', $email); /*De acá sale el $usuarioRecuperado*/
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
  if($fechaNacimientoOriginal != "") {
    $fechaNacimiento = date("d-m-Y", strtotime($fechaNacimientoOriginal));
    $edad = calcularEdad($fechaNacimientoOriginal);
  } else {
    $fechaNacimiento = "";
    $edad = "";
  }

  $CSS = ['perfil'];
  require_once("includes/header.php");
  ob_end_flush();
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
                <button type="submit" name="">Editar Perfil</button>
            </form>
            <form class="editar-button-amarillo" action="cambiarContrasenia.php" method="post">
                <button type="submit" name="">Cambiar Contraseña</button>
            </form>
            <form class="editar-button-rosa" action="actions/logout.php" method="post">
                <button type="submit" name="logout">Cerra sesión</button>
            </form>
        </div>
    </div>
</main>
<?php
    /*Footer*/
    require_once("includes/footer.php");
?>
