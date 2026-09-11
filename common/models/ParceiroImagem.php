<?php

namespace common\models;

use common\helpers\UploadUrl;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Parceiro_Imagem".
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
        return 'Parceiro_Imagem';
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
            [['ParceiroId', 'created_at', 'updated_at', 'Ordem'], 'integer'],
            [['Descricao'], 'string', 'max' => 500],
            [['Imagem'], 'string', 'max' => 255],
            [['ParceiroId'], 'exist', 'skipOnError' => true, 'targetClass' => Parceiro::class, 'targetAttribute' => ['ParceiroId' => 'Id']],
            [['imagemFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 5],
            [['Ordem'], 'default', 'value' => 1],
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
            'Ordem' => 'Ordem',
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
            return false;
        }

        // Verificar se o arquivo temporário existe
        if (!file_exists($this->imagemFile->tempName)) {
            Yii::error('Arquivo temporário não encontrado: ' . $this->imagemFile->tempName);
            return false;
        }

        $uploadPath = Yii::getAlias('@webroot/uploads/parceiros/');
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true)) {
                Yii::error('Não foi possível criar o diretório: ' . $uploadPath);
                return false;
            }
        }
        if (!is_writable($uploadPath)) {
            Yii::error('Diretório não é gravável: ' . $uploadPath);
            return false;
        }

        $fileName = 'Parceiro_Imagem_' . time() . '_' . uniqid() . '.' . $this->imagemFile->extension;
        $filePath = $uploadPath . $fileName;

        try {
            if ($this->imagemFile->saveAs($filePath)) {
                // Salva apenas o nome do arquivo no banco
                $this->Imagem = $fileName;
                return true;
            } else {
                Yii::error('Falha ao salvar arquivo: ' . $filePath);
                return false;
            }
        } catch (\Exception $e) {
            Yii::error('Exceção ao salvar arquivo: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obter URL completa da imagem
     */
    public function getImagemUrl()
    {
        if ($this->Imagem) {
            return UploadUrl::backendWeb('uploads/parceiros/' . basename($this->Imagem));
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
            ->orderBy(['Ordem' => SORT_ASC, 'created_at' => SORT_DESC])
            ->all();
    }

    /**
     * Obter a próxima ordem para uma nova imagem
     */
    public static function getNextOrdem($parceiroId)
    {
        $maxOrdem = self::find()
            ->where(['ParceiroId' => $parceiroId])
            ->max('Ordem');
        
        return $maxOrdem ? $maxOrdem + 1 : 1;
    }

    /**
     * Mover imagem para uma nova posição
     */
    public function moveToPosition($newPosition)
    {
        $parceiroId = $this->ParceiroId;
        $currentPosition = $this->Ordem ?: 1;
        
        if ($newPosition == $currentPosition) {
            return true;
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($newPosition > $currentPosition) {
                // Mover para baixo - diminuir ordem das imagens entre posição atual e nova
                self::updateAllCounters(
                    ['Ordem' => -1],
                    [
                        'and',
                        ['ParceiroId' => $parceiroId],
                        ['>', 'Ordem', $currentPosition],
                        ['<=', 'Ordem', $newPosition]
                    ]
                );
            } else {
                // Mover para cima - aumentar ordem das imagens entre nova posição e atual
                self::updateAllCounters(
                    ['Ordem' => 1],
                    [
                        'and',
                        ['ParceiroId' => $parceiroId],
                        ['>=', 'Ordem', $newPosition],
                        ['<', 'Ordem', $currentPosition]
                    ]
                );
            }
            
            $this->Ordem = $newPosition;
            $this->save(false);
            
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error('Erro ao mover imagem: ' . $e->getMessage());
            return false;
        }
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
