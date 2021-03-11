<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="product-model-form">
	<div class="nav-tabs-custom margin-minus-10 nav-tabs-in">
	<?php $form = ActiveForm::begin(
		['options' => ['enctype' => 'multipart/form-data'],
			'id' => 'dynamic-form-1',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true]); ?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#contentPage" data-toggle="tab">Настройки контента</a>
		</li>
		<li><a href="#seo" data-toggle="tab">Настройки SEO</a></li>
	</ul>
	<div class="tab-content">
		<div class="active tab-pane" id="contentPage">
			<div class="row">

				<?php echo $form->errorSummary($model); ?>

				<div class="col-md-12">
					<div class="row">
						<div class="form-group col-md-2">
							<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
						</div>
						<?= $form->field($model, 'is_published', ['options' => ['class' => 'col-md-2']])->checkbox(); ?>

						<div class="col-md-5 pull-right text-right">
							<a href="<?php echo Yii::getAlias('@frontend') . $model->get_url(); ?>" target="_blank">Перейти в карточку товара</a>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<?php echo $form->field($model, 'name', ['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
						<?php echo $form->field($model, 'slug', ['options' => ['class' => 'col-md-6'], 'inputTemplate' => '<div class="input-group"><span class="input-group-addon">' . Yii::getAlias('@frontend') .'/catalog/*category*/</span>{input}</div>',])
							->hint(Yii::t('backend', 'If you leave this field empty, the slug will be generated automatically'))
							->textInput(['maxlength' => true]) ?>
					</div>
				</div>


				<?php echo $form->field($model, 'category', ['options' => ['class' => 'col-md-2']])->dropdownlist($categories) ?>

				<?php echo $form->field($model, 'status', ['options' => ['class' => 'col-md-2']])->dropdownlist([
					'instock' => 'В наличии',
					'reserve' => 'Под заказ',
					'outstock' => 'Нет в наличии',
				]) ?>

				<?php echo $form->field($model, 'order_date', ['options' => ['class' => 'col-md-2']])->widget(
					DateTimeWidget::class,
					[
						'phpDatetimeFormat' => 'yyyy-MM-dd',
					]
				) ?>

				<?php //echo $form->field($model, 'rating', ['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true]) ?>

				<?php
				echo $form->field($model, 'price', [
					'options' => ['class' => 'col-md-2'],
					'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">руб</span></div>',
				]);
				?>

				<?php
				echo $form->field($model, 'sale_price', [
					'options' => ['class' => 'col-md-2'],
					'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">руб</span></div>',
				]);
				?>

				<?php echo $form->field($model, 'quantity', ['options' => ['class' => 'col-md-2']])->textInput() ?>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<?php echo $form->field($model, 'thumbnail', ['options' => ['class' => '']])->widget(
								Upload::class,
								[
									'url' => ['/file/storage/upload'],
									'maxFileSize' => 5000000, // 5 MiB,
									'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
								]);
							?>

						</div>
						<div class="col-md-6">
							<?php echo $form->field($model, 'attachments', ['options' => ['class' => '']])->widget(
								Upload::class,
								[
									'url' => ['/file/storage/upload'],
									'sortable' => true,
									'maxFileSize' => 5000000, // 10 MiB
									'maxNumberOfFiles' => 10,
									'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
								]);
							?>
						</div>
					</div>
				</div>
				
				<?php echo $form->field($model, 'description', ['options' => ['class' => 'col-md-12']])->widget(
					\yii\imperavi\Widget::class,
					[
						'plugins' => ['fullscreen', 'fontcolor', 'video'],
						'options' => [
							'minHeight' => 400,
							'maxHeight' => 400,
							'buttonSource' => true,
							'convertDivs' => false,
							'removeEmptyTags' => true,
							'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
						],
					]
				) ?>

				<?php echo $form->field($model, 'excerpt', ['options' => ['class' => 'col-md-12']])->textarea() ?>


				<div class="form-group col-md-12">
					<label class="control-label" for="productmodel-rating">Аттрибуты</label>
					<?php
					if ($model->attributes) $attributes = json_decode($model->attributes, true);
					?>
					<?php DynamicFormWidget::begin([
						'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
						'widgetBody' => '.container-items', // required: css class selector
						'widgetItem' => '.item', // required: css class
						'limit' => 999, // the maximum times, an element can be added (default 999)
						'min' => 1, // 0 or 1 (default 1)
						'insertButton' => '.add-item', // css class
						'deleteButton' => '.remove-item', // css class
						'model' => $model,
						'formId' => 'dynamic-form-1',
						'formFields' => [
							'full_name',

						],
					]); ?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="container-items"><!-- widgetBody -->
								<?php if (is_array($attributes)) : ?>
									<?php foreach ($attributes as $key => $item): ?>
										<div class="item panel panel-default"><!-- widgetItem -->
											<div class="panel-heading">
												<div class="pull-left">
													<div class="sortable-handle text-center vcenter"
														 style="cursor: move;">
														<i class="fa fa-arrows"></i>
													</div>
												</div>
												<div class="pull-right">
													<button type="button"
															class="remove-item btn btn-danger btn-xs"><i
																class="glyphicon glyphicon-minus"></i>
													</button>
													<button type="button"
															class="add-item btn btn-success btn-xs"><i
																class="glyphicon glyphicon-plus"></i>
													</button>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-6"><label for="">Атрибут</label>
														<input type="text" class="form-control"
															   name="ProductModel[attributes_key][]"
															   value="<?php echo $item['key'] ?>"
															   aria-required="true">
													</div>
													<div class="col-md-6"><label for="">Значение</label>
														<input type="text" class="form-control"
															   name="ProductModel[attributes_value][]"
															   value="<?php echo $item['value'] ?>"
															   aria-required="true">
													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php else : ?>
									<div class="item panel panel-default"><!-- widgetItem -->
										<div class="panel-heading">
											<div class="pull-left">
												<div class="sortable-handle text-center vcenter"
													 style="cursor: move;">
													<i class="fa fa-arrows"></i>
												</div>
											</div>
											<div class="pull-right">
												<button type="button"
														class="remove-item btn btn-danger btn-xs">
													<i class="glyphicon glyphicon-minus"></i></button>
												<button type="button"
														class="add-item btn btn-success btn-xs"><i
															class="glyphicon glyphicon-plus"></i></button>
											</div>
											<div class="clearfix"></div>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6"><label for="">Атрибут</label>
													<input type="text" class="form-control"
														   name="ProductModel[attributes_key][]"
														   aria-required="true">
												</div>
												<div class="col-md-6"><label for="">Значение</label>
													<input type="text" class="form-control"
														   name="ProductModel[attributes_value][]"
														   aria-required="true">
												</div>
											</div>
										</div>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
					<?php DynamicFormWidget::end(); ?>

				</div>
				<?php //echo $form->field($model, 'attributes')->textarea(['rows' => 6]) ?>

				<div class="form-group col-md-12">
					<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="seo">
			<?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo]); ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	</div>	

</div>
