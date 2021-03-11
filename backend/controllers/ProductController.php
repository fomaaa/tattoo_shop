<?php

namespace backend\controllers;

use Yii;
use common\models\ProductModel;
use common\models\ProductCategoryModel;
use common\models\ProductSearchModel;
use common\traits\FormAjaxValidationTrait;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use common\models\Seo;
use backend\controllers\HelperController;
/**
 * ProductController implements the CRUD actions for ProductModel model.
 */
class ProductController extends Controller
{

    use FormAjaxValidationTrait;

    public function actions()
    {
        return [
            'thumbnail-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'thumbnail-delete',
            ],
            'thumbnail-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }

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
     * Lists all ProductModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductModel model.
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
     * Creates a new ProductModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductModel();

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (is_array($_POST['ProductModel']['attributes_key'])) {
                foreach ($_POST['ProductModel']['attributes_key'] as $key => $item) {
                    $attributes[$key]['key'] = $item;
                    $attributes[$key]['value'] = $_POST['ProductModel']['attributes_value'][$key];
                }
            }
            $model->updateAttributes(['attributes' => json_encode($attributes)]);
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                $seo = HelperController::setSeo(new Seo(), $seo_data);
                $seo->page_id = $model->id;
                $seo->page_type = 'product';
                $seo->isNewRecord = 1;
                $seo->save(false);
            }
            return $this->redirect(['update', 'id' => $model->id]);
        }

        $categories = ProductCategoryModel::find()->all();
        foreach ($categories as $category) {
            $arrCat[$category->id] = $category->name;
        }

        if (!is_array($arrCat)) $arrCat = array('');
        return $this->render('create', [
            'model' => $model,
            'categories' => $arrCat
        ]);
    }

    /**
     * Updates an existing ProductModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->performAjaxValidation($model);
        $seo = Seo::find()->where(['page_id' => $id, 'page_type' => 'product'])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (is_array($_POST['ProductModel']['attributes_key'])) {
                foreach ($_POST['ProductModel']['attributes_key'] as $key => $item) {
                    $attributes[$key]['key'] = $item;
                    $attributes[$key]['value'] = $_POST['ProductModel']['attributes_value'][$key];
                }
            }

            $model->updateAttributes(['attributes' => json_encode($attributes)]);
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                if ($seo) {
                    $seo = HelperController::setSeo($seo, $seo_data);
                    $seo->save();
                } else {
                    $seo = HelperController::setSeo(new Seo(), $seo_data);
                    $seo->page_id = $model->id;
                    $seo->page_type = 'product';
                    $seo->isNewRecord = 1;
                    $seo->save(false);
                }
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        $categories = ProductCategoryModel::find()->all();
        foreach ($categories as $category) {
            $arrCat[$category->id] = $category->name;
        }
        return $this->render('update', [
            'model' => $model,
            'categories' => $arrCat,
            'seo' => $seo
        ]);
    }

    /**
     * Deletes an existing ProductModel model.
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
     * Finds the ProductModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductModel::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
