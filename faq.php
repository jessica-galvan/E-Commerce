<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/faq.css">
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
          <div class="faq-body">
            <h1 class="faq-title">Preguntas Frecuentes</h1>
            <?php include("includes/lista-de-faq.php");?>

            <div class="ayuda">
              <?php for ($i=0; $i < count($listaDePreguntas); $i++): ?>
              <section class="cajaDePregunta">
                <div class="preguntas">
                  <h2><?=$listaDePreguntas[$i]["pregunta"];?></h2>
                </div>
                <div class="respuestas">
                  <p><?=$listaDePreguntas[$i]["respuesta"];?></p>
                </div>
              </section>
              <?php endfor; ?>
            </div>
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
