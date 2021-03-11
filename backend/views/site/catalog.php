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

				</div>
			</div>
		</div>
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#seo" data-toggle="tab">SEO</a></li>
			</ul>
			<div class="tab-content">
				<?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo, 'is_active' => true]); ?>
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
