<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Convencao */

$this->title = 'Inserir Convenção';
$this->params['breadcrumbs'][] = ['label' => 'Convenções', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convencao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
