<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property int $actual_price
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity', 'actual_price', 'order_id'], 'required'],
            [['product_id', 'quantity', 'actual_price', 'order_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order id',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'actual_price' => 'Actual Price',
        ];
    }
}
