<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */

$this->title = 'Novo Parceiro';
$this->params['breadcrumbs'][] = ['label' => 'Parceiros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="parceiro-create">
    <?php if ($model->hasErrors()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($model->getFirstErrors() as $attr => $err): ?>
                    <li><strong><?= $model->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <div class="mb-3">
            <label for="parceiro-nome">Nome</label>
            <input type="text" class="form-control" id="parceiro-nome" name="Parceiro[Nome]" maxlength="255" value="<?= Html::encode($model->Nome) ?>">
        </div>
        <div class="mb-3">
            <label for="parceiro-site">Site</label>
            <input type="text" class="form-control" id="parceiro-site" name="Parceiro[Site]" maxlength="255" value="<?= Html::encode($model->Site) ?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Salvar
            </button>
        </div>
    </form>
</div> 