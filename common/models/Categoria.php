<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "categoria_noticia".
 *
 * @property int $Id
 * @property string $Nome
 */
class Categoria extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_noticia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::class, ['Id_Categoria' => 'Id']);
    }

    /**
     * Get count of news in this category
     *
     * @return int
     */
    public function getContagemNoticias()
    {
        return $this->getNoticias()->count();
    }

    /**
     * Get all categories with news count
     *
     * @return Categoria[]
     */
    public static function getCategoriasComContagem()
    {
        return self::find()
            ->select(['categoria_noticia.*', 'COUNT(noticia.Id) as contagem'])
            ->leftJoin('noticia', 'categoria_noticia.Id = noticia.Id_Categoria')
            ->groupBy(['categoria_noticia.Id'])
            ->orderBy(['categoria_noticia.Nome' => SORT_ASC])
            ->all();
    }

    /**
     * Get categories for dropdown
     *
     * @return array
     */
    public static function getListaCategorias()
    {
        return self::find()
            ->select(['Id', 'Nome'])
            ->orderBy(['Nome' => SORT_ASC])
            ->asArray()
            ->all();
    }

    /**
     * Get all categories ordered by name
     *
     * @return Categoria[]
     */
    public static function getTodasCategorias()
    {
        return self::find()
            ->orderBy(['Nome' => SORT_ASC])
            ->all();
    }

    /**
     * Get category by ID
     *
     * @param int $id
     * @return Categoria|null
     */
    public static function findById($id)
    {
        return self::findOne($id);
    }

    /**
     * Get category by name
     *
     * @param string $nome
     * @return Categoria|null
     */
    public static function findByNome($nome)
    {
        return self::find()
            ->where(['Nome' => $nome])
            ->one();
    }

    /**
     * Get categories with news
     *
     * @return Categoria[]
     */
    public static function getCategoriasComNoticias()
    {
        return self::find()
            ->select(['categoria_noticia.*'])
            ->innerJoin('noticia', 'categoria_noticia.Id = noticia.Id_Categoria')
            ->groupBy(['categoria_noticia.Id'])
            ->orderBy(['categoria_noticia.Nome' => SORT_ASC])
            ->all();
    }

    /**
     * Get category display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->Nome;
    }

    /**
     * Get category badge HTML
     *
     * @return string
     */
    public function getBadgeHtml()
    {
        $colors = [
            'Sindicato' => 'primary',
            'Geral' => 'secondary',
        ];
        
        $color = $colors[$this->Nome] ?? 'info';
        
        return '<span class="badge bg-' . $color . '">' . Html::encode($this->Nome) . '</span>';
    }

    /**
     * Get category icon
     *
     * @return string
     */
    public function getIcone()
    {
        $icones = [
            'Sindicato' => 'fas fa-users',
            'Geral' => 'fas fa-newspaper',
        ];
        
        return $icones[$this->Nome] ?? 'fas fa-tag';
    }

    /**
     * Get category color
     *
     * @return string
     */
    public function getCor()
    {
        $cores = [
            'Sindicato' => '#007bff',
            'Geral' => '#6c757d',
        ];
        
        return $cores[$this->Nome] ?? '#17a2b8';
    }
} 