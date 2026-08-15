<?php

/** @var yii\web\View $this */
/** @var common\models\Noticia[] $noticias */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\web\View;

$this->title = 'Início';

Modal::begin([
    'id' => 'modalComunicadoDiretoria',
    'title' => '<strong>COMUNICADO DA DIRETORIA</strong>',
    'size' => Modal::SIZE_EXTRA_LARGE,
    'closeButton' => false,
    'options' => [
        'tabindex' => false,
        'class' => 'modal-fullscreen',
    ],
]);
?>

<style>
#modalComunicadoDiretoria .modal-dialog {
    height: 95vh;
}

#modalComunicadoDiretoria .modal-content {
    height: 100%;
}
</style>
<div class="comunicado-diretoria">

    <h3 class="text-center mb-4">
        CONTRAPONTO DO SINDICATO DOS PUBLICITÁRIOS DO RS AO COMUNICADO DO SINAPRO-RS
    </h3>

    <p>
        Em resposta ao comunicado publicado pelo Sindicato Patronal – SINAPRO-RS em
        seu site, o Sindicato dos Publicitários do Estado do Rio Grande do Sul vem a público
        prestar os seguintes esclarecimentos aos trabalhadores da categoria:
    </p>

    <p>
        O Sindicato dos Publicitários do RS encaminhou ao SINAPRO-RS, em
        <strong>25 de março de 2026</strong>, a pauta de reivindicações para as negociações da
        <strong>Convenção Coletiva de Trabalho 2026/2027</strong>, dando início formal ao processo de negociação coletiva.
    </p>

    <p>
        Posteriormente, em <strong>28 de abril de 2026</strong>, o Sindicato Patronal encaminhou e-mail
        manifestando sua concordância com a manutenção da data-base em <strong>1º de maio</strong>,
        o que permitiu o prosseguimento das tratativas.
    </p>

    <p>
        Em <strong>12 de maio de 2026</strong>, ocorreu a primeira e única reunião entre as entidades.
        Na oportunidade, o SINAPRO-RS solicitou que o Sindicato dos Publicitários indicasse algumas
        das cláusulas constantes da pauta para que pudessem ser priorizadas nas negociações.
    </p>

    <p>
        Embora a pauta apresentada fosse composta por <strong>38 cláusulas</strong>, o Sindicato dos
        Publicitários, buscando facilitar o entendimento e possibilitar o avanço das negociações,
        selecionou e encaminhou ao Sindicato Patronal <strong>12 cláusulas consideradas prioritárias</strong>,
        justamente com o objetivo de encontrar pontos de consenso e dar continuidade ao processo negocial.
    </p>

    <p>
        Entretanto, em <strong>12 de junho de 2026</strong>, o SINAPRO-RS informou, por e-mail,
        que não poderia agendar nova reunião em razão de um de seus diretores estar submetido
        a procedimento cirúrgico.
    </p>

    <p>
        Demonstrando disposição para solucionar o impasse, em <strong>15 de junho de 2026</strong>,
        o Sindicato dos Publicitários encaminhou novo e-mail ao presidente do SINAPRO-RS,
        solicitando o agendamento de uma reunião para a retomada e conclusão das negociações.
        Não houve qualquer resposta ao pedido.
    </p>

    <div class="card border-success shadow-sm mt-4 mb-4">
        <div class="card-header text-white" style="background-color:#206839;">
            <h5 class="mb-0">
                <i class="fas fa-bullhorn me-2"></i>
                Esclarecimento à categoria
            </h5>
        </div>

        <div class="card-body">
            <p>
                Diante da ausência de retorno e da paralisação das negociações, o Sindicato dos
                Publicitários buscou uma alternativa institucional para solucionar o impasse,
                requerendo mediação junto à <strong>Superintendência Regional do Trabalho</strong>,
                sob o protocolo <strong>SM003742/2026</strong>.
            </p>

            <p class="mb-0">
                Contudo, a tentativa de mediação também não pôde avançar, em razão de a diretoria
                do Sindicato Patronal apresentar irregularidade em seu registro, situação que
                impediu o prosseguimento da mediação naquele momento.
            </p>
        </div>
    </div>

    <p>
        Assim, é importante esclarecer à categoria que o Sindicato dos Publicitários do RS
        <strong>não se omitiu e tampouco deixou de buscar o diálogo</strong>. Pelo contrário:
        apresentou a pauta dentro do prazo, participou da reunião realizada, atendeu à solicitação
        do Sindicato Patronal, reduziu a pauta de 38 para 12 cláusulas prioritárias, solicitou
        formalmente a retomada das negociações e, diante da ausência de resposta, buscou inclusive
        a mediação junto ao órgão competente.
    </p>

    <p>
        A paralisação das negociações, portanto, <strong>não pode ser atribuída à falta de iniciativa
        ou de disposição do Sindicato dos Publicitários do RS.</strong>
    </p>

    <p>
        Nosso compromisso continua sendo com a defesa dos direitos e interesses dos trabalhadores
        da categoria, com a valorização profissional e com a construção de uma Convenção Coletiva
        que assegure avanços nas condições de trabalho.
    </p>

    <p>
        Seguiremos buscando todos os meios legais e institucionais necessários para que as negociações
        sejam retomadas e para que a categoria não fique sem uma solução para a
        <strong>Convenção Coletiva 2026/2027.</strong>
    </p>

    <hr>

    <p class="text-center mb-0 assinatura">
        <strong>Sindicato dos Publicitários do Estado do Rio Grande do Sul</strong><br>
        Porto Alegre, 15 de agosto de 2026.
    </p>

</div>

<div class="text-center mt-4 mb-2">
    <?= Html::button(
        'Li o comunicado e estou ciente',
        [
            'class' => 'btn btn-primary btn-lg px-5',
            'data-bs-dismiss' => 'modal',
        ]
    ) ?>
</div>
<?php Modal::end(); ?>

<?php 
$this->registerJs(<<<JS

console.log("READY");
console.log(document.getElementById("modalComunicadoDiretoria"));

new bootstrap.Modal(
    document.getElementById("modalComunicadoDiretoria")
).show();

JS, View::POS_READY);?>

<div class="site-index">
    <!-- Latest News Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Coluna de Parceiros -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-handshake me-2"></i>Parceiros
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($anunciantes)): ?>
                            <?php foreach ($anunciantes as $anunciante): ?>
                                <div class="mb-3 text-center">
                                    <?php 
                                    $imagens = $anunciante->getImagens();
                                    if (!empty($imagens)): 
                                        $primeiraImagem = $imagens[0];
                                    ?>
                                        <img src="<?= Html::encode($primeiraImagem->getImagemUrl()) ?>" style="width:100%; max-width:120px; max-height:60px; object-fit:contain;" alt="<?= Html::encode($anunciante->Nome) ?>">
                                    <?php else: ?>
                                        <span class="text-muted small"><?= Html::encode($anunciante->Nome) ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted mb-3">
                                Conheça nossos parceiros e colaboradores que apoiam o SINPAPTEP-RS.
                            </p>
                        <?php endif; ?>
                        <a href="<?= Url::to(['/site/parceiros']) ?>" class="btn btn-primary w-100 mt-2">
                            <i class="fas fa-arrow-right me-1"></i>Ver Todos os Parceiros
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Coluna de Notícias -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 mb-0">
                        <i class="fas fa-fire text-danger me-2"></i>
                        Últimas Notícias
                    </h2>
                    <a href="<?= Url::to(['/site/noticias']) ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-right me-1"></i>Ver Todas
                    </a>
                </div>

                <?php if (empty($noticias)): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle fa-2x mb-3"></i>
                                <h4>Nenhuma notícia disponível</h4>
                                <p class="mb-0">Aguarde, em breve teremos novidades para você!</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach (
                            $noticias as $index => $noticia): ?>
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if ($noticia->imagem): ?>
                                        <img src="<?= $noticia->imagem ? $noticia->imagem->getUrlComPrefixo() : '' ?>" 
                                             class="card-img-top noticia-card-img" 
                                             alt="<?= Html::encode($noticia->Titulo) ?>">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="fas fa-newspaper fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-2">
                                            <?php if ($index === 0): ?>
                                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                                    <i class="fas fa-star me-1"></i>Destaque
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <h5 class="card-title">
                                            <?= Html::encode($noticia->Titulo) ?>
                                        </h5>
                                        
                                        <?php if ($noticia->Sub_Titulo): ?>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                <?= Html::encode($noticia->Sub_Titulo) ?>
                                            </h6>
                                        <?php endif; ?>
                                        
                                        <p class="card-text text-muted">
                                            <?= $noticia->getTextoListaSeguro(120) ?>
                                        </p>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-tag me-1"></i>
                                                    <?= Html::encode($noticia->getCategoriaNome()) ?>
                                                </small>
                                                <small class="text-muted">
                                                    <i class="fas fa-hashtag me-1"></i>
                                                    #<?= $noticia->Id ?>
                                                </small>
                                            </div>
                                            
                                            <?= Html::a(
                                                '<i class="fas fa-eye me-1"></i>Ler mais',
                                                ['/site/noticia', 'id' => $noticia->Id],
                                                ['class' => 'btn btn-outline-primary btn-sm w-100']
                                            ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
