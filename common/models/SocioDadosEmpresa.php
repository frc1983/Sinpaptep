<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "socio_dadosempresa".
 *
 * @property int $Id
 * @property int $Id_Socio
 * @property string $Nome
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
 * @property string $CargoAtual
 * @property string $DataInicioCargoAtual
 * @property string $NumeroCTPS
 * @property string $SerieCTPS
 * @property string|null $NumeroRegistroAutonomo
 * @property string $GrauInstrucao
 * @property string|null $NumeroRegistroDRTE
 * @property string|null $Observacoes
 */
class SocioDadosEmpresa extends ActiveRecord
{
    public static function tableName()
    {
        return 'Socio_DadosEmpresa';
    }

    public function rules()
    {
        return [
            [['Nome', 'Logradouro', 'Numero', 'Bairro', 'Cidade', 'CEP', 'UF', 'Email', 'CargoAtual', 'DataInicioCargoAtual', 'NumeroCTPS', 'SerieCTPS', 'GrauInstrucao', 'Celular'], 'required'],
            [['Id_Socio', 'Numero'], 'integer'],
            ['CEP', 'string', 'max' => 8],
            [['DataInicioCargoAtual'], 'date', 'format' => 'php:Y-m-d'],
            [['Nome', 'Logradouro', 'Complemento', 'Bairro', 'Cidade', 'UF', 'Telefone', 'Celular', 'Email', 'CargoAtual', 'NumeroCTPS', 'SerieCTPS', 'NumeroRegistroAutonomo', 'GrauInstrucao', 'NumeroRegistroDRTE', 'Observacoes'], 'string', 'max' => 255],
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
            'Nome' => 'Nome da Empresa',
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
            'CargoAtual' => 'Cargo Atual',
            'DataInicioCargoAtual' => 'Data Início Cargo Atual',
            'NumeroCTPS' => 'Número CTPS',
            'SerieCTPS' => 'Série CTPS',
            'NumeroRegistroAutonomo' => 'Nº Registro Autônomo',
            'GrauInstrucao' => 'Grau de Instrução',
            'NumeroRegistroDRTE' => 'Nº Registro DRTE',
            'Observacoes' => 'Observações',
        ];
    }
} 