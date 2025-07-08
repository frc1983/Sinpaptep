<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "parceiro_imagem".
 *
 * @property int $Id
 * @property int $ParceiroId
 * @property string $Imagem
 * @property string|null $Descricao
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Parceiro $parceiro
 */
class ParceiroImagem extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imagemFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parceiro_imagem';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ParceiroId'], 'required'],
            [['ParceiroId', 'created_at', 'updated_at'], 'integer'],
            [['Descricao'], 'string', 'max' => 500],
            [['Imagem'], 'string', 'max' => 255],
            [['ParceiroId'], 'exist', 'skipOnError' => true, 'targetClass' => Parceiro::class, 'targetAttribute' => ['ParceiroId' => 'Id']],
            [['imagemFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 5], // 5MB
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'ParceiroId' => 'Parceiro ID',
            'Imagem' => 'Imagem',
            'Descricao' => 'Descrição',
            'imagemFile' => 'Arquivo da Imagem',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
        ];
    }

    /**
     * Gets query for [[Parceiro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParceiro()
    {
        return $this->hasOne(Parceiro::class, ['Id' => 'ParceiroId']);
    }

    /**
     * Upload do arquivo de imagem
     */
    public function upload()
    {
        if ($this->imagemFile === null) {
            return true;
        }

        $uploadPath = Yii::getAlias('@webroot/uploads/parceiros/');
        
        // Criar diretório se não existir
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = 'parceiro_imagem_' . time() . '_' . $this->imagemFile->baseName . '.' . $this->imagemFile->extension;
        $filePath = $uploadPath . $fileName;

        if ($this->imagemFile->saveAs($filePath)) {
            // Armazenar o caminho completo no servidor
            $this->Imagem = $filePath;
            return true;
        }

        return false;
    }

    /**
     * Obter URL completa da imagem
     */
    public function getImagemUrl()
    {
        if ($this->Imagem) {
            // Se já é um caminho completo, extrair apenas o nome do arquivo para a URL
            $fileName = basename($this->Imagem);
            return Yii::getAlias('@web/uploads/parceiros/') . $fileName;
        }
        return null;
    }

    /**
     * Obter apenas o nome do arquivo da imagem
     */
    public function getImagemNome()
    {
        if ($this->Imagem) {
            return basename($this->Imagem);
        }
        return null;
    }

    /**
     * Obter todas as imagens de um parceiro
     */
    public static function getImagensByParceiroId($parceiroId)
    {
        return self::find()
            ->where(['ParceiroId' => $parceiroId])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    /**
     * Remover arquivo de imagem
     */
    public function removeImagem()
    {
        if ($this->Imagem && file_exists($this->Imagem)) {
            unlink($this->Imagem);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->removeImagem();
        return true;
    }
} 