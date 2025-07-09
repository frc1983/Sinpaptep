<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Sócios';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('<i class="fas fa-plus"></i> Novo Sócio', ['create'], ['class' => 'btn btn-success']) ?>
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
            'attribute' => 'CPF',
            'label' => 'CPF',
            'contentOptions' => ['width' => '150'],
            'content' => function ($model) {
                return Html::encode($model->CPF);
            },
        ],
        [
            'attribute' => 'Celular',
            'label' => 'Celular',
            'contentOptions' => ['width' => '150'],
            'content' => function ($model) {
                if ($model->Celular) {
                    return Html::a(Html::encode($model->Celular), 'tel:' . $model->Celular, ['class' => 'text-primary']);
                }
                return '<span class="text-danger">Obrigatório</span>';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'Telefone',
            'label' => 'Telefone',
            'contentOptions' => ['width' => '150'],
            'content' => function ($model) {
                if ($model->Telefone) {
                    return Html::a(Html::encode($model->Telefone), 'tel:' . $model->Telefone, ['class' => 'text-primary']);
                }
                return '<span class="text-muted">-</span>';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'CidadeNascimento',
            'label' => 'Cidade de Nascimento',
            'content' => function ($model) {
                return Html::encode($model->CidadeNascimento);
            },
        ],
        [
            'attribute' => 'DataNascimento',
            'label' => 'Data de Nascimento',
            'content' => function ($model) {
                return Html::encode($model->DataNascimento);
            },
        ],
        [
            'class' => ActionColumn::class,
            'header' => 'Ações',
            'headerOptions' => ['width' => '180'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '{view} {update} {delete} {print}',
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
                            'confirm' => 'Tem certeza que deseja excluir este sócio?',
                            'method' => 'post',
                        ],
                    ]);
                },
                'print' => function ($url, $model) {
                    return Html::a('<i class="fas fa-print"></i>', ['imprimir', 'id' => $model->Id], [
                        'class' => 'btn btn-secondary btn-sm',
                        'title' => 'Imprimir',
                        'target' => '_blank'
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