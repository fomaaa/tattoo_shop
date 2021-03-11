<?php

use common\base\MultiModel;
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

$model = new MultiModel([
	'models' => [
		'data' => new \yii\base\DynamicModel([
			'image', 'title', 'subtitle', 'fake'
		]),
	]
]);
$model = $model->getModel('data');

$data = json_decode($data->value, true);
?>

<div class="product-model-form">

	<?php $form = ActiveForm::begin(
		['options' => ['enctype' => 'multipart/form-data'],
			'id' => 'dynamic-form-1']); ?>
	<div class="nav-tabs-custom margin-minus-10 nav-tabs-in">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#contentPage" data-toggle="tab">Настройки контента</a>
			</li>
			<li><a href="#seo" data-toggle="tab">Настройки SEO</a></li>
		</ul>
		<div class="tab-content">
			<div class="active tab-pane" id="contentPage">
				<div style="display: none">
					<?php echo $form->field($model, 'fake')->widget(
						Upload::class,
						[
							'url' => ['/file/storage/upload'],
							'maxFileSize' => 5000000, // 5 MiB,
							'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
						])->label(false);
					?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Элементы слайдера</h4>
						<div class="box box-primary border-left border-right">
							<div class="box-body">
								<div class="container-items1"><!-- widgetBody -->
									<?php if (is_array($data['title'])) : ?>
										<?php foreach ($data['title'] as $key => $item): ?>
											<div class="item1 box box-default border-left border-right">
												<div class="box-header clearfix with-border">
													<div class="pull-right">
														<button type="button"
																class="remove-item1 btn btn-danger btn-xs">
															<i class="glyphicon glyphicon-minus"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-6">
															<label for="">Заголовок</label>
															<textarea
																class="form-control"
																name="DynamicModel[title][]"
																aria-required="true"
															><?php echo $item; ?></textarea>
														</div>
														<div class="col-md-6">
															<label for="">Подзаголовок</label>
															<textarea
																class="form-control"
																name="DynamicModel[subtitle][]"
																aria-required="true"

															><?php echo $data['subtitle'][$key]; ?></textarea>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="">Ссылка</label>
																<input type="text"
																	   class="form-control"
																	   name="DynamicModel[link][]"
																	   value="<?php echo $data['link'][$key]; ?>"
																	   aria-required="true">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group field-dynamicmodel-image">
																<label class="control-label"
																	   for="dynamicmodel-image">Изображение</label>
																<div>
																	<input type="hidden" id="dynamicmodel-image"
																		   class="empty-value "
																		   name="DynamicModel[image][<?php echo $key ?>]">
																	<input type="file" id="slider<?php echo $key ?>"
																		   class="slider-image<?php echo $key ?>"
																		   name="_fileinput_image">
																</div>
															</div>
														</div>
														<?php
														if ($data['image'][$key]) :
															$image_data = json_encode(array($data['image'][$key]));
														else :
															$image_data = 'null';
														endif;

														$this->registerJs("jQuery('.slider-image" . $key . "').yiiUploadKit({'url':'/file/storage/upload?fileparam=_fileinput_image','multiple':false,'sortable':false,'maxNumberOfFiles':1,'maxFileSize':5000000,'minFileSize':null,'acceptFileTypes':/(\.|\/)(gif|jpe?g|png|svg)$/i,'files':" . $image_data . ",'previewImage':true,'showPreviewFilename':false,'pathAttribute':'path','baseUrlAttribute':'base_url','pathAttributeName':'path','baseUrlAttributeName':'base_url','messages':{'maxNumberOfFiles':'Достигнуто максимальное кол-во файлов','acceptFileTypes':'Тип файла не разрешен','maxFileSize':'Файл слишком большой','minFileSize':'Файл меньше минимального размера'},'name':'DynamicModel[image][" . $key . "]'})");
														?>
													</div>
												</div>
											</div>
										<?php endforeach; else : ?>
										<div class="item1 box box-default border-left border-right">
											<div class="box-header clearfix with-border">
												<div class="pull-right">
													<button type="button"
															class="remove-item1 btn btn-danger btn-xs">
														<i class="glyphicon glyphicon-minus"></i>
													</button>
												</div>
											</div>
											<div class="box-body">
												<div class="row">
													<div class="col-md-6">
														<label for="">Заголовок</label>
														<textarea
															class="form-control"
															name="DynamicModel[title][]"
															aria-required="true"
														></textarea>
													</div>
													<div class="col-md-6">
														<label for="">Подзаголовок</label>
														<textarea
															class="form-control"
															name="DynamicModel[subtitle][]"
															aria-required="true"

														></textarea>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for="">Ссылка</label>
															<input type="text" class="form-control"
																   name="DynamicModel[link][]"
																   aria-required="true">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group field-dynamicmodel-image">
															<label class="control-label"
																   for="dynamicmodel-image">Изображение</label>
															<div>
																<input type="hidden" id="dynamicmodel-image" class="empty-value "
																	   name="DynamicModel[image][0]">
																<input type="file" id="slider0" class="slider-image0"
																	   name="_fileinput_image">
															</div>
														</div>
													</div>
													<?php
													$this->registerJs("jQuery('.slider-image0').yiiUploadKit({'url':'/file/storage/upload?fileparam=_fileinput_image','multiple':false,'sortable':false,'maxNumberOfFiles':1,'maxFileSize':5000000,'minFileSize':null,'acceptFileTypes':/(\.|\/)(gif|jpe?g|png|svg)$/i,'files':null,'previewImage':true,'showPreviewFilename':false,'pathAttribute':'path','baseUrlAttribute':'base_url','pathAttributeName':'path','baseUrlAttributeName':'base_url','messages':{'maxNumberOfFiles':'Достигнуто максимальное кол-во файлов','acceptFileTypes':'Тип файла не разрешен','maxFileSize':'Файл слишком большой','minFileSize':'Файл меньше минимального размера'},'name':'DynamicModel[image][0]'})");
													?>
												</div>
											</div>
										</div>
									<?php endif ?>
								</div>
							</div>
							<div class="box-footer">
								<div class="pull-right">
									<button type="button"
											class="add-item1 btn btn-primary add-image">
										<i
											class="glyphicon glyphicon-plus"></i>
										<span>Добавить</span>
									</button>
								</div>
							</div>
						</div>
					</div>


				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Преимущества</h4>
						<div class="box box-primary border-left border-right">
							<div class="box-body">
								<div class="container-items2"><!-- widgetBody -->
									<?php if (is_array($data['advantage_title'])) : ?>
										<?php foreach ($data['advantage_title'] as $key => $item): ?>
											<div class="item1 box box-default border-left border-right">
												<div class="box-header clearfix with-border">
													<div class="pull-right">
														<button type="button"
																class="remove-item1 btn btn-danger btn-xs">
															<i class="glyphicon glyphicon-minus"></i>
														</button>
													</div>
												</div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-6">
															<label for="">Заголовок</label>
															<textarea
																class="form-control"
																name="DynamicModel[advantage_title][]"
																aria-required="true"
															><?php echo $item; ?></textarea>
														</div>
														<div class="col-md-6">
															<div class="form-group field-dynamicmodel-advantage_image">
																<label class="control-label"
																	   for="dynamicmodel-image">Изображение</label>
																<div>
																	<input type="hidden" id="dynamicmodel-advantage_image"
																		   class="empty-value "
																		   name="DynamicModel[advantage_image][<?php echo $key ?>]">
																	<input type="file" id="advantage<?php echo $key ?>"
																		   class="advantage-image<?php echo $key ?>"
																		   name="_fileinput_advantage_image">
																</div>
															</div>
														</div>
														<?php
														if ($data['advantage_image'][$key]) :
															$image_data = json_encode(array($data['advantage_image'][$key]));
														else :
															$image_data = 'null';
														endif;

														$this->registerJs("jQuery('.advantage-image" . $key . "').yiiUploadKit({'url':'/file/storage/upload?fileparam=_fileinput_advantage_image','multiple':false,'sortable':false,'maxNumberOfFiles':1,'maxFileSize':5000000,'minFileSize':null,'acceptFileTypes':/(\.|\/)(gif|jpe?g|png|svg)$/i,'files':" . $image_data . ",'previewImage':true,'showPreviewFilename':false,'pathAttribute':'path','baseUrlAttribute':'base_url','pathAttributeName':'path','baseUrlAttributeName':'base_url','messages':{'maxNumberOfFiles':'Достигнуто максимальное кол-во файлов','acceptFileTypes':'Тип файла не разрешен','maxFileSize':'Файл слишком большой','minFileSize':'Файл меньше минимального размера'},'name':'DynamicModel[advantage_image][" . $key . "]'})");
														?>
													</div>
												</div>
											</div>
										<?php endforeach; else : ?>
										<div class="item1 box box-default border-left border-right">
											<div class="box-header clearfix with-border">
												<div class="pull-right">
													<button type="button"
															class="remove-item1 btn btn-danger btn-xs">
														<i class="glyphicon glyphicon-minus"></i>
													</button>
												</div>
											</div>
											<div class="box-body">
												<div class="row">
													<div class="col-md-6">
														<label for="">Заголовок</label>
														<textarea
															class="form-control"
															name="DynamicModel[advantage_title][]"
															aria-required="true"
														></textarea>
													</div>
													<div class="col-md-6">
														<div class="form-group field-dynamicmodel-advantage_image">
															<label class="control-label" for="dynamicmodel-advantage_image">Изображение</label>
															<div>
																<input type="hidden" id="dynamicmodel-advantage_image"
																	   class="empty-value "
																	   name="DynamicModel[advantage_image][0]">
																<input type="file" id="advantage0" class="advantage-image0"
																	   name="_fileinput_advantage_image">
															</div>
														</div>
													</div>
													<?php
													$this->registerJs("jQuery('.advantage-image0').yiiUploadKit({'url':'/file/storage/upload?fileparam=_fileinput_advantage_image','multiple':false,'sortable':false,'maxNumberOfFiles':1,'maxFileSize':5000000,'minFileSize':null,'acceptFileTypes':/(\.|\/)(gif|jpe?g|png|svg)$/i,'files':null,'previewImage':true,'showPreviewFilename':false,'pathAttribute':'path','baseUrlAttribute':'base_url','pathAttributeName':'path','baseUrlAttributeName':'base_url','messages':{'maxNumberOfFiles':'Достигнуто максимальное кол-во файлов','acceptFileTypes':'Тип файла не разрешен','maxFileSize':'Файл слишком большой','minFileSize':'Файл меньше минимального размера'},'name':'DynamicModel[advantage_image][0]'})");
													?>
												</div>
											</div>
										</div>
									<?php endif ?>
								</div>
							</div>
							<div class="box-footer">
								<div class="pull-right">
									<button type="button"
											class="add-item1 btn btn-primary add-advantage">
										<i
											class="glyphicon glyphicon-plus"></i>
										<span>Добавить</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="seo">
				<?php echo \Yii::$app->view->renderFile('@app/views/components/seo.php', ['seo' => $seo]); ?>
			</div>
		</div>
		<div class="col-md-12">
			<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
		</div>
	</div>
</div>

<?php ActiveForm::end(); ?>

</div>
