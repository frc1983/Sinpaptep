<?php
use yii\bootstrap5\Html;

$this->title = $socio->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Sócios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

function formatDateBr($date) {
    if (!$date || $date == '0000-00-00') return '';
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d ? $d->format('d/m/Y') : $date;
}
?>
<div class="socio-view">
    <p>
        <div class="btn-group" role="group">
            <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'id' => $socio->Id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'id' => $socio->Id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza que deseja excluir este sócio?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<i class="fas fa-print"></i> Imprimir', ['imprimir', 'id' => $socio->Id], [
                'class' => 'btn btn-success',
                'target' => '_blank',
                'title' => 'Imprimir ficha do sócio',
            ]) ?>
            <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </p>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white"><b>Dados Pessoais</b></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Nome</dt><dd class="col-sm-7"><?= Html::encode($socio->Nome) ?></dd>
                        <dt class="col-sm-5">CPF</dt><dd class="col-sm-7"><?= Html::encode($socio->CPF) ?></dd>
                        <dt class="col-sm-5">Data de Nascimento</dt><dd class="col-sm-7"><?= Html::encode(formatDateBr($socio->DataNascimento)) ?></dd>
                        <dt class="col-sm-5">Cidade de Nascimento</dt><dd class="col-sm-7"><?= Html::encode($socio->CidadeNascimento) ?></dd>
                        <dt class="col-sm-5">Estado Civil</dt><dd class="col-sm-7"><?= Html::encode($socio->EstadoCivil) ?></dd>
                        <dt class="col-sm-5">Nacionalidade</dt><dd class="col-sm-7"><?= Html::encode($socio->Nacionalidade) ?></dd>
                        <dt class="col-sm-5">Identidade</dt><dd class="col-sm-7"><?= Html::encode($socio->Identidade) ?></dd>
                        <dt class="col-sm-5">Órgão Emissor</dt><dd class="col-sm-7"><?= Html::encode($socio->OrgaoEmissor) ?></dd>
                        <dt class="col-sm-5">Título de Eleitor</dt><dd class="col-sm-7"><?= Html::encode($socio->TituloEleitor) ?></dd>
                        <dt class="col-sm-5">Data Expiração Título Eleitor</dt><dd class="col-sm-7"><?= Html::encode(formatDateBr($socio->DataExpiracaoTituloEleitor)) ?></dd>
                        <dt class="col-sm-5">UF Título Eleitor</dt><dd class="col-sm-7"><?= Html::encode($socio->UFTituloEleitor) ?></dd>
                        <dt class="col-sm-5">Nome da Mãe</dt><dd class="col-sm-7"><?= Html::encode($socio->NomeMae) ?></dd>
                        <dt class="col-sm-5">Nome do Pai</dt><dd class="col-sm-7"><?= Html::encode($socio->NomePai) ?></dd>
                        <dt class="col-sm-5">Nome do Cônjuge</dt><dd class="col-sm-7"><?= Html::encode($socio->NomeConjuge) ?></dd>
                        <dt class="col-sm-5">Data de Nascimento do Cônjuge</dt><dd class="col-sm-7"><?= Html::encode(formatDateBr($socio->DataNascimentoConjuge)) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white"><b>Dados da Empresa</b></div>
                <div class="card-body">
                    <?php if ($empresa): ?>
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Nome</dt><dd class="col-sm-7"><?= Html::encode($empresa->Nome) ?></dd>
                        <dt class="col-sm-5">Logradouro</dt><dd class="col-sm-7"><?= Html::encode($empresa->Logradouro) ?></dd>
                        <dt class="col-sm-5">Número</dt><dd class="col-sm-7"><?= Html::encode($empresa->Numero) ?></dd>
                        <dt class="col-sm-5">Complemento</dt><dd class="col-sm-7"><?= Html::encode($empresa->Complemento) ?></dd>
                        <dt class="col-sm-5">Bairro</dt><dd class="col-sm-7"><?= Html::encode($empresa->Bairro) ?></dd>
                        <dt class="col-sm-5">Cidade</dt><dd class="col-sm-7"><?= Html::encode($empresa->Cidade) ?></dd>
                        <dt class="col-sm-5">CEP</dt><dd class="col-sm-7"><?= Html::encode($empresa->CEP) ?></dd>
                        <dt class="col-sm-5">UF</dt><dd class="col-sm-7"><?= Html::encode($empresa->UF) ?></dd>
                        <dt class="col-sm-5">Telefone</dt><dd class="col-sm-7"><?= Html::encode($empresa->Telefone) ?></dd>
                        <dt class="col-sm-5">Celular</dt><dd class="col-sm-7"><?= Html::encode($empresa->Celular) ?></dd>
                        <dt class="col-sm-5">E-mail</dt><dd class="col-sm-7"><?= Html::encode($empresa->Email) ?></dd>
                        <dt class="col-sm-5">Cargo Atual</dt><dd class="col-sm-7"><?= Html::encode($empresa->CargoAtual) ?></dd>
                        <dt class="col-sm-5">Data Início Cargo Atual</dt><dd class="col-sm-7"><?= Html::encode(formatDateBr($empresa->DataInicioCargoAtual)) ?></dd>
                        <dt class="col-sm-5">Número CTPS</dt><dd class="col-sm-7"><?= Html::encode($empresa->NumeroCTPS) ?></dd>
                        <dt class="col-sm-5">Série CTPS</dt><dd class="col-sm-7"><?= Html::encode($empresa->SerieCTPS) ?></dd>
                        <dt class="col-sm-5">Nº Registro Autônomo</dt><dd class="col-sm-7"><?= Html::encode($empresa->NumeroRegistroAutonomo) ?></dd>
                        <dt class="col-sm-5">Grau de Instrução</dt><dd class="col-sm-7"><?= Html::encode($empresa->GrauInstrucao) ?></dd>
                        <dt class="col-sm-5">Nº Registro DRTE</dt><dd class="col-sm-7"><?= Html::encode($empresa->NumeroRegistroDRTE) ?></dd>
                        <dt class="col-sm-5">Observações</dt><dd class="col-sm-7"><?= Html::encode($empresa->Observacoes) ?></dd>
                    </dl>
                    <?php else: ?>
                        <p class="text-muted">Sem dados de empresa cadastrados.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-secondary text-white"><b>Endereço Residencial</b></div>
                <div class="card-body">
                    <?php if ($endereco): ?>
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Logradouro</dt><dd class="col-sm-7"><?= Html::encode($endereco->Logradouro) ?></dd>
                        <dt class="col-sm-5">Número</dt><dd class="col-sm-7"><?= Html::encode($endereco->Numero) ?></dd>
                        <dt class="col-sm-5">Complemento</dt><dd class="col-sm-7"><?= Html::encode($endereco->Complemento) ?></dd>
                        <dt class="col-sm-5">Bairro</dt><dd class="col-sm-7"><?= Html::encode($endereco->Bairro) ?></dd>
                        <dt class="col-sm-5">Cidade</dt><dd class="col-sm-7"><?= Html::encode($endereco->Cidade) ?></dd>
                        <dt class="col-sm-5">CEP</dt><dd class="col-sm-7"><?= Html::encode($endereco->CEP) ?></dd>
                        <dt class="col-sm-5">UF</dt><dd class="col-sm-7"><?= Html::encode($endereco->UF) ?></dd>
                        <dt class="col-sm-5">Telefone</dt><dd class="col-sm-7"><?= Html::encode($endereco->Telefone) ?></dd>
                        <dt class="col-sm-5">Celular</dt><dd class="col-sm-7"><?= Html::encode($endereco->Celular) ?></dd>
                        <dt class="col-sm-5">E-mail</dt><dd class="col-sm-7"><?= Html::encode($endereco->Email) ?></dd>
                    </dl>
                    <?php else: ?>
                        <p class="text-muted">Sem endereço cadastrado.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white"><b>Filhos</b></div>
        <div class="card-body">
            <?php if ($filhos && count($filhos) > 0): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($filhos as $filho): ?>
                        <li class="list-group-item">
                            <b>Nome:</b> <?= Html::encode($filho->Nome) ?> <br>
                            <b>Data de Nascimento:</b> <?= Html::encode(formatDateBr($filho->DataNascimento)) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">Nenhum filho cadastrado.</p>
            <?php endif; ?>
        </div>
    </div>
</div> 