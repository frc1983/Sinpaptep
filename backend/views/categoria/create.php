<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Nova Categoria';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="categoria-create">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div> 