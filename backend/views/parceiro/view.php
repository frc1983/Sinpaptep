<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */
/** @var common\models\ParceiroImagem[] $imagens */

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
        

    </div>

    <!-- Seção de Imagens -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-images"></i> Imagens do Parceiro
                        <span class="badge badge-primary"><?= count($imagens) ?></span>
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($imagens)): ?>
                        <div class="row">
                            <?php foreach ($imagens as $index => $imagem): ?>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-header bg-light">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary">Posição <?= $imagem->Ordem ?: ($index + 1) ?></span>
                                                <div class="btn-group btn-group-sm">
                                                    <?php if ($index > 0): ?>
                                                        <?= Html::a('<i class="fas fa-arrow-up"></i>', 
                                                            ['mover-imagem-cima', 'id' => $imagem->Id], 
                                                            [
                                                                'class' => 'btn btn-outline-primary',
                                                                'title' => 'Mover para cima'
                                                            ]
                                                        ) ?>
                                                    <?php endif; ?>
                                                    <?php if ($index < count($imagens) - 1): ?>
                                                        <?= Html::a('<i class="fas fa-arrow-down"></i>', 
                                                            ['mover-imagem-baixo', 'id' => $imagem->Id], 
                                                            [
                                                                'class' => 'btn btn-outline-primary',
                                                                'title' => 'Mover para baixo'
                                                            ]
                                                        ) ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-img-top text-center p-2" style="height: 200px; background-color: #f8f9fa;">
                                            <?= Html::img($imagem->getImagemUrl(), [
                                                'class' => 'img-fluid',
                                                'style' => 'max-height: 180px; max-width: 100%; object-fit: contain;',
                                                'alt' => $imagem->Descricao ?: 'Imagem do parceiro'
                                            ]) ?>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($imagem->Descricao): ?>
                                                <p class="card-text small"><?= Html::encode($imagem->Descricao) ?></p>
                                            <?php endif; ?>
                                            <small class="text-muted">
                                                <?= $imagem->getImagemNome() ?><br>
                                                <?= date('d/m/Y H:i', $imagem->created_at) ?>
                                            </small>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group btn-group-sm w-100">
                                                <?= Html::a('<i class="fas fa-trash"></i>', 
                                                    ['remover-imagem', 'id' => $imagem->Id], 
                                                    [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                            'confirm' => 'Tem certeza que deseja remover esta imagem?',
                                                            'method' => 'post',
                                                        ],
                                                        'title' => 'Remover imagem'
                                                    ]
                                                ) ?>
                                                <button type="button" class="btn btn-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalPosicao<?= $imagem->Id ?>"
                                                        title="Definir posição específica">
                                                    <i class="fas fa-sort-numeric-up"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para definir posição específica -->
                                <div class="modal fade" id="modalPosicao<?= $imagem->Id ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Definir Posição da Imagem</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Defina a nova posição para esta imagem (1 a <?= count($imagens) ?>):</p>
                                                <form method="post" action="<?= Url::to(['mover-imagem-posicao', 'id' => $imagem->Id]) ?>">
                                                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                                    <div class="input-group">
                                                        <input type="number" name="posicao" class="form-control" 
                                                               min="1" max="<?= count($imagens) ?>" 
                                                               value="<?= $imagem->Ordem ?: ($index + 1) ?>">
                                                        <button type="submit" class="btn btn-primary">Mover</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-images fa-3x mb-3"></i>
                            <p>Nenhuma imagem cadastrada para este parceiro.</p>
                            <p class="small">Use o botão "Atualizar" para adicionar imagens.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div> 