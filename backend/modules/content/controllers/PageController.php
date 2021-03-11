<?php

namespace backend\modules\content\controllers;

use backend\modules\content\models\search\PageSearch;
use common\models\Page;
use common\models\Seo;
use common\traits\FormAjaxValidationTrait;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\controllers\HelperController;

class PageController extends Controller
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
     * @return mixed
     */
    public function actionIndex()
    {
        $page = new Page();

        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['index']);
        }
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $page,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $page = new Page();

        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                $seo = HelperController::setSeo(new Seo(), $seo_data);
                $seo->page_id = $page->id;
                $seo->page_type = 'page';
                $seo->isNewRecord = 1;
                $seo->save(false);
            }
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $page,
            'seo'   => $seo
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $page = $this->findModel($id);
        $seo = Seo::find()->where(['page_id' => $id, 'page_type' => 'page'])->one();
        $this->performAjaxValidation($page);

        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            if ($_POST['Seo']) {
                $seo_data = $_POST['Seo'];
                if ($seo) {
                    $seo = HelperController::setSeo($seo, $seo_data);
                    $seo->save();
                } else {
                    $seo = HelperController::setSeo(new Seo(), $seo_data);
                    $seo->page_id = $page->id;
                    $seo->page_type = 'page';
                    $seo->isNewRecord = 1;
                    $seo->save(false);
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $page,
            'seo'   => $seo
        ]);
    }

    /**
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     *
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
