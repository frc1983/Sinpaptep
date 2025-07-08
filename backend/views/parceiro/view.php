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
        <?= Html::a('<i class="fas fa-edit"></i> Atualizar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-plus"></i> Adicionar Imagem', ['adicionar-imagem', 'parceiroId' => $model->Id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'id' => $model->Id], [
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
                            <?php foreach ($imagens as $imagem): ?>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="card h-100">
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
                                            <?= Html::a('<i class="fas fa-trash"></i> Remover', 
                                                ['remover-imagem', 'id' => $imagem->Id], 
                                                [
                                                    'class' => 'btn btn-sm btn-danger',
                                                    'data' => [
                                                        'confirm' => 'Tem certeza que deseja remover esta imagem?',
                                                        'method' => 'post',
                                                    ],
                                                ]
                                            ) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-images fa-3x mb-3"></i>
                            <p>Nenhuma imagem cadastrada para este parceiro.</p>
                            <?= Html::a('<i class="fas fa-plus"></i> Adicionar Primeira Imagem', 
                                ['adicionar-imagem', 'parceiroId' => $model->Id], 
                                ['class' => 'btn btn-success']
                            ) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div> 