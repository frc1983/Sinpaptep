<?php

use yii\helpers\Html;
use dosamigos\tinymce\TinyMce;

/** @var yii\web\View $this */
/** @var common\models\AvisoModal $model */
?>

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
        <label for="aviso-titulo" class="form-label">Título do Comunicado *</label>
        <input type="text"
               class="form-control"
               id="aviso-titulo"
               name="AvisoModal[Titulo]"
               maxlength="255"
               value="<?= Html::encode($model->Titulo) ?>"
               required>
        <div class="form-text">Este título aparece no cabeçalho do modal (ex.: "COMUNICADO DA DIRETORIA").</div>
    </div>

    <div class="mb-3">
        <label for="aviso-conteudo" class="form-label">Conteúdo *</label>
        <?php if (class_exists('dosamigos\tinymce\TinyMce')): ?>
            <?= TinyMce::widget([
                'name'  => 'AvisoModal[Conteudo]',
                'value' => $model->Conteudo,
                'options' => [
                    'id'   => 'aviso-conteudo',
                    'rows' => 15,
                ],
                'clientOptions' => [
                    'height'   => 500,
                    'plugins'  => 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table paste help wordcount',
                    'toolbar'  => 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | fullscreen code | removeformat | help',
                    'menubar'  => true,
                    'statusbar' => true,
                    'resize'   => true,
                    // Permite qualquer elemento/atributo HTML — necessário para edição livre
                    'valid_elements'          => '*[*]',
                    'extended_valid_elements' => '*[*]',
                    'verify_html'             => false,
                    'cleanup'                 => false,
                    'forced_root_block'       => 'p',
                ],
            ]) ?>
            <div class="form-text">
                <i class="fas fa-info-circle me-1"></i>
                Clique no botão <strong>&lt;/&gt;</strong> na barra de ferramentas para editar o HTML diretamente.
            </div>
        <?php else: ?>
            <textarea class="form-control"
                      id="aviso-conteudo"
                      name="AvisoModal[Conteudo]"
                      rows="15"
                      required><?= Html::encode($model->Conteudo) ?></textarea>
            <div class="form-text text-muted">TinyMCE não encontrado; edição em texto puro.</div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   id="aviso-ativo"
                   name="AvisoModal[Ativo]"
                   value="1"
                   <?= $model->Ativo ? 'checked' : '' ?>>
            <label class="form-check-label" for="aviso-ativo">
                <strong>Exibir este aviso no site</strong>
            </label>
        </div>
        <div class="form-text text-warning">
            <i class="fas fa-exclamation-triangle me-1"></i>
            Ao marcar esta opção, <strong>todos os outros avisos serão desativados automaticamente</strong>.
        </div>
    </div>

    <div class="d-flex gap-2">
        <?= Html::submitButton(
            '<i class="fas fa-save me-1"></i> Salvar',
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            '<i class="fas fa-arrow-left me-1"></i> Voltar',
            ['index'],
            ['class' => 'btn btn-outline-secondary']
        ) ?>
    </div>

</form>
