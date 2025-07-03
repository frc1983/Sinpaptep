<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parceiro-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'Descricao')->textarea(['rows' => 6, 'maxlength' => 5000]) ?>

            <?= $form->field($model, 'Site')->textInput(['maxlength' => true, 'placeholder' => 'https://exemplo.com']) ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'logoFile')->fileInput(['accept' => 'image/*']) ?>
            
            <?php if ($model->Logo): ?>
                <div class="form-group">
                    <label class="control-label">Logo Atual:</label>
                    <div class="mt-2">
                        <?= Html::img($model->getLogoUrl(), [
                            'class' => 'img-fluid',
                            'style' => 'max-height: 150px; max-width: 200px; object-fit: contain; border: 1px solid #ddd; border-radius: 4px;',
                            'alt' => $model->Nome
                        ]) ?>
                    </div>
                    <div class="mt-2">
                        <?= Html::a('<i class="fas fa-trash"></i> Remover Logo', ['remover-logo', 'id' => $model->Id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Tem certeza que deseja remover o logo?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="alert alert-info">
                <small>
                    <i class="fas fa-info-circle"></i>
                    <strong>Formatos aceitos:</strong> PNG, JPG, JPEG, GIF, WEBP<br>
                    <strong>Tamanho máximo:</strong> 2MB<br>
                    <strong>Dimensões recomendadas:</strong> 300x150px
                </small>
            </div>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('<i class="fas fa-save"></i> Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> 