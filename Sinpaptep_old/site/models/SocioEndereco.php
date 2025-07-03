<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socio_endereco".
 *
 * @property integer $Id
 * @property integer $Id_Socio
 * @property string $Logradouro
 * @property integer $Numero
 * @property string $Complemento
 * @property string $Bairro
 * @property string $Cidade
 * @property integer $CEP
 * @property string $UF
 * @property string $Telefone
 * @property string $Celular
 * @property string $Email
 *
 * @property Socio $idSocio
 */
class SocioEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Socio_Endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Socio', 'Logradouro', 'Numero', 'Bairro', 'Cidade', 'CEP', 'UF', 'Telefone', 'Email'], 'required'],
            [['Id', 'Id_Socio', 'Numero', 'CEP'], 'integer'],
            [['Logradouro', 'Complemento', 'Bairro', 'Cidade', 'Telefone', 'Celular', 'Email'], 'string', 'max' => 255],
            [['UF'], 'string', 'max' => 2]
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
            'Logradouro' => 'Logradouro',
            'Numero' => 'Numero',
            'Complemento' => 'Complemento',
            'Bairro' => 'Bairro',
            'Cidade' => 'Cidade',
            'CEP' => 'Cep',
            'UF' => 'Uf',
            'Telefone' => 'Telefone',
            'Celular' => 'Celular',
            'Email' => 'Email',
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
