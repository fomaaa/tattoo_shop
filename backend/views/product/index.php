<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use common\models\ProductCategoryModel;
use yii\helpers\ArrayHelper;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-model-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div style="display: inline-block">
		<p>
			<?php echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
		</p>
	</div>
	<div style="display: inline-block">
		<p>
			<a class="btn btn-default" href="/product">Сбросить фильтр</a>
		</p>
	</div>
	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[
	            'label' => 'Изображение',
	            'format' => 'raw',
	            'value' => function($data){
	                return Html::img($data->get_image_url('165x165'),[
	                    'alt'=>$data->name,
	                    'style' => 'width:100px;'
	                ]);
	            },
	            'contentOptions' => ['style' => 'width:100px;']
	        ],
				'name',
			[
			    'attribute'=>'category',
			    'label'=>'Категория',
			    'format'=>'text', // Возможные варианты: raw, html
				'filter' => ArrayHelper::map(\common\models\ProductCategoryModel::find()->asArray()->orderBy('name asc')->all(), 'id', 'name'),
			    'content'=>function($data){
			        return $data->getCategoryName();
			    },
			    // 'filter' => ProductCategoryModel::getParentList()
			],
			'price',
			// 'quantity',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'filter' => array(
					'reserve' => 'Под заказ',
					'instock' => 'В наличии',
					'outstock' => 'Нет в наличии'
				),
//				'filterType' => GridView::FILTER_SELECT2,
				'value' => function($data){
					return $data->get_table_status();
				},
				'filterWidgetOptions' => [
					'options' => ['prompt' => ''],
					'pluginOptions' => [
						'width' => '100%'
					],
				],
			],
			['class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}'],
		],
	]); ?>

</div>
