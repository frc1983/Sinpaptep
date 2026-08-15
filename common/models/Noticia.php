<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "noticia".
 *
 * @property int $Id
 * @property int $Id_Categoria
 * @property string $Titulo
 * @property string|null $Sub_Titulo
 * @property string $Texto
 */
class Noticia extends ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $imagemFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Noticia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_Categoria', 'Titulo', 'Texto'], 'required'],
            [['Id_Categoria'], 'integer'],
            [['Texto'], 'string'],
            [['Titulo', 'Sub_Titulo'], 'string', 'max' => 255],
            [['imagemFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
            [['Id_Categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['Id_Categoria' => 'Id']],
            ['Texto', 'validateTexto'],
        ];
    }

    /**
     * Limpa o texto antes de salvar
     * Remove tags <p> inválidas ao redor de iframes e decodifica HTML escapado
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Limpa tags inválidas ao redor de iframes antes de salvar
            if (!empty($this->Texto)) {
                // Decodifica HTML escapado (se o TinyMCE ou outro processo escapou)
                // Isso corrige casos onde &lt;iframe&gt; foi salvo ao invés de <iframe>
                $this->Texto = html_entity_decode($this->Texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                
                // Limpa tags inválidas ao redor de iframes
                $this->Texto = $this->limparTagsInvalidasAoRedorIframes($this->Texto);
                
                // Remove <span> ao redor de iframes também
                $this->Texto = preg_replace('/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/is', '$1', $this->Texto);
            }
            return true;
        }
        return false;
    }

    /**
     * Validates the Texto field to ensure it's not empty after stripping HTML
     */
    public function validateTexto($attribute, $params)
    {
        $textoSemHtml = strip_tags($this->$attribute);
        if (trim($textoSemHtml) === '') {
            $this->addError($attribute, 'O campo Texto não pode estar vazio.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Categoria' => 'Categoria',
            'Titulo' => 'Título',
            'Sub_Titulo' => 'Subtítulo',
            'Texto' => 'Texto',
            'imagemFile' => 'Imagem',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['Id' => 'Id_Categoria']);
    }

    /**
     * Gets query for [[Imagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id']);
    }

    /**
     * Gets query for [[Imagem]] (first image).
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagem()
    {
        return $this->hasOne(Imagem::class, ['Id_Noticia' => 'Id'])
            ->orderBy(['Id' => SORT_ASC]);
    }

    /**
     * Get categoria name
     *
     * @return string
     */
    public function getCategoriaNome()
    {
        return $this->categoria ? $this->categoria->Nome : 'Sem categoria';
    }

    /**
     * Get short text (first 200 characters)
     *
     * @param int $length
     * @return string
     */
    public function getTextoResumido($length = 200)
    {
        $texto = strip_tags($this->Texto);
        if (strlen($texto) <= $length) {
            return $texto;
        }
        return substr($texto, 0, $length) . '...';
    }

    /**
     * Get short text with HTML preserved
     *
     * @param int $length
     * @return string
     */
    public function getTextoResumidoHtml($length = 200)
    {
        $texto = $this->Texto;
        
        // Remove HTML tags for length calculation
        $textoSemTags = strip_tags($texto);
        
        if (strlen($textoSemTags) <= $length) {
            return $texto; // Return full HTML if text is short enough
        }
        
        // Truncate text
        $textoTruncado = substr($textoSemTags, 0, $length);
        
        // Find the last complete word
        $ultimoEspaco = strrpos($textoTruncado, ' ');
        if ($ultimoEspaco !== false) {
            $textoTruncado = substr($textoTruncado, 0, $ultimoEspaco);
        }
        
        // Simple approach: truncate and preserve basic HTML
        $allowedTags = ['strong', 'em', 'u', 'b', 'i', 'span', 'p', 'br', 'div'];
        $textoLimpo = strip_tags($texto, '<' . implode('><', $allowedTags) . '>');
        
        // Find the position in the original text
        $posicao = strpos($textoLimpo, $textoTruncado);
        if ($posicao !== false) {
            $resultado = substr($textoLimpo, 0, $posicao + strlen($textoTruncado));
            return $resultado . '...';
        }
        
        return $textoTruncado . '...';
    }

    /**
     * Process text with Instagram embeds (special handling)
     *
     * @return string
     */
    private function processarTextoComInstagram()
    {
        // Tenta encontrar o iframe do Instagram usando regex mais permissivo
        // Remove espaços extras e normaliza o iframe
        $texto = $this->Texto;
        
        // Padrão que captura iframes do Instagram com diferentes variações
        $pattern = '/<iframe\s+([^>]*instagram[^>]*)>\s*<\/iframe>/is';
        
        if (preg_match($pattern, $texto, $matches)) {
            // Encontrou iframe, preserva-o e processa o resto
            $iframeCompleto = $matches[0];
            
            // Remove o iframe do texto temporariamente
            $textoSemIframe = str_replace($iframeCompleto, '___INSTAGRAM_IFRAME___', $texto);
            
            // Processa o resto
            $processado = \yii\helpers\HtmlPurifier::process($textoSemIframe, [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th',
            ]);
            
            // Restaura o iframe
            return str_replace('___INSTAGRAM_IFRAME___', $iframeCompleto, $processado);
        }
        
        // Se não encontrou com o padrão acima, tenta padrão mais amplo
        $pattern2 = '/<iframe[^>]*instagram[^>]*>.*?<\/iframe>/is';
        if (preg_match($pattern2, $texto, $matches)) {
            $iframeCompleto = $matches[0];
            $textoSemIframe = str_replace($iframeCompleto, '___INSTAGRAM_IFRAME___', $texto);
            $processado = \yii\helpers\HtmlPurifier::process($textoSemIframe, [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th',
            ]);
            return str_replace('___INSTAGRAM_IFRAME___', $iframeCompleto, $processado);
        }
        
        // Se não encontrou, retorna processado normalmente mas permitindo iframes
        return \yii\helpers\HtmlPurifier::process($texto, [
            'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style|class]',
            'HTML.SafeIframe' => true,
            'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/|www\.instagram\.com/.*/embed/)%',
        ]);
    }

    /**
     * Get text as safe HTML for display
     *
     * @return string
     */
    /**
     * Remove tags <p> e <div> inválidas ao redor de iframes
     * O TinyMCE às vezes envolve iframes em <p>, o que é HTML inválido
     * Também lida com HTML escapado
     *
     * @param string $texto
     * @return string
     */
    private function limparTagsInvalidasAoRedorIframes($texto)
    {
        // Primeiro, decodifica HTML escapado se necessário
        // Verifica se há HTML escapado (ex: &lt;iframe)
        if (strpos($texto, '&lt;iframe') !== false || strpos($texto, '&lt;/iframe') !== false) {
            $texto = html_entity_decode($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        
        // Remove <span> ao redor de iframes
        $texto = preg_replace('/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/is', '$1', $texto);
        
        // Remove <p> ao redor de iframes (com ou sem atributos)
        $texto = preg_replace('/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/is', '$1', $texto);
        
        // Remove <div> vazios ao redor de iframes (se o div só contém o iframe)
        $texto = preg_replace('/<div[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/div>/is', '$1', $texto);
        
        // Remove múltiplos <p> aninhados
        $texto = preg_replace('/<p[^>]*>\s*<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>\s*<\/p>/is', '$1', $texto);
        
        // Remove <p><span> combinados
        $texto = preg_replace('/<p[^>]*>\s*<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>\s*<\/p>/is', '$1', $texto);
        
        return $texto;
    }

    public function getTextoSeguro()
    {
        if (empty($this->Texto)) {
            return '';
        }
        
        try {
            // Limpa tags inválidas ao redor de iframes (causadas pelo TinyMCE)
            $textoLimpo = $this->limparTagsInvalidasAoRedorIframes($this->Texto);
            
            // Se o texto contém iframe do Instagram, processa de forma especial
            // Verifica se há instagram.com e iframe no texto
            $temInstagram = (stripos($textoLimpo, 'instagram.com') !== false);
            $temIframe = (stripos($textoLimpo, '<iframe') !== false);
            
            if ($temInstagram && $temIframe) {
                // Processa permitindo iframes do Instagram diretamente
                return \yii\helpers\HtmlPurifier::process($textoLimpo, [
                    'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style|class]',
                    'HTML.SafeIframe' => true,
                    'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/|www\.instagram\.com/.*/embed/|instagram\.com/.*/embed/)%',
                    'HTML.TidyLevel' => 'none', // Não tenta "corrigir" o HTML
                ]);
            }
            
            // Guarda os embeds originais do Instagram com suas posições
            $instagramEmbeds = [];
            $textoProcessar = $textoLimpo;
            
            // Extrai blockquotes do Instagram (formato padrão de embed)
            preg_match_all('/<blockquote[^>]*class=["\']?instagram-media["\']?[^>]*>.*?<\/blockquote>/is', $textoProcessar, $blockquoteMatches, PREG_OFFSET_CAPTURE);
            
            // Extrai iframes do Instagram - múltiplos padrões
            // Captura iframes com espaços, diferentes formatos de aspas, etc.
            preg_match_all('/<iframe[^>]*src\s*=\s*["\']([^"\']*instagram\.com[^"\']*)["\'][^>]*>\s*<\/iframe>/is', $textoProcessar, $iframeMatches, PREG_OFFSET_CAPTURE);
            
            // Se não encontrou, tenta busca mais ampla (com qualquer conteúdo dentro)
            if (empty($iframeMatches[0])) {
                preg_match_all('/<iframe[^>]*src\s*=\s*["\']([^"\']*instagram\.com[^"\']*)["\'][^>]*>.*?<\/iframe>/is', $textoProcessar, $iframeMatches, PREG_OFFSET_CAPTURE);
            }
            
            // Se ainda não encontrou, busca qualquer iframe com instagram.com
            if (empty($iframeMatches[0])) {
                preg_match_all('/<iframe[^>]*instagram\.com[^>]*>\s*<\/iframe>/is', $textoProcessar, $iframeMatches, PREG_OFFSET_CAPTURE);
            }
            
            // Última tentativa: busca qualquer iframe que contenha instagram
            if (empty($iframeMatches[0])) {
                preg_match_all('/<iframe[^>]*instagram[^>]*>.*?<\/iframe>/is', $textoProcessar, $iframeMatches, PREG_OFFSET_CAPTURE);
            }
            
            // Combina todos os matches e ordena por posição (do final para o início para não afetar índices)
            $allMatches = [];
            
            if (!empty($blockquoteMatches[0])) {
                foreach ($blockquoteMatches[0] as $match) {
                    $allMatches[] = [
                        'html' => $match[0],
                        'offset' => $match[1],
                        'type' => 'blockquote'
                    ];
                }
            }
            
            if (!empty($iframeMatches[0])) {
                foreach ($iframeMatches[0] as $match) {
                    $allMatches[] = [
                        'html' => $match[0],
                        'offset' => $match[1],
                        'type' => 'iframe'
                    ];
                }
            }
            
            // Ordena por offset (do final para o início)
            usort($allMatches, function($a, $b) {
                return $b['offset'] - $a['offset'];
            });
            
            // Substitui do final para o início para manter os índices corretos
            $uniqueId = 0;
            foreach ($allMatches as $match) {
                $placeholder = '___INSTAGRAM_EMBED_' . $uniqueId . '___';
                $instagramEmbeds[$placeholder] = $match['html'];
                $textoProcessar = substr_replace($textoProcessar, $placeholder, $match['offset'], strlen($match['html']));
                $uniqueId++;
            }
            
            // Processa com HtmlPurifier
            $config = [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style|class]',
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/|www\.instagram\.com/.*/embed/|instagram\.com/.*/embed/)%',
            ];
            $purified = \yii\helpers\HtmlPurifier::process($textoProcessar, $config);
            
            // Restaura os embeds do Instagram (HTML puro, sem escape)
            foreach ($instagramEmbeds as $placeholder => $embedHtml) {
                // Tenta substituir o placeholder original e versões escapadas
                $purified = str_replace($placeholder, $embedHtml, $purified);
                $purified = str_replace(htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8'), $embedHtml, $purified);
                $purified = str_replace(htmlentities($placeholder, ENT_QUOTES, 'UTF-8'), $embedHtml, $purified);
            }
            
            return $purified;
        } catch (\Exception $e) {
            // Em caso de erro, retorna versão simplificada sem embeds
            Yii::error('Erro no HtmlPurifier: ' . $e->getMessage());
            $textoFallback = isset($textoLimpo) ? $textoLimpo : $this->Texto;
            return \yii\helpers\HtmlPurifier::process($textoFallback, [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th',
            ]);
        }
    }

    /**
     * Get text as safe HTML for list display (with limited tags)
     *
     * @param int $length
     * @return string
     */
    public function getTextoListaSeguro($length = 150)
    {
        $texto = \yii\helpers\HtmlPurifier::process($this->Texto, [
            'HTML.Allowed' => 'strong,em,u,b,i,span,br',
        ]);
        
        $textoSemTags = strip_tags($texto);
        
        if (strlen($textoSemTags) <= $length) {
            return $texto;
        }
        
        $textoTruncado = substr($textoSemTags, 0, $length);
        $ultimoEspaco = strrpos($textoTruncado, ' ');
        if ($ultimoEspaco !== false) {
            $textoTruncado = substr($textoTruncado, 0, $ultimoEspaco);
        }
        
        return $textoTruncado . '...';
    }

    /**
     * Get formatted title with subtitle
     *
     * @return string
     */
    public function getTituloCompleto()
    {
        if ($this->Sub_Titulo) {
            return $this->Titulo . ': ' . $this->Sub_Titulo;
        }
        return $this->Titulo;
    }

    /**
     * Get latest news
     *
     * @param int $limit
     * @return Noticia[]
     */
    public static function getUltimasNoticias($limit = 5)
    {
        return self::find()
            ->with(['categoria'])
            ->orderBy(['Id' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    /**
     * Get news by category
     *
     * @param int $categoriaId
     * @return Noticia[]
     */
    public static function getNoticiasPorCategoria($categoriaId)
    {
        return self::find()
            ->with(['categoria'])
            ->where(['Id_Categoria' => $categoriaId])
            ->orderBy(['Id' => SORT_DESC])
            ->all();
    }

    /**
     * Search news by title or text
     *
     * @param string $term
     * @return Noticia[]
     */
    public static function buscarNoticias($term)
    {
        return self::find()
            ->with(['categoria'])
            ->where(['or', 
                ['like', 'Titulo', $term],
                ['like', 'Sub_Titulo', $term],
                ['like', 'Texto', $term]
            ])
            ->orderBy(['Id' => SORT_DESC])
            ->all();
    }

    /**
     * Get first image for this news
     *
     * @return Imagem|null
     */
    public function getPrimeiraImagem()
    {
        return $this->hasOne(Imagem::class, ['Id_Noticia' => 'Id'])
            ->orderBy(['Id' => SORT_ASC])
            ->one();
    }

    /**
     * Check if news has images
     *
     * @return bool
     */
    public function temImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id'])->count() > 0;
    }

    /**
     * Get image count
     *
     * @return int
     */
    public function getContagemImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id'])->count();
    }

    /**
     * Generate Instagram embed iframe HTML from post ID or URL
     *
     * @param string $postIdOrUrl Instagram post ID (e.g., "C3gBqVrPSOZ") or full URL
     * @param int $width Width of the iframe (default: 100% for responsive)
     * @param int $height Height of the iframe (default: 480)
     * @return string HTML iframe code
     */
    public static function gerarInstagramEmbed($postIdOrUrl, $width = 100, $height = 480)
    {
        // Extract post ID from URL if full URL is provided
        $postId = $postIdOrUrl;
        if (strpos($postIdOrUrl, 'instagram.com') !== false) {
            // Extract ID from URL like: https://www.instagram.com/p/C3gBqVrPSOZ/
            preg_match('/instagram\.com\/p\/([^\/\?]+)/', $postIdOrUrl, $matches);
            if (!empty($matches[1])) {
                $postId = $matches[1];
            }
        }
        
        // Remove any trailing slashes or query parameters
        $postId = trim($postId, '/');
        
        $widthAttr = is_numeric($width) ? $width . 'px' : $width;
        $heightAttr = is_numeric($height) ? $height . 'px' : $height;
        
        return '<iframe src="https://www.instagram.com/p/' . htmlspecialchars($postId, ENT_QUOTES, 'UTF-8') . '/embed" ' .
               'width="' . htmlspecialchars($widthAttr, ENT_QUOTES, 'UTF-8') . '" ' .
               'height="' . htmlspecialchars($heightAttr, ENT_QUOTES, 'UTF-8') . '" ' .
               'frameborder="0" ' .
               'scrolling="no" ' .
               'allowtransparency="true" ' .
               'class="instagram-embed">' .
               '</iframe>';
    }
} 