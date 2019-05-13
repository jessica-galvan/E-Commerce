<?php
  // ob_start(); /*Si ves que te salen problemas de header, como el cartel que les pase yo por whatsapp, proba usar esto que deje comentado. Tiene que estar ob_start al inicio de todo y ob_end_flush al final. Asi lo resolvi en el login.*/
  session_start();
  require_once('actions/user-check.php');   /*Esto dejalo en todas las paginas. Es necesario para el menu. */
  sinUsuario(); /*Y esto es para que los que no esten logueados no puedan entrar a esta seccion. */
  require_once('includes/funciones.php'); /*Por ahora solo es necesario para formularios. Te deje unos comentarios y la nueva funcion de reemplazar.*/


  // ob_end_flush();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css"> <!--Supongo que va a ser necesaria con lo de edicion de perfil, ya que es un formulario.-->
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
          <div class="main-body">




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
