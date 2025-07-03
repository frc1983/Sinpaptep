<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Categorias de Notícias';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Nova Categoria', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'Id',
        'Nome',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ],
]); ?> 