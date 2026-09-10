<?php

/** @var yii\web\View $this */
/** @var common\models\AvisoModal $model */

$this->title = 'Novo Aviso Modal';
$this->params['breadcrumbs'][] = ['label' => 'Avisos do Modal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="aviso-modal-create">
    <h1 class="h3 mb-4">
        <i class="fas fa-plus-circle me-2 text-success"></i><?= \yii\helpers\Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_form', ['model' => $model]) ?>
</div>
