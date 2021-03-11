<?php
/*
    Frontend компонент для работы с breadcrumbs
*/
namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use common\models\ProductModel;
use common\models\ProductCategoryModel;

class Breadcrumbs extends Component
{
	private $base;

	public function __construct()
	{
		$this->base = '/catalog/';
	}

	public function getCategoryLink($id)
	{
		if ($id) {
			$category = $this->getCategory($id);
			$categories = array_reverse($this->getParentTree($category));

			if ($categories) {
				$categories  = implode(ArrayHelper::map($categories, 'id', 'slug'), '/');
			}
		}

		return $this->base .  $categories;
	}

	public function getProductLink($product)
	{
		$categories = $this->getCategoryLink($product->category);

		return $categories . '/' . $product->slug;
	}

	private function getCategory($id)
	{
		if ($model = ProductCategoryModel::find()->select(['id', 'name', 'slug', 'parent'])->where(['id' => $id])->one()) {
			return $model;
		}
	}

	private function getParentTree($category)
	{
		$categories[] = $category;

		if ($category->parent) {
			$newCategory = $this->getCategory($category->parent);

			if ($newCategory->parent !== 0) {
				$categories = $this->getParentTree($newCategory);
			} else {
				$categories[] = $newCategory;
			}
		}

		return $categories;
	}

	public function getBreadcrumbs($product)
	{
		$breadcrumbs = array(
			0 => array(
				'name' => 'Главная',
				'link' => '/',
				'is_product' => false
			)
		);
		$category = $this->getCategory($product->category);
		$categories = array_reverse($this->getParentTree($category));

		if ($categories) {
			foreach ($categories as $key => $item) {
				$breadcrumbs[] = array(
					'name' => $item->name,
					'link' => $this->getCategoryLink($item->id),
					'is_product' => false
				);
			}
		}

		$product = array(
			'name' => $product->name,
			'link' => false,
			'is_product' => true
		);
		$breadcrumbs[] = (array) $product;

		return $breadcrumbs;

	}
}
