<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $product_name
 * @property integer $product_price
 * @property integer $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'product_name', 'product_price', 'created_at'], 'required'],
            [['product_price', 'created_at'], 'integer'],
            [['product_code'], 'string', 'max' => 50],
            [['product_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'product_price' => 'Product Price',
            'created_at' => 'Created At',
        ];
    }
}
