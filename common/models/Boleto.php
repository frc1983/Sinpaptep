<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Boleto".
 *
 * @property int $Id
 * @property string $Nome
 * @property int $CNPJ
 * @property string $Endereco
 * @property int $CEP
 * @property string $Cidade
 * @property string $Valor
 * @property string $DataVencimento
 * @property string $Multa
 * @property string $DespesaBancaria
 * @property string $DataGeracaoBoleto
 */
class Boleto extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Boleto';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // TimestampBehavior removido
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome', 'CNPJ', 'Endereco', 'CEP', 'Cidade', 'Valor', 'DataVencimento', 'DespesaBancaria', 'DataGeracaoBoleto'], 'required'],
            [['CNPJ', 'CEP'], 'match', 'pattern' => '/^\d+$/', 'message' => 'Somente números são permitidos.'],
            [['CNPJ'], 'string', 'max' => 14],
            [['CEP'], 'string', 'max' => 8],
            [['Valor', 'Multa', 'DespesaBancaria'], 'number'],
            [['DataVencimento', 'DataGeracaoBoleto'], 'safe'],
            [['Nome', 'Endereco', 'Cidade'], 'string', 'max' => 255],
            [['DataVencimento', 'DataGeracaoBoleto'], 'validateDateNotPast'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
            'CNPJ' => 'CNPJ',
            'Endereco' => 'Endereço',
            'CEP' => 'CEP',
            'Cidade' => 'Cidade',
            'Valor' => 'Valor',
            'DataVencimento' => 'Data de Vencimento',
            'Multa' => 'Multa',
            'DespesaBancaria' => 'Despesa Bancária',
            'DataGeracaoBoleto' => 'Data de Geração do Boleto',
        ];
    }

    /**
     * Formata o valor para exibição
     */
    public function getValorFormatado()
    {
        return 'R$ ' . number_format($this->Valor, 2, ',', '.');
    }

    /**
     * Formata a multa para exibição
     */
    public function getMultaFormatada()
    {
        return $this->Multa ? 'R$ ' . number_format($this->Multa, 2, ',', '.') : 'N/A';
    }

    /**
     * Formata a despesa bancária para exibição
     */
    public function getDespesaBancariaFormatada()
    {
        return 'R$ ' . number_format($this->DespesaBancaria, 2, ',', '.');
    }

    /**
     * Formata o CNPJ para exibição
     */
    public function getCNPJFormatado()
    {
        $cnpj = str_pad($this->CNPJ, 14, '0', STR_PAD_LEFT);
        return substr($cnpj, 0, 2) . '.' . 
               substr($cnpj, 2, 3) . '.' . 
               substr($cnpj, 5, 3) . '/' . 
               substr($cnpj, 8, 4) . '-' . 
               substr($cnpj, 12, 2);
    }

    /**
     * Formata o CEP para exibição
     */
    public function getCEPFormatado()
    {
        $cep = str_pad($this->CEP, 8, '0', STR_PAD_LEFT);
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    /**
     * Verifica se o boleto está vencido
     */
    public function isVencido()
    {
        return strtotime($this->DataVencimento) < time();
    }

    /**
     * Calcula o valor total (valor + multa + despesa bancária)
     */
    public function getValorTotal()
    {
        $total = $this->Valor + $this->DespesaBancaria;
        if ($this->Multa) {
            $total += $this->Multa;
        }
        return $total;
    }

    /**
     * Formata o valor total para exibição
     */
    public function getValorTotalFormatado()
    {
        return 'R$ ' . number_format($this->getValorTotal(), 2, ',', '.');
    }

    /**
     * Valida se a data não é menor que o dia atual
     */
    public function validateDateNotPast($attribute, $params)
    {
        if (!empty($this->$attribute)) {
            $dataInformada = strtotime($this->$attribute);
            $hoje = strtotime(date('Y-m-d'));
            if ($dataInformada < $hoje) {
                $this->addError($attribute, 'A data não pode ser menor que o dia atual.');
            }
        }
    }
} 