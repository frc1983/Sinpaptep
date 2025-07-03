<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria_Convencao */

$this->title = 'Editar Categoria: ' . ' ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Categorias das Convencões', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="categoria--convencao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
