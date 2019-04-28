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
    <link rel="stylesheet" href="css/ayuda.css">


    <title>Beauty</title>
  </head>

  <body>
    <div class="body-container">
      <!--HEADER-->
      <?php
        include_once("includes/header.php");
       ?>

      <!--Main Cointainer-->
      <main class="main-container">

        <!--Contenedor de Preguntas-->
        <div class="ayuda-body">
          <!--Titulo-->
          <h1 class="faq-title">Preguntas Frecuentes</h1>

          <!--Seccion de Preguntas-->
          <div class="ayuda">
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Dónde puedo encontrar sus productos?</h2>
               </div>

               <div class="respuestas">
                 <p>Actualmente nuestros productos se consiguen solo de forma online en nuestra página oficial.</p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Su marca testea en animales?</h2>
               </div>
               <div class="respuestas">
                 <p>No, estamos orgullosos de decir que desde el inicio nunca testeamos  ninguno de nuestros productos en animales. </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Sus productos son libres de gluten?</h2>
               </div>
               <div class="respuestas">
                 <p>Sí, es importante para nosotros cuidar de la salud de nuestras clientas y sabemos que muchas tienen alergias relacionadas a este por lo que todos nuestros productos son libres de gluten. </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Hacen envíos internacionales?</h2>
               </div>
               <div class="respuestas">
                 <p>No, por el momento hacemos envíos dentro de Argentina. </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Dónde fabrican y crean sus productos?</h2>
               </div>
               <div class="respuestas">
                 <p>Se diseñan y fabrican dentro de Argentina. </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Cómo hago para hacer el seguimiento de mi orden de compras? </h2>
               </div>
               <div class="respuestas">
                 <p>En la página oficial de Correo Argentino vas a poder hacer el seguimiento con tu orden de compra. </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Qué hago si mi orden llega con productos rotos?</h2>
               </div>
               <div class="respuestas">
                 <p> Escribinos a nuestro mail y te daremos una solucion! </p>
               </div>
             </section>
           <section class="cajaDePregunta">
               <div class="preguntas">
                 <h2>¿Puedo comprar sombras individuales específicas que vengan en sus paletas de ojos?</h2>
               </div>
               <div class="respuestas">
                 <p>No, por el momento las sombras que se encuentran dentro de las paletas de ojos no se venden de forma individual. </p>
               </div>
             </section>
         </div>
        </div>
      </main>

       <!--FOOTER-->
       <?php
       include_once("includes/footer.php");
       ?>
     </div>
   </body>
 </html>
