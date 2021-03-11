<?php

namespace frontend\controllers;

use PetstoreIO\Category;
use Yii;
use yii\web\NotFoundHttpException;
use common\models\ProductModel;
use common\models\ProductCategoryModel;
use app\models\FavoritesModel;
use yii\data\Pagination;


class ProductController extends \yii\web\Controller
{
    use \common\traits\GlobalFunctions;

    public function beforeAction($action)
    {
        $this->putSEO();
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        if (isset($_GET['page'])) $paged = $_GET['page'];
		$this->putSEO(1, 'catalog');
        $categories['main'] = ProductCategoryModel::find()
                                ->select(['product_category.*', 'count(product.id) as count'])
                                ->leftJoin('product', 'product_category.id = product.category')
                                ->where(['parent' => 0])
                                ->groupBy(['product_category.id'])
                                ->orderby('sort asc')
                                ->asArray()
                                ->all();
        $categories['sub'] = ProductCategoryModel::find()
                                ->select(['product_category.*', 'count(product.id) as count'])
                                ->leftJoin('product', 'product_category.id = product.category')
                                ->where('parent != 0')
                                ->groupBy(['product_category.id'])
                                ->orderby('sort asc')
                                ->asArray()
                                ->all();

        if (is_array($categories['main'] )) {
            foreach ($categories['main'] as $key => $main) {
                if (is_array($categories['sub'] )) {
                    foreach ($categories['sub'] as $index => $sub) {
                        if ($sub['parent'] == $main['id']) {

                            $res[$main['id']][] = $sub;
                        }

                    }
                }

            }
        }
        $categories['sub'] = $res;


        return $this->render('index', [
            'categories' => $categories
        ]);
    }

    public function actionCategory($category = NULL, $page = NULL)
    {
    	$category = end(explode('/', $category));
        Yii::$app->user->isGuest ? $user_id = 0 :  $user_id = Yii::$app->user->id;

    	$currentCategory  = ProductCategoryModel::find()->where(['slug' => $category])->asArray()->one();

    	if (!$currentCategory) {
			if ($product = ProductModel::find()->where(['slug' => $category, 'is_published' => 1])->one()) {
				return $this->actionProduct('', $product);
			} else {
    			throw new \yii\web\NotFoundHttpException();
			}
		}

        $this->putSEO($currentCategory['id'], 'product-category', $currentCategory);

        $currentParent = ProductCategoryModel::find()->where(['id' => $currentCategory['parent']])->asArray()->one();

        if (!$currentParent) $currentParent = $currentCategory;

        $chlidrenCategery = ProductCategoryModel::find()
                            ->select(['id'])
                            ->where(['parent' => $currentCategory['id']])
                            ->orderBy('id')
                            ->asArray()
                            ->column();

        $chlidrenCategery[] = $currentCategory['id'];

        $parentCategory = ProductCategoryModel::find()
                            ->select(['id'])
                            ->where(['parent' => $currentParent['id']])
                            ->orderBy('id')
                            ->asArray()
                            ->column();

        $parentCategory[] = $currentParent['id'];


        $cats = implode(',' , $chlidrenCategery);
        $parentCats = implode(',' , $parentCategory);

        $productsCount = ProductModel::find()->select(['count(*) as count'])->where(['is_published' => 1])->where('category IN ( '. $parentCats .')')->asArray()->one();

        $countQuery = ProductModel::find()->where('category IN ( '. $cats .')')->andWhere(['is_published' => 1]);


        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 12,
            'forcePageParam' => false,
            'pageSizeParam' => false,
            'pageParam' => 'page',
        ]);

        $products = ProductModel::find()
                    ->select(['product.*'])
                    ->where('product.category IN ( '. $cats .')')
                    ->andWhere(['is_published' => 1])
                    ->orderby('id desc')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();





    	$categories['main'] = ProductCategoryModel::find()
    							->select(['product_category.*', 'count(product.id) as count'])
    							->leftJoin('product', 'product_category.id = product.category')
						    	->where(['parent' => 0])
						    	->groupBy(['product_category.id'])
						    	->orderby('sort asc')
						    	->asArray()
						    	->all();
    	$categories['sub'] = ProductCategoryModel::find()
						    	->select(['product_category.*', 'count(product.id) as count'])
						    	->leftJoin('product', 'product_category.id = product.category')
						    	->where('parent != 0')
						    	->groupBy(['product_category.id'])
						    	->orderby('sort asc')
						    	->asArray()
						    	->all();

    	if (is_array($categories['main'] )) {
    		foreach ($categories['main'] as $key => $main) {
    			if (is_array($categories['sub'] )) {
    				foreach ($categories['sub'] as $index => $sub) {
    					if ($sub['parent'] == $main['id']) {

    						$res[$main['id']][] = $sub;
    					}

    				}
    			}

    		}
    	}
    	$categories['sub'] = $res;

        return $this->render('category', [
        	'products'         => $products,
        	'productsCount'    => $productsCount,
        	'categories'       => $categories,
        	'currentCategory'  => $currentCategory,
            'currentParent'    => $currentParent,
        	'pagination'       => $pagination
        ]);
    }

    public function actionProduct($category, $product)
    {
        if (!$product) throw new \yii\web\NotFoundHttpException();
        $this->putSEO($product->id, 'product', $product);

    	$categories = ProductCategoryModel::find()->where(['id' => $product['category']])->asArray()->one();

    	return $this->render('product', [
    	 	'product' => $product,
    	 	'categories' => $categories,
    	]);
    }
}
