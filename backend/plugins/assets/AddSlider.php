<?php

namespace app\plugins\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class addSlider extends AssetBundle
{
	public $sourcePath = '@backend/plugins';

	public $js = [
//		'js/dropzone.js',
//		'js/addBrPlugin.js'
	];

	public $css = [
		'css/dropzone.css',
		'css/app.css',
	];

	public $depends = [
		YiiAsset::class,
	];

	public $publishOptions = [
		'forceCopy' => true,
	];
}
