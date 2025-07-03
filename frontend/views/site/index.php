<?php

/** @var yii\web\View $this */
/** @var common\models\Noticia[] $noticias */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Início';
?>

<div class="site-index">
    <!-- Latest News Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Coluna de Parceiros -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-handshake me-2"></i>Parceiros
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($anunciantes)): ?>
                            <?php foreach ($anunciantes as $anunciante): ?>
                                <div class="mb-3 text-center">
                                    <?php if ($anunciante->Logo): ?>
                                        <img src="/Sinpaptep/backend/web/uploads/parceiros/<?= Html::encode($anunciante->Logo) ?>" style="width:100%; max-width:120px; max-height:60px; object-fit:contain;" alt="<?= Html::encode($anunciante->Nome) ?>">
                                    <?php else: ?>
                                        <span class="text-muted small"><?= Html::encode($anunciante->Nome) ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted mb-3">
                                Conheça nossos parceiros e colaboradores que apoiam o SINPAPTEP-RS.
                            </p>
                        <?php endif; ?>
                        <a href="<?= Url::to(['/site/parceiros']) ?>" class="btn btn-primary w-100 mt-2">
                            <i class="fas fa-arrow-right me-1"></i>Ver Todos os Parceiros
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Coluna de Notícias -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0">
                        <i class="fas fa-fire text-danger me-2"></i>
                        Últimas Notícias
                    </h2>
                    <a href="<?= Url::to(['/site/noticias']) ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-right me-1"></i>Ver Todas
                    </a>
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
                        <?php foreach (
                            $noticias as $index => $noticia): ?>
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if ($noticia->imagem): ?>
                                        <img src="/Sinpaptep/backend/web/<?= $noticia->imagem->Url ?>" 
                                             class="card-img-top noticia-card-img" 
                                             alt="<?= Html::encode($noticia->Titulo) ?>">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="fas fa-newspaper fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2">
                                            <?php if ($index === 0): ?>
                                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                    <i class="fas fa-star me-1"></i>Destaque
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <h5 class="card-title">
                                            <?= Html::encode($noticia->Titulo) ?>
                                        </h5>
                                        
                                        <?php if ($noticia->Sub_Titulo): ?>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                <?= Html::encode($noticia->Sub_Titulo) ?>
                                            </h6>
                                        <?php endif; ?>
                                        
                                        <p class="card-text text-muted">
                                            <?= \yii\helpers\HtmlPurifier::process($noticia->getTextoResumidoHtml(120)) ?>
                                        </p>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
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
        </div>
    </div>
</div>
