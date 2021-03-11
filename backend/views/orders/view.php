<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProductModel;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = 'Заказ: ' .  $model->getNumber() . ' ' .'<small class="label bg-yellow" style="vertical-align: middle; margin-left: 5px;">В обработке</small>';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Заказ: ' . ' №' . $model->id;
?>

<div class="orders-view">

	<div class="row">
		<div class="col-md-5 text-right pull-right">
			<p>
				<?php echo Html::a('Удалить заказ', ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
						'method' => 'post',
					],
				]) ?>
				<?php //echo Html::a('Сохранить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary border-left border-right">
						<div class="box-header">
							<h4>
								<i class="fa  fa-shopping-cart margin-r-5"></i>
								Информация о заказе</h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-4">
									<strong>
										<i class="fa fa-calendar  margin-r-5"></i>
										Дата</strong>

									<p class="text-muted">
										<?php echo date('d.m.Y', strtotime($model->created_at)) ?>
									</p>
								</div>
								<div class="col-md-4">
									<strong><i class="fa fa-credit-card  margin-r-5"></i> Способ
										оплаты</strong>

									<p class="text-muted"><?php echo $model::getPaymentType($model->payment_type) ?></p>
								</div>
								<div class="col-md-4">
									<strong><i class="fa fa-truck margin-r-5"></i>Способ
										доставки</strong>

									<p class="text-muted"><?php echo $model::getDeliveryType($model->delivery_type) ?></p>
								</div>
								<div class="col-md-5">
									<strong><i class="fa fa-status margin-r-5"></i>Статус</strong>
									<?php $statuses = array(
										'Новая', 'Обработана', 'Закрыта'
									); ?>
									<?php
									$array = [
										'processing' => 'В обработке',
										'accepted' => 'Принятые',
										'finished' => 'Завершенный',
										'canceled' => 'Отмененный',
									];
									$html = ' <select name="order-status" class="form-control js-ajax-status" data-id="' . $model->id . '">';
									foreach ($array as $key => $item) {
										if ($key == $model->status) $selected = 'selected="selected"';
										$html .= '<option ' . $selected . ' value="' . $key . '">' . $item . '</option>';
										unset($selected);
									}
									$html .= '</select>';
									echo $html;
									?>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="box box-primary border-left border-right">
								<div class="box-header with-border">
									<h3 class="box-title">
										<i class="fa  fa-user margin-r-5"></i>
										Информация о клиенте</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<strong>
										E-mail</strong>

									<p class="text-muted">
										<?php echo $user->email; ?>
									</p>

									<hr>

									<strong>Имя</strong>

									<p class="text-muted"><?php echo $userData->firstname ?></p>

									<hr>

									<strong>Фамилия</strong>

									<p class="text-muted"><?php echo $userData->lastname ?></p>

									<hr>

									<strong>Телефон</strong>

									<p class="text-muted"><?php echo $userData->phone ?></p>
								</div>
								<!-- /.box-body -->
							</div>
						</div>

						<div class="col-md-6">
							<div class="box box-primary border-left border-right">
								<div class="box-header with-border">
									<h3 class="box-title">
										<i class="fa  fa-plane margin-r-5"></i>
										Адрес доставки</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<strong>
										Страна</strong>

									<p class="text-muted">
										<?php echo $model->firstname ?>
									</p>

									<hr>

									<strong>Город</strong>

									<p class="text-muted"><?php echo $model->city ?></p>

									<hr>

									<strong>Адрес</strong>

									<p class="text-muted"><?php echo $model->address ?></p>

									<hr>

									<strong>Индекс</strong>

									<p class="text-muted"><?php echo $model->post_index ?></p>
								</div>
								<!-- /.box-body -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="box box-primary border-left border-right">
				<div class="box-header">
					<h4>
						<i class="fa  fa-shopping-cart margin-r-5"></i>
						Детали заказа</h4>
				</div>
				<div class="box-body">
					<div id="w0" class="grid-view">
						<table class="table table-striped table-bordered">
							<tbody>
							<thead>
							<tr>
								<th>#</th>
								<th>Наименование товара
								</th>
								<th>Категория
								</th>
								<th>Количество</th>
								<th>Цена за единицу</th>
								<th>Итого</th>
							</tr>
							</thead>
							<?php foreach ($products as $key => $product) : ?>
							<?php
								$_product = ProductModel::findOne($product['product_id']);
							 ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><a href="<?php echo Yii::getAlias('@frontend') . $_product->get_url(); ?>" target="_blank"><?php echo $product['name']; ?></a>
								</td>
								<td><?php echo $_product->getCategoryName(); ?></td>
								<td><?php echo $product['current_quantity'] ?></td>
								<td><?php echo $product['actual_price'] ?>р.</td>
								<td><?php echo $product['actual_price'] * $product['current_quantity']  ?>р.</td>
							</tr>
							<?php endforeach; ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>Сумма итого: </td>
									<td><?php echo $model->total  ?>р.</td>
								</tr>
							</tbody></table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--<div class="orders-view">-->
<!---->
<!--	<p>-->
<!---->
<!--	</p>-->
<!---->
<!--	--><?php //echo DetailView::widget([
//		'model' => $model,
//		'attributes' => [
//			'id',
//			'user_id',
//			'delivery_type',
//			'payment_type',
//			'delivery_price',
//			'status',
//			'email:email',
//			'firstname',
//			'lastname',
//			'phone',
//			'country',
//			'city',
//			'address',
//			'post_index',
//			'total',
//			'certificate',
//			'created_at',
//			'deleted_at',
//		],
//	]) ?>
<!---->
<!--</div>-->
