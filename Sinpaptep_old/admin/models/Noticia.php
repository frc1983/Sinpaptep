<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Noticia".
 *
 * @property integer $Id
 * @property integer $Id_Categoria
 * @property string $Titulo
 * @property string $Sub_Titulo
 * @property string $Texto
 *
 * @property Imagem[] $imagems
 * @property CategoriaNoticia $idCategoria
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Categoria', 'Titulo', 'Texto'], 'required'],
            [['Id_Categoria'], 'integer'],
            [['Texto'], 'string'],
            [['Titulo', 'Sub_Titulo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Categoria' => 'Id  Categoria',
            'Titulo' => 'Titulo',
            'Sub_Titulo' => 'Sub  Titulo',
            'Texto' => 'Texto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::className(), ['Id_Noticia' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria()
    {
        return $this->hasOne(CategoriaNoticia::className(), ['Id' => 'Id_Categoria']);
    }
}
