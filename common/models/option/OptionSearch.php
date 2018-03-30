<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Option;

/**
 * OptionSearch represents the model behind the search form of `app\models\Option`.
 */
class OptionSearch extends Option
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'display_weight'], 'integer'],
            [['sku', 'sku_base', 'title', 'description', 'option', 'price', 'stock', 'discontinued'], 'safe'],
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
        $query = Option::find()->havingActiveProduct();

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
            'display_weight' => $this->display_weight,
            'discontinued' => $this->discontinued,
        ]);

        $query->andFilterWhere(['like', Option::tableName().'.sku', $this->sku])
            ->andFilterWhere(['like', Option::tableName().'.sku_base', $this->sku_base])
            ->andFilterWhere(['like', Option::tableName().'.title', $this->title])
            ->andFilterWhere(['like', Option::tableName().'.description', $this->description])
            ->andFilterWhere(['like', Option::tableName().'.option', $this->option])
            ->andFilterWhere(['like', Option::tableName().'.price', $this->price])
            ->andFilterWhere(['like', Option::tableName().'.stock', $this->stock]);

        return $dataProvider;
    }
}
