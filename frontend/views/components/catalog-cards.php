<?php
use common\models\ProductCategoryModel;

?>

<?php if (is_array($categories['main'])) : ?>
	<div class="catalogCards">
		<?php foreach ($categories['main'] as $key => $cat) :
			$thumb = [
				'path' => $cat['thumbnail_path']
			];
			?>
			<div class="catalogCards__item">
				<div class="card card--category">
					<a href="<?php echo \Yii::$app->breadcrumbs->getCategoryLink($cat['id']); ?>" class="card__title"><?php echo $cat['name'] ?></a>
					<?php if (isset($categories['sub'][$cat['id']])) : ?>
						<ul class="card__subCategories">
							<?php foreach ($categories['sub'][$cat['id']] as $index => $subcat) : ?>
								<li class="">
									<a href="<?php echo \Yii::$app->breadcrumbs->getCategoryLink($subcat['id']); ?>"><?php echo $subcat['name'] ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ($thumb['path']) : ?>
						<div class="card__photo">
							<img src="<?php echo \Yii::$app->helper->getImage($thumb) ?>/165x165"
								 srcset="<?php echo \Yii::$app->helper->getImage($thumb) ?>/330x330 2x"
								 alt="catalog item">
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	Категории отсутствуют
<?php endif; ?>
