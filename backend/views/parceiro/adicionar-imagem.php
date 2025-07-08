<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ParceiroImagem $model */
/** @var common\models\Parceiro $parceiro */

$this->title = 'Adicionar Imagem - ' . $parceiro->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $parceiro->Nome, 'url' => ['view', 'id' => $parceiro->Id]];
$this->params['breadcrumbs'][] = 'Adicionar Imagem';
?>
<div class="parceiro-imagem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Nova Imagem</h5>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'imagemFile')->fileInput([
                        'class' => 'form-control-file',
                        'accept' => 'image/*'
                    ])->hint('Formatos aceitos: PNG, JPG, JPEG, GIF. Tamanho máximo: 5MB') ?>

                    <?= $form->field($model, 'Descricao')->textarea([
                        'rows' => 3,
                        'placeholder' => 'Descrição opcional da imagem...'
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fas fa-save"></i> Salvar Imagem', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['view', 'id' => $parceiro->Id], ['class' => 'btn btn-secondary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informações do Parceiro</h5>
                </div>
                <div class="card-body">
                    <h6><?= Html::encode($parceiro->Nome) ?></h6>
                    <?php if ($parceiro->Descricao): ?>
                        <p class="text-muted small"><?= Html::encode($parceiro->Descricao) ?></p>
                    <?php endif; ?>
                    

                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dicas</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-info-circle text-info"></i> Use imagens de boa qualidade</li>
                        <li><i class="fas fa-info-circle text-info"></i> Formatos recomendados: JPG, PNG</li>
                        <li><i class="fas fa-info-circle text-info"></i> Tamanho máximo: 5MB</li>
                        <li><i class="fas fa-info-circle text-info"></i> Adicione uma descrição para melhor organização</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div> 