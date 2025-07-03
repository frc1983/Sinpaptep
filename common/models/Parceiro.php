<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "parceiro".
 *
 * @property int $Id
 * @property string $Nome
 * @property string|null $Descricao
 * @property string|null $Logo
 * @property string|null $Site
 */
class Parceiro extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $logoFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parceiro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Descricao'], 'string', 'max' => 5000],
            [['Nome', 'Logo', 'Site'], 'string', 'max' => 255],
            [['Site'], 'url', 'defaultScheme' => 'https'],
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
            'Descricao' => 'Descrição',
            'Logo' => 'Logo',
            'Site' => 'Site',
            'logoFile' => 'Arquivo do Logo',
        ];
    }

    /**
     * Upload do arquivo de logo
     */
    public function upload()
    {
        if ($this->logoFile === null) {
            return true;
        }

        $uploadPath = Yii::getAlias('@webroot/uploads/parceiros/');
        
        // Criar diretório se não existir
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = 'parceiro_' . time() . '_' . $this->logoFile->baseName . '.' . $this->logoFile->extension;
        $filePath = $uploadPath . $fileName;

        if ($this->logoFile->saveAs($filePath)) {
            $this->Logo = $fileName;
            return true;
        }

        return false;
    }

    /**
     * Obter URL completa do logo
     */
    public function getLogoUrl()
    {
        if ($this->Logo) {
            return Yii::getAlias('@web/uploads/parceiros/') . $this->Logo;
        }
        return null;
    }

    /**
     * Obter todos os parceiros ativos
     */
    public static function getParceirosAtivos()
    {
        return self::find()->orderBy(['Nome' => SORT_ASC])->all();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params)
    {
        $query = Parceiro::find();

        // add conditions that should always apply here

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'Nome' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Descricao', $this->Descricao])
            ->andFilterWhere(['like', 'Site', $this->Site]);

        return $dataProvider;
    }
} 