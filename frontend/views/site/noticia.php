<?php

/** @var yii\web\View $this */
/** @var common\models\Noticia $noticia */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $noticia->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['/site/noticias']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="noticia-view">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <article class="card shadow-sm">
                <?php 
                $imagens = $noticia->imagens;
                ?>
                <?php if ($imagens && count($imagens) > 0): ?>
                    <div class="noticia-galeria mb-3">
                        <div class="noticia-galeria-principal text-center mb-2">
                            <img id="galeria-img-principal" src="<?= Html::encode('/Sinpaptep/backend/web/' . $imagens[0]->Url) ?>" class="img-fluid rounded shadow-sm" style="max-height:400px; object-fit:contain; background:#f4fdf6;">
                        </div>
                        <?php if (count($imagens) > 1): ?>
                            <div class="noticia-galeria-thumbs d-flex flex-wrap gap-2 justify-content-center">
                                <?php foreach ($imagens as $idx => $img): ?>
                                    <img src="<?= Html::encode('/Sinpaptep/backend/web/' . $img->Url) ?>" class="img-thumbnail galeria-thumb" style="height:60px; width:auto; cursor:pointer; object-fit:cover; background:#f4fdf6;" onclick="document.getElementById('galeria-img-principal').src=this.src;">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-newspaper fa-3x text-muted"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body">
                    <header class="mb-4">
                        <h1 class="card-title h2 mb-3">
                            <?= Html::encode($noticia->Titulo) ?>
                        </h1>
                        
                        <?php if ($noticia->Sub_Titulo): ?>
                            <h2 class="card-subtitle h4 text-muted mb-3">
                                <?= Html::encode($noticia->Sub_Titulo) ?>
                            </h2>
                        <?php endif; ?>
                        
                        <div class="d-flex flex-wrap gap-3 text-muted mb-3">
                            <div>
                                <i class="fas fa-tag me-1"></i>
                                <span class="badge bg-primary">
                                    <?= Html::encode($noticia->getCategoriaNome()) ?>
                                </span>
                            </div>
                            
                            <div>
                                <i class="fas fa-hashtag me-1"></i>
                                #<?= $noticia->Id ?>
                            </div>
                        </div>
                    </header>
                    
                    <div class="noticia-content">
                        <?= \yii\helpers\HtmlPurifier::process($noticia->Texto) ?>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-info-circle me-1"></i>Informações:
                                </h6>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="fas fa-tag me-1"></i>Categoria: <?= Html::encode($noticia->getCategoriaNome()) ?></li>
                                    <li><i class="fas fa-hashtag me-1"></i>ID: #<?= $noticia->Id ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-share-alt me-1"></i>Compartilhar:
                                </h6>
                                <div class="d-flex gap-2">
                                    <a href="https://www.facebook.com/sindicatopublicitariosrs.com.br" target="_blank" class="text-decoration-none"><i class="fab fa-facebook"></i></a>
                                    <a href="#" class="btn btn-outline-success btn-sm" title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= Url::to(['/site/noticias']) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Voltar às notícias
                        </a>
                        
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sindicatopublicitariosrs.com.br" target="_blank" class="btn btn-outline-primary btn-sm" title="Compartilhar no Facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm" title="Compartilhar no WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div> 