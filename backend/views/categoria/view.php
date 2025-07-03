<?php
use yii\helpers\Html;

$this->title = 'Categoria: ' . $model->Nome;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Excluir', ['delete', 'id' => $model->Id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Tem certeza que deseja excluir esta categoria?',
            'method' => 'post',
        ],
    ]) ?>
</p>
<ul>
    <li><b>ID:</b> <?= Html::encode($model->Id) ?></li>
    <li><b>Nome:</b> <?= Html::encode($model->Nome) ?></li>
</ul> 