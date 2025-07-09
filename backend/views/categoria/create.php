<?php
use yii\helpers\Html;

$this->title = 'Nova Categoria';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="categoria-create">
    <?php if ($model->hasErrors()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($model->getFirstErrors() as $attr => $err): ?>
                    <li><strong><?= $model->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <div class="mb-3">
            <label for="categoria-nome">Nome</label>
            <input type="text" class="form-control" id="categoria-nome" name="Categoria[Nome]" maxlength="255" value="<?= Html::encode($model->Nome) ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Salvar
            </button>
        </div>
    </form>
</div> 