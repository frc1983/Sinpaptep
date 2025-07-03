<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Solicitar redefinição de senha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-key me-3"></i>Solicitar Redefinição de Senha
                </h1>
                <p class="lead text-muted">
                    Informe seu e-mail para receber o link de redefinição do SINPAPTEP-RS
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Seu e-mail']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
