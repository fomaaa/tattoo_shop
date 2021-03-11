<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleAttachment;
use frontend\models\search\ArticleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\KeyStorageItem;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends Controller
{
    use \common\traits\GlobalFunctions;
    /**
     * @return string
     */
    public function beforeAction($action)
    {
        $this->putSEO();
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {

        return $this->render('index', [
            'articles' => Article::find()->where(['status' => 1])->orderby('published_at desc')->all()
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = Article::find()->published()->andWhere(['slug' => $slug])->one();

        if (!$model) {
            throw new NotFoundHttpException;
        }
        $this->putSEO($model->id, 'blog');
        $subscribe = KeyStorageItem::find()->where(['key' => 'settigns.subscribe'])->one();
        $subscribe = json_decode($subscribe->value);

        $viewFile = $model->view ?: 'view';
        return $this->render('view', ['model' => $model, 'subscribe' => $subscribe]);
    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }
}
