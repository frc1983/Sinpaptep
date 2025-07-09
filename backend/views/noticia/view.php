<?php
use yii\helpers\Html;

$this->title = $model->Titulo;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="noticia-view">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalhes da Notícia</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="120">ID:</th>
                            <td><?= Html::encode($model->Id) ?></td>
                        </tr>
                        <tr>
                            <th>Categoria:</th>
                            <td>
                                <span class="badge" style="background-color: var(--sinpaptep-primary); color: var(--sinpaptep-white);">
                                    <?= Html::encode($model->getCategoriaNome()) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Título:</th>
                            <td><strong><?= Html::encode($model->Titulo) ?></strong></td>
                        </tr>
                        <?php if ($model->Sub_Titulo): ?>
                        <tr>
                            <th>Subtítulo:</th>
                            <td><em><?= Html::encode($model->Sub_Titulo) ?></em></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Conteúdo</h5>
                </div>
                <div class="card-body">
                    <?= $model->getTextoSeguro() ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Imagens</h5>
                </div>
                <div class="card-body">
                    <?php if ($model->imagens && count($model->imagens) > 0): ?>
                        <div class="row">
                            <?php foreach ($model->imagens as $img): ?>
                                <div class="col-6 mb-2">
                                    <img src="<?= $img->getUrlComPrefixo() ?>" 
                                         class="img-fluid rounded" 
                                         style="max-height: 120px; object-fit: cover;"
                                         alt="Imagem da notícia">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-3x mb-2"></i>
                            <p>Nenhuma imagem</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Ações</h5>
                </div>
                <div class="card-body">
                    <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary w-100 mb-2']) ?>
                    <?= Html::a('<i class="fas fa-trash"></i> Excluir', ['delete', 'id' => $model->Id], [
                        'class' => 'btn btn-danger w-100 mb-2',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir esta notícia?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary w-100']) ?>
                </div>
            </div>
        </div>
    </div>
</div> 