<?php
  ob_start();
  session_start();
  require_once('actions/user-check.php');  //Esto dejalo en todas las paginas. Es necesario para el menu.
  sinUsuario();
  ob_end_flush();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/faq.css"> <!--No le cree un css aparte para esta seccion, si queres armarsela, fantastico.-->
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

            <h2>¿Quéres desloguearte?</h2>
            <br>
            <form class="" action="actions/logout.php" method="post">
              <button type="submit" name="logout">Cerra sesión</button>
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