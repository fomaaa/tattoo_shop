<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */
/* @var $form yii\bootstrap\ActiveForm */
?>


<div class="product-model-index">

	<?php $form = ActiveForm::begin(
		['options' => ['enctype' => 'multipart/form-data'],
			'id' => 'dynamic-form-1',
			]); ?>


	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-md-5">
					<h4>Редактирование: Контактные данные / Страница Контакты</h4>
				</div>

				<div class="col-md-7 text-right">
					<div class="col-md-2 pull-right">
						<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
					</div>

					<div class="col-md-3 pull-right">
						<div class="checkbox">
							<label for="productmodel-is_published">
								<input type="checkbox" id="productmodel-is_published" <?php if ($data->is_published) echo ' checked '; ?>
														name="is_published">
								Показать страницу
							</label>
							<p class="help-block help-block-error"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#contactsData" data-toggle="tab">Контактные данные</a>
				</li>
				<li><a href="#map" data-toggle="tab">Настройка карты</a></li>
				<li><a href="#seo" data-toggle="tab">SEO</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="contactsData">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Телефон</label>
								<input type="tel" class="form-control" name="phone" id="exampleInputEmail1"
									   placeholder="Телефон" value="<?php echo $data->phone ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">E-mail</label>
								<input type="email" class="form-control" name="email" id="exampleInputEmail1"
									   placeholder="E-mail" value="<?php echo $data->email ?>">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Адрес</label>
								<input type="tel" class="form-control" name="address" id="exampleInputEmail1"
									   placeholder="Адрес" value="<?php echo $data->address ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Время работы</label>
								<input type="tel" class="form-control" name="work_time" id="exampleInputEmail1"
									   placeholder="Время работы"
									   value="<?php echo $data->work_time ?>">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Метро описание</label>
								<input type="tel" class="form-control" name="metro" id="exampleInputEmail1"
									   placeholder="Метро описание"
									   value="<?php echo $data->metro ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="map">
					<div class="row">
						<div class="col-md-12">
							<h3>Координаты</h3>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">LAT</label>
								<input type="text" class="form-control" id="exampleInputEmail1"
									   placeholder="Координаты LAT" name="lat" value="<?php echo $data->lat ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">LNG</label>
								<input type="text" class="form-control" name="lng" id="exampleInputEmail1"
									   placeholder="Координаты LNG" value="<?php echo $data->lng ?>">
							</div>
						</div>

						<div class="col-md-12">
							<h3>Настройка маркера</h3>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Подпись маркера</label>
								<input type="text" class="form-control" name="marker" id="exampleInputEmail1"
									   placeholder="Подпись маркера"
									   value="<?php echo $data->marker ?>">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Текст тултипа</label>
								<input type="text" class="form-control" name="tooltip_text" id="exampleInputEmail1"
									   placeholder="Текст тултипа"
									   value="<?php echo $data->tooltip_text ?>">
							</div>
						</div>
					</div>
				</div>
				<?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo]); ?>
			</div>
		</div>
		<div class="box-footer no-border">
			<div class="col-md-7 pull-right text-right">
				<div class="col-md-2 pull-right">
					<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
				</div>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>
