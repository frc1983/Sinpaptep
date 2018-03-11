<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "boleto".
 *
 * @property integer $Id
 * @property string $Nome
 * @property integer $CNPJ
 * @property string $Endereco
 * @property integer $CEP
 * @property string $Cidade
 * @property string $Valor
 * @property string $DataVencimento
 * @property string $Multa
 * @property string $DespesaBancaria
 * @property string $DataGeracaoBoleto
 */
class Boleto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Boleto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'CNPJ', 'Endereco', 'CEP', 'Cidade', 'Valor', 'DataVencimento', 'DespesaBancaria', 'DataGeracaoBoleto'], 'required'],
            [['CNPJ', 'CEP'], 'integer'],
            [['Valor', 'Multa', 'DespesaBancaria'], 'number'],
            [['DataVencimento', 'DataGeracaoBoleto'], 'safe'],
            [['Nome', 'Endereco', 'Cidade'], 'string', 'max' => 255]
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
            'CNPJ' => 'Cnpj',
            'Endereco' => 'Endereco',
            'CEP' => 'Cep',
            'Cidade' => 'Cidade',
            'Valor' => 'Valor',
            'DataVencimento' => 'Data Vencimento',
            'Multa' => 'Multa',
            'DespesaBancaria' => 'Despesa Bancaria',
            'DataGeracaoBoleto' => 'Data Geracao Boleto',
        ];
    }
}
