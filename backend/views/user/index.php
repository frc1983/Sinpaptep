<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-user me-2 icon-highlight"></i>Usuários</b>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i> Novo Usuário', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" style="width:80px;">ID</th>
                        <th>Nome de Usuário</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-center" style="width:150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <tr>
                            <td class="text-center">
                                <span class="badge" style="background-color: var(--sinpaptep-gray); color: var(--sinpaptep-dark);">#<?= $model->id ?></span>
                            </td>
                            <td><strong><?= Html::encode($model->username) ?></strong></td>
                            <td><?= Html::encode($model->email) ?></td>
                            <td>
                                <?php if ($model->status == 10): ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                                    'class' => 'btn btn-info btn-sm',
                                    'title' => 'Visualizar'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                                    'class' => 'btn btn-primary btn-sm',
                                    'title' => 'Editar'
                                ]) ?>
                                <?= Html::a('<i class="fas fa-key"></i>', ['reset-password', 'id' => $model->id], [
                                    'class' => 'btn btn-warning btn-sm',
                                    'title' => 'Enviar link de redefinição de senha',
                                    'data' => [
                                        'confirm' => 'Deseja enviar um email de redefinição de senha para este usuário?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Excluir',
                                    'data' => [
                                        'confirm' => 'Tem certeza que deseja excluir este usuário?',
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