<?php


namespace frontend\components;

use Yii;
use yii\base\Component;



class Helper extends Component
{
	public static function findDelimeter($name)
	{
		$a = substr_count($name, '/');
		$b = substr_count($name, '\\');

		return $a > $b ? '/' : '\\';
	}

	public function getLayoutData()
	{


	}

	public function getImage($image)
	{
		if (is_array($image)) {
			if ($image['path']) {
				return str_replace('\\', '/', \Yii::getAlias('@frontendUrl') . '/images' . $image['path']);
			}
		} else if (is_object($image)) {
			if ($image->path) {
				return str_replace('\\', '/', \Yii::getAlias('@frontendUrl') . '/images' . $image->path);
			}
		}
	}
}
