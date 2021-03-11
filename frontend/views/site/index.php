<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
$count = count($categories['main']);
?>

<main class="pageWrapper">
	<div class="section section--banner">
		<div class="containerFluid section__inner">
			<div class="section__left">
				<nav class="nav nav--catalog">
					<?php if (is_array($categories['main'])) : ?>
						<ul class="menu">
							<?php foreach ($categories['main'] as $key => $cat) : ?>
								<?php ?>
								<li class="menu__item">
									<a href="/catalog/<?php echo $cat['slug'] ?>"><?php echo $cat['name'] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</nav>
			</div>
			<?php if ($slider['title'][0] || $slider['subtitle'][0] || $slider['image'][0]['path']  ) : ?>
				<div class="section__right">
					<div class="bannerSlider">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php foreach ($slider['title'] as $key => $item) :
//									$image = str_replace('\\', '/', $slider['image'][$key]['base_url'] . $slider['image'][$key]['path']);
									?>
									<div class="swiper-slide">
										<div class="bannerSliderItem"
											 style="background-image: url('<?php echo \Yii::$app->helper->getImage($slider['image'][$key]) ?>/720x436');">
											<?php if ($slider['link'][$key]) : ?><a href="<?php echo $slider['link'][$key]; ?>"
																		  class="bannerSliderItem__link"></a><?php endif; ?>
											<?php if ($item):  ?><div class="bannerSliderItem__title"><?php echo $item ?></div><?php endif; ?>
											<?php if ($slider['subtitle'][$key]):  ?><div class="bannerSliderItem__subtitle"><?php echo $slider['subtitle'][$key] ?></div><?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="section section--carousel">
		<div class="containerFluid section__inner">
			<div class="carouselHead">
				<div class="carouselHead__inner carouselHead__inner--new"></div>
			</div>
			<?php echo \Yii::$app->view->renderFile('@app/views/components/carousel-body.php', [
				'products' => $novelty,
			]); ?>
		</div>
	</div>
	<div class="section section--carousel">
		<div class="containerFluid section__inner">
			<div class="carouselHead">
				<div class="carouselHead__inner carouselHead__inner--bestsellers"></div>
			</div>
			<?php echo \Yii::$app->view->renderFile('@app/views/components/carousel-body.php', [
				'products' => $bestsellers,
			]); ?>
		</div>
	</div>
	<div class="section section--catalogCards">
		<div class="containerFluidXs section__inner">
			<?php echo \Yii::$app->view->renderFile('@app/views/components/catalog-cards.php', [
				'categories' => $categories,
			]); ?>
		</div>
	</div>
	<div class="section section--certificateOffer">
		<div class="container section__inner">
			<div class="certificateOffer">
				<div class="certificateOffer__head">
					<div class="certificateOffer__title">Подарочные сертификаты</div>
					<div class="certificateOffer__subtitle">на любую сумму</div>
				</div>
				<div class="certificateOffer__body">
					<form action="/cart/add-certificate" method="post" class="form form--certificateOffer">
						<div class="form__top">
							<div class="radioButtonPrice">
								<input type="radio" name="quantity" value="500" class="radioButtonPrice__input">
								<div class="radioButtonPrice__body">
									<span class="price price--ruble">500</span>
								</div>
							</div>
							<div class="radioButtonPrice">
								<input type="radio" value="1000" name="quantity" class="radioButtonPrice__input">
								<div class="radioButtonPrice__body">
									<span class="price price--ruble">1 000</span>
								</div>
							</div>
							<div class="radioButtonPrice">
								<input type="radio" value="2000" name="quantity" class="radioButtonPrice__input">
								<div class="radioButtonPrice__body">
									<span class="price price--ruble">2 000</span>
								</div>
							</div>
							<div class="radioButtonPrice">
								<input type="radio" value="5000" name="quantity" class="radioButtonPrice__input">
								<div class="radioButtonPrice__body">
									<span class="price price--ruble">5 000</span>
								</div>
							</div>
							<input type="text" name="custom" placeholder="или введите свою сумму">
						</div>
						<div class="form__bottom">
							<a href="#" class="btn btn--toCart js-cart-add-item">
								<svg class="icon icon-cart">
									<use xlink:href="img/sprite.svg#icon-cart"></use>
								</svg>
							</a>
						</div>
						<input type="hidden" name="product_id" value="1" class="js-good-value-target">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="section section--instBox">
		<div class="section__inner">
			<div class="instBox">
				<a href="https://instagram.com" target="_blank" class="instBox__line"></a>
				<div class="instBox__body" id="instafeed"></div>
				<a href="https://instagram.com" target="_blank" class="instBox__line"></a>
			</div>
		</div>
	</div>
	<?php if ($articles) : ?>
		<div class="section section--blogCards">
			<div class="section__inner">
				<div class="section__title">Blog</div>
				<div class="blogCards">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ($articles as $article) :
								$thumb = [
									'path' => $article->thumbnail_path
								];
								?>
								<div class="swiper-slide blogCards__item">
									<div class="card card--blog">
										<a href="/blog/<?php echo $article->slug ?>" class="card__link"></a>
										<div class="card__bg"
											 style="background-image: url('<?php echo \Yii::$app->helper->getImage($thumb) ?>');"></div>
										<div class="card__title"><?php echo $article->title; ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button swiper-button-prev"></div>
						<div class="swiper-button swiper-button-next"></div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($slider['advantage_title'][0] || $slider['advantage_image'][0]) : ?>

	<div class="section section--advantages">
		<div class="containerFluid section__inner">
			<ul class="advantagesList">
				<?php foreach ($slider['advantage_title'] as $key => $item) :
					$image = str_replace('\\', '/', $slider['advantage_image'][$key]['base_url'] . $slider['advantage_image'][$key]['path']);
				?>
				<li class="advantagesList__item">
					<div class="advantagesItem">
						<?php if ($image) :  ?>
						<div class="advantagesItem__icon">
							<img src="<?php echo $image; ?>" alt="<?php echo $item; ?>">
						</div>
						<?php endif; ?>
						<?php if ($item) :  ?><div class="advantagesItem__title"><?php echo $item; ?></div><?php endif; ?>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<?php echo \Yii::$app->view->renderFile('@app/views/components/subscribe-block.php', [
		'subscribe' => $subscribe
	]); ?>

	<?php echo \Yii::$app->view->renderFile('@app/views/components/contact-block.php', [
		'contacts' => $contacts,
	]); ?>

</main>
