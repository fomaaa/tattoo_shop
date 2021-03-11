<?php
/*
    Frontend компонент для работы с рассылкой
*/
namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use common\models\ProductModel;
use common\models\OrderProduct;
use common\models\ProductCategoryModel;

class Email extends Component
{
	public function sendNotification($type, $data)
	{
		if ($type == 'callback') {
			$this->sendCallBackNotification($data);
		} else if ($type == 'order') {
			$this->sendOrderNotificationToClient($data);
			$this->sendOrderNotificationToAdmin($data);
		} else if ($type == 'status') {
			$this->changeStatusNotification($data);
		} else if ($type == 'newUser') {
			$this->sendPasswordToUser($data);
		}

	}

	private function sendCallBackNotification($data)
	{
		$name = $data->name;
		$email = $data->email;
		$message = $data->body;

		$body = '<h3>Заявка с формы обратной связи на сайте ' . \Yii::getAlias('@frontendUrl'). '</h3><br>
			Дата и время - '. date("Y.m.d H:i:s") .' <br>
			Имя - ' . $name .' <br>
			Email - ' . $email .' <br>
			Сообщение - ' . $message .' <br>
		';

		$subject = 'Заявка с формы обратной связи';

		return $this->sendMessage($subject, $body);
	}

	private function sendOrderNotificationToAdmin($data)
	{
		$body = '<h3>Новый заказ на сайте ' . \Yii::getAlias('@frontendUrl'). '</h3><br>
			Дата и время - '. date("Y.m.d H:i:s") .' <br>
			Имя - ' . $data->firstname .' <br>
			Фамилия - ' . $data->lastname .' <br>
			Телефон - ' . $data->phone .' <br>
			Email - ' . $data->email .' <br>
			Город - ' . $data->city .' <br>
			Адрес - ' . $data->address .' <br>
			<h4><a href="'. \Yii::getAlias('@backendUrl') .'orders/view?id='. $data->id .'">Подробнее</a></h4>
		';
		$subject = 'Новый заказ №' . $data->getNumber();

		return $this->sendMessage($subject, $body);
	}
	private function sendOrderNotificationToClient($data)
	{
		$body = '<h3>Вы сделали на сайте Tattoopro.ru</h3><br>
			Дата и время - '. date("Y.m.d H:i:s") .' <br>
			Имя - ' . $data->firstname .' <br>
			Фамилия - ' . $data->lastname .' <br>
			Телефон - ' . $data->phone .' <br>
			Email - ' . $data->email .' <br>
			Город - ' . $data->city .' <br>
			Адрес - ' . $data->address .' <br><br>
			
		';
		$products = OrderProduct::find()
			->select([
				'product.id as id',
				'order_product.quantity as quantity',
				'order_product.actual_price as price',
				'product.name as name'
			])
			->leftJoin('product', 'product.id = order_product.product_id')
			->where(['order_product.order_id' => $data->id])
			->asArray()
			->all();
		if ($products) {
			foreach ($products as $key => $item) {
				$body .= $key  + 1  . ') ' . $item['name'] . ' - ' . $item['quantity'] . 'x' . $item['price'] . ' = ' . $item['price'] * $item['quantity'] . '<br>';
			}
		}

		$body .= 'Итого - ' . $data->total .' <br>';
		$body .= '<h4><a href="'. \Yii::getAlias('@frontendUrl') .'user/default/history">Подробнее</a></h4>';

		$subject = 'Новый заказ №' . $data->getNumber();

		return $this->sendMessage($subject, $body);
	}

	private function changeStatusNotification($data)
	{
		$body = '<h3>Изменение статуса заказа № ' . $data->getNumber() . ' на сайте Tatoopro.ru</h3><br>
			Дата и время - '. date("Y.m.d H:i:s") .' <br>
			Статус - '. $data->getStatus($data->status).' <br>
			Состав заказа :  <br>
			
			';

		$products = OrderProduct::find()
			->select([
				'product.id as id',
				'order_product.quantity as quantity',
				'order_product.actual_price as price',
				'product.name as name'
			])
			->leftJoin('product', 'product.id = order_product.product_id')
			->where(['order_product.order_id' => $data->id])
			->asArray()
			->all();
		if ($products) {
			foreach ($products as $key => $item) {
				$body .= $key  + 1  . ') ' . $item['name'] . ' - ' . $item['quantity'] . 'x' . $item['price'] . ' = ' . $item['price'] * $item['quantity'] . '<br>';
			}
		}
		$body .= 'Итого - ' . $data->total .' <br>';
		$body .= '<h4><a href="'. \Yii::getAlias('@frontendUrl') .'user/default/history">Подробнее</a></h4>';

		$subject = 'Изменение статуса заказа №' . $data->getNumber();

		return $this->sendMessage($subject, $body);
	}

	private function sendPasswordToUser($data)
	{

	}


	private function sendMessage($subject, $body)
	{
//		$admin = KeyStorageItem::find()->where(['key' => 'app.admin_email'])->one();
//
//		$admin = $admin->value;

		if ($admin) {
			return Yii::$app->mailer->compose()
				->setFrom('bortsov-dev@mail.ru')
				->setTo('foma.izob@gmail.com')
				->setSubject($subject)
				->setTextBody($body)
				->setHtmlBody($body)
				->send();
		}
	}


	private function setKey($key)
	{
		$array = [
			'main_phone' => 'Пользователь',
			'user_id' => 'id Пользователя',
			'date' => 'Дата оформления заказа',
			'deliveryDate' => 'Дата доставки',
			'deliveryPeriod_from' => 'Период доставки с',
			'deliyveryPeriod_to' => 'Период доставки по',
			'contactName' => 'Контактное имя',
			'contactPhone' => 'Контактный телефон',
			'dontcall' => 'Без звонка оператора',
			'summ' => 'Сумма заказа',
			'discount' => 'Скидка',
			'promoCode' => 'Промокод',
			'bonusSumm' => 'Бонусы',
			'delivery_method' => 'Способ доставки',
			'payment_type' => 'Способ оплаты',
			'city' => 'Город',
			'address' => 'Адрес',
		];

		return $array[$key];
	}

	private function getItemsBody($items)
	{
		$data = json_decode($items, true);

		$body = '<table width="640px" align=”center” border=”1” cellpadding="0" cellspacing="0" ><tr>
        <th>Меню</th><th>product_id</th><th> Цена</th><th>Детализация</th></tr>';

		if ($data) {
			foreach($data as $key => $item) {
				$menu = Menus::find()->select(['NAME', 'category_id'])->where(['product_id' => $item['product_id']])->asArray()->one();

				if ($menu) {
					if ($menu['category_id'] == 3457) {
						$details = '<table align=”center” border=”1” cellpadding="0" cellspacing="0" >';
						$details .= '<tr><th>id</th><th>Блюдо</th></tr>';
						if ($item['detail']) {
							foreach ($item['detail'] as $index => $value) {
								$details .= '<tr>';
								$dish = Dishes::find()->where(['id' => $value['id']])->asArray()->one();
								$details .= '<td width="10%">' . $value['product_id'] . '</td>';
								$details .= '<td width="50%">' . $dish['name'] . '</td>';
								$details .= '</tr>';
							}
						}
						$details .= '</table>';
					}

					$body .= "<tr>
            <td>{$menu['NAME']}</td>
            <td>{$item['product_id']}</td>
            <td>{$item['price']}</td>
            <td>{$details}</td>
            ";
					$body .= '</tr>';
				}
			}
		}

		$body .= '</table>';

		return $body;
	}

}
