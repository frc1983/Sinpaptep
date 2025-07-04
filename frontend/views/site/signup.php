<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Cadastro';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <div class="container-fluid d-flex justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10">
                <div class="row">
                    <!-- Formulário de Cadastro -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                                    <h2 class="fw-bold">Junte-se a Nós!</h2>
                                    <p class="text-muted">Crie sua conta e comece a usar nosso sistema</p>
                                </div>

                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
                                <?php elseif (Yii::$app->session->hasFlash('error')): ?>
                                    <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
                                <?php endif; ?>

                                <form method="post" action="">
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Nome de usuário*:</label>
                                            <input type="text" name="Signup[username]" class="form-control" required>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label>Email*:</label>
                                            <input type="email" name="Signup[email]" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label>Senha*:</label>
                                        <input type="password" name="Signup[password]" class="form-control" required>
                                    </div>

                                    <!-- Campos Adicionais Mock -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nome Completo</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" placeholder="Seu nome completo">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Telefone</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control form-control-lg" placeholder="(11) 99999-9999">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Data de Nascimento</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control form-control-lg">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tipo de Conta</label>
                                            <div class="input-group">
                                                <select class="form-select form-select-lg">
                                                    <option value="">Selecione...</option>
                                                    <option value="pessoal">Pessoal</option>
                                                    <option value="empresarial">Empresarial</option>
                                                    <option value="estudante">Estudante</option>
                                                </select>
                                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Termos e Condições -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="acceptPrivacy" required>
                                            <label class="form-check-label" for="acceptPrivacy">
                                                Concordo com a <a href="<?= Url::to(['site/politica-privacidade']) ?>" class="text-decoration-none" target="_blank">Política de Privacidade</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-user-plus me-2"></i>Criar Conta
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center">
                                    <p class="text-muted mb-3">Já tem uma conta?</p>
                                    <a href="<?= Url::to(['site/login']) ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-sign-in-alt me-2"></i>Fazer Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Informativa -->
                    <div class="col-lg-5">
                        <div class="signup-sidebar h-100 d-flex flex-column justify-content-center">
                            <div class="text-center mb-5">
                                <h3 class="text-white fw-bold mb-3">
                                    <i class="fas fa-star me-2"></i>
                                    Por que se Cadastrar?
                                </h3>
                                <p class="text-white-50 lead">
                                    Junte-se a milhares de usuários que já confiam em nosso 
                                    sistema para gerenciar seu conteúdo.
                                </p>
                            </div>

                            <!-- Benefícios -->
                            <div class="benefits-list">
                                <div class="benefit-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="benefit-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-rocket text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Acesso Imediato</h6>
                                            <p class="text-white-50 mb-0">Comece a usar o sistema em segundos</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="benefit-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="benefit-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-shield-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Segurança Total</h6>
                                            <p class="text-white-50 mb-0">Seus dados estão protegidos</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="benefit-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="benefit-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-headset text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Suporte 24/7</h6>
                                            <p class="text-white-50 mb-0">Equipe sempre pronta para ajudar</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="benefit-item mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="benefit-icon bg-white bg-opacity-25 rounded-circle me-3">
                                            <i class="fas fa-mobile-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-1">Acesso Mobile</h6>
                                            <p class="text-white-50 mb-0">Use de qualquer dispositivo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Depoimentos -->
                            <div class="testimonials-section mt-5">
                                <h5 class="text-white mb-3">
                                    <i class="fas fa-quote-left me-2"></i>
                                    O que nossos usuários dizem
                                </h5>
                                
                                <div class="testimonial-item bg-white bg-opacity-10 rounded p-3 mb-3">
                                    <p class="text-white-50 mb-2">
                                        "Sistema incrível! Facilita muito o gerenciamento do nosso conteúdo."
                                    </p>
                                    <small class="text-white">- Maria Silva, Jornalista</small>
                                </div>
                                
                                <div class="testimonial-item bg-white bg-opacity-10 rounded p-3">
                                    <p class="text-white-50 mb-2">
                                        "Interface intuitiva e funcionalidades completas. Recomendo!"
                                    </p>
                                    <small class="text-white">- João Santos, Editor</small>
                                </div>
                            </div>

                            <!-- Estatísticas -->
                            <div class="stats-section mt-5">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">10K+</h4>
                                            <p class="text-white-50 mb-0">Usuários</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">50K+</h4>
                                            <p class="text-white-50 mb-0">Conteúdos</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h4 class="text-white fw-bold">4.9★</h4>
                                            <p class="text-white-50 mb-0">Avaliação</p>
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
