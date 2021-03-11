<?php

namespace backend\controllers;

class DaemonController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
	{
		\Yii::$app->sklad->updateGoods();
	}
}
