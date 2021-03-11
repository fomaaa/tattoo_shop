<?php

use common\models\ProductModel;
use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\ProductModel */
/* @var $form yii\bootstrap\ActiveForm */
$data->menu_left	 = unserialize($data->menu_left);
$data->menu_right	 = unserialize($data->menu_right);

$data->menu_footer	 = unserialize($data->menu_footer);



?>


<div class="product-model-index">

	<?php $form = ActiveForm::begin(
		['options' => ['enctype' => 'multipart/form-data'],
			'id' => 'dynamic-form-1',
			'enableClientValidation' => false,
			'enableAjaxValidation' => true]); ?>

	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-md-5">
					<h4>Редактирование: Основной layout</h4>
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
				<li class="active"><a href="#contactsData" data-toggle="tab">Шапка сайта</a>
				</li>
				<li><a href="#map" data-toggle="tab">Подвал сайта</a></li>
				<li><a href="#seo" data-toggle="tab">SEO</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="contactsData">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label >Телефон</label>
										<input type="tel" class="form-control" name="phone"
											   
											   placeholder="Телефон" value="<?php echo $data->phone ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label >Время работы</label>
										<input type="test" name="schedule" class="form-control"
											   
											   placeholder="Время работы" value="<?php echo $data->schedule ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<h3>Ссылки на страницы</h3>

							<div class="row">
								<div class="col-md-6">
									<h4>Левая часть</h4>

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
									<div class="box box-primary border-left border-right">
										<div class="box-body">
											<div class="container-items"><!-- widgetBody -->
												<?php if (is_array($data->menu_left['name'])) : $key = 0;?>
													<?php foreach ($data->menu_left['name'] as $item): ?>
														<!-- widgetItem -->
														<!-- ТУТ В ЦИКЛЕ ЯЧЕЙКА ВЫВОДИТЬСЯ, ЕСЛИ ДАННЫЕ УЖЕ ЕСТЬ -->
													<div class="item box box-default border-left border-right">
														<div class="box-header clearfix with-border">
															<div class="pull-left">
																<div class="sortable-handle text-center vcenter"
																	 style="cursor: move;">
																	<i class="fa fa-arrows"></i>
																</div>
															</div>
															<div class="pull-right">
																<button type="button"
																		class="remove-item btn btn-danger btn-xs">
																	<i class="glyphicon glyphicon-minus"></i>
																</button>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="box-body">
															<div class="row">
																<div class="col-md-6"><label for="">Название
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_left[name][]"
																		   aria-required="true" value="<?php echo $data->menu_left['name'][$key]; ?>">
																</div>
																<div class="col-md-6"><label for="">URL
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_left[url][]"
																		   aria-required="true" value="<?php echo $data->menu_left['url'][$key]; ?>">
																</div>
															</div>
														</div>
													</div>
													<?php $key++; endforeach; ?>
												<?php else : ?>
													<!-- widgetItem -->
													<!-- А ТУТ ЕДИНИЧНАЯ ЯЧЕЙКА, КОГДА ДАННЫХ ЕЩЕ НЕТУ -->
													<div class="item box box-default border-left border-right">
														<div class="box-header clearfix with-border">
															<div class="pull-left">
																<div class="sortable-handle text-center vcenter"
																	 style="cursor: move;">
																	<i class="fa fa-arrows"></i>
																</div>
															</div>
															<div class="pull-right">
																<button type="button"
																		class="remove-item btn btn-danger btn-xs">
																	<i class="glyphicon glyphicon-minus"></i>
																</button>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="box-body">
															<div class="row">
																<div class="col-md-6"><label for="">Название
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_left[name][]"
																		   aria-required="true" >
																</div>
																<div class="col-md-6"><label for="">URL
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_left[url][]"
																		   aria-required="true" > 
																</div>
															</div>
														</div>
													</div>
												<?php endif ?>
											</div>
										</div>
										<div class="box-footer">
											<div class="pull-right">
												<button type="button"
														class="add-item btn btn-primary">
													<i
															class="glyphicon glyphicon-plus"></i>
													<span>Добавить</span>
												</button>
											</div>
										</div>
									</div>
									<?php DynamicFormWidget::end(); ?>
								</div>
								<div class="col-md-6">
									<h4>Правая часть</h4>
									<?php DynamicFormWidget::begin([
										'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
										'widgetBody' => '.container-items1', // required: css class selector
										'widgetItem' => '.item1', // required: css class
										'limit' => 999, // the maximum times, an element can be added (default 999)
										'min' => 1, // 0 or 1 (default 1)
										'insertButton' => '.add-item1', // css class
										'deleteButton' => '.remove-item1', // css class
										'model' => $model,
										'formId' => 'dynamic-form-1',
										'formFields' => [
											'full_name',

										],
									]); ?>
									<div class="box box-primary border-left border-right">
										<div class="box-body">
											<div class="container-items1"><!-- widgetBody -->
												<?php if (is_array($data->menu_right['name'])) : $key = 0; ?>
													<?php foreach ($data->menu_right['name'] as $item): ?>
													<div class="item1 box box-default border-left border-right">
														<div class="box-header clearfix with-border">
															<div class="pull-left">
																<div class="sortable-handle text-center vcenter"
																	 style="cursor: move;">
																	<i class="fa fa-arrows"></i>
																</div>
															</div>
															<div class="pull-right">
																<button type="button"
																		class="remove-item1 btn btn-danger btn-xs">
																	<i class="glyphicon glyphicon-minus"></i>
																</button>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="box-body">
															<div class="row">
																<div class="col-md-6"><label for="">Название
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		    name="menu_right[name][]"
																		   value="<?php echo $data->menu_right['name'][$key]; ?>"
																		   aria-required="true">
																</div>
																<div class="col-md-6"><label for="">URL
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		    name="menu_right[url][]"
																		   value="<?php echo $data->menu_right['url'][$key]; ?>"
																		   aria-required="true">
																</div>
															</div>
														</div>
													</div>
													<?php $key++; endforeach; ?>
												<?php else : ?>
													<div class="item1 box box-default border-left border-right">
														<div class="box-header clearfix with-border">
															<div class="pull-left">
																<div class="sortable-handle text-center vcenter"
																	 style="cursor: move;">
																	<i class="fa fa-arrows"></i>
																</div>
															</div>
															<div class="pull-right">
																<button type="button"
																		class="remove-item1 btn btn-danger btn-xs">
																	<i class="glyphicon glyphicon-minus"></i>
																</button>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="box-body">
															<div class="row">
																<div class="col-md-6"><label for="">Название
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_right[name][]"
																		   aria-required="true">
																</div>
																<div class="col-md-6"><label for="">URL
																		ссылки</label>
																	<input type="text"
																		   class="form-control"
																		   name="menu_right[url][]"
																		   aria-required="true">
																</div>
															</div>
														</div>
													</div>
												<?php endif ?>
											</div>
										</div>
										<div class="box-footer">
											<div class="pull-right">
												<button type="button"
														class="add-item1 btn btn-primary">
													<i
															class="glyphicon glyphicon-plus"></i>
													<span>Добавить</span>
												</button>
											</div>
										</div>
									</div>
									<?php DynamicFormWidget::end(); ?>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="tab-pane" id="map">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label class="h3"
									   >Copyright ©</label>
								<input type="text" class="form-control" name="copyright"

									   
									   value="<?php echo $data->copyright ?>">
							</div>


							<h3>Социальные сети</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label >Инстаграм</label>
										<input type="text" class="form-control"
											   name="instagram"
											   value="<?php echo $data->instagram ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label >Вконтакте</label>
										<input type="text" class="form-control" name="vk"
											   
											   value="<?php echo $data->vk ?>">
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-7">
							<h3>Настройка меню</h3>

							<?php DynamicFormWidget::begin([
								'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
								'widgetBody' => '.container-items2', // required: css class selector
								'widgetItem' => '.item2', // required: css class
								'limit' => 999, // the maximum times, an element can be added (default 999)
								'min' => 1, // 0 or 1 (default 1)
								'insertButton' => '.add-item2', // css class
								'deleteButton' => '.remove-item2', // css class
								'model' => $model,
								'formId' => 'dynamic-form-1',
								'formFields' => [
									'full_name',
								],
							]); ?>
							<div class="box box-primary border-left border-right">
								<div class="box-body">
									<div class="container-items2"><!-- widgetBody -->
										<?php if (is_array($data->menu_footer['name'])) : $key = 0;?>
											<?php foreach ($data->menu_footer['name'] as $item): ?>
											<div class="item2 box box-default border-left border-right">
												<div class="box-header clearfix with-border">
													<div class="pull-left">
														<div class="sortable-handle text-center vcenter"
															 style="cursor: move;">
															<i class="fa fa-arrows"></i>
														</div>
													</div>
													<div class="pull-right">
														<button type="button"
																class="remove-item2 btn btn-danger btn-xs">
															<i class="glyphicon glyphicon-minus"></i>
														</button>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-6"><label for="">Название
																ссылки</label>
															<input type="text"
																   class="form-control"
																   name="menu_footer[name][]"
																   value="<?php echo $data->menu_footer['name'][$key]; ?>"
																   aria-required="true">
														</div>
														<div class="col-md-6"><label for="">URL
																ссылки</label>
															<input type="text"
																   class="form-control"
																   name="menu_footer[url][]"
																   value="<?php echo $data->menu_footer['url'][$key]; ?>"
																   aria-required="true">
														</div>
													</div>
												</div>
											</div>
											<?php $key++; endforeach; ?>
										<?php else : ?>
											<div class="item2 box box-default border-left border-right">
												<div class="box-header clearfix with-border">
													<div class="pull-left">
														<div class="sortable-handle text-center vcenter"
															 style="cursor: move;">
															<i class="fa fa-arrows"></i>
														</div>
													</div>
													<div class="pull-right">
														<button type="button"
																class="remove-item2 btn btn-danger btn-xs">
															<i class="glyphicon glyphicon-minus"></i>
														</button>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-6"><label for="">Название
																ссылки</label>
															<input type="text"
																   class="form-control"
																   name="menu_footer[name][]"
																   aria-required="true" >
														</div>
														<div class="col-md-6"><label for="">URL
																ссылки</label>
															<input type="text"
																   class="form-control"
																   name="menu_footer[url][]"
																   aria-required="true">
														</div>
													</div>
												</div>
											</div>
										<?php endif ?>
									</div>
								</div>
								<div class="box-footer">
									<div class="pull-right">
										<button type="button"
												class="add-item2 btn btn-primary">
											<i class="glyphicon glyphicon-plus"></i>
											<span>Добавить</span>
										</button>
									</div>
								</div>
							</div>
							<?php DynamicFormWidget::end(); ?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="seo">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<h3>Настройка SEO
										<!-- <span class="badge bg-aqua">Значения по умолчанию для всего сайта</span> -->
									</h3>
								</div>
								<div class="col-md-6 text-right">
									<button type="button" class="btn btn-default h3"
											data-toggle="modal" data-target="#modal-default">
										Расширенные настройки SEO
									</button>

									<div class="modal fade text-left" id="modal-default"
										 style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close"
															data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span></button>
													<h4 class="modal-title">
														Расширенные настройки
													</h4>
												</div>
												<div class="modal-body">
													<h4>Twitter Card data</h4>
													<div class="form-group">
														<label >meta
															name="twitter:card"</label>
														<input type="text" class="form-control"
															   value="<?php echo $seo->twitter_card; ?>" name="Seo[twitter_card]">
													</div>
													<div class="form-group">
														<label >meta
															name="twitter:site"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->twitter_site; ?>" name="Seo[twitter_site]">
													</div>
													<div class="form-group">
														<label >meta
															name="twitter:title"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->twitter_title; ?>" name="Seo[twitter_title]">
													</div>
													<div class="form-group">
														<label >meta
															name="twitter:description"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->twitter_description; ?>" name="Seo[twitter_description]">
													</div>
													<div class="form-group">
														<label >meta
															name="twitter:creator"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->twitter_creator; ?>" name="Seo[twitter_creator]">
													</div>
													<div class="form-group">
														<label >meta
															name="twitter:image"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->twitter_image; ?>" name="Seo[twitter_image]">
													</div>

													<hr style="opacity: .25"/>

													<h4>Open Graph data</h4>
													<div class="form-group">
														<label >meta
															property="og:title"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_title; ?>" name="Seo[og_title]">
													</div>
													<div class="form-group">
														<label >meta
															property="og:type"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_type; ?>" name="Seo[og_type]">
													</div>
													<div class="form-group">
														<label >meta
															property="og:url"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_url; ?>" name="Seo[og_url]">
													</div>
													<div class="form-group">
														<label >meta
															property="og:image"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_image; ?>" name="Seo[og_image]">
													</div>
													<div class="form-group">
														<label >meta
															property="og:description"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_description; ?>" name="Seo[og_description]">
													</div>
													<div class="form-group">
														<label >meta
															property="og:site_name"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->og_site_name; ?>" name="Seo[og_site_name]">
													</div>
													<div class="form-group">
														<label >meta
															property="fb:admins"</label>
														<input type="text" class="form-control"
															   
															   value="<?php echo $seo->fb_admins; ?>" name="Seo[fb_admins]">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button"
															class="btn btn-default pull-left"
															data-dismiss="modal">Закрыть
													</button>
													<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label >Значение метатега - Title</label>
								<input type="text" name="Seo[title]" class="form-control" 
									   value="<?php echo $seo->title; ?>">
							</div>
							<div class="form-group">
								<label >Значение метатега -
									Description</label>
								<input type="text" name="Seo[description]" class="form-control" 
									   value="<?php echo $seo->description; ?>">
							</div>							
							<div class="form-group">
								<label >Значение метатега -
									Keywords</label>
								<input type="text" name="Seo[keywords]" class="form-control" 
									   value="<?php echo $seo->keywords; ?>">
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer no-border">
			<div class="col-md-7 pull-right text-right">
				<div class="row">
					<div class="col-md-2 pull-right">
						<?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>
