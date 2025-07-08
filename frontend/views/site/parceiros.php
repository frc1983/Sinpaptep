<?php

/** @var yii\web\View $this */
/** @var common\models\Parceiro[] $parceiros */

$this->title = 'Parceiros';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="parceiros-page">
    <!-- Header da página -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-handshake me-3"></i>Nossos Parceiros
                </h1>
                <p class="lead text-muted">
                    Conheça as empresas e instituições que apoiam o SINPAPTEP-RS
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <?php if (empty($parceiros)): ?>
        <!-- Estado vazio -->
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-handshake fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Nenhum parceiro cadastrado</h3>
                    <p class="text-muted">Em breve divulgaremos nossos parceiros aqui.</p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Lista de parceiros -->
        <div class="row g-4">
            <?php foreach (
                $parceiros as $parceiro
            ): ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100 parceiro-card shadow-sm">
                        <div class="card-body text-center p-4">
                            <!-- Imagens do parceiro -->
                            <?php 
                            $imagens = $parceiro->getImagens();
                            if (!empty($imagens)):
                                $carouselId = 'parceiro-carousel-' . $parceiro->Id;
                                $modalId = 'parceiro-modal-' . $parceiro->Id;
                            ?>
                                <div class="parceiro-imagem mb-3">
                                    <div id="<?= $carouselId ?>" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($imagens as $idx => $img): ?>
                                                <div class="carousel-item<?= $idx === 0 ? ' active' : '' ?>">
                                                    <img src="/Sinpaptep/backend/web/uploads/parceiros/<?= htmlspecialchars($img->Imagem) ?>"
                                                         alt="<?= htmlspecialchars($parceiro->Nome) ?>"
                                                         class="img-fluid parceiro-imagem-clickable"
                                                         style="max-height: 120px; max-width: 200px; object-fit: contain; margin: 0 auto; cursor: pointer;"
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#<?= $modalId ?>"
                                                         title="Clique para ampliar">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php if (count($imagens) > 1): ?>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Anterior</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#<?= $carouselId ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Próxima</span>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="parceiro-imagem-placeholder mb-3">
                                    <i class="fas fa-building fa-4x text-muted"></i>
                                </div>
                            <?php endif; ?>

                            <!-- Nome do parceiro -->
                            <h5 class="card-title parceiro-nome mb-3">
                                <?= htmlspecialchars($parceiro->Nome) ?>
                            </h5>

                            <!-- Descrição -->
                            <?php if ($parceiro->Descricao): ?>
                                <p class="card-text text-muted mb-3">
                                    <?= nl2br(htmlspecialchars($parceiro->Descricao)) ?>
                                </p>
                            <?php endif; ?>

                            <!-- Link para o site -->
                            <?php if ($parceiro->Site): ?>
                                <a href="<?= htmlspecialchars($parceiro->Site) ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    Visitar Site
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Informações adicionais -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body text-center p-4">
                        <h4 class="mb-3 parceiro-destaque-titulo">
                            <i class="fas fa-info-circle me-2 parceiro-destaque-icone"></i>
                            Interessado em ser nosso parceiro?
                        </h4>
                        <p class="text-muted mb-3">
                            Se sua empresa ou instituição tem interesse em estabelecer uma parceria 
                            com o SINPAPTEP-RS, entre em contato conosco.
                        </p>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>" 
                           class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>
                            Entre em Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modais para visualização grande das imagens -->
<?php foreach ($parceiros as $parceiro): ?>
    <?php 
    $imagens = $parceiro->getImagens();
    if (!empty($imagens)):
        $modalId = 'parceiro-modal-' . $parceiro->Id;
        $modalCarouselId = 'modal-carousel-' . $parceiro->Id;
    ?>
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>-label" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?= $modalId ?>-label">
                            <i class="fas fa-images me-2"></i>
                            <?= htmlspecialchars($parceiro->Nome) ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="<?= $modalCarouselId ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($imagens as $idx => $img): ?>
                                    <div class="carousel-item<?= $idx === 0 ? ' active' : '' ?>">
                                        <img src="/Sinpaptep/backend/web/uploads/parceiros/<?= htmlspecialchars($img->Imagem) ?>"
                                             alt="<?= htmlspecialchars($parceiro->Nome) ?>"
                                             class="img-fluid w-100"
                                             style="max-height: 70vh; object-fit: contain;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($imagens) > 1): ?>
                                <button class="carousel-control-prev" type="button" data-bs-target="#<?= $modalCarouselId ?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#<?= $modalCarouselId ?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Próxima</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Imagem <?= count($imagens) > 1 ? '1 de ' . count($imagens) : '' ?>
                        </span>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<style>
.parceiro-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,.125);
    position: relative;
    overflow: hidden;
}

.parceiro-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.parceiro-imagem {
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.parceiro-imagem-placeholder {
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 8px;
}

.parceiro-card .card-body {
    display: flex;
    flex-direction: column;
}

.parceiro-card .card-text {
    flex-grow: 1;
}

/* Estilos personalizados para o carrossel dentro do card */
.parceiro-card .carousel {
    position: relative;
    width: 100%;
}

.parceiro-card .carousel-inner {
    border-radius: 8px;
    overflow: hidden;
}

.parceiro-card .carousel-item {
    text-align: center;
    padding: 10px;
}

.parceiro-card .carousel-control-prev,
.parceiro-card .carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    background-color: rgba(32, 113, 58, 0.8);
    border: none;
    border-radius: 50%;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.parceiro-card .carousel-control-prev {
    left: 5px;
}

.parceiro-card .carousel-control-next {
    right: 5px;
}

.parceiro-card .carousel-control-prev:hover,
.parceiro-card .carousel-control-next:hover {
    background-color: rgba(32, 113, 58, 1);
    transform: translateY(-50%) scale(1.1);
}

.parceiro-card .carousel-control-prev-icon,
.parceiro-card .carousel-control-next-icon {
    width: 15px;
    height: 15px;
    filter: brightness(0) invert(1);
}

/* Estilos para imagens clicáveis */
.parceiro-imagem-clickable {
    transition: all 0.3s ease;
}

.parceiro-imagem-clickable:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Estilos para o modal */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg, #20713a, #2d8a4a);
    color: white;
    border-bottom: none;
    border-radius: 12px 12px 0 0;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    background-color: #f8f9fa;
}

.modal-footer {
    background-color: #f8f9fa;
    border-top: none;
    border-radius: 0 0 12px 12px;
}

/* Estilos para o carrossel do modal */
.modal .carousel {
    background-color: #f8f9fa;
}

.modal .carousel-control-prev,
.modal .carousel-control-next {
    width: 50px;
    height: 50px;
    background-color: rgba(32, 113, 58, 0.9);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.modal .carousel-control-prev {
    left: 20px;
}

.modal .carousel-control-next {
    right: 20px;
}

.modal .carousel-control-prev:hover,
.modal .carousel-control-next:hover {
    background-color: rgba(32, 113, 58, 1);
    transform: translateY(-50%) scale(1.1);
}

.modal .carousel-control-prev-icon,
.modal .carousel-control-next-icon {
    width: 20px;
    height: 20px;
    filter: brightness(0) invert(1);
}

@media (max-width: 768px) {
    .parceiro-card {
        margin-bottom: 1rem;
    }
    
    .parceiro-card .carousel-control-prev,
    .parceiro-card .carousel-control-next {
        width: 25px;
        height: 25px;
    }
    
    .parceiro-card .carousel-control-prev-icon,
    .parceiro-card .carousel-control-next-icon {
        width: 12px;
        height: 12px;
    }
    
    .modal .carousel-control-prev,
    .modal .carousel-control-next {
        width: 40px;
        height: 40px;
    }
    
    .modal .carousel-control-prev-icon,
    .modal .carousel-control-next-icon {
        width: 16px;
        height: 16px;
    }
}

.parceiro-destaque-titulo {
    color: var(--sinpaptep-primary) !important;
    font-weight: 600;
}
.parceiro-destaque-icone {
    color: var(--sinpaptep-accent) !important;
    fill: var(--sinpaptep-accent) !important;
}
.parceiro-destaque-titulo .fa-info-circle {
    color: var(--sinpaptep-accent) !important;
    fill: var(--sinpaptep-accent) !important;
}

.parceiro-nome {
    color: var(--sinpaptep-primary) !important;
    font-weight: 600;
}
</style> 