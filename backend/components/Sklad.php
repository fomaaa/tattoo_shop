<?php

namespace backend\components;

use yii\base\Component;
use MoySklad\MoySklad;
use MoySklad\Entities\Products\Product;
use MoySklad\Components\Specs\QuerySpecs\QuerySpecs;


class Sklad extends Component
{
	private $sklad;

	public function __construct()
	{
		$this->sklad =  MoySklad::getInstance('admin@tattoopromsk', '68944b407d');
	}


	public function updateGoods()
	{
//		$list = Product::query($this->sklad)->getList();
		$list = Product::query($this->sklad, QuerySpecs::create([
			"offset" => 0,
			"maxResults" => 50,
		]))->getList();
//
		$categories = array();
		if ($list) {
			foreach ($list as $key => $product) {
				echo '<pre>';
				print_r($product->relations);
				echo '</pre>';
				if ($product->pathName) {
					$categories[] = $product->pathName;
				}
			}
		}
		$categories = array_values(array_unique($categories));

	}
}
