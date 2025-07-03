<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css" media="print">
            .dontprint
            { display: none; }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <a href="/" style="text-decoration: none;" class="dontprint">
                <div id="header-container">
                    <?php
                    echo Html::img('@web/images/logo.jpg', ['alt' => Yii::$app->name, 'id' => 'logo-main', 'class' => '']);
                    ?>
                    <div class="brand-name">Sindicato dos Publicitários, Agenciadores de Propaganda e Trabalhadores em Empresas de Publicidade do Estado do Rio Grande do Sul</div>
                </div>
            </a>
            <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar-inverse header',
                ],
            ]);
            if (Yii::$app->user->isGuest) {
                echo Nav::widget([
                    'activateItems' => true,
                    'activateParents' => true,
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        ['label' => 'HOME', 'url' => ['/site/index']],
                        ['label' => 'SINDICATO', 'url' => ['/sindicato/index']],
                        //['label' => 'CONVENÇÕES', 'url' => ['/convencoes/index']],
                        ['label' => 'HOMOLOGAÇÕES', 'url' => ['/homologacoes/index']],
                        ['label' => 'JURÍDICO', 'url' => ['/juridico/index']],
                        ['label' => 'GUIAS',
                            'items' => [
                                ['label' => 'ASSISTENCIAL', 'url' => ['/guias/assistencial']],
                                //['label' => 'SINDICAL', 'url' => ['/guias/sindical']],
                                ['label' => 'SINDICAL', 'url' => ['/guias/sindical2']]
                            ]],
                        /*['label' => 'INFORMAÇÕES', 'items' => [
                                ['label' => 'TERCEIRIZAÇÃO', 'url' => ['/informacoes/terceirizacao']],
                                ['label' => 'CONSULTA CLT', 'url' => ['/informacoes/consulta']]
                            ]],*/
                        ['label' => 'SÓCIOS', 'url' => ['/socios/index']],
                        ['label' => 'CONTATO', 'url' => ['/contato/index']]
                    ],
                ]);
            } else if (!Yii::$app->user->isGuest) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
            }

            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer dontprint">
            <div class="container">
                <p class="col-sm-4">Endereço:<br />
                    Av. João Wallig, 518 <br />
                    Passo D’Areia<br />
                    Porto Alegre, RS<br />
                    CEP: 91340-000<br />
                    Fone/Fax: (51) 3361.2495<br />
                    E-mail: sindicatopublicitariosrs@gmail.com
                </p>
                <p class="col-sm-4">
                    Horário de atendimento externo: <br />
                    De Segunda a Sexta-feira<br />
                    14:00 às 17:30 horas
                </p>
                <div class="col-sm-4 area-restrita">
                    Área restrita
                    <form class="form">
                        <div class="form-group">
                            <label class="sr-only" for="txtLogin">Login</label>
                            <input type="text" class="form-control" id="txtLogin" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="txtPass">Senha</label>
                            <input type="password" class="form-control" id="txtPass" placeholder="Senha">
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>