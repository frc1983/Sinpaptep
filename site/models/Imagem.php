<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Imagem".
 *
 * @property integer $Id
 * @property integer $Id_Noticia
 * @property string $Url
 *
 * @property Noticia $idNoticia
 */
class Imagem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Imagem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Noticia', 'Url'], 'required'],
            [['Id_Noticia'], 'integer'],
            [['Url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Noticia' => 'Id  Noticia',
            'Url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNoticia()
    {
        return $this->hasOne(Noticia::className(), ['Id' => 'Id_Noticia']);
    }
}
