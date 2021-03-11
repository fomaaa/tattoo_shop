<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\ProductModel;
use common\models\ProductCategoryModel;

class CartController extends \yii\web\Controller
{
	public function beforeAction($action)
	{
	    $this->enableCsrfValidation = false;

	    return parent::beforeAction($action);
	}

	public function actionIndex()
	{

		return $this->render('index', [
            'cart' => \Yii::$app->cart
        ]);
	}

    public function actionMinicart()
    {
    	if ($_POST['product_id']) {
	    	$product = $this->findProduct($_POST['product_id']);

	        return \Yii::$app->view->renderFile('@app/views/cart/minicart.php');
    	}
    }

    public function actionGetCart()
    {
    	$cart = \Yii::$app->cart;
    	$products = $_POST['CartForm'];

    	if (is_array($products)) {
    		foreach ($products as $product_id => $quantity) {
    			if ($quantity == 0) {
    				$cart->remove($product_id);
    			} else {
    				$cart->change($product_id, $quantity);
    			}
    		}
    	}


    	$sidebar = \Yii::$app->view->renderFile('@app/views/cart/sidebar.php', [
	                    'cart' => $cart,
	                    'delivery' => 300,

	                  ]);
    	$htmlItems = \Yii::$app->view->renderFile('@app/views/cart/items.php', [
	                    'cart' => $cart,
	                    'delivery' => '300',

	                  ]);

    	return json_encode(array(
    		'htmlItems' => $htmlItems,
	        'htmlIndicator' => $this->getMiniCart(),
	        'htmlSidebar' 	=> $sidebar
	    ));
    }

    public function actionRemoveItem($id)
    {
        $cart = \Yii::$app->cart;

        $cart->remove($id);

        $sidebar = \Yii::$app->view->renderFile('@app/views/cart/sidebar.php', [
                        'cart' => $cart,
                        'delivery' => 300,

                      ]);
        $htmlItems = \Yii::$app->view->renderFile('@app/views/cart/items.php', [
                        'cart' => $cart,
                        'delivery' => '300',

                      ]);

        return json_encode(array(
            'htmlItems' => $htmlItems,
            'htmlIndicator' => $this->getMiniCart(),
            'htmlSidebar'   => $sidebar
        ));

    }
    public function actionAddItem()
    {

    	if ($_POST['product_id']) {
	    	$product = $this->findProduct($_POST['product_id']);

	    	$cart = \Yii::$app->cart;

	    	if ($this->isInCart($_POST['product_id'])) {
	    		$cart->plus($product->id, '1');
	    	} else {
	    		$cart->add($product, '1');
	    	}

	    	$product = \Yii::$app->view->renderFile('@app/views/cart/item.php', [
	                    'product' => $product,
	                  ]);

	        return json_encode(array(
	        	'htmlIndicator' => $this->getMiniCart(),
	        	'htmlButton' 	=> $product
	        ));
    	}
    }


    public function actionAddSingle()
    {
        if ($_POST['product_id']) {
            !$_POST['quantity'] ? $_POST['quantity'] = 1 : '';
            $product = $this->findProduct($_POST['product_id']);

            $cart = \Yii::$app->cart;

            if ($this->isInCart($_POST['product_id'])) {
                $cart->plus($product->id, $_POST['quantity']);
            } else {
                $cart->add($product, $_POST['quantity']);
            }

            $product = \Yii::$app->view->renderFile('@app/views/cart/item-single.php', [
                        'product' => $product,
                        'quantity' => $_POST['quantity']
                      ]);

            return json_encode(array(
                'htmlIndicator' => $this->getMiniCart(),
                'htmlButton'    => $product
            ));
        }
    }
	public function actionAddCertificate()
	{
		if ($_POST['product_id']) {
			$_POST['custom'] = (int) $_POST['custom'];
			if(!$_POST['quantity'] && !$_POST['custom'] ) return json_encode(array(
				'htmlIndicator' => $this->getMiniCart(),
				'htmlButton'    => \Yii::$app->view->renderFile('@app/views/components/certificate.php')
			));

			if ($_POST['custom']) {
				$_POST['quantity'] = $_POST['custom'];
			}

			$product = $this->findProduct($_POST['product_id']);
			$product->price = $_POST['quantity'];
			$product->save();

			$cart = \Yii::$app->cart;

			if ($this->isInCart(1)) {
				$cart->remove(1);
				$cart->add($product, 1);
			} else {
				$cart->add($product, 1);
			}

			$product = \Yii::$app->view->renderFile('@app/views/components/certificate.php', [

			]);

			return json_encode(array(
				'htmlIndicator' => $this->getMiniCart(),
				'htmlButton'    => $product
			));
		}
	}

    public function actionOrder()
    {



    	return $this->render('order', [
            'cart' => \Yii::$app->cart
        ]);
    }


    protected function findProduct($id)
    {
        if (($model = ProductModel::findOne($id)) !== null) {
            return $model;
        }
    }

    public function isInCart($id)
    {
    	$cart = \Yii::$app->cart;
    	$check = $cart->getItem($id);

    	if ($check) return true;
    }

    public function actionClear()
    {
    	$cart = \Yii::$app->cart;

    	$cart->clear();

        return json_encode(array(
                'htmlIndicator' => $this->getMiniCart(),
            ));
    }



    private function getMiniCart() {

    	return \Yii::$app->view->renderFile('@app/views/cart/minicart.php', [
	    			'cart' => \Yii::$app->cart
	            ]);
    }
}
