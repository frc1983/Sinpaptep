<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Categoria_Noticia".
 *
 * @property integer $Id
 * @property string $Nome
 *
 * @property Noticia[] $noticias
 */
class Categoria_Noticia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Categoria_Noticia';
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
    
    public static function getAll() {
        $data = Categoria_Noticia::find()->asArray()->all();

        return $data;
    }
}
