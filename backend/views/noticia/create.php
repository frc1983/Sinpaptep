<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Nova Notícia';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="noticia-create">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'Id_Categoria')->dropDownList(\common\models\Categoria::find()->select(['Nome', 'Id'])->indexBy('Id')->column(), ['prompt' => 'Selecione uma categoria']) ?>
    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Sub_Titulo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Texto')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'imagemFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?> 