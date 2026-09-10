<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Model para a tabela Aviso_Modal.
 *
 * @property int         $Id
 * @property string      $Titulo
 * @property string      $Conteudo
 * @property bool        $Ativo
 * @property string|null $Criado_Em
 * @property string|null $Atualizado_Em
 */
class AvisoModal extends ActiveRecord
{
    public static function tableName()
    {
        return 'Aviso_Modal';
    }

    public function rules()
    {
        return [
            [['Titulo', 'Conteudo'], 'required'],
            [['Titulo'], 'string', 'max' => 255],
            [['Conteudo'], 'string'],
            [['Ativo'], 'boolean'],
            [['Ativo'], 'default', 'value' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id'            => 'ID',
            'Titulo'        => 'Título',
            'Conteudo'      => 'Conteúdo',
            'Ativo'         => 'Exibir no site',
            'Criado_Em'     => 'Criado em',
            'Atualizado_Em' => 'Atualizado em',
        ];
    }

    /**
     * Retorna o aviso ativo para exibir no modal da home.
     * Se houver mais de um ativo, retorna o mais recente.
     */
    public static function getAtivoParaSite(): ?self
    {
        return static::find()
            ->where(['Ativo' => true])
            ->orderBy(['Id' => SORT_DESC])
            ->one();
    }

    /**
     * Ao ativar este aviso, desativa todos os outros (apenas um ativo por vez).
     * Também decodifica o HTML que o TinyMCE pode escapar antes de salvar.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Decodifica HTML escapado pelo TinyMCE (ex: &lt;p&gt; → <p>)
            if (!empty($this->Conteudo)) {
                $this->Conteudo = html_entity_decode($this->Conteudo, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }

            if ($this->Ativo) {
                static::updateAll(['Ativo' => false], ['<>', 'Id', $this->Id ?? 0]);
            }
            return true;
        }
        return false;
    }
}
