<?php

namespace frontend\controllers;

use common\models\OrderProduct;
use common\models\Orders;
use common\models\UserProfile;
use Yii;
use yii\web\NotFoundHttpException;

class OrdersController extends \yii\web\Controller
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
    	$cart = \Yii::$app->cart;
    	$products = $cart->getItems();

    	if (!$products) redirect(['/cart']);

    	$user = UserProfile::find()->where(['user_id' => Yii::$app->user->id])->asArray()->one();
    	$user['email'] = Yii::$app->user->identity->email;
    	$delivery = 300;

        $sidebar = \Yii::$app->view->renderFile('@app/views/cart/sidebar.php', [
                        'cart' => $cart,
                        'delivery' => $delivery,
                    ]);

        return $this->render('index', [
        	'sidebar' => $sidebar,
        	'delivery' => $delivery,
        	'user' => $user
        ]);
    }


    public function actionCheckout()
    {
    	$cart = \Yii::$app->cart;
        $products = $cart->getItems();

        if (!$products) throw new NotFoundHttpException(Yii::t('frontend', 'Page not found'));

        $order = new Orders();
        $delivery = 300;

    	if (Yii::$app->user->isGuest) {
            $order->user_id = 1;
    	} else {
    		$order->user_id = Yii::$app->user->id;
    	}

        if ($_POST['delivery'] == 3 && $_POST['post_index']) {
            $delivery = (int) $order->getCDEKprice($_POST['post_index']);
        }

        if ($_POST['delivery'] == 2) {
            $delivery = 0;
        }

        if ($_POST['delivery'] == 2) {
            $delivery = $order->getDeliveryPrice();
        }

	    $order->email = $_POST['email'];
	    $order->firstname = $_POST['firstname'];
	    $order->lastname = $_POST['lastname'];
	    $order->phone = $_POST['phone'];
	    $order->country = $_POST['country'];
	    $order->city = $_POST['city'];
	    $order->address = $_POST['address'];
	    $order->post_index = $_POST['post_index'];

    	$order->payment_type = $_POST['payment'];
    	$order->delivery_type = $_POST['delivery'];
    	$order->delivery_price = $delivery;
    	$order->status = 'processing';
    	$order->total = $cart->getTotalCost() + $_POST['delivery'];
    	$order->certificate = '';
    	$order->created_at = date ("Y-m-d H:i:s", time());
    	$order->deleted_at = NULL;

    	$res = $order->save(false);

		if ($res) {
			if ($products) {
				foreach ($products as $product) {
					$quantity = $product->getQuantity();
					$product = $product->getProduct();

					$item = new OrderProduct();

					$item->product_id = $product->id;
					$item->actual_price = $product->price;
					$item->quantity =  $quantity;
					$item->order_id = $order->id;
					$item->isNewRecord = 1;

					$item->save(false);

				}
			}
		}
		\Yii::$app->email->sendNotification('order', $order);

        $cart->clear();

    	return $this->render('success', [
            'number' => str_pad($order->id , 9, '0', STR_PAD_LEFT),
        ]);

    }

}
