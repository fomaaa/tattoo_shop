<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategoryModel */
/* @var $form yii\bootstrap\ActiveForm */
$all = $model::find()->all();
$arrCat['0'] = '';
foreach ($all as $category) {
	$arrCat[$category->id] = $category->name;
}
?>
<div class="nav-tabs-custom margin-minus-10 nav-tabs-in">
<div class="product-category-model-form">

	<?php $form = ActiveForm::begin(); ?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#contentPage" data-toggle="tab">Настройки контента</a>
		</li>
		<li><a href="#seo" data-toggle="tab">Настройки SEO</a></li>
	</ul>
	<div class="tab-content">
		<div class="active tab-pane" id="contentPage">
			<?php echo $form->errorSummary($model); ?>

			<?php echo $form->field($model, 'thumbnail')->widget(
				Upload::class,
				[
					'url' => ['/file/storage/upload'],
					'maxFileSize' => 5000000, // 5 MiB,
					'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
				]);
			?>

			<?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<?php echo $form->field($model, 'parent')->dropdownlist($arrCat) ?>

			<?php echo $form->field($model, 'sort')->textInput() ?>

			<?php echo $form->field($model, 'slug')
				->hint(Yii::t('backend', 'If you leave this field empty, the slug will be generated automatically'))
				->textInput(['maxlength' => true]) ?>
		</div>
		
		<div class="tab-pane" id="seo">
			<?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo]); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
</div>
