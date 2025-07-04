<?php

/** @var yii\web\View $this */

$this->title = 'Homologações';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="homologacoes-page">
    <!-- Header institucional -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-file-contract me-3" style="color: #20713a;"></i>Homologações
                </h1>
                <p class="lead text-muted">
                    Informações sobre homologação de rescisões contratuais
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Título principal -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body bg-white">
                        <h2 class="text-center mb-4" style="color: #20713a;">
                            <i class="fas fa-clipboard-list me-2" style="color: #20713a;"></i>
                            Homologação de Rescisões Contratuais
                        </h2>
                    </div>
                </div>

                <!-- Lista de documentos -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h3 class="mb-0">
                            <i class="fas fa-list-check me-2" style="color: #fff;"></i>
                            Lista de documentos necessários para efetuar a rescisão:
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-file-alt me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Termo de Rescisão de Contrato de Trabalho em 05 vias</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-id-card me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Carteira de Trabalho Atualizada</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-book me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Ficha ou Livro de empregados com Dados Atualizados</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-stethoscope me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Atestado Médico Demissional</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-envelope me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Carta de Preposição</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-file-invoice me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Guia de Comunicação de Dispensa e Requerimento do Seguro-Desemprego</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-chart-line me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Extrato Analítico FGTS</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-percentage me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Guia de Recolhimento Rescisório FGTS – Multa 50%</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-calculator me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Demonstrativo das parcelas variáveis e outros benefícios considerados para fins de cálculo dos valores devidos na rescisão contratual (comissões, horas extras, adicional noturno, repouso semanal remunerado)</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-start">
                                        <i class="fas fa-handshake me-3 mt-1" style="color: #20713a;"></i>
                                        <span>Comprovante da Contribuição Sindical e Assistencial, juntamente com relações de empregados</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações importantes -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2" style="color: #fff;"></i>
                            Informações Importantes
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-calendar-alt me-2" style="color: #20713a;"></i>Agendamento</h5>
                            <p class="mb-0">
                                A Homologação das rescisões contratuais é feita somente mediante agendamento prévio efetuado pelo fone 
                                <strong>(51) 3361-2495</strong>, somente nas <strong>segundas, quartas e sextas</strong>, das <strong>14h às 18h</strong>.
                            </p>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="fas fa-money-bill-wave me-2" style="color: #20713a;"></i>Formas de Pagamento</h5>
                            <p class="mb-0">
                                Pagamentos das verbas rescisórias somente podem ser efetuados em dinheiro, depósito diretamente no caixa ou 
                                cheque administrativo (somente até as 15h).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Base legal -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-balance-scale me-2" style="color: #fff;"></i>
                            Base Legal
                        </h4>
                    </div>
                    <div class="card-body">
                        <p>
                            A assistência ao empregado efetuado pelo SINPAPTEP-RS é prestada nos termos da 
                            <strong>Instrução Normativa SRT/TEM nº 03, de 21.06.2002 – DOU de 28.06.2002</strong>, 
                            art 477 da CLT e clausulas prevista na Convenção Coletiva da categoria (em anexo).
                        </p>
                        
                        <div class="alert alert-success">
                            <h6><i class="fas fa-lightbulb me-2" style="color: #20713a;"></i><span style="color: #20713a;">Recomendação</span></h6>
                            <p class="mb-0 text-dark">
                                Recomenda-se a leitura das Convenções Coletivas da Categoria (que serão fornecidas mediante solicitação prévia), 
                                para correta apuração das verbas rescisórias.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Botão de contato -->
                <div class="text-center">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>" 
                       class="btn btn-primary btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Agendar Homologação
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.list-group-item {
    border: none;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 0;
}

.list-group-item:last-child {
    border-bottom: none;
}

.list-group-item i {
    min-width: 20px;
}

.card-header {
    border-bottom: none;
}

.alert {
    border: none;
    border-radius: 8px;
}

.bg-warning.text-black {
    color: #000 !important;
    background-color: #ffc107 !important;
}

.bg-dark.text-white {
    color: #fff !important;
    background-color: #212529 !important;
}

@media (max-width: 768px) {
    .list-group-item {
        padding: 0.75rem 0;
    }
}
</style> 