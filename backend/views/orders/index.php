<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--     <p>
        <?php echo Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
	<div style="display: inline-block">
		<p>
			<a class="btn btn-default" href="/orders">Сбросить фильтр</a>
		</p>
	</div>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'label'=>'Номер заказа',
                'format'=>'text', //
                'content'=>function($data){
                    return $data->getNumber();
                },
            ],
			[
				'attribute'=>'user',
				'label'=>'Пользователь',
				'format'=>'text', //
				'value'=>'user.username', //
			],
			[
				'attribute' => 'delivery_type',
				'format' => 'raw',
				'filter' => array(
					1 => 'Доставка курьером',
					2 => 'Самовывоз из магазина в Москве',
					3 => 'Доставка по России'
				),
//				'filterType' => GridView::FILTER_SELECT2,
				'value' => function($data){
					return $data::getDeliveryType($data->delivery_type);
				},
				'filterWidgetOptions' => [
					'options' => ['prompt' => ''],
					'pluginOptions' => [
						'width' => '100%'
					],
				],
			],
			[
				'attribute' => 'status',
				'format' => 'raw',
				'filter' => array(
					'processing' => 'В обработке',
					'accepted' => 'Принятые',
					'finished' => 'Завершенный',
					'canceled' => 'Отмененный',
				),
				'value' => function($data){
					return $data::get_the_status($data->status);
				},
				'filterWidgetOptions' => [
					'options' => ['prompt' => ''],
					'pluginOptions' => [
						'width' => '100%'
					],
				],
			],
            [
                'attribute'=>'total',
                'label'=>'Итого',
                'format'=>'text', //
                'content'=>function($data){
                    return $data->getTotal();
                },
            ],
            [
                'attribute'=>'created_at',
                'label'=>'Дата и время оформления',
                'format'=>'text', //
            ],
			['class' => 'yii\grid\ActionColumn',
				'template' => '{view} {delete}'],
        ],
    ]); ?>

</div>
