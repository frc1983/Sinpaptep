<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

    /**
     * This is the model class for table "socio".
     *
     * @property int $Id
     * @property string $Nome
     * @property string $CPF
     * @property string $CidadeNascimento
     * @property string $DataNascimento
     * @property string $EstadoCivil
     * @property string $Nacionalidade
     * @property string $Identidade
     * @property string $OrgaoEmissor
     * @property string|null $TituloEleitor
     * @property string|null $DataExpiracaoTituloEleitor
     * @property string|null $UFTituloEleitor
     * @property string $NomeMae
     * @property string|null $NomePai
     * @property string|null $NomeConjuge
     * @property string|null $DataNascimentoConjuge
     */
class Socio extends ActiveRecord
{
    public static function tableName()
    {
        return 'Socio';
    }

    public function rules()
    {
        return [
            [['Nome', 'CPF', 'CidadeNascimento', 'DataNascimento', 'EstadoCivil', 'Nacionalidade', 'Identidade', 'OrgaoEmissor', 'NomeMae'], 'required'],
            ['CPF', 'filter', 'filter' => function($value) { return preg_replace('/\D/', '', $value); }],
            ['CPF', 'string', 'max' => 11, 'message' => 'CPF deve ter no máximo 11 dígitos.'],
            [['DataNascimento', 'DataExpiracaoTituloEleitor', 'DataNascimentoConjuge'], 'date', 'format' => 'php:Y-m-d'],
            [['Nome', 'CidadeNascimento', 'EstadoCivil', 'Nacionalidade', 'Identidade', 'OrgaoEmissor', 'TituloEleitor', 'NomeMae', 'NomePai', 'NomeConjuge', 'UFTituloEleitor'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
            'CPF' => 'CPF',
            'CidadeNascimento' => 'Cidade de Nascimento',
            'DataNascimento' => 'Data de Nascimento',
            'EstadoCivil' => 'Estado Civil',
            'Nacionalidade' => 'Nacionalidade',
            'Identidade' => 'Identidade',
            'OrgaoEmissor' => 'Órgão Emissor',
            'TituloEleitor' => 'Título de Eleitor',
            'DataExpiracaoTituloEleitor' => 'Data Expiração Título Eleitor',
            'UFTituloEleitor' => 'UF Título Eleitor',
            'NomeMae' => 'Nome da Mãe',
            'NomePai' => 'Nome do Pai',
            'NomeConjuge' => 'Nome do Cônjuge',
            'DataNascimentoConjuge' => 'Data de Nascimento do Cônjuge',
        ];
    }

    /**
     * Relação com os dados da empresa
     */
    public function getDadosEmpresa()
    {
        return $this->hasOne(SocioDadosEmpresa::class, ['Id_Socio' => 'Id']);
    }

    /**
     * Getter para Telefone (da empresa)
     */
    public function getTelefone()
    {
        return $this->dadosEmpresa ? $this->dadosEmpresa->Telefone : null;
    }

    /**
     * Getter para Celular (da empresa)
     */
    public function getCelular()
    {
        return $this->dadosEmpresa ? $this->dadosEmpresa->Celular : null;
    }
} 