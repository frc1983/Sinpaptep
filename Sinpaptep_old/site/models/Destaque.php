<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "destaque".
 *
 * @property integer $Id
 * @property string $Titulo
 * @property string $Resumo
 * @property string $Link
 */
class Destaque extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Destaque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Titulo', 'Link'], 'required'],
            [['Titulo', 'Resumo', 'Link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Titulo' => 'Titulo',
            'Resumo' => 'Resumo',
            'Link' => 'Link',
        ];
    }
    
    public static function getLast($qtd){
        return Destaque::find()->orderBy('id desc')->limit($qtd)->all();
    }
}
