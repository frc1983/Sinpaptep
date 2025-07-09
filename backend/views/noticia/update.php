<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Categoria;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = 'Atualizar Notícia: ' . $model->Titulo;
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Titulo, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="noticia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div> 