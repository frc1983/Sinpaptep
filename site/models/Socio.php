<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socio".
 *
 * @property integer $Id
 * @property string $Nome
 * @property integer $CPF
 * @property string $CidadeNascimento
 * @property string $DataNascimento
 * @property string $EstadoCivil
 * @property string $Nacionalidade
 * @property string $Identidade
 * @property string $OrgaoEmissor
 * @property string $TituloEleitor
 * @property string $DataExpiracaoTituloEleitor
 * @property string $UFTituloEleitor
 * @property string $NomeMae
 * @property string $NomePai
 * @property string $NomeConjuge
 * @property string $DataNascimentoConjuge
 *
 * @property SocioDadosempresa $socioDadosempresas
 * @property SocioEndereco $socioEnderecos
 * @property SocioFilho[] $socioFilhos
 */
class Socio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Socio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'CPF', 'CidadeNascimento', 'DataNascimento', 'EstadoCivil', 'Nacionalidade', 'Identidade', 'OrgaoEmissor', 'NomeMae'], 'required'],
            [['Id', 'CPF'], 'integer'],
            [['DataNascimento', 'DataExpiracaoTituloEleitor', 'DataNascimentoConjuge'], 'safe'],
            [['Nome', 'CidadeNascimento', 'EstadoCivil', 'Nacionalidade', 'Identidade', 'OrgaoEmissor', 'TituloEleitor', 'NomeMae', 'NomePai', 'NomeConjuge'], 'string', 'max' => 255],
            [['UFTituloEleitor'], 'string', 'max' => 2]
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
            'CPF' => 'Cpf',
            'CidadeNascimento' => 'Cidade Nascimento',
            'DataNascimento' => 'Data Nascimento',
            'EstadoCivil' => 'Estado Civil',
            'Nacionalidade' => 'Nacionalidade',
            'Identidade' => 'Identidade',
            'OrgaoEmissor' => 'Orgao Emissor',
            'TituloEleitor' => 'Titulo Eleitor',
            'DataExpiracaoTituloEleitor' => 'Data Expiracao Titulo Eleitor',
            'UFTituloEleitor' => 'Uftitulo Eleitor',
            'NomeMae' => 'Nome Mae',
            'NomePai' => 'Nome Pai',
            'NomeConjuge' => 'Nome Conjuge',
            'DataNascimentoConjuge' => 'Data Nascimento Conjuge',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocioDadosempresas()
    {
        return $this->hasOne(SocioDadosEmpresa::className(), ['Id_Socio' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocioEnderecos()
    {
        return $this->hasOne(SocioEndereco::className(), ['Id_Socio' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocioFilhos()
    {
        return $this->hasMany(SocioFilho::className(), ['Id_Socio' => 'Id']);
    }
}
