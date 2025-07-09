<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Redefinir senha';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-key me-3"></i>Redefinir Senha
                </h1>
                <p class="lead text-muted">
                    Informe sua nova senha para acessar o SINPAPTEP-RS
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Nova senha']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div> 