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
                    <label for="parceiro-nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control" id="parceiro-nome" name="Parceiro[Nome]" maxlength="255" value="<?= Html::encode($model->Nome) ?>" required>
                    <div class="form-text">Nome do parceiro (máximo 255 caracteres)</div>
                </div>
                <div class="mb-3">
                    <label for="parceiro-descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="parceiro-descricao" name="Parceiro[Descricao]" rows="6" maxlength="5000" placeholder="Descrição detalhada do parceiro..."><?= Html::encode($model->Descricao) ?></textarea>
                    <div class="form-text">Descrição opcional do parceiro (máximo 5000 caracteres)</div>
                </div>
                <div class="mb-3">
                    <label for="parceiro-site" class="form-label">Site</label>
                    <input type="url" class="form-control" id="parceiro-site" name="Parceiro[Site]" maxlength="255" placeholder="https://exemplo.com" value="<?= Html::encode($model->Site) ?>">
                    <div class="form-text">URL do site do parceiro (opcional)</div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Imagens</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($model->imagens): ?>
                            <div class="mb-3">
                                <label class="form-label">Imagens Atuais</label>
                                <div class="row">
                                    <?php foreach ($model->imagens as $img): ?>
                                        <div class="col-6 mb-2">
                                            <div class="card">
                                                <img src="<?= $img->getImagemUrl() ?>" 
                                                     class="card-img-top" 
                                                     style="height: 80px; object-fit: cover;"
                                                     alt="Imagem do parceiro">
                                                <div class="card-body p-2">
                                                    <?= Html::a('<i class="fas fa-trash"></i>', 
                                                        ['/parceiro/remover-imagem', 'id' => $img->Id], 
                                                        [
                                                            'class' => 'btn btn-danger btn-sm w-100',
                                                            'onclick' => 'return confirm("Remover esta imagem?")',
                                                            'title' => 'Remover imagem'
                                                        ]
                                                    ) ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label for="parceiro-imagem" class="form-label">Adicionar Imagens</label>
                            <input type="file" class="form-control" id="parceiro-imagem" name="Parceiro[imagemFile][]" multiple accept="image/*">
                            <div class="form-text">
                                Formatos: PNG, JPG, JPEG<br>
                                Máximo: 10 arquivos<br>
                                Tamanho recomendado: 800x600px
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                <strong>Dicas:</strong><br>
                                • Adicione imagens para melhor visualização<br>
                                • Use formatos web otimizados<br>
                                • Mantenha proporções adequadas
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group mt-4">
            <?php if ($model->isNewRecord): ?>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Salvar Parceiro
                </button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Atualizar Parceiro
                </button>
            <?php endif; ?>
            <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </form>
</div> 