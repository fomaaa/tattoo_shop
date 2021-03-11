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


	<div class="col-md-5">
		<h4>Редактирование: Подписка на рассылку mail chimp</h4>
	</div>

	<div class="col-md-7 text-right">
		<!-- 	<div class="col-md-2 pull-right">
						<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
					</div> -->

		<div class="col-md-5 pull-right">
			<div class="checkbox">
				<label for="productmodel-is_published">
					<input type="checkbox"  <?php if ($data->enabled) echo ' checked '; ?>
						   name="enabled">
					Включить подписку
				</label>
				<p class="help-block help-block-error"></p>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label for="subscribe">API ключ</label>
			<input id="subscribe" type="tel" class="form-control" name="api_key"
				   placeholder="Телефон" value="<?php echo $data->api_key ?>">
		</div>
	</div>

	<div class="col-md-7 pull-right text-right">
		<div class="col-md-2 pull-right">
			<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
