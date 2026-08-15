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
 * @property string|null $Instagram_Url
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
            [['Instagram_Url'], 'string', 'max' => 500],
            [['Instagram_Url'], 'url', 'skipOnEmpty' => true, 'validSchemes' => ['http', 'https'],
                'message' => 'Informe uma URL válida do Instagram (ex: https://www.instagram.com/p/CODE/)'],
            [['imagemFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10],
            [['Id_Categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['Id_Categoria' => 'Id']],
            ['Texto', 'validateTexto'],
        ];
    }

    /**
     * Limpa o texto antes de salvar
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->Texto)) {
                $this->Texto = html_entity_decode($this->Texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $this->Texto = $this->limparTagsInvalidasAoRedorIframes($this->Texto);
                $this->Texto = preg_replace('/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/is', '$1', $this->Texto);
            }

            // Normaliza a URL do Instagram: remove parâmetros desnecessários
            if (!empty($this->Instagram_Url)) {
                $this->Instagram_Url = $this->normalizarInstagramUrl($this->Instagram_Url);
            }

            return true;
        }
        return false;
    }

    /**
     * Normaliza a URL do Instagram removendo query strings e garantindo formato correto
     */
    private function normalizarInstagramUrl($url)
    {
        // Remove query string e fragmento
        $url = strtok($url, '?');
        $url = strtok($url, '#');
        // Garante barra no final
        $url = rtrim($url, '/') . '/';
        return $url;
    }

    /**
     * Extrai o embed ID do Instagram a partir da URL armazenada
     * Suporta: https://www.instagram.com/p/CODE/
     *          https://www.instagram.com/reel/CODE/
     *          https://instagram.com/p/CODE/
     */
    public function getInstagramEmbedUrl()
    {
        if (empty($this->Instagram_Url)) {
            return null;
        }

        // Tenta extrair /p/CODE ou /reel/CODE
        if (preg_match('#instagram\.com/(p|reel|tv)/([^/?#]+)#i', $this->Instagram_Url, $m)) {
            return 'https://www.instagram.com/' . $m[1] . '/' . $m[2] . '/embed/';
        }

        return null;
    }

    /**
     * Retorna se esta notícia tem um post do Instagram vinculado
     */
    public function temInstagram()
    {
        return !empty($this->Instagram_Url) && $this->getInstagramEmbedUrl() !== null;
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
     * Limpa tags inválidas ao redor de iframes
     */
    private function limparTagsInvalidasAoRedorIframes($texto)
    {
        // Remove <p> ao redor de iframes
        $texto = preg_replace('/<p[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/p>/is', '$1', $texto);
        // Remove <span> ao redor de iframes
        $texto = preg_replace('/<span[^>]*>\s*(<iframe[^>]*>.*?<\/iframe>)\s*<\/span>/is', '$1', $texto);
        return $texto;
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
            'Instagram_Url' => 'Post do Instagram',
            'imagemFile' => 'Imagem',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['Id' => 'Id_Categoria']);
    }

    /**
     * Gets query for [[Imagens]].
     */
    public function getImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id']);
    }

    /**
     * Gets query for [[Imagem]] (first image).
     */
    public function getImagem()
    {
        return $this->hasOne(Imagem::class, ['Id_Noticia' => 'Id'])
            ->orderBy(['Id' => SORT_ASC]);
    }

    /**
     * Get categoria name
     */
    public function getCategoriaNome()
    {
        return $this->categoria ? $this->categoria->Nome : 'Sem categoria';
    }

    /**
     * Get short text (first 200 characters)
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
     */
    public function getTextoResumidoHtml($length = 200)
    {
        $texto = $this->Texto;
        $textoSemTags = strip_tags($texto);

        if (strlen($textoSemTags) <= $length) {
            return $texto;
        }

        $textoTruncado = substr($textoSemTags, 0, $length);
        $ultimoEspaco = strrpos($textoTruncado, ' ');
        if ($ultimoEspaco !== false) {
            $textoTruncado = substr($textoTruncado, 0, $ultimoEspaco);
        }

        $allowedTags = ['strong', 'em', 'u', 'b', 'i', 'span', 'p', 'br', 'div'];
        $textoLimpo = strip_tags($texto, '<' . implode('><', $allowedTags) . '>');

        $posicao = strpos($textoLimpo, $textoTruncado);
        if ($posicao !== false) {
            $resultado = substr($textoLimpo, 0, $posicao + strlen($textoTruncado));
            return $resultado . '...';
        }

        return $textoTruncado . '...';
    }

    /**
     * Get text as safe HTML
     */
    public function getTextoSeguro()
    {
        try {
            $textoProcessar = $this->Texto;
            $instagramEmbeds = [];

            // Preserva iframes do Instagram antes do purifier
            preg_match_all('/<iframe[^>]*instagram[^>]*>.*?<\/iframe>/is', $textoProcessar, $iframeMatches, PREG_OFFSET_CAPTURE);
            preg_match_all('/<blockquote[^>]*instagram[^>]*>.*?<\/blockquote>/is', $textoProcessar, $blockquoteMatches, PREG_OFFSET_CAPTURE);

            $allMatches = [];
            if (!empty($iframeMatches[0])) {
                foreach ($iframeMatches[0] as $match) {
                    $allMatches[] = ['html' => $match[0], 'offset' => $match[1]];
                }
            }
            if (!empty($blockquoteMatches[0])) {
                foreach ($blockquoteMatches[0] as $match) {
                    $allMatches[] = ['html' => $match[0], 'offset' => $match[1]];
                }
            }

            usort($allMatches, function ($a, $b) { return $b['offset'] - $a['offset']; });

            $uniqueId = 0;
            foreach ($allMatches as $match) {
                $placeholder = '___INSTAGRAM_EMBED_' . $uniqueId . '___';
                $instagramEmbeds[$placeholder] = $match['html'];
                $textoProcessar = substr_replace($textoProcessar, $placeholder, $match['offset'], strlen($match['html']));
                $uniqueId++;
            }

            $config = [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th,iframe[src|width|height|frameborder|scrolling|allowtransparency|allowfullscreen|style|class]',
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/|www\.instagram\.com/.*/embed/|instagram\.com/.*/embed/)%',
            ];
            $purified = \yii\helpers\HtmlPurifier::process($textoProcessar, $config);

            foreach ($instagramEmbeds as $placeholder => $embedHtml) {
                $purified = str_replace($placeholder, $embedHtml, $purified);
                $purified = str_replace(htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8'), $embedHtml, $purified);
            }

            return $purified;
        } catch (\Exception $e) {
            Yii::error('Erro no HtmlPurifier: ' . $e->getMessage());
            return \yii\helpers\HtmlPurifier::process($this->Texto, [
                'HTML.Allowed' => 'p,br,strong,em,u,b,i,span,div,h1,h2,h3,h4,h5,h6,ul,ol,li,a[href|title],img[src|alt|title|width|height],blockquote,code,pre,table,thead,tbody,tr,td,th',
            ]);
        }
    }

    /**
     * Get text as safe HTML for list display
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
     */
    public function getPrimeiraImagem()
    {
        return $this->hasOne(Imagem::class, ['Id_Noticia' => 'Id'])
            ->orderBy(['Id' => SORT_ASC])
            ->one();
    }

    /**
     * Check if news has images
     */
    public function temImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id'])->count() > 0;
    }

    /**
     * Get image count
     */
    public function getContagemImagens()
    {
        return $this->hasMany(Imagem::class, ['Id_Noticia' => 'Id'])->count();
    }

    /**
     * Generate Instagram embed iframe HTML from post ID or URL
     */
    public static function gerarInstagramEmbed($postIdOrUrl, $width = 100, $height = 480)
    {
        $postId = $postIdOrUrl;
        if (strpos($postIdOrUrl, 'instagram.com') !== false) {
            preg_match('/instagram\.com\/p\/([^\/\?]+)/', $postIdOrUrl, $matches);
            if (!empty($matches[1])) {
                $postId = $matches[1];
            }
        }
        $postId = trim($postId, '/');
        $widthAttr = is_numeric($width) ? $width . 'px' : $width;
        $heightAttr = is_numeric($height) ? $height . 'px' : $height;

        return '<iframe src="https://www.instagram.com/p/' . htmlspecialchars($postId, ENT_QUOTES, 'UTF-8') . '/embed" ' .
               'width="' . htmlspecialchars($widthAttr, ENT_QUOTES, 'UTF-8') . '" ' .
               'height="' . htmlspecialchars($heightAttr, ENT_QUOTES, 'UTF-8') . '" ' .
               'frameborder="0" scrolling="no" allowtransparency="true" class="instagram-embed">' .
               '</iframe>';
    }
}
