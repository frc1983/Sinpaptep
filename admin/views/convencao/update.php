<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Convencao */

$this->title = 'Editar Convenção: ' . ' ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Convenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="convencao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
