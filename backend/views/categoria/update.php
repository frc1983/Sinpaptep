<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Categoria: ' . $model->Nome;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="categoria-update">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?> 