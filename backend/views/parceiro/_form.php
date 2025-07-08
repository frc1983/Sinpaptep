<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parceiro $model */
?>

<div class="parceiro-form">
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
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="parceiro-nome">Nome</label>
                    <input type="text" class="form-control" id="parceiro-nome" name="Parceiro[Nome]" maxlength="255" value="<?= Html::encode($model->Nome) ?>">
                </div>
                <div class="mb-3">
                    <label for="parceiro-descricao">Descrição</label>
                    <textarea class="form-control" id="parceiro-descricao" name="Parceiro[Descricao]" rows="6" maxlength="5000"><?= Html::encode($model->Descricao) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="parceiro-site">Site</label>
                    <input type="text" class="form-control" id="parceiro-site" name="Parceiro[Site]" maxlength="255" placeholder="https://exemplo.com" value="<?= Html::encode($model->Site) ?>">
                </div>
            </div>

        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
            <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </form>
</div> 