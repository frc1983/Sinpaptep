<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Categorias';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('<i class="fas fa-plus"></i> Nova Categoria', ['create'], ['class' => 'btn btn-success']) ?>
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
            'class' => ActionColumn::class,
            'header' => 'Ações',
            'headerOptions' => ['width' => '150'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '{view} {update} {delete}',
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
                            'confirm' => 'Tem certeza que deseja excluir esta categoria?',
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