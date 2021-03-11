<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\FavoritesModel;
use common\models\KeyStorageItem;

\frontend\assets\FrontendAsset::register($this);

$layout = KeyStorageItem::find()->where(['key' => 'frontend.layouts'])->one();
$layout = json_decode($layout->value);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<meta name="theme-color" content="#fff" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" media="all" href="/build/css/app.css" />
	<link rel="stylesheet" media="all" href="/custom/style.css" />

	<meta name="instagram-user-id" content="1989375575" />
	<meta name="instagram-client-id" content="50516e77200b4ba2865e82161ff2ca83" />
	<meta name="instagram-access-token" content="1989375575.1677ed0.0e33dd249da14c8ebaf96d7cb178f5b2" />
	<meta name="instagram-photos-limit" content="5" />

	<?php $this->head() ?>
	<?php $this->registerCsrfMetaTags() ?>
	<?php echo Yii::$app->view->params['meta_html']; ?>
</head>
<body class="">
<!-- BEGIN content -->
<div class="out">

	<header class="header <?php if (Yii::$app->request->url != '/' && Yii::$app->request->pathInfo != 'search') echo ' header--inner '; ?>">
		<div class="topBar">
			<div class="containerFluid">
				<div class="topBar__inner">
					<div class="topBar__left">
						<div class="topBar__phone">
							<a href="tel:<?php echo preg_replace('~[^0-9]+~','',$layout->phone); ?>"> <?php echo $layout->phone; ?> </a>
						</div>
					</div>
					<div class="topBar__center">
						<?php $left_nav = unserialize($layout->menu_left) ; ?>
						<?php $right_nav = unserialize($layout->menu_right) ; ?>
						<?php if (is_array($left_nav['name'])) : ?>
						<ul class="topBar__links">
							<?php foreach ($left_nav['name'] as $key => $item) : ?>
								<li class="menu__item">
									<a href="<?php echo $left_nav['url'][$key] ?>"><?php echo $left_nav['name'][$key] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<div class="topBar__timeTable">
							<span><?php echo $layout->schedule; ?></span>
						</div>
						<?php if (is_array($right_nav['name'])) : ?>
						<ul class="topBar__links">
							<?php foreach ($right_nav['name'] as $key => $item) : ?>
								<li class="menu__item">
									<a href="<?php echo $right_nav['url'][$key] ?>"><?php echo $right_nav['name'][$key] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
					<div class="topBar__right">
						<a href="<?php Yii::$app->user->isGuest ? $echo = '/login' : $echo = '/user/default' ; echo $echo; ?>" class="btn btn--profile">
							<svg class="icon icon-account">
								<use xlink:href="/img/sprite.svg#icon-account"></use>
							</svg>
							<span><?php Yii::$app->user->isGuest ? $echo = 'личный кабинет' : $echo = Yii::$app->user->identity->username ; echo $echo; ?></span>
						</a>
						<?php if (!Yii::$app->user->isGuest) : ?>
						<a href="/logout" class="btn btn--logout">
			                  <svg class="icon icon-logout">
			                    <use xlink:href="/img/sprite.svg#icon-logout"></use>
			                  </svg>
                		</a>
                		<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="containerFluid">
			<div class="header__inner">
				<div class="header__top">
					<a href="/" class="logo">
						<img src="/img/tatoopro_logo_2.png" alt="<?php echo Yii::$app->view->params['seo_title']; ?>">
					</a>
				</div>
				<div class="header__bottom">
					<div class="header__left">
						<a href="/catalog" class="btn btn--catalog">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.5px" height="45.5px">
								<path fill-rule="evenodd" fill="rgb(252, 79, 47)" d="M22.500,0.000 C34.926,0.000 45.000,10.074 45.000,22.500 C45.000,34.926 34.926,45.000 22.500,45.000 C10.074,45.000 -0.000,34.926 -0.000,22.500 C-0.000,10.074 10.074,0.000 22.500,0.000 Z" />
								<path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,22.000 L33.000,22.000 L33.000,23.000 L12.000,23.000 L12.000,22.000 Z" />
								<path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,29.000 L33.000,29.000 L33.000,30.000 L12.000,30.000 L12.000,29.000 Z" />
								<path fill-rule="evenodd" stroke="rgb(255, 255, 255)" stroke-width="1px" stroke-linecap="butt" stroke-linejoin="miter" fill="rgb(252, 79, 47)" d="M12.000,15.000 L33.000,15.000 L33.000,16.000 L12.000,16.000 L12.000,15.000 Z" />
							</svg>
							<span>весь каталог</span>
						</a>
					</div>
					<div class="header__center">
						<div class="header__search">
							<form action="/search" method="GET" class="form form--searchLine">
								<input type="text" name="s" placeholder="поиск">
								<button class="btn btn--glass" type="submit">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="69px" height="69px">
										<defs>
											<filter filterUnits="userSpaceOnUse" id="Filter_0" x="0px" y="0px" width="69px" height="69px">
												<feOffset in="SourceAlpha" dx="0" dy="2" />
												<feGaussianBlur result="blurOut" stdDeviation="3.162" />
												<feFlood flood-color="rgb(0, 0, 0)" result="floodOut" />
												<feComposite operator="atop" in="floodOut" in2="blurOut" />
												<feComponentTransfer>
													<feFuncA type="linear" slope="0.16" />
												</feComponentTransfer>
												<feMerge>
													<feMergeNode />
													<feMergeNode in="SourceGraphic" />
												</feMerge>
											</filter>
										</defs>
										<g filter="url(#Filter_0)">
											<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M34.500,10.000 C46.926,10.000 57.000,20.074 57.000,32.500 C57.000,44.926 46.926,55.000 34.500,55.000 C22.074,55.000 12.000,44.926 12.000,32.500 C12.000,20.074 22.074,10.000 34.500,10.000 Z" />
										</g>
										<path fill-rule="evenodd" fill="rgb(0, 0, 0)" d="M34.375,20.875 C40.726,20.875 45.875,26.080 45.875,32.500 C45.875,38.920 40.726,44.125 34.375,44.125 C28.024,44.125 22.875,38.920 22.875,32.500 C22.875,26.080 28.024,20.875 34.375,20.875 Z" />
										<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M40.703,20.875 C43.698,20.875 46.125,23.302 46.125,26.297 C46.125,29.291 43.698,31.719 40.703,31.719 C37.709,31.719 35.281,29.291 35.281,26.297 C35.281,23.302 37.709,20.875 40.703,20.875 Z" />
									</svg>
								</button>
							</form>
						</div>
					</div>
					<div class="header__right">
						<?php if (!Yii::$app->user->isGuest) : ?>
							<div class="header__favorites">
								<a href="/favorites" class="btn btn--favorite btn--lg">
				                    <span class="btn__icon">
				                      <svg class="icon icon-heart">
				                        <use xlink:href="/img/sprite.svg#icon-heart"></use>
				                      </svg>
				                    </span>
									<span class="badge"><?php echo FavoritesModel::find()->where(['is_actual' => 1, 'user_id' => Yii::$app->user->id])->count() ?></span>
								</a>
							</div>
						<?php endif; ?>
						<div class="header__cartMini">
							<?php echo \Yii::$app->view->renderFile('@app/views/cart/minicart.php', [
								'cart' => \Yii::$app->cart
							]); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php echo $content ?>
	<footer class="footer">
		<div class="containerFluid footer__inner">
			<div class="footer__column footer__column--left">
				<div class="footer__top">
					<div class="copyright">
						<p>© 2017-<?php echo date('Y') ?> Tattoopro.ru</p>
						<p>Все права защищены.</p>
					</div>
				</div>
				<div class="footer__bottom">
					<a href="/contact" class="btn btn--arrowRight">
						<span>написать нам</span>
						<svg class="icon icon-arrow_right">
							<use xlink:href="/img/sprite.svg#icon-arrow_right"></use>
						</svg>
					</a>
				</div>
			</div>
			<div class="footer__column footer__column--center">
				<?php $footer_nav = unserialize($layout->menu_footer) ; ?>
				<?php if (is_array($footer_nav['name'])) : ?>
				<nav class="nav nav--primary">
					<ul class="menu js-splitter" data-columns="2">
						<?php foreach ($footer_nav['name'] as $key => $item) : ?>
						<li class="menu__item">
							<a href="<?php echo $footer_nav['url'][$key] ?>"><?php echo $footer_nav['name'][$key] ?></a>
						</li>
						<?php endforeach; ?>

					</ul>
				</nav>
				<?php endif; ?>
			</div>
			<div class="footer__column footer__column--right">
				<ul class="socialsList">
					<li class="socialsList__item">
						<a href="<?php echo $layout->instagram; ?>" class="btn btn--arrowRight btn--arrowRightIcon">
							<svg class="icon icon-inst">
								<use xlink:href="/img/sprite.svg#icon-inst"></use>
							</svg>
							<span>мы в инстаграме</span>
							<svg class="icon icon-arrow_right">
								<use xlink:href="/img/sprite.svg#icon-arrow_right"></use>
							</svg>
						</a>
					</li>
					<li class="socialsList__item">
						<a href="<?php echo $layout->vk; ?>" class="btn btn--arrowRight btn--arrowRightIcon">
							<svg class="icon icon-vk">
								<use xlink:href="/img/sprite.svg#icon-vk"></use>
							</svg>
							<span>мы вконтакте</span>
							<svg class="icon icon-arrow_right">
								<use xlink:href="/img/sprite.svg#icon-arrow_right"></use>
							</svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</footer>
</div>

<!-- BEGIN scripts -->
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>" type="text/javascript"></script>
<script src="/build/js/vendor.js"></script>
<script src="/build/js/app.js"></script>
<script src="/custom/app.js"></script>
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/366a683b70964eac98d00aff9/4ca558940c9023e44bcefcc01.js");</script>
<!-- END scripts -->
</body>
</html>
