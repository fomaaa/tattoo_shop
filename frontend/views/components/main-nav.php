<?php
  	use common\models\ProductModel;
	$count = count($categories['main']);
	$parentActive = ProductModel::get_parent_category($currentCategory['id']);
?>

<nav class="nav nav--catalog" id="catalogNav">
	<?php if (is_array($categories['main'])) : ?>
		<ul class="menu">
			<?php foreach ($categories['main'] as $key => $cat) : ?>

				<?php ?>
				<li class="menu__item <?php if ($parentActive == $cat['id']) echo ' is-active '; ?>">
					<a href="<?php echo \Yii::$app->breadcrumbs->getCategoryLink($cat['id']); ?>"><?php echo $cat['name'] ?></a>
					<?php if (isset($categories['sub'][$cat['id']])) : ?>
						<ul class="subMenu">
							<?php foreach ($categories['sub'][$cat['id']] as $index => $subcat) : ?>
								<li class="subMenu__item <?php if ($currentCategory['id'] == $subcat['id']) echo ' is-active '; ?>">
									<a href="<?php echo \Yii::$app->breadcrumbs->getCategoryLink($subcat['id']); ?>"><?php echo $subcat['name'] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

</nav>
