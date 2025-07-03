<?php

/** @var yii\web\View$this  */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reenviar e-mail de verificação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-resend-verification-email">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-envelope me-3"></i>Reenviar E-mail de Verificação
                </h1>
                <p class="lead text-muted">
                    Informe seu e-mail para receber novamente o link de verificação do SINPAPTEP-RS
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Seu e-mail']) ?>

            <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
