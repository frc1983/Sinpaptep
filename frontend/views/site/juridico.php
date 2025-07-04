<?php
/** @var yii\web\View $this */

$this->title = 'Jurídico';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="homologacoes-page">
    <div class="row mb-4">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 mb-3" style="color: #20713a;">
                    <i class="fas fa-gavel me-3" style="color: #20713a;"></i>Jurídico
                </h1>
                <p class="lead text-muted">
                    Atendimento jurídico
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body bg-white">
                        <h2 class="text-center mb-4" style="color: #20713a;">
                            <i class="fas fa-user-tie me-2" style="color: #20713a;"></i>
                            Atendimento Jurídico
                        </h2>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item d-flex flex-column align-items-center">
                                <i class="fas fa-user me-2 mb-2" style="color: #20713a;"></i>
                                <span>Monalisa Campelo</span>
                            </li>
                            <li class="list-group-item d-flex flex-column align-items-center">
                                <i class="fas fa-user me-2 mb-2" style="color: #20713a;"></i>
                                <span>Franciso Lázaro</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/contact']) ?>" 
                       class="btn btn-primary btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Fale com o Jurídico
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