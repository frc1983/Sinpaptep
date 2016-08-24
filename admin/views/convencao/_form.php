<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="convencao-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?=
    $form->field($model, 'Id_Categoria_Convencao')->dropDownList(
            ArrayHelper::map(app\models\Categoria_Convencao::getAll(), 'Id', 'Nome'), ['prompt' => 'Selecione...'])
    ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>