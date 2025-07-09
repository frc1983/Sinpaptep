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
 * @property string|null $Site
 */
class Parceiro extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Parceiro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Descricao'], 'string', 'max' => 5000],
            [['Nome', 'Site'], 'string', 'max' => 255],
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
            'Site' => 'Site',
        ];
    }



    /**
     * Gets query for [[ParceiroImagens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParceiroImagens()
    {
        return $this->hasMany(ParceiroImagem::class, ['ParceiroId' => 'Id']);
    }

    /**
     * Obter todas as imagens do parceiro
     */
    public function getImagens()
    {
        return $this->parceiroImagens;
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
        $query = Parceiro::find()->with(['parceiroImagens']);

        // add conditions that should always apply here

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['Id' => SORT_DESC],
                'attributes' => [
                    'Id' => [
                        'asc' => ['Id' => SORT_ASC],
                        'desc' => ['Id' => SORT_DESC],
                        'default' => SORT_DESC,
                        'label' => 'ID',
                    ],
                    'Nome' => [
                        'asc' => ['Nome' => SORT_ASC],
                        'desc' => ['Nome' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Nome',
                    ],
                    'Site' => [
                        'asc' => ['Site' => SORT_ASC],
                        'desc' => ['Site' => SORT_DESC],
                        'default' => SORT_ASC,
                        'label' => 'Site',
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 20,
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