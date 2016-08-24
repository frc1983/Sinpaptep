<?php
/* @var $this yii\web\View */
$this->title = 'Sindicato dos Publicitários e Agências de Propaganda do Rio Grande do Sul';
?>
<div class="site-index">

    <?php if(count($destaques) > 0) { ?>
    <div class="body-content">
        <h1>Destaques</h1>
        <?php
        foreach ($destaques as $destaque) {
            echo "<div class='col-lg-4'>";
            echo '<h2>' . $destaque->Titulo . '</h2>';
            echo '<p class="lead">' . $destaque->Resumo . '</p>';
            echo '<p><a class="btn btn-success btn-md" href="' . $destaque->Link . '">Ver mais</a></p>';
            echo "</div>";
        }
        ?>
    </div>
    <?php } ?>

    <?php if(count($noticias) > 0) { ?>
    <div class="body-content" style="clear: both;">        
        <h1>Notícias</h1>
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
    <?php } ?>

    <?php if(count($convencoes) > 0) { ?>
    <div class="body-content" style="clear: both;">        
        <h1>Convenções Coletivas</h1>
        <div class="row">
            <?php
            for ($i = 0; $i <= count($convencoes) - 1; $i++) {
                echo '<div class="col-lg-4">';
                echo '<h2>' . $convencoes[$i][0]->idCategoriaConvencao->Nome . '</h2>';
                foreach ($convencoes[$i] as $item) {
                    echo '<p><a href="' . $item->Url . '">' . $item->Nome . '</a></p>';
                }
                echo '</div>';
            }
            ?>        
        </div>
    </div>
    <?php } ?>
    
    <?php if(count($parceiros) > 0) { ?>
    <div class="body-content" style="clear: both;">        
        <h1>Parceiros</h1>
        <div class="row">
            <?php
            foreach ($parceiros as $key => $value) {
                echo '<div class="col-lg-4">';
                echo '<h2>' . $parceiros->Nome . '</h2>';
                echo '<p><a href="' . $parceiros->Url . '">' . $parceiros->Nome . '</a></p>';
                echo '</div>';
            }
            ?>            
        </div>
    </div>
    <?php } ?>
</div>
