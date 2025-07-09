<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Usuário: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-user me-2 icon-highlight"></i><?= Html::encode($this->title) ?></b>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <tr><th>ID</th><td><?= $model->id ?></td></tr>
                    <tr><th>Nome de Usuário</th><td><?= Html::encode($model->username) ?></td></tr>
                    <tr><th>Email</th><td><?= Html::encode($model->email) ?></td></tr>
                    <tr><th>Status</th><td><?= $model->status == 10 ? '<span class="badge bg-success">Ativo</span>' : '<span class="badge bg-secondary">Inativo</span>' ?></td></tr>
                    <tr><th>Criado em</th><td><?= $model->created_at ? date('d/m/Y H:i', $model->created_at) : '-' ?></td></tr>
                    <tr><th>Atualizado em</th><td><?= $model->updated_at ? date('d/m/Y H:i', $model->updated_at) : '-' ?></td></tr>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-1"></i> Ações</h6>
                    </div>
                    <div class="card-body">
                        <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary w-100 mb-2']) ?>
                        <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger w-100',
                            'data' => [
                                'confirm' => 'Tem certeza que deseja excluir este usuário?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary w-100 mt-2']) ?>
                    </div>
                </div>
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
</style> 