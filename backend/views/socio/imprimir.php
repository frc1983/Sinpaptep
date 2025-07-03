<?php
function formatDateBr($date) {
    if (!$date || $date == '0000-00-00') return '';
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d ? $d->format('d/m/Y') : $date;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Ficha do Sócio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #222; }
        h1, h2 { text-align: center; }
        .section { margin-bottom: 30px; }
        .section-title { background: #20713a; color: #fff; padding: 8px 12px; font-size: 1.1em; margin-bottom: 10px; }
        dl { display: flex; flex-wrap: wrap; }
        dt { width: 220px; font-weight: bold; }
        dd { width: calc(100% - 220px); margin: 0 0 8px 0; }
        ul { margin: 0; padding: 0 0 0 20px; }
        .filhos-list li { margin-bottom: 6px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:right; margin-bottom:10px;">
        <button onclick="window.print()" style="padding:8px 18px; font-size:1em;">Imprimir</button>
    </div>
    <h1>Ficha de Sócio</h1>
    <div class="section">
        <div class="section-title">Dados Pessoais</div>
        <dl>
            <dt>Nome</dt><dd><?= htmlspecialchars($socio->Nome) ?></dd>
            <dt>CPF</dt><dd><?= htmlspecialchars($socio->CPF) ?></dd>
            <dt>Data de Nascimento</dt><dd><?= htmlspecialchars(formatDateBr($socio->DataNascimento)) ?></dd>
            <dt>Cidade de Nascimento</dt><dd><?= htmlspecialchars($socio->CidadeNascimento) ?></dd>
            <dt>Estado Civil</dt><dd><?= htmlspecialchars($socio->EstadoCivil) ?></dd>
            <dt>Nacionalidade</dt><dd><?= htmlspecialchars($socio->Nacionalidade) ?></dd>
            <dt>Identidade</dt><dd><?= htmlspecialchars($socio->Identidade) ?></dd>
            <dt>Órgão Emissor</dt><dd><?= htmlspecialchars($socio->OrgaoEmissor) ?></dd>
            <dt>Título de Eleitor</dt><dd><?= htmlspecialchars($socio->TituloEleitor) ?></dd>
            <dt>Data Expiração Título Eleitor</dt><dd><?= htmlspecialchars(formatDateBr($socio->DataExpiracaoTituloEleitor)) ?></dd>
            <dt>UF Título Eleitor</dt><dd><?= htmlspecialchars($socio->UFTituloEleitor) ?></dd>
            <dt>Nome da Mãe</dt><dd><?= htmlspecialchars($socio->NomeMae) ?></dd>
            <dt>Nome do Pai</dt><dd><?= htmlspecialchars($socio->NomePai) ?></dd>
            <dt>Nome do Cônjuge</dt><dd><?= htmlspecialchars($socio->NomeConjuge) ?></dd>
            <dt>Data de Nascimento do Cônjuge</dt><dd><?= htmlspecialchars(formatDateBr($socio->DataNascimentoConjuge)) ?></dd>
        </dl>
    </div>
    <div class="section">
        <div class="section-title">Dados da Empresa</div>
        <?php if ($empresa): ?>
        <dl>
            <dt>Nome</dt><dd><?= htmlspecialchars($empresa->Nome) ?></dd>
            <dt>Logradouro</dt><dd><?= htmlspecialchars($empresa->Logradouro) ?></dd>
            <dt>Número</dt><dd><?= htmlspecialchars($empresa->Numero) ?></dd>
            <dt>Complemento</dt><dd><?= htmlspecialchars($empresa->Complemento) ?></dd>
            <dt>Bairro</dt><dd><?= htmlspecialchars($empresa->Bairro) ?></dd>
            <dt>Cidade</dt><dd><?= htmlspecialchars($empresa->Cidade) ?></dd>
            <dt>CEP</dt><dd><?= htmlspecialchars($empresa->CEP) ?></dd>
            <dt>UF</dt><dd><?= htmlspecialchars($empresa->UF) ?></dd>
            <dt>Telefone</dt><dd><?= htmlspecialchars($empresa->Telefone) ?></dd>
            <dt>Celular</dt><dd><?= htmlspecialchars($empresa->Celular) ?></dd>
            <dt>E-mail</dt><dd><?= htmlspecialchars($empresa->Email) ?></dd>
            <dt>Cargo Atual</dt><dd><?= htmlspecialchars($empresa->CargoAtual) ?></dd>
            <dt>Data Início Cargo Atual</dt><dd><?= htmlspecialchars(formatDateBr($empresa->DataInicioCargoAtual)) ?></dd>
            <dt>Número CTPS</dt><dd><?= htmlspecialchars($empresa->NumeroCTPS) ?></dd>
            <dt>Série CTPS</dt><dd><?= htmlspecialchars($empresa->SerieCTPS) ?></dd>
            <dt>Nº Registro Autônomo</dt><dd><?= htmlspecialchars($empresa->NumeroRegistroAutonomo) ?></dd>
            <dt>Grau de Instrução</dt><dd><?= htmlspecialchars($empresa->GrauInstrucao) ?></dd>
            <dt>Nº Registro DRTE</dt><dd><?= htmlspecialchars($empresa->NumeroRegistroDRTE) ?></dd>
            <dt>Observações</dt><dd><?= htmlspecialchars($empresa->Observacoes) ?></dd>
        </dl>
        <?php else: ?>
        <p class="text-muted">Sem dados de empresa cadastrados.</p>
        <?php endif; ?>
    </div>
    <div class="section">
        <div class="section-title">Endereço Residencial</div>
        <?php if ($endereco): ?>
        <dl>
            <dt>Logradouro</dt><dd><?= htmlspecialchars($endereco->Logradouro) ?></dd>
            <dt>Número</dt><dd><?= htmlspecialchars($endereco->Numero) ?></dd>
            <dt>Complemento</dt><dd><?= htmlspecialchars($endereco->Complemento) ?></dd>
            <dt>Bairro</dt><dd><?= htmlspecialchars($endereco->Bairro) ?></dd>
            <dt>Cidade</dt><dd><?= htmlspecialchars($endereco->Cidade) ?></dd>
            <dt>CEP</dt><dd><?= htmlspecialchars($endereco->CEP) ?></dd>
            <dt>UF</dt><dd><?= htmlspecialchars($endereco->UF) ?></dd>
            <dt>Telefone</dt><dd><?= htmlspecialchars($endereco->Telefone) ?></dd>
            <dt>Celular</dt><dd><?= htmlspecialchars($endereco->Celular) ?></dd>
            <dt>E-mail</dt><dd><?= htmlspecialchars($endereco->Email) ?></dd>
        </dl>
        <?php else: ?>
        <p class="text-muted">Sem endereço cadastrado.</p>
        <?php endif; ?>
    </div>
    <div class="section">
        <div class="section-title">Filhos</div>
        <?php if ($filhos && count($filhos) > 0): ?>
        <ul class="filhos-list">
            <?php foreach ($filhos as $filho): ?>
            <li><b>Nome:</b> <?= htmlspecialchars($filho->Nome) ?> &nbsp; <b>Data de Nascimento:</b> <?= htmlspecialchars(formatDateBr($filho->DataNascimento)) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="text-muted">Nenhum filho cadastrado.</p>
        <?php endif; ?>
    </div>
    <script>window.onload = function() { setTimeout(function(){ window.print(); }, 300); };</script>
</body>
</html> 