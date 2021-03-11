<?php

namespace backend\controllers;

use common\models\ProductModel;
use Yii;
use common\models\Orders;
use common\models\OrdersSearchModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\UserProfile;
use common\models\OrderProduct;
/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;

		return parent::beforeAction($action);
	}


    public function actionIndex()
    {
        $searchModel = new OrdersSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionChangeStatus()
	{
		if ($_POST['val'] && $_POST['order_id']) {
			$order = Orders::find()->where(['id' => $_POST['order_id']])->one();
			$order->status =  $_POST['val'];
			\Yii::$app->email->sendNotification('status', $order);

			return $order->save();
		}
	}

    public function actionView($id)
    {
        $model = $this->findModel($id);

        $user =  User::findOne($model->user_id);
        $userData = UserProfile::findOne($model->user_id);

        $products  = OrderProduct::find()
                        ->select(['product.*', 'order_product.*', 'order_product.quantity as current_quantity'])
                        ->leftJoin('product', 'product.id = order_product.product_id')
                        ->where(['order_id' => $model->id])
                        ->asArray()
                        ->all();
        // echo '<pre>';
        // print_r($products);

        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'userData' => $userData,
            'products' => $products
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
