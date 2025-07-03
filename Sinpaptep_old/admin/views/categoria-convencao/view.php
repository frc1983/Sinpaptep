<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria_Convencao */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Categorias das Convenc�es', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria--convencao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Voc� tem certeza que deseja excluir essa categoria de conve��o?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Nome',
        ],
    ]) ?>

</div>
