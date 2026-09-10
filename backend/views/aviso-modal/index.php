<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Avisos do Modal';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="aviso-modal-index">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-bullhorn me-2 text-warning"></i><?= Html::encode($this->title) ?>
        </h1>
        <?= Html::a(
            '<i class="fas fa-plus me-1"></i> Novo Aviso',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle me-1"></i>
        Apenas <strong>um aviso</strong> pode estar ativo por vez. O aviso ativo é exibido automaticamente no modal da página inicial do site.
        Ao ativar um aviso, os demais são desativados automaticamente.
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-hover'],
        'columns' => [
            'Id',
            [
                'attribute' => 'Titulo',
                'label' => 'Título',
            ],
            [
                'attribute' => 'Ativo',
                'label' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->Ativo) {
                        return '<span class="badge bg-success"><i class="fas fa-check me-1"></i>Ativo no site</span>';
                    }
                    return '<span class="badge bg-secondary">Inativo</span>';
                },
            ],
            'Criado_Em:datetime:Criado em',
            'Atualizado_Em:datetime:Atualizado em',
            [
                'class' => ActionColumn::class,
                'header' => 'Ações',
                'template' => '{view} {update} {ativar} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<i class="fas fa-eye"></i>',
                            $url,
                            ['class' => 'btn btn-sm btn-outline-info me-1', 'title' => 'Visualizar']
                        );
                    },
                    'update' => function ($url, $model) {
                        return Html::a(
                            '<i class="fas fa-edit"></i>',
                            $url,
                            ['class' => 'btn btn-sm btn-outline-primary me-1', 'title' => 'Editar']
                        );
                    },
                    'ativar' => function ($url, $model) {
                        if ($model->Ativo) {
                            return '<span class="btn btn-sm btn-success me-1 disabled" title="Já está ativo"><i class="fas fa-toggle-on"></i></span>';
                        }
                        return Html::a(
                            '<i class="fas fa-toggle-off"></i>',
                            ['ativar', 'id' => $model->Id],
                            [
                                'class' => 'btn btn-sm btn-outline-success me-1',
                                'title' => 'Ativar este aviso',
                                'data-confirm' => 'Ativar este aviso e desativar os demais?',
                                'data-method' => 'post',
                            ]
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<i class="fas fa-trash"></i>',
                            $url,
                            [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'title' => 'Excluir',
                                'data-confirm' => 'Tem certeza que deseja excluir este aviso?',
                                'data-method' => 'post',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
