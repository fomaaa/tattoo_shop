<?php
	use yii\helpers\Html;
?>
				<div class="tab-pane <?php if ($is_active) echo ' active '; ?>" id="seo">
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
