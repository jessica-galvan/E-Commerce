<?php
    require_once('loader.php');
    /*Header*/
    $CSS = ['faq'];
    require_once("partials/header.php");
    include_once("partials/lista-de-faq.php");
 ?>
<main class="main-container">
    <div class="faq-body">
        <h1 class="faq-title">Preguntas Frecuentes</h1>
        <div class="ayuda">
            <?php for ($i=0; $i < count($listaDePreguntas); $i++): ?>
            <section class="cajaDePregunta">
                <div class="imagenDePreguntas">
                    <img src="<?=$listaDePreguntas[$i]["imagen"];?>" alt="">
                </div>
                <div class="preguntaYRespuesta">
                    <div class="preguntas">
                        <h2><?=$listaDePreguntas[$i]["pregunta"];?></h2>
                    </div>
                    <div class="respuestas">
                        <p><?=$listaDePreguntas[$i]["respuesta"];?></p>
                    </div>
                </div>
            </section>
            <?php endfor; ?>
        </div>
    </div>
</main>
<?php
    /*Footer*/
    include_once("partials/footer.php");
?>
