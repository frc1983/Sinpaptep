<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_noticia".
 *
 * @property integer $Id
 * @property string $Nome
 *
 * @property Noticia[] $noticias
 */
class CategoriaNoticia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['Id_Categoria' => 'Id']);
    }
}
