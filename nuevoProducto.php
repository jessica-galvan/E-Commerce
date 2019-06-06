<?php
    session_start();
    require_once('actions/user-check.php');
    // sinUsuarioLogueado();
    require_once('partials/funciones.php');
    require_once('partials/conexion.php');
    $nombre = "";
    $precio = "";
    $descripcion = "";
    $categoria = "";
    $estado = "";
    $tipoProducto = "";
    $errorDescripcion = "";
    $errorPrecio = "";


          //Datos a recibir: Nombre, Precio, Descripcion, rating, foto, estado_id, categoria, tipoProducto. Además le ponemos por POST:  created_at

      if($_POST){

        //VALIDAR

        //Los datos validados tendria que ser subidos a la base de datos.


      }


    /*Header*/
    $CSS = ['form', 'perfil'];
    require_once("partials/header.php");
?>
<main class="main-container">
    <div class="register-form">
      <div class="login-text">
          <h2>Nuevo Producto</h2>
      </div>

      <div class="form-editar">
          <label for="foto">Foto de Perfil:</label>
          <input type="file" name="foto" value="">
          <span class="error-form"><?=$errorFoto?></span>
      </div>


      <form class="" action="nuevoProducto.php" method="post" enctype="multipart/form-data">
        <div class="form">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="<?=$nombre?>">
            <span class="error-form"><?=$errorNombre?></span>
        </div>

        <div class="form">
            <label for="nombre">Descripcion</label>
            <textarea name="descripcion" rows="8" cols="80"><?=$descripcion?></textarea>
            <span class="error-form"><?=$errorDescripcion?></span>
        </div>

        <div class="form">
            <label for="nombre">Precio</label>
            <input id="nombre" type="text" name="precio" value="<?=$precio?>">
            <span class="error-form"><?=$errorPrecio?></span>
        </div>





        <div class="login-button">
            <button type="submit" name="crearProducto">ENVIAR</button>
        </div>
    </form>
</div>
</main>

<?php
/*Footer*/
require_once("partials/footer.php");
?>
