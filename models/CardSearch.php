<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Card;

/**
 * CardSearch represents the model behind the search form of `app\models\Card`.
 */
class CardSearch extends Card
{
    public $condition_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'binding_id', 'condition_id'], 'integer'],
            [['name', 'author', 'sharing_status', 'publishing_name', 'year', 'condition_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Card::find()
            ->joinWith('condition');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'binding_id' => $this->binding_id,
            'year' => $this->year,
            'condition_id' => $this->condition_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'condition_name', $this->condition_name])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'sharing_status', $this->sharing_status])
            ->andFilterWhere(['like', 'publishing_name', $this->publishing_name]);

        return $dataProvider;
    }
}
