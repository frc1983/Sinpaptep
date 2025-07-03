<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Contato';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.form-check-label a {
    color: #0d6efd;
    text-decoration: underline;
    cursor: pointer;
}
.form-check-label a:hover {
    color: #0a58ca;
    text-decoration: underline;
}
</style>

<div class="site-contact">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-envelope me-3"></i>Contato
                </h1>
                <p class="lead text-muted">
                    Fale com o SINPAPTEP-RS. Estamos à disposição para dúvidas, sugestões e atendimento.
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Informações de Contato -->
            <div class="col-lg-4 mb-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4">
                            <i class="fas fa-info-circle me-2" style="color: #20713a;"></i>
                            Informações de Contato
                        </h3>
                        
                        <div class="contact-info">
                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon rounded-circle me-3" style="background-color: #20713a; color: white;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">NOSSO ENDEREÇO:</h6>
                                        <p class="text-muted mb-0">
                                            Av. João Wallig, 518<br>
                                            Bairro Passo D'Areia<br>
                                            Porto Alegre, RS<br>
                                            CEP: 91340-000
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon rounded-circle me-3" style="background-color: #20713a; color: white;">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Telefone</h6>
                                        <p class="text-muted mb-0">
                                            <a href="tel:+555133612495" class="text-decoration-none">(51) 3361.2495</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon rounded-circle me-3" style="background-color: #20713a; color: white;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">E-mail</h6>
                                        <p class="text-muted mb-0">
                                            <a href="mailto:sindicatopublicitariosrs@gmail.com" class="text-decoration-none">sindicatopublicitariosrs@gmail.com</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact-item mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon rounded-circle me-3" style="background-color: #20713a; color: white;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Horário de Atendimento</h6>
                                        <p class="text-muted mb-0">
                                            Segunda a Sexta: 8h às 18h<br>
                                            Sábado: 9h às 14h<br>
                                            Domingo: Fechado
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Redes Sociais -->
                        <div class="mt-4">
                            <h6 class="mb-3">
                                <i class="fas fa-share-alt me-2" style="color: #20713a;"></i>
                                Siga-nos nas Redes Sociais
                            </h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sindicatopublicitariosrs.com.br" target="_blank" class="text-decoration-none"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/sindicato_publirs" target="_blank" class="text-decoration-none"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulário de Contato -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">
                            <i class="fas fa-paper-plane me-2" style="color: #20713a;"></i>
                            Envie sua Mensagem
                        </h3>
                        
                        <p class="text-muted mb-4">
                            Preencha o formulário abaixo e entraremos em contato o mais rápido possível.
                            Todos os campos marcados com * são obrigatórios.
                        </p>

                        <?php $form = ActiveForm::begin([
                            'id' => 'contact-form',
                            'options' => ['class' => 'contact-form']
                        ]); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'name', [
                                    'options' => ['class' => 'form-group'],
                                    'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-user"></i></span></div>{error}'
                                ])->textInput([
                                    'autofocus' => true,
                                    'class' => 'form-control',
                                    'placeholder' => 'Seu nome completo'
                                ]) ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'email', [
                                    'options' => ['class' => 'form-group'],
                                    'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-envelope"></i></span></div>{error}'
                                ])->textInput([
                                    'class' => 'form-control',
                                    'placeholder' => 'seu@email.com'
                                ]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'subject', [
                                    'options' => ['class' => 'form-group'],
                                    'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-tag"></i></span></div>{error}'
                                ])->textInput([
                                    'class' => 'form-control',
                                    'placeholder' => 'Assunto da mensagem'
                                ]) ?>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo de Contato</label>
                                <div class="input-group">
                                    <select class="form-select">
                                        <option value="">Selecione uma opção</option>
                                        <option value="duvida">Dúvida</option>
                                        <option value="sugestao">Sugestão</option>
                                        <option value="proposta">Proposta Comercial</option>
                                        <option value="suporte">Jurídico</option>
                                        <option value="homologacao">Homologação</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'body', [
                                'options' => ['class' => 'form-group'],
                                'template' => '{label}<div class="input-group">{input}<span class="input-group-text"><i class="fas fa-comment"></i></span></div>{error}'
                            ])->textarea([
                                'rows' => 6,
                                'class' => 'form-control',
                                'placeholder' => 'Digite sua mensagem aqui...'
                            ]) ?>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                    'template' => '<div class="input-group"><div class="input-group-text">{image}</div>{input}<span class="input-group-text"><i class="fas fa-shield-alt"></i></span></div>',
                                    'options' => ['class' => 'form-control', 'placeholder' => 'Digite o código']
                ]) ?>
                            </div>
                        </div>

                <div class="form-check mb-3">
                    <?= $form->field($model, 'aceite_politica', [
                        'template' => '{input}{error}',
                        'options' => ['class' => 'form-check'],
                    ])->checkbox([
                        'value' => 1,
                        'uncheck' => null,
                        'class' => 'form-check-input',
                        'label' => 'Concordo com a <a href="' . Url::to(['/site/politica-privacidade']) . '" target="_blank">política de privacidade</a> e autorizo o uso dos meus dados para contato.',
                        'encode' => false,
                    ]) ?>
                </div>

                <div class="form-group">
                            <?= Html::submitButton('<i class="fas fa-paper-plane me-1"></i> Enviar Mensagem', ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mapa do Google Maps -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">
                            <i class="fas fa-map-marked-alt me-2" style="color: #20713a;"></i>
                            Nossa Localização
                        </h3>
                        <p class="text-muted mb-4">
                            Av. João Wallig, 518 - Bairro Passo D'Areia, Porto Alegre, RS
                        </p>
                        
                        <div class="map-container" style="position: relative; height: 400px; border-radius: 8px; overflow: hidden;">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.728136331381!2d-51.16672698430695!3d-30.015961736914086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951977768f319573%3A0x3b7347e2bcd36ed7!2sSINPAPTEP+-+RS!5e0!3m2!1spt-BR!2sbr!4v1456774048145"
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="https://maps.google.com/?q=Av.+João+Wallig,+518,+Passo+D'Areia,+Porto+Alegre,+RS" 
                               target="_blank" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-external-link-alt me-2"></i>
                                Abrir no Google Maps
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
