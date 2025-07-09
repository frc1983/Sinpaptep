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
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-handshake me-2 icon-highlight"></i>Parceiros</b>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i> Criar Parceiro', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => null,
            'tableOptions' => ['class' => 'table table-striped table-bordered'],
            'headerRowOptions' => ['class' => 'table-primary'],
            'columns' => [
                [
                    'attribute' => 'Id',
                    'label' => 'ID',
                    'contentOptions' => ['class' => 'text-center', 'width' => '80'],
                    'content' => function ($model) {
                        return '<span class="badge" style="background-color: var(--sinpaptep-gray); color: var(--sinpaptep-dark);">#' . $model->Id . '</span>';
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'Nome',
                    'label' => 'Nome',
                    'content' => function ($model) {
                        return '<strong>' . Html::encode($model->Nome) . '</strong>';
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'Site',
                    'label' => 'Site',
                    'content' => function ($model) {
                        if ($model->Site) {
                            return Html::a(Html::encode($model->Site), $model->Site, [
                                'target' => '_blank',
                                'class' => 'text-primary'
                            ]);
                        } else {
                            return '<span class="text-muted">-</span>';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Imagens',
                    'contentOptions' => ['class' => 'text-center', 'width' => '100'],
                    'content' => function ($model) {
                        $count = $model->imagens ? count($model->imagens) : 0;
                        if ($count > 0) {
                            return '<span class="badge" style="background-color: var(--sinpaptep-success); color: var(--sinpaptep-white);">' .
                                   '<i class="fas fa-image"></i> ' . $count . '</span>';
                        } else {
                            return '<span class="badge" style="background-color: var(--sinpaptep-gray); color: var(--sinpaptep-dark);">' .
                                   '<i class="fas fa-image"></i> 0</span>';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => ActionColumn::class,
                    'header' => 'Ações',
                    'headerOptions' => ['width' => '150'],
                    'contentOptions' => ['class' => 'text-center'],
                    'template' => '{view} {update} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            return ['view', 'Id' => $model->Id];
                        }
                        if ($action === 'update') {
                            return ['update', 'Id' => $model->Id];
                        }
                        if ($action === 'delete') {
                            return ['delete', 'Id' => $model->Id];
                        }
                    },
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'class' => 'btn btn-info btn-sm',
                                'title' => 'Visualizar'
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="fas fa-edit"></i>', $url, [
                                'class' => 'btn btn-primary btn-sm',
                                'title' => 'Editar'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Excluir',
                                'data' => [
                                    'confirm' => 'Tem certeza que deseja excluir este parceiro?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
            'pager' => [
                'options' => ['class' => 'pagination justify-content-center'],
                'linkContainerOptions' => ['class' => 'page-item'],
                'linkOptions' => ['class' => 'page-link'],
            ],
        ]); ?>
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