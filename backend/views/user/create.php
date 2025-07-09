<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Novo Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
        <b><i class="fas fa-user-plus me-2 icon-highlight"></i><?= Html::encode($this->title) ?></b>
    </div>
    <div class="card-body">
        <?php if (
            $model->hasErrors()
        ): ?>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user-username" class="form-label">Nome de Usuário *</label>
                        <input type="text" class="form-control" id="user-username" name="User[username]" maxlength="255" value="<?= Html::encode($model->username) ?>" required placeholder="Digite o nome de usuário">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user-email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" id="user-email" name="User[email]" maxlength="255" value="<?= Html::encode($model->email) ?>" required placeholder="Digite o e-mail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user-password" class="form-label">Senha *</label>
                        <input type="password" class="form-control" id="user-password" name="User[password]" maxlength="255" required placeholder="Crie uma senha (mínimo 8 caracteres)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user-status" class="form-label">Status *</label>
                        <select class="form-select" id="user-status" name="User[status]" required>
                            <option value="10" <?= $model->status == 10 ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= $model->status == 0 ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Salvar Usuário
                </button>
                <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </form>
    </div>
</div>
<style>
.icon-highlight {
  color: #fff !important;
  text-shadow: 0 2px 6px rgba(0,0,0,0.25), 0 0px 2px #157347;
  font-size: 1.3em;
  vertical-align: -2px;
}
</style> 