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
        return 'noticia';
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
        ];
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
        
        // Allow only basic HTML tags
        $allowedTags = '<strong><em><u><b><i><span>';
        $textoLimpo = strip_tags($texto, $allowedTags);
        
        // Remove HTML tags for length calculation
        $textoSemTags = strip_tags($texto);
        
        if (strlen($textoSemTags) <= $length) {
            return $textoLimpo;
        }
        
        // Truncate text
        $textoTruncado = substr($textoSemTags, 0, $length);
        
        // Find the last complete word
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
} 