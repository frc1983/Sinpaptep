<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socio_dadosempresa".
 *
 * @property integer $Id
 * @property integer $Id_Socio
 * @property string $Nome
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
 * @property string $CargoAtual
 * @property string $DataInicioCargoAtual
 * @property string $NumeroCTPS
 * @property string $SerieCTPS
 * @property string $NumeroRegistroAutonomo
 * @property string $GrauInstrucao
 * @property string $NumeroRegistroDRTE
 * @property string $Observacoes
 *
 * @property Socio $idSocio
 */
class SocioDadosEmpresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Socio_DadosEmpresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Socio', 'Nome', 'Logradouro', 'Numero', 'Bairro', 'Cidade', 'CEP', 'UF', 'Telefone', 'Email', 'CargoAtual', 'DataInicioCargoAtual', 'NumeroCTPS', 'SerieCTPS', 'GrauInstrucao'], 'required'],
            [['Id', 'Id_Socio', 'Numero', 'CEP'], 'integer'],
            [['DataInicioCargoAtual'], 'safe'],
            [['Nome', 'Logradouro', 'Complemento', 'Bairro', 'Cidade', 'Telefone', 'Celular', 'Email', 'CargoAtual', 'NumeroCTPS', 'SerieCTPS', 'NumeroRegistroAutonomo', 'GrauInstrucao', 'NumeroRegistroDRTE', 'Observacoes'], 'string', 'max' => 255],
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
            'Nome' => 'Nome',
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
            'CargoAtual' => 'Cargo Atual',
            'DataInicioCargoAtual' => 'Data Inicio Cargo Atual',
            'NumeroCTPS' => 'Numero Ctps',
            'SerieCTPS' => 'Serie Ctps',
            'NumeroRegistroAutonomo' => 'Numero Registro Autonomo',
            'GrauInstrucao' => 'Grau Instrucao',
            'NumeroRegistroDRTE' => 'Numero Registro Drte',
            'Observacoes' => 'Observacoes',
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
