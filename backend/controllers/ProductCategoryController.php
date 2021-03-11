<?php

namespace backend\controllers;

use Yii;
use common\models\ProductCategoryModel;
use common\models\ProductCategorySearchModel;
use common\traits\FormAjaxValidationTrait;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Seo;
use backend\controllers\HelperController;
/**
 * ProductCategoryController implements the CRUD actions for ProductCategoryModel model.
 */
class ProductCategoryController extends Controller
{
    use FormAjaxValidationTrait;

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

    /**
     * Lists all ProductCategoryModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategoryModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductCategoryModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategoryModel();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                $seo = HelperController::setSeo(new Seo(), $seo_data);
                $seo->page_id = $model->id;
                $seo->page_type = 'product-category';
                $seo->isNewRecord = 1;
                $seo->save(false);
            }
            return $this->redirect('/product-category');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductCategoryModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $seo = Seo::find()->where(['page_id' => $id, 'page_type' => 'product-category'])->one();
        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                if ($seo) {
                    $seo = HelperController::setSeo($seo, $seo_data);
                    $seo->save();
                } else {
                    $seo = HelperController::setSeo(new Seo(), $seo_data);
                    $seo->page_id = $model->id;
                    $seo->page_type = 'product-category';
                    $seo->isNewRecord = 1;
                    $seo->save(false);
                }
            }

            return $this->redirect('/product-category');
        }
        return $this->render('update', [
            'model' => $model,
            'seo'   => $seo
        ]);
    }

    /**
     * Deletes an existing ProductCategoryModel model.
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
     * Finds the ProductCategoryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCategoryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategoryModel::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
