<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Início';
?>
<div class="row">
    <div class="col-md-9">
        <h2>Últimas Notícias</h2>
        <div class="row">
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-3" style="margin-bottom:20px;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><?= Html::a(Html::encode($noticia->Titulo), ['site/noticia', 'id' => $noticia->Id]) ?></h4>
                            <?php if ($noticia->imagem): ?>
                                <img src="<?= Yii::getAlias('@web') . '/' . $noticia->imagem->Url ?>" style="max-width:100%; height:auto; margin-bottom:10px;">
                            <?php endif; ?>
                            <p style="font-size: 0.95em;">
                                <?= Html::encode(\yii\helpers\StringHelper::truncateWords(strip_tags($noticia->Texto), 20)) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-3">
        <h2>Anunciantes</h2>
        <?php foreach ($anunciantes as $anunciante): ?>
            <div style="margin-bottom:20px;">
                <a href="<?= Html::encode($anunciante->Site) ?>" target="_blank">
                    <?php if ($anunciante->Logo): ?>
                        <img src="/Sinpaptep/backend/web/uploads/parceiros/<?= Html::encode($anunciante->Logo) ?>" style="width:100%; max-width:250px;">
                    <?php else: ?>
                        <?= Html::encode($anunciante->Nome) ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div> 