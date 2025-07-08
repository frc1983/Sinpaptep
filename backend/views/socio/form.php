<?php
use yii\helpers\Html;

$this->title = $socio->isNewRecord ? 'Novo Sócio' : 'Editar Sócio';
$this->params['breadcrumbs'][] = ['label' => 'Sócios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($socio->hasErrors()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($socio->getFirstErrors() as $attr => $err): ?>
                <li><strong><?= $socio->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="post">
    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white"><b>Dados Pessoais</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="socio-nome">Nome</label>
                        <input type="text" class="form-control" id="socio-nome" name="Socio[Nome]" maxlength="255" value="<?= Html::encode($socio->Nome) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-cpf">CPF</label>
                        <input type="text" class="form-control" id="socio-cpf" name="Socio[CPF]" maxlength="11" value="<?= Html::encode($socio->CPF) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-data-nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" id="socio-data-nascimento" name="Socio[DataNascimento]" value="<?= Html::encode($socio->DataNascimento) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-cidade-nascimento">Cidade de Nascimento</label>
                        <input type="text" class="form-control" id="socio-cidade-nascimento" name="Socio[CidadeNascimento]" maxlength="255" value="<?= Html::encode($socio->CidadeNascimento) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-estado-civil">Estado Civil</label>
                        <input type="text" class="form-control" id="socio-estado-civil" name="Socio[EstadoCivil]" maxlength="255" value="<?= Html::encode($socio->EstadoCivil) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-nacionalidade">Nacionalidade</label>
                        <input type="text" class="form-control" id="socio-nacionalidade" name="Socio[Nacionalidade]" maxlength="255" value="<?= Html::encode($socio->Nacionalidade) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-identidade">Identidade</label>
                        <input type="text" class="form-control" id="socio-identidade" name="Socio[Identidade]" maxlength="255" value="<?= Html::encode($socio->Identidade) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-orgao-emissor">Órgão Emissor</label>
                        <input type="text" class="form-control" id="socio-orgao-emissor" name="Socio[OrgaoEmissor]" maxlength="255" value="<?= Html::encode($socio->OrgaoEmissor) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-titulo-eleitor">Título de Eleitor</label>
                        <input type="text" class="form-control" id="socio-titulo-eleitor" name="Socio[TituloEleitor]" maxlength="255" value="<?= Html::encode($socio->TituloEleitor) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-data-expiracao-titulo-eleitor">Data Expiração Título Eleitor</label>
                        <input type="date" class="form-control" id="socio-data-expiracao-titulo-eleitor" name="Socio[DataExpiracaoTituloEleitor]" value="<?= Html::encode($socio->DataExpiracaoTituloEleitor) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-uf-titulo-eleitor">UF Título Eleitor</label>
                        <input type="text" class="form-control" id="socio-uf-titulo-eleitor" name="Socio[UFTituloEleitor]" maxlength="255" value="<?= Html::encode($socio->UFTituloEleitor) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-nome-mae">Nome da Mãe</label>
                        <input type="text" class="form-control" id="socio-nome-mae" name="Socio[NomeMae]" maxlength="255" value="<?= Html::encode($socio->NomeMae) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-nome-pai">Nome do Pai</label>
                        <input type="text" class="form-control" id="socio-nome-pai" name="Socio[NomePai]" maxlength="255" value="<?= Html::encode($socio->NomePai) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-nome-conjuge">Nome do Cônjuge</label>
                        <input type="text" class="form-control" id="socio-nome-conjuge" name="Socio[NomeConjuge]" maxlength="255" value="<?= Html::encode($socio->NomeConjuge) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="socio-data-nascimento-conjuge">Data de Nascimento do Cônjuge</label>
                        <input type="date" class="form-control" id="socio-data-nascimento-conjuge" name="Socio[DataNascimentoConjuge]" value="<?= Html::encode($socio->DataNascimentoConjuge) ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white"><b>Dados da Empresa</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="empresa-nome">Nome da Empresa</label>
                        <input type="text" class="form-control" id="empresa-nome" name="Empresa[Nome]" maxlength="255" value="<?= Html::encode($empresa->Nome ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="empresa-logradouro" name="Empresa[Logradouro]" maxlength="255" value="<?= Html::encode($empresa->Logradouro ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-numero">Número</label>
                        <input type="text" class="form-control" id="empresa-numero" name="Empresa[Numero]" maxlength="255" value="<?= Html::encode($empresa->Numero ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-complemento">Complemento</label>
                        <input type="text" class="form-control" id="empresa-complemento" name="Empresa[Complemento]" maxlength="255" value="<?= Html::encode($empresa->Complemento ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-bairro">Bairro</label>
                        <input type="text" class="form-control" id="empresa-bairro" name="Empresa[Bairro]" maxlength="255" value="<?= Html::encode($empresa->Bairro ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-cidade">Cidade</label>
                        <input type="text" class="form-control" id="empresa-cidade" name="Empresa[Cidade]" maxlength="255" value="<?= Html::encode($empresa->Cidade ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-cep">CEP</label>
                        <input type="text" class="form-control" id="empresa-cep" name="Empresa[CEP]" maxlength="8" value="<?= Html::encode($empresa->CEP ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-uf">UF</label>
                        <input type="text" class="form-control" id="empresa-uf" name="Empresa[UF]" maxlength="255" value="<?= Html::encode($empresa->UF ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-telefone">Telefone</label>
                        <input type="text" class="form-control" id="empresa-telefone" name="Empresa[Telefone]" maxlength="14" value="<?= Html::encode($empresa->Telefone ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-celular">Celular</label>
                        <input type="text" class="form-control" id="empresa-celular" name="Empresa[Celular]" maxlength="15" value="<?= Html::encode($empresa->Celular ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-email">E-mail</label>
                        <input type="email" class="form-control" id="empresa-email" name="Empresa[Email]" maxlength="255" value="<?= Html::encode($empresa->Email ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-cargo-atual">Cargo Atual</label>
                        <input type="text" class="form-control" id="empresa-cargo-atual" name="Empresa[CargoAtual]" maxlength="255" value="<?= Html::encode($empresa->CargoAtual ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-data-inicio-cargo-atual">Data Início Cargo Atual</label>
                        <input type="date" class="form-control" id="empresa-data-inicio-cargo-atual" name="Empresa[DataInicioCargoAtual]" value="<?= Html::encode($empresa->DataInicioCargoAtual ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-numero-ctps">Número CTPS</label>
                        <input type="text" class="form-control" id="empresa-numero-ctps" name="Empresa[NumeroCTPS]" maxlength="255" value="<?= Html::encode($empresa->NumeroCTPS ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-serie-ctps">Série CTPS</label>
                        <input type="text" class="form-control" id="empresa-serie-ctps" name="Empresa[SerieCTPS]" maxlength="255" value="<?= Html::encode($empresa->SerieCTPS ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-numero-registro-autonomo">Nº Registro Autônomo</label>
                        <input type="text" class="form-control" id="empresa-numero-registro-autonomo" name="Empresa[NumeroRegistroAutonomo]" maxlength="255" value="<?= Html::encode($empresa->NumeroRegistroAutonomo ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-grau-instrucao">Grau de Instrução</label>
                        <input type="text" class="form-control" id="empresa-grau-instrucao" name="Empresa[GrauInstrucao]" maxlength="255" value="<?= Html::encode($empresa->GrauInstrucao ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-numero-registro-drte">Nº Registro DRTE</label>
                        <input type="text" class="form-control" id="empresa-numero-registro-drte" name="Empresa[NumeroRegistroDRTE]" maxlength="255" value="<?= Html::encode($empresa->NumeroRegistroDRTE ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="empresa-observacoes">Observações</label>
                        <input type="text" class="form-control" id="empresa-observacoes" name="Empresa[Observacoes]" maxlength="255" value="<?= Html::encode($empresa->Observacoes ?? '') ?>">
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-secondary text-white"><b>Endereço Residencial</b></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="endereco-logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="endereco-logradouro" name="Endereco[Logradouro]" maxlength="255" value="<?= Html::encode($endereco->Logradouro ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-numero">Número</label>
                        <input type="text" class="form-control" id="endereco-numero" name="Endereco[Numero]" maxlength="255" value="<?= Html::encode($endereco->Numero ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-complemento">Complemento</label>
                        <input type="text" class="form-control" id="endereco-complemento" name="Endereco[Complemento]" maxlength="255" value="<?= Html::encode($endereco->Complemento ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-bairro">Bairro</label>
                        <input type="text" class="form-control" id="endereco-bairro" name="Endereco[Bairro]" maxlength="255" value="<?= Html::encode($endereco->Bairro ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-cidade">Cidade</label>
                        <input type="text" class="form-control" id="endereco-cidade" name="Endereco[Cidade]" maxlength="255" value="<?= Html::encode($endereco->Cidade ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-cep">CEP</label>
                        <input type="text" class="form-control" id="endereco-cep" name="Endereco[CEP]" maxlength="8" value="<?= Html::encode($endereco->CEP ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-uf">UF</label>
                        <input type="text" class="form-control" id="endereco-uf" name="Endereco[UF]" maxlength="255" value="<?= Html::encode($endereco->UF ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-telefone">Telefone</label>
                        <input type="text" class="form-control" id="endereco-telefone" name="Endereco[Telefone]" maxlength="14" value="<?= Html::encode($endereco->Telefone ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-celular">Celular</label>
                        <input type="text" class="form-control" id="endereco-celular" name="Endereco[Celular]" maxlength="15" value="<?= Html::encode($endereco->Celular ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco-email">E-mail</label>
                        <input type="email" class="form-control" id="endereco-email" name="Endereco[Email]" maxlength="255" value="<?= Html::encode($endereco->Email ?? '') ?>">
                    </div>
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
                            <div class="mb-3">
                                <label for="filho-nome-<?= $i ?>">Nome do Filho</label>
                                <input type="text" class="form-control" id="filho-nome-<?= $i ?>" name="Filho[<?= $i ?>][Nome]" maxlength="255" value="<?= Html::encode($filho->Nome ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="filho-data-nascimento-<?= $i ?>">Data de Nascimento</label>
                                <input type="date" class="form-control" id="filho-data-nascimento-<?= $i ?>" name="Filho[<?= $i ?>][DataNascimento]" value="<?= Html::encode($filho->DataNascimento ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove-filho w-100" style="height:38px;" onclick="removeFilho(this)">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary mb-4" onclick="addFilho()">
                <i class="fas fa-plus"></i> Adicionar Filho
            </button>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Salvar
        </button>
    </div>
</form>
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
            <button type="button" class="btn btn-danger btn-remove-filho w-100" style="height:38px;" onclick="removeFilho(this)">
                <i class="fas fa-trash"></i> Remover
            </button>
        </div>
    </div>`;
    document.getElementById('filhos-list').insertAdjacentHTML('beforeend', html);
}
function removeFilho(btn) {
    var item = btn.closest('.filho-item');
    item.remove();
}
</script> 