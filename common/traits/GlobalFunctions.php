<?php

namespace common\traits;

use common\models\KeyStorageItem;
use common\models\Seo;
use frontend\modules\user\models\LoginForm;
use Yii;
use yii\base\ExitException;
use yii\base\Model;

trait GlobalFunctions
{

	/**
	 * @param array|Model $model
	 *
	 * @throws ExitException
	 */
	public function setGlobals()
	{
		$layout = KeyStorageItem::find()->where(['key' => 'frontend.layouts'])->one();
		if ($layout) {
			Yii::$app->view->params['layout'] = json_decode($layout->value);
		}

		Yii::$app->view->params['authModel'] = new LoginForm();
	}


	public function putSEO($id = 0, $type = '', $data = false)
	{
		$page_seo = Seo::find()->where(['page_id' => $id, 'page_type' => $type])->one();

		$seo = KeyStorageItem::find()->where(['key' => 'app.seo'])->one();
		if ($type == 'product-category' || $type == 'product') {
//			$data = json_decode(json_encode($data), true);
			if (isset($data->name)) {
				$addition_name = $data->name;
			} elseif(isset($data['name'])) {
				$addition_name = $data['name'];
			}
		}
		if ($seo) {
			$seo = json_decode($seo->value);

			if ($seo) {
				$html = '';

				foreach ($seo as $key => $item) {
					if ($item || $page_seo->{$key}) {
						if ($key != 'title') {
							$_key = $key;
							$key = str_replace('twitter_', 'twitter:', $key);
							$key = str_replace('og_', 'og:', $key);
							$key = str_replace('fb_', 'fb:', $key);

							if ($page_seo->{$_key}) {
								$html .= "<meta name='" . $key . "' content='" . $page_seo->{$_key} . "' />";
							} else {
								$html .= "<meta name='" . $key . "' content='" . $item . "' />";
							}
						} else {
							if ($page_seo->title) {
								Yii::$app->view->params['seo_title'] = $page_seo->title;
								$html .= "<title>" . $page_seo->title . "</title>";
							} elseif($type == 'product-category' || $type == 'product') {
								Yii::$app->view->params['seo_title'] = $addition_name;
								$html .= "<title>" . $addition_name . "</title>";
							} else {
								Yii::$app->view->params['seo_title'] = $item;
								$html .= "<title>" . $item . "</title>";
							}
						}
					}
				}
			}

			\Yii::$app->view->params['meta_html'] = $html;
		}

	}

}
