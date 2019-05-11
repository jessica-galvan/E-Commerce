<?php
  session_start();
  include_once('actions/user-check.php');
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
            <h2>Gracias por registrarte!</h2>

            <h3>¿Quéres desloguearte?</h3>

            <form class="" action="actions/logout.php" method="post">
              <button type="submit" name="logout">Cerra sesión</button>
            </form>

            <h2>Control de Usuarios Temporal</h2>
            <?php
            // $listaJSON = file_get_contents('includes/user.json');
            // $listaUsuarios = json_decode($listaJSON, true);
            //
            // var_dump($listaUsuarios);

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
