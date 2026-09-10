<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Parceiro */

$this->title = 'Create Parceiro';
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parceiro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
