<?php

namespace frontend\controllers;

use common\models\ProductModel;
use yii\data\Pagination;

class SearchController extends \yii\web\Controller
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
    	if ($_GET['s']) {
    		$countQuery = ProductModel::find()->where(['like', 'name', '%'. $_GET['s'] .'%', false]);

	        $pagination = new Pagination([
	            'totalCount' => $countQuery->count(),
	            'pageSize' => 12,
	            'forcePageParam' => false,
	            'pageSizeParam' => false,
	            'pageParam' => 'page',
	        ]);


	        $products = ProductModel::find()
	                        ->select(['product.*'])
	                        ->where(['is_published' => 1])
	                        ->andWhere(['like', 'name', '%'. $_GET['s'] .'%', false])
	                        ->orderby('id desc')
	                        ->offset($pagination->offset)
	                        ->limit($pagination->limit)
	                        ->all();
    	}

    	if ($products) {

    		return $this->render('index', [
    			'products' => $products,
    			'pagination' => $pagination
    		]);
    	} else {
        	return $this->render('empty-search');
    	}

    }

}
