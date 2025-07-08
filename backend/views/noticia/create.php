<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Categoria;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

$this->title = 'Criar Notícia';
$this->params['breadcrumbs'][] = ['label' => 'Notícias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div> 