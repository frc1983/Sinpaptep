<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */

$this->title = 'Criar Parceiro';
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parceiro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div> 