<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */

$this->title = 'Atualizar Parceiro: ' . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="parceiro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div> 