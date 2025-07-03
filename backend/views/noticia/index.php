<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Notícias';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Nova Notícia', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'Id',
        [
            'attribute' => 'categoria',
            'label' => 'Categoria',
            'value' => function($model) {
                return $model->categoria ? $model->categoria->Nome : 'Sem categoria';
            }
        ],
        'Titulo',
        'Sub_Titulo',
        [
            'attribute' => 'imagem',
            'label' => 'Imagens',
            'format' => 'raw',
            'value' => function($model) {
                return $model->getImagens()->count();
            }
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?> 