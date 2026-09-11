<?php

/** @var yii\web\View $this */
/** @var common\models\Noticia[] $noticias */
/** @var common\models\AvisoModal|null $avisoModal */
/** @var array $instagramFeed */

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Início';
$destaque = $noticias[0] ?? null;
$secundarias = array_slice($noticias, 1, 4);

if ($avisoModal !== null):
    Modal::begin([
        'id' => 'modalComunicadoDiretoria',
        'title' => '<strong>' . Html::encode($avisoModal->Titulo) . '</strong>',
        'size' => Modal::SIZE_EXTRA_LARGE,
        'closeButton' => false,
        'options' => ['tabindex' => false],
        'dialogOptions' => ['class' => 'modal-dialog-centered comunicado-dialog'],
    ]);
?>
    <div class="comunicado-diretoria"><?= $avisoModal->Conteudo ?></div>
    <div class="comunicado-actions">
        <?= Html::button('Li o comunicado e estou ciente', [
            'class' => 'btn btn-primary comunicado-confirm-button',
            'data-bs-dismiss' => 'modal',
        ]) ?>
    </div>
<?php
    Modal::end();
    $this->registerJs('new bootstrap.Modal(document.getElementById("modalComunicadoDiretoria")).show();', View::POS_READY);
endif;
?>

<div class="site-index">
    <section class="news-section" aria-labelledby="news-heading">
        <div class="section-heading">
            <div><span class="eyebrow">Informação para a categoria</span><h1 id="news-heading">Últimas Notícias</h1></div>
            <a href="<?= Url::to(['/site/noticias']) ?>" class="section-link">Todas as notícias <i class="fas fa-arrow-right"></i></a>
        </div>

        <?php if ($destaque !== null): ?>
            <div class="editorial-grid">
                <article class="lead-story">
                    <a href="<?= Url::to(['/site/noticia', 'id' => $destaque->Id]) ?>" class="lead-story-media">
                        <?php if ($destaque->imagem): ?>
                            <img src="<?= Html::encode($destaque->imagem->getUrlComPrefixo()) ?>" alt="<?= Html::encode($destaque->Titulo) ?>">
                        <?php else: ?><span class="news-placeholder"><i class="far fa-newspaper"></i></span><?php endif; ?>
                    </a>
                    <div class="lead-story-body">
                        <span class="story-category"><?= Html::encode($destaque->getCategoriaNome()) ?></span>
                        <h2><?= Html::a(Html::encode($destaque->Titulo), ['/site/noticia', 'id' => $destaque->Id]) ?></h2>
                        <p><?= $destaque->Sub_Titulo ? Html::encode($destaque->Sub_Titulo) : $destaque->getTextoListaSeguro(190) ?></p>
                        <a class="read-more" href="<?= Url::to(['/site/noticia', 'id' => $destaque->Id]) ?>">Leia a notícia <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <div class="secondary-stories">
                    <?php foreach ($secundarias as $noticia): ?>
                        <article class="story-card">
                            <a href="<?= Url::to(['/site/noticia', 'id' => $noticia->Id]) ?>" class="story-card-media">
                                <?php if ($noticia->imagem): ?>
                                    <img src="<?= Html::encode($noticia->imagem->getUrlComPrefixo()) ?>" alt="<?= Html::encode($noticia->Titulo) ?>">
                                <?php else: ?><span class="news-placeholder"><i class="far fa-newspaper"></i></span><?php endif; ?>
                            </a>
                            <div>
                                <span class="story-category"><?= Html::encode($noticia->getCategoriaNome()) ?></span>
                                <h2><?= Html::a(Html::encode($noticia->Titulo), ['/site/noticia', 'id' => $noticia->Id]) ?></h2>
                                <p><?= $noticia->getTextoListaSeguro(90) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state"><i class="far fa-newspaper"></i><h2>Novas informações em breve</h2><p>Acompanhe os canais do sindicato para ficar por dentro das ações da categoria.</p></div>
        <?php endif; ?>
    </section>

    <section class="services-section" aria-labelledby="services-heading">
        <div class="section-heading compact"><div><span class="eyebrow">Como podemos ajudar</span><h2 id="services-heading">Serviços para o trabalhador</h2></div></div>
        <div class="service-grid">
            <a href="<?= Url::to(['/site/cadastro-socio']) ?>" class="service-card"><i class="fas fa-users"></i><span><strong>Associe-se</strong>Fortaleça a representação da categoria</span><i class="fas fa-arrow-right"></i></a>
            <a href="<?= Url::to(['/site/juridico']) ?>" class="service-card"><i class="fas fa-scale-balanced"></i><span><strong>Orientação jurídica</strong>Conheça seus direitos e canais de apoio</span><i class="fas fa-arrow-right"></i></a>
            <a href="<?= Url::to(['/site/homologacoes']) ?>" class="service-card"><i class="fas fa-file-signature"></i><span><strong>Homologações</strong>Acesse informações e procedimentos</span><i class="fas fa-arrow-right"></i></a>
            <a href="<?= Url::to(['/site/contact']) ?>" class="service-card"><i class="fas fa-comments"></i><span><strong>Atendimento</strong>Fale diretamente com o sindicato</span><i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="instagram-section" aria-labelledby="instagram-heading">
        <div class="section-heading">
            <div><span class="eyebrow"><i class="fab fa-instagram me-2"></i>@<?= Html::encode($instagramFeed['username']) ?></span><h2 id="instagram-heading">Acompanhe o sindicato</h2></div>
            <a href="<?= Html::encode($instagramFeed['profile_url']) ?>" target="_blank" rel="noopener" class="section-link">Ver no Instagram <i class="fas fa-arrow-up-right-from-square"></i></a>
        </div>
        <?php if (!empty($instagramFeed['posts'])): ?>
            <div class="instagram-grid">
                <?php foreach (array_slice($instagramFeed['posts'], 0, 6) as $post): ?>
                    <a class="instagram-card" href="<?= Html::encode($post['permalink']) ?>" target="_blank" rel="noopener">
                        <img src="<?= Html::encode($post['image_url']) ?>" alt="<?= Html::encode(StringHelper::truncateWords($post['caption'], 12, '')) ?>" loading="lazy">
                        <span class="instagram-overlay">
                            <?php if ($post['media_type'] === 'VIDEO'): ?><i class="fas fa-play" aria-label="Vídeo"></i><?php endif; ?>
                            <?php if ($post['media_type'] === 'CAROUSEL_ALBUM'): ?><i class="fas fa-clone" aria-label="Carrossel"></i><?php endif; ?>
                            <span><?= Html::encode(StringHelper::truncateWords($post['caption'], 16)) ?></span>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="instagram-empty">
                <div class="instagram-mark"><i class="fab fa-instagram"></i></div>
                <div><h3>O cotidiano da categoria também está no Instagram</h3><p>Publicações, mobilizações e informações do SINPAPTEP-RS em um só lugar.</p></div>
                <a href="<?= Html::encode($instagramFeed['profile_url']) ?>" target="_blank" rel="noopener" class="btn btn-light">Acessar @<?= Html::encode($instagramFeed['username']) ?></a>
            </div>
        <?php endif; ?>
    </section>

    <section class="partners-section" aria-labelledby="partners-heading">
        <div class="section-heading compact">
            <div><span class="eyebrow">Rede de apoio</span><h2 id="partners-heading">Parceiros do sindicato</h2></div>
            <a href="<?= Url::to(['/site/parceiros']) ?>" class="section-link">Conheça todos <i class="fas fa-arrow-right"></i></a>
        </div>
        <?php if (!empty($anunciantes)): ?>
            <div class="partner-strip">
                <?php foreach (array_slice($anunciantes, 0, 6) as $anunciante): ?>
                    <?php $imagens = $anunciante->getImagens(); ?>
                    <div class="partner-logo">
                        <?php if (!empty($imagens)): ?><img src="<?= Html::encode($imagens[0]->getImagemUrl()) ?>" alt="<?= Html::encode($anunciante->Nome) ?>" loading="lazy">
                        <?php else: ?><span><?= Html::encode($anunciante->Nome) ?></span><?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?><p class="text-muted">Conheça as instituições que apoiam o trabalho do SINPAPTEP-RS.</p><?php endif; ?>
    </section>
</div>
