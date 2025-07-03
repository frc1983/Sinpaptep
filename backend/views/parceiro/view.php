<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parceiro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-edit"></i> Atualizar', ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir este parceiro?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <div class="row">
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'Id',
                    'Nome',
                    'Descricao:ntext',
                    [
                        'attribute' => 'Site',
                        'format' => 'url',
                        'value' => function ($model) {
                            return $model->Site ? $model->Site : null;
                        },
                    ],
                ],
            ]) ?>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Logo</h5>
                </div>
                <div class="card-body text-center">
                    <?php if ($model->Logo): ?>
                        <?= Html::img($model->getLogoUrl(), [
                            'class' => 'img-fluid',
                            'style' => 'max-height: 200px; max-width: 300px; object-fit: contain;',
                            'alt' => $model->Nome
                        ]) ?>
                        <div class="mt-2">
                            <small class="text-muted"><?= $model->Logo ?></small>
                        </div>
                    <?php else: ?>
                        <div class="text-muted">
                            <i class="fas fa-image fa-3x mb-2"></i>
                            <p>Nenhum logo cadastrado</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div> 