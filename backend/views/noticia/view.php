<?php
use yii\helpers\Html;

$this->title = $model->Titulo;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Excluir', ['delete', 'id' => $model->Id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Tem certeza que deseja excluir esta notícia?',
            'method' => 'post',
        ],
    ]) ?>
</p>
<ul>
    <li><b>ID:</b> <?= $model->Id ?></li>
    <li><b>Título:</b> <?= Html::encode($model->Titulo) ?></li>
    <li><b>Subtítulo:</b> <?= Html::encode($model->Sub_Titulo) ?></li>
    <li><b>Conteúdo:</b> <?= \yii\helpers\Html::decode($model->Texto) ?></li>
    <!-- <li><b>Data de Publicação:</b> <?= isset($model->data_publicacao) ? $model->data_publicacao : '' ?></li> -->
    <?php if ($model->imagens): ?>
        <li><b>Imagens:</b><br>
            <?php foreach ($model->imagens as $img): ?>
                <img src="<?= Yii::getAlias('@web') . '/' . $img->Url ?>" style="max-width:300px; margin:5px;">
            <?php endforeach; ?>
        </li>
    <?php endif; ?>
</ul> 