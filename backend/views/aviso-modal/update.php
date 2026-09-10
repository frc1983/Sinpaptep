<?php

/** @var yii\web\View $this */
/** @var common\models\AvisoModal $model */

$this->title = 'Editar Aviso: ' . $model->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Avisos do Modal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#' . $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>

<div class="aviso-modal-update">
    <h1 class="h3 mb-4">
        <i class="fas fa-edit me-2 text-primary"></i><?= \yii\helpers\Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>
