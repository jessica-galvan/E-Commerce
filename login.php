<!DOCTYPE html>
<html>
  <head>
    <!--Meta TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Links-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Handlee|Open+Sans" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/form.css">


    <title>Fenty Beauty</title>
  </head>

  <body>
    <!--HEADER-->
    <?php
      include_once("includes/header.php");
     ?>

    <!--CONTENIDO PRINCIPAL-->
    <div class="body-container">
       <!--LOGIN-->
     <main class="main-container"> <!--Esto es un contenedor general-->

         <!--Contenedor del Form-->
         <div class="form-container">
           <!--TEXTO DE BIENVENIDA-->
           <div class="login-text">
             <h2>Ingresá a tu cuenta</h2>
           </div>

           <!--FORMULARIO-->
           <form class="login-form" action="index.html" method="post">
             <div class="form">
               <!-- <label for="email">Email</label> -->
               <input type="email" id="email" name="email" value="" placeholder="Email" required>
             </div>

             <div class="form">
               <!-- <label for="password">Constraseña</label> -->
               <input type="password" id="password" name="password" value="" placeholder="Contraseña" required>
             </div>

             <div class="remember">
               <label for="remember">Recordar</label>
               <input id="remember" type="checkbox" name="remember" value="">
             </div>

             <div class="login-button">
               <button type="submit" name="login">Ingresar</button>
             </div>
           </form>

           <div class="form-links">
             <a href="#">¿Olvidó su contraseña?</a>
           </div>
          </div>

        <div class="register-container">
          <div class="login-text">
            <h2>¿No tenes una cuenta?</h2>
            <p>Completa este formulario y crea tu cuenta para obtener varios beneficios.</p>
          </div>

          <form class="login-button" action="register.php" method="post">
            <button type="submit" name="button">Registrarse</button>
          </form>
        </div>
       </main>

     </div>

     <!--FOOTER-->
     <?php
     include_once("includes/footer.php");
     ?>
  </body>
</html>
