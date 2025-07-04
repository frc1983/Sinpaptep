<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "imagem".
 *
 * @property int $Id
 * @property int $Id_Noticia
 * @property string $Url
 * 
 * @property Noticia $noticia
 */
class Imagem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Imagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_Noticia', 'Url'], 'required'],
            [['Id_Noticia'], 'integer'],
            [['Url'], 'string', 'max' => 255],
            [['Url'], 'url'],
            [['Id_Noticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticia::class, 'targetAttribute' => ['Id_Noticia' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Noticia' => 'Notícia',
            'Url' => 'URL da Imagem',
        ];
    }

    /**
     * Gets query for [[Noticia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::class, ['Id' => 'Id_Noticia']);
    }

    /**
     * Get noticia title
     *
     * @return string
     */
    public function getNoticiaTitulo()
    {
        return $this->noticia ? $this->noticia->Titulo : 'Notícia não encontrada';
    }

    /**
     * Get images by news ID
     *
     * @param int $noticiaId
     * @return Imagem[]
     */
    public static function getImagensPorNoticia($noticiaId)
    {
        return self::find()
            ->where(['Id_Noticia' => $noticiaId])
            ->orderBy(['Id' => SORT_ASC])
            ->all();
    }

    /**
     * Get first image for a news
     *
     * @param int $noticiaId
     * @return Imagem|null
     */
    public static function getPrimeiraImagem($noticiaId)
    {
        return self::find()
            ->where(['Id_Noticia' => $noticiaId])
            ->orderBy(['Id' => SORT_ASC])
            ->one();
    }

    /**
     * Get image count for a news
     *
     * @param int $noticiaId
     * @return int
     */
    public static function getContagemImagens($noticiaId)
    {
        return self::find()
            ->where(['Id_Noticia' => $noticiaId])
            ->count();
    }

    /**
     * Check if image URL is valid
     *
     * @return bool
     */
    public function isUrlValida()
    {
        return filter_var($this->Url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Get image filename from URL
     *
     * @return string
     */
    public function getNomeArquivo()
    {
        return basename($this->Url);
    }

    /**
     * Get image extension
     *
     * @return string
     */
    public function getExtensao()
    {
        $pathInfo = pathinfo($this->Url);
        return isset($pathInfo['extension']) ? strtolower($pathInfo['extension']) : '';
    }

    /**
     * Check if image is an image file
     *
     * @return bool
     */
    public function isImagem()
    {
        $extensao = $this->getExtensao();
        return in_array($extensao, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }
} 