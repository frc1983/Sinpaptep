<?php
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
                        <form id="socio-form" method="post" class="socio-form" action="<?= \yii\helpers\Url::to(['site/cadastro-socio']) ?>">
                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <h4 class="mt-4">Dados Pessoais</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="socio-nome">Nome*</label>
                                    <input type="text" class="form-control" id="socio-nome" name="Socio[Nome]" value="<?= Html::encode($socio->Nome) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-cpf">CPF*</label>
                                    <input type="text" class="form-control" id="socio-cpf" name="Socio[CPF]" value="<?= Html::encode($socio->CPF) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-datanascimento">Data de Nascimento*</label>
                                    <input type="date" class="form-control" id="socio-datanascimento" name="Socio[DataNascimento]" value="<?= Html::encode($socio->DataNascimento) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-cidadenascimento">Cidade de Nascimento</label>
                                    <input type="text" class="form-control" id="socio-cidadenascimento" name="Socio[CidadeNascimento]" value="<?= Html::encode($socio->CidadeNascimento) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-estadocivil">Estado Civil</label>
                                    <input type="text" class="form-control" id="socio-estadocivil" name="Socio[EstadoCivil]" value="<?= Html::encode($socio->EstadoCivil) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-nacionalidade">Nacionalidade</label>
                                    <input type="text" class="form-control" id="socio-nacionalidade" name="Socio[Nacionalidade]" value="<?= Html::encode($socio->Nacionalidade) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-identidade">Identidade</label>
                                    <input type="text" class="form-control" id="socio-identidade" name="Socio[Identidade]" value="<?= Html::encode($socio->Identidade) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-orgaoemissor">Órgão Emissor</label>
                                    <input type="text" class="form-control" id="socio-orgaoemissor" name="Socio[OrgaoEmissor]" value="<?= Html::encode($socio->OrgaoEmissor) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-tituloeleitor">Título de Eleitor</label>
                                    <input type="text" class="form-control" id="socio-tituloeleitor" name="Socio[TituloEleitor]" value="<?= Html::encode($socio->TituloEleitor) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-dataexpiracaotituloeleitor">Data Expiração Título Eleitor</label>
                                    <input type="date" class="form-control" id="socio-dataexpiracaotituloeleitor" name="Socio[DataExpiracaoTituloEleitor]" value="<?= Html::encode($socio->DataExpiracaoTituloEleitor) ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="socio-uftituloeleitor">UF Título Eleitor</label>
                                    <input type="text" class="form-control" id="socio-uftituloeleitor" name="Socio[UFTituloEleitor]" value="<?= Html::encode($socio->UFTituloEleitor) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="socio-nomemae">Nome da Mãe</label>
                                    <input type="text" class="form-control" id="socio-nomemae" name="Socio[NomeMae]" value="<?= Html::encode($socio->NomeMae) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="socio-nomepai">Nome do Pai</label>
                                    <input type="text" class="form-control" id="socio-nomepai" name="Socio[NomePai]" value="<?= Html::encode($socio->NomePai) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="socio-nomeconjuge">Nome do Cônjuge</label>
                                    <input type="text" class="form-control" id="socio-nomeconjuge" name="Socio[NomeConjuge]" value="<?= Html::encode($socio->NomeConjuge) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-datanascimentoconjuge">Data Nascimento Cônjuge</label>
                                    <input type="date" class="form-control" id="socio-datanascimentoconjuge" name="Socio[DataNascimentoConjuge]" value="<?= Html::encode($socio->DataNascimentoConjuge) ?>">
                                </div>
                            </div>
                            <h4 class="mt-4">Dados da Empresa</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="socio-empresa-nome">Nome*</label>
                                    <input type="text" class="form-control" id="socio-empresa-nome" name="SocioDadosEmpresa[Nome]" value="<?= Html::encode($empresa->Nome) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="socio-empresa-logradouro">Logradouro*</label>
                                    <input type="text" class="form-control" id="socio-empresa-logradouro" name="SocioDadosEmpresa[Logradouro]" value="<?= Html::encode($empresa->Logradouro) ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="socio-empresa-numero">Número*</label>
                                    <input type="text" class="form-control" id="socio-empresa-numero" name="SocioDadosEmpresa[Numero]" value="<?= Html::encode($empresa->Numero) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-empresa-complemento">Complemento</label>
                                    <input type="text" class="form-control" id="socio-empresa-complemento" name="SocioDadosEmpresa[Complemento]" value="<?= Html::encode($empresa->Complemento) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-bairro">Bairro*</label>
                                    <input type="text" class="form-control" id="socio-empresa-bairro" name="SocioDadosEmpresa[Bairro]" value="<?= Html::encode($empresa->Bairro) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-cidade">Cidade*</label>
                                    <input type="text" class="form-control" id="socio-empresa-cidade" name="SocioDadosEmpresa[Cidade]" value="<?= Html::encode($empresa->Cidade) ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="socio-empresa-cep">CEP*</label>
                                    <input type="text" class="form-control" id="socio-empresa-cep" name="SocioDadosEmpresa[CEP]" value="<?= Html::encode($empresa->CEP) ?>">
                                </div>
                                <div class="col-md-1">
                                    <label for="socio-empresa-uf">UF*</label>
                                    <input type="text" class="form-control" id="socio-empresa-uf" name="SocioDadosEmpresa[UF]" value="<?= Html::encode($empresa->UF) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-telefone">Telefone*</label>
                                    <input type="text" class="form-control" id="socio-empresa-telefone" name="SocioDadosEmpresa[Telefone]" value="<?= Html::encode($empresa->Telefone) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-celular">Celular*</label>
                                    <input type="text" class="form-control" id="socio-empresa-celular" name="SocioDadosEmpresa[Celular]" value="<?= Html::encode($empresa->Celular) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-email">Email*</label>
                                    <input type="text" class="form-control" id="socio-empresa-email" name="SocioDadosEmpresa[Email]" value="<?= Html::encode($empresa->Email) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-cargoatual">Cargo Atual*</label>
                                    <input type="text" class="form-control" id="socio-empresa-cargoatual" name="SocioDadosEmpresa[CargoAtual]" value="<?= Html::encode($empresa->CargoAtual) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-datainiciocargoatual">Data Início Cargo Atual*</label>
                                    <input type="date" class="form-control" id="socio-empresa-datainiciocargoatual" name="SocioDadosEmpresa[DataInicioCargoAtual]" value="<?= Html::encode($empresa->DataInicioCargoAtual) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-numeroctps">Número CTPS*</label>
                                    <input type="text" class="form-control" id="socio-empresa-numeroctps" name="SocioDadosEmpresa[NumeroCTPS]" value="<?= Html::encode($empresa->NumeroCTPS) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-seriectps">Série CTPS*</label>
                                    <input type="text" class="form-control" id="socio-empresa-seriectps" name="SocioDadosEmpresa[SerieCTPS]" value="<?= Html::encode($empresa->SerieCTPS) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-numeroregistroautonomo">Número Registro Autônomo*</label>
                                    <input type="text" class="form-control" id="socio-empresa-numeroregistroautonomo" name="SocioDadosEmpresa[NumeroRegistroAutonomo]" value="<?= Html::encode($empresa->NumeroRegistroAutonomo) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-grauinstrucao">Grau de Instrução*</label>
                                    <select class="form-select" id="socio-empresa-grauinstrucao" name="SocioDadosEmpresa[GrauInstrucao]">
                                        <option value="" disabled selected>Selecione</option>
                                        <option value="Ensino Fundamental" <?= Html::encode($empresa->GrauInstrucao) === 'Ensino Fundamental' ? 'selected' : '' ?>>Ensino Fundamental (1º Grau)</option>
                                        <option value="Ensino Médio" <?= Html::encode($empresa->GrauInstrucao) === 'Ensino Médio' ? 'selected' : '' ?>>Ensino Médio (2º Grau)</option>
                                        <option value="Ensino Técnico" <?= Html::encode($empresa->GrauInstrucao) === 'Ensino Técnico' ? 'selected' : '' ?>>Ensino Técnico</option>
                                        <option value="Superior" <?= Html::encode($empresa->GrauInstrucao) === 'Superior' ? 'selected' : '' ?>>Superior</option>
                                        <option value="Pós-graduação" <?= Html::encode($empresa->GrauInstrucao) === 'Pós-graduação' ? 'selected' : '' ?>>Pós-graduação</option>
                                        <option value="Mestrado" <?= Html::encode($empresa->GrauInstrucao) === 'Mestrado' ? 'selected' : '' ?>>Mestrado</option>
                                        <option value="Doutorado" <?= Html::encode($empresa->GrauInstrucao) === 'Doutorado' ? 'selected' : '' ?>>Doutorado</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-empresa-numeroregistrodrte">Número Registro DRTE*</label>
                                    <input type="text" class="form-control" id="socio-empresa-numeroregistrodrte" name="SocioDadosEmpresa[NumeroRegistroDRTE]" value="<?= Html::encode($empresa->NumeroRegistroDRTE) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="socio-empresa-observacoes">Observações</label>
                                    <textarea class="form-control" id="socio-empresa-observacoes" name="SocioDadosEmpresa[Observacoes]" rows="3"><?= Html::encode($empresa->Observacoes) ?></textarea>
                                </div>
                            </div>
                            <h4 class="mt-4">Endereço Residencial</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="socio-endereco-logradouro">Logradouro*</label>
                                    <input type="text" class="form-control" id="socio-endereco-logradouro" name="SocioEndereco[Logradouro]" value="<?= Html::encode($endereco->Logradouro) ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="socio-endereco-numero">Número*</label>
                                    <input type="text" class="form-control" id="socio-endereco-numero" name="SocioEndereco[Numero]" value="<?= Html::encode($endereco->Numero) ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="socio-endereco-complemento">Complemento</label>
                                    <input type="text" class="form-control" id="socio-endereco-complemento" name="SocioEndereco[Complemento]" value="<?= Html::encode($endereco->Complemento) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-endereco-bairro">Bairro*</label>
                                    <input type="text" class="form-control" id="socio-endereco-bairro" name="SocioEndereco[Bairro]" value="<?= Html::encode($endereco->Bairro) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-endereco-cidade">Cidade*</label>
                                    <input type="text" class="form-control" id="socio-endereco-cidade" name="SocioEndereco[Cidade]" value="<?= Html::encode($endereco->Cidade) ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="socio-endereco-cep">CEP*</label>
                                    <input type="text" class="form-control" id="socio-endereco-cep" name="SocioEndereco[CEP]" value="<?= Html::encode($endereco->CEP) ?>">
                                </div>
                                <div class="col-md-1">
                                    <label for="socio-endereco-uf">UF*</label>
                                    <input type="text" class="form-control" id="socio-endereco-uf" name="SocioEndereco[UF]" value="<?= Html::encode($endereco->UF) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-endereco-telefone">Telefone*</label>
                                    <input type="text" class="form-control" id="socio-endereco-telefone" name="SocioEndereco[Telefone]" value="<?= Html::encode($endereco->Telefone) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-endereco-celular">Celular*</label>
                                    <input type="text" class="form-control" id="socio-endereco-celular" name="SocioEndereco[Celular]" value="<?= Html::encode($endereco->Celular) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="socio-endereco-email">Email*</label>
                                    <input type="text" class="form-control" id="socio-endereco-email" name="SocioEndereco[Email]" value="<?= Html::encode($endereco->Email) ?>">
                                </div>
                            </div>
                            <h4 class="mt-4">Filhos</h4>
                            <div id="filhos-list">
                                <?php foreach ($filhos as $i => $filho): ?>
                                    <div class="row filho-item mb-2" data-index="<?= $i ?>">
                                        <div class="col-md-6">
                                            <label for="socio-filho-<?= $i ?>-nome">Nome do Filho*</label>
                                            <input type="text" class="form-control" id="socio-filho-<?= $i ?>-nome" name="SocioFilho[<?= $i ?>][Nome]" value="<?= Html::encode($filho->Nome) ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="socio-filho-<?= $i ?>-datanascimento">Data de Nascimento*</label>
                                            <input type="date" class="form-control" id="socio-filho-<?= $i ?>-datanascimento" name="SocioFilho[<?= $i ?>][DataNascimento]" value="<?= Html::encode($filho->DataNascimento) ?>">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-remove-filho w-100" style="height:38px;" onclick="removeFilho(this)">Remover</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-secondary mb-4" onclick="addFilho()">Adicionar Filho</button>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Enviar Cadastro</button>
                            </div>
                        </form>
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