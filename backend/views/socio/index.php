<?php
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\ButtonGroup;

$this->title = 'Sócios';
$this->params['breadcrumbs'][] = $this->title;

function formatDateBr($date) {
    if (!$date || $date == '0000-00-00') return '';
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d ? $d->format('d/m/Y') : $date;
}
?>
<div class="socio-index">
    <h1 class="mb-4">Sócios</h1>
    <p>
        <?= Html::a('Novo Sócio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Id',
            'Nome',
            'CPF',
            'CidadeNascimento',
            [
                'attribute' => 'DataNascimento',
                'label' => 'Data de Nascimento',
                'value' => function($model) { return formatDateBr($model->DataNascimento); },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {imprimir}',
                'buttons' => [
                    'imprimir' => function ($url, $model, $key) {
                        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24" style="vertical-align:middle;"><path d="M17 17H7v4h10v-4zm2-2V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v8H3v4a2 2 0 0 0 2 2h2v-4h10v4h2a2 2 0 0 0 2-2v-4h-2zm-2-8v2H7V7h10z"/></svg>';
                        return Html::a($svg, ['imprimir', 'id' => $model->Id], [
                            'title' => 'Imprimir ficha',
                            'target' => '_blank',
                            'data-pjax' => '0',
                            'aria-label' => 'Imprimir ficha',
                        ]);
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
    ]) ?>
</div> 