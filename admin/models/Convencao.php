<?php

namespace app\models;

use Yii;

class Convencao extends \yii\db\ActiveRecord
{
    public $Image;

    public static function tableName()
    {
        return 'Convencao';
    }

    public function rules()
    {
        return [
            [['Id_Categoria_Convencao', 'Nome'], 'required'],
            [['Id_Categoria_Convencao'], 'integer'],
            [['Nome', 'Url'], 'string', 'max' => 255],
            [['Image'], 'file']
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Categoria_Convencao' => 'Categoria da Convenção',
            'Nome' => 'Nome',
            'Url' => 'Url',
            'Image' => 'Arquivo',
        ];
    }

    public function getIdCategoriaConvencao()
    {
        return $this->hasOne(CategoriaConvencao::className(), ['Id' => 'Id_Categoria_Convencao']);
    }
}