<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parceiro".
 *
 * @property integer $Id
 * @property string $Nome
 * @property string $Logo
 * @property string $Site
 */
class Parceiro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Parceiro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Logo', 'Site'], 'required'],
            [['Nome', 'Logo', 'Site'], 'string', 'max' => 255]
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
            'Logo' => 'Logo',
            'Site' => 'Site',
        ];
    }
}
