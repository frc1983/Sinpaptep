<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Convencao */

$this->title = 'Create Convencao';
$this->params['breadcrumbs'][] = ['label' => 'Convencaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convencao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
