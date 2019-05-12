<?php
  session_start();
  require_once('actions/user-check.php');
  // if(!isset($_SESSION['emailUsuario'])) {  /*Si no hay usuario logueado, redireccionalos a login*/
  //   header('location:login.php');
  // }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/faq.css">
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
            <br>
            <h2>Control Info</h2>
            <?php
            var_dump($_SESSION);
            var_dump($_COOKIE);
            ?>
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
