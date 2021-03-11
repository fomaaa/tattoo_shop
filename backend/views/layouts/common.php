<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use common\models\Orders;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
Yii::info(Yii::$app->components["i18n"]["translations"]['*']['class'], 'test');
$orderNotice = Orders::find()->select(['count(*) as count'])->where(['status' => 'processing'])->asArray()->one();
$orderNotice = $orderNotice['count'];

?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

<div class="wrapper">
	<!-- header logo: style can be found in header.less -->
	<header class="main-header">
		<a href="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl('/') ?>" class="logo">
			<!-- Add the class icon to your logo image or logo icon to add the margining -->
			<?php echo 'TATTOOPRO' ?>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only"><?php echo Yii::t('backend', 'Toggle navigation') ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li id="timeline-notifications" class="notifications-menu">
						<a href="<?php echo Url::to(['/timeline-event/index']) ?>">
							<i class="fa fa-bell"></i>
							<span class="label label-success">
                                <?php echo TimelineEvent::find()->today()->count() ?>
                            </span>
						</a>
					</li>
					<!-- Notifications: style can be found in dropdown.less -->
					<li id="log-dropdown" class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-warning"></i>
							<span class="label label-danger">
                                <?php echo SystemLog::find()->count() ?>
                            </span>
						</a>
						<ul class="dropdown-menu">
							<li class="header"><?php echo Yii::t('backend', 'You have {num} log items', ['num' => SystemLog::find()->count()]) ?></li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<?php foreach (SystemLog::find()->orderBy(['log_time' => SORT_DESC])->limit(5)->all() as $logEntry): ?>
										<li>
											<a href="<?php echo Yii::$app->urlManager->createUrl(['/system/log/view', 'id' => $logEntry->id]) ?>">
												<i class="fa fa-warning <?php echo $logEntry->level === Logger::LEVEL_ERROR ? 'text-red' : 'text-yellow' ?>"></i>
												<?php echo $logEntry->category ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
							<li class="footer">
								<?php echo Html::a(Yii::t('backend', 'View all'), ['/system/log/index']) ?>
							</li>
						</ul>
					</li>
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
								 class="user-image">
							<span><?php echo Yii::$app->user->identity->username ?> <i
										class="caret"></i></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header light-blue">
								<img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
									 class="img-circle" alt="User Image"/>
								<p>
									<?php echo Yii::$app->user->identity->username ?>
									<small>
										<?php echo Yii::t('backend', 'Member since {0, date, short}', Yii::$app->user->identity->created_at) ?>
									</small>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<?php echo Html::a(Yii::t('backend', 'Profile'), ['/sign-in/profile'], ['class' => 'btn btn-default btn-flat']) ?>
								</div>
								<div class="pull-left">
									<?php echo Html::a(Yii::t('backend', 'Account'), ['/sign-in/account'], ['class' => 'btn btn-default btn-flat']) ?>
								</div>
								<div class="pull-right">
									<?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<?php echo Html::a('<i class="fa fa-cogs"></i>', ['/system/settings']) ?>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
						 class="img-circle"/>
				</div>
				<div class="pull-left info">
					<p><?php echo Yii::t('backend', 'Hello, {username}', ['username' => Yii::$app->user->identity->getPublicIdentity()]) ?></p>
					<a href="<?php echo Url::to(['/sign-in/profile']) ?>">
						<i class="fa fa-circle text-success"></i>
						<?php echo Yii::$app->formatter->asDatetime(time()) ?>
					</a>
				</div>
			</div>
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<?php echo Menu::widget([
                'options' => ['class' => 'sidebar-menu tree', 'data' => ['widget' => 'tree']],
                'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                'activateParents' => true,
                'items' => [
                    [
                        'label' => Yii::t('backend', 'Main'),
                        'options' => ['class' => 'header'],
                    ],
                    [
                        'label' => Yii::t('backend', 'Timeline'),
                        'icon' => '<i class="fa fa-bar-chart-o"></i>',
                        'url' => ['/timeline-event/index'],
                        'badge' => TimelineEvent::find()->today()->count(),
                        'badgeBgClass' => 'label-success',
                    ],
                    [
                        'label' => Yii::t('backend', 'Users'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'url' => ['/user/index'],
                        'active' => Yii::$app->controller->id === 'user',
                        'visible' => Yii::$app->user->can('administrator'),
                    ],
                    [
                        'label' => 'Магазин',
                        'options' => ['class' => 'header'],
                    ],
	                [
		                'label' =>'Заказы',
		                'url' => ['/orders'],
		                'icon' => '<i class="fa fa-reorder"></i>',
		                'active' => Yii::$app->controller->id === 'orders',
		                'badge' => $orderNotice,
		                'badgeBgClass' => 'label-success',
	                ],
                    [
                        'label' =>'Товары',
                        'url' => ['/product'],
                        'icon' => '<i class="fa fa-barcode"></i>',
                        'active' => Yii::$app->controller->id === 'product',
                    ],
                    [
                        'label' =>'Категории',
                        'url' => ['/product-category'],
                        'icon' => '<i class="fa fa-list"></i>',
                        'active' => Yii::$app->controller->id === 'product-category',
                    ],
	                [
		                'label' => 'Карусели с товарами',
		                'url' => '#',
		                'icon' => '<i class="fa fa-star"></i>',
		                'options' => ['class' => 'treeview'],
		                'active' => Yii::$app->controller->action->id === 'novelty' || Yii::$app->controller->action->id === 'bestsellers',
		                'items' => [
			                [
				                'label' =>'Новинки',
				                'url' => ['/novelty'],
				                'icon' => '<i class="fa fa-fire"></i>',
				                'active' => Yii::$app->controller->action->id === 'novelty',
			                ],
			                [
				                'label' =>'Бестселлеры',
				                'url' => ['/bestsellers'],
				                'icon' => '<i class="fa fa-star"></i>',
				                'active' => Yii::$app->controller->action->id === 'bestsellers',
			                ]
		                ],
	                ],
                    [
                        'label' => Yii::t('backend', 'Content'),
                        'options' => ['class' => 'header'],
                    ],
                    [
                        'label' => Yii::t('backend', 'Страницы'),
                        'url' => ['/content/page/index'],
                        'icon' => '<i class="fa fa-thumb-tack"></i>',
                        'active' => Yii::$app->controller->id === 'page',
                    ],
                    [
                        'label' => 'Статические страницы',
                        'url' => '#',
                        'icon' => '<i class="fa fa-star-o"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => Yii::$app->controller->action->id == 'front-page' || Yii::$app->controller->action->id == 'contact' || Yii::$app->controller->action->id == 'errors',
                        'items' => [
                            [
                                'label' => 'Главная страница',
                                'url' => ['/content/front-page'],
                                'active' =>  Yii::$app->controller->action->id == 'front-page',
                            ],
                            [
                                'label' => 'Контакты',
                                'url' => ['/content/contact'],
                                'active' => Yii::$app->controller->action->id == 'contact',
                            ],
							[
								'label' => 'Страница ошибок',
								'url' => ['/errors'],
								'active' => Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'errors',
							],
							[
								'label' => 'Каталог',
								'url' => ['/catalog'],
								'active' => Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'catalog',
							],
                        ],
                    ],
                    [
                        'label' => 'Блог',
                        'url' => '#',
                        'icon' => '<i class="fa fa-files-o"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => 'content' === Yii::$app->controller->module->id &&
                            ('article' === Yii::$app->controller->id || 'category' === Yii::$app->controller->id),
                        'items' => [
                            [
                                'label' => 'Статьи',
                                'url' => ['/content/article/index'],
                                'icon' => '<i class="fa fa-file-o"></i>',
                                'active' => Yii::$app->controller->id === 'article',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Общие элементы страниц',
                        'url' => ['/content/layout'],
                        'icon' => '<i class="fa fa-cog"></i>',
                        'active' => Yii::$app->controller->action->id === 'layout',
                    ],
                    [
                        'label' => Yii::t('backend', 'Translation'),
                        'options' => ['class' => 'header'],
                        'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                    ],
                    [
                        'label' => Yii::t('backend', 'Translation'),
                        'url' => ['/translation/default/index'],
                        'icon' => '<i class="fa fa-language"></i>',
                        'active' => (Yii::$app->controller->module->id == 'translation'),
                        'visible' => Yii::$app->components["i18n"]["translations"]['*']['class'] === \yii\i18n\DbMessageSource::class,
                    ],
                    [
                        'label' => Yii::t('backend', 'System'),
                        'options' => ['class' => 'header'],
                    ],
	                [
		                'label' => 'Подписка на рассылку',
		                'url' => ['/system/settings/subscribe'],
		                'icon' => '<i class="fa fa-envelope-o"></i>',
		                'active' => (Yii::$app->controller->id == 'settings' && Yii::$app->controller->action->id == 'subscribe'),
	                ],
                    [
                        'label' => 'Файлы',
                        'url' => '#',
                        'icon' => '<i class="fa fa-th-large"></i>',
                        'options' => ['class' => 'treeview'],
                        'active' => (Yii::$app->controller->module->id == 'file'),
                        'items' => [
                            [
                                'label' => 'Хранилище',
                                'url' => ['/file/storage/index'],
                                'icon' => '<i class="fa fa-database"></i>',
                                'active' => (Yii::$app->controller->id == 'storage'),
                            ],
                            [
                                'label' => 'Менеджер файлов',
                                'url' => ['/file/manager/index'],
                                'icon' => '<i class="fa fa-television"></i>',
                                'active' => (Yii::$app->controller->id == 'manager'),
                            ],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend', 'Cache'),
                        'url' => ['/system/cache/index'],
                        'icon' => '<i class="fa fa-refresh"></i>',
                    ],
                    [
                        'label' => Yii::t('backend', 'System Information'),
                        'url' => ['/system/information/index'],
                        'icon' => '<i class="fa fa-dashboard"></i>',
                    ],
                    [
                        'label' => Yii::t('backend', 'Logs'),
                        'url' => ['/system/log/index'],
                        'icon' => '<i class="fa fa-warning"></i>',
                        'badge' => SystemLog::find()->count(),
                        'badgeBgClass' => 'label-danger',
                    ],
                ],
            ]) ?>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				<?php echo $this->title ?>
                <?php if (isset($this->params['subtitle'])): ?>
				<small><?php echo $this->params['subtitle'] ?></small>
				<?php endif; ?>
			</h1>

			<?php echo Breadcrumbs::widget(['tag' => 'ol',
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?php echo Alert::widget(['body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
			'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),]) ?>
            <?php endif; ?>
            <?php echo $content ?>
		</section><!-- /.content -->
	</div><!-- /.right-side -->

	<footer class="main-footer clearfix">
		<div class="pull-left">Создано в <a href="https://widesense.ru"
											target="_blank">Widesense.ru</a></div>
		<div class="pull-right">
			<strong>&copy; tattoopro.ru <?php echo date('Y') ?></strong>
		</div>
	</footer>
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
<script>var fixHelperSortable = function (e, ui) {
    ui.children().each(function () {
      $(this).width($(this).width());
    });
    return ui;
  };

  if ($(".container-items").length) {
    $(".container-items").sortable({
      items: ".item",
      cursor: "move",
      opacity: 0.6,
      axis: "y",
      handle: ".sortable-handle",
      helper: fixHelperSortable,
      update: function (ev) {
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
      }
    }).disableSelection();
  }

</script>
