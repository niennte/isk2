<?php

namespace common\models\compatibility;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductCompatibility;

/**
 * CompatibilitySearch represents the model behind the search form of `app\models\Compatibility`.
 */
class CompatibilitySearch extends Compatibility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['compatible_device_family', 'compatible_device_model', 'relationship', 'product_skubase', 'product_reference_name', 'comments'], 'safe'],
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
        $query = Compatibility::find();

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

        $query->andFilterWhere(['like', 'compatible_device_family', $this->compatible_device_family])
            ->andFilterWhere(['like', 'compatible_device_model', $this->compatible_device_model])
            ->andFilterWhere(['like', 'relationship', $this->relationship])
            ->andFilterWhere(['like', 'product_skubase', $this->product_skubase])
            ->andFilterWhere(['like', 'product_reference_name', $this->product_reference_name])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
