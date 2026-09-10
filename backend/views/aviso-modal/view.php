<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AvisoModal $model */

$this->title = 'Aviso #' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Avisos do Modal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="aviso-modal-view">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-eye me-2"></i><?= Html::encode($this->title) ?>
        </h1>
        <div class="d-flex gap-2">
            <?= Html::a('<i class="fas fa-edit me-1"></i> Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
            <?php if (!$model->Ativo): ?>
                <?= Html::a(
                    '<i class="fas fa-toggle-off me-1"></i> Ativar',
                    ['ativar', 'id' => $model->Id],
                    [
                        'class' => 'btn btn-success',
                        'data-confirm' => 'Ativar este aviso e desativar os demais?',
                        'data-method' => 'post',
                    ]
                ) ?>
            <?php else: ?>
                <span class="btn btn-success disabled"><i class="fas fa-check me-1"></i> Ativo no site</span>
            <?php endif; ?>
            <?= Html::a(
                '<i class="fas fa-trash me-1"></i> Excluir',
                ['delete', 'id' => $model->Id],
                [
                    'class' => 'btn btn-danger',
                    'data-confirm' => 'Tem certeza que deseja excluir este aviso?',
                    'data-method' => 'post',
                ]
            ) ?>
            <?= Html::a('<i class="fas fa-arrow-left me-1"></i> Voltar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Titulo',
            [
                'attribute' => 'Ativo',
                'value' => $model->Ativo
                    ? '<span class="badge bg-success">Ativo no site</span>'
                    : '<span class="badge bg-secondary">Inativo</span>',
                'format' => 'raw',
            ],
            'Criado_Em:datetime',
            'Atualizado_Em:datetime',
        ],
    ]) ?>

    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-desktop me-2"></i>Pré-visualização do conteúdo</h5>
        </div>
        <div class="card-body">
            <div class="border rounded p-4 bg-white" style="max-height: 600px; overflow-y: auto;">
                <?= $model->Conteudo ?>
            </div>
        </div>
    </div>

</div>
