<?php

namespace common\models;


use Yii;
use common\models\User;
use common\models\UserProfile;
use Appwilio\CdekSDK\Requests\CalculationAuthorizedRequest;
use Appwilio\CdekSDK\Requests\CalculationRequest;
use common\models\KeyStorageItem;
/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $delivery_type
 * @property int $payment_type
 * @property int $delivery_price
 * @property string $status
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $post_index
 * @property string $total
 * @property string $certificate
 * @property string $created_at
 * @property string $deleted_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery_type', 'payment_type', 'delivery_price', 'status', 'email', 'firstname', 'lastname', 'phone', 'country', 'city', 'address', 'total'], 'required'],
            [['user_id', 'delivery_type', 'payment_type', 'delivery_price'], 'integer'],
            [['created_at', 'deleted_at'], 'safe'],
            [['status', 'email', 'firstname', 'lastname', 'phone', 'country', 'city', 'address', 'post_index', 'total', 'certificate'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'user_id' => 'Пользователь',
            'delivery_type' => 'Тип доставки',
            'payment_type' => 'Тип оплаты',
            'delivery_price' => 'Цена доставки',
            'status' => 'Статус',
            'email' => 'Email',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'phone' => 'Телефон',
            'country' => 'Страна',
            'city' => 'Город',
            'address' => 'Адрес',
            'post_index' => 'Индекс',
            'total' => 'Итого',
            'certificate' => 'Сертификат',
            'created_at' => 'Создан',
            'deleted_at' => 'Удален',
        ];
    }

    public function getNumber()
    {
        return '№ ' . str_pad($this->id , 9, '0', STR_PAD_LEFT);
    }

    public function getTotal()
    {
        return $this->total . 'р.';
    }

//    public function getUser()
//    {
//        $user = User::findOne($this->user_id);
//
//        if ($user) return $user->username;
//    }
    public function getUserData()
    {
        $user = UserProfile::findOne($this->user_id);

        if ($user) return $user->username;
    }

    public function getCreatedAt()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }


    public static function getDeliveryType($id)
    {
        $array = [
            1 => 'Доставка курьером',
            2 => 'Самовывоз из магазина в Москве',
            3 => 'Доставка по России'
        ];

        if (isset($array[$id])) return $array[$id];

    }

    public function getCDEKprice($reciever)
    {
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

        $client = new \Appwilio\CdekSDK\CdekClient('z9GRRu7FxmO53CQ9cFfI6qiy32wpfTkd', 'w24JTCv4MnAcuRTx0oHjHLDtyt3I6IBq', $guzzleOptions = [
            'timeout' => 5
        ]);

        $request = (new CalculationRequest())
            ->setSenderCityPostCode('129090')
            ->setReceiverCityPostCode($reciever)
            ->setTariffId(1)
            ->addGood([
                'weight' => 1,
                'length' => 10,
                'width'  => 10,
                'height' => 10,
            ]
        );

        $response = $client->sendCalculationRequest($request);

        if ($price = $response->getPrice()) {
            return $price;
        }
    }

    public function getDeliveryPrice()
    {
        $delivery = KeyStorageItem::find()->where(['key' => 'frontend.delivery'])->one();

        return $delivery->value;

    }

    public static function getPaymentType($id)
    {
        $array = [
            '1' => 'При получении',
            '2' => 'Оплата онлайн',
        ];

        if (isset($array[$id])) return $array[$id];
    }


    public static function getStatus($id)
    {
        $array = [
            'processing' => 'В обработке',
            'accepted' => 'Принятые',
            'finished' => 'Завершенный',
            'canceled' => 'Отмененный',
        ];

        if (isset($array[$id])) return $array[$id];
    }

    public static function get_the_status($id)
    {
        $array = [
            'processing' => '<small class="label bg-yellow">В обработке</small>',
            'accepted' => '<small class="label bg-primary">Принятые</small>',
            'finished' => '<small class="label bg-green">Завершенный</small>',
            'canceled' => '<small class="label bg-red">Отменено</small>',
        ];

        if (isset($array[$id])) return $array[$id];
    }

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
