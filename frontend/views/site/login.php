<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Entrar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="container-fluid d-flex justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8">
    <div class="row">
                    <!-- Formulário de Login -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                                    <h2 class="fw-bold">Bem-vindo de volta!</h2>
                                    <p class="text-muted">Entre com suas credenciais para acessar sua conta</p>
                                </div>

                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'options' => ['class' => 'login-form']
                                ]); ?>

                                <div class="mb-3">
                                    <?= $form->field($model, 'username', [
                                        'options' => ['class' => 'form-group'],
                                        'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-user"></i></span></div>{error}'
                                    ])->textInput([
                                        'autofocus' => true,
                                        'class' => 'form-control form-control-lg',
                                        'placeholder' => 'Nome de usuário ou e-mail'
                                    ]) ?>
                                </div>

                                <div class="mb-3">
                                    <?= $form->field($model, 'password', [
                                        'options' => ['class' => 'form-group'],
                                        'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-lock"></i></span></div>{error}'
                                    ])->passwordInput([
                                        'class' => 'form-control form-control-lg',
                                        'placeholder' => 'Sua senha'
                                    ]) ?>
                                </div>

                                <div class="mb-3">
                                    <?= $form->field($model, 'rememberMe')->checkbox([
                                        'template' => '<div class="form-check">{input} {label}</div>',
                                        'label' => 'Lembrar de mim'
                                    ]) ?>
                                </div>

                                <div class="d-grid mb-4">
                                    <?= Html::submitButton(
                                        '<i class="fas fa-sign-in-alt me-2"></i>Entrar',
                                        [
                                            'class' => 'btn btn-primary btn-lg',
                                            'name' => 'login-button'
                                        ]
                                    ) ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                                <div class="text-center">
                                    <div class="mb-3">
                                        <a href="<?= Url::to(['site/request-password-reset']) ?>" class="text-decoration-none">
                                            <i class="fas fa-key me-1"></i>Esqueceu sua senha?
                                        </a>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <a href="<?= Url::to(['site/resend-verification-email']) ?>" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1"></i>Reenviar e-mail de verificação
                                        </a>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    <p class="text-muted mb-3">Não tem uma conta?</p>
                                    <a href="<?= Url::to(['site/signup']) ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-user-plus me-2"></i>Criar Conta
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Informativa -->
                    <div class="col-lg-6">
                        <div class="login-sidebar h-100 d-flex flex-column justify-content-center">
                            <div class="text-center mb-5">
                                <h3 class="text-white fw-bold mb-3">
                                    <i class="fas fa-rocket me-2"></i>
                                    Acesse o Sistema
                                </h3>
                                <p class="text-white-50 lead">
                                    Faça login para acessar todas as funcionalidades do nosso 
                                    sistema de gerenciamento de conteúdo.
                                </p>
                            </div>

                            <!-- Recursos do Sistema -->
                            <div class="features-list">
                                <div class="feature-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-newspaper text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Gerenciamento de Notícias</h6>
                                            <p class="text-white-50 mb-0">Publique e gerencie notícias com facilidade</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Páginas Estáticas</h6>
                                            <p class="text-white-50 mb-0">Crie e edite páginas informativas</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Gestão de Usuários</h6>
                                            <p class="text-white-50 mb-0">Controle de acesso e permissões</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="feature-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-chart-line text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Relatórios e Estatísticas</h6>
                                            <p class="text-white-50 mb-0">Acompanhe o desempenho do seu conteúdo</p>
                                        </div>
                                    </div>
                                </div>
                </div>

                            <!-- Estatísticas -->
                            <div class="stats-section mt-5">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">500+</h4>
                                            <p class="text-white-50 mb-0">Notícias</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">1000+</h4>
                                            <p class="text-white-50 mb-0">Usuários</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">99.9%</h4>
                                            <p class="text-white-50 mb-0">Uptime</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
