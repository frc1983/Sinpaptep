<?php
/* @var $this yii\web\View */
$this->title = 'Sindicato dos Publicitários e Agências de Propaganda do Rio Grande do Sul';
?>
<div class="site-index">
    <div class="row">
        <h1 class="title-border">Destaques</h1>
        <?php
        foreach ($destaques as $destaque) {
            echo "<div class='col-lg-4'>";
            echo '<h2>' . $destaque->Titulo . '</h2>';
            echo '<p class="" style="text-align: justify">' . $destaque->Resumo . '</p>';
            echo '<p><a class="btn btn-lg btn-success" href="' . $destaque->Link . '">Ver mais</a></p>';
            echo "</div>";
        }
        ?>
    </div>

    <div class="row" style="clear: both;">
        <h1 class="title-border">Notícias</h1>

        <?php
        foreach ($noticias as $noticia) {
            echo "<div class='col-lg-12 text-left'>";

            echo '<h2>' . $noticia->Titulo . '</h2>';
            echo '<p class="lead">' . $noticia->Sub_Titulo . '</p>';
            echo '<p>' . $noticia->Texto . '</p>';
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
