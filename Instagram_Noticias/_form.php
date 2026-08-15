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
                            'toolbar' => 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | removeformat | help',
                            'menubar' => false,
                            'statusbar' => true,
                            'resize' => true,
                            'valid_elements' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style]',
                            'extended_valid_elements' => 'iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style]',
                            'invalid_elements' => 'script,object,embed',
                            'paste_as_text' => false,
                            'paste_remove_styles' => false,
                            'paste_retain_style_properties' => 'all',
                            'forced_root_block' => 'p',
                            'force_br_newlines' => false,
                            'force_p_newlines' => true,
                            'convert_newlines_to_brs' => false,
                            'setup' => new \yii\web\JsExpression('function(editor) {
                                editor.on("BeforeSetContent", function(e) {
                                    if (e.content) {
                                        if (e.content.indexOf("&lt;iframe") !== -1) {
                                            var div = document.createElement("div");
                                            div.innerHTML = e.content;
                                            e.content = div.innerHTML;
                                        }
                                        e.content = e.content.replace(/<p[^>]*>\s*<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>\s*<\/p>/gi, "$1");
                                        e.content = e.content.replace(/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/gi, "$1");
                                        e.content = e.content.replace(/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/gi, "$1");
                                    }
                                });
                                editor.on("GetContent", function(e) {
                                    if (e.content) {
                                        if (e.content.indexOf("&lt;iframe") !== -1) {
                                            var div = document.createElement("div");
                                            div.innerHTML = e.content;
                                            e.content = div.innerHTML;
                                        }
                                        e.content = e.content.replace(/<p[^>]*>\s*<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>\s*<\/p>/gi, "$1");
                                        e.content = e.content.replace(/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/gi, "$1");
                                        e.content = e.content.replace(/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/gi, "$1");
                                    }
                                });
                            }')
                        ]
                    ]); ?>
                <?php else: ?>
                    <textarea class="form-control" id="noticia-texto" name="Noticia[Texto]" rows="12" placeholder="Digite o texto da notícia aqui..."><?= Html::encode($model->Texto) ?></textarea>
                <?php endif; ?>
            </div>

            <!-- =======================================================-->
            <!-- CAMPO INSTAGRAM - NOVO                                  -->
            <!-- =======================================================-->
            <div class="mb-3">
                <label for="noticia-instagram" class="form-label">
                    <i class="fab fa-instagram" style="color:#E1306C;"></i>
                    Post do Instagram
                    <span class="badge bg-secondary ms-1">Opcional</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text" style="background:#E1306C; color:#fff; border-color:#E1306C;">
                        <i class="fab fa-instagram"></i>
                    </span>
                    <input type="url"
                           class="form-control"
                           id="noticia-instagram"
                           name="Noticia[Instagram_Url]"
                           maxlength="500"
                           value="<?= Html::encode($model->Instagram_Url) ?>"
                           placeholder="https://www.instagram.com/p/CODIGO_DO_POST/">
                </div>
                <div class="form-text">
                    Cole aqui o link do post do Instagram que deseja exibir na notícia.<br>
                    <strong>Onde encontrar:</strong> Abra o post no Instagram → clique nos três pontos (···) → <em>Copiar link</em>.<br>
                    <strong>Exemplos aceitos:</strong>
                    <code>https://www.instagram.com/p/ABC123/</code> &nbsp;|&nbsp;
                    <code>https://www.instagram.com/reel/ABC123/</code>
                </div>
                <?php if ($model->temInstagram()): ?>
                    <div class="mt-2 p-2 border rounded bg-light d-flex align-items-center gap-2">
                        <i class="fab fa-instagram fa-lg" style="color:#E1306C;"></i>
                        <span class="text-success fw-bold">Post vinculado</span>
                        <a href="<?= Html::encode($model->Instagram_Url) ?>" target="_blank" class="ms-auto btn btn-sm btn-outline-secondary">
                            <i class="fas fa-external-link-alt"></i> Ver no Instagram
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <!-- =======================================================-->

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

                    <?php if (!$model->isNewRecord && $model->imagens && count($model->imagens) > 0): ?>
                        <div class="mb-3">
                            <label class="form-label">Imagens atuais</label>
                            <div class="row g-2">
                                <?php foreach ($model->imagens as $img): ?>
                                    <div class="col-6">
                                        <div class="position-relative">
                                            <img src="<?= $img->getUrlComPrefixo() ?>"
                                                 class="img-fluid rounded"
                                                 style="height:80px; object-fit:cover; width:100%;"
                                                 alt="Imagem">
                                            <?= Html::a(
                                                '<i class="fas fa-times"></i>',
                                                ['remover-imagem', 'id' => $img->Id],
                                                [
                                                    'class' => 'btn btn-danger btn-sm position-absolute top-0 end-0 m-1',
                                                    'style' => 'padding:2px 6px; font-size:10px;',
                                                    'data' => [
                                                        'confirm' => 'Remover esta imagem?',
                                                        'method' => 'post',
                                                    ]
                                                ]
                                            ) ?>
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
                            Máximo: 10 arquivos
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle"></i>
                            <strong>Dicas:</strong><br>
                            • Use o editor para formatação rica<br>
                            • Cole o link do Instagram no campo acima<br>
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
    if (typeof tinymce !== 'undefined') {
        setTimeout(function() {
            var editor = tinymce.get('noticia-texto');
            if (editor) {
                editor.on('GetContent', function(e) {
                    if (e.content) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = e.content;
                        e.content = tempDiv.innerHTML;
                        e.content = e.content.replace(/<p[^>]*>\s*<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>\s*<\/p>/gi, '$1');
                        e.content = e.content.replace(/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/gi, '$1');
                        e.content = e.content.replace(/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/gi, '$1');
                    }
                });
            }
        }, 500);
    }
    
    // Preview do link do Instagram ao sair do campo
    var igInput = document.getElementById('noticia-instagram');
    if (igInput) {
        igInput.addEventListener('blur', function() {
            var url = this.value.trim();
            var preview = document.getElementById('ig-preview');
            if (preview) preview.remove();

            if (!url) return;

            var match = url.match(/instagram\.com\/(p|reel|tv)\/([^/?#]+)/i);
            if (match) {
                var embedUrl = 'https://www.instagram.com/' + match[1] + '/' + match[2] + '/embed/';
                var div = document.createElement('div');
                div.id = 'ig-preview';
                div.className = 'mt-2';
                div.innerHTML = '<div class="text-muted small mb-1"><i class="fab fa-instagram"></i> Pré-visualização do embed:</div>' +
                    '<iframe src="' + embedUrl + '" width="100%" height="480" frameborder="0" scrolling="no" allowtransparency="true" style="border-radius:8px;border:1px solid #ddd;"></iframe>';
                igInput.closest('.mb-3').appendChild(div);
            } else if (url) {
                var div = document.createElement('div');
                div.id = 'ig-preview';
                div.className = 'mt-2 alert alert-warning';
                div.innerHTML = '<i class="fas fa-exclamation-triangle"></i> URL não reconhecida como post do Instagram. Verifique o link.';
                igInput.closest('.mb-3').appendChild(div);
            }
        });
    }

    var form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        var isValid = true;
        var errorMessage = '';
        
        var titulo = document.getElementById('noticia-titulo').value.trim();
        if (!titulo) {
            errorMessage += '• O campo Título é obrigatório.\n';
            isValid = false;
        }
        
        var categoria = document.getElementById('noticia-categoria').value;
        if (!categoria) {
            errorMessage += '• O campo Categoria é obrigatório.\n';
            isValid = false;
        }
        
        var textarea = document.getElementById('noticia-texto');
        var content = '';
        if (typeof tinymce !== 'undefined' && tinymce.get('noticia-texto')) {
            tinymce.get('noticia-texto').save();
            content = textarea.value.trim();
        } else {
            content = textarea.value.trim();
        }
        
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
        
        if (typeof tinymce !== 'undefined' && tinymce.get('noticia-texto')) {
            tinymce.get('noticia-texto').save();
            var ta = document.getElementById('noticia-texto');
            var c = ta.value;
            var td = document.createElement('div');
            td.innerHTML = c;
            c = td.innerHTML;
            c = c.replace(/<p[^>]*>\s*<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>\s*<\/p>/gi, '$1');
            c = c.replace(/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/gi, '$1');
            c = c.replace(/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/gi, '$1');
            ta.value = c;
        }
    });
});
</script>
