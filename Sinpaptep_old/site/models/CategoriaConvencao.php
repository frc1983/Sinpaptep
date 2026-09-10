<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_convencao".
 *
 * @property integer $Id
 * @property string $Nome
 *
 * @property Convencao[] $convencaos
 */
class CategoriaConvencao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_convencao';
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
    public function getConvencaos()
    {
        return $this->hasMany(Convencao::className(), ['Id_Categoria_Convencao' => 'Id']);
    }
}
