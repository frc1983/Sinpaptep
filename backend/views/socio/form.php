<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Alert;

$this->title = $socio->isNewRecord ? 'Novo Sócio' : 'Editar Sócio';
$this->params['breadcrumbs'][] = ['label' => 'Sócios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socio-form">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <?= Alert::widget(['options' => ['class' => 'alert-' . $type], 'body' => $message]) ?>
    <?php endforeach; ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white"><b>Dados Pessoais</b></div>
                <div class="card-body">
                    <?= $form->field($socio, 'Nome')->textInput() ?>
                    <?= $form->field($socio, 'CPF')->textInput(['maxlength' => 11]) ?>
                    <?= $form->field($socio, 'DataNascimento')->input('date') ?>
                    <?= $form->field($socio, 'CidadeNascimento')->textInput() ?>
                    <?= $form->field($socio, 'EstadoCivil')->textInput() ?>
                    <?= $form->field($socio, 'Nacionalidade')->textInput() ?>
                    <?= $form->field($socio, 'Identidade')->textInput() ?>
                    <?= $form->field($socio, 'OrgaoEmissor')->textInput() ?>
                    <?= $form->field($socio, 'TituloEleitor')->textInput() ?>
                    <?= $form->field($socio, 'DataExpiracaoTituloEleitor')->input('date') ?>
                    <?= $form->field($socio, 'UFTituloEleitor')->textInput() ?>
                    <?= $form->field($socio, 'NomeMae')->textInput() ?>
                    <?= $form->field($socio, 'NomePai')->textInput() ?>
                    <?= $form->field($socio, 'NomeConjuge')->textInput() ?>
                    <?= $form->field($socio, 'DataNascimentoConjuge')->input('date') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white"><b>Dados da Empresa</b></div>
                <div class="card-body">
                    <?= $form->field($empresa, 'Nome')->textInput() ?>
                    <?= $form->field($empresa, 'Logradouro')->textInput() ?>
                    <?= $form->field($empresa, 'Numero')->textInput() ?>
                    <?= $form->field($empresa, 'Complemento')->textInput() ?>
                    <?= $form->field($empresa, 'Bairro')->textInput() ?>
                    <?= $form->field($empresa, 'Cidade')->textInput() ?>
                    <?= $form->field($empresa, 'CEP')->textInput(['maxlength' => 8]) ?>
                    <?= $form->field($empresa, 'UF')->textInput() ?>
                    <?= $form->field($empresa, 'Telefone')->textInput(['maxlength' => 14]) ?>
                    <?= $form->field($empresa, 'Celular')->textInput(['maxlength' => 15]) ?>
                    <?= $form->field($empresa, 'Email')->textInput() ?>
                    <?= $form->field($empresa, 'CargoAtual')->textInput() ?>
                    <?= $form->field($empresa, 'DataInicioCargoAtual')->input('date') ?>
                    <?= $form->field($empresa, 'NumeroCTPS')->textInput() ?>
                    <?= $form->field($empresa, 'SerieCTPS')->textInput() ?>
                    <?= $form->field($empresa, 'NumeroRegistroAutonomo')->textInput() ?>
                    <?= $form->field($empresa, 'GrauInstrucao')->dropDownList([
                        'Ensino Fundamental' => 'Ensino Fundamental (1º Grau)',
                        'Ensino Médio' => 'Ensino Médio (2º Grau)',
                        'Ensino Técnico' => 'Ensino Técnico',
                        'Superior' => 'Superior',
                        'Pós-graduação' => 'Pós-graduação',
                        'Mestrado' => 'Mestrado',
                        'Doutorado' => 'Doutorado',
                    ], ['prompt' => 'Selecione']) ?>
                    <?= $form->field($empresa, 'NumeroRegistroDRTE')->textInput() ?>
                    <?= $form->field($empresa, 'Observacoes')->textInput() ?>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-secondary text-white"><b>Endereço Residencial</b></div>
                <div class="card-body">
                    <?= $form->field($endereco, 'Logradouro')->textInput() ?>
                    <?= $form->field($endereco, 'Numero')->textInput() ?>
                    <?= $form->field($endereco, 'Complemento')->textInput() ?>
                    <?= $form->field($endereco, 'Bairro')->textInput() ?>
                    <?= $form->field($endereco, 'Cidade')->textInput() ?>
                    <?= $form->field($endereco, 'CEP')->textInput(['maxlength' => 8]) ?>
                    <?= $form->field($endereco, 'UF')->textInput() ?>
                    <?= $form->field($endereco, 'Telefone')->textInput(['maxlength' => 14]) ?>
                    <?= $form->field($endereco, 'Celular')->textInput(['maxlength' => 15]) ?>
                    <?= $form->field($endereco, 'Email')->textInput() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white"><b>Filhos</b></div>
        <div class="card-body">
            <div id="filhos-list">
                <?php foreach ($filhos as $i => $filho): ?>
                    <div class="row filho-item mb-2" data-index="<?= $i ?>">
                        <div class="col-md-6">
                            <?= $form->field($filho, "[$i]Nome")->textInput() ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($filho, "[$i]DataNascimento")->input('date') ?>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove-filho w-100" style="height:38px;" onclick="removeFilho(this)">Remover</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary mb-4" onclick="addFilho()">Adicionar Filho</button>
        </div>
    </div>
    <div class="form-group mt-4">
        <?= Html::submitButton($socio->isNewRecord ? 'Cadastrar Sócio' : 'Salvar Alterações', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
function addFilho() {
    var idx = document.querySelectorAll('.filho-item').length;
    var html = `<div class="row filho-item mb-2" data-index="${idx}">
        <div class="col-md-6">
            <div class="form-group field-sociofilho-${idx}-nome required">
                <label class="form-label" for="sociofilho-${idx}-nome">Nome do Filho</label>
                <input type="text" id="sociofilho-${idx}-nome" class="form-control" name="SocioFilho[${idx}][Nome]">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group field-sociofilho-${idx}-datanascimento required">
                <label class="form-label" for="sociofilho-${idx}-datanascimento">Data de Nascimento</label>
                <input type="date" id="sociofilho-${idx}-datanascimento" class="form-control" name="SocioFilho[${idx}][DataNascimento]">
            </div>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-remove-filho w-100" style="height:38px;" onclick="removeFilho(this)">Remover</button>
        </div>
    </div>`;
    document.getElementById('filhos-list').insertAdjacentHTML('beforeend', html);
}
function removeFilho(btn) {
    var item = btn.closest('.filho-item');
    item.remove();
}
</script> 