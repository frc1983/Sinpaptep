<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Boletos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-barcode me-2 icon-highlight"></i>Boletos</b>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i> Novo Boleto', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" style="width:80px;">ID</th>
                        <th>Nome</th>
                        <th style="width:150px;">CNPJ</th>
                        <th style="width:120px;">Cidade</th>
                        <th style="width:120px;">Valor</th>
                        <th style="width:120px;">Vencimento</th>
                        <th class="text-center" style="width:100px;">Status</th>
                        <th class="text-center" style="width:150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <tr>
                            <td class="text-center">
                                <span class="badge" style="background-color: var(--sinpaptep-gray); color: var(--sinpaptep-dark);">#<?= $model->Id ?></span>
                            </td>
                            <td><strong><?= Html::encode($model->Nome) ?></strong></td>
                            <td><?= $model->getCNPJFormatado() ?></td>
                            <td><?= Html::encode($model->Cidade) ?></td>
                            <td><strong><?= $model->getValorFormatado() ?></strong></td>
                            <td><?= $model->DataVencimento ? date('d/m/Y', strtotime($model->DataVencimento)) : '' ?></td>
                            <td class="text-center">
                                <?php if ($model->isVencido()): ?>
                                    <span class="badge bg-danger">
                                        <i class="fas fa-exclamation-triangle text-danger-icon"></i> Vencido
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Válido
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->Id], [
                                    'class' => 'btn btn-info btn-sm',
                                    'title' => 'Visualizar'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->Id], [
                                    'class' => 'btn btn-primary btn-sm',
                                    'title' => 'Editar'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->Id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Excluir',
                                    'data' => [
                                        'confirm' => 'Tem certeza que deseja excluir este boleto?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($dataProvider->getCount() == 0): ?>
            <div class="text-center py-4">
                <i class="fas fa-barcode fa-3x text-muted mb-3"></i>
                <p class="text-muted">Nenhum boleto encontrado.</p>
                <?= Html::a('<i class="fas fa-plus me-1"></i> Criar Primeiro Boleto', ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php endif; ?>
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
</style> 