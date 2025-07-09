<?php
use yii\helpers\Html;

$this->title = 'Boletos';
$this->params['breadcrumbs'][] = ['label' => 'Sócios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boletos-view">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #20713a, #2d8a4a); color: white;">
            <b><i class="fas fa-barcode me-2 icon-highlight"></i>Boletos</b>
        </div>
        <div class="card-body text-center">
            <p class="text-muted mb-0">Nenhum boleto disponível no momento.</p>
        </div>
    </div>
</div>
<style>
.icon-highlight {
  color: #fff !important;
  text-shadow: 0 2px 6px rgba(0,0,0,0.25), 0 0px 2px #157347;
  font-size: 1.3em;
  vertical-align: -2px;
}
</style> 