<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use common\models\Orders;
use common\models\OrderProduct;

class DefaultController extends Controller
{
	use \common\traits\GlobalFunctions;
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

	public function beforeAction($action)
	{
		$this->putSEO();

		return parent::beforeAction($action);
	}

    public function actionIndex()
    {
        $accountForm = new AccountForm();
        $accountForm->setUser(Yii::$app->user->identity);

        $model = new MultiModel([
            'models' => [
                'account' => $accountForm,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);

       if ($message = ActiveForm::validate($model)) {
                Yii::$app->session->setFlash('alert', [
                    'class' => 'error',
                    'body' => Yii::t('frontend', $message['multimodel-account'][0][0], [], $locale)
                ]);

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $locale = $model->getModel('profile')->locale;

            Yii::$app->session->setFlash('alert', [
                'class' => 'success',
                'body' => 'Данные успешно сохранены!'
            ]);

            return $this->refresh();
        }
        return $this->render('index', ['model' => $model]);
    }


    public function actionChangePassword()
    {
        $accountForm = new AccountForm();
        $accountForm->setUser(Yii::$app->user->identity);

        $model = new MultiModel([
            'models' => [
                'account' => $accountForm,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);
        if (Yii::$app->request->post() ) {

            $accountForm->password = $_POST['AccountForm']['password'];
            $accountForm->password_confirm = $_POST['AccountForm']['password_confirm'];

            if (!$_POST['AccountForm']['password']) {
                Yii::$app->session->setFlash('alert', [
                    'class' => 'error',
                    'body' => Yii::t('frontend', 'Необходимо ввести новый пароль', [], $locale)
                ]);

                return $this->refresh();
            }

            if ($message = ActiveForm::validate($model)) {
                Yii::$app->session->setFlash('alert', [
                    'class' => 'error',
                    'body' => Yii::t('frontend', $message['multimodel-account'][0][0], [], $locale)
                ]);

                return $this->refresh();
            }

            $res = $accountForm->save();
            if ($res) {
                // Yii::$app->session->setFlash('forceUpdateLocale');
                Yii::$app->session->setFlash('alert', [
                    'class' => 'success',
                    'body' => Yii::t('frontend', 'Пароль успешно обновлен', [], $locale)
                ]);
            }
            return $this->refresh();
        }

        return $this->render('change-password', ['model' => $model]);
    }

    public function actionHistory()
    {
        $user_id = Yii::$app->user->id;


        $orders = Orders::find()
            ->select(['orders.*'])
            ->where(['orders.user_id' => $user_id, 'orders.deleted_at' => NULL])
            ->leftJoin('order_product', 'orders.id = order_product.order_id')
            ->orderby('orders.created_at desc')
            ->asArray()
            // ->groupby('orders.id')
            ->all();

        $products = Orders::find()
            ->select(['orders.id','product.*', 'order_product.*', 'order_product.quantity as current_quantity'])
            ->where(['orders.user_id' => $user_id, 'orders.deleted_at' => NULL])
            ->leftJoin('order_product', 'orders.id = order_product.order_id')
            ->leftJoin('product', 'product.id = order_product.product_id')
            ->asArray()
            // ->groupby('orders.id')
            ->all();



        $statuses = Orders::find()
                        ->select(['status', 'count(*) as count'])
                        ->asArray()
                        ->where(['user_id' => $user_id])
                        ->groupby('status')
                        ->all();

        // foreach ($statuses as $satus)

        //$input = array_map("unserialize", array_unique(array_map("serialize", $input)));

        // echo '<pre>';
        // print_r($statuses);

        return $this->render('history', [
            'orders' => $orders,
            'statuses' => $statuses,
            'products' => $products
        ]);
    }
}
