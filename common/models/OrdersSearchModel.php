<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearchModel represents the model behind the search form about `common\models\Orders`.
 */
class OrdersSearchModel extends Orders
{
	public $user;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'delivery_type', 'payment_type', 'delivery_price'], 'integer'],
            [['status', 'user', 'email', 'firstname', 'lastname', 'phone', 'country', 'city', 'address', 'post_index', 'total', 'certificate', 'created_at', 'deleted_at'], 'safe'],
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
        $query = Orders::find();
		$query->joinWith(['user']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['user'] = [
			'asc' => ['user.username' => SORT_ASC],
			'desc' => ['user.username' => SORT_DESC],
		];
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'orders.id' => $this->id,
            'delivery_type' => $this->delivery_type,
            'orders.status' => $this->status,
            'payment_type' => $this->payment_type,
        ]);

        $query->andFilterWhere(['like', 'orders.total', $this->total])
            ->andFilterWhere(['like', 'orders.created_at', $this->created_at])
			->andFilterWhere(['like', 'user.username', $this->user])
		;

        return $dataProvider;
    }
}
