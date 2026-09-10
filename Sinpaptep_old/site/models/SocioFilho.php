<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socio_filho".
 *
 * @property integer $Id
 * @property integer $Id_Socio
 * @property string $Nome
 * @property string $DataNascimento
 *
 * @property Socio $idSocio
 */
class SocioFilho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Socio_Filho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Socio', 'Nome', 'DataNascimento'], 'required'],
            [['Id', 'Id_Socio'], 'integer'],
            [['DataNascimento'], 'safe'],
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
            'Id_Socio' => 'Id  Socio',
            'Nome' => 'Nome',
            'DataNascimento' => 'Data Nascimento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSocio()
    {
        return $this->hasOne(Socio::className(), ['Id' => 'Id_Socio']);
    }
}
