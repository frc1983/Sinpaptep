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
$instagramUrl = 'https://www.instagram.com/sindicato_publirs/';
$facebookUrl = 'https://www.facebook.com/sindicatopublicitariosrs.com.br';
$isPreview = filter_var(getenv('APP_PREVIEW') ?: 'false', FILTER_VALIDATE_BOOLEAN);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - SINPAPTEP-RS</title>
    <meta name="description" content="Sindicato dos Publicitários e trabalhadores em empresas de publicidade do Rio Grande do Sul.">
    <?php if ($isPreview): ?>
        <meta name="robots" content="noindex,nofollow,noarchive">
    <?php endif; ?>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/sinpaptep-favicon.png') ?>">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<?php if ($isPreview): ?>
    <div class="preview-banner" role="status">Ambiente de pré-visualização</div>
<?php endif; ?>

<div class="topbar">
    <div class="site-shell topbar-inner">
        <span>Representação, orientação e defesa dos trabalhadores da publicidade no RS</span>
        <div class="topbar-links">
            <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>">Fale conosco</a>
            <a href="<?= $instagramUrl ?>" target="_blank" rel="noopener" aria-label="Instagram do SINPAPTEP-RS"><i class="fab fa-instagram"></i></a>
            <a href="<?= $facebookUrl ?>" target="_blank" rel="noopener" aria-label="Facebook do SINPAPTEP-RS"><i class="fab fa-facebook-f"></i></a>
        </div>
    </div>
</div>

<div class="institutional-header">
    <div class="site-shell institutional-header-inner">
        <a class="brand-lockup" href="<?= Yii::$app->homeUrl ?>">
            <img src="<?= Yii::getAlias('@web/sinpaptep-logo.jpg') ?>" alt="SINPAPTEP-RS">
            <span>Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul</span>
        </a>
        <a href="<?= Yii::$app->urlManager->createUrl(['/site/cadastro-socio']) ?>" class="btn btn-primary btn-associate">
            Associe-se <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</div>

<header class="main-navigation">
    <?php
    NavBar::begin([
        'options' => ['class' => 'navbar navbar-expand-lg navbar-dark'],
        'innerContainerOptions' => ['class' => 'site-shell'],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav align-items-lg-center'],
        'items' => [
            ['label' => 'Início', 'url' => ['/site/index']],
            ['label' => 'Notícias', 'url' => ['/site/noticias']],
            ['label' => 'O Sindicato', 'url' => ['/site/about']],
            ['label' => 'Parceiros', 'url' => ['/site/parceiros']],
            ['label' => 'Associe-se', 'url' => ['/site/cadastro-socio']],
            ['label' => 'Homologações', 'url' => ['/site/homologacoes']],
            ['label' => 'Jurídico', 'url' => ['/site/juridico']],
            ['label' => 'Contato', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="site-shell content-shell">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
            'options' => ['class' => 'breadcrumb'],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto">
    <div class="site-shell">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="<?= Yii::getAlias('@web/sinpaptep-logo.jpg') ?>" alt="SINPAPTEP-RS">
                <p>Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul.</p>
            </div>
            <div>
                <h2>Navegue</h2>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/noticias']) ?>">Notícias</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/about']) ?>">O Sindicato</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/parceiros']) ?>">Parceiros</a>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/politica-privacidade']) ?>">Política de Privacidade</a>
            </div>
            <div>
                <h2>Atendimento</h2>
                <p>Av. João Wallig, 518<br>Passo D'Areia — Porto Alegre, RS</p>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>">Entre em contato</a>
            </div>
            <div>
                <h2>Acompanhe</h2>
                <div class="footer-social">
                    <a href="<?= $instagramUrl ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="<?= $facebookUrl ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i> Facebook</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> SINPAPTEP-RS. Todos os direitos reservados.</span>
            <?php
            $host = $_SERVER['HTTP_HOST'] ?? '';
            $isLocalhost = strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false;
            $adminUrl = $isLocalhost ? '/Sinpaptep/backend/web/site/login' : '/backend/web/site/login';
            ?>
            <?php if (!$isPreview): ?>
                <a href="<?= $adminUrl ?>" target="_blank" rel="noopener">Área administrativa</a>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
