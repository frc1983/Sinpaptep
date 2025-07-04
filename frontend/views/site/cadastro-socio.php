<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Alert;

$this->title = 'Cadastro de Sócio';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="cadastro-socio-page">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-user-plus me-3" style="color: #20713a;"></i>Cadastro de Sócio
                </h1>
                <p class="lead text-muted">
                    Preencha o formulário para se associar ao SINPAPTEP-RS. Todos os campos marcados com * são obrigatórios.
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 bg-white">
                        <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
                            <?= Alert::widget(['options' => ['class' => 'alert-' . $type], 'body' => $message]) ?>
                        <?php endforeach; ?>
                        <?php if ($socio->hasErrors() || $empresa->hasErrors() || $endereco->hasErrors() || (isset($filhos) && is_array($filhos) && array_filter($filhos, function($f){return $f->hasErrors();}))) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($socio->getFirstErrors() as $attr => $err) : ?>
                                        <li><strong><?= $socio->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
                                    <?php endforeach; ?>
                                    <?php foreach ($empresa->getFirstErrors() as $attr => $err) : ?>
                                        <li><strong><?= $empresa->getAttributeLabel($attr) ?> (Empresa):</strong> <?= $err ?></li>
                                    <?php endforeach; ?>
                                    <?php foreach ($endereco->getFirstErrors() as $attr => $err) : ?>
                                        <li><strong><?= $endereco->getAttributeLabel($attr) ?> (Endereço):</strong> <?= $err ?></li>
                                    <?php endforeach; ?>
                                    <?php if (isset($filhos) && is_array($filhos)) : foreach ($filhos as $idx => $filho) :
                                        foreach ($filho->getFirstErrors() as $attr => $err) : ?>
                                            <li><strong>Filho <?= $idx+1 ?> - <?= $filho->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
                                        <?php endforeach; endforeach; endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'socio-form',
                            'options' => ['class' => 'socio-form']
                        ]); ?>
                        <h4 class="mt-4">Dados Pessoais</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($socio, 'Nome')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($socio, 'CPF')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($socio, 'DataNascimento')->input('date') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'CidadeNascimento')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'EstadoCivil')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'Nacionalidade')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'Identidade')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'OrgaoEmissor')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'TituloEleitor')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($socio, 'DataExpiracaoTituloEleitor')->input('date') ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($socio, 'UFTituloEleitor')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($socio, 'NomeMae')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($socio, 'NomePai')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($socio, 'NomeConjuge')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($socio, 'DataNascimentoConjuge')->input('date') ?>
                            </div>
                        </div>
                        <h4 class="mt-4">Dados da Empresa</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($empresa, 'Nome')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($empresa, 'Logradouro')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($empresa, 'Numero')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($empresa, 'Complemento')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'Bairro')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'Cidade')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($empresa, 'CEP')->textInput() ?>
                            </div>
                            <div class="col-md-1">
                                <?= $form->field($empresa, 'UF')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'Telefone')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'Celular')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'Email')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'CargoAtual')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'DataInicioCargoAtual')->input('date') ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'NumeroCTPS')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'SerieCTPS')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'NumeroRegistroAutonomo')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'GrauInstrucao')->dropDownList([
                                    'Ensino Fundamental' => 'Ensino Fundamental (1º Grau)',
                                    'Ensino Médio' => 'Ensino Médio (2º Grau)',
                                    'Ensino Técnico' => 'Ensino Técnico',
                                    'Superior' => 'Superior',
                                    'Pós-graduação' => 'Pós-graduação',
                                    'Mestrado' => 'Mestrado',
                                    'Doutorado' => 'Doutorado',
                                ], ['prompt' => 'Selecione']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($empresa, 'NumeroRegistroDRTE')->textInput() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($empresa, 'Observacoes')->textInput() ?>
                            </div>
                        </div>
                        <h4 class="mt-4">Endereço Residencial</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($endereco, 'Logradouro')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($endereco, 'Numero')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($endereco, 'Complemento')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($endereco, 'Bairro')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($endereco, 'Cidade')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($endereco, 'CEP')->textInput() ?>
                            </div>
                            <div class="col-md-1">
                                <?= $form->field($endereco, 'UF')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($endereco, 'Telefone')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($endereco, 'Celular')->textInput() ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($endereco, 'Email')->textInput() ?>
                            </div>
                        </div>
                        <h4 class="mt-4">Filhos</h4>
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
                        <div class="form-group mt-4">
                            <?= Html::submitButton('Cadastrar Sócio', ['class' => 'btn btn-success btn-lg']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    aplicarMascaraCep();
    aplicarMascaraTelefoneCelular();
}
function removeFilho(btn) {
    var item = btn.closest('.filho-item');
    item.remove();
}

function aplicarMascaraCep() {
    const ceps = document.querySelectorAll('input[name$="[CEP]"], input[name="SocioDadosEmpresa[CEP]"], input[name="SocioEndereco[CEP]"]');
    ceps.forEach(function(input) {
        input.setAttribute('maxlength', '8');
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0,8);
        });
    });
}

function aplicarMascaraTelefoneCelular() {
    // Telefone: (99) 9999-9999
    const tels = document.querySelectorAll('input[name$="[Telefone]"], input[name="SocioDadosEmpresa[Telefone]"], input[name="SocioEndereco[Telefone]"]');
    tels.forEach(function(input) {
        input.setAttribute('maxlength', '14');
        input.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 10) v = v.slice(0,10);
            if (v.length > 6) v = '(' + v.slice(0,2) + ') ' + v.slice(2,6) + '-' + v.slice(6,10);
            else if (v.length > 2) v = '(' + v.slice(0,2) + ') ' + v.slice(2);
            else if (v.length > 0) v = '(' + v;
            e.target.value = v;
        });
    });
    // Celular: (99) 99999-9999
    const cels = document.querySelectorAll('input[name$="[Celular]"], input[name="SocioDadosEmpresa[Celular]"], input[name="SocioEndereco[Celular]"]');
    cels.forEach(function(input) {
        input.setAttribute('maxlength', '15');
        input.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 11) v = v.slice(0,11);
            if (v.length > 7) v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7,11);
            else if (v.length > 2) v = '(' + v.slice(0,2) + ') ' + v.slice(2);
            else if (v.length > 0) v = '(' + v;
            e.target.value = v;
        });
    });
}

function validarDatasFuturas(e) {
    const hoje = new Date();
    hoje.setHours(0,0,0,0);
    const campos = document.querySelectorAll('input[type="date"]');
    let valido = true;
    campos.forEach(function(input) {
        if (input.name && input.name.indexOf('[DataExpiracaoTituloEleitor]') !== -1) {
            input.classList.remove('is-invalid');
            return;
        }
        if (input.value) {
            const valor = new Date(input.value);
            if (valor >= hoje) {
                input.classList.add('is-invalid');
                valido = false;
            } else {
                input.classList.remove('is-invalid');
            }
        }
    });
    if (!valido) {
        alert('As datas não podem ser iguais ou superiores à data atual.');
        e.preventDefault();
        return false;
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    aplicarMascaraCep();
    aplicarMascaraTelefoneCelular();
    // Limitar CPF a 11 dígitos
    var cpfInput = document.querySelector('input[name="Socio[CPF]"]');
    if (cpfInput) {
        cpfInput.setAttribute('maxlength', '11');
        cpfInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0,11);
        });
    }
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', validarDatasFuturas);
    }
});
</script> 