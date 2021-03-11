<?php

namespace backend\controllers;

use Yii;
use common\models\KeyStorageItem;
use common\models\ProductAttachment;
use common\traits\FormAjaxValidationTrait;
use common\models\ProductModel;
use common\models\Seo;
use common\models\ProductCategoryModel;
use Intervention\Image\ImageManagerStatic;
use yii\imagine\Image;
use Imagine\Image\Box;
/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionNovelty()
    {
        $data = KeyStorageItem::find()->where(['key' => 'frontend.novelty'])->one();
        $model = new ProductModel();
        $products = array();

        if ($_POST) {
            if (is_array($_POST['Product'])){
                $products_id = implode(',' , $_POST['Product']);
                if ($products_id) {
                    $products = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( '. $products_id .')')->all();
                }
                $data->value = $products_id;
            } else {
                $data->value = ' ';
            }

            $data->save();

            return $this->render('product-picker', [
                'products' => $products,
                'model' => $model,
            ]);
        }

        if ($data->value) {
            $products = $products = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( '. $data->value .')')->all();
        }

        return $this->render('product-picker', [
            'products' => $products,
            'model' => $model,
        ]);
    }

    public function actionBestsellers()
    {
        $data = KeyStorageItem::find()->where(['key' => 'frontend.bestsellers'])->one();

        if (!$data) {
            $data = new KeyStorageItem();
            $data->key = 'frontend.bestsellers';
        }

        $model = new ProductModel();
        $products = array();

        if ($_POST) {
            if (is_array($_POST['Product'])){
                $products_id = implode(',' , $_POST['Product']);
                if ($products_id) {
                    $products = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( '. $products_id .')')->all();
                }
                $data->value = $products_id;
            } else {
                $data->value = ' ';
            }

            $data->save();

            return $this->render('product-picker', [
                'products' => $products,
                'model' => $model,
            ]);
        }

        if ($data->value) {
            $products = $products = ProductModel::find()->where(['is_published' => 1])->andWhere('id IN ( '. $data->value .')')->all();
        }

        return $this->render('product-picker', [
            'products' => $products,
            'model' => $model,
        ]);
    }

    public function actionGetProducts()
    {
        $method =  Yii::$app->request->method;

        $s = $_GET['search'];

        $products = ProductModel::find()
                ->select(['id', 'name'])
                ->where(['is_published' => 1])
                ->andWhere(['like', 'name', '%'. $s .'%', false])
                ->orderby('id desc')
                ->offset(10)
                ->all();

        $html = '';

        if ($products) {
            foreach ($products as $key => $product) {
                $html .= '<div class="sortableGroup__item">
                        <div class="productItem">
                            <input type="hidden" name="Product[' . $product->id .']" value="' . $product->id . '">
                            <div class="productItem__head">
                                <div class="productItem__label">
                                    Название товара
                                </div>
                                <h4 class="productItem__title">
                                    ' . $product->name .'
                                </h4>

                                <a href="' . Yii::getAlias('@frontend') . $product->get_url() .'" target="_blank" class="productItem__link">
                                    <i class="fa fa-external-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>';
            }
        }

        return $html;
    }

    public function actionFrontPage()
    {
    	$slider = KeyStorageItem::find()->where(['key' => 'frontend.slider'])->one();
    	$seo = Seo::find()->where(['page_type' => 'home'])->one();

    	if ($_POST) {
			$_POST['DynamicModel']['image'] = array_values($_POST['DynamicModel']['image']);
			$_POST['DynamicModel']['advantage_image'] = array_values($_POST['DynamicModel']['advantage_image']);

    		$data = json_encode($_POST['DynamicModel']);
    		$slider->value = $data;
    		$slider->save();

			if ($_POST['Seo']) {
				$seo_data = $_POST['Seo'];
				if (!$seo)  $seo = new Seo();
				$seo = HelperController::setSeo($seo, $seo_data);
				$seo->page_id = 1;
				$seo->page_type = 'home';
				$seo->save();
			}
		}

        return $this->render('front', ['data' => $slider, 'seo' => $seo]);
    }

	public function actionCatalog()
	{
		$seo = Seo::find()->where(['page_type' => 'catalog'])->one();

		if ($_POST) {
			if ($_POST['Seo']) {
				$seo_data = $_POST['Seo'];
				if (!$seo)  $seo = new Seo();
				$seo = HelperController::setSeo($seo, $seo_data);
				$seo->page_id = 1;
				$seo->page_type = 'catalog';
				$seo->save();
			}
		}

		return $this->render('catalog', ['seo' => $seo]);
	}

    public function actionContact()
    {
        $data = KeyStorageItem::find()->where(['key' => 'frontend.contacts'])->one();

        $seo = Seo::find()->where([ 'page_type' => 'contact'])->one();

        if ($_POST) {
            unset($_POST['_csrf']);
            $seo_data = $_POST['Seo'];
            unset($_POST['Seo']);

            if ($seo) {
                $seo = $this->setSeo($seo, $seo_data);
                $seo->save();
            } else {
                $seo = $this->setSeo(new Seo(), $seo_data);
                $seo->page_id = '1';
                $seo->page_type = 'contact';
                $seo->isNewRecord = 1;
                $seo->save(false);
            }

            $data->value = json_encode($_POST);
            $data->save();
        }


        return $this->render('contact', [
            'data' => json_decode($data->value),
            'seo' => $seo
        ]);
    }


    public function actionLayout()
    {
        $model = new ProductModel();
        $data = KeyStorageItem::find()->where(['key' => 'frontend.layouts'])->one();
        $seo = KeyStorageItem::find()->where(['key' => 'app.seo'])->one();

        $seo = $this->checkKeyValueModel($seo, 'app.seo');

        if ($_POST) {

            $_POST['menu_left'] = serialize($_POST['menu_left']);
            $_POST['menu_right'] = serialize($_POST['menu_right']);
            $_POST['menu_footer'] = serialize($_POST['menu_footer']);
            $_seo = $_POST['Seo'];

            $seo->value = json_encode($_seo);
            $seo->save();

            unset($_POST['Seo']);
            unset($_POST['_csrf']);

            $data->value = json_encode($_POST);
            $data->save();

        }


        return $this->render('layout', [
            'model' => $model,
            'data'  => json_decode($data->value),
            'seo'   => json_decode($seo->value),
        ]);
    }

    public function actionUploader()
    {
        $path = Yii::getAlias('@storage') . '\source';

        $thumb = Yii::getAlias('@storage') . '\source\thumbs\\';

        // $products = ProductModel::find()->all();

        //DELETE EMPTY TAGS IN DESCRIPTION
        // foreach ($products as $key => $product) {

        //     $pattern = "/<p[^>]*><br><\\/p[^>]*>/";
        //     $product->description =  preg_replace($pattern, '', $product->description);

        //     $product->save();
        // }




        //GENERATE THUMBS
        // foreach ($products as $key => $product) {
        //     $filename = explode('/', $product['thumbnail_path']);
        //     $filename = $filename[count($filename) -1];

        //     if ($filename) {
        //         $sizes = ['90x52','165x165','180x104','265x265','535x530'];
        //         // print_r($file);

        //         foreach ($sizes as $size) {
        //             $imagine = Image::getImagine();
        //             $_size = explode('x', $size);
        //             if (file_exists($path . '\\' . $product['thumbnail_path'])) {
        //                 $image = $imagine->open($path . '\\' . $product['thumbnail_path']);
        //                 $image->resize(new Box($_size[0], $_size[1]))
        //                         ->save($thumb  . $size . '\\' . $filename);
        //             }

        //             unset($image);
        //             unset($imagine);
        //         }
        //         echo 'image - ' . $key . ' generated. <br>' ;
        //     }

        //     // if ($key == 0) break;
        // }

        // $files = scandir($path);

        // foreach ($files as $key =>  $file) {
        //     if ($file == '.' || $file == '..') continue;
        //         $filename = $file;
        //             /* @var $file \League\Flysystem\File */
        //         // $file = file_get_contents($path . '\\' . $filename);
        //         $array = ['90x52','165x165','180x104','265x265','535x530'];

        //         foreach ($array as $size) {
        //             $imagine = Image::getImagine();
        //             // echo '<pre>';
        //             // print_r($path . '\\' . $filename);
        //             $_size = explode('x', $size);
        //             $image = $imagine->open($path . '\\' . $filename);
        //             $image->resize(new Box($_size[0], $_size[1]))
        //                     ->save($thumb  . $size . '\import-products\catalog\\' . $filename);


        //         //     $file = ImageManagerStatic::make($file)->resize($_size[0], $_size[1]);
        //         //     file_put_contents($thumb  . $size . '\1\\' . $filename, $file);

        //             unset($image);
        //             unset($imagine);

        //         }
        //         // if ($key == 3) break;
        // }

        //UPLOADS PRODUCTS
        // $path =  \Yii::getAlias('@webroot') . '/import/attachment.csv';
        // $counter = 0;
        // echo '<pre>';
        // $_path = 'C:\OSPanel\domains\tattoo-store.loc\storage\web\source\import-products\catalog\\';
        // if (($handle = fopen($path, "r+")) !== FALSE) {
        //     while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
        //         // print_r($data);
        //         for ($i = 1; $i< count($data); $i+=2) {
        //             $count++;
        //             if ($data[$i]) {
        //                 $name = explode('/', $data[$i]);
        //                 $name = $name[1];
        //                 $product_id =  (int) $data[$i-1];

        //                 // print_r($product_id . ' - ');
        //                 // print_r($name . '<br>');
        //                 // $attachment = new ProductAttachment;

        //                 // if ($product_id) {
        //                 //     $attachment->product_id = $product_id;
        //                 //     $attachment->path = '/import-products/catalog/' . $name;
        //                 //     $attachment->base_url = 'http://storage.tattoopro.localhost/source';
        //                 //     $attachment->name = $name;
        //                 //     $attachment->created_at = time();
        //                 //     $attachment->save(false);

        //                 // }

        //                 // unset($attachment);
        //                     print_r($_path . $name . '<br>');
        //                 if (file_exists($_path . $name)) {
        //                     $sizes = ['90x52','165x165','180x104','265x265','535x530'];

        //                     foreach ($sizes as $size) {
        //                         $imagine = Image::getImagine();
        //                         $_size = explode('x', $size);
        //                         $image = $imagine->open($_path  . $name);
        //                         $image->resize(new Box($_size[0], $_size[1]))
        //                                     ->save($thumb  . $size . '\\' . $name);

        //                         unset($image);
        //                         unset($imagine);
        //                     }
        //                     echo 'image - ' . $key . ' generated. <br>' ;
        //                 }

        //             }
        //         }
                // echo $count;
                // foreach ($data as $key => $item) {
                //     if (!$key || $key == 1 || $key == 2)  continue;
                //     print_r($item);

                // }

        //         $_data[$counter]['id'] = $data['0']; //parent
        //         // $_data[$counter]['parent'] = $data['1']; //parent
        //         $_data[$counter]['name'] = $data['1']; //name
        //         $cats = explode(',', $data['2']);
        //         $_data[$counter]['category'] = $cats['0']; //name
        //         $_data[$counter]['quantity'] = $data['10']; //sort
        //         $_data[$counter]['slug'] = $data['28'];
        //         $_data[$counter]['price'] = $data['15'];
        //         $_data[$counter]['description'] = $data['29'];
        //         $_data[$counter]['thumbnail_base_url'] = 'http://storage.tattoopro.localhost/source';
        //         $_data[$counter]['thumbnail_path'] = $data['13']; //image

        //         $counter++;
        //     }
        //     fclose($handle);
        // }
        // // echo '<pre>';
        // // print_r($_data);
        // foreach ($_data as $key => $item) {
        //     if (!$key) continue;
        //     $model = new ProductModel();
        //     $model->id = $item['id'];
        //     $model->name = $item['name'];
        //     $model->category = $item['category'];
        //     $model->quantity = $item['quantity'];
        //     $model->slug = $item['slug'];
        //     $model->price = $item['price'];
        //     $model->description = $item['description'];

        //     if ($item['thumbnail_path']) {
        //         $model->thumbnail_base_url = 'http://storage.tattoopro.localhost/source';
        //         $model->thumbnail_path = '/import-products/' . $item['thumbnail_path']; //image
        //     }
        //     $model->isNewRecord = 1;
        //     // print_r($model);
        //     $model->save(false);

        //     unset($model);
        //     if ($key == '1280') break;
        // }
    }

	public function actionErrors()
	{
		$fields = ['title', 'description', 420, 768, 1200, 'btn', 'link', 'subtitle'];
		$error404_data = array();
		$error500_data = array();

		$error404 = KeyStorageItem::find()->where(['key' => 'frontend.404'])->one();

		$error404 = $this->checkKeyValueModel($error404, 'frontend.404');

		$error500 = KeyStorageItem::find()->where(['key' => 'frontend.500'])->one();

		$error500 = $this->checkKeyValueModel($error500, 'frontend.500');

		if ($_POST) {
			foreach ($fields as $key => $item) {
				if (isset($_POST['DynamicModel']['error404_' . $item])) {
					$error404_data['error404_' . $item] = $_POST['DynamicModel']['error404_' . $item];
				}

				if (isset($_POST['DynamicModel']['error500_' . $item])) {
					$error500_data['error500_' . $item] = $_POST['DynamicModel']['error500_' . $item];
				}

			}
			$error404->value = json_encode($error404_data);
			$error404->save();
			$error500->value = json_encode($error500_data);
			$error500->save();
		}

		return $this->render('error_settings', [
			'error404' => json_decode($error404->value, true),
			'error500' => json_decode($error500->value, true),
		]);
	}

    private function check404($url)
    {
        $code = false;
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
            $code = 404;
        }

        curl_close($handle);

        return $code;
    }

    private function checkKeyValueModel($model, $key)
    {
        if (!$model && $key) {
            $model = new KeyStorageItem();
            $model->key = $key;
            $model->value = ' ';
            $model->isNewRecord = 1;
            $model->save(false);
        }

        return $model;
    }

    private function setSeo($model, $data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $item) {
                $model->{$key} = $item;
            }
        }

        return $model;
    }
}
