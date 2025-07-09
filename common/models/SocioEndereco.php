<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "socio_endereco".
 *
 * @property int $Id
 * @property int $Id_Socio
 * @property string $Logradouro
 * @property int $Numero
 * @property string|null $Complemento
 * @property string $Bairro
 * @property string $Cidade
 * @property int $CEP
 * @property string $UF
 * @property string $Telefone
 * @property string|null $Celular
 * @property string $Email
 */
class SocioEndereco extends ActiveRecord
{
    public static function tableName()
    {
        return 'Socio_Endereco';
    }

    public function rules()
    {
        return [
            [['Logradouro', 'Numero', 'Bairro', 'Cidade', 'CEP', 'UF', 'Celular', 'Email'], 'required'],
            [['Id_Socio', 'Numero'], 'integer'],
            ['CEP', 'string', 'max' => 8],
            [['Logradouro', 'Complemento', 'Bairro', 'Cidade', 'UF', 'Telefone', 'Celular', 'Email'], 'string', 'max' => 255],
            [['Telefone', 'Celular'], 'filter', 'filter' => function($value) { return preg_replace('/\D/', '', $value); }],
            [['Telefone', 'Celular'], 'validatePhone'],
        ];
    }

    /**
     * Validação personalizada para telefone e celular
     */
    public function validatePhone($attribute, $params)
    {
        $value = preg_replace('/\D/', '', $this->$attribute);
        if (strlen($value) < 10 || strlen($value) > 11) {
            $this->addError($attribute, 'Telefone/Celular deve ter 10 ou 11 dígitos.');
        }
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Id_Socio' => 'Sócio',
            'Logradouro' => 'Logradouro',
            'Numero' => 'Número',
            'Complemento' => 'Complemento',
            'Bairro' => 'Bairro',
            'Cidade' => 'Cidade',
            'CEP' => 'CEP',
            'UF' => 'UF',
            'Telefone' => 'Telefone',
            'Celular' => 'Celular',
            'Email' => 'E-mail',
        ];
    }
} 