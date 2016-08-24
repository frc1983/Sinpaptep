<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "convencao".
 *
 * @property integer $Id
 * @property integer $Id_Categoria_Convencao
 * @property string $Nome
 * @property string $Url
 *
 * @property CategoriaConvencao $idCategoriaConvencao
 */
class Convencao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Convencao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Categoria_Convencao', 'Nome', 'Url'], 'required'],
            [['Id_Categoria_Convencao'], 'integer'],
            [['Nome', 'Url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Categoria_Convencao' => 'Id  Categoria  Convencao',
            'Nome' => 'Nome',
            'Url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoriaConvencao()
    {
        return $this->hasOne(CategoriaConvencao::className(), ['Id' => 'Id_Categoria_Convencao']);
    }
}
