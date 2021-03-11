<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\base\MultiModel;


$this->title = 'Страницы ошибок';

$model = new MultiModel([
	'models' => [
		'error' => new \yii\base\DynamicModel([
			'error404_btn', 'error404_title', 'error404_description',
			'error404_btn_en', 'error404_title_en', 'error404_description_en',
			'error404_image', 'error404_link', 'error404_subtitle',

			'error500_title', 'error500_description', 'error500_btn',
			'error500_title_en', 'error500_description_en', 'error500_btn_en',
			'error500_link', 'error500_image', 'error500_subtitle'
		]),
	]
]);
$sizes = [1200, 768, 420];

$model = $model->getModel('error');

foreach ($sizes as $size) {
	if (isset($error404['error404_' . $size])) {
		$model->{'error404_' . $size} = $error404['error404_' . $size];
	}
	if (isset($error500['error500_' . $size])) {
		$model->{'error500_' . $size} = $error500['error500_' . $size];
	}

}
?>
<div class="page-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
		'id' => 'dynamic-form-1',
	]); ?>
	<div class="nav-tabs-custom nav-tabs-in">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#contentPage" data-toggle="tab">Настройки контента</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="active tab-pane" id="contentPage">
				<div class="nav-tabs-custom margin-minus-10">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#firstBlock" data-toggle="tab">404</a>
						</li>
						<li><a href="#secondBlock" data-toggle="tab">500</a></li>

					</ul>
					<div class="tab-content">

						<div class="active tab-pane" id="firstBlock">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'error404_title')->textInput(['value' => $error404['error404_title']])->label('Заголовок') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error404_subtitle')->textInput(['value' => $error404['error404_subtitle']])->label('Подзаголовок') ?>
								</div>

								<div class="col-md-12">
									<?= $form->field($model, 'error404_description')->textarea([ 'class' => 'tinymce', 'value' => $error404['error404_description']])->label('Описание') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error404_btn')->textInput(['value' => $error404['error404_btn']])->label('Текст кнопки') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error404_link')->textInput(['value' => $error404['error404_link']])->label('Ссылка кнопки') ?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="secondBlock">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'error500_title')->textInput(['value' => $error500['error500_title']])->label('Заголовок') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error500_subtitle')->textInput(['value' => $error500['error500_subtitle']])->label('Подзаголовок') ?>
								</div>

								<div class="col-md-12">
									<?= $form->field($model, 'error500_description')->textarea([ 'class' => 'tinymce', 'value' => $error500['error500_description']])->label('Описание') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error500_btn')->textInput(['value' => $error500['error500_btn']])->label('Текст кнопки') ?>
								</div>
								<div class="col-md-6">
									<?= $form->field($model, 'error500_link')->textInput(['value' => $error500['error500_link']])->label('Ссылка кнопки') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="form-group margin-top-30">
		<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	</div>


	<?php ActiveForm::end(); ?>

</div>
