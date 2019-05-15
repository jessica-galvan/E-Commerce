<?php
  // ob_start(); /*Si ves que te salen problemas de header, como el cartel que les pase yo por whatsapp, proba usar esto que deje comentado. Tiene que estar ob_start al inicio de todo y ob_end_flush al final. Asi lo resolvi en el login.*/
  session_start();
  require_once('actions/user-check.php');   /*Esto dejalo en todas las paginas. Es necesario para el menu. */
  sinUsuario(); /*Y esto es para que los que no esten logueados no puedan entrar a esta seccion. */
  require_once('includes/funciones.php'); /*Por ahora solo es necesario para formularios. Te deje unos comentarios y la nueva funcion de reemplazar.*/

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

  // ob_end_flush();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form2.css"> <!--Supongo que va a ser necesaria con lo de edicion de perfil, ya que es un formulario.-->
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
          <div class="main-body register-form">
            <div class="login-text">
              <h2>Editar mi perfil</h2>
            </div>
              <form class="container-editarPerfil" action="perfilUsuario.php" method="post">
                <label for="tipoDePiel">Tipo de piel:</label>
                <br>
                <div class="">
                <input type="radio" name="tipoDePiel" value="n">Normal
                </div>
                <div class="">
                <input type="radio" name="tipoDePiel" value="s">Seca
                </div>
                <div class="">
                <input type="radio" name="tipoDePiel" value="g">Grasa
                </div>
                <div class="">
                <input type="radio" name="tipoDePiel" value="m">Mixta
                </div>

                <br>
                <label for="tonoDePiel">Tono de piel:</label>
                <br>
                <div class="">
                  <div class="">
                  <input type="radio" name="tonoDePiel" value="cla">Clara
                  </div>
                  <div class="">
                  <input type="radio" name="tonoDePiel" value="med">Media
                  </div>
                  <div class="">
                  <input type="radio" name="tonoDePiel" value="osc">Oscura
                  </div>
                  <div class="">
                    <input type="radio" name="tonoDePiel" value="prof">Profunda
                  </div>

                </div>
                <br>
                <div class="input-flex">
                <label for="genero">Género:</label>
                <br>

                <div class="">
                <input type="radio" name="genero" value="fem">Femenino
                </div>
                <div class="">
                <input type="radio" name="genero" value="mas">Masculino
                </div>
                <div class="">
                <input type="radio" name="genero" value="med">Otro
                </div>
                </div>
                <br>
                <p>
                  <label for="ubicacion">Provincia:</label>
                    <select class="" name="provincia">
                      <option hidden value=""> <i>Seleccionar</i> </option>
                      <option value="bsas">Buenos Aires</option>
                      <option value="cat">Catamarca</option>
                      <option value="chac">Chaco</option>
                      <option value="chu">Chubut</option>
                      <option value="cor">Córdoba</option>
                      <option value="corri">Corrientes</option>
                      <option value="entre"> Entre Ríos</option>
                      <option value="for">Formosa</option>
                      <option value="juj">Jujuy</option>
                      <option value="laP"> La Pampa</option>
                      <option value="laR"> La Rioja</option>
                      <option value="men">Mendoza</option>
                      <option value="mi">Misiones</option>
                      <option value="neu">Neuquén</option>
                      <option value="rio"> Río Negro</option>
                      <option value="sal">Salta</option>
                      <option value="sanJ">San Juan</option>
                      <option value="sanL">San Luis</option>
                      <option value="santaC">Santa Cruz</option>
                      <option value="santaF"> Santa Fe</option>
                      <option value="santi">Santiago del Estero</option>
                      <option value="tierr">Tierra del Fuego</option>
                      <option value="tucu">Tucumán</option>
                    </select>
                </p>
                <br>
                <div class="">
                  <label for="foto">Foto de Perfil:</label>
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
