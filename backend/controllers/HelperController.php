<?php

namespace backend\controllers;

class HelperController extends \yii\web\Controller
{
    public static function setSeo($model, $data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $item) {
                $model->{$key} = $item;
            }
        }

        return $model;
    }

	public static function doResize($imageLocation, $imageDestination, Array $options = null, $fq = false)
	{
		$image = new \Imagick(realpath($imageLocation));

		$ratio = $options['newWidth'] / $options['newHeight'];


		$old_width = $image->getImageWidth();
		$old_height = $image->getImageHeight();
		$old_ratio = $old_width / $old_height;


		if ($ratio > $old_ratio) {
			$new_width = $options['newWidth'];
			$new_height = $options['newWidth'] / $old_width * $old_height;
			$crop_x = 0;
			$crop_y = intval(($new_height - $options['newHeight']) / 2);
		}
		else {
			$new_width = $options['newHeight'] / $old_height * $old_width;
			$new_height = $options['newHeight'];
			$crop_x = intval(($new_width - $options['newWidth']) / 2);
			$crop_y = 0;
		}

		if ($fq) {
			$image->setImageCompressionQuality(80);
		} else {
			$image->gaussianBlurImage(10, 10);
			$image->setImageCompressionQuality(20);
		}

		if ($new_width && $new_height) {
			$image->resizeImage($new_width, $new_height, \Imagick::FILTER_LANCZOS, 1, false);
			$image->cropImage($options['newWidth'], $options['newHeight'], $crop_x, $crop_y);
		}

		$row = $image->getImageBlob();
		file_put_contents($imageDestination, $row);
	}

	public static function createPlaceholder($origin, $path)
	{
		// echo "convert '".$origin."' -quality 20  -filter Gaussian -resize 50% -define filter:sigma=10 -resize 200% '". $path ."'";
		$exe = "/opt/local/bin/convert '".$origin."' -quality 20  -filter Gaussian -resize 50% -define filter:sigma=10 -resize 200% '". $path ."'";
		shell_exec($exe);
	}


	public static function findDelimeter($name)
	{
		$a = substr_count($name, '/');
		$b = substr_count($name, '\\');

		return $a > $b ? '/' : '\\';
	}
}
