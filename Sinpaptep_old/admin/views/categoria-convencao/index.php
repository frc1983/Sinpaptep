<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaConvencaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias das Conven��es';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria--convencao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Categoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Nome',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
