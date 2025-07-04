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
            <?php foreach ($parceiros as $parceiro): ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100 parceiro-card shadow-sm">
                        <div class="card-body text-center p-4">
                            <!-- Logo do parceiro -->
                            <?php if ($parceiro->Logo): ?>
                                <div class="parceiro-logo mb-3">
                                    <img src="/Sinpaptep/backend/web/uploads/parceiros/<?= htmlspecialchars($parceiro->Logo) ?>" 
                                         alt="<?= htmlspecialchars($parceiro->Nome) ?>" 
                                         class="img-fluid" 
                                         style="max-height: 120px; max-width: 200px; object-fit: contain;">
                                </div>
                            <?php else: ?>
                                <div class="parceiro-logo-placeholder mb-3">
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

<style>
.parceiro-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,.125);
}

.parceiro-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.parceiro-logo {
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.parceiro-logo-placeholder {
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

@media (max-width: 768px) {
    .parceiro-card {
        margin-bottom: 1rem;
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