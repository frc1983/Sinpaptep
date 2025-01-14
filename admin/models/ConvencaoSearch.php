<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Convencao;

/**
 * ConvencaoSearch represents the model behind the search form about `app\models\Convencao`.
 */
class ConvencaoSearch extends Convencao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Id_Categoria_Convencao'], 'integer'],
            [['Nome', 'Url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Convencao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'Id_Categoria_Convencao' => $this->Id_Categoria_Convencao,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
            ->andFilterWhere(['like', 'Url', $this->Url]);

        return $dataProvider;
    }
}
