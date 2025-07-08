<?php

/** @var yii\web\View $this */
/** @var common\models\Noticia[] $noticias */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Notícias';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="noticias-index">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-newspaper me-3"></i>Notícias
                </h1>
                <p class="lead text-muted">
                    Fique por dentro das novidades e comunicados do SINPAPTEP-RS
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <?php if (empty($noticias)): ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Nenhuma notícia disponível</h4>
                    <p class="mb-0">Aguarde, em breve teremos novidades para você!</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($noticia->getImagens()->one()): ?>
                            <img src="<?= Html::encode('/Sinpaptep/backend/web/' . $noticia->getImagens()->one()->Url) ?>" 
                                 class="card-img-top" 
                                 alt="<?= Html::encode($noticia->Titulo) ?>"
                                 style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-newspaper fa-3x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?= Html::encode($noticia->Titulo) ?>
                            </h5>
                            
                            <?php if ($noticia->Sub_Titulo): ?>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?= Html::encode($noticia->Sub_Titulo) ?>
                                </h6>
                            <?php endif; ?>
                            
                            <p class="card-text text-muted">
                                <?= $noticia->getTextoListaSeguro(150) ?>
                            </p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-tag me-1"></i>
                                        <?= Html::encode($noticia->getCategoriaNome()) ?>
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-hashtag me-1"></i>
                                        #<?= $noticia->Id ?>
                                    </small>
                                </div>
                                
                                <?= Html::a(
                                    '<i class="fas fa-eye me-1"></i>Ler mais',
                                    ['/site/noticia', 'id' => $noticia->Id],
                                    ['class' => 'btn btn-outline-primary btn-sm w-100']
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div> 