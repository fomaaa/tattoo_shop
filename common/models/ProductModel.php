<?php

namespace common\models;

use common\models\query\ArticleQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\ProductCategoryModel;
use app\models\FavoritesModel;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $category
 * @property string $description
 * @property string $excerpt
 * @property int $price
 * @property int $quantity
 * @property string $slug
 * @property string $thumbnail
 * @property int $sale_price
 * @property string $rating
 * @property string $attributes
 */
class ProductModel extends \yii\db\ActiveRecord
{
    public $attachments;

    public $thumbnail;

    public $product_parent_cat;

    public function behaviors()
    {
        return [
            // TimestampBehavior::class,
            // BlameableBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'immutable' => true,
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'productAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
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
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['slug'], 'unique'],
            [['category', 'price', 'quantity', 'sale_price', 'is_published'], 'integer'],
            [['description'], 'string'],
            [['name', 'excerpt', 'slug', 'status', 'order_date'], 'string', 'max' => 255],
            [['rating'], 'string', 'max' => 50],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['attachments', 'thumbnail', 'attributes'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'category' => 'Категория',
            'description' => 'Описание',
            'excerpt' => 'Краткое описание',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'slug' => 'URL',
            'thumbnail' => 'Главное изображение',
            'sale_price' => 'Цена со скидкой',
            'rating' => 'Рейтинг',
            'attributes' => 'Атрибуты',
            'attachments' => 'Галерея',
            'is_published' => 'Опубликовать',
            'status' => 'Статус',
            'order_date' => 'Дата поступления'
        ];
    }
    public function getProductAttachments()
    {
        return $this->hasMany(ProductAttachment::class, ['product_id' => 'id']);
    }

    public function is_in_cart()
    {
        $cart = \Yii::$app->cart;

        $item = $cart->getItem($this->id);

        if ($item) {
            return $item->getQuantity();
        } else {
            return false;
        }


    }

    public function get_status()
    {
        switch ($this->status) {
            case 'reserve' : {
                $status = 'Под заказ. ';
                if ($this->order_date) {
                    $status .= ' В наличии с  ' . $this->order_date;
                }
                break;
            }
            case 'instock' : {
                $status = 'В наличии ';
            break;
            }
            case 'outstock' : {
                $status = 'Нет в наличии';
            break;
            }
        }

        return $status;
    }

    public function get_table_status()
    {
        switch ($this->status) {
            case 'reserve' : {
                $status = '<small class="label bg-yellow">Под заказ. ';
                if ($this->order_date) {
                    $status .= ' В наличии с  ' . $this->order_date;
                }
                $status .= '</small>';
                break;
            }
            case 'instock' : {
                $status = '<small class="label bg-green">В наличии</small>';
            break;
            }
            case 'outstock' : {
                $status = '<small class="label bg-info">Нет в наличии</small>';
            break;
            }
        }

        return $status;
    }
    public function get_recomended()
    {
        $products = $this->find()->where(['category' => $this->category])->andWhere(['!=','id', $this->id])->limit(15)->all();

        if (!$products) {
            $parentCategory = self::findParentCategory($this->category);

            $products = $this->find()->where(['category' => $this->parentCategory])->andWhere(['!=','id', $this->id])->limit(15)->all();
        }

        return $products;
    }

    public function get_category()
    {
        return ProductCategoryModel::findOne($this->category);
    }

    public  function get_parent_category_slug() {
        $id = self::get_parent_category($this->category);

        $category = ProductCategoryModel::findOne($id);

        return $category->slug;
    }



    public static function get_parent_category($id)
    {
        $category = ProductCategoryModel::findOne($id);

        if ($category) {
            if ($category->parent == 0) {
                $category_id = $category->id;
            } else {
                $category_id = self::get_parent_category($category->parent);
            }

        } else {
            $category_id =  0;
        }

        return $category_id;
    }

    public  function get_url()
    {
        return \Yii::$app->breadcrumbs->getProductLink($this);
    }

    public static function get_the_url($id)
    {
        if ($id) {
            $product = new self;
            $product = $product::findOne($id);

            if ($product) {
                $category_slug  = ProductCategoryModel::find()->select(['slug'])->where(['id' => $product->category])->one();

                if ($category_slug->slug) {
                    $url = '/catalog/' . $category_slug->slug . '/' . $product->slug;
                } else {
                    $url = '/catalog/' . $product->slug;

                }

                return $url;

            }

        }
    }

    public static function is_in_recomended($user_id = 0, $product_id = 0)
    {
        if ($user_id && $product_id) {
            $check = FavoritesModel::find()->where(['user_id' => $user_id, 'product_id' => $product_id, 'is_actual' => '1'])->all();

            if ($check) return true;
        }
    }

    public function getCategoryName()
    {
        $parentCatId = self::get_parent_category($this->category);

        $catName = ProductCategoryModel::find()->select(['name'])->where(['id' => $this->category])->asArray()->one();

        $parentName = ProductCategoryModel::find()->select(['name'])->where(['id' => $parentCatId])->asArray()->one();

        if (!empty($parentName['name']) && $parentCatId != $this->category) {
            $res = $catName['name'] . ', ' . $parentName['name'];
        } else {
            $res = $catName['name'];
        }

        return $res;
    }

    private function check404($url)
    {
        $code = false;
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
            $code = 404;
        }

        curl_close($handle);

        return $code;
    }
}
