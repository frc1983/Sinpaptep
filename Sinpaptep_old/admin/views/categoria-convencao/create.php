<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categoria_Convencao */

$this->title = 'Create Categoria  Convencao';
$this->params['breadcrumbs'][] = ['label' => 'Categoria  Convencaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria--convencao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
