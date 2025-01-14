<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Parceiro".
 *
 * @property integer $Id
 * @property string $Nome
 * @property string $Descricao 
 * @property string $Logo
 * @property string $Site
 */
class Parceiro extends \yii\db\ActiveRecord {

    public $Image;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'Parceiro';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Nome', 'Logo', 'Site'], 'required'],
            [['Nome', 'Logo', 'Site'], 'string', 'max' => 255],
            [['Descricao'], 'string', 'max' => 5000],
            [['Image'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
            'Descricao' => 'Descrição', 
            'Logo' => 'Logo',
            'Site' => 'Site',
            'Image' => 'Arquivo',
        ];
    }

}
