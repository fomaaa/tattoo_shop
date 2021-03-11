<?php

namespace frontend\controllers;

use app\models\FavoritesModel;
use common\models\ProductModel;
use common\models\ProductCategoryModel;
use Yii;

class FavoritesController extends \yii\web\Controller
{
	public function beforeAction($action)
	{
	    $this->enableCsrfValidation = false;

	    return parent::beforeAction($action);
	}

	public function actionIndex()
	{
		if (Yii::$app->user->isGuest) throw new \yii\web\NotFoundHttpException();
		$user_id = Yii::$app->user->id;

		$products = ProductModel::find()
		            ->select(['product.*', 'product_category.slug as category_slug', 'favorites.is_actual as is_favorites'])
		            ->leftJoin('favorites', 'product.id = favorites.product_id AND favorites.user_id = ' . $user_id)
		            ->leftJoin('product_category', 'product_category.id = product.category')
		            ->where(['favorites.is_actual' => 1, 'favorites.user_id' => $user_id])
		            ->all();


		$categories = array();
		$products_cat = array();
		if ($products) {
			foreach ($products as $key => $product) {
				$parent_cat = $this->findParentCategory($product['category']);
				$categories[] = $parent_cat;
				$products_cat[$parent_cat][] = $product['id'];
			}

			$categories = implode(',', array_unique($categories));
			$categories = ProductCategoryModel::find()
			            ->select(['product_category.*'])
						->where('product_category.id IN ( '. $categories .')')
						->orderby('product_category.sort asc')
						->asArray()
						->all();
			foreach ($categories as $key => $category) {
				if (isset($products_cat[$category['id']])) {
					$categories[$key]['count'] = count($products_cat[$category['id']]);
				}
			}
		}


		return $this->render('index', [
			'products' 		=> $products,
			'categories' 	=> $categories,
		]);



	}

    public function actionAction($id)
    {
    	if (Yii::$app->user->isGuest) exit(array('error' => 'login ...'));

    	$user_id = Yii::$app->user->id;
    	$product = FavoritesModel::find()->where(['product_id' => $id, 'user_id' => $user_id])->one();

    	if ($product) {
    		$product->is_actual ? $product->is_actual = 0   :  $product->is_actual = 1 ;

    		$product->save();
    	} else {
    		$product = new FavoritesModel;
    		$product->user_id = $user_id;
    		$product->product_id = $id;
    		$product->is_actual = 1;
    		$product->isNewRecord = 1;

	        $product->save(false);
    	}


    	$count = FavoritesModel::find()->where(['is_actual' => 1, 'user_id' => $user_id])->count();

    	$htmlIndicator = '<a href="/favorites" class="btn btn--favorite btn--lg"> <span class="btn__icon"> <svg class="icon icon-heart"> <use xlink:href="/img/sprite.svg#icon-heart"></use> </svg> </span> <span class="badge">' . $count . '</span> </a>';

    	if ($product->is_actual) {
    		$htmlButton = '<a href="/favorites/action/' . $product->product_id .'" class="btn btn--favorite js-favorite-add-item is-active"> <svg class="icon icon-heart"> <use xlink:href="/img/sprite.svg#icon-heart"></use> </svg> </a>';
    	} else {
    		$htmlButton = '<a href="/favorites/action/' . $product->product_id .'" class="btn btn--favorite js-favorite-add-item"> <svg class="icon icon-heart"> <use xlink:href="/img/sprite.svg#icon-heart"></use> </svg> </a>';
    	}

    	return json_encode(array(
    		'htmlIndicator' => $htmlIndicator,
    		'htmlButton' => $htmlButton
    	));
    }

    protected function findModel($id)
    {
        if (($model = FavoritesModel::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function findParentCategory($id)
    {
    	$category = ProductCategoryModel::findOne($id);

    	if ($category) {
    		if ($category->parent == 0) {
    			$category_id = $category->id;
    		} else {
    			$category_id = $this->findParentCategory($category->parent);
    		}

    	} else {
    		$category_id =  0;
    	}

    	return $category_id;
    }
}
