<?php
$attributes = array();
if ($product->attributes) $attributes = json_decode($product->attributes, 1);
$quantity = $product->is_in_cart();

if (!$quantity || $product->status != "instock") $quantity = 1;

?>
<main class="pageWrapper">
	<div class="section section--goodCard section--paddingTopDefault">
		<div class="containerFluid section__inner">
			<div class="goodCard">
				<div class="goodCard__left">
					<div class="goodCardSlider">
						<?php if ($product->thumbnail_path || is_array($product->attachments)) : ?>
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<img src="<?php echo \Yii::$app->helper->getImage($product->thumbnail) ?>/508x400"
											 alt="">
									</div>
									<?php if (is_array($product->attachments)) : ?>
										<?php foreach ($product->attachments as $image) : ?>
											<div class="swiper-slide">
												<img src="<?php echo \Yii::$app->helper->getImage($image) ?>/508x400" alt="">
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<div class="swiper-button swiper-button-prev"></div>
								<div class="swiper-button swiper-button-next"></div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="goodCard__right">
					<?php echo \Yii::$app->view->renderFile('@app/views/components/breadcrumbs.php', ['product' => $product]); ?>
					<div class="goodCard__title">  <?php echo $product->name ?>          </div>
					<div class="goodCard__status"> <?php echo $product->get_status(); ?> </div>
					<?php if ($product->status == "instock") : ?>
					<form action="/cart/add-item-single" class="form form--addGood goodCard__order" method="post">
						<input type="hidden" name="product_id" value="<?php echo $product->id ?>"
							   class="js-good-value-target"/>
						<div class="goodCard__quantity">
							<div class="quantity quantity--lg">
								<div class="quantity__control quantity__control--minus minus">
									<svg class="icon icon-minus">
										<use xlink:href="/img/sprite.svg#icon-minus"></use>
									</svg>
								</div>
								<input type="text" class="quantity__value" name="quantity"
									   value="<?php echo $quantity; ?>"/>
								<div class="quantity__control quantity__control--plus plus">
									<svg class="icon icon-plus">
										<use xlink:href="/img/sprite.svg#icon-plus"></use>
									</svg>
								</div>
							</div>
						</div>
						<?php endif; ?>

						<div class="goodCard__price">
							<span class="price price--ruble"><?php echo $product->price * $quantity ?></span>
						</div>

						<?php if ($product->status == "instock") : ?>
						<?php if ($product->is_in_cart()) : ?>
							<div class="goodCard__buttons">
								<button class="btn btn--primary btn--lg js-cart-add-item" type="submit">
									<svg class="icon icon-checked">
										<use xlink:href="/img/sprite.svg#icon-checked"></use>
									</svg>
									<span>в корзине</span></button>
							</div>
						<?php else : ?>
							<div class="goodCard__buttons">
								<button class="btn btn--primary btn--lg js-cart-add-item" type="submit">добавить в
									корзину
								</button>
							</div>
						<?php endif; ?>
					</form>
				<?php endif; ?>


				</div>
				<div class="goodCard__bottom">
					<div class="tabs tabs--default">
						<div class="tabsList">
							<div class="tabsList__item">
								<a href="#" class="tab1 is-active">описание</a>
							</div>
							<?php if (isset($attributes[0]['key']) || isset($attributes[0]['value'])) : ?>
								<?php if ($attributes[0]['key'] || $attributes[0]['value']) : ?>
									<div class="tabsList__item">
										<a href="#" class="tab2">характеристики</a>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="tabsBox">
							<div class="tabs__con tabs__con_tab1 is-active">
								<div class="goodCardDescription">
									<article>
										<?php echo $product->description ?>
									</article>
								</div>
							</div>
							<?php if (isset($attributes[0]['key']) || isset($attributes[0]['value'])) : ?>
								<?php if ($attributes[0]['key'] || $attributes[0]['value']) : ?>
									<div class="tabs__con tabs__con_tab2">
										<div class="goodCardDescription">
											<table>
												<?php foreach ($attributes as $item) : ?>
													<tr>
														<td><?php echo $item['key'] ?></td>
														<td><?php echo $item['value'] ?></td>
													</tr>
												<?php endforeach; ?>
											</table>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo \Yii::$app->view->renderFile('@app/views/components/recomended-products.php', [
		'product' => $product,
	]); ?>
</main>
