<?php

use yii\helpers\Html;
use common\models\Categoria;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Noticia */

?>

<?php if ($model->hasErrors()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($model->getFirstErrors() as $attr => $err): ?>
                <li><strong><?= $model->getAttributeLabel($attr) ?>:</strong> <?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
    
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="noticia-titulo" class="form-label">Título *</label>
                <input type="text" class="form-control" id="noticia-titulo" name="Noticia[Titulo]" maxlength="255" value="<?= Html::encode($model->Titulo) ?>" required>
                <div class="form-text">Título principal da notícia (máximo 255 caracteres)</div>
            </div>
            
            <div class="mb-3">
                <label for="noticia-sub-titulo" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" id="noticia-sub-titulo" name="Noticia[Sub_Titulo]" maxlength="255" value="<?= Html::encode($model->Sub_Titulo) ?>">
                <div class="form-text">Subtítulo opcional da notícia (máximo 255 caracteres)</div>
            </div>
            
            <div class="mb-3">
                <label for="noticia-texto" class="form-label">Texto *</label>
                <?php if (class_exists('dosamigos\tinymce\TinyMce')): ?>
                    <?= TinyMce::widget([
                        'name' => 'Noticia[Texto]',
                        'value' => $model->Texto,
                        'options' => [
                            'id' => 'noticia-texto',
                            'rows' => 12
                        ],
                        'clientOptions' => [
                            'height' => 400,
                            'plugins' => [
                                'advlist autolink lists link image charmap print preview anchor',
                                'searchreplace visualblocks code fullscreen',
                                'insertdatetime media table paste code help wordcount'
                            ],
                            'toolbar' => 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | help',
                            'menubar' => false,
                            'statusbar' => true,
                            'resize' => true,
                            'valid_elements' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder]',
                            'extended_valid_elements' => 'iframe[src|width|height|frameborder|allowfullscreen]'
                        ]
                    ]); ?>
                <?php else: ?>
                    <textarea class="form-control" id="noticia-texto" name="Noticia[Texto]" rows="12" placeholder="Digite o texto da notícia aqui..."><?= Html::encode($model->Texto) ?></textarea>
                <?php endif; ?>
                <div class="form-text">
                    <strong>HTML permitido:</strong> &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;u&gt;, &lt;b&gt;, &lt;i&gt;, &lt;span&gt;, &lt;div&gt;, &lt;h1&gt;-&lt;h6&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;a&gt;, &lt;img&gt;, &lt;blockquote&gt;, &lt;code&gt;, &lt;pre&gt;, &lt;table&gt;, &lt;iframe&gt; (YouTube/Vimeo)
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Configurações</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="noticia-categoria" class="form-label">Categoria *</label>
                        <select class="form-select" id="noticia-categoria" name="Noticia[Id_Categoria]" required>
                            <option value="">Selecione uma categoria</option>
                            <?php 
                            $categorias = Categoria::getTodasCategorias();
                            foreach ($categorias as $categoria): 
                            ?>
                                <option value="<?= $categoria->Id ?>" <?= $model->Id_Categoria == $categoria->Id ? 'selected' : '' ?>>
                                    <?= Html::encode($categoria->Nome) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <?php if ($model->imagens): ?>
                        <div class="mb-3">
                            <label class="form-label">Imagens Atuais</label>
                            <div class="row">
                                <?php foreach ($model->imagens as $img): ?>
                                    <div class="col-6 mb-2">
                                        <div class="card">
                                            <img src="<?= Yii::getAlias('@web') . '/' . $img->Url ?>" 
                                                 class="card-img-top" 
                                                 style="height: 80px; object-fit: cover;"
                                                 alt="Imagem da notícia">
                                            <div class="card-body p-2">
                                                <?= Html::a('<i class="fas fa-trash"></i>', 
                                                    ['/noticia/remover-imagem', 'id' => $img->Id], 
                                                    [
                                                        'class' => 'btn btn-danger btn-sm w-100',
                                                        'onclick' => 'return confirm("Remover esta imagem?")',
                                                        'title' => 'Remover imagem'
                                                    ]
                                                ) ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="noticia-imagem" class="form-label">Adicionar Imagens</label>
                        <input type="file" class="form-control" id="noticia-imagem" name="Noticia[imagemFile][]" multiple accept="image/*">
                        <div class="form-text">
                            Formatos: PNG, JPG, JPEG<br>
                            Máximo: 10 arquivos<br>
                            Tamanho recomendado: 800x600px
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle"></i>
                            <strong>Dicas:</strong><br>
                            • Use o editor para formatação rica<br>
                            • Adicione imagens para melhor visualização<br>
                            • Escolha a categoria apropriada
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group mt-4">
        <?php if ($model->isNewRecord): ?>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Salvar Notícia
            </button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Atualizar Notícia
            </button>
        <?php endif; ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        var isValid = true;
        var errorMessage = '';
        
        // Validar título
        var titulo = document.getElementById('noticia-titulo').value.trim();
        if (!titulo) {
            errorMessage += '• O campo Título é obrigatório.\n';
            isValid = false;
        }
        
        // Validar categoria
        var categoria = document.getElementById('noticia-categoria').value;
        if (!categoria) {
            errorMessage += '• O campo Categoria é obrigatório.\n';
            isValid = false;
        }
        
        // Validar texto (TinyMCE)
        var textarea = document.getElementById('noticia-texto');
        var content = '';
        
        if (typeof tinymce !== 'undefined' && tinymce.get('noticia-texto')) {
            // Garantir que o TinyMCE salve o conteúdo antes da validação
            tinymce.get('noticia-texto').save();
            content = textarea.value.trim();
        } else {
            content = textarea.value.trim();
        }
        
        // Verificar se o conteúdo não está vazio após remover HTML
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;
        var textoSemHtml = tempDiv.textContent || tempDiv.innerText || '';
        
        if (!content || textoSemHtml.trim() === '') {
            errorMessage += '• O campo Texto não pode estar vazio.\n';
            isValid = false;
        }
        
        if (!isValid) {
            alert('Por favor, corrija os seguintes erros:\n\n' + errorMessage);
            e.preventDefault();
            return false;
        }
        
        // Se tudo estiver válido, garantir que o TinyMCE salve antes do submit
        if (typeof tinymce !== 'undefined' && tinymce.get('noticia-texto')) {
            tinymce.get('noticia-texto').save();
        }
    });
});
</script> 