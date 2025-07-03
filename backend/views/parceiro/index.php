<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Parceiros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parceiro-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Criar Parceiro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Nome:ntext',
            [
                'attribute' => 'Logo',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->Logo) {
                        return Html::img($model->getLogoUrl(), [
                            'style' => 'max-height: 50px; max-width: 100px; object-fit: contain;',
                            'alt' => $model->Nome
                        ]);
                    }
                    return '<span class="text-muted">Sem logo</span>';
                },
            ],
            'Site:url',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Id' => $model->Id]);
                 }
            ],
        ],
    ]); ?>


</div> 