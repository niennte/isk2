<?php

namespace common\models\collection;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\collection\Collection;

/**
 * CollectionSearch represents the model behind the search form of `common\models\Collection`.
 */
class CollectionSearch extends Collection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['product_sku', 'product_skubase', 'collection_title', 'comments'], 'safe'],
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
        $query = Collection::find();

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
        ]);

        $query->andFilterWhere(['like', 'product_sku', $this->product_sku])
            ->andFilterWhere(['like', 'product_skubase', $this->product_skubase])
            ->andFilterWhere(['like', 'collection_title', $this->collection_title])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
