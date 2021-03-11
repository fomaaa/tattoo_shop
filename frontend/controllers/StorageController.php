<?php

namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use backend\controllers\HelperController;

class StorageController extends \yii\web\Controller
{
	public $base_url;
	public $lazy_url;

	public function beforeAction($action)
	{
		$this->base_url = \Yii::getAlias('@storage') . '/web/source/';
		$this->lazy_url = \Yii::getAlias('@storage') . '/web/source/lazyload/';

		return parent::beforeAction($action);
	}

	public function actionIndex($image, $path = false, $size = false)
	{
		$path = str_replace('//', '/', $path);
		$path = str_replace('///', '/', $path);
		$path ? $folder = $path . '/' : '';
		$path = $this->base_url . $folder . $image;

		if (file_exists($path)) {
			$this->checkSize($path);

			$handle = fopen($path, 'rb');

			if ($size) {
				$sizeArray = explode('x', $size);
				$width = (int)$sizeArray[0];
				$height = (int)$sizeArray[1];
				if ($size) $size = $size . '/';
				if ($width && $height) {
					$this->checkDir($size, $folder, 'main');
					$regenerated = $this->base_url . $size . $folder . $image;
					if (file_exists($regenerated)) {
						$handle = fopen($regenerated, 'rb');
					} else {

						HelperController::doResize(
							$path,
							$regenerated,
							[
								'quality' => 90,
								'newWidth' => $width,
								'newHeight' => $height
							],
							true
						);

						if (file_exists($regenerated)) {
							$handle = fopen($regenerated, 'rb');
							$path = $regenerated;
						} else {
							exit();
						}

					}

				}
			}

			$this->return($path, $handle);
		} else {
			throw new \yii\web\NotFoundHttpException();
		}
	}

	public function actionLazyload($image, $path = false, $size = false)
	{
		$path = str_replace('//', '/', $path);
		$path = str_replace('///', '/', $path);
		$path ? $folder = $path . '/' : '';
		//Путь до оригинального файла
		$path = $this->base_url . $folder . $image;
		//Пусть до полноразмерного сжатого файла
		$lazy_path = $this->lazy_url . $folder . $image;

		//Проверяем наличии оригинала
		if (file_exists($path)) {
			$this->checkSize($path);
			//Открываем оригинал
			$handle = fopen($path, 'rb');
			//Если требуется кропинг
			if ($size) {
				//Операции с вычислением размера, проверкой размера и подгонки строк путей
				$sizeArray = explode('x', $size);
				$width = (int)$sizeArray[0];
				$height = (int)$sizeArray[1];
				if ($size) $size = $size . '/';
				if ($width && $height) {
					//Проверяем наличие папки с заданным размером
					$this->checkDir($size, $folder, 'lazy');
					//Формируем путь до файла
					$regenerated = str_replace('//', '/', $this->lazy_url . $size . $folder . $image);
					//Eсли файл не существует, то генерируем его с заданной шириной и высотой
					if (!file_exists($regenerated)) {
						HelperController::doResize(
							$path,
							$regenerated,
							[
								'quality' => 5,
								'newWidth' => $width,
								'newHeight' => $height
							],
							false
						);
					}
					//Отдаем запрашиваемый файл
					$handle = fopen($regenerated, 'rb');
					$this->return($regenerated, $handle);
				}
				//Если кропинг не требуется
			} else {
				//Проверяем наличии полноразмерного сжатого файла, если нету, то создаем
				if (!file_exists($lazy_path)) {
					$this->checkDir('', $folder, 'false');
					//Если нету, генерируем
					HelperController::doResize(
						$path,
						$lazy_path,
						[
							'quality' => 5,
							'newWidth' => 0,
							'newHeight' => 0
						],
						false
					);

				}
				// Отдамем сжатую картинику в полном размере
				$handle = fopen($lazy_path, 'rb');
				$this->return($lazy_path, $handle);
			}
			//Если оригинала нету, выходим
		} else {
			throw new \yii\web\NotFoundHttpException();
		}

	}


	private function return($path, $handle)
	{
		$imageInfo = getimagesize($path);

		if ($imageInfo) {
			header("Content-Type: " . $imageInfo['mime']);
		} else {
			header("Content-Type: image/svg+xml;charset=utf-8");
			echo file_get_contents($path);
			exit();
		}

		fpassthru($handle);
		exit();
	}

	private function checkDir($size, $folder = false, $type = false)
	{
		if ($folder) $folder = '/' . $folder;

		if ($type == 'main') {
			$dir = str_replace('///', '/', $this->base_url . $size . $folder);
			$dir = str_replace('//', '/', $dir);

			if (!is_dir($dir)) {
				if (!$res = mkdir($dir, 0755, true)) {
					throw new BadRequestHttpException('Insufficient permissions to create folder');
				}
				$this->chmod_r($dir, 0755, 0755);
			}
		} else {
			$dir = str_replace('///', '/', $this->lazy_url . $size . $folder);
			$dir = str_replace('//', '/', $dir);

			if (!is_dir($dir)) {
				if (!$res = mkdir($dir, 0755, true)) {
					throw new BadRequestHttpException('Insufficient permissions to create folder');
				}
				$this->chmod_r($dir, 0755, 0755);
			}
		}

	}

	private function checkSize($image)
	{
		$size = filesize($image);

		if ($size > 7000000) {
			exit();
		}
	}


	private function chmod_r($dir, $dirPermissions, $filePermissions)
	{
		$dp = opendir($dir);
		while ($file = readdir($dp)) {
			if (($file == ".") || ($file == ".."))
				continue;

			$fullPath = $dir . "/" . $file;

			if (is_dir($fullPath)) {
				chmod($fullPath, $dirPermissions);
				$this->chmod_r($fullPath, $dirPermissions, $filePermissions);
			} else {
				chmod($fullPath, $filePermissions);
			}

		}
		closedir($dp);
	}
}
