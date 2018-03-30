<?php

namespace common\models\xmas;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\xmas\Xmas;

/**
 * XmasSearch represents the model behind the search form of `\app\models\Xmas`.
 */
class XmasSearch extends Xmas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['skubase', 'short_description', 'reference_name'], 'safe'],
            [['discount'], 'number'],
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
        $query = Xmas::find();

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
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'skubase', $this->skubase])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'reference_name', $this->reference_name]);

        return $dataProvider;
    }
}
