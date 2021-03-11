<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace frontend\controllers;

use common\models\Page;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{
    use \common\traits\GlobalFunctions;

	public function beforeAction($action)
    {
        $this->putSEO();
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionView($slug)
    {
        $model = Page::find()->where(['slug' => $slug, 'status' => Page::STATUS_PUBLISHED])->one();
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('frontend', 'Page not found'));
        }
        $this->putSEO($model->id, 'page');
        $viewFile = $model->view ?: 'view';
        return $this->render('view', ['model' => $model]);
    }
}
