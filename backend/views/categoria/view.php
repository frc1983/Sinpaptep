<?php
use yii\helpers\Html;

$this->title = $model->Nome;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="categoria-view">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= Html::encode($model->Id) ?></td>
        </tr>
        <tr>
            <th>Nome</th>
            <td><?= Html::encode($model->Nome) ?></td>
        </tr>
    </table>
    <p>
        <div class="btn-group" role="group">
            <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'id' => $model->Id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza que deseja excluir esta categoria?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </p>
</div> 