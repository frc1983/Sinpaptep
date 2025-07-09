<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

$this->title = 'Notícias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-newspaper me-2 icon-highlight"></i>Notícias</b>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i> Nova Notícia', ['create'], ['class' => 'btn btn-success']) ?>
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
            'contentOptions' => ['class' => 'text-center', 'width' => '60'],
            'content' => function ($model) {
                return '<span class="badge" style="background-color: var(--sinpaptep-gray); color: var(--sinpaptep-dark);">#' . $model->Id . '</span>';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'categoria',
            'label' => 'Categoria',
            'contentOptions' => ['width' => '120'],
            'content' => function ($model) {
                $categoriaNome = $model->CategoriaNome ?? $model->getCategoriaNome();
                return '<span class="badge" style="background-color: var(--sinpaptep-primary); color: var(--sinpaptep-white);">' . 
                       Html::encode($categoriaNome) . '</span>';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'Titulo',
            'label' => 'Título',
            'content' => function ($model) {
                return '<strong>' . Html::encode($model->Titulo) . '</strong>';
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'Sub_Titulo',
            'label' => 'Subtítulo',
            'contentOptions' => ['width' => '200'],
            'content' => function ($model) {
                if ($model->Sub_Titulo) {
                    return '<em>' . Html::encode($model->Sub_Titulo) . '</em>';
                } else {
                    return '<span class="text-muted">-</span>';
                }
            },
            'format' => 'raw',
        ],
        [
            'label' => 'Resumo',
            'contentOptions' => ['width' => '300'],
            'content' => function ($model) {
                return "";
            },
            'format' => 'raw',
        ],
        [
            'label' => 'Imagens',
            'contentOptions' => ['class' => 'text-center', 'width' => '120'],
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
                            'confirm' => 'Tem certeza que deseja excluir esta notícia?',
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