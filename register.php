<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Fenty Beauty</title>
  </head>
  <body>
    <div class="xl-screen">
      <div class="body-container">
        <!--HEADER-->
        <?php
          include_once("includes/header.php");
         ?>

         <main class="main-container">
           <div class="register-form">
             <div class="login-text">
               <h2>Registrate</h2>
             </div>

             <form class="" action="index.php" method="post">
               <div class="form">
                 <label for="nombre">Nombre</label>
                 <input id="nombre" type="text" name="nombre" value="" required>
               </div>

               <div class="form">
                 <label for="apellido">Apellido</label>
                 <input id="apellido" type="text" name="apellido" value="" required>
               </div>

               <div class="form">
                 <label for="email">Email</label>
                 <input id="email" type="email" name="email" value="" required>
               </div>

               <div class="form">
                 <label for="password">Contraseña</label>
                 <input id="password" type="password" name="password" value="" required>
               </div>

               <div class="form">
                 <label for="confirm">Confirmar Contraseña</label>
                 <input id="confirm" type="password" name="password" value="" required>
               </div>

               <div class="login-button">
                 <button type="submit" name="login">ENVIAR</button>
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
