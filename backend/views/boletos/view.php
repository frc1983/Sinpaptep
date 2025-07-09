<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Boleto $model */

$this->title = 'Boleto #' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Boletos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boleto-view">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <b><i class="fas fa-barcode me-2 icon-highlight"></i><?= Html::encode($this->title) ?></b>
                </div>
                <div>
                    <?= Html::a('<i class="fas fa-edit me-1"></i> Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-light btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-trash me-1"></i> Excluir', ['delete', 'id' => $model->Id], [
                        'class' => 'btn btn-light btn-sm',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir este boleto?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'Id',
                            'Nome',
                            [
                                'attribute' => 'CNPJ',
                                'value' => $model->getCNPJFormatado(),
                            ],
                            'Endereco',
                            [
                                'attribute' => 'CEP',
                                'value' => $model->getCEPFormatado(),
                            ],
                            'Cidade',
                            [
                                'attribute' => 'Valor',
                                'value' => Yii::$app->formatter->asCurrency($model->Valor, 'BRL'),
                            ],
                            [
                                'attribute' => 'DataVencimento',
                                'value' => $model->DataVencimento ? date('d/m/Y', strtotime($model->DataVencimento)) : '',
                            ],
                            [
                                'attribute' => 'Multa',
                                'value' => $model->Multa !== null ? Yii::$app->formatter->asCurrency($model->Multa, 'BRL') : 'N/A',
                            ],
                            [
                                'attribute' => 'DespesaBancaria',
                                'value' => Yii::$app->formatter->asCurrency($model->DespesaBancaria, 'BRL'),
                            ],
                            [
                                'attribute' => 'DataGeracaoBoleto',
                                'value' => $model->DataGeracaoBoleto ? date('d/m/Y', strtotime($model->DataGeracaoBoleto)) : '',
                            ],
                        ],
                        'options' => ['class' => 'table table-striped'],
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-info-circle me-1"></i> Informações</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Status:</strong><br>
                                <?php if ($model->isVencido()): ?>
                                    <span class="badge bg-danger">Vencido</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Válido</span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($model->isVencido()): ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle text-danger-icon"></i>
                                    <strong>Boleto Vencido!</strong>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <strong>Valor Principal:</strong><br>
                                <span class="h5 text-success"><?= Yii::$app->formatter->asCurrency($model->Valor, 'BRL') ?></span>
                            </div>
                            
                            <?php if ($model->Multa): ?>
                                <div class="mb-3">
                                    <strong>Multa:</strong><br>
                                    <span class="text-danger"><?= Yii::$app->formatter->asCurrency($model->Multa, 'BRL') ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <strong>Despesa Bancária:</strong><br>
                                <span class="text-info"><?= Yii::$app->formatter->asCurrency($model->DespesaBancaria, 'BRL') ?></span>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Valor Total:</strong><br>
                                <span class="h6 text-primary"><?= Yii::$app->formatter->asCurrency($model->getValorTotal(), 'BRL') ?></span>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Vencimento:</strong><br>
                                <?= $model->DataVencimento ? date('d/m/Y', strtotime($model->DataVencimento)) : '' ?>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Geração:</strong><br>
                                <?= $model->DataGeracaoBoleto ? date('d/m/Y', strtotime($model->DataGeracaoBoleto)) : '' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <?= Html::a('<i class="fas fa-arrow-left me-1"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>

<style>
.icon-highlight {
    color: #fff !important;
    text-shadow: 0 2px 6px rgba(0,0,0,0.25), 0 0px 2px #157347;
    font-size: 1.3em;
    vertical-align: -2px;
}

.text-danger-icon {
    color: #ff6b81 !important;
    text-shadow: 0 1px 3px #fff, 0 1px 3px rgba(220,53,69,0.3);
    font-size: 1.2em;
    vertical-align: -2px;
}

.table th {
    font-weight: 600;
    width: 30%;
}
</style> 