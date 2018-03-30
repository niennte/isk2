<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductLineSearch represents the model behind the search form of `common\models\ProductLine`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'display_weight'], 'integer'],
            [['sku_base', 'title', 'description', 'display_title', 'specs', 'product_url', 'buy_url', 'category', 'type', 'price', 'released', 'discontinued'], 'safe'],
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
        $query = Product::find(); //->with('productOptions');

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
            'released' => $this->released,
            'discontinued' => $this->discontinued,
        ]);

        $query->andFilterWhere(['like', 'sku_base', $this->sku_base])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'display_title', $this->display_title])
            ->andFilterWhere(['like', 'specs', $this->specs])
            ->andFilterWhere(['like', 'product_url', $this->product_url])
            ->andFilterWhere(['like', 'buy_url', $this->buy_url])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }

    public function searchFor($params) {

        // TODO validate param
        $query = Product::find()
            ->compatibleWith($params['deviceModel']);

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
            'released' => $this->released,
            'discontinued' => $this->discontinued,
        ]);

        $query->andFilterWhere(['like', 'sku_base', $this->sku_base])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'display_title', $this->display_title])
            ->andFilterWhere(['like', 'specs', $this->specs])
            ->andFilterWhere(['like', 'product_url', $this->product_url])
            ->andFilterWhere(['like', 'buy_url', $this->buy_url])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;

    }


}
