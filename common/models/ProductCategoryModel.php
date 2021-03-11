<?php

namespace common\models;

use common\models\query\ArticleQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property int $sort
 * @property string $slug
 */
class ProductCategoryModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $thumbnail;

    public static function tableName()
    {
        return 'product_category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => true,
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['slug'], 'unique'],
            [['parent', 'sort'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'parent' => 'Родитель',
            'sort' => 'Приоритет',
            'slug' => 'URL',
            'thumbnail' => 'Изображение',
        ];
    }

    public function get_image_url($size = null)
    {
        $sizes = ['90x52','165x165','180x104','265x265','530x530'];

        if ($size) {
            if (in_array($size, $sizes)) {
                $filename = explode('/', $this->thumbnail_path);
                $filename = $filename[count($filename) -1];

                return $this->thumbnail_base_url . '/thumbs/' . $size . '/' .$filename;
            }

        } else {
            return $this->thumbnail_base_url . $this->thumbnail_path;
        }

    }

    public static function get_the_image_url($id, $size = null)
    {
        $sizes = ['90x52','165x165','180x104','265x265','530x530'];
        $product = new self;
        $product = $product::findOne($id);
        
        if ($product) {
            if ($size) {
                if (in_array($size, $sizes)) {
                    $filename = explode('/', $product->thumbnail_path);
                    $filename = $filename[count($filename) -1];

                    return $product->thumbnail_base_url . '/thumbs/' . $size . '/' .$filename;
                }

            } else {
                return $product->thumbnail_base_url . $product->thumbnail_path;
            }
            
        }

    }

    public function getParentList()
    {
        // return $this->hasOne(ProductCategoryModel::className(), ['id' => 'parent_id']);
    }

    public function getParentName()
    {
        if ($this->parent) {
            $parent = self::findOne($this->parent);

            return $parent->name;
        }
    }
}
