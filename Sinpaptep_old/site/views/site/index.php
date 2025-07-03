<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Sindicato dos Publicitários e Agências de Propaganda do Rio Grande do Sul';
?>

<div class="site-index">
    <?php
    
    yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        //'size' => 'modal-lg',
        'closeButton' => [
            'id' => 'close-button',
            'class' => 'close',
            'data-dismiss' => 'modal',
        ],
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => [
            'backdrop' => false, 'keyboard' => true
        ]
    ]);
    echo "<div id='modalContent'><div style='text-align:center'>" . $this->render('@app/views/site/comunicado.html') . "</div></div>";
    yii\bootstrap\Modal::end();
    
    ?>
    <div class="row">
        <h1 class="title-border">Destaques</h1>
        <?php
        foreach ($destaques as $destaque) {
            echo "<div class='col-lg-4'>";
            echo '<h2>' . $destaque->Titulo . '</h2>';
            echo '<p class="" style="text-align: justify">' . $destaque->Resumo . '</p>';
	    if($destaque->Link != "" && $destaque->Link != "www.sindicatopublicitariosrs.com.br" && strpos($destaque->Link, "site/web/images") !== false)
		echo '<a href="'.$destaque->Link.'" target="_blank"><img src="'.$destaque->Link.'" width="250" /></a>';
            else if($destaque->Link != "" && $destaque->Link != "www.sindicatopublicitariosrs.com.br")
                echo '<p><a class="btn btn-lg btn-success" href="' . $destaque->Link . '" target="_blank">Ver mais</a></p>';
            echo "</div>";
        }
        ?>
    </div>

    <div class="row" style="clear: both;">
        <h1 class="title-border">Notícias</h1>

        <?php
        foreach ($noticias as $noticia) {
            echo "<div class='col-lg-12 text-left' style='border-bottom: 1px solid gray;padding-bottom: 15px;margin-bottom: 20px;'>";

            echo '<h2>' . $noticia->Titulo . '</h2>';
            echo '<p class="lead">' . $noticia->Sub_Titulo . '</p>';
            //echo '<div class="reduced">' . $noticia->Texto . '</div>';
            echo Html::a('Ver Mais', ['/noticias/noticia/' . $noticia->Id], ['class' => 'btn btn-lg btn-success']);
            echo "</div>";
        }
        ?>
    </div>

    <?php if (count($convencoes[0]) > 0 && count($convencoes[1]) > 0 && count($convencoes[2]) > 0) { ?>
        <div class="row" style="clear: both;">
            <h1 class="title-border">Convenções</h1>
            <?php
            for ($i = 0; $i <= count($convencoes) - 1; $i++) {
                //echo($convencao[0]->idCategoriaConvencao->Nome);
                if (count($convencoes[$i]) > 0) {
                    echo '<div class="col-lg-4">';

                    echo '<h2>' . $convencoes[$i][0]->idCategoriaConvencao->Nome . '</h2>';
                    foreach ($convencoes[$i] as $item) {
                        echo '<p><a href="' . $item->Url . '">' . $item->Nome . '</a></p>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    <?php } ?>

    <?php if (count($parceiros) > 0) { ?>
        <div class="row">        
            <h1 class="title-border">Parceiros</h1>
            <ul class="bxslider">
                <?php
                foreach ($parceiros as $key => $value) {
                    echo '<li><img src="' . $value->Logo . '" /></li>';
                }
                ?>
            </ul>
        </div>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.css" type="text/css" />
    <script>
        $(document).ready(function () {
            $('.bxslider').bxSlider({
                minSlides: 5,
                maxSlides: 5,
                slideWidth: 250,
                slideMargin: 20,
                adaptiveHeight: false,
                responsive: true
            });
            $('.carousel').carousel({
                interval: 5000
            })
        });
    </script>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        if ($('#modal').hasClass('in')) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            $('#modalHeader').html('<h4>' + $(this).attr('title') + '</h4>');
        } else {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
            $('#modalHeader').html('<div id="header-modal">' +
                    '<button type="button" id="close-button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                    '<img id="logo-main" class="modal-logo" style="width: 51px; margin: 3px 10px;" src="/site/web/images/logo.jpg" alt="Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul - SINPAPTEP RS">' +
                    '<div class="modal-title">Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul</div>');
        }
    });
</script>