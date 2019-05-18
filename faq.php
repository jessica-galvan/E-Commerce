<?php
    session_start();
    require_once('actions/user-check.php');
    include_once("includes/lista-de-faq.php");
    $CSS = ['faq'];
    include_once("includes/header.php");
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
<!--FOOTER-->
<?php
    include_once("includes/footer.php");
?>
