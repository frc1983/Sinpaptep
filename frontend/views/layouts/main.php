<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - SINPAPTEP-RS</title>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/sinpaptep-favicon.png') ?>">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!-- Header institucional centralizado -->
<div class="institucional-header py-3" style="background: white; border-bottom: 1px solid #e2e8f0;">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
        <img src="<?= Yii::getAlias('@web/sinpaptep-logo.jpg') ?>" alt="SINPAPTEP-RS" style="height: 80px; width: auto; max-width: 150px;" class="me-md-4 mb-2 mb-md-0">
        <span class="institucional-text text-center text-md-start" style="font-size: 1.15rem; color: #206839; font-weight: 600; line-height: 1.3;">
            Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul
        </span>
    </div>
</div>

<header>
    <?php
    NavBar::begin([
        //'brandLabel' => Html::img('@web/sinpaptep-logo.jpg', ['alt' => 'SINPAPTEP-RS', 'class' => 'me-2', 'style' => 'height: 40px;']) . 'SINPAPTEP-RS',
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark bg-primary shadow-sm',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid',
        ],
    ]);
    
    // Menu principal
    $menuItems = [
        [
            'label' => '<i class="fas fa-home me-1"></i>Início',
            'url' => ['/site/index'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-newspaper me-1"></i>Notícias',
            'url' => ['/site/noticias'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-info-circle me-1"></i>Sobre',
            'url' => ['/site/about'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-handshake me-1"></i>Parceiros',
            'url' => ['/site/parceiros'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-user-plus me-1"></i>Cadastro de Sócio',
            'url' => ['/site/cadastro-socio'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-file-contract me-1"></i>Homologações',
            'url' => ['/site/homologacoes'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-balance-scale me-1"></i>Jurídico',
            'url' => ['/site/juridico'],
            'encode' => false,
        ],
        [
            'label' => '<i class="fas fa-envelope me-1"></i>Contato',
            'url' => ['/site/contact'],
            'encode' => false,
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0" style="margin-top: 56px;">
    <div class="container-fluid px-2 pt-2">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb bg-light rounded p-2 mb-2'],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-4 text-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h5>SINPAPTEP-RS</h5>
                <p class="text-muted">Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul</p>
            </div>
            <div class="col-md-3">
                <h6>Links Úteis</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/index']) ?>" class="text-muted text-decoration-none">Início</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/noticias']) ?>" class="text-muted text-decoration-none">Notícias</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/about']) ?>" class="text-muted text-decoration-none">Sobre</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/parceiros']) ?>" class="text-muted text-decoration-none">Parceiros</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/cadastro-socio']) ?>" class="text-muted text-decoration-none">Cadastro de Sócio</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/homologacoes']) ?>" class="text-muted text-decoration-none">Homologações</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/juridico']) ?>" class="text-muted text-decoration-none">Jurídico</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>" class="text-muted text-decoration-none">Contato</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Redes Sociais</h6>
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/sindicatopublicitariosrs.com.br" target="_blank" class="text-muted text-decoration-none"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/sindicato_publirs" target="_blank" class="text-muted text-decoration-none"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">&copy; <?= date('Y') ?> SINPAPTEP-RS. Todos os direitos reservados.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted">Av. João Wallig, 518 - Passo D'Areia - Porto Alegre, RS</p>
                <p class="mb-0">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/politica-privacidade']) ?>" class="text-muted text-decoration-none small">Política de Privacidade</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
