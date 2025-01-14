<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Convencao */

$this->title = 'Update Convencao: ' . ' ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Convencaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="convencao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
