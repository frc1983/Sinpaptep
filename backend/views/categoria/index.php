<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-list-alt me-2 icon-highlight"></i>Categorias</b>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i> Nova Categoria', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" style="width:80px;">ID</th>
                        <th>Nome</th>
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
                            <td class="text-center">
                                <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->Id], [
                                    'class' => 'btn btn-info btn-sm',
                                    'title' => 'Visualizar']) ?>
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->Id], [
                                    'class' => 'btn btn-primary btn-sm',
                                    'title' => 'Editar']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->Id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Excluir',
                                    'data' => [
                                        'confirm' => 'Tem certeza que deseja excluir esta categoria?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
</style> 