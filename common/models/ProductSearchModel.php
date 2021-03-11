<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductModel;

/**
 * ProductSearchModel represents the model behind the search form about `common\models\ProductModel`.
 */
class ProductSearchModel extends ProductModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'price', 'quantity', 'sale_price'], 'integer'],
            [['name', 'description', 'excerpt', 'slug', 'thumbnail', 'rating', 'attributes', 'status'], 'safe'],
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
        $query = ProductModel::find();
		$query->where(['!=','id', '1']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'sale_price' => $this->sale_price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'excerpt', $this->excerpt])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'attributes', $this->attributes]);

        return $dataProvider;
    }
}
