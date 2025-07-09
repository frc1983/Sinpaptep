<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Boleto $model */

$this->title = 'Editar Boleto #' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Boletos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Boleto #' . $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="boleto-update">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
            <b><i class="fas fa-edit me-2 icon-highlight"></i><?= Html::encode($this->title) ?></b>
        </div>
        <div class="card-body">
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
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="boleto-nome" class="form-label">Nome *</label>
                            <input type="text" class="form-control" id="boleto-nome" name="Boleto[Nome]" maxlength="255" value="<?= Html::encode($model->Nome) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="boleto-cnpj" class="form-label">CNPJ *</label>
                            <input type="text" class="form-control cnpj" id="boleto-cnpj" name="Boleto[CNPJ]" maxlength="18" value="<?= Html::encode($model->CNPJ) ?>" required>
                            <div class="form-text">Digite apenas os números do CNPJ</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="boleto-endereco" class="form-label">Endereço *</label>
                            <input type="text" class="form-control" id="boleto-endereco" name="Boleto[Endereco]" maxlength="255" value="<?= Html::encode($model->Endereco) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-cep" class="form-label">CEP *</label>
                            <input type="text" class="form-control cep" id="boleto-cep" name="Boleto[CEP]" maxlength="9" value="<?= Html::encode($model->CEP) ?>" required>
                            <div class="form-text">Digite apenas os números do CEP</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-cidade" class="form-label">Cidade *</label>
                            <input type="text" class="form-control" id="boleto-cidade" name="Boleto[Cidade]" maxlength="255" value="<?= Html::encode($model->Cidade) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-valor" class="form-label">Valor *</label>
                            <input type="text" class="form-control money" id="boleto-valor" name="Boleto[Valor]" value="<?= Html::encode(number_format($model->Valor, 2, ',', '.')) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-multa" class="form-label">Multa</label>
                            <input type="text" class="form-control money" id="boleto-multa" name="Boleto[Multa]" value="<?= Html::encode($model->Multa !== null ? number_format($model->Multa, 2, ',', '.') : '') ?>">
                            <div class="form-text">Opcional</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-despesa-bancaria" class="form-label">Despesa Bancária *</label>
                            <input type="text" class="form-control money" id="boleto-despesa-bancaria" name="Boleto[DespesaBancaria]" value="<?= Html::encode(number_format($model->DespesaBancaria, 2, ',', '.')) ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-data-vencimento" class="form-label">Data de Vencimento *</label>
                            <input type="date" class="form-control" id="boleto-data-vencimento" name="Boleto[DataVencimento]" value="<?= $model->DataVencimento ? date('Y-m-d', strtotime($model->DataVencimento)) : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="boleto-data-geracao" class="form-label">Data de Geração *</label>
                            <input type="date" class="form-control" id="boleto-data-geracao" name="Boleto[DataGeracaoBoleto]" value="<?= $model->DataGeracaoBoleto ? date('Y-m-d', strtotime($model->DataGeracaoBoleto)) : '' ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Atualizar Boleto
                    </button>
                    <?= Html::a('<i class="fas fa-eye"></i> Visualizar', ['view', 'id' => $model->Id], ['class' => 'btn btn-info']) ?>
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.icon-highlight {
    color: #fff !important;
    text-shadow: 0 2px 6px rgba(0,0,0,0.25), 0 0px 2px #157347;
    font-size: 1.3em;
    vertical-align: -2px;
}

.form-control:focus {
    border-color: #20713a;
    box-shadow: 0 0 0 0.2rem rgba(32, 113, 58, 0.25);
}
</style> 

<script>
// Máscara monetária simples para campos com classe .money
function setMoneyMask(input) {
    input.addEventListener('input', function(e) {
        let v = this.value.replace(/\D/g, '');
        v = (v/100).toFixed(2) + '';
        v = v.replace('.', ',');
        v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        this.value = v;
    });
}
document.querySelectorAll('.money').forEach(setMoneyMask);

// Máscara para CEP: 00000-000
function setCepMask(input) {
    input.addEventListener('input', function(e) {
        let v = this.value.replace(/\D/g, '');
        if (v.length > 5) v = v.slice(0,5) + '-' + v.slice(5,8);
        this.value = v.slice(0,9);
    });
}
document.querySelectorAll('.cep').forEach(setCepMask);

// Máscara para CNPJ: 00.000.000/0000-00
function setCnpjMask(input) {
    input.addEventListener('input', function(e) {
        let v = this.value.replace(/\D/g, '');
        v = v.slice(0,14);
        if (v.length > 12) v = v.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        else if (v.length > 8) v = v.replace(/(\d{2})(\d{3})(\d{3})(\d{0,4})/, '$1.$2.$3/$4');
        else if (v.length > 5) v = v.replace(/(\d{2})(\d{3})(\d{0,3})/, '$1.$2.$3');
        else if (v.length > 2) v = v.replace(/(\d{2})(\d{0,3})/, '$1.$2');
        this.value = v;
    });
}
document.querySelectorAll('.cnpj').forEach(setCnpjMask);
</script> 